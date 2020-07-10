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

//Cart
Route::get('/gio-hang','CartController@showCart');
Route::post('/saveCart','CartController@saveCart');
Route::get('/delete-cart/{rowId}', 'CartController@deleteCart');


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


// Api login Google
Route::get('/redirect/{provider}', 'CustomerController@redirect')->name('redirect');
Route::get('/callback', 'CustomerController@handleProviderCallback');

// Admin
Route::get('/admin', 'AdminController@getLoginAdmin');
Route::get('/admin/dashboard', 'AdminController@dashboard');
Route::get('admin/list-san-pham-cho-duyet','AdminController@listProductsPending');
Route::get('admin/list-san-pham','AdminController@listProductsApprove');
// Route::post('/postLogin','AdminController@postLoginAdmin');
Route::post('/admin-dashboard','AdminController@postLoginAdmin');
// Route::get('/admin-them-san-pham','AdminController@setAddProduct');
// Route::get('/admin-danh-sach-sub','AdminController@getSubCategory');
Route::get('/admin-them','AdminController@saveProduct');

Route::post('/admin-dashboard','AdminController@postLoginAdmin');;
Route::get('admin-list-san-pham-cho-duyet','AdminController@listProductsPending');
Route::get('admin-list-san-pham', 'AdminController@listProductsApprove');
Route::get('/admin-them-san-pham', 'AdminController@setAddProduct');
Route::get('/admin-danh-sach-sub', 'AdminController@getSubCategory');
Route::get('/admin-them', 'AdminController@saveProduct');
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

