@extends('users.banhang')
@section('content')
  <div class="content-wrapper"> 
        <!-- Content Header (Page header) -->
        <form action="{{URL::to('/admin-them')}}" class="form-horizontal form-bordered" enctype="multipart/form-data" method="POST" >
        <input type="hidden" name="_token" value="{{csrf_token()}}" >
        <!-- Main content -->
        <div class="content">
            <h4 class="text-black">Chọn Danh Mục</h4>
            <div class="row">
                <div class="col-lg-12">
                    <select name="_id_category" id="_id_category" class="form-control">
                        <option value="-1">Chọn</option>
                        @foreach($listCategory as $category)
                            <option value="{{$category->id_category}}">{{$category->name_category}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <hr class="m-t-2 m-b-2">
            <h4 class="text-black">Chọn Loại Danh Mục</h4>
            <div class="row">
                <div class="col-lg-12">
                    <select name="_id_sub_category" id="_id_sub_category" class="form-control">

                    </select>
                </div>
            </div>

            <hr class="m-t-2 m-b-2">
            <h4 class="text-black">Chọn Thương hiệu</h4>
            <div class="row">
                <div class="col-lg-12">
                    <select name="_id_brand" id="_id_brand" class="form-control">
                    <option value="-1">Chọn</option>
                        @foreach($listBrand as $brand)
                            <option value="{{$brand->id_brand}}">{{$brand->name_brand}}</option>
                        @endforeach
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
                                <input name="nameProduct" placeholder="Tên sản phẩm" class="form-control" type="text">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Nơi sản xuất *</label>
                                <div class="col-md-9">
                                <input name="madeby" placeholder="Nơi sản xuất" class="form-control" type="text">
                                </div>
                            </div>
                            
                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Giá *</label>
                                <div class="col-md-9">
                                <input name="price" placeholder="Giá sản phẩm" class="form-control" type="text">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label text-right col-md-3">Ghi chú</label>
                                <div class="col-md-9">
                                <input name="note" class="form-control" type="text">
                                </div>
                            </div>

                            <!-- summernote --> 
                            <div class="col-lg-12">
                                <fieldset class="form-group">
                                <label>Mô tả *</label>
                                <textarea name="description" class="form-control" id="descTextarea" placeholder="Textarea with description" ></textarea>
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
                    <input  type="file" id="input-file-now-custom-1" class="dropify" name="img_product" />
                    </div>
                </div>
            </div>
            
            <hr class="m-t-1 m-b-1">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Hình 2</h4>
                    <label for="input-file-now-custom-1">Chọn hình</label>
                    <input type="file" id="input-file-now-custom-1" class="dropify" name="img1_product" />
                    </div>
                </div>
            </div>

            <hr class="m-t-1 m-b-1">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Hình 3</h4>
                    <label for="input-file-now-custom-1">Chọn hình</label>
                    <input type="file" id="input-file-now-custom-1" class="dropify" name="img2_product" />
                    </div>
                </div>
            </div>

            <hr class="m-t-1 m-b-1">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body">
                    <h4 class="card-title">Hình 4</h4>
                    <label for="input-file-now-custom-1">Chọn hình</label>
                    <input type="file" id="input-file-now-custom-1" class="dropify" name="img3_product"/>
                    </div>
                </div>
            </div>
            <div class="card m-t-3">
            <div style="text-align: center;" class="card-body">
              <div class="click2edit m-b-3"></div>
              <button id="save" class="btn btn-success" onclick="save()" type="submit">Thêm</button>
              <button id="cancel" class="btn btn-info"  type="button">Huỷ</button>
            </div>
          </div>
        </div>
        </form>
        <!-- /.content --> 
    </div>
@endsection
