<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(){
    	return view('banhang');
    }
    public function trangchu(){
    	return view('pages.home');
    }
    public function trangchinh(){
    	return view('pages.trangsanpham');
    }
    public function trangctsanpham(){
    	return view('pages.chitietsanpham');
    }
}
