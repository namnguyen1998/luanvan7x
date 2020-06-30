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
        $customer = Customers::all()->first();
        Session::put('customer_id_db', $customer->id_customer);
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
        $dataProduct = array();
        $dataProduct['name_product'] = $req->nameProduct;
        $dataProduct['madeby'] = $req->madeby;
        $dataProduct['sub_category_id'] = $req->_id_sub_category;
        $dataProduct['brand_id'] = $req->_id_brand;
        $dataProduct['customer_id'] = Session::get('customer_id_db');
         $getimage = '';
                if($req->hasFile('img_product'))
                {
                    //Hàm kiểm tra dữ liệu
                    $this->validate($req, 
                        [
                            //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
                            'image' => 'mimes:jpg,jpeg,png,gif|max:2048',
                        ],          
                        [
                            //Tùy chỉnh hiển thị thông báo không thõa điều kiện
                            'image.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
                            'image.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
                        ]
                    );
                    
                  
                    $image = $req->file('img_product');
                    $getimage = $image->getClientOriginalName();//echo $getimage;
                    $destinationPath = 'public/petmart/images/';//var_dump( $destinationPath);
                    $image->move($destinationPath, $getimage);
                }    
        $dataProduct['img_product'] = $getimage;
        
        // $dataProduct['img1_product'] = $this->setNameImage($req->img1_product);
        // $dataProduct['img2_product'] = $this->setNameImage($req->img2_product);
        // $dataProduct['img3_product'] = $this->setNameImage($req->img3_product);
        $dataProduct['note_product'] = $req->note;
        $dataProduct['description_product'] = $req->description;
        $dataProduct['price_product'] = $req->price;

        
        DB::table('products')->insert($dataProduct);

        return Redirect::to('/banhang');

        // dd($dataProduct);

        
        
    }
}
