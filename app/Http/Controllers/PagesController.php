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
session_start();

class PagesController extends Controller
{
	public function getIndex(){
    	return view('pages.home');
    }
    // public function getPagesProduct(){
    // 	return view('pages.trangsanpham');
    // }
    public function getPagesProductDetail(){
    	return view('pages.chitietsanpham');
    }
    public function getCategory(){
    	$Category = Category::all();
    	return view('pages.header',compact('Category'));
    }

    public function getPagesProductCategory($id_category){
    	$productCategory = DB::table('products_category')->where('category_id','=',$id_category)->get();
    	return view('pages.header');
    }
}
