<?php
session_start();
include "partials/header.php";

include 'connection.php';
 $order_id = $_GET['order_id'];
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
 $DetailOrderByOrderId = $data;
 $totalMoney = null;
foreach ($DetailOrderByOrderId as $item) {
    $totalMoney = $item['money'] + $totalMoney;
}

$user_id = $_SESSION['user_id'];
$delivery_id = $DetailOrderByOrderId[0]['delivery_address_id'];
// echo $user_id."<br>";
// echo $delivery_id;
// die;
$queryAddress = "SELECT
    delivery_addresses.id,
    delivery_addresses.phone,
    delivery_addresses.name,
    delivery_addresses.address,
    delivery_addresses.status,
    provinces.name as province_name,
    districts.name as district_name,
    communes.name as commune_name
    FROM delivery_addresses
    JOIN provinces  ON provinces.id = delivery_addresses.province_id
    JOIN districts  ON districts.id = delivery_addresses.district_id
    JOIN communes  ON communes.id = delivery_addresses.commune_id
    WHERE delivery_addresses.id = $delivery_id
    AND delivery_addresses.user_id = $user_id";
$excuteAddress = $conn->query($queryAddress);
// var_dump($excuteAddress);die;
$resultAddress = [];
$delivery_address= null;
while ($address = $excuteAddress->fetch_assoc()) {
    $delivery_address = $address;
    // echo $address['province_name'];
}
// die;
// $delivery_address= $resultAddress;
// echo $_SESSION['name'];die;
$queryHistory = "SELECT * FROM history_orders WHERE history_orders.order_id = $order_id";
$excuteHistory = $conn->query($queryHistory);
// var_dump($excuteHistory);die;
$resultHistory = [];
while ($history = $excuteHistory->fetch_assoc()) {
    $resultHistory[] = $history;
    // echo $address['province_name'];
}
$histories = $resultHistory;
$is_da_xac_nhan = false;
$is_dang_giao = false;
$is_da_nhan = false;
$is_da_huy = false;
$width_line_active = 70;

