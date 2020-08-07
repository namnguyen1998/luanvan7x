@extends('users.seller.banhang')
@section('content')
<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">

<div class="content-header sty-one">
    <h1>Danh sách đơn hàng</h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/dashboard')}}">Bán hàng</a></li>
        <li><i class="fa fa-angle-right"></i>Danh sách đơn hàng</li>
    </ol>
    <div class="row">
        <div class="col-10 ">
                <h4 class="text-black mb-2 mt-2"></h4>
            </div>
    </div class="content-header sty-one">
</div>


<div class="table-responsive">
    <?php
        $number = 1;
        $total_price_order = 0;
    ?>
    <table class="table table-striped">
        <thead>
            <tr style="text-align: center">
                <th scope="col"># STT</th>
                <th scope="col"># Mã đơn hàng</th>
                <th scope="col"># Ngày</th>
                <th scope="col"># Giá trị đơn hàng</th>
                <th scope="col"># Trạng thái</th>
                <th scope="col"># Chi tiết</th>
            </tr>
        </thead>
       @foreach ($loadOrderShop as $order)
        <tbody>
            <tr style="text-align: center">
                <th><?php echo $number ++ ;?></th>
                <td>#{{ $order->orders_id }}</td>
                <td>{{ date('d-m-Y', strtotime( $order->created_at ))}}</td>
                <td>{{ number_format( $order->price_order, 0, ',', '.') . " ₫" }}</td>
                <td>
                    @if ($order->status_order == 0)
                        <span class="label label-warning">Đang chờ duyệt</span>
                    @elseif ($order->status_order == 1)
						<span class="label label-default">Đã duyệt</span>
					@elseif ($order->status_order == -1)
                        <span class="label label-danger">Huỷ</span>
                    @elseif ($order->status_order == 4)
                        <span class="label label-success">Vận chuyển thành công</span>
                    
					@else
						<span class="label label-info">Đang vận chuyển</span>
					@endif
                </td>
                <td><a href="{{URL::to('/chi-tiet-don-hang/'.$order->orders_id)}}"><button class="btn"><span class="ti-github"></span></button></a></td>
            </tr>
        </tbody>
       @endforeach
    </table>
    
</div>
@endsection
