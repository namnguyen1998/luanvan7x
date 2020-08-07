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

    	$emailShopvsCustomer = DB::table('shop_oder_product')->where('id_customer','=',$this->checkUser())
    	->join('shop','shop.id_shop','=','shop_oder_product.id_shop')
    	->groupBy(array(
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
			$details = [
			'title' => 'Mail from OGANI',
			'body' => "Bạn vừa có đơn đặt hàng vui lòng đăng nhập để kiểm tra!",
			'url' => \URL::to("/banhang"),
			];
		for($i = 0; $i<count($emailShopvsCustomer);$i++){
			//echo($emailShopvsCustomer[$i]->email_shop);
			\Mail::to($emailShopvsCustomer[$i]->email_shop)->send(new \App\Mail\Mail($details));
		}

		$this->sendMailCustomer();
		
	}

	public function sendMailCustomer(){
			$details = [
			'title' => 'Mail from OGANI',
			'body' =>"Cám ơn bạn đã mua hàng! Shop bán hàng sẽ kiểm tra đơn hàng và liên hệ với bạn sau!!",
			
		];
		\Mail::to(Session::get("email_customer"))->send(new \App\Mail\Mail($details));
		echo "Email sent";
		//dd($emailShopvsCustomer);
	}
}
