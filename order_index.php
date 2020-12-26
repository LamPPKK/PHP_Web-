<?php
header('Content-Type: text/html; charset=UTF-8');
//Khai báo sử dụng session
session_start();
$orderAll = [];
$list_order_cho_xac_nhan = [];
$list_order_da_xac_nhan = [];
$list_order_dang_giao = [];
$list_order_da_giao = [];
$list_order_da_huy = [];

include 'connection.php';
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM orders WHERE user_id = $user_id  and status !=4";
$query = $conn->query($sql);
while ($row = $query->fetch_assoc()){
   
    $orderAll[] = $row;    
}
$orderWaitConfirm = [];
$sqlWaitConfirm = "SELECT * FROM orders WHERE  user_id = $user_id AND  status =0 order by id DESC ";
$excuteWaitConfirm = $conn->query($sqlWaitConfirm);
if(mysqli_num_rows($excuteWaitConfirm)){
    while ($WaitConfirm = $excuteWaitConfirm->fetch_assoc()){
   
        $orderWaitConfirm[] = $WaitConfirm;    
    }
}
// var_dump($orderWaitConfirm);die;



$orderWaitGetItem = [];
$sqlWaitGetItem = "SELECT * FROM orders WHERE  user_id = $user_id  AND status =1 order by  id DESC";
$query = $conn->query($sqlWaitGetItem);
while ($WaitGetItem = $query->fetch_assoc()){
   
    $orderWaitGetItem[] = $WaitGetItem;    
}

$orderDelivering = [];
$sqlDelivering = "SELECT * FROM orders WHERE  user_id = $user_id  AND status =2 order by id DESC";
$query = $conn->query($sqlDelivering);
while ($Delivering = $query->fetch_assoc()){
   
    $orderDelivering[] = $Delivering;    
}

$orderDelivered = [];
$sqlDelivered = "SELECT * FROM orders WHERE  user_id = $user_id  AND status =3 order by id DESC";
$query = $conn->query($sqlDelivered);
while ($Delivered = $query->fetch_assoc()){
   
    $orderDelivered[] = $Delivered;    
}

$orderCancelled = [];
$sqlCancelled = "SELECT * FROM orders WHERE  user_id = $user_id  AND status =4 order by id DESC";
$query = $conn->query($sqlCancelled);
// var_dump($orderWaitConfirm);die;

