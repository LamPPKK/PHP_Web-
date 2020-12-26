<?php
session_start();
// $_SESSION['statusChangeOrder'] = 0;
$user_name = $_SESSION['name'];



include '../connection.php';
$user_id = $_SESSION['user_id'];

$orderWaitConfirm = [];
$sqlWaitConfirm = "select * from orders where  status =0 order by id DESC ";
$query = $conn->query($sqlWaitConfirm);
while ($WaitConfirm = $query->fetch_assoc()){
   
    $orderWaitConfirm[] = $WaitConfirm;    
}


$orderWaitGetItem = [];
$sqlWaitGetItem = "select * from orders where  status =1 order by  id DESC";
$query = $conn->query($sqlWaitGetItem);
while ($WaitGetItem = $query->fetch_assoc()){
   
    $orderWaitGetItem[] = $WaitGetItem;    
}

$orderDelivering = [];
$sqlDelivering = "select * from orders where  status =2 order by id DESC";
$query = $conn->query($sqlDelivering);
while ($Delivering = $query->fetch_assoc()){
   
    $orderDelivering[] = $Delivering;    
}

$orderDelivered = [];
$sqlDelivered = "select * from orders where  status =3 order by id DESC";
$query = $conn->query($sqlDelivered);
while ($Delivered = $query->fetch_assoc()){
   
    $orderDelivered[] = $Delivered;    
}

