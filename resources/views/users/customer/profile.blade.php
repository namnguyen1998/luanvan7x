@include('pages.header')
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/green1.png')}}">
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
                            @if(Session::get('img_customer')==null && Session::get('customer')->name_customer == null)
                            <img class="profile-user-img img-responsive img-circle m-b-2" src="{{asset('public/frontend/img/default-avatar.png')}}" alt="User profile picture" style="height: 100px;
                                padding-left: 56px;">
                            <h5 class="profile-username text-center" style="padding-right: 38px; padding-top: 10px;">
                                <strong style="color:blue">{{Session::get('customer')->email_customer}}</strong>
                            </h5>
                            @else
                            <img class="profile-user-img img-responsive img-circle m-b-2" src="{{asset('public/frontend/img/shop/'.Session::get('img_customer'))}}" alt="User profile picture" style="height: 100px;
                                padding-left: 56px;">
                            <h5 class="profile-username text-center" style="padding-right: 38px; padding-top: 10px;">
                                <strong style="color:blue">{{Session::get('customer')->name_customer}}</strong>
                            </h5>
                            @endif
                        </li>
                        <li><a href="{{URL::to('/profile')}}" class = "fa fa-user">Hồ sơ của tôi</a></li>
                        <li><a href="{{URL::to('/profile/update-password')}}" class = "fa fa-lock">Cập nhật mật khẩu</a></li>
                        <li><a href="{{URL::to('/profile/don-hang-cua-ban')}}" class = "fa fa-shopping-cart">Đơn mua hàng</a></li>
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