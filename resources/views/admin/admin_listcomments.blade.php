@extends('admin.admin')
@section('content')

<div class="content-header sty-one">

  @if(Session::get('success_comment')!=null)
  <div class="alert alert-success">{{Session::get('success_comment')}}</div>
  @endif
  <h1>Danh sách comment</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
    <li><i class="fa fa-angle-right"></i>Danh sách comment</li>
  </ol>
  <div class="row">
	  <div class="col-10 ">
	  		<h4 class="text-black mb-2 mt-2"></h4>
		</div>
	</div>
</div>
<div class="table-responsive">
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Ngày đăng</th>
        <th scope="col">Tên sản phẩm</th>
        <th scope="col">Hình</th>
        <th scope="col">Tên người đăng</th>
        <th scope="col">Nội dung</th>
        <th style="text-align: right" scope="col">Chỉnh sửa</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($listComments as $comment)
      <tr>
        <th>{{$comment->created_at}}</th>
        <td>{{$comment->name_product}}</td>
        <td>
          <img src='{{asset("public/frontend/img/product/$comment->img_product")}}' height="70" width="70">
        </td>
        <td>{{$comment->name_customer}}</td>
        <td>{{$comment->content}}</td>
        <td style="text-align: right"><a href="{{URL::to('/admin-delete-comment/'.$comment->id_comment)}}" class="btn btn-danger fa fa-trash-o"></a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
  <span>{!! $listComments->render() !!}</span>
</div>
  
@endsection