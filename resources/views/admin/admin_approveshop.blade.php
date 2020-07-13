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
                <h1>Duyệt Shop</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
                        <li><i class="fa fa-angle-right"></i>Duyệt Shop</li>
                    </ol>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="listApproveShop">
                    <thead>
                        <tr>
                            
                            <th>STT</th>
                            <th>Ngày đăng ký</th>
                            <th>Tên Shop</th>
                            <th>Email</th>
                            <th>SĐT</th>
                            <th>Địa chỉ</th>
                            <th id="statusShop">Trạng thái</th>
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
<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css" >
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/plug-ins/1.10.21/dataRender/datetime.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script> -->

<!-- DataTables -->
<script src="{{asset('public/backend/dist/js/jquery.js')}}"></script> 
<script src="{{asset('public/backend/dist/js/jquery.validate.js')}}"></script> 
<script src="{{asset('public/backend/dist/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('public/backend/dist/js/datetime.js')}}"></script> 
<script src="{{asset('public/backend/dist/js/moment.min.js')}}"></script> 

<!-- template --> 
<script src="{{asset('public/backend/dist/js/bizadmin.js')}}"></script> 
<!-- Jquery Sparklines --> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/jquery.sparkline.min.js')}}"></script> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/sparkline-int.js')}}"></script> 
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }});
        $('#listApproveShop').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{URL::to('/admin-danh-sach-shop-cho-phe-duyet')}}",
                type: 'GET',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                { data: 'created_at', name: 'created_at' },
                { data: 'name_shop', name: 'name_shop' },
                { data: 'email_shop', name: 'email_shop' },
                { data: 'phone_shop', name: 'phone_shop' },
                { data: 'address_shop', name: 'address_shop' },
                { data: 'status_shop', 
                    "render": function (data, type, row) {
                    if (row.status_shop === 0) 
                        return '<span class="label label-warning">Đang chờ duyệt</span>';
                    else {
                        if (row.status_shop === 1)
                            return '<span class="label label-success">Đã phê duyệt</span>';
                        else
                            return '<span class="label label-danger">Từ chối duyệt</span>';
                }}}, 
                { data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                { targets: 1, render:function(data){return moment(data).format('DD-MM-YYYY')}},
            ]
        });
    });
    
    $('body').on('click', '#edit-agree-shop', function(){
        var id_shop = $(this).attr('data-id');
        console.log(id_shop)
        $.ajax({
            type: "POST",
            url: "{{URL::to('/admin-duyet-shop')}}" + '/' + id_shop,
            success: function (data) {
                var table = $('#listApproveShop').DataTable();
                table.ajax.reload( function ( json ) {
                    $('#statusShop').val( json.lastInput );
                });
            },
        });
    });
</script>

