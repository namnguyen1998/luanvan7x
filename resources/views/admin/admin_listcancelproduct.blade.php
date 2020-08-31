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
                <h1>Huỷ sản phẩm</h1>
                    <ol class="breadcrumb">
                        <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
                        <li><i class="fa fa-angle-right"></i>Huỷ sản phẩm</li>
                    </ol>
            </div>
            <div class="table-responsive">
                <table class="table table-striped" id="listCancelProduct">
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
                            <th>Huỷ</th>
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

<!-- DataTables -->
<script src="{{asset('public/backend/dist/js/jquery.js')}}"></script> 
<script src="{{asset('public/backend/dist/js/jquery.validate.js')}}"></script> 
<script src="{{asset('public/backend/dist/js/jquery.dataTables.min.js')}}"></script> 
<script src="{{asset('public/backend/dist/js/datetime.js')}}"></script> 
<script src="{{asset('public/backend/dist/js/moment.min.js')}}"></script> 
<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }});
        $('#listCancelProduct').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{URL::to('/admin-huy-san-pham')}}",
                type: 'GET',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                { data: 'created_at', name: 'created_at' },
                { data: 'name_shop', name: 'name_shop' },
                { data: 'name_product', name: 'name_product' },
                { data: 'madeby', name: 'madeby' },
                { data: 'price_product', name: 'price_product' },
                { data: 'status_product', 
                    "render": function (data, type, row) {
                    if (row.status_product == 0) 
                        return '<span class="label label-warning">Đang chờ duyệt</span>';
                    else {
                        if (row.status_product == 1)
                            return '<span class="label label-success">Đã phê duyệt</span>';
                        else
                            return '<span class="label label-danger">Từ chối duyệt</span>';
                }}}, 
                { data: 'name_brand', name: 'name_brand' },
                { data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                { targets: 1, render:function(data){return moment(data).format('DD-MM-YYYY')}},
                { targets: 5, render: $.fn.dataTable.render.number('.', '.', 0, 0, " ₫") }
            ]
        });
    });

    $('body').on('click', '#edit-refuse', function(){
        var id_product = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{URL::to('/admin-tu-choi-duyet-san-pham')}}" + '/' + id_product,
            success: function (data) {
                var table = $('#listCancelProduct').DataTable();
                table.ajax.reload( function ( json ) {
                    $('#status').val( json.lastInput );
                });
            },
        });
    });
</script>

<!-- template --> 
<script src="{{asset('public/backend/dist/js/bizadmin.js')}}"></script> 
<!-- Jquery Sparklines --> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/jquery.sparkline.min.js')}}"></script> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/sparkline-int.js')}}"></script> 

