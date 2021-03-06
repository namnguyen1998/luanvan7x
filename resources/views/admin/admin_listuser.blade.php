@extends('admin.admin')
@section('content')

<div class="content-header sty-one">
  <h1>Danh sách nhân viên</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
    <li><i class="fa fa-angle-right"></i>Danh sách nhân viên</li>
  </ol>
  <div class="row">
	  <div class="col-10 ">
	  		<h4 class="text-black mb-2 mt-2"></h4>
		</div>
	  <div class="col-2 text-right">
	    <a href="{{URL::to('/admin-them-nhan-vien')}}" class="btn btn-success btn-md mb-2 mt-2" style="color: white">
	       + Thêm nhân viên
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
        <th scope="col">Tên nhân viên</th>
        <th scope="col">Email</th>
        <th scope="col">SĐT</th>
        <th scope="col">Quyền</th>
        <th style="text-align: right" scope="col">Thay đổi quyền</th>
        <th style="text-align: right" scope="col">Đặt lại mật khẩu</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($listUser as $user)
      <tr>
        <th><?php echo $number ++ ;?></th>
        <td>{{$user->name_user}}</td>
        <td>{{$user->email_user}}</td>
        <td>{{$user->phone_user}}</td>
        <td>{{$user->name_role}}</td>

        @if ($user->id_role != 1)
        <form action="{{URL::to('/admin-sua-quyen-nhan-vien')}}" method="post">
          @csrf
            <input hidden name="id_users" value="{{ base64_encode(base64_encode($user->id_users)) }}">
            <td meth style="text-align: right"><button class="btn"><span class="icon-wrench"></span></button></td>
        </form>

        <form action="{{URL::to('/admin-dat-lai-mat-khau')}}" method="post">
          @csrf
          <input hidden name="id_users" value="{{base64_encode(base64_encode($user->id_users))}}">
          <td style="text-align: right"><button class="btn"><span class="icon-wrench"></span></button></td>
        </form>
        @endif

        <?php if($user->id_role == 1) { ?>
            <td> </td><td></td>
        <?php } ?>
        
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
  
@endsection