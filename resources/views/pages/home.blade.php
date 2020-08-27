@include('pages.header')
 <section class="hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="hero__categories">
                        <div class="hero__categories__all">
                            <i class="fa fa-bars"></i>
                            <span>Danh sách danh mục</span>
                        </div>
                        <ul>
                            @foreach($Category as $category)
                            <li><a href="{{URL::to('/danh-muc-'.base64_encode(base64_encode($category->id_category)))}}">
                                <img src="{{asset('public/frontend/img/categories/'.$category->icon_category)}}" 
                                style="padding-right:10px;width:30px"/>
                                     {{$category->name_category}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-lg-9">     
                    <div class="col-lg-12" style="width: 100%;">
                        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                          <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                          </ol>
                          <div class="carousel-inner">
                            <div class="carousel-item active">
                              <img class="d-block w-100" src="{{asset('public\frontend\img\banner\banner-1.jpg')}}" alt="First slide">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{asset('public\frontend\img\banner\banner-2.jpg')}}" alt="Second slide">
                            </div>
                            <div class="carousel-item">
                              <img class="d-block w-100" src="{{asset('public\frontend\img\banner\banner-1.jpg')}}" alt="Third slide">
                            </div>
                          </div>
                          <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                          </a>
                          <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                          </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </section>
    <!-- Categories Section Begin -->
    <section class="categories">
        <div class="container">
            <div class="row">
                <div class="categories__slider owl-carousel">
                    @foreach($Category as $cat)
                    <div class="col-lg-3">
                        <div class="categories__item set-bg" data-setbg="{{asset('public/frontend/img/categories/'.$cat->img_category)}}">
                            <h5><a href="{{URL::to('/danh-muc-'.base64_encode(base64_encode($cat->id_category)))}}">{{$cat->name_category}}</a></h5>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
    <!-- Categories Section End -->

    <!-- Featured Section Begin -->
    <section class="featured spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Sản phẩm</h2>
                    </div>
                    <div class="featured__controls">
                        <!-- <ul>
                            <li class="active" data-filter="*">All</li>
                            <li data-filter=".oranges">Oranges</li>
                            <li data-filter=".fresh-meat">Fresh Meat</li>
                            <li data-filter=".vegetables">Vegetables</li>
                            <li data-filter=".fastfood">Fastfood</li>
                        </ul> -->
                    </div>
                </div>
            </div>
            <div class="row featured__filter">
                @foreach($listProducts as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mix oranges fresh-meat">
                    <div class="featured__item">
                        <div class="featured__item__pic set-bg" data-setbg="{{asset('public/frontend/img/product/'.$product->img_product)}}">
                            <ul class="featured__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                <li><a onClick="AddCart({{$product->id_product}})" href="javascript:"><i class="fa fa-shopping-cart"></i></a></li>
                            </ul>
                        </div>
                        <div class="featured__item__text">
                            <h6><a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($product->id_product)))}}">{{$product->name_product}}</a></h6>
                            <h5>{{number_format($product->price_product, 0, ',', '.') . " ₫"}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <span>{!!$listProducts->render() !!}</span>
        </div>
    </section>
    <!-- Featured Section End -->

    <!-- Banner Begin -->
    <div class="banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{asset('public/frontend/img/banner/banner-1.jpg')}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="banner__pic">
                        <img src="{{asset('public/frontend/img/banner/banner-2.jpg')}}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Banner End -->

    <!-- Latest Product Section Begin -->
    <section class="latest-product spad">
        <div class="container">
            <div class="row">

            @if (empty($getScanProductClient5))

                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>SP bán chạy nhất</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($listTopProduct5 as $topProduct)
                                <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)))}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$topProduct->name_product}}</h6>
                                        <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                        <p>{{ number_format($topProduct->topProduct, 0, ',', '.')}} Lượt</p>
                                    </div>
                                </a>
                                @endforeach
                                
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($listTopProduct10 as $topProduct)
                                <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)))}}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$topProduct->name_product}}</h6>
                                        <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                        <p>{{ number_format($topProduct->topProduct, 0, ',', '.')}} Lượt</p>
                                    </div>
                                </a>
                                @endforeach
                            </div>
                           
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>SP dành cho bạn</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($listProductsRelated5 as $topProduct)
                                <a href="{{ URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)) ) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$topProduct->name_product}}</h6>
                                        <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                        
                                    </div>
                                </a>
                                @endforeach
                                
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($listProductsRelated10 as $topProduct)
                                <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)) ) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$topProduct->name_product}}</h6>
                                        <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                       
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="latest-product__text">
                        <h4>SP mới</h4>
                        <div class="latest-product__slider owl-carousel">
                            <div class="latest-prdouct__slider__item">
                                @foreach ($listNewProduct5 as $topProduct)
                                <a href="{{ URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)) ) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$topProduct->name_product}}</h6>
                                        <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                        
                                    </div>
                                </a>
                                @endforeach
                                
                            </div>
                            <div class="latest-prdouct__slider__item">
                                @foreach ($listNewProduct10 as $topProduct)
                                <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)) ) }}" class="latest-product__item">
                                    <div class="latest-product__item__pic">
                                        <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                    </div>
                                    <div class="latest-product__item__text">
                                        <h6>{{$topProduct->name_product}}</h6>
                                        <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                       
                                    </div>
                                </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>


            @else
                <div class="col-lg-3 col-md-6">
                        <div class="latest-product__text">
                            <h4>SP bán chạy nhất</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($listTopProduct5 as $topProduct)
                                    <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)))}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$topProduct->name_product}}</h6>
                                            <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                            <p>{{ number_format($topProduct->topProduct, 0, ',', '.')}} Lượt</p>
                                        </div>
                                    </a>
                                    @endforeach
                                    
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($listTopProduct10 as $topProduct)
                                    <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)))}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$topProduct->name_product}}</h6>
                                            <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                            <p>{{ number_format($topProduct->topProduct, 0, ',', '.')}} Lượt</p>
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-3 col-md-6">
                        <div class="latest-product__text">
                            <h4>SP bạn vừa xem</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($getScanProductClient5 as $scanProduct)
                                    <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($scanProduct->id_product)))}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$scanProduct->img_product)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$scanProduct->name_product}}</h6>
                                            <span>{{number_format($scanProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                        
                                        </div>
                                    </a>
                                    @endforeach
                                    
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($getScanProductClient10 as $scanProduct)
                                    <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($scanProduct->id_product)))}}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$scanProduct->img_product)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$scanProduct->name_product}}</h6>
                                            <span>{{number_format($scanProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                        
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="latest-product__text">
                            <h4>SP dành cho bạn</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($listProductsRelated5 as $topProduct)
                                    <a href="{{ URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)) ) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$topProduct->name_product}}</h6>
                                            <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                            
                                        </div>
                                    </a>
                                    @endforeach
                                    
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($listProductsRelated10 as $topProduct)
                                    <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)) ) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$topProduct->name_product}}</h6>
                                            <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                        
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="latest-product__text">
                            <h4>SP mới</h4>
                            <div class="latest-product__slider owl-carousel">
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($listNewProduct5 as $topProduct)
                                    <a href="{{ URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)) ) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$topProduct->name_product}}</h6>
                                            <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                            
                                        </div>
                                    </a>
                                    @endforeach
                                    
                                </div>
                                <div class="latest-prdouct__slider__item">
                                    @foreach ($listNewProduct10 as $topProduct)
                                    <a href="{{URL::to('/chi-tiet-san-pham/'.base64_encode(base64_encode($topProduct->id_product)) ) }}" class="latest-product__item">
                                        <div class="latest-product__item__pic">
                                            <img style="width: 100px; height: 100px" src="{{asset('public/frontend/img/product/'.$topProduct->img_product)}}" alt="">
                                        </div>
                                        <div class="latest-product__item__text">
                                            <h6>{{$topProduct->name_product}}</h6>
                                            <span>{{number_format($topProduct->price_product, 0, ',', '.') . " ₫"}}</span>
                                        
                                        </div>
                                    </a>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>

                
                @endif

            </div>
        </div>
    </section>
    <!-- Latest Product Section End -->

    <!-- Blog Section Begin -->
    <section class="from-blog spad">
        <!-- <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title from-blog__title">
                        <h2>From The Blog</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('public/frontend/img/blog/blog-1.jpg')}}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Cooking tips make cooking simple</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('public/frontend/img/blog/blog-2.jpg')}}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6">
                    <div class="blog__item">
                        <div class="blog__item__pic">
                            <img src="{{asset('public/frontend/img/blog/blog-3.jpg')}}" alt="">
                        </div>
                        <div class="blog__item__text">
                            <ul>
                                <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                <li><i class="fa fa-comment-o"></i> 5</li>
                            </ul>
                            <h5><a href="#">Visit the clean farm in the US</a></h5>
                            <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                        </div>
                    </div>
                </div>
            </div>
        </div> -->
       @if(Session::get('Cart')!=null)
       <input type="hidden" id="total-quantity-cart" type="number" value="{{Session::get('Cart')->totalQuantity}}">
       @endif
    </section>
    <!-- Blog Section End -->
    
    <script>
        function AddCart(id){
            $.ajax({
                url:'add-cart/'+id,
                type:'GET',
            }).done(function(response){
                // console.log(response);
                $("#list-cart").empty();
                $("#list-cart").html(response);
                // $("#total-quantity-show").in
                // console.log(response)
                document.getElementById("total-quantity-show").innerHTML = parseInt(response)
            });
            alertify.success('Đã thêm sản phẩm vào giỏ hàng');
            
        }
    </script>

   @include('pages.footer')

  