<?php
    session_start();
    include('connection.php');
    include "partials/header.php";
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
                        Thông báo
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
                            <div class="item-title-cate ml-2 " >
                                Đơn hàng
                            </div>
                        </a>
                    </div>
                    <div class="item-link d-flex align-items-center">
                        <div class="item-icon-user icon-notification">
                            <i class="fa fa-bell-o "></i>
                        </div>
                        <a href="notification.php" class="w-100">
                            <div class="item-title-cate ml-2 d-flex justify-content-between active ">
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
            <div class="notifications">
                    <ul style="list-style:none">

                    <?php 
                        $queryNotification = "SELECT * FROM notifications WHERE user_id = $user_id";
                        $excuteNoti = $conn->query($queryNotification);
                        $data=[];
                        While($row = $excuteNoti->fetch_assoc()){
                            $data[] = $row;
                        }
                        $notificationByUserId = $data;
                        // var_dump($notificationByUserId[0]['order_id']);die;

                     ?>
                    <?php foreach ($notificationByUserId as $notice) { ?>
                    <a href="order_detail.php?order_id=<?php echo $notice['order_id'];?>">
                        <li class="d-flex align-items-center justify-content-between p-2 <?php if($notice['status'] == 0) echo 'not_seen' ;?>">
                            <?= $notice['content']; ?>
                           
                            <span><?= date('Y-m-d H:i:s',strtotime($notice['created_at']) )?> </span>
                            
                        </li>
                    </a>
                    <?php }; ?>
                    </ul>

            </div>
            </div>
        </div>
    </section>
</div>
<?php
include "partials/footer.php";
?>