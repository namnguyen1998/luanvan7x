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
use App\Cart;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Session as FacadesSession;

//use Cart;
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
        $data['options']['image']= $product_info->img_product;
    	$data['options']['shop'] = $shop_customer_product->name_shop;
        $content = Cart::content();
    	Cart::add($data);
        

        // Cart::destroy();
    	

     //    echo '<pre>';
    	// var_dump($shop_customer_product);
    	// echo '</pre>';
    	return Redirect::to('/gio-hang');
    }
    public function deleteCart1($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/gio-hang');
    }

    public function addCart(Request $request, $id_product){
        $product_Info = Products::where('id_product',$id_product)->first();
        //$shop_customer_product = DB::table('shop_customer')->where('id_product','=',$id_product)->first();

        if ($product_Info !== null){
            $oldCart = Session::get('Cart') ? Session::get('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCart($product_Info, $id_product);
            $request->session()->put('Cart', $newCart);

            
            //dd(Session::get('Cart'));
        }  
            //print_r(Session::get('shop')->img_shop);
            // dd(Session::get('Cart'));
            echo Session::get('Cart')->totalQuantity;

            return view('pages.cart_ajax');
        
        //print_r(Session::get('shop_name'));  
    }
    public function addCartQuantity(Request $request, $id_product, $quantity){
        $product_Info = Products::where('id_product',$id_product)->first();
        if ($product_Info !== null){
            $oldCart = Session::get('Cart') ? Session::get('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->addCartQuantity($product_Info, $id_product, $quantity);

            $request->session()->put('Cart', $newCart);
            //dd(Session::get('Cart'));
            echo Session::get('Cart')->totalQuantity;
            return view('pages.cart_ajax');
        }    
    }

    // public function deleteCart1(Request $request, $id_product){
    //     $oldCart = Session::get('Cart') ? Session::get('Cart') : null;
    //     $newCart = new Cart($oldCart);
    //     $newCart->deleteCart($id_product);

    //     if(Count($newCart->products) > 0){
    //         $request->Session()->put('Cart', $newCart);
    //     }
    //     else{
    //         $request->Session()->forget('Cart');
    //     }
    //     //return view('pages.giohang1');
    // }   

    public function listItemsCart(){
        //dd(Session::get('Cart'));
        return view ('pages.giohang2');
    }

    public function deleteItemsCart(Request $request, $id_product){
        $oldCart = Session::get('Cart') ? Session::get('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->deleteCart($id_product);

        if (Count($newCart->products) > 0){
            $request->Session()->put('Cart', $newCart);
            return view('pages.cart_ajax');
        }
        else {
            $request->Session()->forget('Cart');
        }
    }   

    public function saveItemsCart(Request $request, $id_product, $quantity){
        $oldCart = Session::get('Cart') ? Session::get('Cart') : null;
        $newCart = new Cart($oldCart);
        $newCart->updateCart($id_product,$quantity);

        $request->Session()->put('Cart', $newCart);
        return view('pages.cart_ajax');
    }

    public function saveAllCart(Request $request){
        foreach ($request->data as $item){
            $oldCart = Session::get('Cart') ? Session::get('Cart') : null;
            $newCart = new Cart($oldCart);
            $newCart->updateCart($item["key"], $item["value"]);
            $request->Session()->put('Cart', $newCart);
        }
       
        // return view('pages.cart_ajax');
    }
    public function checkoutCart(){
        if (!empty(Session::get('Cart'))){
            if (!empty( Session::get('id_customer'))){
                $loadShippingAddrees = DB::table('shipping_address')->where('customer_id', $this->checkUser())->where('status_default', '=', 1)->first();
                return view('pages.checkout_cart', compact('loadShippingAddrees'));
            }
            else {
                Session::put('message', 'Bạn chưa đăng nhập. Vui lòng đăng nhập để tiến hành thanh toán.');
                return redirect('/list-cart');
            }
        }
        else
            return redirect::to('/list-cart');
    }

    public function checkUser(){
        if (Session::get('provider_id')){
            $customer = Customers::where('provider_id',  Session::get('provider_id'))->pluck('id_customer')->first();
            return $customer;
        }
        else
            return Session::get('id_customer');
    }

    public function saveCheckoutCart(Request $req){
        if (empty( Session::get('id_customer'))){
            return redirect('/list-cart');
        }
        else {
            if ($req->totalShip == null){
                Session::put('message', 'Bạn chưa chọn hình thức bạn chuyển. Vui lòng chọn để tiến hành thanh toán.');
                return redirect('/thanh-toan');
            }
            else {
                if (empty($req->_address)){
                    $dataShipping['customer_id'] = $this->checkUser();
                    $dataShipping['name_recipient'] = $req->_name;
                    $dataShipping['phone_recipient'] = $req->_phone;
                    $dataShipping['status_default'] = 1;
                    $dataShipping['address_customer'] = (string)$req->_street . ', ' . $req->_district . ', ' . $req->_city;
                    DB::table('shipping_address')->insert($dataShipping);

                    $addressShipping_id = DB::select("SHOW TABLE STATUS LIKE 'shipping_address'");
                    $dataOrder['address_order'] = $addressShipping_id[0]->Auto_increment -1;
                    $dataOrder['note'] = $req->_note;
                    $dataOrder['shipping_cost'] = $req->totalShip;
                    $dataOrder['price_orders'] = $req->totalTotal;
                    $dataOrder['customer_id'] = $this->checkUser();
                    DB::table('orders')->insert($dataOrder);

                    $order_id = DB::select("SHOW TABLE STATUS LIKE 'orders'");
                    foreach (Session::get('Cart')->products as $product){
                        $dataOrderDetail['orders_id'] = $order_id[0]->Auto_increment -1;
                        $dataOrderDetail['product_id'] = $product['productInfo']->id_product;
                        $dataOrderDetail['quantity'] = $product['quantity'];
                        DB::table('order_detail')->insert($dataOrderDetail);
                    }
                }

                else {
                    $order_id = DB::select("SHOW TABLE STATUS LIKE 'orders'");
                    $dataOrder['address_order'] = $req->_address;
                    $dataOrder['note'] = $req->_note;
                    $dataOrder['shipping_cost'] = $req->totalShip;
                    $dataOrder['price_orders'] = $req->totalTotal;
                    $dataOrder['customer_id'] = $this->checkUser();
                    DB::table('orders')->insert($dataOrder);

                    foreach (Session::get('Cart')->products as $product){
                        $dataOrderDetail['orders_id'] = $order_id[0]->Auto_increment;
                        $dataOrderDetail['product_id'] = $product['productInfo']->id_product;
                        $dataOrderDetail['quantity'] = $product['quantity'];
                        DB::table('order_detail')->insert($dataOrderDetail);
                    }
                }
                Session::forget('Cart');
                Session::forget('message');
                return view('pages.thanks_cart');
            }
        }
    }
}

