$('body').on('click', '#edit-agree', function () {
    var id_product = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url: "{{URL::to('/admin-duyet-san-pham')}}" + '/' + id_product,
        success: function (data) {
            var table = $('#listApprove').DataTable();
            table.ajax.reload( function ( json ) {
                $('#status').val( json.lastInput );
            } );
        },
        
    });
});

$('body').on('click', '#edit-refuse', function () {
    var id_product = $(this).attr('data-id');
    $.ajax({
        type: "POST",
        url: "{{URL::to('/admin-tu-choi-duyet-san-pham')}}" + '/' + id_product,
        success: function (data) {
            var table = $('#listApprove').DataTable();
            table.ajax.reload( function ( json ) {
                $('#status').val( json.lastInput );
            } );
        },
        
    });
});