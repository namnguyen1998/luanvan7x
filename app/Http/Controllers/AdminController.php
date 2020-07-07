<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users;
use App\Category;
use App\Brands;
use App\SubCategory;
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
        if(empty($data)){
            return null;
        }
        else{
            $getNameImage = current(explode('.', $data->getClientOriginalName()));
            $destinationPath = 'public/frontend/img/categories';
            $date = date('dmY');
            $hash = md5($getNameImage);
            $plus = $date . '_' . $hash . '.jpg';
            $data->move($destinationPath, $plus);
            return $plus;
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


    public function dashboard(){
        return view('admin.admin_dashboard');
    }
    public function listProductsPending(){
        $listProductsPendingAdmin = DB::table('products_category')
        ->where('status_product','=',0)->where('is_deleted','=',0)->get();

        return view('admin.admin_duyetsanpham',compact('listProductsPendingAdmin'));
    }
    public function listProductsApprove(){
        $listProductsApprove = DB::table('products_category')->get();

        return view('admin.admin_listsanpham',compact('listProductsApprove'));
    }

    public function listCategory(){
        $listCategory = Category::all();
        return view('admin.admin_listcategory', compact('listCategory'));
    }

    public function addCategory(){
        return view('admin.admin_addcategory');
    }

    public function saveCategory(Request $req){
        $this->validate($req, 
        [
            //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
            'imgCategory' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            //Tùy chỉnh hiển thị thông báo không thõa điều kiện
            'imgCategory.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'imgCategory.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
        ]);
        $dataCategory = array();
        $dataCategory['name_category'] = $req->nameCategory;
        $dataCategory['img_category'] = $this->setNameImage($req->imgCategory);
        DB::table('category')->insert($dataCategory);
        // dd($dataCategory);

        return redirect::to('/admin-danh-sach-danh-muc');
    }

    public function editCategory($id_category){
        $id_category = DB::table('category')->where('id_category', $id_category)->get();
        return view('admin.admin_editcategory', compact('id_category'));
    }

    public function updateCategory(Request $req, $id_category){
        $this->validate($req, 
        [
            //Kiểm tra đúng file đuôi .jpg,.jpeg,.png.gif và dung lượng không quá 2M
            'imgCategory' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            //Tùy chỉnh hiển thị thông báo không thõa điều kiện
            'imgCategory.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'imgCategory.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
        ]);
        $dataCategory = array();
        $dataCategory['name_category'] = $req->nameCategory;
        if (!empty($req->imgCategory))
            $dataCategory['img_category'] = $this->setNameImage($req->imgCategory);
        else {
            $id_category = DB::table('category')->where('id_category', $id_category)->pluck('img_category');
            $dataCategory['img_category'] = $id_category;
        }
        // dd($dataCategory);
        DB::table('category')->where('id_category',$id_category)->update($dataCategory);
        return redirect::to('/admin-danh-sach-danh-muc');
    }

    public function listSub(){
        $listSub = DB::table('sub_category')
                    ->select('sub_category.id_sub', 'sub_category.name_sub', 'category.name_category')
                    ->join('category', 'category.id_category', '=', 'sub_category.category_id')
                    ->get();
                    
        return view('admin.admin_listsub', compact('listSub'));
    }

    public function addSub(){
        $listCategory = Category::all();
        return view('admin.admin_addsub', compact('listCategory'));
    }

    public function saveSub(Request $req){
        $dataSub = array();
        $dataSub['name_sub'] = $req->nameSub;
        $dataSub['category_id'] = $req->categorySub;

        DB::table('sub_category')->insert($dataSub);
        return redirect::to('/admin-danh-sach-danh-muc-con');
    }

    public function editSub($id_sub){
        $id_sub = DB::table('sub_category')
                    ->join('category', 'category.id_category', '=', 'sub_category.category_id')
                    ->where('id_sub', $id_sub)
                    ->select('sub_category.id_sub', 'sub_category.category_id', 'sub_category.name_sub', 'category.name_category')
                    ->get();
        $listCategory = Category::all();
        return view('admin.admin_editsub', compact('id_sub', 'listCategory'));
    }

    public function updateSub(Request $req, $id_sub){
        
        $dataSub = array();
        $dataSub['name_sub'] = $req->nameSub;
        $dataSub['category_id'] = $req->categorySub;

        // dd($dataSub);
        DB::table('sub_category')->where('id_sub',$id_sub)->update($dataSub);
        return redirect::to('/admin-danh-sach-danh-muc-con');
    }
}
