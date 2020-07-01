@extends('admin.admin')
@section('content')
<div class="content-header sty-one">
  <h1>Sản phẩm chờ duyệt</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin/dashboard')}}">Admin</a></li>
    <li><i class="fa fa-angle-right"></i>Sản phẩm chờ duyệt</li>
  </ol>
</div>
<div class="table-responsive">
  <table id="example2" class="table table-bordered table-hover" data-name="cool-table">
    <thead>
      <tr>
      	<th>Ngày đăng</th>
        <th>Shop</th>
        <th>Name</th>
        <th>Xuất sứ</th>
        <th>Giá</th>
        <th>Hình</th>
        <th>Trạng thái</th>
        <th>Danh mục</th>
       	<th>Hãng</th>
       	<th>#</th>
      </tr>
    </thead>
    @foreach($listProductsPendingAdmin as $product)
    <tbody>
      <tr>
      	<td>{{$product->created_at}}</td>
        <td>{{$product->email_customer}}</td>
        <td>{{$product->name_product}}</td>
        <td>{{$product->madeby}}</td>
        <td>{{$product->price_product}}</td>
        <td>
          <img src='{{asset("public/frontend/img/product/$product->img_product")}}' height="70" width="70">
          <?php
            if(($product->img1_product)!=null){
          ?>
          <img src='{{asset("public/frontend/img/product/$product->img1_product")}}' height="70" width="70">
          <?php 
            }
          ?>
         <?php
            if(($product->img2_product)!=null){
          ?>
          <img src='{{asset("public/frontend/img/product/$product->img2_product")}}' height="70" width="70">
          <?php 
            }
          ?>
          <?php
            if(($product->img3_product)!=null){
          ?>
          <img src='{{asset("public/frontend/img/product/$product->img3_product")}}' height="70" width="70">
          <?php 
            }
          ?>
        </td>
        <td>
      			<?php
      			if($product->status_product==0){
      			?>
      			<span class="label label-warning">Chờ phê duyệt</span></td>              
      			<?php
      			}else{
      			?>  
      			<span class="label label-success">Đã phê duyệt</span></td>
      			<?php
      			}
      			?>
        </td>
       	<td>{{$product->name_sub}}</td>
        <td>{{$product->name_brand}}</td>
        <td>
          	<a href="#" class="active" ui-toggle-class="">
            <i class="fa fa-check"></i>
           	<a onclick="return confirm('Bạn có muốn xóa danh mục này không')" href="#" class="active" ui-toggle-class="">
            <i class="fa fa-times text-danger text"></i>
          	</a>
        </td>
      </tr>
    </tbody>
     @endforeach
  </table>
  </div>
@endsection