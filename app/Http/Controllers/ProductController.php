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
        $id_shop = Session::get('id_shop');
        if($id_shop){
            return Redirect::to('/dashboard');
        }else{
            return Redirect::to('/banhang')->send();
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
        // echo $_GET['val_id_category'];
        if(!empty($_GET['val_id_category'])){
            if($_GET['val_id_category'] == -1)
                echo ' ';
            else{
                $data = $_GET['val_id_category'];
                $listSub = SubCategory::
                    where('category_id',$data)
                    ->get();
                echo ($listSub);
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
        $this->AuthLogin();
        $this->validate($req, 
        [   
            'madeby' => 'required',
            'price' => 'required',
            'description' => 'required',
            'nameProduct' => 'required|unique:products,name_product',
            //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
            'img_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img1_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img2_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img3_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'nameProduct.required' => 'Vui lòng nhập tên sản phẩm',
            'nameProduct.unique' => 'Tên sản phẩm đã tồn tại. Vui lòng chọn tên khác',
            'price.required' => 'Vui lòng nhập giá sản phẩm',
            'description.required' => 'Vui lòng nhập mô tả',
            'nameProduct' => 'Vui lòng nhập tên sản phẩm',
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

            return Redirect::to('/list-san-pham');
        
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
        ->where('is_deleted','=',0)->orderBy('created_at','DESC')->paginate(6);
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
        $loadSubEdit = SubCategory::where('category_id', $productEdit[0]->category_id )->get();
        //dd($loadSubEdit);
        return view('users.seller.banhang_editsanpham', compact('productEdit','listCategory','listBrand', 'loadSubEdit'));
    }

    public function updateProduct(Request $req,$id_product){
        $this->validate($req, 
        [
            //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
            
            'img_product' => 'required',
            'img_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img1_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img2_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'img3_product' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            
            //Tùy chỉnh hiển thị thông báo không thõa điều kiện
            
            'img_product.required' => 'Ko có dữ liệu',
            'img_product.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'img_product.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
            'img1_product.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'im1g_product.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
            'img2_product.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'img2_product.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
            'img3_product.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'img3_product.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
        ]);
        
        
            $productEdit = Products::find($id_product);
            $productEdit->shop_id = Session::get('id_shop');
            $productEdit->status_product = $productEdit->status_product;
            // if(($req->img1_product)!=null){
            //     $productEdit->img1_product = $this->setNameImage($req->img1_product);
            // }            
            // else $productEdit->img_product = '';

            // if(($req->img2_product)!=null){
            //     $productEdit->img2_product = $this->setNameImage($req->img2_product);
            // }            
            // else $productEdit->img2_product = '';
            if(!empty($req->nameProduct)){
                $productEdit->name_product = $req->nameProduct;
            }else{
                 $productEdit->name_product = $productEdit->name_product;
            }
            if(!empty($req->madeby)){
                $productEdit->madeby = $req->madeby;
            }else{
                 $productEdit->madeby = $productEdit->madeby;
            }
            if(!empty($req->_id_sub_category)){
                $productEdit->sub_category_id = $req->_id_sub_category;
            }else{
                 $productEdit->sub_category_id = $productEdit->sub_category_id;
            }
            if(!empty($req->_id_brand)){
                $productEdit->brand_id = $req->_id_brand;
            }else{
                 $productEdit->brand_id = $productEdit->brand_id;
            }
            if(!empty($req->img_product)){
                $productEdit->img_product = $this->setNameImage($req->img_product);
            }else{
                 $productEdit->img_product = $productEdit->img_product;
            }
            if(!empty($req->img1_product)){
                $productEdit->img1_product = $this->setNameImage($req->img1_product);
            }else{
                $productEdit->img1_product = $productEdit->img1_product;
            }
            if(!empty($req->img2_product)){
                $productEdit->img2_product = $this->setNameImage($req->img2_product);
            }else{
                 $productEdit->img2_product = $productEdit->img2_product;
            }
            if(!empty($req->img3_product)){
                $productEdit->img3_product = $this->setNameImage($req->img3_product);
            }else{
                 $productEdit->img3_product = $productEdit->img3_product;
            }
            if(!empty($req->description_product)){
                $productEdit->description_product = $req->description_product;
            }else{
                 $productEdit->description_product = $productEdit->description_product;
            }
            if(!empty($req->price)){
                $productEdit->price_product = $this->stringToNumber($req->price);
            }else{
                 $productEdit->price_product = $this->stringToNumber($productEdit->price_product);
            }
            if(!empty($req->note)){
                $productEdit->note_product = $req->note;
            }else{
                 $productEdit->note_product = $productEdit->note_product;
            }
            $productEdit->save();
            return Redirect::to('/list-san-pham')->with('notification','Cập nhật thành công!!');
        
    }
    public function deleteProduct(Request $request,$id_product){
        $dataProduct = array();
        $dataProduct['is_deleted'] = 1;
        DB::table('products')->where('id_product','=',$id_product)->update($dataProduct);
        return Redirect::to('/list-san-pham');   

    }

}
