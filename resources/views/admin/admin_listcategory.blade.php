@extends('admin.admin')
@section('content')

<div class="content-header sty-one">
  <h1>Danh sách danh mục</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
    <li><i class="fa fa-angle-right"></i>Danh sách danh mục</li>
  </ol>
  <div class="row">
	  <div class="col-10 ">
	  		<h4 class="text-black mb-2 mt-2"></h4>
		</div>
	  <div class="col-2 text-right">
	    <a href="{{URL::to('/admin-them-danh-muc')}}" class="btn btn-success btn-md mb-2 mt-2" style="color: white">
	       + Thêm danh mục
	    </a>
	</div>
</div>
</div>
<div class="table-responsive">
  <?php
    if (!empty(Session::get('message'))){
        echo'<div class = "alert-success">'.Session::get('message').'</div></br>';
        Session::put('message', null);
    }
    $number = 1;
  ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">STT</th>
        <th scope="col">Tên danh mục</th>
        <th scope="col">Hình</th>
        <th style="text-align: right" scope="col">Chỉnh sửa</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($listCategory as $category)
      <tr>
        <th><?php echo $number ++ ;?></th>
        <td>{{$category->name_category}}</td>
        <td>
          <?php
            if(!empty($category->img_category)){?>
              <img src='{{asset("public/frontend/img/categories/$category->img_category")}}' height="70" width="70">
            <?php
            }
          ?>
        </td>
        <td style="text-align: right"><a href="{{URL::to('/admin-sua-danh-muc/'.$category->id_category)}}"><button class="btn"><span class="icon-wrench"></span></button></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <span>{!! $listCategory->render() !!}</span>
</div>
  
@endsection