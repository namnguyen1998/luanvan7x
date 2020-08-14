@extends('users.customer.profile')
@section('content')

<div class="col-lg-9 col-md-7">
	<div class="container">
		<h2>Chi tiết hàng</h2>        
		<table class="table table-hover">
			<thead style="text-align: center">
			<tr>
				<th>STT</th>
				<th>Ngày</th>
				<th>Tên SP</th>
				<th>SL</th>
				<th>Giá</th>
				<th>Thành tiền</th>
			</tr>
			</thead>
			
			<?php $number = 1; $total = 0; $ship = 0;?>
			@foreach ($orderDetail as $order)
				<tbody>
					<tr style="text-align: center">
						<td><?php echo $number ++; ?></td>
						<td>{{ date('d-m-Y H:i:s', strtotime( $order->created_at )) }}</td>
						<td>{{ $order->name_product }}</td>
						<td>{{ $order->quantity }}</td>
						<td>{{ number_format($order->price_product, 0, ',', '.') . " ₫" }}</td>
						<td>{{ number_format($order->price_product * $order->quantity , 0, ',', '.') . " ₫" }}</td>
						<?php
							$total += $order->price_product * $order->quantity;
							$ship = $order->shipping_cost;
							$status_order = $order->status_order;
							$id_orders = $order->id_orders;
						?>
					</tr>
				</tbody>
			@endforeach
		</table>

		<div style="font-size: 130%">
			<strong>
				Tổng GTĐH: &nbsp&nbsp&nbsp&nbsp <?php echo number_format($total, 0, ',', '.') . " ₫" ?>
				<br>
				Phí vận chuyển: &nbsp&nbsp&nbsp&nbsp <?php echo number_format($ship , 0, ',', '.') . " ₫" ?>
				<br>
				Tổng: &nbsp&nbsp&nbsp&nbsp <?php echo number_format($total + $ship , 0, ',', '.') . " ₫" ?>
			</strong>
			
		</div>

		<div style="text-align: center">
			@if ($status_order >= 0)
			<button type="button" class="btn btn-secondary">
				<a style="color: white" href=" {{URL::to('profile/huy-don-hang/'.$id_orders)}} ">
					<span>
						Huỷ đơn hàng này
					</span>
				</a>
			</button>
			@endif
			<button type="button" class="btn btn-success">
				<a style="color: white" href=" {{URL::to('profile/don-hang-cua-ban')}} ">
					<span>
						Trở về
					</span>
				</a>
			</button>
		</div>
	</div>
</div>
@endsection