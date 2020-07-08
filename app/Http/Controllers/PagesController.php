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

class PagesController extends Controller
{
	public function getIndex(){
        $Category = Category::all();
        $productCategory = DB::table('products_category')->where('category_id','=',1)
        ->where('status_product','=',1)->get();
        $listProducts = Products::where('status_product','=',1)->get();
        var_dump(Session::get('id_shop'));
        //var_dump($productCategory);
    	return view('pages.home',compact('Category','listProducts'));
    }
    public function getPagesProductCategory($id_category){
    	$productCategory = DB::table('products_category')->where('category_id','=',$id_category)
        ->where('status_product','=',1)->get();
        $subCategorybyCategory = DB::table('sub_category')->join('category','id_category','=','category_id')
        ->where('category_id','=',$id_category)
        ->get();
    	return view('pages.trangsanpham',compact('productCategory','subCategorybyCategory'));
    }
    public function getPagesProductDetail($id_product){
        $productByID = DB::table('products')->where('id_product','=',$id_product)->get();
        //var_dump($productByID);
        return view('pages.chitietsanpham',compact('productByID'));
    }
}
