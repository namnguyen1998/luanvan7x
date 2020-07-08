@include('pages.header')
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb.jpg')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">OGANI</a>
                        <span>Profile</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="product spad">
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-5">
            <div class="sidebar">
                <div class="sidebar__item">
                    <h4>Thông tin</h4>
                    <ul>
                        <li>
                            <img class="profile-user-img img-responsive img-circle m-b-2" src="{{Session::get('img_customer')}}" alt="User profile picture" style="height: 100px;
                                padding-left: 56px;">
                            <h5 class="profile-username text-center" style="padding-right: 38px;">
                                {{Session::get('name_customer')}}
                            </h5>
                        </li>
                        <li><a href="{{URL::to('/profile')}}" class = "fa fa-user">Hồ sơ của tôi</a></li>
                        <li><a href="#" class = "fa fa-shopping-cart">Đơn mua</a></li>
                        <li><a href="{{URL::to('/profile/address')}}" class = "fa fa-truck">Địa chỉ</a></li>
                        <li><a href="{{URL::to('/dang-ky-shop')}}" class = "fa fa-slideshare">Đăng ký shop bán hàng</a></li>
                        <!-- <li>
                            @if(Session::get('id_shop'))
                                <a href="{{URL::to('/dang-ky-shop')}}" class = "fa fa-slideshare">Kênh bán hàng</a>
                            @endif
                        </li> -->
                    </ul>
                </div>
                
            </div>
        </div>
           @yield('content')
    </div>
</div>
</section>
    <!-- Breadcrumb Section End -->
    <!-- Product Section Begin -->
    <!-- Product Section End -->
@include('pages.footer')