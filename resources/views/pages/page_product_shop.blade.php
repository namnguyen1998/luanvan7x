@extends('pages.shop')
@section('content')
<div class="col-lg-9 col-md-7">
    <!-- <div class="product__discount">
        <div class="section-title product__discount__title">
            <h2>Sale Off</h2>
        </div>
        <div class="row">
            <div class="product__discount__slider owl-carousel">
                <div class="col-lg-4">
                    <div class="product__discount__item">
                        <div class="product__discount__item__pic set-bg"
                            data-setbg="{{asset('public/frontend/img/product/discount/pd-1.jpg')}}">
                            <div class="product__discount__percent">-20%</div>
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__discount__item__text">
                            <span>Dried Fruit</span>
                            <h5><a href="#">Raisin’n’nuts</a></h5>
                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product__discount__item">
                        <div class="product__discount__item__pic set-bg"
                            data-setbg="{{asset('public/frontend/img/product/discount/pd-2.jpg')}}">
                            <div class="product__discount__percent">-20%</div>
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__discount__item__text">
                            <span>Vegetables</span>
                            <h5><a href="#">Vegetables’package</a></h5>
                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product__discount__item">
                        <div class="product__discount__item__pic set-bg"
                            data-setbg="{{asset('public/frontend/img/product/discount/pd-3.jpg')}}">
                            <div class="product__discount__percent">-20%</div>
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__discount__item__text">
                            <span>Dried Fruit</span>
                            <h5><a href="#">Mixed Fruitss</a></h5>
                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product__discount__item">
                        <div class="product__discount__item__pic set-bg"
                            data-setbg="{{asset('public/frontend/img/product/discount/pd-4.jpg')}}">
                            <div class="product__discount__percent">-20%</div>
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__discount__item__text">
                            <span>Dried Fruit</span>
                            <h5><a href="#">Raisin’n’nuts</a></h5>
                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product__discount__item">
                        <div class="product__discount__item__pic set-bg"
                            data-setbg="{{asset('public/frontend/img/product/discount/pd-5.jpg')}}">
                            <div class="product__discount__percent">-20%</div>
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__discount__item__text">
                            <span>Dried Fruit</span>
                            <h5><a href="#">Raisin’n’nuts</a></h5>
                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="product__discount__item">
                        <div class="product__discount__item__pic set-bg"
                            data-setbg="{{asset('public/frontend/img/product/discount/pd-6.jpg')}}">
                            <div class="product__discount__percent">-20%</div>
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__discount__item__text">
                            <span>Dried Fruit</span>
                            <h5><a href="#">Raisin’n’nuts</a></h5>
                            <div class="product__item__price">$30.00 <span>$36.00</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
    <div class="filter__item">
        <div class="row">
            <div class="col-lg-4 col-md-5">
                <div class="filter__sort">
                    <span>Sort By</span>
                    <select>
                        <option value="0">Default</option>
                        <option value="0">Default</option>
                    </select>
                </div>
            </div>
            <div class="col-lg-4 col-md-4">
                <div class="filter__found">
                    <h6>Có tất cả <span> {{count($productShop)}}</span>sản phẩm trong shop</h6>
                </div>
            </div>
            <div class="col-lg-4 col-mproductCategoryd-3">
                <div class="filter__option">
                    <span class="icon_grid-2x2"></span>
                    <span class="icon_ul"></span>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($productShop as $pro)
        <div class="col-lg-4 col-md-6 col-sm-6">
            <div class="product__item">
                <div class="product__item__pic set-bg" data-setbg="{{asset('public/frontend/img/product/'.$pro->img_product)}}">
                    <ul class="product__item__pic__hover">
                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                    </ul>
                </div>
                <div class="product__item__text">
                    <h6><a href="{{URL::to('/chi-tiet-san-pham/'.$pro->id_product)}}">{{$pro->name_product}}</a></h6>
                    <h5>{{number_format($pro->price_product, 0, ',', '.') . " ₫"}}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div>
        {!!$productShop->render()!!}
    </div>
</div>
@endsection