@include('admin.header_admin')
<!-- Left side column. contains the logo and sidebar -->
 @include('admin.menu_admin')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
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
        <div class="col-lg-3 col-sm-6 col-xs-12 m-b-3">
          <div class="card">
            <div class="card-body box-rounded box-gradient"> <span class="info-box-icon bg-transparent"><i class="ti-stats-up text-white"></i></span>
              <div class="info-box-content">
                <h6 class="info-box-text text-white">New Orders</h6>
                <h1 class="text-white">5,500</h1>
                <span class="progress-description text-white"> 70% Increase in 30 Days </span> </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12 m-b-3">
          <div class="card">
            <div class="card-body box-rounded box-gradient-4"> <span class="info-box-icon bg-transparent"><i class="ti-face-smile text-white"></i></span>
              <div class="info-box-content">
                <h6 class="info-box-text text-white">New Users</h6>
                <h1 class="text-white">2,040</h1>
                <span class="progress-description text-white"> 45% Increase in 30 Days </span> </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12 m-b-3">
          <div class="card">
            <div class="card-body box-rounded box-gradient-2"> <span class="info-box-icon bg-transparent"><i class="ti-bar-chart text-white"></i></span>
              <div class="info-box-content">
                <h6 class="info-box-text text-white">Online Revenue</h6>
                <h1 class="text-white">6,450</h1>
                <span class="progress-description text-white"> 65% Increase in 30 Days </span> </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-sm-6 col-xs-12 m-b-3">
          <div class="card">
            <div class="card-body box-rounded box-gradient-3"> <span class="info-box-icon bg-transparent"><i class="ti-money text-white"></i></span>
              <div class="info-box-content">
                <h6 class="info-box-text text-white">Total Profit</h6>
                <h1 class="text-white">$ 8,590</h1>
                <span class="progress-description text-white"> 45% Increase in 30 Days </span> </div>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <div class="row">
        <div class="col-lg-6">
          <div class="card m-b-3">
            <div class="card-body">
              <h5 class="m-b-1">Sales Analytics</h5>
              <canvas id="line-chart"></canvas>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="card m-b-3">
            <div class="card-body">
              <h5 class="m-b-1">Marketplaces</h5>
              <canvas id="bar-chart" height="150"></canvas>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
      
      <div class="row">
        <div class="col-xl-4 m-b-3">
          <div class="bg-aqua-gradient">
            <div class="card-body">
              <h5 class="text-white">Bandwidth usage</h5>
              <h1 class="text-white font-weight-200">1,350 GB</h1>
              <h5 class="text-white m-b-3">April 2018</h5>
              <div id="spa-line-2"></div>
              <p class="text-white m-t-2">Lorem ipsum dolor sit amet moles tiae, consectetur adipisicing elit users.</p>
            </div>
          </div>
        </div>
        <div class="col-xl-8">
          <div class="info-box">
            <div class="card-header">
              <h5 class="card-title">Recent Sales <a class="btn btn-sm btn-primary pull-right text-white">View all</a></h5>
            </div>
            <div class="table-responsive">
              <table class="table table-hover">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Customer</th>
                    <th>Categories</th>
                    <th>Progress</th>
                    <th>Amount</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>iPone X</td>
                    <td><img src="dist/img/img1.jpg" class="img-circle img-w-30" alt="User Image"></td>
                    <td><button type="button" class="btn btn-sm btn-outline-danger btn-rounded">Mobile</button></td>
                    <td><div class="progress progress-sm">
                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 85%" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100"></div>
                      </div></td>
                    <td>$ 5,500</td>
                  </tr>
                  <tr>
                    <td>OPPP</td>
                    <td><img src="dist/img/img2.jpg" class="img-circle img-w-30" alt="User Image"></td>
                    <td><button type="button" class="btn btn-sm btn-outline-success btn-rounded">Tablet</button></td>
                    <td><div class="progress progress-sm">
                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width: 75%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                      </div></td>
                    <td>$ 3,450</td>
                  </tr>
                  <tr>
                    <td>iPad</td>
                    <td><img src="dist/img/img3.jpg" class="img-circle img-w-30" alt="User Image"></td>
                    <td><button type="button" class="btn btn-sm btn-outline-danger btn-rounded">Mobile</button></td>
                    <td><div class="progress progress-sm">
                        <div class="progress-bar bg-gradient-x-danger" role="progressbar" style="width: 70%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100"></div>
                      </div></td>
                    <td>$ 1,040</td>
                  </tr>
                  <tr>
                    <td>OnePlus</td>
                    <td><img src="dist/img/img1.jpg" class="img-circle img-w-30" alt="User Image"></td>
                    <td><button type="button" class="btn btn-sm btn-outline-success btn-rounded">Tablet</button></td>
                    <td><div class="progress progress-sm">
                        <div class="progress-bar bg-gradient-x-success" role="progressbar" style="width:65%" aria-valuenow="65" aria-valuemin="0" aria-valuemax="100"></div>
                      </div></td>
                    <td>$ 2,200</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
      <!-- /.row -->
      <!-- /.row --> 
    </div>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  @include('admin.footer_admin')