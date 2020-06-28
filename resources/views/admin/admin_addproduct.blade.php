
@include('admin.header_admin')
    <!-- Left side column. contains the logo and sidebar -->
    <!-- dropify in ADMIN  -->
    <link rel="stylesheet" href="{{asset('public/backend/dist/plugins/dropify/dropify.min.css')}}">
 
@include('admin.menu_admin')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper"> 
        <!-- Content Header (Page header) -->
        <form action="#" class="form-horizontal form-bordered">
        <!-- Main content -->
        <div class="content">
            <h4 class="text-black">Chọn Danh Mục</h4>
            <div class="row">
                <div class="col-lg-12">
                    <select class="form-control">
                        @foreach($listCategory as $category)
                        <option value="">{{$category->name_category}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr class="m-t-2 m-b-2">
            <h4 class="text-black">Chọn Loại Danh Mục</h4>
            <div class="row">
                <div class="col-lg-12">
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>

            <hr class="m-t-2 m-b-2">
            <h4 class="text-black">Chọn Thương hiệu</h4>
            <div class="row">
                <div class="col-lg-12">
                    <select class="form-control">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>

            <hr class="m-t-2 m-b-2">
            <div class="row m-t-3">
                <div class="col-lg-12">
                <div class="card">
                    <div class="card-header bg-blue">
                    <h5 class="m-b-0">Thông tin khác</h5>
                    </div>
                    <div class="card-body">
                        <div class="form-body">
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Tên sản phẩm *</label>
                                <div class="col-md-9">
                                <input placeholder="Tên sản phẩm" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nơi sản xuất *</label>
                                <div class="col-md-9">
                                <input placeholder="Nơi sản xuất" class="form-control" type="text">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Ghi chú</label>
                                <div class="col-md-9">
                                <input class="form-control" type="text">
                                </div>
                            </div>

                            <!-- summernote --> 
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                <label>Mô tả *</label>
                                <textarea class="form-control" id="descTextarea" placeholder="Textarea with description" ></textarea>
                                </fieldset>
                            </div>
                        </div>

                        

                    </div>
                </div>
                </div>
            </div>
            
            <hr class="m-t-2 m-b-2">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Hình 1</h4>
                    <label for="input-file-now-custom-1">Chọn hình</label>
                    <input type="file" id="input-file-now-custom-1" class="dropify" data-default-file="{{asset('public/backend/dist/img/img13.jpg')}}" />
                    </div>
                </div>
            </div>
            
            <hr class="m-t-1 m-b-1">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Hình 2</h4>
                    <label for="input-file-now-custom-1">Chọn hình</label>
                    <input type="file" id="input-file-now-custom-1" class="dropify" />
                    </div>
                </div>
            </div>

            <hr class="m-t-1 m-b-1">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Hình 3</h4>
                    <label for="input-file-now-custom-1">Chọn hình</label>
                    <input type="file" id="input-file-now-custom-1" class="dropify" />
                    </div>
                </div>
            </div>

            <hr class="m-t-1 m-b-1">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Hình 4</h4>
                    <label for="input-file-now-custom-1">Chọn hình</label>
                    <input type="file" id="input-file-now-custom-1" class="dropify" />
                    </div>
                </div>
            </div>
            <div class="card m-t-3">
            <div style="text-align: center;" class="card-body">
              <div class="click2edit m-b-3"></div>
              <button id="save" class="btn btn-success" onclick="save()" type="button">Thêm</button>
              <button id="cancel" class="btn btn-info"  type="button">Huỷ</button>
            </div>
          </div>
        </div>
        </form>
        <!-- /.content --> 
    </div>
    
    <!-- jQuery 3 --> 
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

    </body>
</html>
