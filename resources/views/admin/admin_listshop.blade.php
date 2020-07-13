@extends('admin.admin')
@section('content')
<div class="content-header sty-one">
  <h1>Danh sách Shop</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
    <li><i class="fa fa-angle-right"></i>Danh sách Shop</li>
  </ol>
</div>
<div class="table-responsive">
  <table id="example2" class="table table-bordered table-hover" data-name="cool-table">
    <thead>
      <tr>
        <th>Ngày</th>
      	<th>Tên Shop</th>
        <th>Email</th>
        <th>SĐT</th>
        <th>Địa chỉ</th>
        <th>Trạng thái</th>
        
      </tr>
    </thead>
    @foreach($listShop as $shop)
    <tbody>
      <tr>
      	<td>{{$shop->created_at}}</td>
        <td>{{$shop->name_shop}}</td>
        <td>{{$shop->email_shop}}</td>
        <td>{{$shop->phone_shop}}</td>
        <td>{{$shop->address_shop}}</td>
        <?php 
              if($shop->status_shop == 0)
                echo('<td><span class="label label-warning">Đang chờ duyệt</span></td>');
              if ($shop->status_shop == 1)
                echo('<td><span class="label label-success">Đã phê duyệt</span></td>');
              if ($shop->status_shop == -1)
                echo('<td><span class="label label-danger">Từ chối duyệt</span></td>')
        ?>
       	
      </tr>
    </tbody>
     @endforeach
  </table>
  </div>
  
@endsection