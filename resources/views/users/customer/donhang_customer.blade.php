@extends('users.customer.profile')
@section('content')

<div class="col-lg-9 col-md-7">
	<div class="container">
	  <h2>Đơn mua hàng</h2>
	  <h6><strong>Lưu ý:</strong> Đơn hàng đã được <strong>"Đã xác nhận"</strong> hoặc <strong>"Đang vận chuyển"</strong> không thể huỷ.</h6>
	  <br>
	  	<?php
			if (!empty(Session::get('message'))){
				echo'<div class = "alert-danger">'.Session::get('message').'</div></br>';
				Session::put('message', null);
			}
		?>       
	  <table class="table table-hover">
	    <thead style="text-align: center">
	      <tr>
			<th>STT</th>
			<th>Ngày</th>
	        <th>Mã ĐH</th>
			<th>Thành tiền</th>
			<th>Trạng thái</th>
			<th>Xem CTĐH</th>
			<th>Huỷ ĐH</th>
	      </tr>
		</thead>
		
		<?php $number = 1; ?>
		@foreach ($billCustomer as $bill)
			<tbody>
			<tr style="text-align: center" >
				<td><?php echo $number ++; ?></td>
				<td>{{ date('d-m-Y H:i:s', strtotime( $bill->created_at )) }}</td>
				<td>#{{ base64_encode(base64_encode($bill->id_orders)) }}</td>
				<td>{{ number_format($bill->price_orders, 0, ',', '.') . " ₫" }}</td>
				<td>
					@if ($bill->status_order == 0)
						<span class="label label-other">Đang duyệt</span>
					@elseif ($bill->status_order == 1)
						<span class="label label-success">Đã xác nhận</span>
					@elseif ($bill->status_order == -1)
						<span class="label label-danger">Huỷ</span>
					@else
						<span class="label label-info">Đang vận chuyển</span>
					@endif
				</td>
				<td>
					<a href="{{URL::to('profile/chi-tiet-don-hang/'.$bill->id_orders)}}"><button class="btn"><span class="fa fa-tripadvisor"></span></button></a>
				</td>
				<td>
					@if ($bill->status_order <= 0)
						<a href="{{URL::to('profile/huy-don-hang/'.$bill->id_orders)}}"><button class="btn"><span class="fa fa-expeditedssl"></span></button></a>
					@endif
				</td>
			</tr>
			</tbody>
		@endforeach
	  </table>
	</div>
	<span>{!! $billCustomer->render() !!}</span>
</div>
@endsection