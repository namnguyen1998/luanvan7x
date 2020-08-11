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
        <div style="text-align: center">
            <img src="public/frontend/img/cart/thanks.jpg">
            
        </div>
        <div style="text-align: center; color:#A8AFB1; font-size: 50px; background-color: lightblack">
            Cảm ơn Bạn đã đặt sản phẩm của chúng tôi.
        </div>

        <div style="text-align: center; font-size: 50px; background-color: lightblack">
            <a style="color:#A8AFB1;"  href="{{URL::to('/')}}"> Quay về trang chủ</a>
        </div>

    </section>

    <script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
    <script>
        $(document).ready( function(){
            $.ajax({
                url:'send-email',
                type:'GET',
                success: function(){
                    alert('Xoá thành công.');
                },
            })
        });
    </script>

    <!-- Shoping Cart Section End -->
@include('pages.footer')