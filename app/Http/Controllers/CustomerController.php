<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Customers;
use Hash;
session_start();

class CustomerController extends Controller
{
    public function getLoginForm(){
    	return view('login');
    }
    public function postLogin(Request $request){
        $this->validate($request,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required'=>'Vui lòng nhập Email',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu có ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu không quá 20 kí tựs'
            ]);
    	

        $email = $request->email;
    	$password =md5($request->password);

    	// $result = DB::table('Customers')
    	// ->where('email_customer', $email)
    	// ->where('password_customer', $password)->first();
    	$result = Customers::where('email_customer', $email)->where('password_customer',$password)->first();
        
    	if($result){
            Session::put('name_customer',$result->name_customer);
            Session::put('id_customer',$result->id_customer);
    		return redirect::to('/');
    	}else{
    		return redirect::to('/login');
    	}
    }
    public function getRegisterForm(){
    	return 	view('register');
    }
    public function postRegister(Request $request){
    	$this->validate($request,
    		[
    			'email' => 'required|email|unique:customers,email_customer',
    			'password' => 'required|min:6|max:20',
    			're_password' => 'required|same:password',
    		],
    		[
    			'email.required'=>'Vui lòng nhập Email',
    			'email.unique'=>'Email đã được sử dụng',
    			'password.required'=>'Vui lòng nhập mật khẩu',
    			're_password.same'=>'Mật khẩu không giống nhau',
    			'password.min'=>'Mật khẩu có ít nhất 6 kí tự'
    		]);
    	$customer = new Customers();
    	$customer->email_customer = $request->email;
    	$customer->password_customer = md5($request->password);	
    	$customer->save();

    	return redirect('/')->with('success','Tạo tài khoản thành công');
    }
    public function logout(){
        Session::forget('id_customer');
        Session::forget('name_customer');

        return Redirect::to('/');
    }
    public function sellerChannel(){
        return view('pages.trangsanpham');
    }
}
