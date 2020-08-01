<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DateTimeZone;
use App\Users;
use App\Category;
use App\Brands;
use App\SubCategory;
use App\Products;
use App\Orders;
use DataTables;
use DB;

use Session;
use Illuminate\Support\Facades\Redirect;
session_start();

class AdminController extends Controller
{
    // Login
    public function AuthAdmin(){
        if (empty(Session::get('id_users')))
            return redirect::to('/admin')->send();
    }
    
    public function logOutAdmin(){
        $this->AuthAdmin();
        Session::forget('id_users');
        Session::forget('email_user');
        Session::forget('username_user');
        Session::forget('role_id');
        Session::forget('message');
        Session::forget('res_name_user');
        Session::forget('res_username_user');
        Session::forget('res_email_user');
        Session::forget('res_phone_user');
        return redirect::to('/admin');
    }

    public function getLoginAdmin(){
        if(!empty(Session::get('id_users')))
            $this->logOutAdmin();
    	return view('admin.admin_login');
    }

    public function postLoginAdmin(Request $request){
        $result = Users::where('email_user', $request->_username_user)
                        ->orWhere('username_user', $request->_username_user)
                        ->where('password_user', md5(sha1($request->_password_user)))
                        ->first();
        if($result){
            Session::put('id_users',$result->id_users);
            Session::put('username_user',$result->username_user);
            Session::put('email_user',$result->email_user);
            Session::put('role_id', $result->role_id);
            return redirect::to('/admin-dashboard');
        }
        else
            return redirect::to('/admin');
    }

    public function showDashboard(){
            $this->AuthAdmin();
        return view('admin.admin_dashboard');
    }

    // Products
    public function listProduct(){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $listProductsPending = DB::table('products_category')->where('status_product', '=', 1)->get();
        return view('admin.admin_listproduct',compact('listProductsPending'));
    }

