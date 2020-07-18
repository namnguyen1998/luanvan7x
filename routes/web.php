<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Page

Route::get('/','PagesController@getIndex');
Route::get('/danh-muc-{id_category}','PagesController@getPagesProductCategory');
Route::get('/chi-tiet-san-pham/{id_product}','PagesController@getPagesProductDetail');
Route::get('/danh-muc-{id_category}/sub-{id_sub}','PagesController@getProductsSubCategory');


Route::get('check-out','CartController@checkoutCart');
	

//Cart
Route::get('/gio-hang','CartController@showCart');
Route::post('/saveCart','CartController@saveCart');
// Route::get('/delete-cart/{rowId}', 'CartController@deleteCart1');
Route::get('/list-cart','CartController@listItemsCart');
//Ajax
Route::get('/add-cart/{id_product}','CartController@addCart');
Route::get('/add-cart-quantity/{id_product}/{quantity}','CartController@addCartQuantity');
//Route::get('/delete-cart1/{id_product}', 'CartController@deleteCart1');
Route::get('/delete-cart/{id_product}', 'CartController@deleteItemsCart');
Route::get('/save-item-cart/{id_product}/{quantity}','CartController@saveItemsCart');
Route::post('/save-all-cart','CartController@saveAllCart');

//Customers
Route::get('/login','CustomerController@getLoginForm');
Route::post('/postLogin','CustomerController@postLogin');
Route::get('/register','CustomerController@getRegisterForm');
Route::post('/postRegister','CustomerController@postRegister');
Route::get('/logout','CustomerController@logout');
Route::get('/profile','CustomerController@profile');
Route::post('/updateProfile','CustomerController@updateProfile');
Route::get('/profile/address','CustomerController@getAddressCustomer');
Route::post('/updateAddress','CustomerController@updateAddressCustomer');

// Seller
Route::get('/dang-ky-shop','CustomerController@getRegisterShop');
Route::post('/postRegisterShop','CustomerController@postRegisterShop');
Route::get('/banhang/dashboard','SellerController@sellerDashBoard');
Route::get('/them-san-pham','ProductController@getAddProduct');
Route::get('/danh-sach-sub','ProductController@getSubCategory');
Route::post('/postThem','ProductController@saveProduct');
Route::get('/san-pham-cho-duyet','ProductController@getProductPending');
Route::get('/list-san-pham','ProductController@getListProduct');
Route::get('/banhang','SellerController@sellerChannel');
Route::post('/postSellerDashBoard','SellerController@postSellerDashBoard');
Route::get('/logout-shop','SellerController@logoutShop');


// Api login Google
Route::get('/redirect/{provider}', 'CustomerController@redirect')->name('redirect');
Route::get('/callback', 'CustomerController@handleProviderCallback');

// Admin
Route::get('/admin', 'AdminController@getLoginAdmin');
Route::post('/admin-post-login','AdminController@postLoginAdmin');
Route::get('/admin-dashboard','AdminController@showDashboard');
Route::get('/logout-admin','AdminController@logOutAdmin');
Route::get('admin-danh-sach-san-pham', 'AdminController@listProduct');
Route::get('admin-danh-sach-san-pham-cho-duyet','AdminController@listProductApprove');
Route::get('/admin-danh-sach-danh-muc', 'AdminController@listCategory');
Route::get('/admin-them-danh-muc', 'AdminController@addCategory');
Route::post('/admin-save-danh-muc', 'AdminController@saveCategory');
Route::get('/admin-sua-danh-muc/{id_category}', 'AdminController@editCategory');
Route::post('/admin-update-danh-muc/{id_category}', 'AdminController@updateCategory');
Route::get('/admin-danh-sach-danh-muc-con', 'AdminController@listSub');
Route::get('/admin-them-danh-muc-con', 'AdminController@addSub');
Route::post('/admin-save-danh-muc-con', 'AdminController@saveSub');
Route::get('/admin-sua-danh-muc-con/{id_sub}', 'AdminController@editSub');
Route::post('/admin-update-danh-muc-con/{id_sub}', 'AdminController@updateSub');
Route::get('/admin-danh-sach-duyet-san-pham','AdminController@listProductApprove');
Route::post('/admin-duyet-san-pham/{id_product}', 'AdminController@editAgree');
Route::post('/admin-tu-choi-duyet-san-pham/{id_product}', 'AdminController@editRefuse');
Route::get('/admin-danh-sach-shop', 'AdminController@listShop');
Route::get('/admin-danh-sach-shop-cho-phe-duyet', 'AdminController@listShopApprove');
Route::post('/admin-duyet-shop/{id_shop}', 'AdminController@editAgreeShop');
Route::get('/admin-danh-sach-shop-tam-ngung-hoat-dong', 'AdminController@listShopBlock');

Route::get('/admin-danh-sach-nhan-vien', 'AdminController@listUser');
Route::get('/admin-them-nhan-vien', 'AdminController@addUser');
Route::post('/admin-save-nhan-vien', 'AdminController@saveUser');
Route::get('/admin-sua-quyen-nhan-vien/{id_users}', 'AdminController@editApproveUser');
Route::post('/admin-update-nhan-vien/{id_users}', 'AdminController@updateApproveUser');
Route::get('/admin-dat-lai-mat-khau/{id_users}', 'AdminController@loadPasswordUser');
Route::post('/admin-update-password-nhan-vien/{id_users}', 'AdminController@updatePasswordUser');



Route::get('/{slug_id}','PagesController@getPagesProductDetailSlug');

Route::get('/admin-doi-mat-khau', 'AdminController@changePasswordUser');
Route::post('/admin-update-change-password-nhan-vien/{id_users}', 'AdminController@updateChangePasswordUser');

