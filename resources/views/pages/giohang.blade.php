@include('pages.header')
<section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/green1.png')}}">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 text-center">
                <div class="breadcrumb__text">
                    <h2>Organi</h2>
                    <div class="breadcrumb__option">
                        <a href="./index.html">OGANI</a>
                        <span>Cart</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Shoping Cart Section Begin -->
<section class="shoping-cart spad">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <?php
                    $content = Cart::content();
                ?>
                <div class="shoping__cart__table">
                    <table>
                        <thead>
                            <tr>
                                <th class="shoping__product">Products</th>
                                <th>Price</th>
                                <th>Quantity</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            @foreach($content as $val_content)
                            <tr>
                                <td class="shoping__cart__item">
                                    <div class="mb-3 mt-3">
                                           SHOP:
                                        <a href="#">
                                          {{$val_content->options->shop}}
                                        </a>
                                    </div>
                                    <img src="{{asset('public/frontend/img/product/'.$val_content->options->image)}}" alt="" style ="width:130px; height:130px" >
                                    <h5>{{$val_content->name}}</h5>
                                </td>
                                <td class="shoping__cart__price">
                                    {{number_format($val_content->price)}}
                                </td>
                                <td class="shoping__cart__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty1">
                                            <input type="number" value="{{$val_content->qty}}">
                                        </div>
                                    </div>
                                </td>
                                <td class="shoping__cart__total">
                                    <?php
                                        $subtotal = $val_content->price * $val_content->qty;
                                        echo number_format($subtotal).'VNĐ';
                                    ?>
                                </td>
                                <td class="shoping__cart__item__close">
                                    <a href="{{URL::to('/delete-cart/'.$val_content->rowId)}}" class="icon_close" style="color: black;" ></a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="shoping__cart__btns">
                    <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                    <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                        Upadate Cart</a>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__continue">
                    <div class="shoping__discount">
                        <h5>Discount Codes</h5>
                        <form action="#">
                            <input type="text" placeholder="Enter your coupon code">
                            <button type="submit" class="site-btn">APPLY COUPON</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="shoping__checkout">
                    <h5>Cart Total</h5>
                    <ul>
                        <li>Subtotal <span>{{Cart::subtotal()}}</span></li>
                        <li>Total <span>{{Cart::total()}}</span></li>
                    </ul>
                    <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                </div>
            </div>
        </div>
    </div>
</section>
    <!-- Shoping Cart Section End -->
@include('pages.footer')