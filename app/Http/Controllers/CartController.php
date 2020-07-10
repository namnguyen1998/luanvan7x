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
use Cart;
session_start();


class CartController extends Controller
{
    public function showCart(Request $request){
    	$product_id = $request->productid_hidden;
    	$product_info =Products::find($product_id);
    	return view('pages.giohang');
    }


    public function saveCart(Request $request){
    	$product_id = $request->productid_hidden;
    	$quantity = $request->qty;
    	
        $product_info = Products::where('id_product',$product_id)->first();
    	$shop_customer_product = DB::table('shop_customer')->where('id_product','=',$product_id)->first();

        $data['id']=$product_info->id_product;
        $data['qty']=$quantity;
        $data['name']=$product_info->name_product;
        $data['price']=$product_info->price_product;
        $data['weight']='123';
        $data['options']['image']=$product_info->img_product;
    	$data['options']['shop'] = $shop_customer_product->name_shop;
        $content = Cart::content();
    	Cart::add($data);
        

        // Cart::destroy();
    	

     //    echo '<pre>';
    	// var_dump($shop_customer_product);
    	// echo '</pre>';
    	return Redirect::to('/gio-hang');
    }
    public function deleteCart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/gio-hang');
    }
}

