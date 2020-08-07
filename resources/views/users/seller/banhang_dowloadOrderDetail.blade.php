<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Thông tin chi tiết đơn hàng</title>
</head>

<body> 
    <style>
        /* reset */
            body {
                font-family: 'DejaVu Sans', sans-serif;
            }
            .column {
                float: left;
                width: auto;
            }
            .column.left {
                float: left;
                width: 50%;
            }
            .column.right {
                float: right;
                width: 50%;
                height: 16%;
                
            }
            @media screen and (max-width: 19cm) {
                .column.left, .column.right {
                    width: 53%;
                }
            }

            /***/
            /*{*/
            /*border: 0;*/
            /*box-sizing: content-box;*/
            /*color: inherit;*/
            /*font-family: inherit;*/
            /*font-size: inherit;*/
            /*font-style: inherit;*/
            /*font-weight: inherit;*/
            /*line-height: inherit;*/
            /*list-style: none;*/
            /*margin: 0;*/
            /*padding: 0;*/
            /*text-decoration: none;*/
            /*vertical-align: top;*/
            /*}*/

            /* content editable */

            *[contenteditable] { border-radius: 0.25em; min-width: 1em; outline: 0; }

            *[contenteditable] { cursor: pointer; }

            *[contenteditable]:hover, *[contenteditable]:focus, td:hover *[contenteditable], td:focus *[contenteditable], img.hover { background: #DEF; box-shadow: 0 0 1em 0.5em #DEF; }

            span[contenteditable] { display: inline-block; }

            /* heading */

            h1 { font: bold 100% sans-serif; letter-spacing: 0.5em; text-align: center; text-transform: uppercase; }

            /* table */

            table { font-size: 75%; table-layout: fixed; width: 100%; }
            table { border-collapse: separate; border-spacing: 2px; }
            

            /* page */

            /*html { font: 16px/1 'Open Sans', sans-serif; overflow: auto; padding: 0.5in; }*/
            /*html { background: #999; cursor: default; }*/

            /*body { box-sizing: border-box; height: 11in; margin: 0 auto; overflow: hidden; padding: 0.5in; width: 8.5in; }*/
            /*body { background: #FFF; border-radius: 1px; box-shadow: 0 0 1in -0.25in rgba(0, 0, 0, 0.5); }*/

            /* header */

            header { margin: 0 0 3em; }
            header:after { clear: both; content: ""; display: table; }

            header h1 { background: #000; border-radius: 0.25em; color: #FFF; margin: 0 0 1em; padding: 0.5em 0; }
            header address { float: left; font-size: 75%; font-style: normal; line-height: 1.25; margin: 0 1em 1em 0; }
            header address p { margin: 0 0 0.25em; }
            header span, header img { display: block; float: right; }
            header span { margin: 0 0 1em 1em; max-height: 25%; max-width: 60%; position: relative; }
            header img { max-height: 100%; max-width: 100%; }
            header input { cursor: pointer; -ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=0)"; height: 100%; left: 0; opacity: 0; position: absolute; top: 0; width: 100%; }

            /* article */

            article, article address, table.meta, table.inventory { margin: 0 0 3em; }
            article:after { clear: both; content: ""; display: table; }
            article h1 { clip: rect(0 0 0 0); position: absolute; }

            article address { float: left; font-size: 125%; font-weight: bold; }

            /* table meta & balance */

            table.meta, table.balance { float: right; width: 45%; }
            table.meta:after, table.balance:after { clear: both; content: ""; display: table; }

            /* table meta */

            table.meta th { width: 40%; }
            table.meta td { width: 60%; }

            /* table items */

            table.inventory { clear: both; width: 100%; }
            table.inventory th { font-weight: bold; text-align: center; }

            table.inventory td:nth-child(1) { width: 26%; }
            table.inventory td:nth-child(2) { width: 38%; }
            table.inventory td:nth-child(3) { text-align: right; width: 12%; }
            table.inventory td:nth-child(4) { text-align: right; width: 12%; }
            table.inventory td:nth-child(5) { text-align: right; width: 12%; }

            /* table balance */

            table.balance th, table.balance td { width: 50%; }
            table.balance td { text-align: right; }

            /* aside */

            aside h1 { border: none; border-width: 0 0 1px; margin: 0 0 1em; }
            aside h1 { border-color: #999; border-bottom-style: solid; }

            /* javascript */

            .add, .cut
            {
                border-width: 1px;
                display: block;
                font-size: .8rem;
                padding: 0.25em 0.5em;
                float: left;
                text-align: center;
                width: 0.6em;
            }

            .add, .cut
            {
                background: #9AF;
                box-shadow: 0 1px 2px rgba(0,0,0,0.2);
                background-image: -moz-linear-gradient(#00ADEE 5%, #0078A5 100%);
                background-image: -webkit-linear-gradient(#00ADEE 5%, #0078A5 100%);
                border-radius: 0.5em;
                border-color: #0076A3;
                color: #FFF;
                cursor: pointer;
                font-weight: bold;
                text-shadow: 0 -1px 2px rgba(0,0,0,0.333);
            }

            .add { margin: -2.5em 0 0; }

            .add:hover { background: #00ADEE; }

            .cut { opacity: 0; position: absolute; top: 0; left: -1.5em; }
            .cut { -webkit-transition: opacity 100ms ease-in; }

            tr:hover .cut { opacity: 1; }
    </style>
    <div class="content-wrapper"> 
        <!-- Content Header (Page header) -->
        <!-- Main content -->
        <div class="content">
            <div class="content-header sty-one">
            <!-- Customize Headear -->
                <span class="logo-lg"><img src="{{asset('public/frontend/img/logo.png')}}" alt=""></span>
                <br>
            <!-- /. Customize Headear -->

            <!-- Customize Body -->
                <div class="card"> 
                    <div class="card-body">
                        <!-- Main content -->
                        <div class="invoice"> 
                            <!-- Title -->
                            <div style="height: 8%" class="row">
                                <div class="col-lg-12 m-b-3">
                                    <address class="text-black" style="text-align: center; font-size: 7mm"> THÔNG TIN CHI TIẾT ĐƠN HÀNG</address>
                                </div>
                            </div>
                            <!-- /. Title -->

                            <!-- Customize From -->
                            <div class="column">
                                <div style="height: 16%" class="column left">Từ
                                        <address>
                                            <strong>Tên Shop: {{ $loadShop->name_shop }}</strong><br>
                                            Địa chỉ: {{ $loadShop->address_shop }}<br>
                                            SĐT: {{ $loadShop->phone_shop }}<br>
                                            Email: {{ $loadShop->email_shop }}
                                        </address>
                                    
                                </div>
                                <!-- /. Customize From -->

                                <!-- Customize To -->
                                <div  class="column right"> Đến
                                    <address>
                                    <strong>Tên Người Nhận: {{ $loadAddressCustomer->name_recipient }}</strong><br>
                                    {{ $loadAddressCustomer->address_customer }}<br>
                                    SĐT: {{ $loadAddressCustomer->phone_recipient }}<br>
                                    </address>
                                </div>
                                <!-- /. Customize To -->
                            </div>
                            
                            <!-- Date Now -->
                            <div style="height: 22%"> 
                                <address>
                                    In ngày: <?php echo  date_format(now()->setTimezone( new DateTimeZone('Asia/Ho_Chi_Minh')), 'd-m-Y H:i:s'); ?>
                                </address>
                            </div>
                            <!-- /. Date Now -->

                            <!-- Table row -->
                            <?php $number = 1; $total = 0; ?>
                            <div class="col-xs-12 table-responsive">
                                <table class="table ">
                                    <thead style="border-bottom: 1.5px solid #ddd">
                                        <tr style="text-align: center">
                                            <th style="width: 10%"># STT</th>
                                            <th style="width: 40%"># Tên sản phẩm</th>
                                            <th style="width: 10%"># SL</th>
                                            <th># Giá</th>
                                            <th># Thành tiền</th>
                                        </tr>
                                    </thead>

                                    @foreach ($loadOrderDetail as $orderDetail)
                                    <tbody style="border-bottom: 1px solid #ddd">
                                        <tr style="text-align: center">
                                            <td><?php echo $number ++; ?></td>
                                            <td>{{ $orderDetail->name_product }}</td>
                                            <td>{{ $orderDetail->quantity }}</td>
                                            <td>{{ number_format($orderDetail->price_product , 0, ',', '.') . " ₫" }}</td>
                                            <td>{{ number_format($orderDetail->price_product * $orderDetail->quantity , 0, ',', '.') . " ₫" }}</td>
                                            <?php $total += $orderDetail->price_product * $orderDetail->quantity; ?>
                                        </tr>
                                    </tbody>
                                    @endforeach
                                </table>
                            </div>
                            <!-- /. Table row --> 

                            <!-- Note -->
                            <div  style="height: 7%" class="col-lg-6">
                                <div class="m-b-3">
                                    <div class="callout callout-info" style="margin-bottom: 0!important;">
                                        <p style="font-size: 15px"><i class="ti-receipt"></i> GHI CHÚ:  {{ $loadOrders->note }}</p>
                                    </div>
                                </div>
                            </div>
                            <!-- /. Note -->

                            <!-- Total Row -->
                            <div style="height: 13%" class="table">
                                <table class="table balance">
                                    <tbody>
                                        <tr>
                                            <th>Tổng GTĐH:</th>
                                            <td> <?php echo number_format($total , 0, ',', '.') . " ₫" ?> </td>
                                        </tr>
                                        <tr>
                                            <th >Phí vận chuyển:</th>
                                            <td>{{ number_format($loadOrders->shipping_cost , 0, ',', '.') . " ₫" }} <?php $shipping_cost = $loadOrders->shipping_cost; ?></td>
                                        </tr>
                                        <tr style="font-size: 150%">
                                            <th>Tổng:</th>
                                            <td> <?php echo number_format($total + $shipping_cost , 0, ',', '.') . " ₫" ?> </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /. Total Row -->
                        </div>
                        <!-- /.content --> 
                    </div>
                </div>
                <!-- /. Customize Body -->
            </div>
        <!-- /.content --> 
        </div>
        <form class="form-group">
            <div class="row">
                <div style="text-align: right; height: 5%" class="col-12">
                    <span>..... Ngày..... Tháng..... Năm.....</span>
                </div>
            </div>
            
            <div style="text-align: center; width: 1180px;">
                <span><i>  Ký tên </i></span>
                    <br>
                    <i style="font-size: 12px">(Ghi gõ Họ và Tên)</i>
            </div>
        </form>
    </div>

</body>
</html>