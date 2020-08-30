<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use Socialite;
use PDF;
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
use App\Shop;
use Illuminate\Support\Facades\Input;
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
    public function setNameImage($data){
        if(empty($data)){
            return null;
        }
        else{
            $getNameImage = current(explode('.', $data->getClientOriginalName()));
            $destinationPath = 'public/frontend/img/shop';
            $date = date('dmY');
            $hash = md5($getNameImage);
            $plus = $date . '_' . $hash . '.jpg';
            $data->move($destinationPath, $plus);
            return $plus;
        }
    }
    public function sellerChannel(){
		if(!empty(Session::get('shop')->id_shop))
			return Redirect::to('/dashboard');
		else
			if(!empty(Session::get('id_customer')) || empty(Session::get('id_customer')))
				return view('users.seller.banhang_login');
			else
				return Redirect::to('/banhang');
	}
	

    public function getProfileShop(){
        $this->AuthLogin();
        $shop = Shop::find(Session::get('shop')->id_shop);
        if(!empty($shop)){
            Session::put('shop',$shop);
            $phone_shop = substr($shop->phone_shop,7);
            $email_shop = substr($shop->email_shop,0,3);
        }
        return view('users.seller.profile_shop',compact('phone_shop', 'email_shop'));
    }

    public function updateProfileShop(Request $request){
        $this->AuthLogin();
        $this->validate($request, 
        [
            'name_shop' => 'unique:shop,name_shop',
            'img_shop' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ], 
        [
            'name_shop.unique' => 'Tên shop đã tồn tại! Vui lòng đặt tên khác!!',
            'img_shop.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'img_shop.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',

        ]);
        $shop = Shop::find(Session::get('shop')->id_shop);
        if($request->name_shop!= null){
            $shop->name_shop = $request->name_shop;
        }else{
            $shop->name_shop = $shop->name_shop;
        }
        if($request->phone_shop!= null){
            $shop->phone_shop = $request->phone_shop;
        }else{
             $shop->phone_shop = $shop->phone_shop;
        }
        if($request->img_shop){
            $shop->img_shop = $this->setNameImage($request->img_shop);
        }else{
            $shop->img_shop = $shop->img_shop;
        }
        $shop->save();
        //dd($customer);
        return Redirect::to('/ban-hang/profile-shop')->with('success','Cập nhật thông tin  thành công');
    }

    public function getFormUpdatePassword(){
        $this->AuthLogin();
        return view('users.seller.update_password_shop');
    }
    public function postUpdatePasswordShop(Request $request){
        $this->AuthLogin();
        $this->validate($request,[
                'new_password' => 'required|min:6|max:20',
                'password_new_confirmation' => 'required|same:new_password',
            ],
            [
                'new_password.required'=>'Vui lòng nhập mật khẩu',
                'password_new_confirmation.same'=>'Mật khẩu không giống nhau',
                'new_password.min'=>'Mật khẩu có ít nhất 6 kí tự',
                'new_password.max'=>'Mật khẩu có tối đa 20 kí tự'
            ]);
        $shop = Shop::find(Session::get('id_shop'));
        $shop->password_shop = md5($request->password_new_confirmation);
        $shop->save();
        return Redirect::to('/seller/update-password')->with('success','Cập nhật mật khẩu thành công');
    }

    public function sellerDashBoard(){
    	$this->AuthLogin();
    	return view('users.seller.banhang_thongke');

    }
   public function postSellerDashBoard(Request $request){
        $this->AuthLogin();
        $this->validate($request,
            [
                'email_shop' => 'required',
                'password_shop' => 'required|min:6|max:20',

            ],
            [
                'email_shop.required'=>'Vui lòng nhập Email',
                'password_shop.required'=>'Vui lòng nhập mật khẩu',
                'password_shop.min'=>'Mật khẩu có ít nhất 6 kí tự',
                'password_shop.max'=>'Mật khẩu có tối đa 20 kí tự'
            ]);
        $email_shop = $request->email_shop;
        $password_shop = md5($request->password_shop);
        $result = DB::table('shop')
                    ->where('email_shop', $email_shop)
                    ->where('password_shop', $password_shop)
                    ->where('status_shop', '=', 1)
                    ->first();               
        if(!empty($result)){
            Session::put('shop',$result);
            // Session::put('name_shop',$result->name_shop);
            // Session::put('img_shop',$result->img_shop);
            Session::put('id_shop',$result->id_shop);
            return Redirect::to('/dashboard');
        }
        else
            return Redirect::to('/banhang');
    }	
    public function logoutShop(){
    	$this->AuthLogin();
    	Session::forget('id_shop');
        Session::forget('shop');
    	return Redirect::to('/banhang');
    }

    public function getForgotPasswordShop(){
        return view('users.seller.forgot_password');
    }
     public function sendMailResetPassShop(Request $request)
    {
        $shop = Shop::where('email_shop',$request->email_shop)->first();

        //print_r($user);exit;
        if(($shop)== null){
            return redirect()->back()->with(['Lỗi' => 'Email không có trong hệ thống']);
        }

        $str = \Str::random(32);
        $url = \URL::to('/reset-password-shop?key='.$str.base64_encode($shop->id_shop));
        
        $details = [
            'url' => $url
        ];

        \Mail::to($shop->email_shop)->send(new \App\Mail\SendMailForgetPassword($details));
        
        return redirect()->back()->with(['Thành công' => 'Email đã được gửi. Vui lòng kiểm tra mail để cập nhật thông tin.']);
    }

    public function formResetPasswordShop(){
        $key = $_GET['key'];
        return view('users.seller.reset_password',compact('key'));
    }
    public function resetPasswordShop(Request $request){
        $this->validate($request,
            [
                'password_new' => 'required|min:6|max:20',
                'password_new_confirmation' => 'required|same:password_new',
            ],
            [
                'password_new.required'=>'Vui lòng nhập mật khẩu',
                'password_new_confirmation.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu có ít nhất 6 kí tự'
            ]);
        $keyID = base64_decode(substr($request->key,32));
        $shop = Shop::find($keyID);
        $shop->password_shop = md5($request->password_new);
        $shop->save();
        return Redirect('/banhang')->with('success','Cập nhật mật khẩu thành công');
    }
    public function getShop($id_shop){
        $dataShop = DB::table('shop')->where('id_shop','=', base64_decode(base64_decode($id_shop)))->where('status_shop','=',1)->first();
        
        $productShop = DB::table('sub_category')->join('products','sub_category_id','=','id_sub')
        ->where('shop_id','=', base64_decode(base64_decode($id_shop)))
        ->where('is_deleted','=','0')
        ->paginate(9);
        $categoryShop = DB::table('shop')->join('products_category','shop_id','=','id_shop')
        ->where('id_shop','=', base64_decode(base64_decode($id_shop)))
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
        ->select(
                    DB::raw('Date(created_at) as created_at'),
                    DB::raw('orders_id as orders_id'),
                    DB::raw('name_shop as name_shop'),
                    DB::raw('SUM(price_product * quantity) as "price_order"'),
                    DB::raw('status_order as "status_order"')
                )
            // ->whereBetween('created_at', [$lastMonth, $dayNow])
            ->where('id_shop', '=', Session::get('id_shop'))
            ->groupBy('orders_id')
            ->orderBy('created_at', 'DESC')
            ->paginate(10);
            // ->get();
            //dd($loadOrderShop);
        return view('users.seller.banhang_listOrder', compact('loadOrderShop'));
    }
    
    public function loadStatusShip(){
        $loadOrderShop = DB::table('shop_oder_product')
                            ->select(
                                DB::raw('Date(created_at) as created_at'),
                                DB::raw('orders_id as orders_id'),
                                DB::raw('name_shop as name_shop'),
                                DB::raw('SUM(price_product * quantity) as "price_order"'),
                                DB::raw('status_order as "status_order"')
                            )
                            ->where('status_order', '>=', 1)
                            ->where('id_shop', '=', Session::get('id_shop'))
                            ->groupBy('orders_id')
                            ->orderBy('created_at', 'DESC')
                            ->paginate(10);
        return view('users.seller.banhang_updateStatusShip', compact('loadOrderShop'));
    }

    public function updateStatusShip(Request $req){
        $updateStatusShip['status_order'] = $req->status_order;
        // $updateStatusShip['id_orders'] = $req->id_orders;
        // dd($updateStatusShip);
        Orders::where('id_orders', $req->id_orders)->update($updateStatusShip);
        Session::put('message','Cập nhật trạng thái thành công.');
        return redirect::to('/shop-cap-nhat-trang-thai-van-chuyen');
    }

    public function loadOrderDetailShop($orders_id){
        $loadOrderDetail = OrderDetail::select('order_detail.name_product_order_detail', 'order_detail.price_order_detail', 'shop.id_shop', 'shop.name_shop', 'order_detail.id_order_detail', 'order_detail.quantity')
                                ->join('orders', 'orders.id_orders', '=', 'order_detail.orders_id')
                                ->join('products', 'products.id_product', '=', 'order_detail.product_id')
                                ->leftjoin('shop', 'shop.id_shop', '=', 'products.shop_id')
                                ->where('id_shop', '=', Session::get('id_shop'))
                                ->where( 'orders_id', '=', base64_decode($orders_id))
                                // ->orderBy('created_at', 'DESC')
                                ->get();
        if (!empty($loadOrderDetail->count())){
            $loadShop = DB::table('shop')->where('id_shop','=', Session::get('id_shop'))->first();
            $loadOrders = Orders::where('id_orders', base64_decode($orders_id))
                                ->join('customers', 'customers.id_customer', '=', 'orders.customer_id')
                                ->first();
            $loadAddressCustomer = DB::table('shipping_address')->where('customer_id', '=', $loadOrders->customer_id)->first();
            return view('users.seller.banhang_orderDetail', compact('loadOrderDetail', 'loadShop', 'loadOrders', 'loadAddressCustomer'));
        }
        else 
            return redirect::to('/danh-sach-don-hang');
    }
    
    public function confirmOrderShop(Request $req){
        $confirmOrder['status_order'] = 1;
        Orders::where('id_orders', $req->id_orders)->update($confirmOrder);
    }

    public function downloadPDF(Request $req){
        $loadOrderDetail = OrderDetail::select('order_detail.name_product_order_detail', 'order_detail.price_order_detail', 'shop.id_shop', 'shop.name_shop', 'order_detail.id_order_detail', 'order_detail.quantity')
                                ->join('orders', 'orders.id_orders', '=', 'order_detail.orders_id')
                                ->join('products', 'products.id_product', '=', 'order_detail.product_id')
                                ->leftjoin('shop', 'shop.id_shop', '=', 'products.shop_id')
                                ->where('id_shop', '=', Session::get('id_shop'))
                                ->where( 'orders_id', '=', $req->id_orders)
                                ->get();
        $loadShop = DB::table('shop')->where('id_shop','=', Session::get('id_shop'))->first();
        $loadOrders = Orders::where('id_orders', $req->id_orders)
                            ->join('customers', 'customers.id_customer', '=', 'orders.customer_id')
                            ->first();
        $loadAddressCustomer = DB::table('shipping_address')->where('customer_id', '=', $loadOrders->customer_id)->first();

        $id_name_orders['id_orders'] = $loadOrders->id_orders;
        $id_name_orders['name_orders'] = $loadOrders->name_customer;

        view()->share('loadOrderDetail',$loadOrderDetail);
        view()->share('loadShop',$loadShop);
        view()->share('loadOrders',$loadOrders);
        view()->share('loadAddressCustomer',$loadAddressCustomer);  
        view()->share('id_name_orders', $id_name_orders);
        $pdf = PDF::loadView('users.seller.banhang_dowloadOrderDetail', [$loadAddressCustomer, $loadOrderDetail, $loadShop, $loadOrders, $loadAddressCustomer, $id_name_orders]);
        return $pdf->download('in-don-hang.pdf');
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

    public function revenueShopDateStartEnd(Request $req){
        $date_start = date('Y-m-d 00:00:00', strtotime($req->start));
        $date_end = date('Y-m-d 23:59:59', strtotime($req->end));
        if (empty($req->start) || empty($req->end)){
            return '<div class = "alert alert-dark alert-dismissible fade show" role="alert">Xin vui lòng chọn <strong>"Thời gian bắt đầu"</strong> và <strong>"Thời gian kết thúc"</strong> trước khi chọn <strong>"Lọc"</strong>.</div>';
        }
        elseif (date('Y-m-d', strtotime($req->end)) < date('Y-m-d', strtotime($req->start))){
            return '<div class = "alert alert-dark alert-dismissible fade show" role="alert"><strong>"Thời gian bắt đầu"</strong> không thể lớn hơn <strong>"Thời gian kết thúc"</strong>. Xin vui lòng chọn lại.</div>';
        }
        else {
            $loadOrderShop = DB::table('shop_oder_product')
                        ->whereBetween('created_at', [$date_start, $date_end])
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
                        
        return view('users.seller.banhang_revenueAjax', compact('loadOrderShop'));
        }
    }
    
}
