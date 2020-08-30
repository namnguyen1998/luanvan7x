@include('pages.header')
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>OGANI</h2>
                        <div class="breadcrumb__option">
                            <a href="{{URL::to('/')}}">Trang chủ</a>
                            <span>Tìm kiếm</span>
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
                   
                </div>
                <div class="col-lg-9 col-md-7">
                    <div class="section-title product__discount__title">
                        <h2>Kết quả tìm kiếm</h2>
                    </div>
                    <div class="product__discount">
                        <div class="row">
                        	@foreach($shopSearch as $shop)
                            <div class="row col-lg-12">
                            	<img src="{{asset('public/frontend/img/shop/'.$shop->img_shop)}}" style="width:100px;height:100px">
                            	<a style="padding-left: 30px; font-size: 30px; color:black;" href="{{URL::to('/shop-ban-hang/'.base64_encode(base64_encode($shop->id_shop)))}}">{{$shop->name_shop}}</a>
                            </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="filter__sort">
                                    <span>Sắp xếp</span>
                                    <select id="sortBySub">
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
                                    <h6>Tìm thấy <span> {{count($productSearch)}}</span> sản phẩm</h6>
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
                        @if (count($productSearch) == 0)
                            <div class="col-lg-12" style="text-align: center; font-size: 200%">Xin lỗi. Chúng tôi không tìm thấy sản phẩm bạn muốn tìm.</div>
                        @else
                        @foreach($productSearch as $pro)
                        <div class="col-lg-4 col-md-6 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{asset('public/frontend/img/product/'.$pro->img_product)}}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($pro->id_product)))}}">{{$pro->name_product}}</a></h6>
                                    <h5>{{number_format($pro->price_product, 0, ',', '.') . " ₫"}}</h5>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  
    <script>
        $(document).ready(function(){   
            $('#sortBySub').on('change', function(){
                sortBySub = document.getElementById('sortBySub').value
                console.log(sortBySub)
                $.ajax({
                    url:"{{URL::to('/sort-by-product-keyword')}}",
                    type:'GET',
                    data: {sortBySub: sortBySub},
                }).done(function(data){
                    if (data == 1)
                        alert('Hệ thống gặp một chút sự cố. Xin thử lại sau.')
                    else {
                        $("#productSortBy").empty();
                        $("#productSortBy").html(data);
                    }
                    
                })
            })
        })
    </script>
    <!-- Product Section End -->
    @include('pages.footer')