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
                            <label for="text-input" class=" form-control-label">Thêm địa chỉ mới</label>
                        </div>

                        <div class="row form-group">
                            <div class="col-12 col-md-9">
                                <input id="_disabled" disabled type="text" id="text-input" name="new_address_default" class="form-control" style="width: 280px;">
                            </div>

                            <div class="col-12 col-md-3">
                                <label style="color: #A52652" id="click_disabled" for="text-input" class=" form-control-label">Nhấn tại đây để điền địa chỉ</label>
                            </div>
                        </div>
                    </div>

                    <div class="row form-group">
                        <div class="col col-md-3">
                            <label for="email-input" class=" form-control-label">Chọn địa chỉ mặc định</label>
                        </div>

                        <div class="col-12 col-md-9">
                            <select id="address_default" name="address_default">.
                                @foreach ($addressCustomer as $address)
                                    <option id="_default" value="{{$address->id_address}}">{{$address->address_customer}}</option>
                                @endforeach
                            </select>

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
</div>
<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).on('click', '#click_disabled', function() {
        $("#_disabled").attr("disabled", false);
        
    });

    $(document).ready(function(){
        $("#address_default").change(function(){
            $("#_disabled").val(null); 
            $("#_disabled").attr("disabled", true);
        })
    })
</script>
@endsection