@include('admin.header_seller')
<!-- Left side column. contains the logo and sidebar -->
@include('users.seller.menu_banhang')
<link rel="stylesheet" href="{{asset('public/backend/dist/bootstrap/css/bootstrap.min.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('public/frontend/css/jquery.datetimepicker.css')}}"/>
<div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <div class="content" >
        <div class="content-header sty-one" >
            <h1>Danh thu</h1>
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/admin-dashboard')}}">Bán hàng</a></li>
                <li><i class="fa fa-angle-right"></i>Danh thu</li>
            </ol>
            <div class="row" >
                <div class="col-10 " >
                        <h4 class="text-black mb-2 mt-2"></h4>
                    </div>
            </div class="content-header sty-one">
        </div>
        <div class="row">
            <div class="col-10" style="height: 45px;" >+ Chọn khoảng thời gian mặc định: 
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
            </div>

            <div class="col-10">
                + Thời gian bắt dầu:
                    <span class="fa fa-calendar" aria-hidden="true"></span>
                    <input id="date_timepicker_start"  type="text">
                Thời gian kết thúc:
                    <span class="fa fa-calendar" aria-hidden="true"></span>
                    <input id="date_timepicker_end"  type="text">
                    
                <button id="submit_filterShop" title="submit">
                    <i class="fa fa-filter" aria-hidden="true"></i> Lọc
                </button>
            </div>
            
            <!-- <div class="col-2 text-right">
                <a class="btn btn-success btn-md mb-2 mt-2" href="#" style="color: white">
                    <i class="fa fa-download" aria-hidden="true"> Xuất file</i> 
                </a>
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
                    </tr>
                </thead>
                @foreach ($loadOrderShop as $order)
                <tbody>
                    <tr style="text-align: center">
                        <th><?php echo $number ++ ;?></th>
                        <td>#{{ $order->orders_id }}</td>
                        <td>{{ date('d-m-Y', strtotime( $order->date )) }}</td>
                        <td>{{ number_format($order->price_order, 0, ',', '.') . " ₫" }}</td>
                        <?php $total_price_order += $order->price_order; ?>
                    </tr>
                </tbody>
                @endforeach
            </table>
            <div class="col-12 text-right font-weight-bold" style="font-size:180%">
                TỔNG:  <?php echo number_format($total_price_order, 0, ',', '.') . " ₫" ?>
            </div>
        </div>
    </div>
    <!-- /.content --> 
    </div>
    <footer class="main-footer">
    <div class="pull-right hidden-xs">Version 1.0</div>
    Copyright © 2018 Yourdomian. All rights reserved.</footer>
  
  <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark"> 
        <!-- Tab panes -->
        <div class="tab-content"> 
        <!-- Home tab content -->
        <div class="tab-pane" id="control-sidebar-home-tab"></div>
        <!-- /.tab-pane --> 
        </div>
    </aside>
  <!-- /.control-sidebar --> 
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
    <div class="control-sidebar-bg"></div>
</div>

<script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  

<!-- template --> 
<script src="{{asset('public/backend/dist/js/bizadmin.js')}}"></script> 

<!-- Jquery Sparklines --> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/jquery.sparkline.min.js')}}"></script> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/sparkline-int.js')}}"></script> 

<!-- Date -->
<script src="{{asset('public/frontend/js/jquery.datetimepicker.full.min.js')}}"></script>  
<script>
   
    jQuery(function(){
        jQuery('#date_timepicker_start').datetimepicker({
            format:'Y/m/d',
            onShow: function(){
                this.setOptions({
                    maxDate:jQuery('#date_timepicker_end').val()?jQuery('#date_timepicker_end').val():false
                })
            },
            timepicker:false
        });
        jQuery('#date_timepicker_end').datetimepicker({
            format:'Y/m/d',
            onShow: function(){
                this.setOptions({
                    minDate:jQuery('#date_timepicker_start').val()?jQuery('#date_timepicker_start').val():false
                })
            },
            timepicker:false
        });
    });

    $(document).ready(function(){
        
        $('#submit_filterShop').on('click', function(){
        // date = []
        start = document.getElementById("date_timepicker_start").value
        end = document.getElementById("date_timepicker_end").value
        // console.log(date)
        $.ajax({
            url:'shop-danh-thu',
            data: {start: start, end: end},
            // dataType:"json",
            type:'GET',
        }).done(function(response){   
            $("#load_revenueShop").empty();
            $("#load_revenueShop").html(response);
        });
        })
    })

    $(document).ready(function(){
        $('#revenueShop').on('change', function(){
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
</script>
</body>
</html>