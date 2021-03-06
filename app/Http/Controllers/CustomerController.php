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
use App\OrderDetail;
use App\Orders;
use App\ShippingAddress;
use App\Shop;
use Sentinel;
use Reminder;
use Mail;
use Hash;
use Image;
use PharIo\Manifest\Email;

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
            Session::put('img_customer',$result->img_customer);

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
        return view('register');
        
    }
    public function postRegister(Request $request){
        if($request->email != null){
        $this->validate($request,[
            'email' => 'required|unique:customers,email_customer'
        ],[
            'email.required'=>'Vui lòng nhập Email',
            'email.unique'=>'Email đã được đăng ký'
        ]);
            $str = \Str::random(32);
            $url = \URL::to('/register?key='.$str.base64_encode($request->email));
            $details = [
                'title' => 'Tạo tài khoản OGANI',
                'body' => "Chúng tôi vừa nhận được yêu cầu đăng ký tài khoản! Xin vui lòng click vào LINK bên dưới để tiếp tục",
                'url' => $url
            ];
            \Mail::to($request->email)->send(new \App\Mail\Mail($details));
            return redirect()->back()->with(['Thành công' => 'Email đã được gửi. Vui lòng kiểm tra mail để cập nhật thông tin.']);
        }
        else{
        $request->email = null;
        $this->validate($request,
            [
                'password' => 'required|min:6|max:20',
                're_password' => 'required|same:password',
            ],
            [
                'password.required'=>'Vui lòng nhập mật khẩu',
                're_password.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu có ít nhất 6 kí tự',
                'password.max'=>'Mật khẩu có tối đa 20 kí tự'
            ]);
        $customer = new Customers();
        $customer->email_customer = base64_decode(substr($request->accept,32));
        $customer->password_customer = md5($request->re_password); 
        $customer->save();
        return redirect('/login')->with('success','Tạo tài khoản thành công');
        }
    }
    public function getUpdatePassword(){
        return view('users.customer.update_password');
    }
    public function postUpdatePassword(Request $request){
        $this->AuthLogin();
        $this->validate($request,
            [
                'new_password' => 'required|min:6|max:20',
                'password_new_confirmation' => 'required|same:new_password',
            ],
            [
                'new_password.required'=>'Vui lòng nhập mật khẩu',
                'password_new_confirmation.same'=>'Mật khẩu không giống nhau',
                'new_password.min'=>'Mật khẩu có ít nhất 6 kí tự',
                'new_password.max'=>'Mật khẩu có tối đa 20 kí tự'
            ]);
        $customer = Customers::find($this->checkUser());
        $customer->password_customer = md5($request->password_new_confirmation);
        $customer->save();
        return Redirect('/profile/update-password')->with('message','Cập nhật thành công');
    }
    public function getForgotPassword(){
        return view('forgot_password');
    }
     public function sendMailResetPass(Request $request)
    {
        $customer = Customers::where('email_customer',$request->email_customer)->first();

        //print_r($user);exit;
        if(($customer)== null){
            return redirect()->back()->with(['Lỗi' => 'Email không có trong hệ thống']);
        }

        $str = \Str::random(32);
        $url = \URL::to('/reset-password?key='.$str.base64_encode($customer->id_customer));
        
        $details = [
            'url' => $url
        ];

        \Mail::to($customer->email_customer)->send(new \App\Mail\SendMailForgetPassword($details));
        
        return redirect()->back()->with(['Thành công' => 'Email đã được gửi. Vui lòng kiểm tra mail để cập nhật thông tin.']);
    }

    public function formResetPassword(){
        $key = $_GET['key'];
        return view('reset_password',compact('key'));
    }
    public function resetPassword(Request $request){
        $this->validate($request,
            [
                'password_new' => 'required|min:6|max:20',
                'password_new_confirmation' => 'required|same:password_new',
            ],
            [
                'password_new.required'=>'Vui lòng nhập mật khẩu',
                'password_new_confirmation.same'=>'Mật khẩu không giống nhau',
                'password.min'=>'Mật khẩu có ít nhất 6 kí tự'
            ]);
        $keyID = base64_decode(substr($request->key,32));
        $customer = Customers::find($keyID);
        $customer->password_customer = md5($request->password_new);
        $customer->save();
        return Redirect('/login')->with('success','Cập nhật mật khẩu thành công');
    }
    
    public function logout(){
        $this->AuthLogin();
        Session::forget('id_customer');
        Session::forget('name_customer');
        Session::forget('provider_customer');
        Session::forget('sex_customer');
        Session::forget('img_customer');
        Session::forget('phone_customer');
        Session::forget('address_customer');
        Session::forget('email_customer');
        Session::forget('provider_id');
        Session::forget('Cart');
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
            $newCustomers->img_customer              = $Customers->id . '.jpg';
            $newCustomers->password_customer         = '';
            $newCustomers->save();
            Image::make($Customers->avatar)->save(public_path('frontend/img/shop/' . $Customers->id . '.jpg'));
        }
        Session::put('customers', $Customers);
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
        $customer = Customers::find($this->checkUser());
        if(!empty($customer)){
            Session::put('customer',$customer);
            Session::put('img_customer',$customer->img_customer);
            $phone_customer = substr(Session::get('customer')->phone_customer,7);
            $email_customer = substr(Session::get('customer')->email_customer,0,3);
        }
        //var_dump($shop_customer);
        return view('users.customer.thongtin_customer',compact('phone_customer','email_customer'));
    }   
     public function updateProfile(Request $request){
        $this->AuthLogin();
        $this->validate($request, 
        [
            'img_customer' => 'mimes:jpg,jpeg,png,gif|max:2048',
            'date_customer' => 'date|before:tomorrow',
        ], 
        [
            'date_customer.date' =>'Định dạng ngày, tháng không đúng. Xin vui lòng nhập lại',
            'img_customer.mimes' => 'Chỉ chấp nhận với đuôi .jpg .jpeg .png .gif',
            'img_customer.max' => 'Hình ảnh giới hạn dung lượng không quá 2M',

        ]);
        $customer = Customers::find($this->checkUser());
        if($request->name_customer!= null){
            $customer->name_customer = $request->name_customer;
        }else{
            $customer->name_customer = $customer->name_customer;
        }
        if($request->sex_customer!= null){
            $customer->sex_customer = $request->sex_customer;    
        }else{
            $customer->sex_customer = $customer->sex_customer;
        }if($request->phone_customer!= null){
            $customer->phone_customer = $request->phone_customer;
         }else{
             $customer->phone_customer = $customer->phone_customer;
         }if($request->date_customer != null){
            $customer->date_customer = date('Y-m-d', strtotime($request->date_customer));
        }else{
            $customer->date_customer = $customer->date_customer;
        }
        if($request->img_customer){
            $customer->img_customer = $this->setNameImage($request->img_customer);
        }else{
            $customer->img_customer = $customer->img_customer;
        }
        $customer->save();
        //dd($customer);
        Session::put('message','Cập nhật thành công.');
        return Redirect::to('/profile');
    }
    public function getAddressCustomer(){
        $this->AuthLogin();
        $addressCustomer = ShippingAddress::where('customer_id','=',$this->checkUser())
                                        ->where('id_deleted', '>=', 0)
                                        ->orderBy('status_default', 'DESC')
                                        ->get();
        if (empty($addressCustomer->count()))
            Session::put('message1','Hiện bạn chưa có địa chỉ nào. Xin vui lòng bấm chọn <strong> Thêm thông tin chỉ </strong> để thêm địa chỉ mới.');
        return view('users.customer.address_customer',compact('addressCustomer'));
    }

    public function defaultAddressCustomer(Request $request){
        $this->AuthLogin();
        $status_default['status_default'] = 0;

        // Update All
        DB::table('shipping_address')->where('status_default', '=', 1)->where('customer_id',$this->checkUser())->update($status_default);

        // Update One
        $addressCustomer['status_default']  = 1;
        $addressCustomer['customer_id'] = $this->checkUser();
        DB::table('shipping_address')->where('id_address', '=', $request->address_default)->update($addressCustomer);
        Session::put('message','Cập nhật <strong> Địa chỉ mặc định </strong> thành công');
        return Redirect::to('/profile/address');
    }

    public function getNamePhoneCustomer($val_address){
        $this->AuthLogin();
        $loadNamePhone = DB::table('shipping_address')->where('id_address', '=', $val_address)->where('id_deleted', '=', 0)->get();
        return json_decode($loadNamePhone);
    }

    public function delteAdressCustomer($val_address){
        $this->AuthLogin();
        $is_deleted_address['id_deleted'] = -1;
        $is_deleted_address['status_default'] = 0;
        DB::table('shipping_address')->where('id_address', '=', $val_address)->update($is_deleted_address);
        // Session::put('message','Xoá thành công. Xin vui lòng chọn lại <strong> Địa chỉ mặc định</strong>.');
        return Redirect::to('/profile/address');
    }

    public function editAddressCustomer(Request $request){
        $this->AuthLogin();
        if ( empty($request->edit_address) || empty($request->edit_address_name) || empty($request->edit_address_phone)){
            Session::put('message1','Vui lòng điền đầy đủ thông tin <strong> Tên, SĐT, Địa chỉ </strong> trước khi <strong> Xác nhận </strong>');
            return Redirect::to('/profile/address');
        }
        else {
            $editAddressCustomer['status_default']  = 0;
            $editAddressCustomer['address_customer']  = $request->edit_address;
            $editAddressCustomer['name_recipient']  = $request->edit_address_name;
            $editAddressCustomer['phone_recipient']  = $request->edit_address_phone;
            $editAddressCustomer['customer_id'] = $this->checkUser();

            DB::table('shipping_address')->where('id_address', '=', $request->change_edit_address)->update($editAddressCustomer);
            Session::put('message','Sửa thành công. Xin vui lòng chọn lại <strong> Địa chỉ mặc định</strong>.');
            return Redirect::to('/profile/address');
        }
        
    }

    public function createAddressCustomer(Request $request){
        $this->AuthLogin();
        $this->validate($request,
        [
            'new_address' => 'required',
            'new_address_name' => 'required',
            'new_address_phone' => 'required|numeric',
        ],[
            'new_address.required' => 'Vui lòng nhập địa chỉ',
            'new_address_name.required' => 'Vui lòng nhập tên',
            'new_address_phone.required' => 'Vui lòng nhập số điện thoại',
            'new_address_phone.numeric' => ' Nhập sai kiểu số điện thoại'

        ]);
        // if ( empty($request->new_address) || empty($request->new_address_name) || empty($request->new_address_phone)){
        //     Session::put('message1','Vui lòng điền đầy đủ thông tin <strong> Tên, SĐT, Địa chỉ </strong> trước khi <strong> Xác nhận </strong>');
        //     return Redirect::to('/profile/address');
        // }
        // else {
            $createAddressCustomer['status_default']  = 0;
            $createAddressCustomer['address_customer']  = $request->new_address;
            $createAddressCustomer['name_recipient']  = $request->new_address_name;
            $createAddressCustomer['phone_recipient']  = $request->new_address_phone;
            $createAddressCustomer['customer_id'] = $this->checkUser();

            DB::table('shipping_address')->insert($createAddressCustomer);
            Session::put('message','Thêm thành công. Xin vui lòng chọn lại <strong> Địa chỉ mặc định</strong>.');
            return Redirect::to('/profile/address');
        //}
        
    }

    public function getRegisterShop(){
        $this->AuthLogin();
        return view('users.seller.banhang_dangkyshop');
    }

    public function postRegisterShop(Request $request){
        $this->AuthLogin();
        if($request->email_shop != null){
        $this->validate($request,[
            'email_shop' => 'required|unique:shop,email_shop'
        ],[
            'email_shop.required'=>'Vui lòng nhập Email',
            'email_shop.unique'=>'Email đã được đăng ký'
        ]);
            $str = \Str::random(32);
            $url = \URL::to('/dang-ky-shop?keyID='.$str.base64_encode($request->email_shop));
            $details = [
                'title' => 'Tạo tài khoản OGANI',
                'body' => "Chúng tôi vừa nhận được yêu cầu đăng ký mở shop! Xin vui lòng click vào LINK bên dưới để tiếp tục",
                'url' => $url
            ];
            \Mail::to($request->email_shop)->send(new \App\Mail\Mail($details));
            return redirect()->back()->with(['Thành công' => 'Email đã được gửi. Vui lòng kiểm tra mail để cập nhật thông tin.']);
        }else{
            $request->email_shop = null;
            $data = $request->validate(
                [
                    'name_shop' => 'required|unique:shop,name_shop',
                    'address_shop' => 'required',
                    'phone_shop' => 'required|max:10',
                    'img_shop' => 'mimes:jpg,jpeg,png,gif|max:2048',
                    'password_shop' => 'required|min:6|max:20',
                    're-password' => 'required|same:password_shop',
                    'g-recaptcha-response' => new Captcha(),         //dòng kiểm tra Captcha
                ],[
                    'name_shop.unique' => 'Tên shop đã tồn tại',
                    'password.required'=>'Vui lòng nhập mật khẩu',
                    're_password.same'=>'Mật khẩu không giống nhau',
                    'password.min'=>'Mật khẩu có ít nhất 6 kí tự'
                ]);

            $shop = new Shop();
            $shop->name_shop = $request->name_shop;
            $shop->address_shop = $request->address_shop;
            $shop->phone_shop = $request->phone_shop;
            $shop->email_shop = base64_decode(substr($request->accept_shop,32));
            $shop->password_shop = md5($request->re_password);
            $shop->img_shop = $this->setNameImage($request->img_shop);
            $shop->customer_id = $this->checkUser();
            $shop->save();
            // $items = array();
            // $items['name_shop'] = $data['name_shop'];
            // $items['address_shop'] = $data['address_shop'];
            // $items['phone_shop'] = $data['phone_shop'];
            // $items['email_shop'] = $data['email_shop'];
            // $items['password_shop'] = md5($data['password_shop']);
            // $items['img_shop'] = $this->setNameImage($data['img_shop']);
            // $items['customer_id'] = $this->checkUser();
            // DB::table('shop')->insert($items);
            Session::put('message','Đăng ký thành công chờ phê duyệt');
            return Redirect::to('/profile');
        }
    }

    public function getBillCustomer(){
        $billCustomer = Orders::where('customer_id', $this->checkUser())->orderBy('created_at', 'DESC')->paginate(5);
        // dd($billCustomer);
        $orderDetail = OrderDetail::join('products', 'products.id_product', '=', 'order_detail.product_id')->get();
        return view('users.customer.donhang_customer', compact('billCustomer', 'orderDetail'));
    }
    
    public function getOrdersCustomer($id_orders){
        $orderDetail = OrderDetail::where('orders_id', $id_orders)
                                    ->where('customer_id', $this->checkUser())
                                    ->join('products', 'products.id_product', '=', 'order_detail.product_id')
                                    ->join('orders', 'orders.id_orders', '=', 'order_detail.orders_id')
                                    // ->orderBy('create_at', 'DESC')
                                    ->get();
        // dd($orderDetail);
        if (empty($orderDetail->count()))
            return redirect::to('/profile/don-hang-cua-ban');
        else
            return view('users.customer.chitietdonhang_customer', compact('orderDetail'));
    }

    public function loadCancelOrdersCustomer($id_orders){
        $loadCancelOrder = Orders::where('id_orders', $id_orders)
                                ->where('customer_id', $this->checkUser())
                                ->get();
        if (empty($loadCancelOrder->count()))
            return redirect::to('/profile/don-hang-cua-ban');
        else
            return view('users.customer.huydonhang_customer', compact('loadCancelOrder'));
    }

    public function cancelOrdersCustomer(Request $req){
        if (empty($req->noteCancel)){
            Session::put('message','Xin vui lòng nhập nội dung trước khi <strong>"Xác nhận"</strong>. Cảm ơn.');
            return redirect::to('/profile/huy-don-hang/'.$req->id_orders);
        }
        else {
            $cancelOrder['status_order'] = -1;
            $cancelOrder['note'] = $req->noteCancel;
            Orders::where('id_orders', $req->id_orders)->update($cancelOrder);
            Session::put('message','Đơn hàng đã được <strong>"Huỷ"</strong>. Chúng tôi sẽ ghi nhận phản hồi của bạn. Xin cảm ơn.');
            return redirect::to('/profile/don-hang-cua-ban');
        }       
    }
    public function postComment(Request $req){
        // $this->validate($req, 
        // [
        //     'content' => 'required',
        // ], 
        // [
        //     'content.required' =>'Vui lòng nhập comment',
        // ]);
        $data = array();
        $data['customer_id'] = $this->checkUser();
        $data['product_id'] = $req->id_product;
        $data['content'] = $req->content;
        DB::table('comment')->insert($data);
        $id = base64_encode(base64_encode($req->id_product));
        return Redirect::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($req->id_product)));
    }   

}
