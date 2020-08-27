  
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
<!-- ./wrapper --> 

<!-- jQuery 3 --> 
<script src="{{asset('public/backend/dist/js/jquery.min.js')}}"></script>  
<script src="{{asset('public/backend/dist/bootstrap/js/bootstrap.min.js')}}"></script>

<!-- template --> 
<script src="{{asset('public/backend/dist/js/bizadmin.js')}}"></script> 

<!-- Jquery Sparklines --> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/jquery.sparkline.min.js')}}"></script> 
<script src="{{asset('public/backend/dist/plugins/jquery-sparklines/sparkline-int.js')}}"></script> 

<!-- CKeditor
<script src="{{asset('public/ckeditor/ckeditor.js')}}"></script>
<script type="text/javascript">
    CKEDITOR.replace('descTextarea',{
      filebrowserBrowseUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
      filebrowserUploadUrl : 'filemanager/dialog.php?type=2&editor=ckeditor&fldr=',
      filebrowserImageBrowseUrl : 'filemanager/dialog.php?type=1&editor=ckeditor&fldr='  
      });
</script> -->

<!-- for demo purposes --> 
<script src="{{asset('public/backend/dist/js/demo.js')}}"></script>
</body>
</html>