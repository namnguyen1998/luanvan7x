<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\Category;
use DB;

use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    //
    public function getLoginAdmin(){
    	return view('admin.admin_login');
    }

    public function postLoginAdmin(Request $request){
        

        $username_user = $request->_username_user;
    	$password =md5($request->_password_user);

    	$result = Users::where('email_user', $username_user)->where('password_user', $password)->first();
        
    	if($result){
            Session::put('username_user',$result->username_user);
            Session::put('email_user',$result->email_user);

            Session::put('id_users',$result->id_users);
            return view('admin.admin_dashboard');
            
    	}else{
    		return redirect::to('/admin');
        }
    }

    public function setAddProduct(){
        $listCategory = Category::all();
    	return view('admin.admin_addproduct')->with('admin.admin_addproduct',$listCategory);

    }




}
