@include('admin.header_admin')
@include('admin.menu_admin')
<link rel="stylesheet" href="{{asset('public/backend/dist/css/bootstrap.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/dist/css/jquery.dataTables.min.css')}}"/>

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="content-wrapper"> 
    <div class="table-responsive">
        <div class="col-md-12">
            <!-- DATA TABLE -->
            <div class="content-header sty-one">
                <h1>Duyệt sản phẩm</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
                        <li><i class="fa fa-angle-right"></i>Duyệt sản phẩm</li>
                    </ol>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="listPending">
                    <thead>
                        <tr>
                            
                            <th>STT</th>
                            <th>Ngày đăng</th>
                            <th>Tên Shop</th>
                            <th>Tên sản phẩm</th>
                            <th>Xuất sứ</th>
                            <th>Giá</th>
                            <th id="status">Trạng thái</th>
                            <th>Hãng</th>
                            <th>Duyệt</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                    </tbody>
                </table>
            </div>
            <!-- END DATA TABLE -->
        </div>
    </div>
</div>

<!-- DataTables -->
@include('admin.admin_showlistproductpending')

<!-- template --> 
<script src="{{asset('public/backend/dist/js/bizadmin.js')}}"></script> 
<!-- Jquery Sparklines --> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/jquery.sparkline.min.js')}}"></script> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/sparkline-int.js')}}"></script> 

