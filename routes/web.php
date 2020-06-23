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
Route::get('/ban-hang','UserController@index');
Route::get('/','UserController@trangchu');
Route::get('/trang-chinh','UserController@trangchinh');
Route::get('/chi-tiet','UserController@trangctsanpham');


Route::get('/login','CustomerController@getLogin');
Route::post('/postLogin','CustomerController@postLogin');
Route::get('/signup','CustomerController@getSignup');
Route::post('/postSignup','CustomerController@postSignup');