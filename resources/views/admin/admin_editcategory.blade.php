@include('admin.header_admin')
@include('admin.menu_admin')
<link rel="stylesheet" href="{{asset('public/backend/dist/plugins/dropify/dropify.min.css')}}">
    <div class="content-wrapper"> 
        <!-- Content Header (Page header) -->
        @foreach ($id_category as $category)
        <form action="{{URL::to('/admin-update-danh-muc/'.$category->id_category)}}" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST" >
        
        @csrf
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
                        if (!empty(Session::get('message'))){
                            echo'<div class = "alert-danger">'.Session::get('message').'</div></br>';
                            Session::put('message', null);
                        }
                    ?>
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Tên sản danh mục</label>
                                <div class="col-md-9">
                                <input name="nameCategory" value="{{$category->name_category}}" class="form-control" type="text">
                                </div>
                                
                            </div>  
                            
                        </div>
                        <div class="card-body">
                            <h4 class="card-title">Hình</h4>
                            <label for="input-file-now-custom-1">Chọn hình</label>
                            <input  type="file" id="input-file-now-custom-1" class="dropify" name="imgCategory" data-default-file='{{asset("public/frontend/img/categories/$category->img_category")}}'/>
                        </div>

                        <div style="text-align: center;" class="card-body">
                            <div class="click2edit m-b-3"></div>
                            <button id="save" class="btn btn-success" type="submit">Cập nhật</button>
                            <a href="{{URL::to('/admin-danh-sach-danh-muc')}}">
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
    <script src="{{asset('public/ckeditor/ckeditor.js')}}"></script>
    <script type="text/javascript">
        CKEDITOR.replace('descTextarea',{
        filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
        filebrowserImageBrowseUrl : 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='  
        });
    </script>

    <!-- dropify --> 
    <script src="{{asset('public/backend/dist/plugins/dropify/dropify.min.js')}}"></script> 
    <script>
        $(document).ready(function(){
        // Basic
        $('.dropify').dropify();

        // Translated
        $('.dropify-fr').dropify({
                        messages: {
                            default: 'Glissez-déposez un fichier ici ou cliquez',
                            replace: 'Glissez-déposez un fichier ou cliquez pour remplacer',
                            remove:  'Supprimer',
                            error:   'Désolé, le fichier trop volumineux'
                        }
                    });

                    // Used events
                    var drEvent = $('#input-file-events').dropify();

                    drEvent.on('dropify.beforeClear', function(event, element){
                        return confirm("Do you really want to delete \"" + element.file.name + "\" ?");
                    });

                    drEvent.on('dropify.afterClear', function(event, element){
                        alert('File deleted');
                    });

                    drEvent.on('dropify.errors', function(event, element){
                        console.log('Has Errors');
                    });

                    var drDestroy = $('#input-file-to-destroy').dropify();
                    drDestroy = drDestroy.data('dropify')
                    $('#toggleDropify').on('click', function(e){
                        e.preventDefault();
                        if (drDestroy.isDropified()) {
                            drDestroy.destroy();
                        } else {
                            drDestroy.init();
                        }
                    })
        });
    </script>