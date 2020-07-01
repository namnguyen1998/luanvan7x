@include('admin.header_admin')
<!-- Left side column. contains the logo and sidebar -->
 @include('admin.menu_admin')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper"> 
    <!-- Content Header (Page header) -->
    @yield('content')
    <!-- /.content --> 
  </div>
  <!-- /.content-wrapper -->
  @include('admin.footer_admin')