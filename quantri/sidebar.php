<?php
session_start();
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="javascript:;" class="brand-link">
      <img src="{{asset('images/favicon.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Quản trị</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('template/AdminLTE-master/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?= $_SESSION['username'] ?></a>
        </div>
      </div>


      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
         
          <li class="nav-item">
            <a href="dashboard.php?action=dashboard"  class="nav-link  <?php if($_GET['action'] == 'dashboard') echo 'active';?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Tổng quan
                <span class="right badge badge-danger">Mới</span>
              </p>
            </a>
          </li>
         
          <li class="nav-item">
            <a href="order.php?action=order" class="nav-link  <?php if($_GET['action'] == 'order') echo 'active';?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Đơn hàng
                <span class="right badge badge-danger">Mới</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="doanhthu.php?action=doanhthu" class="nav-link  <?php if($_GET['action'] == 'doanhthu') echo 'active';?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Doanh thu
                <span class="right badge badge-danger">Mới</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="user.php?action=user" class="nav-link  <?php if($_GET['action'] == 'user') echo 'active';?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Người dùng
                <span class="right badge badge-danger">Mới</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>a
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>