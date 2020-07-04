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
Route::get('/search?category_id={$id_category}','PagesController@getPagesProductCategory');



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
Route::get('/banhang','CustomerController@sellerChannel');
Route::get('/them-san-pham','ProductController@getAddProduct');
Route::get('/danh-sach-sub','ProductController@getSubCategory');
Route::post('/postThem','ProductController@saveProduct');
Route::get('/san-pham-cho-duyet','ProductController@getProductPending');
Route::get('/list-san-pham','ProductController@getListProduct');

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
