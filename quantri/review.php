<?php
session_start();
// $_SESSION['statusChangeOrder'] = 0;
$user_name = $_SESSION['name'];



include '../connection.php';
$user_id = $_SESSION['user_id'];

$listReview = [];
$sqlRiew = "select * from review_products  order by id DESC ";
$query = $conn->query($sqlRiew);
while ($WaitConfirm = $query->fetch_assoc()){
   
    $listReview[] = $WaitConfirm;    
}
// var_dump($listReview);die;

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Dashboard 2</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="../AdminLTE-master/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="../AdminLTE-master/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../AdminLTE-master/dist/css/adminlte.min.css">
  <link rel="stylesheet" href="../Site/public/css/client.css" type="text/css">
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
  

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <?= $user_name; ?>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="../controller/logout.php" class="dropdown-item">
              Thoát
          </a>
          
        </div>
      </li>
      
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="../AdminLTE-master/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Quản trị</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      

     

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item ">
            <a href="dashboard.php?action=dashboard" class="nav-link <?php if($_GET['action'] == 'dashboard') echo 'active' ; ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Thống kê
              </p>
            </a>
            
          </li>
          <li class="nav-item">
            <a href="order.php?action=order" class="nav-link <?php if($_GET['action'] == 'order') echo 'active' ; ?>">
              <i class="nav-icon fas fa-th"></i>
              Quản lý đơn hàng
              <p>
                <span class="right badge badge-danger">mới</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="review.php?action=review" class="nav-link <?php if($_GET['action'] == 'review') echo 'active' ; ?>">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Quản lý đánh giá
                
              </p>
            </a>
          </li>
          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
   
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
            <div class="row">
            <div class="col-md-6">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Quản lý đánh giá sản phẩm</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th style="width: 10px">STT</th>
                      <th>Đánh giá</th>
                      <th>Thời gian</th>
                      <th>Trạng thái</th>
                      <th>Hành động</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $i = 1; ?>
                  <?php  foreach ($listReview as $review) {?>
                    <tr>
                      <td ><?= $i; ?></td>
                      <td><?= date("Y-m-d H:i:s",strtotime($review['created_at']));?></td>
                      <td><?= $review['content'];?></td>
                      <td><?php echo  $review['status'] ==  0 ? 'Ẩn' : 'Hiện';?></td>
                      <td >
                            <?php if($review['status'] == 1) {?>
                            <a href="controller/changeStatusReview.php?status=0&review_id=<?= $review['id'];?>" class="btn btn-warning">
                                ẩn
                            </a>
                            <?php } else {?>
                                <a href="controller/changeStatusReview.php?status=1&review_id=<?= $review['id'];?>" class="btn btn-primary">
                                    hiện
                                </a>
                            <?php }?>
                      </td>
                    </tr>
                    <?php $i++; ?>

                    <?php }?>
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->

           
            <!-- /.card -->
          </div>    
            </div>
        
      </div><!--/. container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="../AdminLTE-master/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../AdminLTE-master/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="../AdminLTE-master/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="../AdminLTE-master/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="../AdminLTE-master/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="../AdminLTE-master/plugins/raphael/raphael.min.js"></script>
<script src="../AdminLTE-master/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../AdminLTE-master/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="../AdminLTE-master/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="../AdminLTE-master/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="../AdminLTE-master/dist/js/pages/dashboard2.js"></script>
</body>
</html>
