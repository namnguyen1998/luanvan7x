<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\Category;
use App\Brands;
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
        $listBrand = Brands::all();
        //var_dump($listCategory);
    	return view('admin.admin_addproduct')->with('listCategory',$listCategory)->with('listBrand',$listBrand);

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

    public function checkImage($data){
        $arr=array("jpg","jpeg","png","gif");
        $file_image = explode('.', $data);
        $file = end($file_image);
        if(empty($file))
            return null;
        else{
            foreach($arr as $key=>$value){
                if(strcmp($value, $file) == 0)
                    return 1;
            }
            return 0;
        }
    }

    public function setNameImage($data){
        if(empty($data))
            return null;
        else{
            if($this->checkImage($data) == 1){
                $name_image = current(explode('.', $data));
                $file_image = explode('.', $data);
                $file = end($file_image);
                $date = date('dmY');
                $hash = md5($name_image);
                $plus = $date . '_' . $hash . '.' .$file;
                // $data->move('public/frontend/images/product',$plus);
                return $plus;
            }
        }
    }

    public function saveProduct(Request $req){
        
        $get_image = $req->file('img_product');
        // NOTE: em dùng "$get_image = $req->file('img_product');" thì nó trả về Null, fix dùm em cái này với :3
        
        $dataProduct = array();
        $dataProduct['name_product'] = $req->nameProduct;
        $dataProduct['madeby'] = $req->madebay;
        $dataProduct['category_id'] = $req->_id_category;
        $dataProduct['sub_category_id'] = $req->_id_sub_category;
        $dataProduct['brand_id'] = $req->_id_brand;
        $dataProduct['users_id'] = Session::get('id_users');
        $dataProduct['img_product'] = $this->setNameImage($req->img_product);
        $dataProduct['img1_product'] = $this->setNameImage($get_image);
        $dataProduct['img2_product'] = $this->setNameImage($req->img2_product);
        $dataProduct['img3_product'] = $this->setNameImage($req->img3_product);
        $dataProduct['note_product'] = $req->note;
        $dataProduct['description_product'] = $req->description;
        $dataProduct['price_product'] = $req->price;

        dd($dataProduct);
        
    }
    
}
