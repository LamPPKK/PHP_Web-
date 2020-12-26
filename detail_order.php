<?php
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
                        Chi tiết đơn hàng
                    </a>
                </li>
            </ul>
        </div>
        <div class="col-12 mt-2 bg-white">
            <div class="row">
                <div class="col-2">
                    <div class="info-user d-flex">
                        <div class="box-image-user flex-1 rounded-circle">
                            <img src="img/user-img/avatar.jpg" />
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
                            <a href="order.html">
                                <div class="item-title-cate ml-2 active">
                                    Đơn hàng
                                </div>
                            </a>
                        </div>
                        <div class="item-link d-flex align-items-center">
                            <div class="item-icon-user icon-notification">
                                <i class="fa fa-bell-o "></i>
                            </div>
                            <a href="javascript:;" class=>
                                <div class="item-title-cate ml-2 ">
                                    Thông báo
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-10">

                    <div class="text-header-order">
                        <div class="text-left-header-order">
                            Đơn hàng số: XXXYYYZZZ99
                        </div>
                        <div class="text-right-status">
                            Đã nhận hàng
                        </div>
                    </div>
                    <div class="order-status position-relative">
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
                                        12:20 21-08-2020
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-md-2 item-status-order">
                                <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
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
                                <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-handshake-o"></i>
                                </div>
                                <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                                    <div class="text-status-order order-2 text-center">
                                        Đã giao cho ĐVVC
                                    </div>
                                    <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                        12:00 22-08-2020
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-md-2 item-status-order">
                                <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-ambulance"></i>
                                </div>
                                <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                                    <div class="text-status-order order-2 text-center">
                                        Đang giao hàng
                                    </div>
                                    <div class="datetime-status-order order-1 align-items-center justify-content-center mt-2">
                                        6:20 23-08-2020
                                    </div>
                                </div>
                            </div>
                            <div class="col-2 col-md-2 item-status-order">
                                <div class="box-icon box-icon-active rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fa fa-money"></i>
                                </div>
                                <div class="box-content flex-column-reverse d-flex align-items-center justify-content-center mt-2">
                                    <div class="text-status-order order-2 text-center">
                                        Đã nhận hàng
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
                    <div class="show-text">
                        <div class=" row">
                            <div class="text-show-left col align-items-center d-flex">
                                Bạn đã nhận đơn hàng này
                            </div>
                            <div class="text-show-left text-right col-3 ">
                                <div class="buy__again">
                                    Mua lại lần nữa
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="order-address">
                        <div class="text-address">
                            Địa chỉ nhận hàng
                        </div>
                        <div class="content-address">
                            <div class="name-user-address">
                                Nguyễn Bá Hùng
                            </div>
                            <div class="phone-user-address">
                                0972218408
                            </div>
                            <div class="user-address">
                                Số 9 Ngõ 1 Lê Văn Thiêm, Q.Thanh Xuân, Phường Thượng Đình, Quận Thanh Xuân, Hà Nội
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
                                Đã giao
                            </div>
                        </div>
                        <div class="detail-order-product">
                            <div class="row">
                                <div class="col-2">
                                    <div class="box-image">
                                        <img src="../Site/public/images/products/0011.jpg" alt="">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="title__product">
                                        Điện thoại Iphone kiểu dáng sang trọng, màu xám đậm chất dân chơi
                                    </div>
                                    <div class="type__product">
                                        Phân loại hàng: Xám
                                    </div>
                                    <div class="total__product">
                                        Số lượng: 1
                                    </div>
                                </div>
                                <div class="col-4 text-right">
                                    <div class="price__product text-red justify-content-end">
                                        <sup class="text-underline ">đ</sup>25.000.000.000
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="d-flex p-3 border payment-item">
                                        <div class="text-order-payment flex-auto ">
                                            Tổng tiền hàng

                                        </div>
                                        <div class="d-flex  money-order-payment">
                                            <div class="payment-money-product justify-content-end ">
                                                <sup class="text-underline ">đ</sup>25.000.000.000
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
                                                <sup class="text-underline ">đ</sup>25.000.000.000
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
        </div>
    </div>
<?php
include "partials/footer.php";
?>