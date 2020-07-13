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
	    $id_shop = Session::get('id_shop');
	    if($id_shop){
	        return Redirect::to('/banhang/dashboard');
	    }else{
	        return Redirect::to('/banhang')->send();
	    }
	}

    public function sellerChannel(){
		if(!empty(Session::get('id_shop')))
			return Redirect::to('/banhang/dashboard');
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
			return Redirect::to('/banhang/dashboard');
		}
		else
			return Redirect::to('/banhang');
		
	}
	
    public function logoutShop(){
    	$this->AuthLogin();
    	Session::forget('id_shop');
    	return Redirect::to('/');
    }
}
