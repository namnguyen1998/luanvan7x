@include('pages.header')
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/green1.png')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">OGANI</a>
                        <span>SHOP</span>
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
                    <h4>THÔNG TIN SHOP</h4>
                    <ul>
                        <li>
                            <img class="profile-user-img img-responsive img-circle m-b-2" src="{{asset('public/frontend/img/shop/'.Session::get('dataShop')->img_shop)}}" alt="User profile picture" style="height: 100px;padding-left: 12px;">
                            <h5 class="profile-username text-center" style="margin-top: 18px;margin-bottom: 18px;padding-left: 30px;margin-right: 92px;color: blue">
                                {{Session::get('dataShop')->name_shop}}
                            </h5>
                        </li>
                        <li><a href="#" class = "fa fa-shopping-basket">DANH MỤC SHOP</a></li>
                        @foreach($subCateProductShop as $item)
                        <li><a href="#">{{$item->name_sub}}</a></li>
                        @endforeach
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