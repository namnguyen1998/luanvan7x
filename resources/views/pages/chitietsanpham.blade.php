@include('pages.header')
<section class="product-details spad">
        <div class="container">
            <div class="row">
                @foreach($productByID as $product)
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__pic">
                        <div class="product__details__pic__item">
                            <img class="product__details__pic__item--large"
                                src="{{asset('public/frontend/img/product/'.$product->img_product)}}" alt="">
                        </div>
                        <div class="product__details__pic__slider owl-carousel">
                            <img data-imgbigurl="{{asset('public/frontend/img/product/'.$product->img1_product)}}"
                                src="{{asset('public/frontend/img/product/'.$product->img1_product)}}" alt="">
                            <img data-imgbigurl="{{asset('public/frontend/img/product/'.$product->img2_product)}}"
                                src="{{asset('public/frontend/img/product/'.$product->img2_product)}}" alt="">
                            <img data-imgbigurl="{{asset('public/frontend/img/product/'.$product->img3_product)}}"
                                src="{{asset('public/frontend/img/product/'.$product->img3_product)}}" alt="">
                            <img data-imgbigurl="{{asset('public/frontend/img/product/'.$product->img_product)}}"
                                src="{{asset('public/frontend/img/product/'.$product->img_product)}}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6">
                    <div class="product__details__text">
                        <h3>{{$product->name_product}}</h3>
                        <div class="product__details__rating">
                            <!-- <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i> -->
                            <span>({{count($listComments)}} bình luận)</span>
                        </div>
                        <div class="product__details__price">{{number_format($product->price_product, 0, ',', '.') . " ₫"}}</div>
                        <p>{{$product->note_product}}</p>
                        <input type="hidden" value="{{$product->id_product}}" name="id_product">
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" name="qty"  min="1" value="1" id="quantity-item-{{$product->id_product}}">
                                        <input type="hidden" name="productid_hidden" value="{{$product->id_product}}">
                                    </div>
                                </div>
                            </div>
                            <div class="btn btn-success">
                            <i class="fa fa-shopping-cart"><a onClick="AddCart({{$product->id_product}})" href="javascript:" style="color:white"> THÊM VÀO GIỎ HÀNG</a></i>
                            </div>
                            <!-- <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a> -->
                        <ul>
                            <li><b>THÔNG TIN SHOP</b> <span>{{$product->name_shop}}</span>
                                <a href="{{URL::to('/shop-ban-hang/'.base64_encode(base64_encode($product->id_shop)))}}" class="btn btn-primary" style="margin-left:10px">Xem shop</a>
                            </li>
                            <li><b>Địa chỉ</b> <span>{{$product->address_shop}}</span></li>
                            <!-- <li><b>Weight</b> <span>0.5 kg</span></li> -->
                            <li><b>Chia sẻ</b>
                                <div class="share">
                                    <a href="#"><i class="fa fa-facebook"></i></a>
                                    <a href="#"><i class="fa fa-twitter"></i></a>
                                    <a href="#"><i class="fa fa-instagram"></i></a>
                                    <a href="#"><i class="fa fa-pinterest"></i></a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="product__details__tab">
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                    aria-selected="true">Mô tả</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                    aria-selected="false">Bình luận <span>({{count($listComments)}})</span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                <div class="product__details__tab__desc">
                                    <h6>Mô tả</h6>
                                    <p>{!!$product->description_product!!}</p>
                                </div>
                            </div>
                            <div class="tab-pane" id="tabs-3" role="tabpanel">
                                @if(Session::get('id_customer')!=null)
                                <div class="product__details__tab__desc">
                                    <div class="col-md-6 offset-md-3">
                                        <form action="{{URL::to('/postComment')}}" method="POST">
                                        <input type="hidden" name="_token" value="{{csrf_token()}}" >
                                        <input type="hidden" value="{{$product->id_product}}" name="id_product">
                                            <h6>Viết bình luận của bạn</h6>
                                            <textarea name="content" class="form-control" placeholder="Viết bình luận" required></textarea>
                                            <button type="submit" class="btn btn-success float-right">Đăng</button>
                                        </form>
                                    </div>
                                </div>
                                @endif
                                @foreach($listComments as $comment)
                                <div class="product__details__tab__desc">
                                    <div class="row">
                                        <img class="w-100" src="">
                                        <h6>{{$comment->name_customer}}<h6>
                                    </div>
                                    <p>Ngày: {{date('d-m-Y H:i:s', strtotime($comment->created_at))}}</p>
                                    <span>Nội dung: {!!$comment->content!!}</span>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Product Details Section End -->

    <!-- Related Product Section Begin -->
    <section class="related-product">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title related__product__title">
                        <h2>Sản phẩm liên quan</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                 @foreach($productsRalated as $pro)
                <div class="col-lg-3 col-md-4 col-sm-6">    
                    <div class="product__item">
                        <div class="product__item__pic set-bg" data-setbg="{{asset('public/frontend/img/product/'.$pro->img_product)}}">
                            <ul class="product__item__pic__hover">
                                <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                            </ul>
                        </div>
                        <div class="product__item__text">
                            <h6><a href="{{URL::to('/chi-tiet-san-pham/'.$pro->id_product)}}">{{$pro->name_product}}</a></h6>
                            <h5>{{number_format($pro->price_product)}}</h5>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        function AddCart(id){
            $.ajax({
                url:'add-cart-quantity/'+id + '/' + $("#quantity-item-"+id).val(),
                type:'GET',
            }).done(function(response){
                document.getElementById("total-quantity-show").innerHTML = parseInt(response)
            
            });
            alertify.success('Đã thêm sản phẩm vào giỏ hàng');
            
        }
    </script>
    <!-- Related Product Section End -->
    @include('pages.footer')