while ($Cancelled = $query->fetch_assoc()){
   
    $orderCancelled[] = $Cancelled;    
}
include "partials/header.php";
?>
 <div class="content container">
        <div class="col-12">
            <ul class="breadcrumb">
                <li>
                    <a href="javascript:;">Trang chủ</a>
                </li>

                <li>
                    <a href="javascript:;">
						Danh sách đơn hàng của bạn
					</a>
                </li>
            </ul>
        </div>
        <div class="row">
            <div class="col-2">
                <div class="info-user d-flex">
                    <div class="box-image-user flex-1 rounded-circle d-flex align-items-center justify-content-center">
                        <img src="img/user-img/avatar.jpg" class="rounded-circle" />
                    </div>
                    <div class="name-user d-flex  flex-column-reverse align-items-center">
                        <div class="name mb-2  order-2 ">
                            Vũ Minh Đức
                        </div>
                        <div class="edit-name mb-2 order-1">
                            <i class="fa fa-pencil"> </i>Sửa hồ sơ
                        </div>
                    </div>
                </div>
                <div class="item-user">
                    <div class="item-link d-flex align-items-center">
                        <div class="item-icon-user icon-account">
                            <i class="fa fa-user-circle "></i>
                        </div>
                        <a href="javascript:;" class=>
                            <div class="item-title-cate ml-2 ">
                                Tài khoản của tôi
                            </div>
                        </a>
                    </div>
                    <div class="item-link d-flex align-items-center">
                        <div class="item-icon-user">
                            <i class="fa fa-file-text-o "></i>
                        </div>
                        <a href="order_index.php">
                            <div class="item-title-cate ml-2 active">
                                Đơn hàng
                            </div>
                        </a>
                    </div>
                    <div class="item-link d-flex align-items-center">
                        <div class="item-icon-user icon-notification">
                            <i class="fa fa-bell-o "></i>
                        </div>
                        <a href="notification.php" class=>
                            <div class="item-title-cate ml-2 ">
                                Thông báo
                                <?php
                                    $user_id = $_SESSION['user_id'];
                                    $queryTotalNoti = "SELECT COUNT(id)  AS totalNotSeen FROM notifications WHERE user_id = $user_id AND status = 0";
                                    $resultNoti = $conn->query($queryTotalNoti);
                                    $totalNotSeen = $resultNoti->fetch_array()['totalNotSeen']
                                ?>
                                <span class="right badge badge-danger">
                                    
                                    <?= $totalNotSeen ;?>
                                </span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-10 mt-2 bg-white">
                <ul class="nav nav-pills mb-2 box-title" id="pills-tab" role="tablist">
                    <li class="nav-item flex-1 text-center">
                        <a class="nav-link active" id="order_all_tab" data-toggle="pill" href="#order_all" role="tab" aria-controls="order_all" aria-selected="true">Tất cả</a>
                    </li>
                    <li class="nav-item flex-1 text-center">
                        <a class="nav-link" id="wait_confirm_tab" data-toggle="pill" href="#wait_confirm" role="tab" aria-controls="wait_confirm" aria-selected="false">Chờ xác nhận</a>
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
                    <div class="tab-pane fade show active" id="order_all" role="tabpanel" aria-labelledby="order__all_tab">
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
                        <?php foreach ($orderAll as $order) {?>
                            <div class="item-order">
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
                                    // var_dump($post_id);die;


                                ?>
                                <?php foreach ($getDetailOrderByOrderId as $item) {?>
                                <!-- @foreach (\App\Entity\DetailOrder::getDetailOrderByOrderId($order->order_id,Auth::user()->id) as $item) -->
                               
                                <div class="row">
                                    <div class="col-2">
                                        <div class="box-image">
                                            <img src="<?php echo substr($item['image'], 0) ;?>" alt="<?= $item['title'] . $order['id'];?>">
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="title__product">
                                        <?= $item['title'];?>
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
                                        <div class="price__product text-red">
                                            <?php
                                                $product_price = !empty($item['price_sale']) ? $item['price_sale']:$item['price_buy'];
                                            ?>
                                            <sup class="text-underline ">đ</sup><?= number_format($product_price*$item['total']);?>
                                        </div>
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
                                <!-- @endforeach -->
                               
                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 col-md-3">
                                        <a href="order_detail.php?order_id=<?php echo $order['id'] ;?>">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>

                                    <?php if($order['status'] ==0) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="quantri/controller/changeStatusOrder.php?status=4&order_id=<?php echo $order['id'] ;?>">
                                            <div class=" cancelled__order__item button btnOrange <?php echo $order['id'] ;?>">
                                                Hủy đơn hàng 
                                            </div>
                                        </a>
                                        
                                    </div>
                                 
                                    <?php } elseif($order['status'] == 3) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="controller/doReview.php?post_id=<?php echo $item['post_id'] ;?>" >
                                            <div class=" review__product button btnOrange  <?php echo $item['post_id'] ;?>">
                                                Đánh giá
                                            </div>
                                       </a>
                                    </div>
                                   
                                    <?php } ?>
                                    
                                </div>
                                <?php } ?>

                            </div>
                        <?php } ?>

                            <!-- @endforeach -->
                        </div>
                    </div>
                    </div>
                    <div class="tab-pane fade" id="wait_confirm" role="tabpanel" aria-labelledby="wait_confirm_tab">
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
                                    <div class="col-2 col-md-3">
                                        <a href="order_detail.php?order_id=<?php echo $order['id'] ;?>">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>

                                    <?php if($order['status'] ==0) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="quantri/controller/changeStatusOrder.php?status=4&order_id=<?php echo $order['id'] ;?>">
                                            <div class=" cancelled__order__item button btnOrange <?php echo $order['id'] ;?>">
                                                Hủy đơn hàng 
                                            </div>
                                        </a>
                                        
                                    </div>
                                 
                                    <?php } elseif($order['status'] == 3) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="controller/doReview.php?post_id=<?php echo $item['post_id'] ;?>" >
                                            <div class=" review__product button btnOrange  <?php echo $item['post_id'] ;?>">
                                                Đánh giá
                                            </div>
                                       </a>
                                    </div>
                                   
                                    <?php } ?>
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
                                    <div class="col-2 col-md-3">
                                        <a href="order_detail.php?order_id=<?php echo $order['id'] ;?>">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>

                                    <?php if($order['status'] ==0) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="quantri/controller/changeStatusOrder.php?status=4&order_id=<?php echo $order['id'] ;?>">
                                            <div class=" cancelled__order__item button btnOrange <?php echo $order['id'] ;?>">
                                                Hủy đơn hàng 
                                            </div>
                                        </a>
                                        
                                    </div>
                                 
                                    <?php } elseif($order['status'] == 3) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="controller/doReview.php?post_id=<?php echo $item['post_id'] ;?>" >
                                            <div class=" review__product button btnOrange  <?php echo $item['post_id'] ;?>">
                                                Đánh giá
                                            </div>
                                       </a>
                                    </div>
                                   
                                    <?php } ?>
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
                                    <div class="col-2 col-md-3">
                                        <a href="order_detail.php?order_id=<?php echo $order['id'] ;?>">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>

                                    <?php if($order['status'] ==0) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="quantri/controller/changeStatusOrder.php?status=4&order_id=<?php echo $order['id'] ;?>">
                                            <div class=" cancelled__order__item button btnOrange <?php echo $order['id'] ;?>">
                                                Hủy đơn hàng 
                                            </div>
                                        </a>
                                        
                                    </div>
                                 
                                    <?php } elseif($order['status'] == 3) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="controller/doReview.php?post_id=<?php echo $item['post_id'] ;?>" >
                                            <div class=" review__product button btnOrange  <?php echo $item['post_id'] ;?>">
                                                Đánh giá
                                            </div>
                                       </a>
                                    </div>
                                   
                                    <?php } ?>
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

                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 col-md-3">
                                        <a href="order_detail.php?order_id=<?php echo $order['id'] ;?>">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>

                                    <?php if($order['status'] ==0) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="quantri/controller/changeStatusOrder.php?status=4&order_id=<?php echo $order['id'] ;?>">
                                            <div class=" cancelled__order__item button btnOrange <?php echo $order['id'] ;?>">
                                                Hủy đơn hàng 
                                            </div>
                                        </a>
                                        
                                    </div>
                                 
                                    <?php } elseif($order['status'] == 3) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="controller/doReview.php?post_id=<?php echo $item['post_id'] ;?>" >
                                            <div class=" review__product button btnOrange  <?php echo $item['post_id'] ;?>">
                                                Đánh giá
                                            </div>
                                       </a>
                                    </div>
                                   
                                    <?php } ?>
                                </div>
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
                                <div class="row ">
                                    <div class="col d-flex justify-content-center align-items-center text-warning">
                                        Lựa chọn
                                    </div>
                                    <div class="col-2 col-md-3">
                                        <a href="order_detail.php?order_id=<?php echo $order['id'] ;?>">
                                            <div class="show__detail__order">
                                                Xem chi tiết
                                            </div>
                                        </a>
                                    </div>

                                    <?php if($order['status'] ==0) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="quantri/controller/changeStatusOrder.php?status=4&order_id=<?php echo $order['id'] ;?>">
                                            <div class=" cancelled__order__item button btnOrange <?php echo $order['id'] ;?>">
                                                Hủy đơn hàng 
                                            </div>
                                        </a>
                                        
                                    </div>
                                 
                                    <?php } elseif($order['status'] == 3) { ?>
                                    <div class="col-3 col-md-4">
                                        <a href="controller/doReview.php?post_id=<?php echo $item['post_id'] ;?>" >
                                            <div class=" review__product button btnOrange  <?php echo $item['post_id'] ;?>">
                                                Đánh giá
                                            </div>
                                       </a>
                                    </div>
                                   
                                    <?php } ?>
                                </div>
                                
                                </div>
                            <?php }?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php
    include('reviewProduct.php');
    include('partials/footer.php');
?>