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
Route::get('/','UserController@trangchu');
Route::get('/trang-chinh','UserController@trangchinh');
Route::get('/chi-tiet','UserController@trangctsanpham');


Route::get('/login','CustomerController@getLoginForm');
Route::post('/postLogin','CustomerController@postLogin');
Route::get('/register','CustomerController@getRegisterForm');
Route::post('/postRegister','CustomerController@postRegister');
Route::get('/logout','CustomerController@logout');

// Seller
Route::get('/banhang','CustomerController@sellerChannel');
Route::get('/profile','CustomerController@profile');
Route::post('/capnhap','CustomerController@capnhap');
Route::get('/them-san-pham','ProductController@getAddProduct');
Route::get('/admin-danh-sach-sub','ProductController@getSubCategory');
Route::post('/admin-them','ProductController@saveProduct');
Route::get('/san-pham-cho-duyet','ProductController@getProductPending');

// Api login Google
Route::get('/redirect/{provider}', 'CustomerController@redirect')->name('redirect');
Route::get('/callback', 'CustomerController@handleProviderCallback');

// Admin
Route::get('/admin', 'AdminController@getLoginAdmin');
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