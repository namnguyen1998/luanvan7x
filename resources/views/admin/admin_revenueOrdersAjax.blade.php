<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">

<div id="load_revenue" class="table-responsive">
  <?php
    $number = 1;
    $total_revenue = 0;
  ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col"># STT</th>
        <th scope="col"># Mã đơn hàng</th>
        <th scope="col"># Ngày</th>
        <th scope="col"># Giá trị đơn hàng</th>
        <th scope="col"># Thành tiền (5% GTĐH)</th>
        
      </tr>
    </thead>
    @foreach ($loadOrder as $order)
    <tbody>
     <tr>
        <th><?php echo $number ++ ;?></th>
        <td>#{{$order->id_orders}}</td>
        <td>{{$order->created_at}}</td>
        <td>{{number_format($order->price_orders, 0, ',', '.') . " ₫"}}</td>
        <td>{{number_format($order->price_orders * 0.02, 0, ',', '.') . " ₫"}}</td>
        <?php $total_revenue += $order->price_orders * 0.02; ?>
     </tr>
    </tbody>
    @endforeach
  </table>
  <div class="col-12 text-right font-weight-bold" style="font-size:180%">
        TỔNG:  <?php echo number_format($total_revenue, 0, ',', '.') . " ₫" ?>
  </div>
</div>

