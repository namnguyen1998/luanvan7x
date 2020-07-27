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
                <div class="card-body card-block" style="">
                    <form action="{{URL::to('/updateProfile')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="name_customer" value="{{Session::get('name_customer')}}" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label class=" form-control-label">Inline Radios</label>
                            </div>
                            <div class="col col-md-9">
                                <div class="form-check-inline form-check">
                                    <label for="inline-radio1" class="form-check-label"style="padding-left: 10px;">
                                        <input type="radio" id="inline-radio1" @if(Session::get('sex_customer')==0) {{'checked="true"'}} @endif name="sex_customer" value="0" class="form-check-input">Nam
                                    </label>
                                    <label for="inline-radio2" class="form-check-label"style="padding-left: 10px;">
                                        <input type="radio" id="inline-radio2" @if(Session::get('sex_customer')==1) {{'checked="true"'}} @endif name="sex_customer" value="1"  class="form-check-input">Nữ
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
                                <label for="text-input" class=" form-control-label">Số điện thoại</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="col-12 col-md-9">
                                @if($phone_customer!=null)
                                <label for="text-input" class=" form-control-label">********{{$phone_customer}}</label>
                                @else
                                <label for="text-input" class=" form-control-label"></label>
                                @endif
                            </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label">Chọn ảnh</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="file-input" name="img" class="form-control-file">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Địa chỉ mặc định</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="address_default" value="{{Session::get('address_customer')}}" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                <div class="card-footer" style="text-align: center;">
                    <button type="submit" class="btn btn-primary btn-sm">
                        Save
                    </button>
                </div>
            </form>
          </div>
    </div>
</div>
@endsection