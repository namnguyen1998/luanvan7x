<aside class="main-sidebar"> 
    <!-- sidebar -->
    <div class="sidebar"> 
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image text-center"><img src="{{asset('public/backend/dist/img/img1.jpg')}}" class="img-circle" alt="User Image"> </div>
        <div class="info">
            <p>{{Session::get('username_user')}}</p>
            <a href="#"><i class="fa fa-envelope"></i></a>
            <a href="{{URL::to('/thong-tin-ca-nhan')}}"><i class="fa fa-gear"></i></a> 
            <a href="{{URL::to('/logout-admin')}}"><i class="fa fa-power-off"></i></a> 
        </div>
      </div>
      
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">PERSONAL</li>
        <li class="treeview"> <a href="#"> <i class="icon-home"></i> <span>Thống kê</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::to('/admin-doanh-thu-don-hang')}}"><i class="fa fa-angle-right"></i>Doanh thu theo đơn hàng</a></li>
            <!-- <li><a href="{{URL::to('/admin-doanh-thu-shop')}}"><i class="fa fa-angle-right"></i> Doanh thu theo Shop</a></li> -->
            <!-- <li class="active"><a href="index-agency.html"><i class="fa fa-angle-right"></i> Agency</a></li>
            <li><a href="index-analytics.html"><i class="fa fa-angle-right"></i> Analytics</a></li>
            <li><a href="index-ecommerce.html"><i class="fa fa-angle-right"></i> Ecommerce</a></li> -->
          </ul>
        </li>
        
        <!-- Admin -->
        @if (Session::get('role_id') == 1)
        <li class="treeview"> <a href="#"> <i class="icon-grid"></i> <span>Quản lý danh mục</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
          <li><a href="{{URL::to('admin-danh-sach-danh-muc')}}"><i class="fa fa-angle-right"></i> Danh mục cha</a></li>
            <li><a href="{{URL::to('admin-danh-sach-danh-muc-con')}}"><i class="fa fa-angle-right"></i> Danh mục con</a></li>
          </ul>
        </li>

        <li class="treeview"> <a href="#"> <i class="icon-grid"></i> <span>Quản lý sản phẩm</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
          <li><a href="{{URL::to('admin-danh-sach-san-pham')}}"><i class="fa fa-angle-right"></i> Tất cả sản phẩm</a></li>
            <li><a href="{{URL::to('admin-danh-sach-san-pham-cho-duyet')}}"><i class="fa fa-angle-right"></i> Sản phẩm chờ duyệt</a></li>
          </ul>
        </li>
        <!-- <li class="treeview"> <a href="#"> <i class="ti-email"></i> <span>Inbox</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="apps-mailbox.html"><i class="fa fa-angle-right"></i> Mailbox</a></li>
            <li><a href="apps-mailbox-detail.html"><i class="fa fa-angle-right"></i> Mailbox Detail</a></li>
            <li><a href="apps-compose-mail.html"><i class="fa fa-angle-right"></i> Compose Mail</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="icon-frame"></i> <span>UI Elements</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="ui-cards.html" class="active"><i class="fa fa-angle-right"></i> Cards</a></li>
            <li><a href="ui-user-card.html"><i class="fa fa-angle-right"></i> User Cards</a></li>
            <li><a href="ui-tab.html"><i class="fa fa-angle-right"></i> Tab</a></li>
            <li><a href="ui-grid.html"><i class="fa fa-angle-right"></i> Grid</a></li>
            <li><a href="ui-buttons.html"><i class="fa fa-angle-right"></i> Buttons</a></li>
            <li><a href="ui-notification.html"><i class="fa fa-angle-right"></i> Notification</a></li>
            <li><a href="ui-progressbar.html"><i class="fa fa-angle-right"></i> Progressbar</a></li>
            <li><a href="ui-range-slider.html"><i class="fa fa-angle-right"></i> Range slider</a></li>
            <li><a href="ui-timeline.html"><i class="fa fa-angle-right"></i> Timeline</a></li>
            <li><a href="ui-horizontal-timeline.html"> <i class="fa fa-angle-right"></i> Horizontal Timeline</a></li>
            <li><a href="ui-breadcrumb.html"><i class="fa fa-angle-right"></i> Breadcrumb</a></li>
            <li><a href="ui-typography.html"><i class="fa fa-angle-right"></i> Typography</a></li>
            <li><a href="ui-bootstrap-switch.html"><i class="fa fa-angle-right"></i> Bootstrap Switch</a></li>
            <li><a href="ui-tooltip-popover.html"><i class="fa fa-angle-right"></i> Tooltip &amp; Popover</a></li>
            <li><a href="ui-list-media.html"><i class="fa fa-angle-right"></i> List Media</a></li>
            <li><a href="ui-carousel.html"><i class="fa fa-angle-right"></i> Carousel</a></li>
          </ul>
        </li> -->

        <li class="header">FORMS, TABLE & WIDGETS</li>
        <li class="treeview"> <a href="#"> <i class="icon-note"></i> <span>Quản lý nhân viên</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::to('admin-danh-sach-nhan-vien')}}"><i class="fa fa-angle-right"></i> Danh sách nhân viên</a></li>
            <!-- <li><a href="form-validation.html"><i class="fa fa-angle-right"></i> Cấp quyền nhân viên</a></li>
            <li><a href="form-wizard.html"><i class="fa fa-angle-right"></i> Form Wizard</a></li>
            <li><a href="form-layouts.html"><i class="fa fa-angle-right"></i> Form Layouts</a></li>
            <li><a href="form-uploads.html"><i class="fa fa-angle-right"></i> Form File Upload</a></li>
            <li><a href="form-summernote.html"><i class="fa fa-angle-right"></i> Summernote</a></li> -->
          </ul>
        </li>

        <li class="treeview"> <a href="#"> <i class="fa fa-table"></i> <span>Quản lý Shop</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::to('admin-danh-sach-shop')}}"><i class="fa fa-angle-right"></i> Danh sách Shop</a></li>
            <li><a href="{{URL::to('admin-danh-sach-shop-cho-phe-duyet')}}"><i class="fa fa-angle-right"></i> DS Shop chờ phê duyệt</a></li>
            <li><a href="{{URL::to('admin-danh-sach-shop-tam-ngung-hoat-dong')}}"><i class="fa fa-angle-right"></i> DS Shop bị tạm ngưng hoạt động</a></li>
            <!-- <li><a href="table-jsgrid.html"><i class="fa fa-angle-right"></i> Js Grid Table</a></li> -->
          </ul>
        </li>
        <!-- <li class="treeview"> <a href="#"> <i class="icon-layers"></i> <span>Widgets</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="widget-data.html"><i class="fa fa-angle-right"></i> Data Widgets</a></li>
            <li><a href="widget-apps.html"><i class="fa fa-angle-right"></i> Apps Widgets</a></li>
          </ul>
        </li>
        <li class="header">EXTRA COMPONENTS</li>
        <li class="treeview"> <a href="#"><i class="icon-chart"></i> <span>Charts</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="chart-morris.html"><i class="fa fa-angle-right"></i> Morris Chart</a></li>
            <li><a href="chart-chartist.html"><i class="fa fa-angle-right"></i> Chartis Chart</a></li>
            <li><a href="chart-knob.html"><i class="fa fa-angle-right"></i> Knob Chart</a></li>
            <li><a href="chart-chart-js.html"><i class="fa fa-angle-right"></i> Chartjs</a></li>
            <li><a href="chart-peity.html"><i class="fa fa-angle-right"></i> Peity Chart</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="icon-docs"></i> <span>Sample Pages</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="pages-blank.html"><i class="fa fa-angle-right"></i> Blank page</a></li>
            <li class="treeview"><a href="#"><i class="fa fa-angle-right"></i> Authentication <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
              <ul class="treeview-menu">
                <li><a href="pages-login.html"><i class="fa fa-angle-right"></i> Login 1</a></li>
                <li><a href="pages-login-2.html"><i class="fa fa-angle-right"></i> Login 2</a></li>
                <li><a href="pages-register.html"><i class="fa fa-angle-right"></i> Register</a></li>
                <li><a href="pages-register2.html"><i class="fa fa-angle-right"></i> Register 2</a></li>
                <li><a href="pages-lockscreen.html"><i class="fa fa-angle-right"></i> Lockscreen</a></li>
                <li><a href="pages-recover-password.html"><i class="fa fa-angle-right"></i> Recover password</a></li>
              </ul>
            </li>
            <li><a href="pages-profile.html"><i class="fa fa-angle-right"></i> Profile page</a></li>
            <li><a href="pages-invoice.html"><i class="fa fa-angle-right"></i> Invoice</a></li>
            <li><a href="pages-treeview.html"><i class="fa fa-angle-right"></i> Treeview</a></li>
            <li><a href="pages-pricing.html"><i class="fa fa-angle-right"></i> Pricing</a></li>
            <li><a href="pages-gallery.html"><i class="fa fa-angle-right"></i> Gallery</a></li>
            <li><a href="pages-faq.html"><i class="fa fa-angle-right"></i> Faqs</a></li>
            <li><a href="pages-404.html"><i class="fa fa-angle-right"></i> 404 Error Page</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="icon-location-pin"></i> <span>Maps</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="map-google.html"><i class="fa fa-angle-right"></i> Google Maps</a></li>
            <li><a href="map-vector.html"><i class="fa fa-angle-right"></i> Vector Maps</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="icon-energy"></i> <span>Icons</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="icon-fontawesome.html"><i class="fa fa-angle-right"></i> Fontawesome Icons</a></li>
            <li><a href="icon-themify.html"><i class="fa fa-angle-right"></i> Themify Icons</a></li>
            <li><a href="icon-weather.html"><i class="fa fa-angle-right"></i> Weather Icons</a></li>
            <li><a href="icon-simple-lineicon.html"><i class="fa fa-angle-right"></i> Simple Lineicons</a></li>
            <li><a href="icon-flag.html"><i class="fa fa-angle-right"></i> Flag Icons</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="icon-action-redo"></i> <span>Multilevel</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="#"><i class="fa fa-angle-right"></i> Level One</a></li>
            <li class="treeview"> <a href="#"><i class="fa fa-angle-right"></i> Level One <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
              <ul class="treeview-menu">
                <li><a href="#"><i class="fa fa-angle-right"></i> Level Two</a></li>
                <li class="treeview"> <a href="#" ><i class="fa fa-angle-right"></i> Level Two <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
                  <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-angle-right"></i> Level Three</a></li>
                    <li><a href="#"><i class="fa fa-angle-right"></i> Level Three</a></li>
                  </ul>
                </li>
              </ul>
            </li>
            <li><a href="#"><i class="fa fa-angle-right"></i> Level One</a></li>
          </ul>
        </li> -->

        <!-- Quản lý danh muc -->
        @elseif (Session::get('role_id') == 2)
        <li class="treeview"> <a href="#"> <i class="icon-grid"></i> <span>Quản lý danh mục</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
          <li><a href="{{URL::to('admin-danh-sach-danh-muc')}}"><i class="fa fa-angle-right"></i> Danh mục cha</a></li>
            <li><a href="{{URL::to('admin-danh-sach-danh-muc-con')}}"><i class="fa fa-angle-right"></i> Danh mục con</a></li>
          </ul>
        </li>

        <!-- Quản lý sản phẩm -->
        @elseif (Session::get('role_id') == 3)
        <li class="treeview"> <a href="#"> <i class="icon-grid"></i> <span>Quản lý sản phẩm</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
          <li><a href="{{URL::to('admin-danh-sach-san-pham')}}"><i class="fa fa-angle-right"></i> Tất cả sản phẩm</a></li>
            <li><a href="{{URL::to('admin-danh-sach-san-pham-cho-duyet')}}"><i class="fa fa-angle-right"></i> Sản phẩm chờ duyệt</a></li>
          </ul>
        </li>
        
        <!-- Quản lý nhân viên -->
        @elseif (Session::get('role_id') == 4)
        <li class="treeview"> <a href="#"> <i class="icon-note"></i> <span>Quản lý nhân viên</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::to('admin-danh-sach-nhan-vien')}}"><i class="fa fa-angle-right"></i> Danh sách nhân viên</a></li>
            <!-- <li><a href="form-validation.html"><i class="fa fa-angle-right"></i> Cấp quyền nhân viên</a></li>
            <li><a href="form-wizard.html"><i class="fa fa-angle-right"></i> Form Wizard</a></li>
            <li><a href="form-layouts.html"><i class="fa fa-angle-right"></i> Form Layouts</a></li>
            <li><a href="form-uploads.html"><i class="fa fa-angle-right"></i> Form File Upload</a></li>
            <li><a href="form-summernote.html"><i class="fa fa-angle-right"></i> Summernote</a></li> -->
          </ul>
        </li>

        <!-- Quản lý Shop -->
        @elseif (Session::get('role_id') == 5)
        <li class="treeview"> <a href="#"> <i class="fa fa-table"></i> <span>Quản lý Shop</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::to('admin-danh-sach-shop')}}"><i class="fa fa-angle-right"></i> Danh sách Shop</a></li>
            <li><a href="{{URL::to('admin-danh-sach-shop-cho-phe-duyet')}}"><i class="fa fa-angle-right"></i> DS Shop chờ phê duyệt</a></li>
            <li><a href="{{URL::to('admin-danh-sach-shop-tam-ngung-hoat-dong')}}"><i class="fa fa-angle-right"></i> DS Shop bị tạm ngưng hoạt động</a></li>
            <!-- <li><a href="table-jsgrid.html"><i class="fa fa-angle-right"></i> Js Grid Table</a></li> -->
          </ul>
        </li>

        @else
        <li class="header"></li>
        @endif
      </ul>
    </div>
    <!-- /.sidebar --> 
  </aside>