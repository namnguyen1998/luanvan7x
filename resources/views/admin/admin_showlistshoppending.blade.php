
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

