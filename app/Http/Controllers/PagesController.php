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
        // $productCategory = DB::table('products_category')->where('category_id','=',1)
        // ->where('status_product','=',1)->where('is_deleted','=',0)->get();
        $listProducts = Products::where('is_deleted','=',0)->orderby('id_product','desc')->paginate(12);
        //var_dump(Session::get('id_shop'));
        //var_dump($productCategory);
    	return view('pages.home',compact('Category','listProducts'));
    }
    public function getPagesProductCategory($id_category){
    	$productCategory = DB::table('products_category')->where('category_id','=',$id_category)
        ->where('is_deleted','=',0)->paginate(10);
        $subCategorybyCategory = DB::table('sub_category')->join('category','id_category','=','category_id')
        ->where('category_id','=',$id_category)
        ->get();
    	return view('pages.trangsanpham',compact('productCategory','subCategorybyCategory'));
    }
    public function getPagesProductDetail($id_product){
        $productByID = DB::table('products')->
        join('shop','id_shop','=','shop_id')
        ->where('is_deleted','=',0)
        ->where('id_product','=',$id_product)->get();
        //var_dump($productByID);
        return view('pages.chitietsanpham',compact('productByID'));
    }
    public function getPagesProductDetailSlug($slug_product){
        $productByID = DB::table('products')->
        join('shop','id_shop','=','shop_id')
        ->where('is_deleted','=',0)
        ->where('slug','=',$slug_product)->get();
        //var_dump($productByID);
        return view('pages.chitietsanpham',compact('productByID'));
    }
    public function getProductsSubCategory($id_category, $id_sub){
        $subCategorybyCategory = DB::table('sub_category')->join('category','id_category','=','category_id')
        ->where('category_id','=',$id_category)
        ->get();
        $products_sub = Products::where('sub_category_id','=',$id_sub)->where('is_deleted','=',0)->paginate(10);

        return view('pages.sanpham_sub',compact('subCategorybyCategory','products_sub'));
        
    }
    public function getSearch(Request $request){
        $products = DB::table('products_category')
        ->where('name_product','like','%'.$request->key.'%')
        ->orWhere('price_product',$request->key)
        // ->orWhere('name_shop',$request->key)
        ->get();
        $shop = DB::table('shop')->where('name_shop','like','%'.$request->key.'%')
        ->get();
        return view('pages.search', compact('products','shop'));
    }
}
