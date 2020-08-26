<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use Socialite;
use Illuminate\Support\Facades\Redirect;
use App\Rules\Captcha;
use DB;
use App\Customers;
use App\Category;
use App\Brands;
use App\ShippingAddress;
use Hash;
session_start();

class MailController extends Controller
{
	public function checkUser(){
        if((Session::get('provider_id'))){
            $customer = Customers::where('provider_id',  Session::get('provider_id'))->first();
            return $customer->id_customer;
        }
        else
            return Session::get('id_customer');
    }

    public function sendMail(){
		$id_orders = DB::table('shop_oder_product')->orderBy('orders_id', 'DESC')->pluck('orders_id')->first();
		$emailShopvsCustomer = DB::table('shop_oder_product')
								->join('shop', 'shop.id_shop', 'shop_oder_product.id_shop')
								->where('orders_id', $id_orders)
								->groupBy('email_shop')
								->get(array(
									DB::raw('shop.id_shop as id_shop'),
									DB::raw('shop.email_shop as email_shop'),
									DB::raw('shop_oder_product.orders_id as orders_id'),
								)); 
		$url = \URL::to('/banhang')
		$details = [
		'title' => 'OGANI',
		'body' => "Bạn vừa có đơn đặt hàng vui lòng đăng nhập để kiểm tra!",
		'url' => $url
		];
		
		foreach($emailShopvsCustomer as $email){
			// echo($email->email_shop);
			\Mail::to($email->email_shop)->send(new \App\Mail\Mail($details));
		}

		$this->sendMailCustomer();
		
	}

	public function sendMailCustomer(){
			$url = null;
			$details = [
			'title' => 'OGANI',
			'body' =>"Cám ơn bạn đã mua hàng! Shop bán hàng sẽ kiểm tra đơn hàng và liên hệ với bạn sau!!",
			'url' => $url
			
		];
		\Mail::to(Session::get("email_customer"))->send(new \App\Mail\Mail($details));
		echo "Email sent";
		//dd($emailShopvsCustomer);
	}
}
