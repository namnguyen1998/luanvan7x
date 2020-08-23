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
    public function getTraCes(){
        $getIPconfigClient = explode('Physical Address. . . . . . . . .',shell_exec ("ipconfig/all"));  
        $getMacAddressClient = explode(':', $getIPconfigClient[1]);  
        $getMacAddressClient = explode(' ', $getMacAddressClient[1]);  
        $macAddressClient = $getMacAddressClient[1];
        $getMacAddress = DB::table('traces')->where('mac_address', $macAddressClient)->first();
        return $getMacAddress;
    }

    public function insertTracesClient(Request $req){
        // echo $req->id;
        $url = explode('/', $req->id);
        $getID = array_pop($url);
        $id = base64_decode(base64_decode($getID));
            // return $id;
        $getIPconfigClient = explode('Physical Address. . . . . . . . .',shell_exec ("ipconfig/all"));  
        $getMacAddressClient = explode(':', $getIPconfigClient[1]);  
        $getMacAddressClient = explode(' ', $getMacAddressClient[1]);  
        $macAddressClient = $getMacAddressClient[1];
        $getMacAddress = DB::table('traces')->where('mac_address', $macAddressClient)->first();
        // print_r( $getMacAddress);
        if (empty($getMacAddress)) {
            $dataTraves['mac_address'] = $macAddressClient;
            $dataTraves['data_traces'] = json_encode( array($id) );
            DB::table('traces')->insert( $dataTraves );
            return 1;
        }
        else {
            $arrayDataTraces = json_decode( $getMacAddress->data_traces );
            if ( count($arrayDataTraces) < 10 ) 
                 array_push ($arrayDataTraces, $id);
            else {
                $arrayDataTracesTemps = array_shift($arrayDataTraces);
                array_push ($arrayDataTraces, $id);
            }

            DB::table('traces')->where('mac_address', $macAddressClient)->update([ 'data_traces' => $arrayDataTraces ]);
            return $arrayDataTraces;
        }
        return 0;
    }

	public function getIndex(){
        $getIPconfigClient = explode('Physical Address. . . . . . . . .',shell_exec ("ipconfig/all"));  
        $getMacAddressClient = explode(':', $getIPconfigClient[1]);  
        $getMacAddressClient = explode(' ', $getMacAddressClient[1]);  
        $macAddressClient = $getMacAddressClient[1];

        $getMacAddress = DB::table('traces')->where('mac_address', $macAddressClient)->first();
        // $getNameProduct = Products::where('id_product', json_decode($getMacAddress->data_traces))->pluck('sub_category_id');
        // $a = json_decode($getMacAddress->data_traces);
        // dd(array_pop($a));
        // dd(($getNameProduct));

       
        if (empty($getMacAddress))
            $listProducts = Products::where('is_deleted','=',0)->where('status_product','!=', -1)->orderby('id_product','desc')->paginate(12);

        else {
            foreach (json_decode($getMacAddress->data_traces) as $aaa){
                $getNameProduct = Products::where('id_product', $aaa)->pluck('sub_category_id');
            }
            $listProducts = Products::where('is_deleted','=',0)->where('status_product','!=', -1)
                            // ->orderby('id_product','desc')
                            ->where('sub_category_id','like','%'.$getNameProduct[0].'%')
                            ->paginate(12);
        }
        // dd($listProducts);
        $Category = Category::all();
        // $productCategory = DB::table('products_category')->where('category_id','=',1)
        // ->where('status_product','=',1)->where('is_deleted','=',0)->get();

        
        //var_dump(Session::get('id_shop'));
        //var_dump($productCategory);
        $listTopProduct5 = Products::join('order_detail', 'order_detail.product_id', '=', 'products.id_product')
                                    ->where('is_deleted','=',0)
                                    ->where('status_product','!=', -1)
                                    ->leftjoin('orders', 'orders.id_orders', '=', 'order_detail.orders_id')
                                    ->groupBy('id_product')
                                    ->orderBy('topProduct', 'DESC')
                                    ->select('name_product', 'price_product', 'img_product', 'id_product')
                                    ->addSelect(DB::raw('COUNT(id_orders) as topProduct'))
                                    ->offset(0)->limit(5)->get();
        $listTopProduct10 = Products::join('order_detail', 'order_detail.product_id', '=', 'products.id_product')
                                    ->where('is_deleted','=',0)                            
                                    ->where('status_product','!=', -1)
                                    ->leftjoin('orders', 'orders.id_orders', '=', 'order_detail.orders_id')
                                    ->groupBy('id_product')
                                    ->orderBy('topProduct', 'DESC')
                                    ->select('name_product', 'price_product', 'img_product', 'id_product')
                                    ->addSelect(DB::raw('COUNT(id_orders) as topProduct'))
                                    ->offset(5)->limit(5)->get();
        $listNewProduct5 = Products::orderBy('id_product', 'DESC')->where('is_deleted','=',0)                            
                                    ->where('status_product','!=', -1)
                                    ->offset(0)->limit(5)->get();
        // dd($listNewProduct5);
        $listNewProduct10 = Products::orderBy('id_product', 'DESC')->where('is_deleted','=',0)                            
                                    ->where('status_product','!=', -1)
                                    ->offset(5)->limit(5)->get();
    	return view('pages.home',compact('Category','listProducts', 'listTopProduct5', 'listTopProduct10' ,'listNewProduct5', 'listNewProduct10'));
    }
    
    public function getPagesProductCategory($id_category){
    	$productCategory = DB::table('products_category')->where('category_id','=', base64_decode(base64_decode($id_category)))
                            ->where('is_deleted','=',0)
                            ->where('status_product','!=', -1)
                            ->paginate(9);
        $subCategorybyCategory = DB::table('sub_category')->join('category','id_category','=','category_id')
                            ->where('category_id','=', base64_decode(base64_decode($id_category)))
                            ->get();
        $loadBrand = Brands::where('category_id', base64_decode(base64_decode($id_category)))->get();
        // dd($subCategorybyCategory);
    	return view('pages.trangsanpham',compact('productCategory','subCategorybyCategory', 'loadBrand'));
    }

    public function getPagesProductDetail($id_product){
        $productByID = DB::table('products')
                                ->join('shop','id_shop','=','shop_id')
                                ->where('is_deleted','=',0)
                                ->where('status_product','!=', -1)
                                ->where('id_product','=', base64_decode(base64_decode($id_product)))->get();

        foreach ($productByID as $key => $value){
            $sub_category = $value->sub_category_id;
        }
        
        $productsRalated = DB::table('products')->where('sub_category_id','=', base64_decode(base64_decode($sub_category)))
                                ->where('is_deleted','=',0)
                                ->inRandomOrder()->limit(4)->get();
        $listComments = DB::table('comment')->join('customers','id_customer','=','customer_id')
                                ->select('customers.name_customer', 'comment.created_at', 'comment.content')
                                ->orderBy('created_at', 'DESC')
                                ->where('product_id','=', base64_decode(base64_decode($id_product)))
                                ->get();

        return view('pages.chitietsanpham',compact('productByID','productsRalated','listComments'));
    }
    public function getPagesProductDetailSlug($slug_product){
        $productByID = DB::table('products')
                                ->join('shop','id_shop','=','shop_id')
                                ->where('is_deleted','=',0)
                                ->where('status_product','!=', -1)
                                ->where('slug','=',$slug_product)->get();
                                //var_dump($productByID);
        return view('pages.chitietsanpham',compact('productByID'));
    }
    public function getProductsSubCategory($id_category, $id_sub){
        $subCategorybyCategory = DB::table('sub_category')->join('category','id_category','=','category_id')
        ->where('category_id','=', base64_decode(base64_decode($id_category)))
        ->get();
        
        $products_sub = Products::where('sub_category_id','=', base64_decode(base64_decode($id_sub)))->where('is_deleted','=',0)->paginate(9);
        return view('pages.sanpham_sub',compact('subCategorybyCategory','products_sub'));
        
    }
    public function getSearch(Request $request){
        if($request->key != null){
            $keySearch = $request->key;
        };
        $products = DB::table('products_category')
                        ->where('name_product','like','%'.$keySearch.'%')
                        ->where('is_deleted','=',0)
                        ->where('status_product','!=', -1)
                        ->orWhere('price_product',$keySearch)
                        ->orWhere('name_shop',$keySearch)
                        ->get();
        return view('pages.search', compact('products','keySearch'));
    }

    public function sortByProductCategories(Request $req){
        // Get the full URL for the previous request
        $id = explode('-', url()->previous());
        $id_category = array_pop($id);
        $id_category = base64_decode(base64_decode($id_category));
        $explode = explode(' ', $req->sortBy);
        if (empty($req->sortBy)) {
            $sortByProduct = DB::table('products_category')->where('category_id','=', $id_category)
                                ->where('is_deleted','=',0)
                                ->where('status_product','!=', -1)
                                ->get();
        }
        else {
            $sortByProduct = DB::table('products_category')->where('category_id','=',$id_category)
                                ->where('is_deleted','=',0)
                                ->where('status_product','!=', -1)
                                ->orderBy(array_shift($explode), array_pop($explode))
                                ->get();
        }
        if (empty($sortByProduct))
            return 1;
        else
            return view('pages.trangsanpham_sortByProductAjax', compact('sortByProduct'));
    }

    public function sortByProductSub(Request $req){
        // Get the full URL for the previous request
        $id = explode('-', url()->previous());
        $id_sub = array_pop($id);
        $id_sub = base64_decode(base64_decode($id_sub));
        $explode = explode(' ', $req->sortBySub);
        if (empty($req->sortBySub)) {
            $sortByProduct = DB::table('products_category')->where('sub_category_id','=', $id_sub)
                                ->where('is_deleted','=',0)
                                ->where('status_product','!=', -1)
                                ->get();
        }
        else {
            $sortByProduct = DB::table('products_category')->where('sub_category_id','=', $id_sub)
                                ->where('is_deleted','=',0)
                                ->where('status_product','!=', -1)
                                ->orderBy(array_shift($explode), array_pop($explode))
                                ->get();
        }
        if (empty($sortByProduct))
            return 1;
        else
            return view('pages.trangsanpham_sortByProductAjax', compact('sortByProduct'));
    }

    public function sortByProductKeyWord(Request $req){
        // Get the full URL for the previous request
        $getUrlKeyWord = explode('=', url()->previous());
        $getKeyWord = array_pop($getUrlKeyWord);
        $decodeUrlKeyword = urldecode($getKeyWord);
        // dd(($decodeUrlKeyword));
        
        $explode = explode(' ', $req->sortBySub);
        if (empty($req->sortBySub)) {
            $sortByProduct = DB::table('products_category')
                                ->where('name_product','like','%'.$decodeUrlKeyword.'%')
                                ->where('is_deleted','=',0)
                                ->where('status_product','!=', -1)
                                ->orWhere('price_product',$decodeUrlKeyword)
                                ->orWhere('name_shop',$decodeUrlKeyword)
                                ->get();
        }
        else {
            $sortByProduct = DB::table('products_category')
                                ->where('name_product','like','%'.$decodeUrlKeyword.'%')
                                ->where('is_deleted','=',0)
                                ->where('status_product','!=', -1)
                                ->orWhere('price_product',$decodeUrlKeyword)
                                ->orWhere('name_shop',$decodeUrlKeyword)
                                ->orderBy(array_shift($explode), array_pop($explode))
                                ->get();
        }
        // dd($sortByProduct);
        if (empty($sortByProduct))
            return 1;
        else
            return view('pages.trangsanpham_sortByProductAjax', compact('sortByProduct'));
    }
}
