<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use Socialite;
use Illuminate\Support\Facades\Redirect;
use DateTimeZone;
use DB;
use App\Customers;
use App\Category;
use App\Brands;
use App\ShippingAddress;
use App\Products;
use App\Orders;
use App\OrderDetail;
session_start();

class SellerController extends Controller
{
	public function AuthLogin(){
	    $id_shop = Session::get('id_shop');
	    if($id_shop){
	        return Redirect::to('/dashboard');
	    }else{
	        return Redirect::to('/banhang')->send();
	    }
	}

    public function sellerChannel(){
		if(!empty(Session::get('id_shop')))
			return Redirect::to('/dashboard');
		else
			if(!empty(Session::get('id_customer')))
				return view('users.seller.banhang_login');
			else
				return Redirect::to('/');
	}
	
    public function sellerDashBoard(){
    	$this->AuthLogin();
    	return view('users.seller.banhang_thongke');

    }
   public function postSellerDashBoard(Request $request){
        $this->AuthLogin();
        $email_shop = $request->email_shop;
        $password_shop = md5($request->password_shop);
        $result = DB::table('shop')
                    ->where('email_shop', $email_shop)
                    ->where('password_shop', $password_shop)
                    ->where('status_shop', '=', 1)
                    ->first();               
        if(!empty($result)){
            Session::put('name_shop',$result->name_shop);
            Session::put('img_shop',$result->img_shop);
            Session::put('id_shop',$result->id_shop);
            return Redirect::to('/dashboard');
        }
        else
            return Redirect::to('/banhang');
    }	
    public function logoutShop(){
    	$this->AuthLogin();
    	Session::forget('id_shop');
    	return Redirect::to('/');
    }
    public function getShop($id_shop){
        $dataShop = DB::table('shop')->where('id_shop','=',$id_shop)->first();
        
        $productShop = DB::table('sub_category')->join('products','sub_category_id','=','id_sub')
        ->where('shop_id','=',$id_shop)
        ->where('is_deleted','=','0')
        ->get();
        $categoryShop = DB::table('shop')->join('products_category','shop_id','=','id_shop')->where('id_shop','=',$id_shop)->get();
        
        $countProductsByShop = DB::table('products')->join('sub_category','id_sub','=','sub_category_id')
        ->where('shop_id','=',$id_shop)->count();
        if($dataShop != null){
            Session::put('dataShop',$dataShop);
        }
        //dd($subCateProductShop);
        return view('pages.page_product_shop', compact('productShop','countProductsByShop','categoryShop'));
    }

