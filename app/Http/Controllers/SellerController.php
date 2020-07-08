<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use Socialite;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Customers;
use App\Category;
use App\Brands;
use App\ShippingAddress;
use App\Products;
session_start();

class SellerController extends Controller
{
	public function AuthLogin(){
	    $customer_id = Session::get('id_customer');
	    if($customer_id){
	        return Redirect::to('banhang');
	    }else{
	        return Redirect::to('/')->send();
	    }
	}
    public function sellerChannel(){
        return view('users.seller.banhang_login');
    }
    public function sellerDashBoard(){
    	$this->AuthLogin();
    	return view('users.seller.banhang_thongke');
    }
    public function postSellerDashBoard(Request $request){
    	$this->AuthLogin();
    	$email_shop = $request->email_shop;
    	$password_shop = md5($request->password_shop);
    	$result = DB::table('shop')->where('email_shop', $email_shop)->where('password_shop', $password_shop)->first();
    		Session::put('name_shop',$result->name_shop);
    		Session::put('img_shop',md5($result->img_shop));
    	return Redirect::to('/banhang/dashboard');
    }
}
