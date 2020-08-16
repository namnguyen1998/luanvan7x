@extends('admin.admin')
@section('content')

<div class="content-header sty-one">
  <h1>Danh sách danh mục con</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
    <li><i class="fa fa-angle-right"></i>Danh sách danh mục con</li>
  </ol>
  <div class="row">
	  <div class="col-10 ">
	  		<h4 class="text-black mb-2 mt-2"></h4>
		</div>
	  <div class="col-2 text-right">
	    <a href="{{URL::to('/admin-them-danh-muc-con')}}" class="btn btn-success btn-md mb-2 mt-2" style="color: white">
	       + Thêm danh mục con
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
        <th></th>
        <th></th>
        <th scope="col">Tên danh mục con</th>
        <th scope="col">Tên danh mục cha</th>
        <th style="text-align: right" scope="col">Chỉnh sửa</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($listSub as $sub)
      <tr>
        <th><?php echo $number ++ ;?></th>
        <td></td>
        <td></td>
        <td>{{$sub->name_sub}}</td>
        <td>{{$sub->name_category}}</td>
        <td style="text-align: right"><a href="{{URL::to('/admin-sua-danh-muc-con/'.base64_encode(base64_encode($sub->id_sub)))}}"><button class="btn"><span class="icon-wrench"></span></button></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
<span>{!! $listSub->render() !!}</span>
</div>
  
@endsection