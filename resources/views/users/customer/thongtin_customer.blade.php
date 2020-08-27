@extends('users.customer.profile')
@section('content')
 <div class="col-lg-9 col-md-7">
    <div class="filter__item">
        <div class="card"> <?php
        $message = Session::get('message');
        if($message){
            echo'<div class = "alert-success">'.$message.'</div>';
            Session::put('message',null);
        }
        ?>
            <div class="card-header">
                <strong>Hồ sơ của tôi</strong>
            </div>
                @if(Session::get('message')!=null)
                <div class="alert alert-success" role="alert">{{Session::get('message')}}</div>
                @endif
                <div class="card-body card-block" style="">
                    @foreach($errors->all() as $err)
                        <div class="alert alert-danger" role="alert">{{$err}}</div>
                    @endforeach
                    <form action="{{URL::to('/updateProfile')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="name_customer" value="{{Session::get('customer')->name_customer}}" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Giới tính</label>
                            </div>
                            <div class="col col-md-9">
                                <div class="form-check-inline form-check">
                                    <label for="inline-radio1" class="form-check-label"style="padding-left: 10px;">
                                        <input type="radio" id="inline-radio1" @if(Session::get('customer')->sex_customer==0) {{'checked="true"'}} @endif name="sex_customer" value="0" class="form-check-input">Nam
                                    </label>
                                    <label for="inline-radio2" class="form-check-label"style="padding-left: 10px;">
                                        <input type="radio" id="inline-radio2" @if(Session::get('customer')->sex_customer==1) {{'checked="true"'}} @endif name="sex_customer" value="1"  class="form-check-input">Nữ
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Email</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <label for="text-input" class=" form-control-label">{{$email_customer}}******@gmail.com</label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Ngày sinh</label>
                            </div>
                            <div class="col-12 col-md-9">
                                @if(Session::get('customer')->date_customer!=null)
                                    <label for="text-input" class=" form-control-label">{{date('d/m/Y', strtotime(Session::get('customer')->date_customer))}}</label>
                                @else
                                <input type="text" placeholder="dd-mm-yyyy" id="text-input" name="date_customer" class="form-control" style="width: 280px;">
                                @endif
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Số điện thoại</label>
                            </div>
                            <div class="col-12 col-md-9">
                                
                                <div class="row">
                                    <input id="_disabled" disabled type="number" id="text-input" value="{{Session::get('customer')->phone_customer}}" name="phone_customer" class="form-control" style="width: 280px;">
                                    <div class="col-12 col-md-3">
                                        <label style="color: #A52652" id="click_disabled" for="text-input" class=" form-control-label fa fa-hand-o-right">Nhấn tại đây để điền SDT</label>
                                    </div>
                                </div>
                               
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label">Chọn ảnh</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="file-input" name="img_customer" class="form-control-file">
                            </div>
                        </div>
                <div class="card-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-sm">
                        Cập nhật
                    </button>
                </div>
            </form>
          </div>
    </div>
</div>
@endsection
<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).on('click', '#click_disabled', function() {
        $("#_disabled").attr("disabled", false);
        
    });
    $(document).ready(function(){
        $("#phone_customer").change(function(){
            $("#_disabled").val(null); 
            $("#_disabled").attr("disabled", true);
        })
    })
    $(document).on('click', '#click_disabled', function() {
        $("#_disabled").attr("disabled", false);
        
    });
    $(document).ready(function(){
        $("#date_customer").change(function(){
            $("#_disabled").val(null); 
            $("#_disabled").attr("disabled", true);
        })
    })
</script>