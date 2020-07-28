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
    public function sendMailCustomer(){

    	
		$details = [
			'title' => 'Mail from OGANI',
			'body' => 'Cám ơn bạn đã đặt hàng shop bán hàng sẽ kiểm tra đơn hàng của đã đặt'
		];
		\Mail::to(Session::get('email_customer'))->send(new \App\Mail\Mail($details));
		echo "Email sent";
	}

	public function sendMailShop(){
		$url = \URL::to('/banhang');
		$details = [
			'title' => 'Mail from OGANI',
			'body' => 'Bạn vừa có đơn hàng. Vui lòng đăng nhập để kiểm tra', 
			'url' => $url
		];
		\Mail::to('le.trong.an256@gmail.com')->send(new \App\Mail\Mail($details));
		echo "Email sent";
	}
}
