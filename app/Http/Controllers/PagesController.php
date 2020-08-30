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
use App\SubCategory;

session_start();

class PagesController extends Controller
{

    public function getTraCes(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) 
            $IP = $_SERVER['HTTP_CLIENT_IP'];
         elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) 
            $IP = $_SERVER['HTTP_X_FORWARDED_FOR'];
         else 
            $IP = $_SERVER['REMOTE_ADDR'];
        return $IP ;
    }

    public function insertTracesClient(Request $req){
        $url = explode('/', $req->id);
        $getID = array_pop($url);
        $id = base64_decode(base64_decode($getID));
        $getIPAddress = DB::table('traces')->where('mac_address', $this->getTraCes())->first();
        if (empty($getIPAddress)) {
            $dataTraves['mac_address'] = $this->getTraCes();
            $dataTraves['data_traces'] = json_encode( array($id) );
            DB::table('traces')->insert( $dataTraves );
            return 1;
        }
        else {
            $arrayDataTraces = json_decode( $getIPAddress->data_traces );
            if ( count($arrayDataTraces) < 10 ) 
                 array_push ($arrayDataTraces, $id);
            else {
                $arrayDataTracesTemps = array_shift($arrayDataTraces);
                array_push ($arrayDataTraces, $id);
            }

            DB::table('traces')->where('mac_address', $this->getTraCes())->update([ 'data_traces' => $arrayDataTraces ]);
            return $arrayDataTraces;
        }
        return 0;
    }

	public function getIndex(){

        // Traces Product Client
        $getIPAddress = DB::table('traces')->where('mac_address', $this->getTraCes())->first();
        if (!empty($getIPAddress)){
            $getDataTraces = json_decode($getIPAddress->data_traces);

            // List Scan Product Client
            $getScanProductClient5 = Products::whereIn('id_product', $getDataTraces)->offset(0)->limit(5)->get();
            $getScanProductClient10 = Products::whereIn('id_product', $getDataTraces)->offset(5)->limit(5)->get();

            // List Ralated Product
            $getSub_id = Products::where('id_product', array_pop($getDataTraces))->pluck('sub_category_id');
            $listProductsRelated5 = Products::where('is_deleted','=',0)->where('status_product','>', 0)
                        ->orderby('id_product','desc')
                        ->where('sub_category_id', $getSub_id[0])
                        ->offset(0)->limit(5)->get();

            $listProductsRelated10 = Products::where('is_deleted','=',0)->where('status_product','>', 0)
                        ->orderby('id_product','desc')
                        ->where('sub_category_id', $getSub_id[0])
                        ->offset(5)->limit(5)->get();

        }
        else {
            $getScanProductClient5 = null;
            $getScanProductClient10 = null;
            $getSub = SubCategory::get()->random(1);
            // dd($getSub[0]->id_sub);
            $listProductsRelated5 = Products::where('is_deleted','=',0)->where('status_product','>', 0)
                        ->orderby('id_product','desc')
                        ->where('sub_category_id', $getSub[0]->id_sub)
                        ->offset(0)->limit(5)->get();

            $listProductsRelated10 = Products::where('is_deleted','=',0)->where('status_product','>', 0)
                        ->orderby('id_product','desc')
                        ->where('sub_category_id', $getSub[0]->id_sub)
                        ->offset(5)->limit(5)->get();
        }

        // List Category
        $Category = Category::all();

        // List Product
        $listProducts = Products::where('is_deleted','=',0)->where('status_product','>', 0)->orderby('id_product','desc')->paginate(12);

        // List Top Product
        $listTopProduct5 = Products::join('order_detail', 'order_detail.product_id', '=', 'products.id_product')
                                    ->where('is_deleted','=',0)
                                    ->where('status_product','>', 0)
                                    ->leftjoin('orders', 'orders.id_orders', '=', 'order_detail.orders_id')
                                    ->groupBy('id_product')
                                    ->orderBy('topProduct', 'DESC')
                                    ->select('name_product', 'price_product', 'img_product', 'id_product')
                                    ->addSelect(DB::raw('COUNT(id_orders) as topProduct'))
                                    ->offset(0)->limit(5)->get();
        $listTopProduct10 = Products::join('order_detail', 'order_detail.product_id', '=', 'products.id_product')
                                    ->where('is_deleted','=',0)                            
                                    ->where('status_product','>', 0)
                                    ->leftjoin('orders', 'orders.id_orders', '=', 'order_detail.orders_id')
                                    ->groupBy('id_product')
                                    ->orderBy('topProduct', 'DESC')
                                    ->select('name_product', 'price_product', 'img_product', 'id_product')
                                    ->addSelect(DB::raw('COUNT(id_orders) as topProduct'))
                                    ->offset(5)->limit(5)->get();
        
        // List New Product
        $listNewProduct5 = Products::orderBy('id_product', 'DESC')->where('is_deleted','=',0)                            
                                    ->where('status_product','>', 0)
                                    ->offset(0)->limit(5)->get();
        $listNewProduct10 = Products::orderBy('id_product', 'DESC')->where('is_deleted','=',0)                            
                                    ->where('status_product','>', 0)
                                    ->offset(5)->limit(5)->get();
        Session::forget('keySearch');
        return view('pages.home',compact('Category','listProducts', 'listTopProduct5', 'listTopProduct10' ,'listNewProduct5',
         'listNewProduct10', 'listProductsRelated5', 'listProductsRelated10', 'getScanProductClient5', 'getScanProductClient10'));
    }
    
    public function getPagesProductCategory($id_category){
    	$productCategory = DB::table('products_category')->where('category_id','=', base64_decode(base64_decode($id_category)))
                            ->where('is_deleted','=',0)
                            ->where('status_product','>', 0)
                            ->paginate(9);
        $subCategorybyCategory = DB::table('sub_category')->join('category','id_category','=','category_id')
                            ->where('category_id','=', base64_decode(base64_decode($id_category)))
                            ->get();
        $loadBrand = Brands::where('category_id', base64_decode(base64_decode($id_category)))->get();
        // dd($subCategorybyCategory);
    	return view('pages.trangsanpham',compact('productCategory','subCategorybyCategory', 'loadBrand'));
    }

    public function getPagesProductDetail($id_product){
        // Session::forget('keySearch');
        $productByID = DB::table('products')
                                ->join('shop','id_shop','=','shop_id')
                                ->where('is_deleted','=',0)

                                ->where('status_product','>', 0)
                                ->where('id_product','=', base64_decode(base64_decode($id_product)))->get();


        //dd($productByID);
        if(empty(count($productByID))){
            return view('pages.404');
        }
        else{
            foreach ($productByID as $key => $value){
            $sub_category = $value->sub_category_id;
        }
        $productsRalated = DB::table('products')->where('sub_category_id','=',$sub_category)
                                ->where('is_deleted','=',0)
                                ->inRandomOrder()->limit(4)->get();
        $listComments = DB::table('comment')->join('customers','id_customer','=','customer_id')
                                ->select('customers.name_customer', 'comment.created_at', 'comment.content')
                                ->orderBy('created_at', 'DESC')
                                ->where('product_id','=', base64_decode(base64_decode($id_product)))
                                ->get();
        //dd($productsRalated);
        //print_r($sub_category);                  
        return view('pages.chitietsanpham',compact('productByID','productsRalated','listComments'));
        }
    }

    public function getProductsSubCategory($id_category, $id_sub){
        Session::forget('keySearch');
        $subCategorybyCategory = DB::table('sub_category')->join('category','id_category','=','category_id')
        ->where('category_id','=', base64_decode(base64_decode($id_category)))
        ->get();
        
        $products_sub = Products::where('sub_category_id','=', base64_decode(base64_decode($id_sub)))->where('is_deleted','=',0)->paginate(9);
        return view('pages.sanpham_sub',compact('subCategorybyCategory','products_sub'));
        
    }
    public function getSearch(Request $request){
        $keySearch = $request->keySearch;
        $productSearch = DB::table('products_category')
                    ->where('name_product','like','%'.$keySearch.'%')
                    ->where('is_deleted','=',0)
                    ->where('status_product','>', 0)
                    ->orWhere('price_product','like','%'.$keySearch.'%')
                    ->orWhere('name_shop','like','%'.$keySearch.'%')
                    ->orWhere('name_sub','like','%'.$keySearch.'%')
                    ->get();
        $shopSearch =  DB::table('shop')
                    ->where('name_shop','like','%'.$keySearch.'%')
                    ->groupBy('name_shop')
                    ->get();
        // if(!empty($productSearch)){
        //     Session::put('keySearch',$keySearch);
        // }
        return view('pages.search', compact('productSearch','shopSearch'));
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
                                ->where('status_product','>', 0)
                                ->get();
        }
        else {
            $sortByProduct = DB::table('products_category')->where('category_id','=',$id_category)
                                ->where('is_deleted','=',0)
                                ->where('status_product','>', 0)
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
                                ->where('status_product','>', 0)
                                ->get();
        }
        else {
            $sortByProduct = DB::table('products_category')->where('sub_category_id','=', $id_sub)
                                ->where('is_deleted','=',0)
                                ->where('status_product','>', 0)
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
                                ->where('status_product','>', 0)
                                ->orWhere('price_product','like','%'.$decodeUrlKeyword.'%')
                                ->orWhere('name_shop','like','%'.$decodeUrlKeyword.'%')
                                ->orWhere('name_sub','like','%'.$decodeUrlKeyword.'%')
                                ->get();
        }
        else {
            $sortByProduct = DB::table('products_category')
                                ->where('name_product','like','%'.$decodeUrlKeyword.'%')
                                ->where('is_deleted','=',0)
                                ->where('status_product','>', 0)
                                ->orWhere('price_product','like','%'.$decodeUrlKeyword.'%')
                                ->orWhere('name_shop','like','%'.$decodeUrlKeyword.'%')
                                ->orWhere('name_sub','like','%'.$decodeUrlKeyword.'%')
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
