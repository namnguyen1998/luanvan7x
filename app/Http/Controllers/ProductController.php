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
use Hash;
session_start();

class ProductController extends Controller
{
	public function AuthLogin(){
        $customer_id = Session::get('id_customer');
        if($customer_id){
            return Redirect::to('banhang');
        }else{
            return Redirect::to('/')->send();
        }
    }

    public function getAddProduct(){
        $this->AuthLogin();
        $listCategory = Category::all();
        $listBrand = Brands::all();
        // $provider_id =  Session::get('id_customer');
        
        //var_dump($listCategory);
        return view('users.banhang_quanlysanpham')->with('listCategory',$listCategory)->with('listBrand',$listBrand);
    }
    
     public function getSubCategory(){
        if(isset($_GET['val_id_category'])){
            if($_GET['val_id_category'] == -1)
                echo ' ';
            else{
                $data = $_GET['val_id_category'];
                $listSub = DB::table('sub_category')
                ->where('category_id','like','%'.$data.'%')
                ->get();
                echo $listSub;
            }
        }
    }

    public function setNameImage($data){
        if(empty($data)){
            return null;
        }
        else{
            $getNameImage = current(explode('.', $data->getClientOriginalName()));
            $destinationPath = 'public/frontend/img/product';
            $date = date('dmY');
            $hash = md5($getNameImage);
            $plus = $date . '_' . $hash . '.jpg';
            $data->move($destinationPath, $plus);
            return $plus;
        }
    }

    public function checkUser(){
        if((Session::get('provider_id'))){
            $customer = Customers::where('provider_id',  Session::get('provider_id'))->first();
            return $customer->id_customer;
        }
        else
            return Session::get('id_customer');
    }

    public function saveProduct(Request $req){
        $this->validate($req, 
        [
            //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
            'img_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img1_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img2_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img3_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            //Tùy chỉnh hiển thị thông báo không thõa điều kiện
            'img_product.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'img_product.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
            'img1_product.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'im1g_product.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
            'img2_product.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'img2_product.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
            'img3_product.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'img3_product.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
        ]);

        
        $dataProduct = array();
        $dataProduct['name_product'] = $req->nameProduct;
        $dataProduct['madeby'] = $req->madeby;
        $dataProduct['sub_category_id'] = $req->_id_sub_category;
        $dataProduct['brand_id'] = $req->_id_brand;
        $dataProduct['customer_id'] = $this->checkUser();
        $dataProduct['img_product'] = $this->setNameImage($req->img_product);
        $dataProduct['img1_product'] = $this->setNameImage($req->img1_product);
        $dataProduct['img2_product'] = $this->setNameImage($req->img2_product);
        $dataProduct['img3_product'] = $this->setNameImage($req->img3_product);
        $dataProduct['note_product'] = $req->note;
        $dataProduct['description_product'] = $req->description;
        $dataProduct['price_product'] = $req->price;

        // dd($dataProduct);
        DB::table('products')->insert($dataProduct);

        return Redirect::to('/banhang');
    }
}
