@extends('users.seller.banhang')
@section('content')
<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">

<div id="downloadPDF" class="content-header sty-one">
    <h1>Chi tiết đơn hàng</h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/dashboard')}}">Bán hàng</a></li>
        <li> <a href="{{URL::to('/danh-sach-don-hang')}}"><i class="fa fa-angle-right"></i> Danh sách đơn hàng </a></li>
        <li><i class="fa fa-angle-right"></i> Chi tiết đơn hàng </li>
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
        <div class="invoice"> 
        <!-- title row -->

        <div class="m-b-3">
            <div class="callout callout-info" style="margin-bottom: 0!important;">
                <h4><i class="ti-receipt"></i> GHI CHÚ:</h4>
                {{ $loadOrders->note }}
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12 m-b-3">
            <h3 class="text-black" style="text-align: center"> THÔNG TIN CHI TIẾT ĐƠN HÀNG</h3>
            </div>
            <!-- /.col --> 
        </div>
        <!-- info row -->
        <div class="row invoice-info m-b-3">
            <div class="col-sm-4 invoice-col"> Từ
                <address>
                    <strong>Tên Shop: {{ $loadShop->name_shop }}</strong><br>
                    Địa chỉ: {{ $loadShop->address_shop }}<br>
                    SĐT: {{ $loadShop->phone_shop }}<br>
                    Email: {{ $loadShop->email_shop }}
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col"> Đến
                <address>
                    <strong>Tên Người Nhận: {{ $loadAddressCustomer->name_recipient }}</strong><br>
                    {{ $loadAddressCustomer->address_customer }}<br>
                    SĐT: {{ $loadAddressCustomer->phone_recipient }}<br>
                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-4 invoice-col"> <b>Thông tin khác</b><br>
                <b>Tên khách hàng:</b> {{ $loadOrders->name_customer }}<br>
                <b>Mã đơn hàng:</b> #{{ $loadOrders->id_orders }}<br>
                <b>Ngày đặt hàng:</b> {{ date('d-m-Y', strtotime( $loadOrders->created_at )) }}<br>
             </div>
            <!-- /.col --> 
        </div>
        <!-- /.row --> 
        <?php $number = 1; $total = 0; ?>
        <!-- Table row -->
            <div class="col-xs-12 table-responsive">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th># STT</th>
                    <th># Tên sản phẩm</th>
                    <th># Số lượng</th>
                    <th># Giá</th>
                    <th># Thành tiền</th>
                </tr>
                </thead>
                @foreach ($loadOrderDetail as $orderDetail)
                <tbody>
                    <tr>
                        <td><?php echo $number ++; ?></td>
                        <td>{{ $orderDetail->name_product }}</td>
                        <td>{{ $orderDetail->quantity }}</td>
                        <td>{{ number_format($orderDetail->price_product , 0, ',', '.') . " ₫" }}</td>
                        <td>{{ number_format($orderDetail->price_product * $orderDetail->quantity , 0, ',', '.') . " ₫" }}</td>
                        <?php $total += $orderDetail->price_product * $orderDetail->quantity; ?>
                    </tr>
                </tbody>
                @endforeach
            </table>
            </div>
            <!-- /.col --> 

        <!-- /.row -->
        
        <div class="row"> 
            <!-- accepted payments column -->
            <div  class="col-lg-6">
                <!-- <p class="lead">Payment Methods:</p>
                <img src="dist/img/mastercard.png" alt="Visa"> <img src="dist/img/mastercard.png" alt="Mastercard"> <img src="dist/img/american-express.png" alt="American Express"> <img src="dist/img/paypal2.png" alt="Paypal">
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;"> Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles, weebly ning heekya handango imeem plugg
                    dopplr jibjab, movity jajah plickers sifteo edmodo ifttt zimbra. </p> -->
            </div>
            <!-- /.col -->
            <div class="col-lg-6">
                <p class="lead"><strong style="font-size: 200%; "># THÀNH TIỀN</strong></p>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <th>Tổng GTĐH:</th>
                                <td> <?php echo number_format($total , 0, ',', '.') . " ₫" ?> </td>
                            </tr>
                            <tr>
                                <th >Phí vận chuyển:</th>
                                <td>{{ number_format($loadOrders->shipping_cost , 0, ',', '.') . " ₫" }} <?php $shipping_cost = $loadOrders->shipping_cost; ?></td>
                                <input id="id_orders" value="{{$loadOrders->id_orders}}" hidden>
                            </tr>
                            <tr>
                                <th>Tổng:</th>
                                <td> <?php echo number_format($total + $shipping_cost , 0, ',', '.') . " ₫" ?> </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.col --> 
        </div>
        <!-- /.row --> 
        
        <!-- this row will not appear when printing -->
        <div class="row no-print">
            <div class="col-lg-12">
                <form action="{{URL::to('/in-don-hang')}}" method="get">
                @csrf
                <input name="id_orders" hidden value="{{$loadOrders->id_orders}}"> 
                    <button type="submit" class="btn btn-primary pull-right" style="margin-right: 5px;"> <i class="fa fa-download"></i> In Đơn Hàng </button>
                </form>
                @if ($loadOrders->status_order == 0)
                    <button id="confirm_order" type="submit" class="btn btn-success pull-right" style="margin-right: 5px;"> <i class="fa fa-check"></i> Xác nhận dơn hàng </button>
                @endif
            </div>
            
        </div>
        </div>
        <!-- /.content --> 
    </div>
</div>
<script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  
<script>
    $(document).ready(function(){
        $('#confirm_order').on('click', function(){
        id_orders = document.getElementById("id_orders").value
        // console.log(id_orders)
        $.ajax({
            url:"{{URL::to('/shop-confirm-order')}}",
            data: {id_orders: id_orders},
            type:'GET',
            success: function(){
                $("#confirm_order").attr("hidden", true)
                alert('Xác nhận thành công.');
            },
            error: function(){
                alert('Error');
            }
        })
        })
    })
</script>
@endsection
