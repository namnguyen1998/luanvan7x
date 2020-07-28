@extends('admin.admin')
@section('content')
<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">

<div class="content-header sty-one">
  <h1>Danh thu</h1>
  <ol class="breadcrumb">
    <li><a href="{{URL::to('/admin-dashboard')}}">Admin</a></li>
    <li><i class="fa fa-angle-right"></i>Danh thu</li>
  </ol>
  <div class="row">
	  <div class="col-10 ">
	  		<h4 class="text-black mb-2 mt-2"></h4>
		</div>
  </div class="content-header sty-one">
</div>
<div class="row">
  <div class="col-10">+ Chọn khoảng thời gian: 
    <select name="revenue" id="revenue">
        <option value="-11">Hôm qua</option>
        <option value="-10" selected>Hôm nay</option>
        <option value="-1">Tháng trước</option>
        <option value="0">Tháng này</option>
        <option value="01">Tháng 1</option>
        <option value="02">Tháng 2</option>
        <option value="03">Tháng 3</option>
        <option value="04">Tháng 4</option>
        <option value="05">Tháng 5</option>
        <option value="06">Tháng 6</option>
        <option value="07">Tháng 7</option>
        <option value="08">Tháng 8</option>
        <option value="09">Tháng 9</option>
        <option value="10">Tháng 10</option>
        <option value="11">Tháng 11</option>
        <option value="12">Tháng 12</option>
    </select>
    <button id="submit_filter" title="submit">
      <i class="fa fa-filter" aria-hidden="true"></i> Lọc
    </button>

    
  </div>
  
</div>

<div id="load_revenue" class="table-responsive">
  <?php
    $number = 1;
    $total_revenue = 0;
  ?>
  <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col"># STT</th>
        <th scope="col"># Shop</th>
        <th scope="col"># Tổng giá trị đơn hàng</th>
        <th scope="col"># Thành tiền (5% TGTĐH)</th>
        
      </tr>
    </thead>
    
  </table>
  <div class="col-12 text-right font-weight-bold" style="font-size:180%">
        TỔNG:  <?php echo number_format($total_revenue, 0, ',', '.') . " ₫" ?>
  </div>
</div>

<script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  
<script>
  $(document).ready(function(){
    $('#submit_filter').on('click', function(){
      val_revenue = document.getElementById("revenue").value
      $.ajax({
        url:'admin-load-revenue/'+val_revenue,
        type:'GET',
      }).done(function(response){     
        $("#load_revenue").empty();
        $("#load_revenue").html(response);
      });
    })
  })
</script>
@endsection