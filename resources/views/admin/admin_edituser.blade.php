@include('admin.header_admin')
@include('admin.menu_admin')
<link rel="stylesheet" href="{{asset('public/backend/dist/plugins/dropify/dropify.min.css')}}">
    <div class="content-wrapper"> 
        <!-- Content Header (Page header) -->
       @foreach ($loadUser as $user)
        <form action="{{URL::to('/admin-update-nhan-vien')}}" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST" >
        
        @csrf
        <input hidden name="id_users" value="{{ $user->id_users }}">
        <!-- Main content -->
            <hr class="m-t-2 m-b-2">
            <div class="row m-t-3">
                <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-header bg-blue">
                    <h5 class="m-b-0">Thay đổi quyền nhân viên</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                        <div class="form-group has-feedback row">
                            <label class="control-label text-right col-md-3">Tên nhân viên</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-12" name="name_user" readonly value="{{$user->name_user}}" placeholder="Họ và Tên" type="text">
                                <span class="fa ti-user form-control-feedback" aria-hidden="true"></span>
                            </div>                
                        </div>
                
                        <div class="form-group has-feedback row">
                            <label class="control-label text-right col-md-3">Tài khoản</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-12" name="username_user" readonly value="{{$user->username_user}}" placeholder="Tài khoản đăng nhập" type="text">
                                <span class="fa fa-user form-control-feedback" aria-hidden="true"></span>
                            </div>                
                        </div>

                        <div class="form-group has-feedback row">
                            <label class="control-label text-right col-md-3">E-mail</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-12" name="email_user" readonly value="{{$user->email_user}}" placeholder="Email" type="text">
                                <span class="fa fa-envelope-o form-control-feedback" aria-hidden="true"></span> 
                            </div>
                            
                        </div>
                        
                        <div class="form-group has-feedback row">
                            <label class="control-label text-right col-md-3">Số điện thoại</label>
                            <div class="col-md-9">
                                <input class="form-control col-md-12" name="phone_user" readonly value="{{$user->phone_user}}" placeholder="SĐT" type="text">
                                <span class="fa fa-phone form-control-feedback" aria-hidden="true"></span>
                            </div>
                            
                        </div>

                        <div class="form-group row">
                            <label class="control-label text-right col-md-3">Chọn quyền cho nhân viên*</label>
                            <div class="col-md-9">
                                <select  name="role_user" id="_id_role" class="form-control">
                                <option value="{{$user->role_id}}">{{$user->name_role}}</option>
                                @foreach ($loadRole as $role)
                                    <option value="{{$role->id_role}}">{{$role->name_role}}</option>
                                @endforeach
                                </select>   
                            </div>
                        </div> 
                        
                        <div style="text-align: center;" class="card-body">
                            <div class="click2edit m-b-3"></div>
                            <button class="btn btn-success" type="submit">Cập nhật</button>
                            <a href="{{URL::to('/admin-danh-sach-nhan-vien')}}">
                                <button id="cancel" class="btn btn-info"  type="button">Huỷ</button>
                            </a>
                            
                        </div>
                    </div>
                </div>
                </div>
            
            </div>
        </form>
        @endforeach
        <!-- /.content --> 
    </div>

    <!-- CKeditor  -->
    <script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  
    <script src="{{asset('public/backend/dist/bootstrap/js/bootstrap.min.js')}}"></script> 

    <!-- template --> 
    <script src="{{asset('public/backend/dist/js/bizadmin.js')}}"></script> 

    <!-- for demo purposes --> 
    <script src="{{asset('public/backend/dist/js/demo.js')}}"></script> 

    <!-- CKeditor  -->
    