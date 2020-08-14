@extends('users.seller.banhang')
@section('content')
<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">

<div id="downloadPDF" class="content-header sty-one">
    <h1>Thông tin Shop</h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
        <li> <a href="{{URL::to('/admin-danh-sach-shop')}}"><i class="fa fa-angle-right"></i> Danh sách Shop </a></li>
        <li><i class="fa fa-angle-right"></i> Danh sách sản phẩm shop </li>
    </ol>
    <div class="row">
        <div class="col-10 ">
                <h4 class="text-black mb-2 mt-2"></h4>
            </div>
    </div class="content-header sty-one">
</div>

<br>

<div class="card"> 
    <div class="card-body">
        <!-- Main content -->
   
        <!-- info row -->
        <div class="row invoice-info m-b-3">
            <div class="col-sm-4 invoice-col">
                <address>
                    <strong>Tên: {{ $loadShop->name_shop }}</strong><br>
                    Địa chỉ: {{ $loadShop->address_shop }}<br>
                    SĐT: {{ $loadShop->phone_shop }}<br>
                    Email: {{ $loadShop->email_shop }}
                </address>
            </div>
            <!-- /.col -->
            
        </div>
        <!-- /.row --> 
        <?php $number = 1; ?>
        <!-- Table row -->
            <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th># STT</th>
                    <th># Ngày đăng</th>
                    <th># Tên sản phẩm</th>
                    <th># Giá</th>
                    <th># Hình</th>
                </tr>
                </thead>
                @foreach ($loadProductShop as $productShop)
                <tbody>
                    <tr>
                        <td><?php echo $number ++; ?></td>
                        <td>{{ date('d-m-Y H:i:s', strtotime( $productShop->created_at )) }}</td>
                        <td>{{ $productShop->name_product }}</td>
                        <td>{{ number_format( $productShop->price_product, 0, ',', '.') . " ₫" }}</td>
                        <td>
                        <img src='{{asset("public/frontend/img/product/$productShop->img_product")}}' height="70" width="70">
                            <?php
                                if(($productShop->img1_product)!=null){
                            ?>
                            <img src='{{asset("public/frontend/img/product/$productShop->img1_product")}}' height="70" width="70">
                            <?php 
                                }
                            ?>
                            <?php
                                if(($productShop->img2_product)!=null){
                            ?>
                            <img src='{{asset("public/frontend/img/product/$productShop->img2_product")}}' height="70" width="70">
                            <?php 
                                }
                            ?>
                            <?php
                                if(($productShop->img3_product)!=null){
                            ?>
                            <img src='{{asset("public/frontend/img/product/$productShop->img3_product")}}' height="70" width="70">
                            <?php 
                                }
                            ?>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <span>{!!$loadProductShop->render() !!}</span>
            </div>
            <!-- /.col --> 

    </div>
</div>

@endsection
