@extends('admin.admin')
@section('content')
<div class="content-header sty-one">
  <h1>Danh sách sản phẩm</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
    <li><i class="fa fa-angle-right"></i>Danh sách sản phẩm</li>
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
        <th>Trạng thái</th>
        <th>Danh mục</th>
       	<th>Hãng</th>
      </tr>
    </thead>
    @foreach($listProductsApprove as $product)
    <tbody>
      <tr>
      	<td>{{$product->created_at}}</td>
        <td>{{$product->email_customer}}</td>
        <td>{{$product->name_product}}</td>
        <td>{{$product->madeby}}</td>
        <td>{{number_format($product->price_product, 0, ',', '.') . " ₫"}}</td>
        <?php 
              if($product->status_product == 0)
                echo('<td><span class="label label-warning">Đang chờ duyệt</span></td>');
              if ($product->status_product == 1)
                echo('<td><span class="label label-success">Đã phê duyệt</span></td>');
              if ($product->status_product == -1)
                echo('<td><span class="label label-danger">Từ chối duyệt</span></td>')
        ?>
       	<td>{{$product->name_sub}}</td>
        <td>{{$product->name_brand}}</td>
      </tr>
    </tbody>
     @endforeach
  </table>
  </div>
  
@endsection