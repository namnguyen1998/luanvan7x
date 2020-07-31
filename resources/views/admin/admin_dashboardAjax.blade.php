<script src="{{asset('public/backend/dist/plugins/chartjs/chart.min.js')}}"></script> 
<script src="{{asset('public/backend/dist/plugins/chartjs/chart-int.js')}}"></script> 

<script src="{{asset('public/backend/dist/js/moment.min.js')}}"></script>
<script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  

<script>
// ======	
    // Profit
// ======	
    $(document).ready(function(){
        $.ajax({
            url:'admin-profit/',
            type:'GET',
        }).done(function(response){ 
            document.getElementById("profit").innerHTML = response
        });
        
// ======	
    // Revenue
// ======	     
        $.ajax({
            url:'admin-revenue/',
            type: 'GET',
        }).done(function(response){
            revenue = parseInt(response * 0.02)
            response = Intl.NumberFormat('de-DE', { style: 'currency', currency: 'VND' }).format(revenue)
            document.getElementById("revenue").innerHTML = response
        });
    })

// ======	
    // Bar chart
// ======	
    $.ajax({
            url:'admin-chart-revenue/',
            type:'GET',
        }).done(function(response){ 
            dataRevenue = []
            dataDateRevenue = []
            $.each(response, function(key, value){
                dataRevenue.push(parseInt(value.revenue * 0.02))
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
        url:'admin-chart-profit/',
        type:'GET',
    }).done(function(response){ 
        console.log(response)
        dataProfit = []
        dataDate = []
        $.each(response, function(key, value){
            dataProfit.push(value.profit)
            dataDate.push(moment(value.date).format('DD/MM/YYYY'))
        })
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',
            // The data for our dataset
            data: {
                labels: dataDate,
                datasets: [{
                    label: "Đơn hàng",
                    //backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(88, 103, 221)',
                    data: dataProfit,
                            fill: false,
                        }, 
                    ]},
            options: {
                responsive: true
            }
        })
    })
      
</script>
