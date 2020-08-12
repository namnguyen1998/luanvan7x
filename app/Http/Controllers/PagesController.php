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
        ->where('is_deleted','=',0)->paginate(9);
        $subCategorybyCategory = DB::table('sub_category')->join('category','id_category','=','category_id')
        ->where('category_id','=',$id_category)
        ->get();
        $loadBrand = Brands::where('category_id', $id_category)->get();
        // dd($subCategorybyCategory);
    	return view('pages.trangsanpham',compact('productCategory','subCategorybyCategory', 'loadBrand'));
    }

    public function getPagesProductDetail($id_product){
        $productByID = DB::table('products')
                                ->join('shop','id_shop','=','shop_id')
                                ->where('is_deleted','=',0)
                                ->where('id_product','=',$id_product)->get();

        foreach ($productByID as $key => $value){
            $sub_category = $value->sub_category_id;
        }
        
        $productsRalated = DB::table('products')->where('sub_category_id','=',$sub_category)
                                ->where('is_deleted','=',0)
                                ->inRandomOrder()->limit(4)->get();
        $listComments = DB::table('comment')->join('customers','id_customer','=','customer_id')
                                ->select('customers.name_customer', 'comment.created_at', 'comment.content')
                                ->orderBy('created_at', 'DESC')
                                ->where('product_id','=',$id_product)
                                ->get();

        return view('pages.chitietsanpham',compact('productByID','productsRalated','listComments'));
    }
    public function getPagesProductDetailSlug($slug_product){
        $productByID = DB::table('products')
                                ->join('shop','id_shop','=','shop_id')
                                ->where('is_deleted','=',0)
                                ->where('slug','=',$slug_product)->get();
                                //var_dump($productByID);
        return view('pages.chitietsanpham',compact('productByID'));
    }
    public function getProductsSubCategory($id_category, $id_sub){
        $subCategorybyCategory = DB::table('sub_category')->join('category','id_category','=','category_id')
        ->where('category_id','=',$id_category)
        ->get();
        $products_sub = Products::where('sub_category_id','=',$id_sub)->where('is_deleted','=',0)->paginate(9);

        return view('pages.sanpham_sub',compact('subCategorybyCategory','products_sub'));
        
    }
    public function getSearch(Request $request){
        if($request->key != null){
            $keySearch = $request->key;
        };
        $products = DB::table('products_category')
        ->where('name_product','like','%'.$keySearch.'%')
        ->where('is_deleted','=',0)
        ->orWhere('price_product',$keySearch)
        ->orWhere('name_shop',$keySearch)
        ->get();
        return view('pages.search', compact('products','keySearch'));
    }

    public function sortByProduct(Request $req){
        if (empty($req->sortBy)) {
            $productCategory = DB::table('products_category')->where('category_id','=',$req->id_category)
                                ->where('is_deleted','=',0)
                                ->paginate(9);
        }
        else {
            $productCategory = DB::table('products_category')->where('category_id','=',$req->id_category)
                                ->where('is_deleted','=',0)
                                ->orderBy('price_product', $req->sortBy)
                                ->paginate(9);
        }

        return view('pages.trangsanpham_sortByProductAjax', compact('productCategory'));
    }
}