foreach($histories as $history){
    // echo $history['status']."<br>";
    if($history['status'] == 1 ){
        $width_line_active = 15;
        $is_da_xac_nhan = true;
    }
    if($history['status'] == 2 ){
        $width_line_active = 50;
        $is_dang_giao = true;
    }
    if($history['status'] == 3 ){
        $width_line_active = 70;
        $is_da_nhan = true;
    }
    if($history['status'] == 4 ){
        $is_da_huy = true;
    }
    
}
// var_dump($is_da_xac_nhan)."<br>";
// var_dump($is_dang_giao)."<br>";
// var_dump($is_da_nhan)."<br>";
// var_dump($is_da_huy)."<br>";
// var_dump($histories);die;
?>
<div class="content container bg-white">
    <section>
        <div class="col-12">
            <ul class="breadcrumb">
                <li>
                    <a href="javascript:;">Trang chủ</a>
                </li>
        
                <li>
                    <a href="javascript:;">
                    Chi tiết đơn hàng của bạn
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
                        <a href="notification.php" class="w-100">
                            <div class="item-title-cate ml-2 d-flex justify-content-between">
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
            <?php if($DetailOrderByOrderId[0]['status'] == 4) {?>
            <div class="order-status position-relative">
                        <div class="row ">
                            <div class="offset-1 col-2 col-md-2 item-status-order">
                                <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-file-text-o"></i>
                                </div>
                                <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                                    <div class="text-status-order order-2 text-center">
                                        Đơn hàng đã đặt
                                    </div>
                                    <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                        12:20 21-08-2020
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 item-status-order offset-6 ">
                                <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-exclamation-circle"></i>
                                </div>
                                <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                                    <div class="text-status-order order-2 text-center">
                                        Đã hủy
                                    </div>
                                    <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                        9:00 24-08-2020
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="horizontal-line position-absolute">
                            <div class="line line-active"></div>
                        </div>

                    </div>
<?php } else{?>
            <div class="order-status position-relative ">
                <div class="row">

                    <div class="offset-1 col-2 col-md-2 item-status-order">
                        <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-file-text-o"></i>
                        </div>
                        <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đơn hàng đã đặt
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                               
                            </div>
                        </div>
                    </div>
                    <div class="col-2 col-md-2 item-status-order">
                        <div class="box-icon <?php if($is_da_xac_nhan) echo "box-icon-active" ;?>  rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-check-square-o"></i>
                        </div>
                         <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đã xác nhận đơn hàng
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                18:00 21-08-2020
                            </div>
                        </div> 
                    </div>
                    <div class="col-2 col-md-2 item-status-order">
                        <div class="box-icon <?php if($is_dang_giao) echo "box-icon-active" ;?> rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-handshake-o"></i>
                        </div>
                        <?php if($width_line_active == 50) {?>
                         <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đã giao cho ĐVVC
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                12:00 22-08-2020
                            </div>
                        </div> 
                        <?php } ?>
                    </div>
                    <div class="col-2 col-md-2 item-status-order">
                        <div class="box-icon <?php if($is_dang_giao) echo "box-icon-active" ;?> rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-ambulance"></i>
                        </div>
                        <?php if($width_line_active == 50) {?>
                         <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đang giao hàng
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                6:20 23-08-2020
                            </div>
                        </div> 
                        <?php } ?>
                    </div>
                    <div class="col-2 col-md-2 item-status-order">
                        <div class="box-icon <?php if($is_da_nhan) echo "box-icon-active" ;?> rounded-circle d-flex align-items-center justify-content-center">
                            <i class="fa fa-money"></i>
                        </div>
                        <?php if($width_line_active == 70) {?>
                         <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                            <div class="text-status-order order-2 text-center">
                                Đã nhận hàng
                            </div>
                            <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                9:00 24-08-2020
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="horizontal-line position-absolute">
                    <div class="line"></div>
                    <div class=" line-active" style="width:<?= $width_line_active."%";?>"></div>
                </div>
            </div>
            <?php };?>
            <div class="order-address">
                <div class="text-address">
                    Địa chỉ nhận hàng
                </div>
                <div class="content-address">
                    <div class="name-user-address">
                        <?= $delivery_address['name'];?>
                        
                    </div>
                    <div class="phone-user-address">
                        <?= $delivery_address['phone'];?>
                    </div>
                    <div class="user-address">
                    <?= $delivery_address['address'];?>- <?= $delivery_address['commune_name'];?>- <?= $delivery_address['district_name'];?>- <?= $delivery_address['province_name'];?>
                    </div>
                </div>
            </div>
            <div class="order-history-deliver">

            </div>
                <div class="order-product">
                    <div class="header-order-product d-flex">
                        <div class="text-header-product">
                            Kiện hàng
                        </div>
                        <div class="status-header-product text-right text-warning">
                            <?php

                                if ($DetailOrderByOrderId[0]['status'] == 0) {
                                    echo "Chờ xác nhận";
                                } elseif ($DetailOrderByOrderId[0]['status'] == 1) {
                                    echo "Chờ lấy hàng";
                                } elseif ($DetailOrderByOrderId[0]['status'] == 2) {
                                    echo " Đang giao hàng";
                                } elseif ($DetailOrderByOrderId[0]['status'] == 3) {
                                    echo "Đã giao hàng";
                                } else {
                                echo " Đã hủy";
                                }
                            ?>
                        </div>
                    </div>
                    <div class="detail-order-product">
                        <?php foreach ($DetailOrderByOrderId as $item) {?>
                            <div class="row">
                                <div class="col-2">
                                    <div class="box-image">
                                        <img src="<?php echo substr($item['image'], 0) ;?>" alt<?= $item['title'];?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="title__product">
                                        <?= $item['title'];?>
                                    </div>
                                    <div class="list__image">
                                    <?php foreach (explode(',', $item['images']) as $img) { ?>
                                            <img src="<?php echo substr($img, 0) ;?>" alt="<?= $item['title'];?>" width="40">
                                    <?php } ?>
                                    </div>
                                    <div class="total__product">
                                        Số lượng: <?= $item['total'];?>
                                    </div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="price__product text-red justify-content-end">
                                        <sup class="text-underline ">đ</sup><?= number_format($item['money']);?>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex p-3 border payment-item">
                                    <div class="text-order-payment flex-auto ">
                                        Tổng tiền hàng

                                    </div>
                                    <div class="d-flex  money-order-payment">
                                        <div class="payment-money-product justify-content-end ">
                                            <sup class="text-underline ">đ</sup><?= number_format($totalMoney);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex p-3 border payment-item">
                                    <div class="text-order-payment flex-auto ">
                                        Vận chuyển-J&T Express
                                    </div>
                                    <div class="money-order-payment">
                                        <div class="payment-money-product justify-content-end ">
                                            <sup class="text-underline ">đ</sup>30.000
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex p-3 border payment-item">
                                    <div class="text-order-payment flex-auto ">
                                        Miễn Phí Vận Chuyển
                                    </div>
                                    <div class="money-order-payment">
                                        <div class="payment-money-product justify-content-end ">
                                            -<sup class="text-underline ">đ</sup>30.000
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex p-3 border payment-item">
                                    <div class="text-order-payment flex-auto ">
                                        Tổng số tiền

                                    </div>
                                    <div class="money-order-payment">
                                        <div class="payment-money-product justify-content-end text-red">
                                            <sup class="text-underline ">đ</sup><?= number_format($totalMoney);?>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex p-3 border payment-item">
                                    <div class="text-order-payment flex-auto ">
                                        Phương thức thanh toán

                                    </div>
                                    <div class="money-order-payment text-red">
                                        Thanh toán khi nhận hàng
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>  
</div>
<?php
include "partials/footer.php";
?>