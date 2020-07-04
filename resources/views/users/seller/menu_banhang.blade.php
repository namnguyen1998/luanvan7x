<aside class="main-sidebar"> 
    <!-- sidebar -->
    <div class="sidebar"> 
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="image text-center"><img src="{{asset('public/backend/dist/img/img1.jpg')}}" class="img-circle" alt="User Image"> </div>
        <div class="info">
          <p>{{Session::get('name_customer')}}</p>
          <a href="#"><i class="fa fa-envelope"></i></a> <a href="{{URL::to('profile')}}"><i class="fa fa-gear"></i></a> <a href="{{URL::to('/logout')}}"><i class="fa fa-power-off"></i></a> </div>
      </div>
      <!-- sidebar menu -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">KÊNH BÁN HÀNG</li>
        <li class="treeview"> 
          <a href="{{URL::to('/banhang')}}"> <i class="icon-home"></i> 
            <span>Thống kê</span> 
            <span class="pull-right-container"> 
              <i class="fa fa-angle-left pull-right"></i> 
            </span> 
          </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::to('/banhang')}}"><i class="fa fa-angle-right"></i>Doanh thu</a></li>
            <li><a href="index-classic.html"><i class="fa fa-angle-right"></i>Tài khoản ngân hàng</a></li>
          </ul>
        </li>
        <li class="treeview"> 
          <a href="#"> <i class="icon-grid"></i> 
            <span>Quản lý sản phẩm</span> 
              <span class="pull-right-container"> 
                <i class="fa fa-angle-left pull-right"></i> 
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="{{URL::to('/list-san-pham')}}"><i class="fa fa-angle-right"></i>Tất cả sản phẩm</a></li>
            <li><a href="{{URL::to('/them-san-pham')}}"><i class="fa fa-angle-right"></i>Thêm sản phẩm</a></li>
            <li><a href="{{URL::to('/san-pham-cho-duyet')}}"><i class="fa fa-angle-right"></i>Sản phẩm chờ duyệt</a></li>
          </ul>
        </li>
        <li class="treeview"> <a href="#"> <i class="ti-email"></i> <span>Inbox</span> <span class="pull-right-container"> <i class="fa fa-angle-left pull-right"></i> </span> </a>
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
        </li>
      </ul>
    </div>
    <!-- /.sidebar --> 
  </aside>