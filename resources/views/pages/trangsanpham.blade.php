@include('pages.header')
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>OGANI</h2>
                        <div class="breadcrumb__option">
                            <a href="{{URL::to('/')}}">Trang chủ</a>
                            <span>Danh mục</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>LOẠI DANH MỤC</h4>
                            <ul>
                                @foreach($subCategorybyCategory as $sub)
                                <li>
                                    <a href="{{URL::to('/danh-muc-'.base64_encode(base64_encode($sub->category_id)).'/sub-'.base64_encode(base64_encode($sub->id_sub)))}}">{{$sub->name_sub}}</a>
                                </li>
                                @endforeach
                            </ul>
                            
                        </div>
                        <div class="sidebar__item">
                            <h4>Chọn giá</h4>
                            <div class="price-range-wrap">
                                <div id="price" class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="100000" data-max="10000000"  step="200.000">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div style="width: 120%" class="price-input">
                                        <input type="text" id="minamount1">
                                        <input type="text" id="maxamount1">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{asset('public/frontend/img/latest-product/lp-1.jpg')}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{asset('public/frontend/img/latest-product/lp-2.jpg')}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{asset('public/frontend/img/latest-product/lp-3.jpg')}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="latest-prdouct__slider__item">
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{asset('public/frontend/img/latest-product/lp-1.jpg')}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{asset('public/frontend/img/latest-product/lp-2.jpg')}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                        <a href="#" class="latest-product__item">
                                            <div class="latest-product__item__pic">
                                                <img src="{{asset('public/frontend/img/latest-product/lp-3.jpg')}}" alt="">
                                            </div>
                                            <div class="latest-product__item__text">
                                                <h6>Crab Pool Security</h6>
                                                <span>$30.00</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                    </div>
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Danh sách hãng</h2>
                        </div>
                        <div class="row">
                            <div class="product__discount__slider owl-carousel">
                                @foreach ($loadBrand as $brand)
                                <div class="col-lg-4">
                                    <div class="product__discount__item">
                                        <div class="product__discount__item__pic set-bg"
                                            data-setbg="{{asset('public/frontend/img/brand/'.$brand->logo_brand)}}">
                                            <!--<div class="product__discount__percent"></div>-->
                                            <!--<ul class="product__item__pic__hover">-->
                                            <!--    <li><a href="#"><i class="fa fa-heart"></i></a></li>-->
                                            <!--    <li><a href="#"><i class="fa fa-retweet"></i></a></li>-->
                                            <!--    <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>-->
                                            <!--</ul>-->
                                        </div>
                                        <div class="product__discount__item__text">
                                            <!--<span>Dried Fruit</span>-->
                                            <h5><a href="#">{{$brand->name_brand}}</a></h5>
                                            <!--<div class="product__item__price">$30.00 <span>$36.00</span></div>-->
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sắp xếp</span>
                                    <select id="sortBy">
                                        <option value="0">Mặc định</option>
                                        <option value="price_product ASC">Sắp xếp giá Thấp - Cao</option>
                                        <option value="price_product DESC">Sắp xếp giá Cao - Thấp</option>
                                        <option value="name_product ASC">Sắp xếp tên A - Z</option>
                                        <option value="name_product DESC">Sắp xếp tên Z - A</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6>Hiển thị <span> {{count($productCategory)}}</span></h6>
                                </div>
                            </div>
                            <div class="col-lg-4 col-mproductCategoryd-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <!-- <span class="icon_ul"></span> -->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="productSortBy" class="row">
                        @if (count($productCategory)==0)
                            <div class="col-lg-12" style="text-align: center; font-size: 200%">Không có sản phẩm</div>
                        @else
                        @foreach($productCategory as $pro)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{asset('public/frontend/img/product/'.$pro->img_product)}}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{URL::to('/chi-tiet-san-pham/'. base64_encode(base64_encode($pro->id_product)))}}">{{$pro->name_product}}</a></h6>
                                    <h5>{{number_format($pro->price_product, 0, ',', '.') . " ₫"}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                    <span>
                        {!!$productCategory->render()!!}
                    </span>
               
                </div>
            </div>
        </div>
    </section>
    <script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  
    <script>
        $(document).ready(function(){
            var rangeSlider = $("#price"),
                minamount = $("#minamount1"),
                maxamount = $("#maxamount1"),
                minPrice = rangeSlider.data('min'),
                maxPrice = rangeSlider.data('max');
            rangeSlider.slider({
                range: true,
                min: minPrice,
                max: maxPrice,
                values: [minPrice, maxPrice],
                slide: function (event, ui) {
                    minamount.val(ui.values[0] + ' VNĐ' );
                    maxamount.val(ui.values[1] + ' VNĐ' );
                }
            });
            minamount.val(rangeSlider.slider("values", 0) + ' VNĐ');
            maxamount.val(rangeSlider.slider("values", 1) + ' VNĐ');


            $('#sortBy').on('change', function(){
                sortBy = document.getElementById('sortBy').value
                // console.log(sortBy)
                $.ajax({
                    url:"{{URL::to('/sort-by-product-categories')}}",
                    type:'GET',
                    data: {sortBy: sortBy},
                }).done(function(data){
                    if (data == 1)
                        alert('Hệ thống gặp một chút sự cố. Xin thử lại sau.')
                    else{
                        $("#productSortBy").empty();
                        $("#productSortBy").html(data);}
                })
            })
        })
    </script>
    <!-- Product Section End -->
    @include('pages.footer')