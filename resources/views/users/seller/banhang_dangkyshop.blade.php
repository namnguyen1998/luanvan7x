@extends('users.customer.profile')
@section('content')
 <div class="col-lg-9 col-md-7">
    <div class="filter__item">
        <div class="card">
            <div class="card-header">
                <strong>ĐĂNG KÝ SHOP BÁN HÀNG</strong>
            </div>
            @foreach($errors->all() as $err)
                <div class="alert alert-danger" role="alert">{{$err}}</div>
            @endforeach
            @if(session('Thành công'))
                <div class="alert alert-success">{{ session('Thành công')}}</div>
            @endif
                <div class="card-body card-block" style="">
                    <form action="{{URL::to('/postRegisterShop')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                        <?php
                            if(empty($_GET['keyID'])){
                        ?>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Email</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="email" id="text-input" name="email_shop" value="" class="form-control" style="width: 280px;" placeholder="Nhập Email để đăng ký shop">
                            </div>
                        </div>
                        <?php
                            }else{
                        ?>
                        <input type="hidden" name="accept_shop" value="<?php echo $_GET['keyID']?>" class="form-control">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên Shop</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="name_shop" value="" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Địa chỉ lấy hàng</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="address_shop" value="" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Số điện thoại</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="number" name="phone_shop" value="" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Password</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" class="form-control" id="text-input" name="password_shop" value="" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                         <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Re-Password</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" class="form-control" id="text-input" name="re-password" value="" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="file-input" class=" form-control-label">Chọn ảnh</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="file" id="file-input" name="img_shop" class="form-control-file">
                            </div>
                        </div>
                        <div class="row form-group" style="padding-left:228px;">
                        <div class="g-recaptcha" data-sitekey="{{env('CAPTCHA_KEY')}}"></div>
                            <br/>
                            @if($errors->has('g-recaptcha-response'))
                            <span class="invalid-feedback" style="display:block">
                                <strong>{{$errors->first('g-recaptcha-response')}}</strong>
                            </span>
                            @endif
                        </div>
                        <?php
                        }?>
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