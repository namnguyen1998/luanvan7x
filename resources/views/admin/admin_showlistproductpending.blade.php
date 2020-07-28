
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
        $('#listPending').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{URL::to('/admin-danh-sach-duyet-san-pham')}}",
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
                    if (row.status_product === 0) 
                        return '<span class="label label-warning">Đang chờ duyệt</span>';
                    else {
                        if (row.status_product === 1)
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
    $('body').on('click', '#edit-agree', function(){
        var id_product = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{URL::to('/admin-duyet-san-pham')}}" + '/' + id_product,
            success: function (data) {
                var table = $('#listPending').DataTable();
                table.ajax.reload( function ( json ) {
                    $('#status').val( json.lastInput );
                });
            },
        });
    });

    $('body').on('click', '#edit-refuse', function(){
        var id_product = $(this).attr('data-id');
        $.ajax({
            type: "POST",
            url: "{{URL::to('/admin-tu-choi-duyet-san-pham')}}" + '/' + id_product,
            success: function (data) {
                var table = $('#listPending').DataTable();
                table.ajax.reload( function ( json ) {
                    $('#status').val( json.lastInput );
                });
            },
        });
    });
</script>