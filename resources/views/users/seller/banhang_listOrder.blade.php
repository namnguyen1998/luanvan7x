@extends('users.seller.banhang')
@section('content')
<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">

<div class="content-header sty-one">
    <h1>Danh thu</h1>
    <ol class="breadcrumb">
        <li><a href="{{URL::to('/dashboard')}}">Bán hàng</a></li>
        <li><i class="fa fa-angle-right"></i>Danh sách đơn hàng</li>
    </ol>
    <div class="row">
        <div class="col-10 ">
                <h4 class="text-black mb-2 mt-2"></h4>
            </div>
    </div class="content-header sty-one">
</div>
<div class="row">
    <!-- <div class="col-10">+ Chọn khoảng thời gian: 
        <select name="revenue" id="revenueShop">
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
        <button id="submit_filterShop" title="submit">
        <i class="fa fa-filter" aria-hidden="true"></i> Lọc
        </button>
    </div> -->
  
</div>

<div id="load_revenueShop" class="table-responsive">
    <?php
        $number = 1;
        $total_price_order = 0;
    ?>
    <table class="table table-striped">
        <thead>
            <tr style="text-align: center">
                <th scope="col"># STT</th>
                <th scope="col"># Mã đơn hàng</th>
                <th scope="col"># Ngày</th>
                <th scope="col"># Giá trị đơn hàng</th>
                <th scope="col"># Chi tiết</th>
            </tr>
        </thead>
       @foreach ($loadOrderShop as $order)
        <tbody>
            <tr style="text-align: center">
                <th><?php echo $number ++ ;?></th>
                <td>#{{ $order->orders_id }}</td>
                <td>{{ date('d-m-Y', strtotime( $order->created_at ))}}</td>
                <td>{{ number_format( $order->price_order, 0, ',', '.') . " ₫" }}</td>
                <td><a href="{{URL::to('/chi-tiet-don-hang/'.$order->orders_id)}}"><button class="btn"><span class="ti-github"></span></button></a></td>
            </tr>
        </tbody>
       @endforeach
    </table>
    
</div>

<!-- <script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  
<script>
    $(document).ready(function(){
        $('#submit_filterShop').on('click', function(){
        val_revenue = document.getElementById("revenueShop").value
        $.ajax({
            url:'shop-danh-thu/'+val_revenue,
            type:'GET',
        }).done(function(response){   
            $("#load_revenueShop").empty();
            $("#load_revenueShop").html(response);
        });
        })
    })
</script> -->
@endsection
