<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">

<div id="load_revenueShop" class="table-responsive">
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
            
        </tr>
        </thead>
        @foreach ($loadOrderShop as $order)
        <tbody>
        <tr style="text-align: center">
            <th><?php echo $number ++ ;?></th>
            <td>#{{ $order->orders_id }}</td>
            <td>{{ date('d-m-Y', strtotime( $order->date )) }}</td>
            <td>{{ number_format($order->price_order, 0, ',', '.') . " ₫" }}</td>
            <?php $total_price_order += $order->price_order; ?>
        </tr>
        </tbody>
        @endforeach
    </table>
    <div class="col-12 text-right font-weight-bold" style="font-size:180%">
            TỔNG:  <?php echo number_format($total_price_order, 0, ',', '.') . " ₫" ?>
    </div>
</div>

