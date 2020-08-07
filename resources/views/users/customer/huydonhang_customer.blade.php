@extends('users.customer.profile')
@section('content')
<div class="col-lg-9 col-md-7">
    <div class="filter__item">
        <div class="card">
            <div class="card-header">
                <strong>Thông tin đơn hàng</strong>
            </div>

            <div class="card-body card-block" style="">
                <form action="{{URL::to('/profile/huy')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
					
                    <!-- <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">Chọn địa chỉ mặc định</label>
                        </div>

                        <div class="col-12 col-md-9">
                            <select id="address_default" name="address_default">.
                                
                            </select>
                        </div>
                    </div> -->
					<div class="col col-md-12">
						<?php
							if (!empty(Session::get('message'))){
								echo'<div class = "alert-danger">'.Session::get('message').'</div></br>';
								Session::put('message', null);
							}
						?>
							<label for="text-input" class=" form-control-label">Xin vui lòng nhập lý do <strong>Huỷ đơn hàng</strong></label>
						</div>
						
						<div class="row form-group">
                            <div class="col-12 col-md-12">
                                <textarea   type="textarea" id="text-input" name="noteCancel" class="form-control" style="width: 800px;"></textarea>
                            </div>

                        </div>
                    <div class="row form-group">
                        
                        
                    </div>
					@foreach ($loadCancelOrder as $order)
            			<input hidden value="{{$order->id_orders}}" name="id_orders">
					@endforeach
                    <div class="card-footer" style="text-align: center;">
                        <button type="submit" class="btn btn-primary btn-sm">
                            Xác nhận 
						</button>	
                    </div>
				</form>
            </div>
        </div>
    </div>
</div>

@endsection
