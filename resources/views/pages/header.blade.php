<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ogani Template">
    <meta name="keywords" content="Ogani, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>OGANI</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;900&display=swap" rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{asset('public/frontend/css/bootstrap.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/font-awesome.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/elegant-icons.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/nice-select.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/jquery-ui.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/owl.carousel.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/slicknav.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('public/frontend/css/style.css')}}" type="text/css">
</head>

<body><!-- Page Preloder -->
    <div id="preloder">
        <div class="loader"></div>
    </div>
    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__left">
                            <ul>
                              @if(Session::get('id_customer')!=null)
                                <li>
                                <a href="{{URL::to('/banhang')}}" target="_blank">
                                    <i class="fa fa-hand-o-right"></i>Kênh bán hàng</li>
                                </a>
                                @endif
                                <!-- <li>Free Shipping for all Order of $99</li> -->
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            @if(Session::get('id_customer')!=null)
                            <div class="header__top__right__language">
                                <div>
                                <i class="fa fa-user"></i>
                                @if(Session::get('name_customer') != null)
                                    {{Session::get('name_customer')}}
                                @else
                                    {{Session::get('email_customer')}}
                                @endif
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="{{URL::to('/profile')}}">Hồ sơ của tôi</a></li>
                                    <li><a href="{{URL::to('/logout')}}">Đăng xuất</a></li>
                                </ul>
                                </div>
                            </div>
                            @endif
                            @if(Session::get('id_customer')==null)                   
                            <div class="header__top__right__auth">
                                <a href="{{URL::to('login')}}"><i class="fa fa-user"></i>Đăng nhập</a>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{URL::to('/')}}"><img src="{{asset('public/frontend/img/logo.png')}}" alt=""></a>
                    </div>
                </div>
                <div class="col-lg-6" style="margin-top: 18px">
                    <div class="hero__search__form">
                        <form action="{{URL::to('/search')}}" method="get">
                            <div class="hero__search__categories" style="width:30%">
                                Tìm trong tất cả
                                <!-- <span class="arrow_carrot-down"></span> -->
                            </div>
                            <input type="text" name="key" @if(Session::get('keySearch')!=null) value="{{Session::get('keySearch')}}" @endif placeholder="Nhập tên sản phẩm cần tìm.">
                            <button type="submit" class="site-btn">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <div class="col-lg-3" id="total-quantity">
                    <div class="header__cart">
                        <ul>
                            <li><a href="#"><i class="fa fa-heart"></i></a></li>
                            <li><a href="{{URL::to('list-cart')}}">
                                <i class="fa fa-shopping-bag">
                                @if(Session::get('Cart')!=null)
                                    <span id="total-quantity-show">{{Session::get('Cart')->totalQuantity}}</span>
                                @else
                                    <span id="total-quantity-show">0</span>
                                @endif
                                </i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->

    <!-- Hero Section Begin -->
   
    <!-- Hero Section End -->

