@include('admin.header_admin')
@include('admin.menu_admin')
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <form action="{{URL::to('/admin-save-nhan-vien')}}" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST" >
    <input type="hidden" name="_token" value="{{csrf_token()}}" >
    <!-- Main content -->
        <hr class="m-t-2 m-b-2">
        <div class="row m-t-3">
            <div class="col-lg-12 col-md-12">
            <div class="card">
                <div class="card-header bg-blue">
                <h5 class="m-b-0">Thông tin khác</h5>
                </div>

                <div class="card-body">
                    <?php
                        if(!empty(Session::get('message'))){
                            echo'<div class = "alert-danger">'.Session::get('message').'</div></br>';
                            Session::put('message', null);
                        }
                    ?>
                    <div class="form-body">
                        <div class="form-group has-feedback row">
                            <label class="control-label text-right col-md-3">Tên nhân viên*</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-12" name="name_user" value="<?php if(!empty(Session::get('res_name_user'))){
                                                                                                    echo Session::get('res_name_user');
                                                                                                    Session::put('res_name_user', null);
                                                                                                } ?>" placeholder="Họ và Tên" type="text">
                                <span class="fa ti-user form-control-feedback" aria-hidden="true"></span>
                            </div>                
                        </div>
                
                        <div class="form-group has-feedback row">
                            <label class="control-label text-right col-md-3">Tài khoản*</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-12" name="username_user"  value="<?php if(!empty(Session::get('res_username_user'))){
                                                                                                    echo Session::get('res_username_user');
                                                                                                    Session::put('res_username_user', null);
                                                                                                } ?>" placeholder="Tài khoản đăng nhập" type="text">
                                <span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
                            </div>                
                        </div>

                        <div class="form-group has-feedback row">
                            <label class="control-label text-right col-md-3">Mật khẩu*</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-12" name="password_user" placeholder="Mật khẩu đăng nhập" type="password">
                                <span class="fa ti-lock form-control-feedback" aria-hidden="true"></span>
                            </div>                
                        </div>

                        <div class="form-group has-feedback row">
                            <label class="control-label text-right col-md-3">E-mail*</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-12" name="email_user"  value="<?php if(!empty(Session::get('res_email_user'))){
                                                                                                    echo Session::get('res_email_user');
                                                                                                    Session::put('res_email_user', null);
                                                                                                } ?>" placeholder="Email" type="text">
                                <span class="fa fa-envelope-o form-control-feedback" aria-hidden="true"></span> 
                            </div>
                            
                        </div>
                        
                        <div class="form-group has-feedback row">
                            <label class="control-label text-right col-md-3">Số điện thoại*</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-12" name="phone_user" value="<?php if(!empty(Session::get('res_phone_user'))){
                                                                                                    echo Session::get('res_phone_user');
                                                                                                    Session::put('res_phone_user', null);
                                                                                                } ?>"  placeholder="SĐT" type="text">
                                <span class="fa fa-phone form-control-feedback" aria-hidden="true"></span>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Chọn quyền cho nhân viên*</label>
                            <div class="col-md-9">
                                <select  name="role_user" id="_id_role" class="form-control">
                                <option value="0">Chọn</option>
                                @foreach($listRole as $role)
                                    <option value="{{$role->id_role}}">{{$role->name_role}}</option>
                                @endforeach
                                </select>   
                            </div>
                        </div> 
                    </div>

                    <div style="text-align: center;" class="card-body">
                        <div class="click2edit m-b-3"></div>
                        <button id="save" class="btn btn-success" onclick="save()" type="submit">Thêm</button>
                        <a href="{{URL::to('/admin-danh-sach-nhan-vien')}}">
                            <button id="cancel" class="btn btn-info" type="button">Huỷ</button>
                        </a>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </form>
    <!-- /.content --> 
</div>

<!-- CKeditor  -->
<script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  
<script src="{{asset('public/backend/dist/bootstrap/js/bootstrap.min.js')}}"></script> 

<!-- template --> 
<script src="{{asset('public/backend/dist/js/bizadmin.js')}}"></script> 

<!-- for demo purposes --> 
<script src="{{asset('public/backend/dist/js/demo.js')}}"></script> 

