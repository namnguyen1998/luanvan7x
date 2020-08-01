<script src="{{asset('public/frontend/plugins/chartjs/chart.min.js')}}"></script> 
<script src="{{asset('public/frontend/plugins/chartjs/chart-int.js')}}"></script> 

<script src="{{asset('public/frontend/js/moment.min.js')}}"></script>
<script src="{{asset('public/frontend/js/jquery-3.3.1.min.js')}}"></script>  
<script>
// ======	
    // Profit
// ======	
    $(document).ready(function(){
        $.ajax({
            url:'shop-profit/',
            type:'GET',
        }).done(function(response){ 
            document.getElementById("profitShop").innerHTML = response
        });
        
// ======	
    // Revenue
// ======	     
        $.ajax({
            url:'shop-revenue/',
            type: 'GET',
        }).done(function(response){
            // console.log(response)
            revenue = parseInt(response)
            response = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(revenue)
            document.getElementById("revenueShop").innerHTML = response
        });

// ======	
    // Bar chart
// ======	
        $.ajax({
                url:'shop-chart-revenue/',
                type:'GET',
            }).done(function(response){ 
                dataRevenue = []
                dataDateRevenue = []
                $.each(response, function(key, value){
                    dataRevenue.push(parseInt(value.revenue))
                    dataDateRevenue.push(moment(value.date).format('DD/MM/YYYY'))
                })
                var ctx = document.getElementById('bar-chart').getContext('2d')
                var chart = new Chart(ctx, {
                    // The type of chart we want to create
                    type: 'bar',
                    // The data for our dataset
                    data: {
                        labels: dataDateRevenue,
                        datasets: [{
                            label: "Doanh thu",
                            backgroundColor: 'rgb(88, 103, 221)',
                            borderColor: 'rgb(88, 103, 221)',
                            data: dataRevenue,
                                fill: false,
                            },]},
                    options: {
                        responsive: true
                    }
                })
            })  

// ======
    // Line chart
// ======
    var ctx = document.getElementById('line-chart').getContext('2d')
    $.ajax({
            url:'shop-chart-profit/',
            type:'GET',
        }).done(function(response){ 
            dataChartProfit = []
            dataChartDate = []
            $.each(response, function(key, value){
                dataChartProfit.push(value)
                dataChartDate.push(moment(key).format('DD/MM/YYYY'))
            })
            var chart = new Chart(ctx, {
                // The type of chart we want to create
                type: 'line',
                // The data for our dataset
                data: {
                    labels: dataChartDate,
                    datasets: [{
                        label: "Đơn hàng",
                        //backgroundColor: 'rgb(255, 99, 132)',
                        borderColor: 'rgb(88, 103, 221)',
                        data: dataChartProfit,
                                fill: false,
                            }, 
                        ]},
                options: {
                    responsive: true
                }
            })
        })
    })
</script>
