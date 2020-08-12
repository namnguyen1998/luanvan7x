@include('pages.header')
 <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/breadcrumb.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>OGANI</h2>
                        <div class="breadcrumb__option">
                            <a href="{{URL::to('/')}}">Trang chủ</a>
                            <span>Thanh toán</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <!-- <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div> -->
            <div class="checkout__form">
                <h4>Thông tin khách hàng</h4>
                <?php
                        if (!empty(Session::get('message'))){
                            echo'<div class = "alert-danger">'.Session::get('message').'</div></br>';
                            Session::put('message', null);
                        }
                    ?>
                <form action="{{URL::to('/tien-hanh-thanh-toan')}}" method="post">
                @csrf
                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            @if ($loadShippingAddrees)
                            <div class="checkout__input">
                                <p>Tên người nhận<span>*</span></p>
                                <input value="{{$loadShippingAddrees->name_recipient}}" placeholder="Tên người nhận hàng." disabled type="text">
                            </div>
                                
                            <div class="checkout__input">
                                <p>Số điện thoại nhận hàng<span>*</span></p>
                                <input type="text" value="{{$loadShippingAddrees->phone_recipient}}" placeholder="Số điện thoại liên hệ nhận hàng." disabled class="checkout__input__add">
                            </div>

                            <div class="checkout__input">
                                <p>Ghi chú với Shop</p>
                                <input name="_note" type="text" placeholder="Ghi chú về đơn hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng.">

                                <!-- note total cart in here -->
                                <input hidden id="totalPrice" value="{{Session::get('Cart')->totalPrice}}" >
                                <input hidden id="totalTotal" name="totalTotal" >
                                <input hidden id="totalShip" name="totalShip" >
                            </div>

                            <div class="checkout__input">
                                <p>Địa chỉ nhận hàng<span>*</span></p>
                                <input name="_address" type="text" value="{{$loadShippingAddrees->address_customer}}" placeholder="Số nhà, tên đường, tên khu vực, phường/Xã" disabled class="checkout__input__add">
                                <input hidden name="_address" type="text" value="{{$loadShippingAddrees->id_address}}">
                                <p><a style="color: #E14C80;" href="{{URL::to('/profile/address')}}">Thiết lập địa chỉ nhận hàng tại đây.</a></p>
                            </div>
                            @else
                            <div class="checkout__input">
                                <p>Tên người nhận<span>*</span></p>
                                <input name="_name" placeholder="Tên người nhận hàng." type="text">
                            </div>
                                
                            <div class="checkout__input">
                                <p>Số điện thoại nhận hàng<span>*</span></p>
                                <input name="_phone" type="text" placeholder="Số điện thoại liên hệ nhận hàng." class="checkout__input__add">
                            </div>

                            <div class="checkout__input">
                                <p>Địa chỉ nhận hàng<span>*</span></p>
                                <input name="_street" type="text" placeholder="Số nhà, tên đường, tên khu vực, phường/Xã" class="checkout__input__add">
                            </div>

                            <div class="checkout__input">
                                <p>Quận/Huyện<span>*</span></p>
                                <input name="_district" type="text">
                            </div>
                            
                            <div class="checkout__input">
                                <p>Tỉnh/Thành phố<span>*</span></p>
                                <input name="_city" type="text">
                            </div>
                            
                            <div class="checkout__input">
                                <p>Ghi chú với Shop</p>
                                <input name="_note" type="text" placeholder="Ghi chú về đơn hàng của bạn, ví dụ: ghi chú đặc biệt để giao hàng.">

                                <!-- note total cart in here -->
                                <input hidden id="totalPrice" value="{{Session::get('Cart')->totalPrice}}" >
                                <input hidden id="totalTotal" name="totalTotal" >
                                <input hidden id="totalShip" name="totalShip" >
                            </div>
                            @endif

                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>ĐƠN HÀNG CỦA BẠN</h4>
                                <div class="checkout__order__products">Sản phẩm <span>TỔNG GIÁ</span></div>
                                <ul>
                                    @foreach (Session::get('Cart')->products as $productCart)
                                        <li>{{$productCart['productInfo']->name_product}}
                                            <span>{{number_format($productCart['price'], 0, ',', '.')}} ₫</span>
                                        </li>
                                    @endforeach
                                </ul>

                                <div class="checkout__order__subtotal">PHÍ VẬN CHUYỂN <span id="ship"></span></div>
                                <div class="checkout__order__total" >TỔNG <span id="total">{{number_format(Session::get('Cart')->totalPrice, 0, ',', '.')}} ₫ </span></div>

                                <div class="checkout__input__checkbox"> Hình thức vận chuyển
                                    <label class="delivery_option clearfix">Giao hàng nhanh
                                        <input id="ship_50" type="radio" name="radio" value="50000" onclick="myFunction()">
                                        <span class="checkmark"></span>
                                        <span class="delivery_price">50.000 ₫</span>
                                    </label>
                                    <label class="delivery_option clearfix">Giao hàng tiêu chuẩn
                                        <input id="ship_22" type="radio" name="radio" value="22000" onclick="myFunction1()">
                                        <span class="checkmark"></span>
                                        <span class="delivery_price">22.000 ₫</span>
                                    </label>
                                    <label class="delivery_option clearfix">Giao hàng tiết kiệm
                                        <input id="ship_0" type="radio" name="radio" value="0" onclick="myFunction2()">
                                        <span class="checkmark"></span>
                                        <span class="delivery_price">0 ₫</span>
                                    </label>

                                </div>
                                
                                <button  id="save" type="submit" class="site-btn">THANH TOÁN</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

    <!-- Script -->
    <script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script>
        function myFunction() {
        var ship, total, convert, subtotal;
        ship = document.getElementById("ship_50").value;
		total = document.getElementById("totalPrice").value;
		convert  = parseInt(ship) + parseInt(total)
		ship = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(ship);
        subtotal = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(convert);
        document.getElementById("ship").innerHTML = ship;
		document.getElementById("total").innerHTML = subtotal;
        document.getElementById("totalTotal").value = convert;
        document.getElementById("totalShip").value = document.getElementById("ship_50").value;
    }

        function myFunction1() {
            var ship, total, convert, subtotal;
            ship = document.getElementById("ship_22").value;
            total = document.getElementById("totalPrice").value;
            convert  = parseInt(ship) + parseInt(total)
            ship = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(ship);
            subtotal = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(convert);
            document.getElementById("ship").innerHTML = ship;
            document.getElementById("total").innerHTML = subtotal;
            document.getElementById("totalTotal").value = convert;
            document.getElementById("totalShip").value = document.getElementById("ship_22").value;
        }

        function myFunction2() {
            var ship, total, convert, subtotal;
            ship = document.getElementById("ship_0").value;
            total = document.getElementById("totalPrice").value;
            convert  = parseInt(ship) + parseInt(total)
            ship = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(ship);
            subtotal = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(convert);
            document.getElementById("ship").innerHTML = ship;
            document.getElementById("total").innerHTML = subtotal;
            document.getElementById("totalTotal").value = convert;
            document.getElementById("totalShip").value = document.getElementById("ship_0").value;
        }
        
        // $("#save").on("click", function(){
        //     $.ajax({
        //         url:'send-email',
        //         type:'GET',
        //     }).done(function(response){           
        //         alertify.success('thành công');
        //     });
        // });
    </script>
@include('pages.footer')