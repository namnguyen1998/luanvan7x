@extends('users.customer.profile')
@section('content')
<div class="col-lg-9 col-md-7">
    <div class="filter__item">
        <div class="card">
            <div class="card-header">
                <strong>Thông tin nhận hàng</strong>
            </div>
            <div class="card-footer" style="text-align: center" >
                @if (!empty($addressCustomer->count()))
                    <span id="default" style="width: 250px" type="type" class="btn btn-secondary btn-sm">
                        Thông tin mặc định
                    </span>
                    
                    <span id="edit" style="width: 250px" type="type" class="btn btn-outline-secondary btn-sm">
                        Sửa thông tin địa chỉ 
                    </span>
                    
                    <span id="create" style="width: 250px" type="type" class="btn btn-outline-secondary btn-sm">
                        Thêm thông tin địa chỉ 
                    </span>
                @else
                    <span id="create" style="width: 750px" type="type" class="btn btn-outline-secondary btn-sm">
                        Thêm thông tin địa chỉ 
                    </span>
                @endif
            </div>
                       
            <?php
                if (!empty(Session::get('message'))){
                    echo'<div class = "card-footer alert-success">'.Session::get('message').'</div></br>';
                    Session::put('message', null);
                }
                if (!empty(Session::get('message1'))){
                    echo'<div class = "card-footer alert-danger">'.Session::get('message1').'</div></br>';
                    Session::put('message1', null);
                }
            ?>

            <div class="card-body card-block">
                @if (!empty($addressCustomer->count()))
                <!-- Address Default -->
                <form action="{{URL::to('/defaultAddress')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div id="form_change_default">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="email-input" class=" form-control-label">Chọn địa chỉ mặc định</label>
                            </div>

                            <div class="col-12 col-md-9" style="height: 60px">
                                <select style="width: 150%" id="address_default" name="address_default">.
                                    @foreach ($addressCustomer as $address)
                                        <option style="width: 100px" id="_default" value="{{$address->id_address}}">{{$address->address_customer}}</option>
                                    @endforeach
                                </select>
                            </div>
    
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên người nhận</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input id="address_default_name" disabled type="text" value="{{$addressCustomer[0]->name_recipient}}" class="form-control" style="width: 500px;">
                                </div>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Số điện thoại</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input id="address_default_phone" disabled type="text" value="{{$addressCustomer[0]->phone_recipient}}" class="form-control" style="width: 500px;">
                                </div>
                            </div>
                        </div>
                
                        <div class="card-footer" style="text-align: center;">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Xác nhận
                            </button>
                        </div>
                    </div>
                </form>
                
                <!-- Edit Address -->
                <form action="{{URL::to('/editAddress')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div id="form_change_edit">
                        <div class="row form-group">
                            <div class="col-12 col-md-3">
                                <label for="email-input" class=" form-control-label">Địa chỉ mặc định</label>
                            </div>

                            <div class="col-12 col-md-6" style="height: 60px">
                                <select id="change_edit_address" name="change_edit_address">.
                                    @foreach ($addressCustomer as $address)
                                        <option style="width: 100px" value="{{$address->id_address}}">{{$address->address_customer}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div id="deleted_address" class="col-12 col-md-3">
                                <span class="btn btn-outline-danger btn-sm fa fa-hand-o-right"> Xoá địa chỉ này</span>
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên người nhận</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input id="edit_address_name"  type="text" value="{{$addressCustomer[0]->name_recipient}}" name="edit_address_name" class="form-control" style="width: 500px;">
                                </div>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Số điện thoại</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input id="edit_address_phone"  type="text" id="text-input" value="{{$addressCustomer[0]->phone_recipient}}" name="edit_address_phone" class="form-control" style="width: 500px;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Địa chỉ</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input id="edit_address" value="{{$addressCustomer[0]->address_customer}}" type="text" name="edit_address" class="form-control" style="width: 500px;">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="text-align: center;">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Xác nhận
                            </button>
                        </div>
                    </div>
                </form>

                <!-- Create Address -->
                <form action="{{URL::to('/createAddress')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div id="form_change_create">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên người nhận</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input type="text"  name="new_address_name" class="form-control" style="width: 500px;">
                                </div>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Số điện thoại</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input type="text" name="new_address_phone" class="form-control" style="width: 500px;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Địa chỉ người nhận</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input type="text" name="new_address" class="form-control" style="width: 500px;">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="text-align: center;">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Xác nhận
                            </button>
                        </div>
                    </div>
                </form>
                @else
                <!-- Create Address -->
                <form action="{{URL::to('/createAddress')}}" method="post" enctype="multipart/form-data" class="form-horizontal">
                    @csrf
                    <div id="form_change_create">
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Tên người nhận</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input type="text"  name="new_address_name" class="form-control" style="width: 500px;">
                                </div>

                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Số điện thoại</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input type="text" name="new_address_phone" class="form-control" style="width: 500px;">
                                </div>
                            </div>
                        </div>
                        
                        <div class="row form-group">
                            <div class="col col-md-3">
                                <label for="text-input" class=" form-control-label">Địa chỉ người nhận</label>
                            </div>

                            <div class="row form-group">
                                <div class="col-12 col-md-9">
                                    <input type="text" name="new_address" class="form-control" style="width: 500px;">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer" style="text-align: center;">
                            <button type="submit" class="btn btn-primary btn-sm">
                                Xác nhận
                            </button>
                        </div>
                    </div>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>
<script>
    $(document).on('click', '#click_disabled', function() {
        $("#_disabled_name").attr("disabled", false)
        $("#_disabled_phone").attr("disabled", false)
        $("#_disabled_address").attr("disabled", false)
    });

    $(document).ready(function(){
        $("#form_change_create").hide();
        $("#form_change_default").show();
        $("#form_change_edit").hide();
        $('#default').on('click', function(){
            $("#form_change_default").show();
            $("#form_change_create").hide();
            $("#form_change_edit").hide();
        })

        $('#edit').on('click', function(){
            $("#form_change_edit").show();
            $("#form_change_create").hide();
            $("#form_change_default").hide();
        })

        $('#create').on('click', function(){
            $("#form_change_create").show();
            $("#form_change_default").hide();
            $("#form_change_edit").hide();
        })

        $("#address_default").change(function(){
            
            val_address = document.getElementById("address_default").value
            $.ajax({
                type: "GET",
                url: "{{URL::to('/load-name-phone')}}" + '/' + val_address,
            }).done(function(data){               
                $.each (data, function (key, value){
                    console.log( value.name_recipient)
                    console.log( value.phone_recipient)
                    $('#address_default_name').val( value.name_recipient );
                    $('#address_default_phone').val( value.phone_recipient);
                })
            })
                
        })
        
        $("#change_edit_address").change(function(){
            
            val_address = document.getElementById("change_edit_address").value
            $.ajax({
                type: "GET",
                url: "{{URL::to('/load-name-phone')}}" + '/' + val_address,
            }).done(function(data){               
                $.each (data, function (key, value){
                    $('#edit_address_name').val( value.name_recipient );
                    $('#edit_address_phone').val( value.phone_recipient);
                    $('#edit_address').val( value.address_customer);
                })
            })  
        })

        $("#deleted_address").on('click', function(){
            val_address = document.getElementById("change_edit_address").value
            $.ajax({
                type: "GET",
                url: "{{URL::to('/delete-address')}}" + '/' + val_address,
                success: function(){
                    alert('Xác nhận thành công.');
                    location.reload(true);
                }
            }) 
        })

    })
</script>
@endsection
