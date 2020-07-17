 <div class="container" id="list-cart">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Update</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(Session::get('Cart')!=null)
                                @foreach(Session::get('Cart')->products as $item)
                                <tr>
                                    <td class="shoping__cart__item">
                                        <img src="{{asset('public/frontend/img/product/'.$item['productInfo']->img_product)}}" alt="" style ="width:130px; height:130px" >
                                        <h5>{{$item['productInfo']->name_product}}</h5>
                                    </td>
                                    <td class="shoping__cart__price">
                                         {{number_format($item['productInfo']->price_product)}}
                                    </td>
                                    <td class="shoping__cart__quantity">
                                        <div class="quantity">
                                            <div class="pro-qty">
                                                <input data-id="{{$item['productInfo']->id_product}}" id="quantity-item-{{$item['productInfo']->id_product}}" type="text" min="0" max="100" value="{{$item['quantity']}}">
                                            </div>
                                        </div>
                                    </td>
                                    <td class="shoping__cart__total">
                                        {{number_format($item['price'])}}VNĐ
                                    </td>
                                    <td class="shoping__cart__item__save" >
                                        <span class="fa fa-floppy-o" style="margin-left:40px;margin-right:40px"onclick="saveItemsCart({{$item['productInfo']->id_product}});"></span>
                                    </td>
                                    <td class="shoping__cart__item__close" id="change-items-cart">
                                        <span class="icon_close" onclick="deleteItemsCart({{$item['productInfo']->id_product}});"></span>
                                    </td>
                                </tr>
                                @endforeach
                                @endif
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
                            @if(Session::get('Cart')!=null)
                            <li>Total Quantity<span>{{Session::get('Cart')->totalQuantity}}</span></li>
                            <li>Total <span>{{number_format(Session::get('Cart')->totalPrice)}} VND</span></li>
                            @endif
                            
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
        <script>
        var proQty = $('.pro-qty');
        proQty.prepend('<span class="dec qtybtn">-</span>');
        proQty.append('<span class="inc qtybtn">+</span>');
        proQty.on('click', '.qtybtn', function () {
            var $button = $(this);
            var oldValue = $button.parent().find('input').val();
            if ($button.hasClass('inc')) {
                var newVal = parseFloat(oldValue) + 1;
            } else {
                // Don't allow decrementing below zero
                if (oldValue > 0) {
                    var newVal = parseFloat(oldValue) - 1;
                } else {
                    newVal = 0;
                }
            }
            $button.parent().find('input').val(newVal);
        });
        
        </script>