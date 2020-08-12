
<div id="productSortBy" class="row">
    @foreach($sortByProduct as $pro)
    <div class="col-lg-4 col-md-6 col-sm-6">
        <div class="product__item">
            <div style="width: 270px; height:270px" class="product__item__pic set-bg" data-setbg="{{asset('public/frontend/img/product/'.$pro->img_product)}}">
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

<script src="{{asset('public/frontend/js/main.js')}}"></script>
