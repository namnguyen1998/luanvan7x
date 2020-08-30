@include('pages.header')
 <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{asset('public/frontend/img/green1.png')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>OGANI</h2>
                        <div class="breadcrumb__option">
                            <a href="{{URL::to('/')}}">Trang chủ</a>
                            <span>Giỏ hàng của bạn</span>
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
                    <?php
                        if (!empty(Session::get('message'))){
                            echo'<h4 class = "alert alert-danger">'.Session::get('message').'</h4></br>';
                            Session::put('message', null);
                        }
                    ?>
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
                            <li>Tổng số lượng<span>{{Session::get('Cart')->totalQuantity}}</span></li>
                             <li>TỔNG TIỀN<span>{{number_format(Session::get('Cart')->totalPrice, 0, ',', '.') . " ₫"}}</span></li>
                            @endif
                            
                        </ul>
                        <a href="{{URL::to('/thanh-toan')}}" class="primary-btn">TIẾN HÀNH THANH TOÁN</a>
                    </div>
                </div>
            </div>
            @endif
        </div>
    </section>
@include('pages.footer')
    <script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
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
            // window.location.reload(true);
                    
        }
        function saveItemsCart(id){
            //console.log($("#quantity-item-"+id).val());
            $.ajax({
                url:'save-item-cart/'+id+'/'+$("#quantity-item-"+id).val(),
                type:'GET',
            }).done(function(response){
                if (response == 1)
                    window.location.reload(true);
                else {
                    $("#list-cart").empty();
                    $("#list-cart").html(response);
                //    console.log($("#list-cart").html(response))
                }
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
