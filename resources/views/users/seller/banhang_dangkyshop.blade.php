@extends('users.customer.profile')
@section('content')
 <div class="col-lg-9 col-md-7">
    <div class="filter__item">
        <div class="card">
            <div class="card-header">
                <strong>ĐĂNG KÝ SHOP BÁN HÀNG</strong>
            </div>
            @foreach($errors->all() as $err)
                <div class="alert alert-danger">{{ $err }}</div>
            @endforeach
                <div class="card-body card-block" style="">
                    <form action="{{URL::to('/postRegisterShop')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
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
                                <input type="text" id="text-input" name="phone_shop" value="" class="form-control" style="width: 280px;">
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