$orderCancelled = [];
$sqlCancelled = "select * from orders where  status =4 order by id DESC";
$query = $conn->query($sqlCancelled);
while ($Cancelled = $query->fetch_assoc()){
   
    $orderCancelled[] = $Cancelled;    
}
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
    <div class="col-12">
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            Danh sách đơn hàng
          </h3>
          
        </div>
        <?php if(isset($_SESSION['statusChangeOrder']) ) { ?>

        <?php if($_SESSION['statusChangeOrder'] == 200) {?>
          <div class="row">
            <div class="col-12 col-xs-12 col-md-12 col-lg-12  pd-0 pd-t-15">
                <div class="alert alert-success mg-b-0 ">
                Cập nhật trạng thái đơn hàng thành công
                    <button type="button" class="close iconAlert" data-dismiss="alert" aria-label="Close">x</button>
                </div>
            </div>
        </div>
        <?php } ?>
        <?php } ?>
       
      
          <?php unset($_SESSION['statusChangeOrder']); ?>
        <!-- ./card-header -->
        <div class="card-body">
          <div class="col-12 mt-2 bg-white">
            <ul class="nav nav-pills mb-2 box-title" id="pills-tab" role="tablist">
                
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link active" id="wait_confirm_tab" data-toggle="pill" href="#wait_confirm" role="tab" aria-controls="wait_confirm" aria-selected="true">Chờ xác nhận</a>
                </li>
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link" id="wait_get_item_tab" data-toggle="pill" href="#wait_get_item" role="tab" aria-controls="wait_get_item" aria-selected="false">Chờ lấy hàng</a>
                </li>
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link " id="delivering_tab" data-toggle="pill" href="#delivering" role="tab" aria-controls="delivering" aria-selected="true">Đang giao</a>
                </li>
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link" id="delivered_tab" data-toggle="pill" href="#delivered" role="tab" aria-controls="delivered" aria-selected="false">Đã giao</a>
                </li>
                <li class="nav-item flex-1 text-center">
                    <a class="nav-link" id="cancelled_tab" data-toggle="pill" href="#cancelled" role="tab" aria-controls="cancelled" aria-selected="false">Đã hủy</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                
                <div class="tab-pane fade show active" id="wait_confirm" role="tabpanel" aria-labelledby="wait_confirm_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                          <?php foreach ($orderWaitConfirm as $order) {?>
                            <div class="item-order  border pb-2">
                              <?php 
                                    $order_id = $order['id'];
                                    $sql2= "SELECT
                                        orders.id as order_id,
                                        orders.delivery_address_id,
                                        orders.updated_at,
                                        orders.status,
                                        detail_orders.total,
                                        detail_orders.money,
                                        detail_orders.id as detail_order_id,
                                        products.images,
                                        products.price_buy,
                                        products.price_sale,
                                        posts.title,
                                        posts.slug as post_slug,
                                        posts.id as post_id,
                                        posts.image
                                        FROM orders
                                        JOIN item_orders  ON item_orders.order_id = orders.id
                                        JOIN detail_orders  ON detail_orders.id = item_orders.detail_order_id
                                        JOIN products  ON products.id = detail_orders.product_id
                                        JOIN posts  ON posts.id = products.post_id
                                        where orders.id = $order_id";
                                    $query2 = $conn->query($sql2);
                                    $data = [];
                                    while ($row2 = $query2->fetch_assoc()) {
                                        $data[] = $row2;
                                        
                                    }
                                    $getDetailOrderByOrderId = $data;
                                    $post_id = $getDetailOrderByOrderId[0]['post_id'];
                              ?>
                              <?php foreach ($getDetailOrderByOrderId as $item) {?>
                              <div class="row">
                                  <div class="col-2">
                                      <div class="box-image">
                                          <img src="<?php echo substr($item['image'], 0) ;?>" alt="<?= $item['title'] ;?>">
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="title__product">
                                      <?= $item['title'] ;?>
                                      </div>
                                      <div class=" list__image">
                                        <?php foreach (explode(',', $item['images']) as $img) { ?>
                                            <img src="<?php echo  substr($img, 0);?>" alt="<?= $item['title'];?>" width="40">
                                        <?php }?>
                                      </div>
                                      <div class="total__product">
                                        Số lượng: <?= $item['total'];?>
                                      </div>
                                  </div>
                                  <div class="col-2 text-center">
                                    <div class="price__product text-red">
                                        <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                        ?>
                                        <sup class="text-underline ">đ</sup><?= number_format($product_price);?>
                                      </div>
                                    </div>
                                
                                    <div class="col-2 text-center">
                                      <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                      ?>
                                      <sup class="text-underline ">đ</sup><?= number_format($product_price*$item['total']);?>
                                    </div>
                                  <div class="col-2">
                                      <div class="item__wait_confirm item-status">
                                      <?php
                                        if ($order['status'] == 0) {
                                            echo "Chờ xác nhận";
                                        } elseif ($order['status'] == 1) {
                                            echo "Chờ lấy hàng";
                                        } elseif ($order['status'] == 2) {
                                            echo " Đang giao hàng";
                                        } elseif ($order['status'] == 3) {
                                            echo "Đã giao hàng";
                                        } else {
                                        echo " Đã hủy";
                                        }
                                        ?>
                                      </div>
                                  </div>
                              </div>
                              <?php }?>

                              <div class="row ">
                                  <div class="col d-flex justify-content-center align-items-center text-warning">
                                      Lựa chọn
                                  </div>
                                  <div class="col-2 ">
                                      <a href="controller/changeStatusOrder.php?status=1&order_id=<?php echo $order['id'] ;?>" class="btn btn-primary">
                                          Xác nhận
                                      </a>
                                  </div>
                                  <div class="col-2">
                                    <a href="controller/changeStatusOrder.php?status=4&order_id=<?php echo $order['id'] ;?>" class="btn btn-danger">
                                      Hủy đơn hàng
                                    </a>
                                      
                                  </div>
                              </div>
                            </div>
                          <?php }?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="wait_get_item" role="tabpanel" aria-labelledby="wait_get_item_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                          <?php foreach ($orderWaitGetItem as $order) {?>
                            <div class="item-order  border pb-2">
                              <?php 
                                    $order_id = $order['id'];
                                    $sql2= "SELECT
                                        orders.id as order_id,
                                        orders.delivery_address_id,
                                        orders.updated_at,
                                        orders.status,
                                        detail_orders.total,
                                        detail_orders.money,
                                        detail_orders.id as detail_order_id,
                                        products.images,
                                        products.price_buy,
                                        products.price_sale,
                                        posts.title,
                                        posts.slug as post_slug,
                                        posts.id as post_id,
                                        posts.image
                                        FROM orders
                                        JOIN item_orders  ON item_orders.order_id = orders.id
                                        JOIN detail_orders  ON detail_orders.id = item_orders.detail_order_id
                                        JOIN products  ON products.id = detail_orders.product_id
                                        JOIN posts  ON posts.id = products.post_id
                                        where orders.id = $order_id";
                                    $query2 = $conn->query($sql2);
                                    $data = [];
                                    while ($row2 = $query2->fetch_assoc()) {
                                        $data[] = $row2;
                                        
                                    }
                                    $getDetailOrderByOrderId = $data;
                                    $post_id = $getDetailOrderByOrderId[0]['post_id'];
                              ?>
                              <?php foreach ($getDetailOrderByOrderId as $item) {?>
                              <div class="row">
                                  <div class="col-2">
                                      <div class="box-image">
                                          <img src="<?php echo substr($item['image'], 0) ;?>" alt="<?= $item['title'] ;?>">
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="title__product">
                                      <?= $item['title'] ;?>
                                      </div>
                                      <div class=" list__image">
                                        <?php foreach (explode(',', $item['images']) as $img) { ?>
                                            <img src="<?php echo  substr($img, 0);?>" alt="<?= $item['title'];?>" width="40">
                                        <?php }?>
                                      </div>
                                      <div class="total__product">
                                        Số lượng: <?= $item['total'];?>
                                      </div>
                                  </div>
                                  <div class="col-2 text-center">
                                    <div class="price__product text-red">
                                        <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                        ?>
                                        <sup class="text-underline ">đ</sup><?= number_format($product_price);?>
                                      </div>
                                    </div>
                                
                                    <div class="col-2 text-center">
                                      <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                      ?>
                                      <sup class="text-underline ">đ</sup><?= number_format($product_price*$item['total']);?>
                                    </div>
                                  <div class="col-2">
                                      <div class="item__wait_confirm item-status">
                                      <?php
                                        if ($order['status'] == 0) {
                                            echo "Chờ xác nhận";
                                        } elseif ($order['status'] == 1) {
                                            echo "Chờ lấy hàng";
                                        } elseif ($order['status'] == 2) {
                                            echo " Đang giao hàng";
                                        } elseif ($order['status'] == 3) {
                                            echo "Đã giao hàng";
                                        } else {
                                        echo " Đã hủy";
                                        }
                                        ?>
                                      </div>
                                  </div>
                              </div>
                              <?php }?>

                              <div class="row ">
                                  <div class="col d-flex justify-content-center align-items-center text-warning">
                                      Lựa chọn
                                  </div>
                                  <div class="col-2 ">
                                      <a href="controller/changeStatusOrder.php?status=2&order_id=<?php echo $order['id'] ;?>" class="btn btn-primary">
                                          Giao cho DVVC
                                      </a>
                                  </div>
                                  <div class="col-2">
                                    <a href="controller/changeStatusOrder.php?status=4&order_id=<?php echo $order['id'] ;?>" class="btn btn-danger">
                                      Hủy đơn hàng
                                    </a>
                                      
                                  </div>
                              </div>
                            </div>
                          <?php }?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="delivering" role="tabpanel" aria-labelledby="delivering_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                          <?php foreach ($orderDelivering as $order) {?>
                            <div class="item-order  border pb-2">
                              <?php 
                                    $order_id = $order['id'];
                                    $sql2= "SELECT
                                        orders.id as order_id,
                                        orders.delivery_address_id,
                                        orders.updated_at,
                                        orders.status,
                                        detail_orders.total,
                                        detail_orders.money,
                                        detail_orders.id as detail_order_id,
                                        products.images,
                                        products.price_buy,
                                        products.price_sale,
                                        posts.title,
                                        posts.slug as post_slug,
                                        posts.id as post_id,
                                        posts.image
                                        FROM orders
                                        JOIN item_orders  ON item_orders.order_id = orders.id
                                        JOIN detail_orders  ON detail_orders.id = item_orders.detail_order_id
                                        JOIN products  ON products.id = detail_orders.product_id
                                        JOIN posts  ON posts.id = products.post_id
                                        where orders.id = $order_id";
                                    $query2 = $conn->query($sql2);
                                    $data = [];
                                    while ($row2 = $query2->fetch_assoc()) {
                                        $data[] = $row2;
                                        
                                    }
                                    $getDetailOrderByOrderId = $data;
                                    $post_id = $getDetailOrderByOrderId[0]['post_id'];
                              ?>
                              <?php foreach ($getDetailOrderByOrderId as $item) {?>
                              <div class="row">
                                  <div class="col-2">
                                      <div class="box-image">
                                          <img src="<?php echo substr($item['image'], 0) ;?>" alt="<?= $item['title'] ;?>">
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="title__product">
                                      <?= $item['title'] ;?>
                                      </div>
                                      <div class=" list__image">
                                        <?php foreach (explode(',', $item['images']) as $img) { ?>
                                            <img src="<?php echo  substr($img, 0);?>" alt="<?= $item['title'];?>" width="40">
                                        <?php }?>
                                      </div>
                                      <div class="total__product">
                                        Số lượng: <?= $item['total'];?>
                                      </div>
                                  </div>
                                  <div class="col-2 text-center">
                                    <div class="price__product text-red">
                                        <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                        ?>
                                        <sup class="text-underline ">đ</sup><?= number_format($product_price);?>
                                      </div>
                                    </div>
                                
                                    <div class="col-2 text-center">
                                      <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                      ?>
                                      <sup class="text-underline ">đ</sup><?= number_format($product_price*$item['total']);?>
                                    </div>
                                  <div class="col-2">
                                      <div class="item__wait_confirm item-status">
                                      <?php
                                        if ($order['status'] == 0) {
                                            echo "Chờ xác nhận";
                                        } elseif ($order['status'] == 1) {
                                            echo "Chờ lấy hàng";
                                        } elseif ($order['status'] == 2) {
                                            echo " Đang giao hàng";
                                        } elseif ($order['status'] == 3) {
                                            echo "Đã giao hàng";
                                        } else {
                                        echo " Đã hủy";
                                        }
                                        ?>
                                      </div>
                                  </div>
                              </div>
                              <?php }?>

                              <div class="row ">
                                  <div class="col d-flex justify-content-center align-items-center text-warning">
                                      Lựa chọn
                                  </div>
                                  <div class="col-3 ">
                                      <a href="controller/changeStatusOrder.php?status=3&order_id=<?php echo $order['id'] ;?>" class="btn btn-primary">
                                          Xác nhận đã giao hàng
                                      </a>
                                  </div>
                                  <div class="col-2">
                                    <a href="controller/changeStatusOrder.php?status=4&order_id=<?php echo $order['id'] ;?>" class="btn btn-danger">
                                      Hủy đơn hàng
                                    </a>
                                      
                                  </div>
                              </div>
                            </div>
                          <?php }?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="delivered" role="tabpanel" aria-labelledby="delivered_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                          <?php foreach ($orderDelivered as $order) {?>
                            <div class="item-order  border pb-2">
                              <?php 
                                    $order_id = $order['id'];
                                    $sql2= "SELECT
                                        orders.id as order_id,
                                        orders.delivery_address_id,
                                        orders.updated_at,
                                        orders.status,
                                        detail_orders.total,
                                        detail_orders.money,
                                        detail_orders.id as detail_order_id,
                                        products.images,
                                        products.price_buy,
                                        products.price_sale,
                                        posts.title,
                                        posts.slug as post_slug,
                                        posts.id as post_id,
                                        posts.image
                                        FROM orders
                                        JOIN item_orders  ON item_orders.order_id = orders.id
                                        JOIN detail_orders  ON detail_orders.id = item_orders.detail_order_id
                                        JOIN products  ON products.id = detail_orders.product_id
                                        JOIN posts  ON posts.id = products.post_id
                                        where orders.id = $order_id";
                                    $query2 = $conn->query($sql2);
                                    $data = [];
                                    while ($row2 = $query2->fetch_assoc()) {
                                        $data[] = $row2;
                                        
                                    }
                                    $getDetailOrderByOrderId = $data;
                                    $post_id = $getDetailOrderByOrderId[0]['post_id'];
                              ?>
                              <?php foreach ($getDetailOrderByOrderId as $item) {?>
                              <div class="row">
                                  <div class="col-2">
                                      <div class="box-image">
                                          <img src="<?php echo substr($item['image'], 0) ;?>" alt="<?= $item['title'] ;?>">
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="title__product">
                                      <?= $item['title'] ;?>
                                      </div>
                                      <div class=" list__image">
                                        <?php foreach (explode(',', $item['images']) as $img) { ?>
                                            <img src="<?php echo  substr($img, 0);?>" alt="<?= $item['title'];?>" width="40">
                                        <?php }?>
                                      </div>
                                      <div class="total__product">
                                        Số lượng: <?= $item['total'];?>
                                      </div>
                                  </div>
                                  <div class="col-2 text-center">
                                    <div class="price__product text-red">
                                        <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                        ?>
                                        <sup class="text-underline ">đ</sup><?= number_format($product_price);?>
                                      </div>
                                    </div>
                                
                                    <div class="col-2 text-center">
                                      <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                      ?>
                                      <sup class="text-underline ">đ</sup><?= number_format($product_price*$item['total']);?>
                                    </div>
                                  <div class="col-2">
                                      <div class="item__wait_confirm item-status">
                                      <?php
                                        if ($order['status'] == 0) {
                                            echo "Chờ xác nhận";
                                        } elseif ($order['status'] == 1) {
                                            echo "Chờ lấy hàng";
                                        } elseif ($order['status'] == 2) {
                                            echo " Đang giao hàng";
                                        } elseif ($order['status'] == 3) {
                                            echo "Đã giao hàng";
                                        } else {
                                        echo " Đã hủy";
                                        }
                                        ?>
                                      </div>
                                  </div>
                              </div>
                              <?php }?>

                             
                            </div>
                          <?php }?>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="cancelled" role="tabpanel" aria-labelledby="cancelled_tab">
                    <div class="list-order">
                        <div class="info-top">
                            <div class="row">
                                <div class="col-2">Ảnh</div>
                                <div class="col-4">
                                    Thông tin sản phẩm
                                </div>
                                <div class="col-2">
                                    Giá sản phẩm
                                </div>
                                <div class="col-2">
                                    Tổng tiền
                                </div>
                                <div class="col-2">
                                    Trạng thái
                                </div>
                            </div>
                        </div>
                        <div class="list-order">
                          <?php foreach ($orderCancelled as $order) {?>
                            <div class="item-order  border pb-2">
                              <?php 
                                    $order_id = $order['id'];
                                    $sql2= "SELECT
                                        orders.id as order_id,
                                        orders.delivery_address_id,
                                        orders.updated_at,
                                        orders.status,
                                        detail_orders.total,
                                        detail_orders.money,
                                        detail_orders.id as detail_order_id,
                                        products.images,
                                        products.price_buy,
                                        products.price_sale,
                                        posts.title,
                                        posts.slug as post_slug,
                                        posts.id as post_id,
                                        posts.image
                                        FROM orders
                                        JOIN item_orders  ON item_orders.order_id = orders.id
                                        JOIN detail_orders  ON detail_orders.id = item_orders.detail_order_id
                                        JOIN products  ON products.id = detail_orders.product_id
                                        JOIN posts  ON posts.id = products.post_id
                                        where orders.id = $order_id";
                                    $query2 = $conn->query($sql2);
                                    $data = [];
                                    while ($row2 = $query2->fetch_assoc()) {
                                        $data[] = $row2;
                                        
                                    }
                                    $getDetailOrderByOrderId = $data;
                                    $post_id = $getDetailOrderByOrderId[0]['post_id'];
                              ?>
                              <?php foreach ($getDetailOrderByOrderId as $item) {?>
                              <div class="row">
                                  <div class="col-2">
                                      <div class="box-image">
                                          <img src="<?php echo substr($item['image'], 0) ;?>" alt="<?= $item['title'] ;?>">
                                      </div>
                                  </div>
                                  <div class="col-4">
                                      <div class="title__product">
                                      <?= $item['title'] ;?>
                                      </div>
                                      <div class=" list__image">
                                        <?php foreach (explode(',', $item['images']) as $img) { ?>
                                            <img src="<?php echo  substr($img, 0);?>" alt="<?= $item['title'];?>" width="40">
                                        <?php }?>
                                      </div>
                                      <div class="total__product">
                                        Số lượng: <?= $item['total'];?>
                                      </div>
                                  </div>
                                  <div class="col-2 text-center">
                                    <div class="price__product text-red">
                                        <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                        ?>
                                        <sup class="text-underline ">đ</sup><?= number_format($product_price);?>
                                      </div>
                                    </div>
                                
                                    <div class="col-2 text-center">
                                      <?php
                                          $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                      ?>
                                      <sup class="text-underline ">đ</sup><?= number_format($product_price*$item['total']);?>
                                    </div>
                                  <div class="col-2">
                                      <div class="item__wait_confirm item-status">
                                      <?php
                                        if ($order['status'] == 0) {
                                            echo "Chờ xác nhận";
                                        } elseif ($order['status'] == 1) {
                                            echo "Chờ lấy hàng";
                                        } elseif ($order['status'] == 2) {
                                            echo " Đang giao hàng";
                                        } elseif ($order['status'] == 3) {
                                            echo "Đã giao hàng";
                                        } else {
                                        echo " Đã hủy";
                                        }
                                        ?>
                                      </div>
                                  </div>
                              </div>
                              <?php }?>

                             
                            </div>
                          <?php }?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!-- /.card-body -->
      </div>
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
