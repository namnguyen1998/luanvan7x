@extends('users.seller.banhang')
@section('content')
 <div class="col-md-6 offset-md-3 mr-auto ml-auto">
    <div class="filter__item">
        <div class="card">
            <div class="card-header">
                <strong>Mật khẩu shop</strong>
            </div>
                @if(Session::get('success')!=null)
                <div class="alert alert-success" role="alert">{{Session::get('success')}}</div>
                @endif
                <div class="card-body card-block" style="">
                    @foreach($errors->all() as $err)
                        <div class="alert alert-danger" role="alert">{{$err}}</div>
                    @endforeach
                    <form action="{{URL::to('/updatePasswordShop')}}" method="post" class="form-horizontal">
                            @csrf
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Mật khẩu mới</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" name="new_password" class="form-control" style="width: 280px;">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Nhập lại mật khẩu mới</label>
                            </div>
                            <div class="col-12 col-md-9">
                                <input type="password" name="password_new_confirmation" class="form-control" style="width: 280px;">
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