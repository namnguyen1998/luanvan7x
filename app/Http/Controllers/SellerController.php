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
			if(!empty(Session::get('id_customer')) || empty(Session::get('id_customer')))
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
        $dataShop = DB::table('shop')->where('id_shop','=',$id_shop)->where('status_shop','=',1)->first();
        
        $productShop = DB::table('sub_category')->join('products','sub_category_id','=','id_sub')
        ->where('shop_id','=',$id_shop)
        ->where('is_deleted','=','0')
        ->paginate(9);
        $categoryShop = DB::table('shop')->join('products_category','shop_id','=','id_shop')
        ->where('id_shop','=',$id_shop)
        ->groupBy(array(
            DB::raw('sub_category_id'),
            DB::raw('shop.id_shop '),
            DB::raw('shop.email_shop'),
            DB::raw('shop.password_shop'),
            DB::raw('shop.name_shop'),
            DB::raw('shop.phone_shop'),
            DB::raw('shop.customer_id'),
            DB::raw('shop.img_shop'),
            DB::raw('shop.address_shop'),
            DB::raw('shop.status_shop'),
            DB::raw('shop.created_at'),
            DB::raw('shop.updated_at')            
            ))
        ->get();
        
        // $countProductsByShop = DB::table('products')->join('sub_category','id_sub','=','sub_category_id')
        // ->where('shop_id','=',$id_shop)->count();
        if($dataShop != null){
            Session::put('dataShop',$dataShop);
        }
        //dd($subCateProductShop);
        return view('pages.page_product_shop', compact('productShop','categoryShop'));
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
                                    // ->select('')
                                    ->join('customers', 'customers.id_customer', '=', 'orders.customer_id')
                                    ->first();
            $loadAddressCustomer = DB::table('shipping_address')->where('customer_id', '=', $loadOrders->customer_id)->where('status_default','=', 1)->first();
            return view('users.seller.banhang_orderDetail', compact('loadOrderDetail', 'loadShop', 'loadOrders', 'loadAddressCustomer'));
        }
        else 
            return redirect::to('/danh-sach-don-hang');
    }

    // Revenue Shop
    public function profitShopDashboard(){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d 23:59:59');
        $lastMonth = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -30, date("Y")));
        $lastMonth = date('Y-m-d H:i:s', strtotime($lastMonth));
        $loadOrderShop = DB::table('shop_oder_product')
                            ->whereBetween('created_at', [$lastMonth, $dayNow])
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('date', 'ASC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"')
                            ));
        return $loadOrderShop->count();
    }

    public function revenueShopDashboard(){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d 23:59:59');
        $lastMonth = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -30, date("Y")));
        $lastMonth = date('Y-m-d H:i:s', strtotime($lastMonth));
        $loadOrderShop = DB::table('shop_oder_product')
                            ->whereBetween('created_at', [$lastMonth, $dayNow])
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('date')
                            ->orderBy('date', 'ASC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('SUM(price_product * quantity) as "revenue"')
                            ));
        return $loadOrderShop->sum('revenue');
    }

    public function profitChartDashboard(){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d 23:59:59');
        $lastWeek = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -7, date("Y")));
        $lastWeek = date('Y-m-d H:i:s', strtotime($lastWeek));
        $loadOrderShop = DB::table('shop_oder_product')
                            ->whereBetween('created_at', [$lastWeek, $dayNow])
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('date', 'ASC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"')
                            ));

        foreach (json_decode($loadOrderShop) as $order=>$orderDate){
            $countDate[$order] = $orderDate->date;
        }
        
        return array_count_values($countDate);
    }
    
    public function revenueChartDashboard(){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d 23:59:59');
        $lastWeek = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -7, date("Y")));
        $lastWeek = date('Y-m-d H:i:s', strtotime($lastWeek));
        $loadOrderShop = DB::table('shop_oder_product')
                            ->whereBetween('created_at', [$lastWeek, $dayNow])
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('date')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('SUM(price_product * quantity) as "revenue"')
                            ));
        return json_decode($loadOrderShop);
    }

    public function revenueShop(){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d');
        $loadOrderShop = DB::table('shop_oder_product')
                            ->whereDate('created_at', $dayNow)
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"'),
                                DB::raw('SUM(price_product * quantity) as "price_order"')
                            ));
        return view('users.seller.banhang_revenue', compact('loadOrderShop'));
    }

    public function revenueShopAjax($val_revenue){
        if ($val_revenue == -11){
            $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
            $yesterday = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -1, date("Y")));
            $loadOrderShop = DB::table('shop_oder_product')
                            ->whereDate('created_at', $yesterday)
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"'),
                                DB::raw('SUM(price_product * quantity) as "price_order"')
                            ));
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }

        elseif ($val_revenue == -10){
            $dayNow = now()->setTimezone(new DateTimeZone("Asia/Ho_Chi_Minh"));
            $loadOrderShop = DB::table('shop_oder_product')
                            ->whereDate('created_at', $dayNow)
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"'),
                                DB::raw('SUM(price_product * quantity) as "price_order"')
                            ));
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }

        elseif ($val_revenue == -1){
            $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
            if ($dayNow->format('d') == 31)
                $lastMonth = date("m", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -31, date("Y")));
            else
                $lastMonth = date("m", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -30, date("Y")));
            $yearNow = date_format($dayNow, 'Y');
            $loadOrderShop = DB::table('shop_oder_product')
                            ->whereMonth('created_at', $lastMonth)
                            ->whereYear('created_at', '=', $yearNow)
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"'),
                                DB::raw('SUM(price_product * quantity) as "price_order"')
                            ));
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }

        elseif ($val_revenue == 0){
            $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
            $lastMonth = date("m", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d"), date("Y")));
            $yearNow = date_format($dayNow, 'Y');
            $loadOrderShop = DB::table('shop_oder_product')
                            ->whereMonth('created_at', $lastMonth)
                            ->whereYear('created_at', '=', $yearNow)
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"'),
                                DB::raw('SUM(price_product * quantity) as "price_order"')
                            ));
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }
        
        else {
            $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
            $yearNow = date_format($dayNow, 'Y');
            $loadOrderShop = DB::table('shop_oder_product')
                            ->whereMonth('created_at', '=', $val_revenue)
                            ->whereYear('created_at', '=', $yearNow)
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('date', 'DESC')
                            ->get(array(
                                DB::raw('Date(created_at) as date'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('COUNT(orders_id) as "profit"'),
                                DB::raw('SUM(price_product * quantity) as "price_order"')
                            ));
            return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }
    }
}
