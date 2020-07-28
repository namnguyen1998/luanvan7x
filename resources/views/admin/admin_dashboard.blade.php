@extends('admin.admin')
@section('content')
<!-- Chartist CSS -->
<link rel="stylesheet" href="{{asset('public/backend/dist/plugins/chartist-js/chartist.min.css')}}">
<link rel="stylesheet" href="{{asset('public/backend/dist/plugins/chartist-js/chartist-plugin-tooltip.css')}}">

<div class="content-header sty-one">
  <h1>Thống kê</h1>
  <ol class="breadcrumb">
    <li><a href="#">Admin</a></li>
    <li><i class="fa fa-angle-right"></i>Thống kê</li>
  </ol>
</div>
<!-- Main content -->
<div class="content">
  <div class="row">
    <div class="col-lg-6 col-sm-6 col-xs-12 m-b-3">
      <div class="card">
        <div class="card-body box-rounded box-gradient"> <span class="info-box-icon bg-transparent"><i class="ti-stats-up text-white"></i></span>
          <div class="info-box-content">
            <h6 class="info-box-text text-white">Đơn Hhàng</h6>
            <h1 id="profit" class="text-white"></h1>
            <span class="progress-description text-white"> Tổng đơn hàng trong 30 ngày gần nhất </span> </div>
        </div>
      </div>
    </div>
  
    <div class="col-lg-6 col-sm-6 col-xs-12 m-b-3">
      <div class="card">
        <div class="card-body box-rounded box-gradient-1"> <span class="info-box-icon bg-transparent"><i class="ti-money text-white"></i></span>
          <div class="info-box-content">
            <h6 class="info-box-text text-white"> Doanh Thu</h6>
            <h1 id="revenue" class="text-white"></h1>
            <span class="progress-description text-white"> Tổng doanh thu trong 30 ngày gần nhất </span> </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /.row -->
  <div class="row">
    <div class="col-lg-6">
      <div class="card m-b-3">
        <div class="card-body">
          <h5 class="m-b-1">Biểu đồ đường hiển thị đơn hàng trong 7 ngày gần nhất</h5>
          <canvas id="line-chart" ></canvas>
        </div>
      </div>
    </div>
    <div class="col-lg-6">
      <div class="card m-b-3">
        <div class="card-body">
          <h5 class="m-b-1">Biểu đồ cột hiển thị doanh thu trong 7 ngày gần nhất</h5>
          <canvas id="bar-chart" data-dataProfit="" height="150"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Chartjs JavaScript --> 
@include('admin.admin_dashboardAjax')

@endsection