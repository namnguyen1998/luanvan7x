 <div class="container" id="list-cart">
    <div class="row">
        <div class="col-lg-12">
            <div class="shoping__cart__table">
            @if(Session::get('Cart')==null)
                <div style="text-align: center">
                    <img src="public/frontend/img/cart/empty-cart.png">
                </div>
                <div style="text-align: center; font-size: 100px; background-color: lightblack">
                    <a style="color:#A8AFB1;"  href="{{URL::to('/')}}">Quay về trang chủ.</a>
                </div>
            @else
                <table>
                    <thead>
                        <tr>
                            <th class="shoping__product">Sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                            <th>Cập nhật</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @foreach(Session::get('Cart')->products as $item)
                        <tr>
                            <td class="shoping__cart__item">
                                <img src="{{asset('public/frontend/img/product/'.$item['productInfo']->img_product)}}" alt="" style ="width:130px; height:130px" >
                                <h5>{{$item['productInfo']->name_product}}</h5>
                            </td>
                            <td class="shoping__cart__price">
                                    {{number_format($item['productInfo']->price_product, 0, ',', '.') . " ₫"}}
                            </td>
                            <td class="shoping__cart__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input data-id="{{$item['productInfo']->id_product}}" id="quantity-item-{{$item['productInfo']->id_product}}" type="text" min="0" max="100" value="{{$item['quantity']}}">
                                    </div>
                                </div>
                            </td>
                            <td class="shoping__cart__total">
                                {{number_format($item['price'], 0, ',', '.') . " ₫"}}
                            </td>
                            <td class="shoping__cart__item__save" >
                                <span class="fa fa-floppy-o" style="margin-left:40px;margin-right:40px"onclick="saveItemsCart({{$item['productInfo']->id_product}});"></span>
                            </td>
                            <td class="shoping__cart__item__close" id="change-items-cart">
                                <span class="icon_close" onclick="deleteItemsCart({{$item['productInfo']->id_product}});"></span>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="row">
        
        <div class="col-lg-4">
            
        </div>
        <div class="col-lg-8">
            <div class="shoping__checkout">
                <h2 style="text-align: center">TỔNG GIỎ HÀNG</h2>
                <ul>
                    @if(Session::get('Cart')!=null)
                    <li id="qtyCart" value="{{Session::get('Cart')->totalQuantity}}" >Tổng số lượng<span>{{Session::get('Cart')->totalQuantity}}</span></li>
                    <li>TỔNG TIỀN <span>{{number_format(Session::get('Cart')->totalPrice, 0, ',', '.') . " ₫"}}</span></li>
                    @endif
                    
                </ul>
                <a href="{{URL::to('/thanh-toan')}}" class="primary-btn">TIẾN HÀNH THANH TOÁN</a>
            </div>
        </div>
    </div>
    @endif
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

    val_address = document.getElementById("qtyCart").value
    document.getElementById("total-quantity-show").innerHTML = val_address
</script>