    // Order Shop
    public function loadOrderShop(){
        $loadOrderShop = DB::table('shop_oder_product')
                            // ->whereBetween('created_at', [$lastMonth, $dayNow])
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('created_at', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as created_at'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('name_shop as name_shop'),
                                DB::raw('SUM(price_product * quantity) as "price_order"')
                            ));
                            // ->get();
                            // dd($loadOrderShop);
        return view('users.seller.banhang_listOrder', compact('loadOrderShop'));
    }

    public function loadOrderDetailShop($orders_id){
        $loadOrderDetail = OrderDetail::select('products.name_product', 'products.price_product', 'shop.id_shop', 'shop.name_shop', 'order_detail.id_order_detail', 'order_detail.quantity')
                                ->join('orders', 'orders.id_orders', '=', 'order_detail.orders_id')
                                ->join('products', 'products.id_product', '=', 'order_detail.product_id')
                                ->leftjoin('shop', 'shop.id_shop', '=', 'products.shop_id')
                                ->where('id_shop', '=', Session::get('id_shop'))
                                ->where( 'orders_id', '=', $orders_id)
                                ->get();
        if (!empty($loadOrderDetail->count())){
            $loadShop = DB::table('shop')->where('id_shop','=', Session::get('id_shop'))->first();
            $loadOrders = Orders::where('id_orders', $orders_id)
                                ->join('customers', 'customers.id_customer', '=', 'orders.customer_id')
                                ->first();
            $loadAddressCustomer = DB::table('shipping_address')->where('customer_id', '=', $loadOrders->customer_id)->where('status_default','=', 1)->first();
            return view('users.seller.banhang_orderDetail', compact('loadOrderDetail', 'loadShop', 'loadOrders', 'loadAddressCustomer'));
        }
        else 
            return redirect::to('/danh-sach-don-hang');
    }

    // Revenue Shop
    public function profitShop($date){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d 23:59:59');
        $loadOrderShop = DB::table('shop_oder_product')
                            ->whereBetween('created_at', [$date, $dayNow])
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->where('status_order', '!=', -1)
                            ->groupBy('orders_id')
                            ->orderBy('date', 'ASC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"')
                            ));
        return $loadOrderShop;
    }

    public function revenueShop($date){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d 23:59:59');
        $loadOrderShop = DB::table('shop_oder_product')
                            ->whereBetween('created_at', [$date, $dayNow])
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->where('status_order', '!=', -1)
                            ->groupBy('date')
                            ->orderBy('date', 'ASC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('SUM(price_product * quantity) as "revenue"')
                            ));
        return $loadOrderShop;
    }

    public function revenueShopFilterDate($date){
        $loadOrderShop = DB::table('shop_oder_product')
                            ->whereDate('created_at', $date)
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->where('status_order', '!=', -1)
                            ->groupBy('orders_id')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"'),
                                DB::raw('SUM(price_product * quantity) as "price_order"')
                            ));
        return $loadOrderShop;
    }

    public function revenueShopFilterMonth($date){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $yearNow = date_format($dayNow, 'Y');
        $loadOrderShop = DB::table('shop_oder_product')
                        ->whereMonth('created_at', $date)
                        ->whereYear('created_at', '=', $yearNow)
                        ->where('id_shop', '=', Session::get('id_shop'))
                        ->where('status_order', '!=', -1)
                        ->groupBy('orders_id')
                        ->orderBy('date', 'DESC')
                        ->get(array(
                            DB::raw('Date(created_at) as date'),
                            DB::raw('orders_id as orders_id'),
                            DB::raw('COUNT(orders_id) as "profit"'),
                            DB::raw('SUM(price_product * quantity) as "price_order"')
                        ));
        return $loadOrderShop;
    }

    public function profitShopDashboard(){
        $lastMonth = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -30, date("Y")));
        $lastMonth = date('Y-m-d H:i:s', strtotime($lastMonth));
        $getDataLastMonth = $this->profitShop($lastMonth);
        return $getDataLastMonth->count();
    }

    public function revenueShopDashboard(){
        $lastMonth = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -30, date("Y")));
        $lastMonth = date('Y-m-d H:i:s', strtotime($lastMonth));
        $getDataLastMonth = $this->revenueShop($lastMonth);
        return $getDataLastMonth->sum('revenue');
    }

    public function profitChartDashboard(){
        $lastWeek = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -7, date("Y")));
        $lastWeek = date('Y-m-d H:i:s', strtotime($lastWeek));

        $getDataLastWeek = $this->profitShop($lastWeek);
        foreach (json_decode($getDataLastWeek) as $order=>$orderDate){
            $countDate[$order] = $orderDate->date;
        }
        
        return array_count_values($countDate);
    }
    
    public function revenueChartDashboard(){
        $lastWeek = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -7, date("Y")));
        $lastWeek = date('Y-m-d H:i:s', strtotime($lastWeek));
        $getDataLastWeek = $this->revenueShop($lastWeek);
        return json_decode($getDataLastWeek);
    }

    public function revenueShopDate(){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d');
        $loadOrderShop = $this->revenueShopFilterDate($dayNow);
        return view('users.seller.banhang_revenue', compact('loadOrderShop'));
    }

    public function revenueShopAjax($val_revenue){
        if ($val_revenue == -11){
            $yesterday = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -1, date("Y")));
            $loadOrderShop = $this->revenueShopFilterDate($yesterday);
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }

        elseif ($val_revenue == -10){
            $dayNow = now()->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
            $dayNow = date_format($dayNow, 'Y-m-d');
            $loadOrderShop = $this->revenueShopFilterDate($dayNow);
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }

        elseif ($val_revenue == -1){
            $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
            if ($dayNow->format('d') == 31)
                $lastMonth = date("m", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -31, date("Y")));
            else
                $lastMonth = date("m", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -30, date("Y")));

            $loadOrderShop = $this->revenueShopFilterMonth($lastMonth);
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }

        elseif ($val_revenue == 0){
            $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
            $lastMonth = date("m", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d"), date("Y")));

            $loadOrderShop = $this->revenueShopFilterMonth($lastMonth);
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }
        
        else {
            $loadOrderShop = $this->revenueShopFilterMonth($val_revenue);
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }
    }
}
