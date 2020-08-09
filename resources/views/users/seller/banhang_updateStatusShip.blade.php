@extends('users.seller.banhang')
@section('content')
<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">

<div class="content-header sty-one">
    <h1>Cập nhật trạng thái vận chuyển</h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/dashboard')}}">Bán hàng</a></li>
        <li><i class="fa fa-angle-right"></i>Cập nhật trạng thái vận chuyển</li>
    </ol>
    <div class="row">
        <div class="col-10 ">
                <h4 class="text-black mb-2 mt-2"></h4>
            </div>
    </div class="content-header sty-one">
</div>
<?php
    if (!empty(Session::get('message'))){
        echo'<div class = "alert-success">'.Session::get('message').'</div></br>';
        Session::put('message', null);
    }
  ?>
<div id="load_updateStatusShip" class="table-responsive">
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
                <th scope="col"># Cập nhật</th>
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
                <form action="{{URL::to('/shop-update-status-ship')}}" method="get">
                    <td>
                        <input hidden name="id_orders" value="{{$order->orders_id}}">
                        <select name="status_order" id="status_order">
                            @if ($order->status_order == 1)
                                <option value="1">Đã duyệt</option>
                                <option value="2">Tiến hàng vận chuyển</option>
                                <option value="3">Đang vận chuyển</option>
                                <option value="4">Vận chuyển thành công</option>
                            @elseif ($order->status_order == 2)
                                <option value="2">Tiến hàng vận chuyển</option>
                                <option value="3">Đang vận chuyển</option>
                                <option value="4">Vận chuyển thành công</option>
                                @elseif ($order->status_order == 3)
                                <option value="3">Đang vận chuyển</option>
                                <option value="4">Vận chuyển thành công</option>
                            @else
                                <option value="4">Vận chuyển thành công</option>
                            @endif
                        </select>
                    </td>
                    <td><a href="{{URL::to('/shop-update-status-ship')}}"><button id="updateStatus" class="btn"><span class="fa fa-check"></span></button></a></td>
                </form>
                <td><a href="{{URL::to('/chi-tiet-don-hang/'.$order->orders_id)}}"><button class="btn"><span class="ti-github"></span></button></a></td>
            </tr>
        </tbody>
       @endforeach
    </table>
    <span>{!! $loadOrderShop->render() !!}</span>
</div>
@endsection
