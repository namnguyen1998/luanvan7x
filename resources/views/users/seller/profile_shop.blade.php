@extends('users.seller.banhang')
@section('content')
 <div class="col-lg-12">
    <div class="filter__item">
        <div class="card">
            <div class="card-header">
                <h2><strong>Hồ sơ shop</strong></h2>
            </div>
                @if(Session::has('success')!=null)
                <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                @endif
                <div class="card-body card-block" style="">
                    @foreach($errors->all() as $err)
                        <div class="alert alert-danger" role="alert">{{$err}}</div>
                    @endforeach
                    <form action="{{URL::to('/updateProfileShop')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                            @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="text" id="text-input" name="name_shop" value="{{Session::get('shop')->name_shop}}" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Email</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <label for="text-input" class=" form-control-label">{{$email_shop}}******@gmail.com</label>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Số điện thoại</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <div class="row">
                                    <input id="_disabled" disabled type="number" id="text-input" value="{{Session::get('shop')->phone_shop}}" name="phone_shop" class="form-control" style="width: 280px;">
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
                                <input type="file" id="file-input" name="img_shop" class="form-control-file">
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