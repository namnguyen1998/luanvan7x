@extends('users.seller.banhang')
@section('content')
 <div class="content col-12">
  <div class="card">
  <div class="card-body">
  	<div class="row">
	  <div class="col-10 ">
	  		<h4 class="text-black mb-2 mt-2">Danh sách sản phẩm đang bán</h4>
		</div>
	  <div class="col-2 text-right">
	    <a class="btn btn-success btn-md mb-2 mt-2" href="{{URL::to('/them-san-pham')}}" style="color: white">
	       + ADD PRODUCT
	    </a>
	</div>
</div>
<div class="table-responsive">
  <table id="example2" class="table table-bordered table-hover" data-name="cool-table">
    <thead>
      <tr>
      	<th>Ngày đăng</th>
        <th>Name</th>
        <th>Xuất sứ</th>
        <th>Giá</th>
        <th>Hình</th>
        <th>Trạng thái</th>
        <th>Danh mục</th>
        <th>Loại</th>
       	<th>Hãng</th>
        <th>Mô tả</th>
      </tr>
    </thead>
    @foreach($listProducts as $product)
    <tbody>
      <tr>
      	<td>{{$product->created_at}}</td>
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
        <td>{!!$product->description_product!!}</td>
      </tr>
    </tbody>
     @endforeach
  </table>
  </div>
</div></div>
</div>
@endsection