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
use Hash;
session_start();

class CustomerController extends Controller
{
    public function getLoginForm(){
    	return view('login');
    }
    public function postLogin(Request $request){
        $this->validate($request,
            [
                'email' => 'required|email',
                'password' => 'required|min:6|max:20'
            ],
            [
                'email.required'=>'Vui lòng nhập Email',
                'password.required'=>'Vui lòng nhập mật khẩu',
                'password.min'=>'Mật khẩu có ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu không quá 20 kí tựs'
            ]);
    	

        $email = $request->email;
    	// $password =md5(md5($request->password.'_%1A'));
        $password =md5($request->password);
    	// $result = DB::table('Customers')
    	// ->where('email_customer', $email)
    	// ->where('password_customer', $password)->first();
    	$result = Customers::where('email_customer', $email)->where('password_customer',$password)->first();
        
    	if($result){

            if(!empty($result->name_customer))
                Session::put('name_customer',$result->name_customer);
            else
                Session::put('name_customer',$result->email_customer);

            Session::put('id_customer',$result->id_customer);
            return redirect::to('/');
            
    	}else{
    		return redirect::to('/login');
    	}
    }

    public function capnhap(){
        $customer = Customers::find(Session::get('id_customer'));//print_r($customer);
        $customer->name_customer = $_POST['name_customer'];
        $customer->save();
            Session::put('name_customer',$customer->name_customer);
        return Redirect::to('/');

    }
    public function getRegisterForm(){
    	return 	view('register');
    }
    public function postRegister(Request $request){
    	$this->validate($request,
    		[
    			'email' => 'required|email|unique:customers,email_customer',
    			'password' => 'required|min:6|max:20',
    			're_password' => 'required|same:password',
    		],
    		[
    			'email.required'=>'Vui lòng nhập Email',
    			'email.unique'=>'Email đã được sử dụng',
    			'password.required'=>'Vui lòng nhập mật khẩu',
    			're_password.same'=>'Mật khẩu không giống nhau',
    			'password.min'=>'Mật khẩu có ít nhất 6 kí tự'
    		]);
    	$customer = new Customers();
    	$customer->email_customer = $request->email;
    	$customer->password_customer = md5(md5($request->password.'_%1A'));	
    	$customer->save();

    	return redirect('/')->with('success','Tạo tài khoản thành công');
    }
    public function logout(){
        Session::forget('id_customer');
        Session::forget('name_customer');

        return Redirect::to('/');
    }
    public function sellerChannel(){
        return view('users.banhang');
    }

    public function profile(){
        return view('users.profile');
    }

    public function getAddProduct(){
        return view('users.banhang_quanlysanpham');
    }

    // Login Google Api
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback()
    {
        try {
            $Customers = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            return redirect('/login');
        }

        // only allow people with @gmail.com to login
        if(explode("@", $Customers->email)[1] !== 'gmail.com'){
            Session::put('name_customer',$Customers->name);
            return redirect()->to('/');
        }

        // check if they're an existing Customers
        $existingCustomers = Customers::where('email_customer', $Customers->email)->first();
        if($existingCustomers){
            // log them in
            Session::put('name_customer',$Customers->name);

        } else {
            // create a new Customers
            $newCustomers                            = new Customers;
            $newCustomers->name_customer             = $Customers->name;
            $newCustomers->email_customer            = $Customers->email;
            $newCustomers->address_customer          = $Customers->id;
            $newCustomers->img_customer              = $Customers->avatar;
            $newCustomers->password_customer         = '';
            $newCustomers->save();
        }

        Session::put('name_customer',$Customers->name);
        return redirect()->to('/');
    }


    // Login Facebook Api
    // public function callback($provider)
    // {
    //     $getInfo = Socialite::driver($provider)->user(); 
    //     $Customers = $this->createUser($getInfo); 
    //     Session::put('name_customer',$Customers->name);
    //     return redirect()->to('/');
    // }

    // function createUser($getInfo){
    //     $customer = Customers::where('email_customer', $getInfo->getEmail())->first();
    //     if (!$customer) {
    //         $customer = Customers::create([
    //             'name_customer' => $getInfo->getName(),
    //             'email_customer' => $getInfo->getEmail(),
    //             'img_customer' => $getInfo->getAvatar(),
    //             'address_customer' => $getInfo->getId(),

    //         ]);
    //     }
    //     return $customer;
    // }
}
