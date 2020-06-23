<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Customers;
session_start();

class CustomerController extends Controller
{
	public function AuthLogin(){
        $admin_id = Session::get('id');
        if($admin_id){
            return Redirect::to('ban-hang');
        }else{
            return Redirect::to('/')->send();
        }
    }
    public function getLogin(){
    	return view('login');
    }
    public function postLogin(Request $request){
    	$username = $request->username;
    	$password = $request->password;

    	// $result = DB::table('Customers')
    	// ->where('username_customer', $username)
    	// ->where('password_customer', $password)->get();
    	// if($username != DB::table('Customers')
    	// ->where('username_customer', $username)->get())

    	$result = Customers::where('username_customer', $username)->where('password_customer',$password)->first();

    	if($result){
    		Session::put('ten',$result->ten);
    		return redirect::to('/');
    	}else{
    		Session::put('message','Tài khoản hoặc mật khẩu không đúng');
    		return redirect::to('/login');
    	}
    }
    public function getSignup(){
    	return 	view('signup');
    }
    public function postSignup(Request $request){
    	
    }
}
