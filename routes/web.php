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


Route::get('/banhang','CustomerController@sellerChannel');

Route::get('/profile','CustomerController@profile');
Route::post('/capnhap','CustomerController@capnhap');
Route::get('/them-san-pham','CustomerController@getAddProduct');

// Api login Google
Route::get('/redirect/{provider}', 'CustomerController@redirect')->name('redirect');
Route::get('/callback', 'CustomerController@handleProviderCallback');

