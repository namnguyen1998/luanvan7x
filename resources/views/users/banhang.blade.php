@include('admin.header_admin')
<!-- Left side column. contains the logo and sidebar -->
 @include('users.menu_banhang')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <div class="content">
      @yield('content')
      <!-- /.row -->
      <!-- /.row --> 
    </div>
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  @include('admin.footer_admin')