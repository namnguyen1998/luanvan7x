@extends('users.customer.profile')
@section('content')
<div class="col-lg-9 col-md-7">
    <div class="filter__item">
        <div class="card">
            <div class="card-header">
                <strong>Địa chỉ</strong>
            </div>
                <div class="card-body card-block" style="">
                    <form action="{{URL::to('/updateAddress')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Địa chỉ mặc định</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="address_default" value="@if(Session::get('address_default')!=null) {{Session::get('address_default')}} @endif" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="email-input" class=" form-control-label">Địa chỉ khác</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="address_customer" value="{{Session::get('address_customer')}}" class="form-control"style="width: 280px;">
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