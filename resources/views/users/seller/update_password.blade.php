<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from uxliner.com/bizadmin/demo/main/pages-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jun 2020 17:58:24 GMT -->
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>OGANI | CẬP NHẬT MẬT KHẨU</title>
<!-- Tell the browser to be responsive to screen width -->

<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Biz Admin is a Multipurpose bootstrap 4 Based Dashboard & Admin Site Responsive Template by uxliner." />
<meta name="keywords" content="admin, admin dashboard, admin template, cms, crm, Biz Admin, Biz Adminadmin, premium admin templates, responsive admin, sass, panel, software, ui, visualization, web app, application" />
<meta name="author" content="uxliner"/>
<!-- v4.1.3 -->
<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="16x16" href="{{asset('public/backend/dist/img/favicon-16x16.png')}}">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="{{asset('public/backend/dist/css/style.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/dist/css/font-awesome/css/font-awesome.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/dist/css/et-line-font/et-line-font.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/dist/css/themify-icons/themify-icons.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/dist/css/simple-lineicon/simple-line-icons.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/dist/css/skins/_all-skins.min.css')}}">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

</head>

<body class="login-page sty1">
<div class="login-box sty1">
  <div class="login-box-body sty1">
  <div class="login-logo">
    <a href="{{URL::to('/')}}"><img src="{{asset('public/frontend/img/logo.png')}}" alt=""></a>
  </div>
  @foreach($errors->all() as $err)
      <div class="alert alert-danger" role="alert">{{$err}}</div>
  @endforeach
    <form action="{{URL::to('/resetPasswordShop')}}" method="post" enctype="multipart/form-data">
         @csrf
      <input type="hidden" class="form-control sty1" name="key" value="{{$key}}">
      <div class="form-group has-feedback">
        <input type="password" class="form-control sty1" name="password_new" placeholder="Nhập mật khẩu mới">
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control sty1" name="password_new_confirmation" placeholder="Nhập lại mật khẩu">
      </div>
      <div>
        <div class="col-xs-8">
          <div class="checkbox icheck">
            <!-- <label>
              <input type="checkbox">
              Remember Me </label> -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4 m-t-1">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Đổi mật khẩu</button>
        </div>
        <!-- /.col --> 
      </div>
    </form>
  <!-- /.login-box-body --> 
</div>
<!-- ./wrapper --> 

<!-- jQuery 3 --> 
<script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  
<script src="{{asset('public/backend/dist/bootstrap/js/bootstrap.min.js')}}"></script> 

<!-- template --> 
<script src="{{asset('public/backend/dist/js/bizadmin.js')}}"></script> 

<!-- for demo purposes --> 
<script src="{{asset('public/backend/dist/js/demo.js')}}"></script>
<!--Start of Tawk.to Script-->

<!--End of Tawk.to Script-->
</body>

<!-- Mirrored from uxliner.com/bizadmin/demo/main/pages-login-2.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Jun 2020 17:58:25 GMT -->
</html>