    public function listProductPending(Request $request){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        if ($request->ajax()) {
            $data = DB::table('products')
                        ->join('brands', 'brands.id_brand', '=', 'products.brand_id')
                        ->join('shop', 'products.shop_id', '=', 'shop.id_shop')
                        ->where('products.status_product', '!=', 1)
                        ->select('products.id_product', 'products.name_product', 'products.price_product', 'products.madeby', 'products.created_at', 'products.status_product', 'shop.name_shop', 'brands.name_brand')
                        ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id_product.'" data-toggle="tooltip" id="edit-agree"><span class=" btn btn-outline-success icon-like" title="Đồng ý"></span></a>';
                    $btn = $btn.' <a href="javascript:void(0)" data-id="'.$row->id_product.'" data-toggle="tooltip" id="edit-refuse"><span  class="btn btn-outline-danger icon-dislike" title="Từ chối"></span></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        
        return view('admin.admin_listproductpending');
    }

    public function editAgree(Request $request){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $dataProduct['status_product'] = 1;
        DB::table('products')->where('id_product',$request->id_product)->update($dataProduct);      
        return response()->json(['success'=>'Product saved successfully.']);
    }

    public function editRefuse(Request $request){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $dataProduct['status_product'] = -1;
        DB::table('products')->where('id_product',$request->id_product)->update($dataProduct);      
        return response()->json(['success'=>'Product saved successfully.']);
    }

    // Categories
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
    
    public function listCategory(){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $listCategory = Category::all();
        return view('admin.admin_listcategory', compact('listCategory'));
    }

    public function addCategory(){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        return view('admin.admin_addcategory');
    }

    public function saveCategory(Request $req){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $this->validate($req, 
        [
            'imgCategory' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'imgCategory.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'imgCategory.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
        ]);
        if (empty($req->nameCategory) || empty($req->imgCategory)){
            Session::put('message', 'Bạn chưa điền đầy đủ thông tin. Vui lòng kiểm tra lại.');
            return redirect::to('/admin-them-danh-muc');
        }
        else {
            $dataCategory['name_category'] = $req->nameCategory;
            $dataCategory['img_category'] = $this->setNameImage($req->imgCategory);
            DB::table('category')->insert($dataCategory);
            Session::put('message', 'Thêm thành công.');
            return redirect::to('/admin-danh-sach-danh-muc');
        }
    }

    public function editCategory($id_category){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $id_category = DB::table('category')->where('id_category', $id_category)->get();
        return view('admin.admin_editcategory', compact('id_category'));
    }

    public function updateCategory(Request $req, $id_category){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $this->validate($req, 
        [
            'imgCategory' => 'mimes:jpg,jpeg,png,gif|max:2048',
        ], [
            'imgCategory.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'imgCategory.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',
        ]);
        if (empty($req->nameCategory) || empty($req->imgCategory)){
            Session::put('message', 'Bạn chưa điền đầy đủ thông tin. Vui lòng kiểm tra lại.');
            return redirect::to('/admin-sua-danh-muc/'.$id_category);
        }
        else {
            $dataCategory['name_category'] = $req->nameCategory;
            if (!empty($req->imgCategory))
                $dataCategory['img_category'] = $this->setNameImage($req->imgCategory);
            else {
                $id_category = DB::table('category')->where('id_category', $id_category)->pluck('img_category');
                $dataCategory['img_category'] = $id_category;
            }
            DB::table('category')->where('id_category',$id_category)->update($dataCategory);
            Session::put('message', 'Cập nhật thành công.');
            return redirect::to('/admin-danh-sach-danh-muc');
        }
        
    }

    // Sub Categories
    public function listSub(){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $listSub = DB::table('sub_category')
                    ->select('sub_category.id_sub', 'sub_category.name_sub', 'category.name_category')
                    ->join('category', 'category.id_category', '=', 'sub_category.category_id')
                    ->get();
        return view('admin.admin_listsub', compact('listSub'));
    }

    public function addSub(){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $listCategory = Category::all();
        return view('admin.admin_addsub', compact('listCategory'));
    }

    public function saveSub(Request $req){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        if (empty($req->nameSub) || empty($req->categorySub)){
            Session::put('message', 'Bạn chưa điền đầy đủ thông tin. Vui lòng kiểm tra lại.');
            return redirect::to('/admin-them-danh-muc-con');
        }
        else {
            $dataSub['name_sub'] = $req->nameSub;
            $dataSub['category_id'] = $req->categorySub;
            DB::table('sub_category')->insert($dataSub);
            Session::put('message', 'Thêm thành công.');
            return redirect::to('/admin-danh-sach-danh-muc-con');
        }
    }

    public function editSub($id_sub){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $id_sub = DB::table('sub_category')
                    ->join('category', 'category.id_category', '=', 'sub_category.category_id')
                    ->where('id_sub', $id_sub)
                    ->select('sub_category.id_sub', 'sub_category.category_id', 'sub_category.name_sub', 'category.name_category')
                    ->get();
        $listCategory = Category::all();
        return view('admin.admin_editsub', compact('id_sub', 'listCategory'));
    }

    public function updateSub(Request $req, $id_sub){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        if (empty($req->nameSub)){
            Session::put('message', 'Bạn chưa điền đầy đủ thông tin. Vui lòng kiểm tra lại.');
            return redirect::to('/admin-sua-danh-muc-con/'.$id_sub);
        }
        else{
            $dataSub['name_sub'] = $req->nameSub;
            $dataSub['category_id'] = $req->categorySub;
            DB::table('sub_category')->where('id_sub',$id_sub)->update($dataSub);
            Session::put('message', 'Cập nhật thành công.');
            return redirect::to('/admin-danh-sach-danh-muc-con');
        }
    }

    // Shop
    public function listShop(){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $listShop = DB::table('shop')->get();
        return view('admin.admin_listshop', compact('listShop'));
    }

    public function listShopPending(Request $request){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        if ($request->ajax()) {
            $data = DB::table('shop')->where('status_shop', '=', 0) ->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="javascript:void(0)" data-id="'.$row->id_shop.'" data-toggle="tooltip" id="edit-agree-shop"><span class=" btn btn-outline-success icon-like" title="Đồng ý"></span></a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin.admin_listshoppending');
    }

    public function editAgreeShop(Request $request){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $dataShop['status_shop'] = 1;
        DB::table('shop')->where('id_shop',$request->id_shop)->update($dataShop);      
        return response()->json(['success'=>'Product saved successfully.']);
    }

    // Users
    public function checkUrlRoleUser($role_id){
        // $role_id == 2 Quản lý danh mục
        // $role_id == 3 Quản lý sản phẩm
        // $role_id == 4 Quản lý nhân viên
        // $role_id == 5 Quản lý Shop

        if($role_id == 2)
            return Redirect::to('/admin-danh-sach-danh-muc');
        else if($role_id == 3)
            return Redirect::to('/admin-danh-sach-san-pham');
        else if($role_id == 4)
            return Redirect::to('/admin-danh-sach-nhan-vien');
        else if($role_id == 5)
            return Redirect::to('/admin-danh-sach-shop');
        else
            return Redirect::to('/admin-dashboard');
    }
    
    public function checkRoleUser($dataRoleUser){
        foreach($dataRoleUser as $RoleUsers =>$role)
            return $role->role_id;
    }

    public function listUser(){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $listUser = DB::table('users')
                        ->join('roles','roles.id_role', '=', 'users.role_id')
                        ->select('users.id_users', 'users.name_user', 'users.email_user', 'users.phone_user', 'roles.id_role', 'roles.name_role')
                        ->get();
        return view('admin.admin_listuser', compact('listUser'));
    }

    public function addUser(){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $listRole = DB::table('roles')->where('roles.id_role', '>', 1)->get();
        return view('admin.admin_adduser', compact('listRole'));
    }

    public function saveUser(Request $req){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        Session::put('res_name_user', $req->name_user);
        Session::put('res_username_user', $req->username_user);
        Session::put('res_email_user', $req->email_user);
        Session::put('res_phone_user', $req->phone_user);

        if (!empty($req->username_user) || !empty($req->email_user)){
            $loadUser = Users::all();
            foreach ($loadUser as $user){
                if (strcmp($req->username_user, $user->username_user) == 0){
                    Session::put('message', 'Tài khoản này đã tồn tại. Vui lòng kiểm tra lại.');
                    return redirect::to('/admin-them-nhan-vien');
                }
                if (strcmp($req->email_user, $user->email_user) == 0){
                    Session::put('message', 'Email này đã tồn tại. Vui lòng kiểm tra lại.');
                    return redirect::to('/admin-them-nhan-vien');
                }
            }
        }
        if (empty($req->name_user) || empty($req->username_user)  || empty($req->password_user) 
                                   || empty($req->email_user) || empty($req->phone_user) || empty($req->role_user)){
            Session::put('message', 'Bạn chưa điền đầy đủ thông tin. Vui lòng kiểm tra lại.');
            return redirect::to('/admin-them-nhan-vien');
        }
        else {
            $dataUser['name_user'] = $req->name_user;
            $dataUser['username_user'] = $req->username_user;
            $dataUser['password_user'] = md5(sha1($req->password_user));
            $dataUser['email_user'] = $req->email_user;
            $dataUser['phone_user'] = $req->phone_user;
            $dataUser['role_id'] = $req->role_user;
            DB::table('users')->insert($dataUser);
            Session::put('message', 'Thêm thành công.');
            Session::forget('res_name_user');
            Session::forget('res_username_user');
            Session::forget('res_email_user');
            Session::forget('res_phone_user');
            return redirect::to('/admin-danh-sach-nhan-vien');
        }
    }

    public function editRoleUser($id_users){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $loadUser = DB::table('users')->where('id_users', $id_users)
                        ->join('roles', 'roles.id_role', '=', 'users.role_id')
                        ->select('roles.name_role', 'users.id_users', 'users.name_user', 'users.username_user', 'users.email_user', 'users.phone_user', 'users.role_id')
                        ->get();
        $loadRole = DB::table('roles')->where('id_role', '>', 1)->get();
        if ($this->checkRoleUser($loadUser) == 1)
            return redirect::to('/admin-danh-sach-nhan-vien');
        else 
            return view('admin.admin_edituser', compact('loadUser', 'loadRole'));
    }

    public function updateRoleUser(Request $req, $id_users){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $updateRoleUser['role_id'] = $req->role_user;
        DB::table('users')->where('id_users', $id_users)->update($updateRoleUser);
        Session::put('message', 'Cập nhật thành công.');
        return redirect::to('/admin-danh-sach-nhan-vien');
    }

    public function loadPasswordUser($id_users){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $loadUser = DB::table('users')->where('id_users', $id_users)
                        ->join('roles', 'roles.id_role', '=', 'users.role_id')
                        ->select('roles.name_role', 'users.id_users', 'users.name_user', 'users.username_user', 'users.email_user', 'users.phone_user', 'users.role_id')
                        ->get();
        
        if ($this->checkRoleUser($loadUser) == 1)
            return redirect::to('/admin-danh-sach-nhan-vien');
        else 
            return view('admin.admin_resetpassworduser', compact('loadUser'));
    }

    public function updatePasswordUser(Request $req, $id_users){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        if (empty($req->password_user)){
            Session::put('message', 'Bạn chưa nhập mật khẩu. Vui lòng nhập mật khẩu.');
            return redirect::to('/admin-dat-lai-mat-khau/'.$id_users);
        }
        else {
            if (strcmp($req->password_user, $req->confirm_password_user) != 0){
                Session::put('message', 'Mật khẩu nhập lại không đúng. Vui lòng nhập lại.');
                return redirect::to('/admin-dat-lai-mat-khau/'.$id_users);
            }
            else {
                $updatePasswordUser['password_user'] = md5(sha1($req->confirm_password_user));
                DB::table('users')->where('id_users', $id_users)->update($updatePasswordUser);
                Session::put('message', 'Cập nhật thành công.');
                return redirect::to('/admin-danh-sach-nhan-vien');
            }
        }   
    }

    public function changePasswordUser(){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        return view('admin.admin_changepassworduser');
    }

    public function updateChangePasswordUser(Request $req, $id_users){
        $this->AuthAdmin();
        $this->checkUrlRoleUser(Session::get('role_id'));
        $change_password = Users::where('id_users', $id_users)->where('password_user', md5(sha1($req->password_user)))->first();
        if (empty($change_password)){
            Session::put('message', 'Mật khẩu cũ không đúng. Vui lòng nhập lại.');
            return redirect::to('/admin-doi-mat-khau');
        }
        else {
            if (empty($req->new_password_user)){
                Session::put('message', 'Bạn chưa nhập mật khẩu mới. Vui lòng nhập mật khẩu mới.');
                return redirect::to('/admin-doi-mat-khau');
            }
            else {
                if(strcmp($req->new_password_user, $req->confirm_new_password_user) != 0){
                    Session::put('message', 'Mật khẩu mới nhập lại không đúng. Vui lòng nhập lại.');
                    return redirect::to('/admin-doi-mat-khau');
                }
                else {
                    $updatePasswordUser['password_user'] = md5(sha1($req->confirm_new_password_user));
                    DB::table('users')->where('id_users', $id_users)->update($updatePasswordUser);
                    Session::put('message', 'Cập nhật thành công.');
                    return redirect::to('/admin-danh-sach-nhan-vien');
                } 
            }
        }
    }

    // Revenue
    public function statisticsDashboard($date){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d 23:59:59');
        $loadOrder = Orders::whereBetween('created_at', [$date, $dayNow])->where('status_order', '!=', -1)->get();
        return $loadOrder;
    }

    public function chartDashboard($date){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d 23:59:59');
        $loadOrder = Orders::whereBetween('created_at', [$date, $dayNow])
                            ->where('status_order', '!=', -1)
                            ->groupBy('date')
                            ->orderBy('date', 'ASC')
                            ->get(array(
                                Orders::raw('Date(created_at) as date'),
                                Orders::raw('COUNT(*) as "profit"'),
                                Orders::raw('SUM(price_orders) as "revenue"')
                            ));
        return $loadOrder;
    }

    public function revenueFilterDate($date){
        $loadOrderDate = Orders::whereDate('created_at', $date)
                                ->orderBy('created_at', 'DESC')
                                ->where('status_order', '!=', -1)
                                ->get();
        return $loadOrderDate;
    }

    public function revenueFilterMonth($date){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $yearNow = date_format($dayNow, 'Y');
        $loadOrder = Orders::whereMonth('created_at', '=', $date)
                            ->whereYear('created_at', '=', $yearNow)
                            ->orderBy('created_at', 'DESC')
                            ->where('status_order', '!=', -1)
                            ->get();
        return $loadOrder;
    }

    public function profitDashboard(){
        $lastMonth = date("Y-m-d H:i:s", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -30, date("Y")));
        $lastMonth = date('Y-m-d H:i:s', strtotime($lastMonth));
        $getDataLastMonth = $this->statisticsDashboard($lastMonth);
        return $getDataLastMonth->count();
    }

    public function revenueDashboard(){
        $lastMonth = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -30, date("Y")));
        $lastMonth = date('Y-m-d H:i:s', strtotime($lastMonth));
        $getDataLastMonth = $this->statisticsDashboard($lastMonth);
        return $getDataLastMonth->sum('price_orders');
    }

    public function profitChartDashboard(){
        $lastWeek = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -7, date("Y")));
        $lastWeek = date('Y-m-d H:i:s', strtotime($lastWeek));
        $getDataLastWeek = $this->chartDashboard($lastWeek);
        return json_decode($getDataLastWeek);
    }
    
    public function revenueChartDashboard(){
        $lastWeek = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -7, date("Y")));
        $lastWeek = date('Y-m-d H:i:s', strtotime($lastWeek));
        $getDataLastWeek = $this->chartDashboard($lastWeek);
        return json_decode($getDataLastWeek);
    }

    public function pageRevenue(){
        $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
        $dayNow = date_format($dayNow, 'Y-m-d');
        $loadOrderDay = $this->revenueFilterDate($dayNow);
        return view('admin.admin_revenueOrders', compact('loadOrderDay'));
    }

    public function Revenue($val_revenue){
        if ($val_revenue == -11){
            $yesterday = date("Y-m-d", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -1, date("Y")));
            $loadOrder = $this->revenueFilterDate($yesterday);
            return view('admin.admin_revenueOrdersAjax', compact('loadOrder'));
        }

        elseif ($val_revenue == -10){
            $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
            $dayNow = date_format($dayNow, 'Y-m-d');
            $loadOrder = $this->revenueFilterDate($dayNow);
            return view('admin.admin_revenueOrdersAjax', compact('loadOrder'));
        }

        elseif ($val_revenue == -1){
            $dayNow = now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh'));
            if ($dayNow->format('d') == 31)
                $lastMonth = date("m", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -31, date("Y")));
            else
                $lastMonth = date("m", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d") -30, date("Y")));
            $loadOrder = $this->revenueFilterMonth($lastMonth);
            return view('admin.admin_revenueOrdersAjax', compact('loadOrder'));
        }

        elseif ($val_revenue == 0){
            $lastMonth = date("m", mktime(date("H") +7 , date("i"), date("s"), date("m"), date("d"), date("Y")));
            $loadOrder = $this->revenueFilterMonth($lastMonth);
            return view('admin.admin_revenueOrdersAjax', compact('loadOrder'));
        }
        
        else {
            $loadOrder = $this->revenueFilterMonth($val_revenue);
            return view('admin.admin_revenueOrdersAjax', compact('loadOrder'));
        }
    }

    // public function pageRevenueShop(){
    //     return view('admin.admin_revenueShop');
    // }
    
}
