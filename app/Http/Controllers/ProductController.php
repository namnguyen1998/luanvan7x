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
use App\Products;
use App\SubCategory;
use Hash;
use Illuminate\Contracts\Session\Session as SessionSession;

session_start();
    
class ProductController extends Controller
{
	public function AuthLogin(){
        if(Session::get('id_customer')!=null)
            $customer_id = Session::get('id_customer');
        else
            $customer_id = Session::get('id_shop');
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
        return view('users.seller.banhang_themsanpham')->with('listCategory',$listCategory)->with('listBrand',$listBrand);
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

    public function getBrandCategory(){
        if(isset($_GET['val_id_category'])){
            if($_GET['val_id_category'] == -1)
                echo ' ';
            else{
                $data = $_GET['val_id_category'];
                $listBrand = DB::table('brands')
                    ->where('category_id','like','%'.$data.'%')
                    ->get();
                echo $listBrand;
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
    public function checkShop(){
        if((Session::get('id_shop')!=null)){
            return Session::get('id_shop');
        }
        else
            return Session::get('id_customer');
    }

    public function stringToNumber($string) {
        // return 0 if the string contains no number at all or is not a string:
        if (!is_string($string) || !preg_match('/\d/', $string)) {
            return 0;
        } 
        // Replace all ',' with '.':
        $workingString = str_replace(',', '.', $string);
    
        // Keep only number and '.':
        $workingString = preg_replace("/[^0-9.]+/", "", $workingString);
    
        // Split the integer part and the decimal part,
        // (and eventually a third part if there are more 
        //     than 1 decimal delimiter in the string):
        $explodedString = explode('.', $workingString, 5);
    
        if ($explodedString[0] === '') {
            // No number was present before the first decimal delimiter, 
            // so we assume it was meant to be a 0:
            $explodedString[0] = '0';
        } 

        if (sizeof($explodedString) === 1) 
            $workingString = $explodedString[0];
        
        elseif (sizeof($explodedString) === 2)
            $workingString = $explodedString[0] .  $explodedString[1];
        
        elseif (sizeof($explodedString) === 3)
            $workingString = $explodedString[0] .  $explodedString[1] . $explodedString[2];

        elseif (sizeof($explodedString) === 4)
            $workingString = $explodedString[0] .  $explodedString[1] . $explodedString[2] . $explodedString[3];

        else 
            $workingString = $explodedString[0] .  $explodedString[1] . $explodedString[2] . $explodedString[3] . $explodedString[4];
        

        // Create a number from this now non-ambiguous string:
        $number = $workingString * 1;
    
        return $number;
    }

    public function saveProduct(Request $req){
        $this->validate($req, 
        [
            // 'nameProduct' => 'required|unique:products,name_product',
            //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
            'img_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img1_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img2_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img3_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            // 'nameProduct.required' => 'Tên sản phẩm đã tồn tại. Vui lòng chọn tên khác',
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

        if (empty($req->nameProduct) || empty($req->madeby) || empty($req->price) || empty($req->description)){
            Session::put('message', 'Bạn chưa điền đầy đủ thông tin. Vui lòng kiểm tra lại <strong> "Danh mục", "Thương hiệu", "Tên SP", "Nơi SX", "Giá", "Mô tả", "Hình 1".</strong>');
            return Redirect::to('/them-san-pham');
        }
        else {
            $dataProduct = array();
            $dataProduct['name_product'] = $req->nameProduct;
            $dataProduct['madeby'] = $req->madeby;
            $dataProduct['sub_category_id'] = $req->_id_sub_category;
            $dataProduct['brand_id'] = $req->_id_brand;
            $dataProduct['shop_id'] = Session::get('id_shop');
            $dataProduct['img_product'] = $this->setNameImage($req->img_product);
            $dataProduct['img1_product'] = $this->setNameImage($req->img1_product);
            $dataProduct['img2_product'] = $this->setNameImage($req->img2_product);
            $dataProduct['img3_product'] = $this->setNameImage($req->img3_product);
            $dataProduct['note_product'] = $req->note;
            $dataProduct['description_product'] = $req->description;
            $dataProduct['price_product'] = $this->stringToNumber($req->price);
            
            // dd($dataProduct);
            DB::table('products')->insert($dataProduct);

            return Redirect::to('/san-pham-cho-duyet');
        }
    }
    public function getProductPending(){
        $this->AuthLogin();
        $listProductsPending = DB::table('products_category')->where('shop_id','=',Session::get('id_shop'))
        ->where('is_deleted','=',0)->paginate(6);
        return view('users.seller.banhang_sanphamchoduyet',compact('listProductsPending'));
    }

    public function getListProduct(){
        $this->AuthLogin();
        $listProducts = DB::table('products_category')->where('shop_id','=',Session::get('id_shop'))
        ->where('is_deleted','=',0)->orderBy('id_product','DESC')->paginate(6);
        return view('users.seller.banhang_danhsachsanpham',compact('listProducts'));
    }

    public function getUpdateProduct($id_product){
        $this->AuthLogin();
        $listCategory = Category::all();
        $listBrand = Brands::all();
        $productEdit = Products::where('id_product','=',$id_product)
                                ->where('shop_id','=',Session::get('id_shop'))
                                ->join('sub_category','id_sub','=','sub_category_id')
                                ->get();
        $listSub = SubCategory::where('category_id', $productEdit[0]->category_id )->get();
        //dd($listSub);
        return view('users.seller.banhang_editsanpham', compact('productEdit','listCategory','listBrand', 'listSub'));
    }

    public function updateProduct(Request $req,$id_product){
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
        if (empty($req->nameProduct) || empty($req->madeby) || empty($req->price) || empty($req->description)){
            Session::put('message', 'Bạn chưa điền đầy đủ thông tin. Vui lòng kiểm tra lại <strong> "Danh mục", "Thương hiệu", "Tên SP", "Nơi SX", "Giá", "Mô tả", "Hình 1".</strong>');
            return Redirect::to('/them-san-pham');
        }
        else {
            $dataProduct = array();
            $dataProduct['name_product'] = $req->nameProduct;
            $dataProduct['madeby'] = $req->madeby;
            $dataProduct['sub_category_id'] = $req->_id_sub_category;
            $dataProduct['brand_id'] = $req->_id_brand;
            $dataProduct['shop_id'] = Session::get('id_shop');
            $dataProduct['img_product'] = $this->setNameImage($req->img_product);
            $dataProduct['img1_product'] = $this->setNameImage($req->img1_product);
            $dataProduct['img2_product'] = $this->setNameImage($req->img2_product);
            $dataProduct['img3_product'] = $this->setNameImage($req->img3_product);
            $dataProduct['note_product'] = $req->note;
            $dataProduct['description_product'] = $req->description;
            $dataProduct['price_product'] = $this->stringToNumber($req->price);
            
            dd($dataProduct);
            DB::table('products')->where('id_product','=', $id_product)->update($dataProduct);

            return Redirect::to('/san-pham-cho-duyet');
        }
    }
    public function deleteProduct(Request $request,$id_product){
        $dataProduct = array();
        $dataProduct['is_deleted'] = 1;
        DB::table('products')->where('id_product','=',$id_product)->update($dataProduct);
        return Redirect::to('/list-san-pham');   

    }

}
