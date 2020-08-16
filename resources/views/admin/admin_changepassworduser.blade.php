@include('admin.header_admin')
@include('admin.menu_admin')
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
        <form action="{{ URL::to('/admin-update-change-password/'.base64_encode(base64_encode(Session::get('id_users')))) }}" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST" >
        @csrf
        <!-- Main content -->
            <hr class="m-t-2 m-b-2">
            <div class="row m-t-3">
                <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-blue">
                    <h5 class="m-b-0">Đặt lại mật khẩu</h5>
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
                                <label class="control-label text-right col-md-3">Mật khẩu cũ*</label>
                                <div class="col-md-9">
                                    <input class="form-control col-md-12" name="password_user" placeholder="Nhập mật khẩu cũ" type="password">
                                    <span class="fa ti-lock form-control-feedback" aria-hidden="true"></span>
                                </div>                
                            </div>

                            <div class="form-group has-feedback row">
                                <label class="control-label text-right col-md-3">Mật khẩu mới*</label>
                                <div class="col-md-9">
                                    <input class="form-control col-md-12" name="new_password_user" placeholder="Nhập mật khẩu mới" type="password">
                                    <span class="fa fa-lock form-control-feedback" aria-hidden="true"></span>
                                </div>                
                            </div>

                            <div class="form-group has-feedback row">
                                <label class="control-label text-right col-md-3">Nhập lại mật khẩu mới*</label>
                                <div class="col-md-9">
                                    <input class="form-control col-md-12" name="confirm_new_password_user" placeholder="Nhập lại mật khẩu mới" type="password">
                                    <span class="fa fa-lock form-control-feedback" aria-hidden="true"></span>
                                </div>                
                            </div>
                        </div>

                        <div style="text-align: center;" class="card-body">
                            <div class="click2edit m-b-3"></div>
                            <button id="save" class="btn btn-success" onclick="save()" type="submit">Cập nhật</button>
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

