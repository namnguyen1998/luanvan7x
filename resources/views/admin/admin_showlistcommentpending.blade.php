
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
        $('#listApproveComment').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                url: "{{URL::to('/admin-binh-luan-san-pham')}}",
                type: 'GET',
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false,searchable: false},
                { data: 'created_at', name: 'created_at' },
                { data: 'name_customer', name: 'name_customer' },
                { data: 'name_product', name: 'name_product' },
                { data: 'content', name: 'content' },
                { data: 'action', name: 'action', orderable: false, searchable: false},
            ],
            columnDefs: [
                { targets: 1, render:function(data){return moment(data).format('DD-MM-YYYY')}},
            ]
        });
    });
    
    $('body').on('click', '#edit-agree-comment', function(){
        var id_comment = $(this).attr('data-id');
        // console.log(id_comment)
        $.ajax({
            type: "POST",
            url: "{{URL::to('/admin-xoa-binh-luan')}}" + '/' + id_comment,
            success: function (data) {
                var table = $('#listApproveComment').DataTable();
                table.ajax.reload( function ( json ) {
                    $('#listApproveComment').val( json.lastInput );
                });
            },
        });
    });
</script>