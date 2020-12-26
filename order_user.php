<?php
header('Content-Type: text/html; charset=UTF-8');
//Khai báo sử dụng session
session_start();
$list_order = [];
$list_order_cho_xac_nhan = [];
$list_order_da_xac_nhan = [];
$list_order_dang_giao = [];
$list_order_da_giao = [];
$list_order_da_huy = [];
if (isset($_SESSION['user_id'])) {
    include 'connection.php';
    $user_id = $_SESSION['user_id'];
    $sql = "select * from orders where user_id = $user_id ORDER BY id DESC ";
    $query = $conn->query($sql);
    while ($row = $query->fetch_assoc()) {
        $order_id = $row['id'];
        $sql2 = "select od.*, od.quantity as order_quantity, p.*,p.name as product_name, p.id as product_id, p.price as product_price from order_detail as od
                JOIN products as p ON od.product_id = p.id
                where od.order_id = $order_id";
        $query2 = $conn->query($sql2);
        $data = [];
        while ($row2 = $query2->fetch_assoc()) {
            $data[] = $row2;
        }
        $row['order_detail'] = $data;
        $list_order[] = $row;
    }
    // echo $list_order[0]['order_quantity'];die;
    $query_cho_xac_nhan = $conn->query("select * from orders where user_id = $user_id and delivery_status = 0 ORDER BY id DESC ");
    while ($row = $query_cho_xac_nhan->fetch_assoc()) {
        $order_id = $row1['id'];
        $sql2 = "select od.*, od.quantity as order_quantity, p.*,p.name as product_name, p.id as product_id, p.price as product_price from order_detail as od
                JOIN products as p ON od.product_id = p.id
                where od.order_id = $order_id";
        $query2 = $conn->query($sql2);
        $data = [];
        while ($row2 = $query2->fetch_assoc()) {
            $data[] = $row2;
        }
        $row['order_detail'] = $data;
        $list_order_cho_xac_nhan[] = $row;
    }
    $query_da_xac_nhan = $conn->query("select * from orders where user_id = $user_id and delivery_status = 1 ORDER BY id DESC ");
    while ($row = $query_da_xac_nhan->fetch_assoc()) {
        $order_id = $row['id'];
        $sql2 = "select od.*, od.quantity as order_quantity, p.*,p.name as product_name, p.id as product_id, p.price as product_price from order_detail as od
                JOIN products as p ON od.product_id = p.id
                where od.order_id = $order_id";
        $query2 = $conn->query($sql2);
        $data = [];
        while ($row2 = $query2->fetch_assoc()) {
            $data[] = $row2;
        }
        $row['order_detail'] = $data;
        $list_order_da_xac_nhan[] = $row;
    }
    $query_dang_giao = $conn->query("select * from orders where user_id = $user_id and delivery_status = 2 ORDER BY id DESC ");
    while ($row = $query_dang_giao->fetch_assoc()) {
        $order_id = $row['id'];
        $sql2 = "select od.*, od.quantity as order_quantity, p.*,p.name as product_name, p.id as product_id, p.price as product_price from order_detail as od
                JOIN products as p ON od.product_id = p.id
                where od.order_id = $order_id";
        $query2 = $conn->query($sql2);
        $data = [];
        while ($row2 = $query2->fetch_assoc()) {
            $data[] = $row2;
        }
        $row['order_detail'] = $data;
        $list_order_dang_giao[] = $row;
    }
    $query_da_giao = $conn->query("select * from orders where user_id = $user_id and delivery_status = 3 ORDER BY id DESC ");
    while ($row = $query_da_giao->fetch_assoc()) {
        $order_id = $row['id'];
        $sql2 = "select od.*, od.quantity as order_quantity, p.*,p.name as product_name, p.id as product_id, p.price as product_price from order_detail as od
                JOIN products as p ON od.product_id = p.id
                where od.order_id = $order_id";
        $query2 = $conn->query($sql2);
        $data = [];
        while ($row2 = $query2->fetch_assoc()) {
            $data[] = $row2;
        }
        $row['order_detail'] = $data;
        $list_order_da_giao[] = $row;
    }
    $query_da_huy = $conn->query("select * from orders where user_id = $user_id and delivery_status = 4 ORDER BY id DESC ");
    while ($row = $query_da_huy->fetch_assoc()) {
        $order_id = $row['id'];
        $sql2 = "select od.*, od.quantity as order_quantity, p.*,p.name as product_name, p.id as product_id, p.price as product_price from order_detail as od
                JOIN products as p ON od.product_id = p.id
                where od.order_id = $order_id";
        $query2 = $conn->query($sql2);
        $data = [];
        while ($row2 = $query2->fetch_assoc()) {
            $data[] = $row2; 
        }
        $row['order_detail'] = $data;
        $list_order_da_huy[] = $row;
    }
    // echo '<pre>'; print_r($list_order); echo '</pre>';
    //     exit;
}
include "partials/header.php";
?>

        <div class="list_order">
            <div class="container">
            <div class="row">
                <div class="col-md-3 col-sm-12 col-xs-12">
                    <div class="media">
                         <img class="mr-3" src="img/user-img/avatar.jpg" alt="Generic placeholder image" width="80" style="border-radius: 50%">
                         <div class="media-body">
                            <h6 class="mt-0">Vũ Minh Đức</h6>
                            <p style="font-size: 15px; color: #777"><i class="fa fa-pencil"></i> Sửa thông tin</p>
                        </div>
                    </div>
                    <div class="menu_user_detail">
                        <ul>
                            <li data-toggle="collapse" data-target="#women" class="collapsed active li-menu-user">
                                <i class="fa fa-user mr-2 icon-user-menu"></i>
                                <a href="#" class="a-menu-user">Tài khoản của tôi<span class="arrow"></span></a>
                            </li>
                            <li data-toggle="collapse" data-target="#man" class="collapsed li-menu-user">
                                <i class="fa fa-first-order mr-2 icon-order-menu"></i>
                                <a href="#" class="a-menu-user" style="color: red">Đơn mua<span class="arrow"></span></a>
                            </li>
                            <li data-toggle="collapse" data-target="#eyewear" class="collapsed li-menu-user">
                                <i class="fa fa-shopping-cart mr-2 icon-cart-menu"></i>
                                <a href="#" class="a-menu-user">Giỏ hàng<span class="arrow"></span></a>
                            </li>
                            <li data-toggle="collapse" data-target="#kids" class="collapsed li-menu-user">
                                <i class="fa fa-bell mr-2 icon-noti-menu"></i>
                                <a href="#" class="a-menu-user">Thông báo<span class="arrow"></span></a>
                            </li>
                            <li data-toggle="collapse" data-target="#footwear" class="collapsed li-menu-user">
                                <i class="fa fa-credit-card mr-2 icon-voucher-menu"></i>
                                <a href="#" class="a-menu-user">Voucher của bạn<span class="arrow"></span></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-9 col-sm-12 col-xs-12 ">
                  <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-all" role="tab" aria-controls="nav-home" aria-selected="true">Tất cả</a>
                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-cho-xac-nhan" role="tab" aria-controls="nav-profile" aria-selected="false">Chờ xác nhận</a>
                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-da-xac-nhan" role="tab" aria-controls="nav-contact" aria-selected="false">Đã Xác nhận</a>
                      <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-dang-giao" role="tab" aria-controls="nav-about" aria-selected="false">Đang giao</a>
                      <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-da-giao" role="tab" aria-controls="nav-about" aria-selected="false">Đã giao</a>
                      <a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-da-huy" role="tab" aria-controls="nav-about" aria-selected="false">Đã hủy</a>
                    </div>
                  </nav>
                  <div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
                    <div class="tab-pane fade show active" id="nav-all" role="tabpanel" aria-labelledby="nav-home-tab">
                        <?php foreach ($list_order as $item) {?>
                            <div class="ml-2 mt-2">
                                <div class="row">

                                <?php foreach ($item['order_detail'] as $i) {?>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <div class="media">
                                            <img class="mr-3" src="<?php echo $i['image'] ?>" alt="Generic placeholder image" width="160">
                                                <div class="media-body">
                                                    <div>
                                                        <h6 class="mt-0"><?php echo $i['product_name'] ?></h6>
                                                        <p>x <?php echo $i['order_quantity'] ?><span style="font-size: 15px; color: #777"> <br><?php echo date("d-m-Y", strtotime($item['created_at'])) ?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12" style="text-align: center;">
                                        <div class="status-order">
                                        <?php
                                            if ($item['delivery_status'] == 0) {
                                                echo "Chờ xác nhận";
                                            } elseif ($item['delivery_status'] == 1) {
                                                echo "Đã xác nhận";
                                            } elseif ($item['delivery_status'] == 2) {
                                                echo "Đang giao";
                                            } elseif ($item['delivery_status'] == 3) {
                                                echo "Đã giao";
                                            } else {
                                                echo "Đã hủy từ khách hàng";
                                            }
                                        ?>
                                        </div>
                                        <div class="price--original"><?php echo number_format($i['product_price']) ?> VNĐ</div>
                                        <div class="price--primary"><?php echo number_format($i['price']*(100-$i['sale'])/100) ?> VNĐ</div>
                                    </div>
                                <?php }?>
                                </div>
                                <div style="background: rgb(255 254 251)">
                                    <div class="text-right mr-3">
                                        <p>
                                            <i class="fa fa-money mr-2" style="color: red"></i>
                                            Tổng số tiền: <span style="color: red;font-size: 25px;"><?php echo number_format($item['total_money']) ?> VNĐ</span>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12" style="display: flex">
                                            <?php if (!$i['review']) {?>
                                                <button type="button" href="{{route('make_review', $ls->id)}}" class="btn btn-info" data-toggle="modal" data-target="#myModal1" onclick="return makeReview(this);">
                                                        Đánh giá lần đặt hàng
                                                </button>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <?php if ($item['delivery_status'] == 0 || $item['delivery_status'] == 1 || $item['delivery_status'] == 2) {?>
                                                <a href="controller/cancel_order.php?order_id=<?php echo $item['id'] ?>">
                                                    <button type="button" class="btn btn-danger p-bt" >Hủy đơn hàng</button>
                                                </a>
                                            <?php
                                                } else {
                                            ?>
                                                <a href="#">
                                                    <button type="button" class="btn btn-danger p-bt">Mua thêm</button>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                            <a href="order_detail.php?order_id=<?php echo  $item['id']?>" title="Xem chi tiết đơn hàng">
                                                <button type="button" class="btn btn-default p-bt">Xem chi tiết đơn hàng</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="tab-pane fade" id="nav-cho-xac-nhan" role="tabpanel" aria-labelledby="nav-profile-tab">
                        <?php foreach ($list_order_cho_xac_nhan as $item) {?>
                            <div class="ml-2 mt-2">
                                <div class="row">

                                <?php foreach ($item['order_detail'] as $i) {?>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <div class="media">
                                            <img class="mr-3" src="<?php echo $i['image'] ?>" alt="Generic placeholder image" width="160">
                                                <div class="media-body">
                                                    <div>
                                                        <h6 class="mt-0"><?php echo $i['product_name'] ?></h6>
                                                        <?php echo $i['product_name']; ?>
                                                        <p>x <?php echo $i['order_quantity'] ?><span style="font-size: 15px; color: #777"> <br><?php echo date("d-m-Y", strtotime($item['created_at'])) ?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12" style="text-align: center;">
                                        <div class="status-order">
                                        <?php
                                            if ($item['delivery_status'] == 0) {
                                                echo "Chờ xác nhận";
                                            } elseif ($item['delivery_status'] == 1) {
                                                echo "Đã xác nhận";
                                            } elseif ($item['delivery_status'] == 2) {
                                                echo "Đang giao";
                                            } elseif ($item['delivery_status'] == 3) {
                                                echo "Đã giao";
                                            } else {
                                                echo "Đã hủy từ khách hàng";
                                            }
                                        ?>
                                        </div>
                                        <div class="price--original"><?php echo number_format($i['product_price']) ?> VNĐ</div>
                                        <div class="price--primary"><?php echo number_format($i['price']*(100-$i['sale'])/100) ?> VNĐ</div>
                                    </div>
                                <?php }?>
                                </div>
                                <div style="background: rgb(255 254 251)">
                                    <div class="text-right mr-3">
                                        <p>
                                            <i class="fa fa-money mr-2" style="color: red"></i>
                                            Tổng số tiền: <span style="color: red;font-size: 25px;"><?php echo number_format($item['total_money']) ?> VNĐ</span>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12" style="display: flex">
                                            <?php if (!$i['review']) {?>
                                                <button type="button" href="{{route('make_review', $ls->id)}}" class="btn btn-info" data-toggle="modal" data-target="#myModal1" onclick="return makeReview(this);">
                                                        Đánh giá lần đặt hàng
                                                </button>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <?php if ($item['delivery_status'] == 0 || $item['delivery_status'] == 1 || $item['delivery_status'] == 2) {?>
                                                <a href="controller/cancel_order.php?order_id=<?php echo $item['id'] ?>">
                                                    <button type="button" class="btn btn-danger p-bt" >Hủy đơn hàng</button>
                                                </a>
                                            <?php
                                                } else {
                                            ?>
                                                <a href="#">
                                                    <button type="button" class="btn btn-danger p-bt">Mua thêm</button>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                            <a href="order_detail.php?order_id=<?php echo  $item['id']?>" title="Xem chi tiết đơn hàng">
                                                <button type="button" class="btn btn-default p-bt">Xem chi tiết đơn hàng</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="tab-pane fade" id="nav-da-xac-nhan" role="tabpanel" aria-labelledby="nav-contact-tab">
                        <?php foreach ($list_order_da_xac_nhan as $item) {?>
                            <div class="ml-2 mt-2">
                                <div class="row">

                                <?php foreach ($item['order_detail'] as $i) {?>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <div class="media">
                                            <img class="mr-3" src="<?php echo $i['image'] ?>" alt="Generic placeholder image" width="160">
                                                <div class="media-body">
                                                    <div>
                                                        <h6 class="mt-0"><?php echo $i['product_name'] ?></h6>
                                                        <p>x <?php echo $i['order_quantity'] ?><span style="font-size: 15px; color: #777"> <br><?php echo date("d-m-Y", strtotime($item['created_at'])) ?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12" style="text-align: center;">
                                        <div class="status-order">
                                        <?php
                                            if ($item['delivery_status'] == 0) {
                                                echo "Chờ xác nhận";
                                            } elseif ($item['delivery_status'] == 1) {
                                                echo "Đã xác nhận";
                                            } elseif ($item['delivery_status'] == 2) {
                                                echo "Đang giao";
                                            } elseif ($item['delivery_status'] == 3) {
                                                echo "Đã giao";
                                            } else {
                                                echo "Đã hủy từ khách hàng";
                                            }
                                        ?>
                                        </div>
                                        <div class="price--original"><?php echo number_format($i['product_price']) ?> VNĐ</div>
                                        <div class="price--primary"><?php echo number_format($i['price']*(100-$i['sale'])/100) ?> VNĐ</div>
                                    </div>
                                <?php }?>
                                </div>
                                <div style="background: rgb(255 254 251)">
                                    <div class="text-right mr-3">
                                        <p>
                                            <i class="fa fa-money mr-2" style="color: red"></i>
                                            Tổng số tiền: <span style="color: red;font-size: 25px;"><?php echo number_format($item['total_money']) ?> VNĐ</span>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12" style="display: flex">
                                            <?php if (!$i['review']) {?>
                                                <button type="button" href="{{route('make_review', $ls->id)}}" class="btn btn-info" data-toggle="modal" data-target="#myModal1" onclick="return makeReview(this);">
                                                        Đánh giá lần đặt hàng
                                                </button>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <?php if ($item['delivery_status'] == 0 || $item['delivery_status'] == 1 || $item['delivery_status'] == 2) {?>
                                                <a href="controller/cancel_order.php?order_id=<?php echo $item['id'] ?>">
                                                    <button type="button" class="btn btn-danger p-bt" >Hủy đơn hàng</button>
                                                </a>
                                            <?php
                                                } else {
                                            ?>
                                                <a href="#">
                                                    <button type="button" class="btn btn-danger p-bt">Mua thêm</button>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                            <a href="order_detail.php?order_id=<?php echo  $item['id']?>" title="Xem chi tiết đơn hàng">
                                                <button type="button" class="btn btn-default p-bt">Xem chi tiết đơn hàng</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="tab-pane fade" id="nav-dang-giao" role="tabpanel" aria-labelledby="nav-about-tab">
                        <?php foreach ($list_order_dang_giao as $item) {?>
                            <div class="ml-2 mt-2">
                                <div class="row">

                                <?php foreach ($item['order_detail'] as $i) {?>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <div class="media">
                                            <img class="mr-3" src="<?php echo $i['image'] ?>" alt="Generic placeholder image" width="160">
                                                <div class="media-body">
                                                    <div>
                                                        <h6 class="mt-0"><?php echo $i['product_name'] ?></h6>
                                                        <p>x <?php echo $i['order_quantity'] ?><span style="font-size: 15px; color: #777"> <br><?php echo date("d-m-Y", strtotime($item['created_at'])) ?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12" style="text-align: center;">
                                        <div class="status-order">
                                        <?php
                                            if ($item['delivery_status'] == 0) {
                                                echo "Chờ xác nhận";
                                            } elseif ($item['delivery_status'] == 1) {
                                                echo "Đã xác nhận";
                                            } elseif ($item['delivery_status'] == 2) {
                                                echo "Đang giao";
                                            } elseif ($item['delivery_status'] == 3) {
                                                echo "Đã giao";
                                            } else {
                                                echo "Đã hủy từ khách hàng";
                                            }
                                        ?>
                                        </div>
                                        <div class="price--original"><?php echo number_format($i['product_price']) ?> VNĐ</div>
                                        <div class="price--primary"><?php echo number_format($i['price']*(100-$i['sale'])/100) ?> VNĐ</div>
                                    </div>
                                <?php }?>
                                </div>
                                <div style="background: rgb(255 254 251)">
                                    <div class="text-right mr-3">
                                        <p>
                                            <i class="fa fa-money mr-2" style="color: red"></i>
                                            Tổng số tiền: <span style="color: red;font-size: 25px;"><?php echo number_format($item['total_money']) ?> VNĐ</span>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12" style="display: flex">
                                            <?php if (!$i['review']) {?>
                                                <button type="button" href="{{route('make_review', $ls->id)}}" class="btn btn-info" data-toggle="modal" data-target="#myModal1" onclick="return makeReview(this);">
                                                        Đánh giá lần đặt hàng
                                                </button>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <?php if ($item['delivery_status'] == 0 || $item['delivery_status'] == 1 || $item['delivery_status'] == 2) {?>
                                                <a href="controller/cancel_order.php?order_id=<?php echo $item['id'] ?>">
                                                    <button type="button" class="btn btn-danger p-bt" >Hủy đơn hàng</button>
                                                </a>
                                            <?php
                                                } else {
                                            ?>
                                                <a href="#">
                                                    <button type="button" class="btn btn-danger p-bt">Mua thêm</button>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                            <a href="order_detail.php?order_id=<?php echo  $item['id']?>" title="Xem chi tiết đơn hàng">
                                                <button type="button" class="btn btn-default p-bt">Xem chi tiết đơn hàng</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="tab-pane fade" id="nav-da-giao" role="tabpanel" aria-labelledby="nav-about-tab">
                        <?php foreach ($list_order_da_giao as $item) {?>
                            <div class="ml-2 mt-2">
                                <div class="row">

                                <?php foreach ($item['order_detail'] as $i) {?>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <div class="media">
                                            <img class="mr-3" src="<?php echo $i['image'] ?>" alt="Generic placeholder image" width="160">
                                                <div class="media-body">
                                                    <div>
                                                        <h6 class="mt-0"><?php echo $i['product_name'] ?></h6>
                                                        <p>x <?php echo $i['order_quantity'] ?><span style="font-size: 15px; color: #777"> <br><?php echo date("d-m-Y", strtotime($item['created_at'])) ?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12" style="text-align: center;">
                                        <div class="status-order">
                                        <?php
                                            if ($item['delivery_status'] == 0) {
                                                echo "Chờ xác nhận";
                                            } elseif ($item['delivery_status'] == 1) {
                                                echo "Đã xác nhận";
                                            } elseif ($item['delivery_status'] == 2) {
                                                echo "Đang giao";
                                            } elseif ($item['delivery_status'] == 3) {
                                                echo "Đã giao";
                                            } else {
                                                echo "Đã hủy từ khách hàng";
                                            }
                                        ?>
                                        </div>
                                        <div class="price--original"><?php echo number_format($i['product_price']) ?> VNĐ</div>
                                        <div class="price--primary"><?php echo number_format($i['price']*(100-$i['sale'])/100) ?> VNĐ</div>
                                    </div>
                                <?php }?>
                                </div>
                                <div style="background: rgb(255 254 251)">
                                    <div class="text-right mr-3">
                                        <p>
                                            <i class="fa fa-money mr-2" style="color: red"></i>
                                            Tổng số tiền: <span style="color: red;font-size: 25px;"><?php echo number_format($item['total_money']) ?> VNĐ</span>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12" style="display: flex">
                                            <?php if (!$i['review']) {?>
                                                <button type="button" href="{{route('make_review', $ls->id)}}" class="btn btn-info" data-toggle="modal" data-target="#myModal1" onclick="return makeReview(this);">
                                                        Đánh giá lần đặt hàng
                                                </button>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <?php if ($item['delivery_status'] == 0 || $item['delivery_status'] == 1 || $item['delivery_status'] == 2) {?>
                                                <a href="controller/cancel_order.php?order_id=<?php echo $item['id'] ?>">
                                                    <button type="button" class="btn btn-danger p-bt" >Hủy đơn hàng</button>
                                                </a>
                                            <?php
                                                } else {
                                            ?>
                                                <a href="#">
                                                    <button type="button" class="btn btn-danger p-bt">Mua thêm</button>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                            <a href="order_detail.php?order_id=<?php echo  $item['id']?>" title="Xem chi tiết đơn hàng">
                                                <button type="button" class="btn btn-default p-bt">Xem chi tiết đơn hàng</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                    <div class="tab-pane fade" id="nav-da-huy" role="tabpanel" aria-labelledby="nav-about-tab">
                        <?php foreach ($list_order_da_huy as $item) {?>
                            <div class="ml-2 mt-2">
                                <div class="row">
                                <?php foreach ($item['order_detail'] as $i) {?>
                                        <div class="col-md-9 col-sm-12 col-xs-12">
                                            <div class="media">
                                            <img class="mr-3" src="<?php echo $i['image'] ?>" alt="Generic placeholder image" width="160">
                                                <div class="media-body">
                                                    <div>
                                                        <h6 class="mt-0"><?php echo $i['product_name'] ?></h6>
                                                        <p>x <?php echo $i['order_quantity'] ?><span style="font-size: 15px; color: #777"> <br><?php echo date("d-m-Y", strtotime($item['created_at'])) ?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="col-md-3 col-sm-12 col-xs-12" style="text-align: center;">
                                        <div class="status-order">
                                        <?php
                                            if ($item['delivery_status'] == 0) {
                                                echo "Chờ xác nhận";
                                            } elseif ($item['delivery_status'] == 1) {
                                                echo "Đã xác nhận";
                                            } elseif ($item['delivery_status'] == 2) {
                                                echo "Đang giao";
                                            } elseif ($item['delivery_status'] == 3) {
                                                echo "Đã giao";
                                            } else {
                                                echo "Đã hủy từ khách hàng";
                                            }
                                        ?>
                                        </div>
                                        <div class="price--original"><?php echo number_format($i['product_price']) ?> VNĐ</div>
                                        <div class="price--primary"><?php echo number_format($i['price']*(100-$i['sale'])/100) ?> VNĐ</div>
                                    </div>
                                <?php }?>
                                </div>
                                <div style="background: rgb(255 254 251)">
                                    <div class="text-right mr-3">
                                        <p>
                                            <i class="fa fa-money mr-2" style="color: red"></i>
                                            Tổng số tiền: <span style="color: red;font-size: 25px;"><?php echo number_format($item['total_money']) ?> VNĐ</span>
                                        </p>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12 col-xs-12" style="display: flex">
                                            <?php if (!$i['review']) {?>
                                                <button type="button" href="{{route('make_review', $ls->id)}}" class="btn btn-info" data-toggle="modal" data-target="#myModal1" onclick="return makeReview(this);">
                                                        Đánh giá lần đặt hàng
                                                </button>
                                            <?php
                                                }
                                            ?>
                                        </div>
                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                            <?php if ($item['delivery_status'] == 0 || $item['delivery_status'] == 1 || $item['delivery_status'] == 2) {?>
                                                <a href="controller/cancel_order.php?order_id=<?php echo $item['id'] ?>">
                                                    <button type="button" class="btn btn-danger p-bt" >Hủy đơn hàng</button>
                                                </a>
                                            <?php
                                                } else {
                                            ?>
                                                <a href="#">
                                                    <button type="button" class="btn btn-danger p-bt">Mua thêm</button>
                                                </a>
                                            <?php
                                                }
                                            ?>
                                            <a href="order_detail.php?order_id=<?php echo  $item['id']?>" title="Xem chi tiết đơn hàng">
                                                <button type="button" class="btn btn-default p-bt">Xem chi tiết đơn hàng</button>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php }?>
                    </div>
                  </div>

                </div>
            </div>
        </div>
        <div id="id02" class="modal">
            <span onclick="document.getElementById('id02').style.display='none'" class="close" title="Close Modal">×</span>
            <form class="modal-content" action="/action_page.php">
                <div class="container">
                    <h1>Hủy đơn hàng</h1>
                    <p>Bạn có chắc chắn muốn hủy đơn hàng này?</p>

                    <div class="clearfix">
                        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="cancelbtn">Đóng</button>
                        <button type="button" onclick="document.getElementById('id02').style.display='none'" class="deletebtn">Hủy</button>
                    </div>
                </div>
            </form>
        </div>
<?php
include "partials/footer.php";
?>