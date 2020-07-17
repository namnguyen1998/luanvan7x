<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Session;
use Socialite;
use Illuminate\Support\Facades\Redirect;
use App\Rules\Captcha;
use DB;
use App\Customers;
use App\Category;
use App\Brands;
use App\ShippingAddress;
use Hash;
session_start();

class CustomerController extends Controller
{
    public function AuthLogin(){
        $customer_id = Session::get('id_customer');
        if($customer_id){
            return Redirect::to('/');
        }else{
            return Redirect::to('/login')->send();
        }
    }
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
    	$password =md5($request->password);

    	// $result = DB::table('Customers')
    	// ->where('email_customer', $email)
    	// ->where('password_customer', $password)->first();
    	$result = Customers::where('email_customer', $email)->where('password_customer',$password)->first();
        
    	if($result){
            Session::put('name_customer',$result->name_customer);
            Session::put('email_customer',$result->email_customer);

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
    	$customer->password_customer = md5($request->password);	
    	$customer->save();

    	return redirect('/')->with('success','Tạo tài khoản thành công');
    }
    public function logout(){
        $this->AuthLogin();
        Session::forget('id_customer');
        Session::forget('name_customer');
        Session::forget('provider_id');
        Session::forget('sex_customer');
        Session::forget('img_customer');
        Session::forget('phone_customer');
        Session::forget('address_customer');
        Session::forget('email_customer');
        Session::forget('email_shop');
        Session::forget('img_shop');
        Session::forget('id_shop');
        return Redirect::to('/');
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
            // dd(Session::get('name_customer'))
            return redirect('/');
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
            $newCustomers->provider_id               = $Customers->id;
            $newCustomers->img_customer              = $Customers->avatar;
            $newCustomers->password_customer         = '';
            $newCustomers->save();
        }

        Session::put('name_customer',$Customers->name);
        Session::put('id_customer',$Customers->id);
        Session::put('provider_id',$Customers->id);
        Session::put('img_customer',$Customers->avatar);
        Session::put('email_customer',$Customers->email);
        //dd($Customers);


        return redirect()->to('/');
    }

    public function checkUser(){
        if((Session::get('provider_id'))){
            $customer = Customers::where('provider_id',  Session::get('provider_id'))->first();
            return $customer->id_customer;
        }
        else
            return Session::get('id_customer');
    }

    //Cập nhật info customer
    public function profile(){
        $this->AuthLogin();
        
        $phone_customer = substr(Session::get('phone_customer'),7);
        $email_customer = substr(Session::get('email_customer'),0,3);
        $customer = Customers::find($this->checkUser());
        
        
        Session::put('name_customer',$customer->name_customer);
        Session::put('sex_customer',$customer->sex_customer);
        Session::put('phone_customer',$customer->phone_customer);
        Session::put('email_customer',$customer->email_customer);
        //var_dump($shop_customer);
        return view('users.customer.thongtin_customer',compact('phone_customer','email_customer'));
    }   

     public function updateProfile(){
        $this->AuthLogin();
        $customer = Customers::find($this->checkUser());
        $customer->name_customer = $_POST['name_customer'];
        $customer->sex_customer = $_POST['sex_customer'];
        $customer->save();
        $addressDefault = array();
        $addressDefault['address_default'] = $_POST['address_default'];
        $addressDefault['customer_id'] = $this->checkUser();
        DB::table('shipping_address')->insert($addressDefault);
       
            
        return Redirect::to('/profile');
    }
    public function getAddressCustomer(){
        $this->AuthLogin();
        $addressCustomer = ShippingAddress::where('customer_id','=',$this->checkUser())->first();
        Session::put('address_default',$addressCustomer->address_default);
        Session::put('address_customer',$addressCustomer->address_customer);
        // var_dump($addressCustomer);
        return view('users.customer.address_customer',compact('addressCustomer'));
    }

    public function updateAddressCustomer(Request $request){
        $this->AuthLogin();
        $addressCustomer = array();
        $addressCustomer['address_customer'] = $request->address_customer;
        $addressCustomer['address_default']  = $request->address_default;
        $addressCustomer['customer_id'] = $this->checkUser();
        DB::table('shipping_address')->where('customer_id',$this->checkUser())->update($addressCustomer);
        //var_dump($this->checkUser());
        return Redirect::to('/profile/address');
    }

    public function getRegisterShop(){
        $this->AuthLogin();
        return view('users.seller.banhang_dangkyshop');
    }

    public function setNameImage($data){
        if(empty($data)){
            return null;
        }
        else{
            $getNameImage = current(explode('.', $data->getClientOriginalName()));
            $destinationPath = 'public/frontend/img/shop';
            $date = date('dmY');
            $hash = md5($getNameImage);
            $plus = $date . '_' . $hash . '.jpg';
            $data->move($destinationPath, $plus);
            return $plus;
        }
    }

    public function postRegisterShop(Request $request){
        $this->AuthLogin();
        $data = $request->validate(
            [
                'name_shop' => 'required|unique:shop_customer,name_shop',
                'address_shop' => 'required',
                'phone_shop' => 'required|max:10',
                'img_shop' => 'mimes:jpg,jpeg,png,gif|max:2048',
                'email_shop' => 'required',
                'password_shop' => 'required|min:6|max:20',
                're-password' => 'required|same:password_shop',
                'g-recaptcha-response' => new Captcha(),         //dòng kiểm tra Captcha
            ],[
                'name_shop.unique' => 'Tên shop đã tồn tại',
                'email.required'=>'Vui lòng nhập Email',
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu có ít nhất 6 kí tự'
            ]);
        $items = array();
        $items['name_shop'] = $data['name_shop'];
        $items['address_shop'] = $data['address_shop'];
        $items['phone_shop'] = $data['phone_shop'];
        $items['email_shop'] = $data['email_shop'];
        $items['password_shop'] = md5($data['password_shop']);
        $items['img_shop'] = $this->setNameImage($data['img_shop']);
        $items['customer_id'] = $this->checkUser();
        DB::table('shop')->insert($items);
        Session::put('message','Đăng ký thành công chờ phê duyệt');
        return Redirect::to('/profile');
    }


    
    


}
