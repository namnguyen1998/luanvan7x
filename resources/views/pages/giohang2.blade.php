@include('pages.header')
 <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/green1.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
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
                        <a href="#" class="primary-btn cart-btn cart-btn-right" id="edit-all"><span class="icon_loading"></span>
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
    </section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


    <script type="text/javascript">
        function deleteItemsCart(id){
            $.ajax({
                url:'delete-cart/'+id,
                type:'GET',
            }).done(function(response){               
               $("#list-cart").empty();
               $("#list-cart").html(response);
            });
            alertify.success('Xóa sản phẩm thành công');
                    
        }
        function saveItemsCart(id){
            //console.log($("#quantity-item-"+id).val());
            $.ajax({
                url:'save-item-cart/'+id+'/'+$("#quantity-item-"+id).val(),
                type:'GET',
            }).done(function(response){               
               $("#list-cart").empty();
               $("#list-cart").html(response);
            });
            alertify.success('Cập nhật sản phẩm thành công');
                    
        }
        $("#edit-all").on("click", function(){
            var list = [];
            $("table tbody tr td").each(function(){
                $(this).find("input").each(function(){
                    var element = {key: $(this).data("id"), value: $(this).val()};
                    list.push(element);
                });
            });
            $.ajax({
                url:'save-all-cart',
                type:'POST',
                data:{
                    "_token" : "{{ csrf_token() }}",
                    "data" : list
                }
            }).done(function(response){               
               location.reload(); 
            });
            alertify.success('Cập nhật sản phẩm thành công');
        });


    </script>

    <!-- Shoping Cart Section End -->
<!-- @include('pages.footer') -->