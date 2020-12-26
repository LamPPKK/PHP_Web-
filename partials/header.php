<!DOCTYPE html>
<html mlns="http://www.w3.org/1999/xhtml" xmlns:fb="http://ogp.me/ns/fb#" class="no-js">

<head>
    <title>Shop MU</title>
    <!-- meta -->
    <!-- <meta http-equiv="Content-Type" content="text/html; charset=utf-8"> -->
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="alternate" href="#" hreflang="vi-vn" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="csrf-token" content="Y3PHaspBSQ2cXyp0iq1TkFMJLbBDWlsd9XgZSTKq">

    <link rel="shortcut icon" href="img/core-img/huyhieu.jpg" type="image/x-icon" />



    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:image:width" content="300" />
    <meta property="og:image:height" content="300" />



    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="Site/public/bootstrap-4.0.0/dist/css/bootstrap.css" type="text/css">


    <link rel="stylesheet" href="Site/public/font-awesome-master/css/font-awesome.css">
    <link rel="stylesheet" href="Site/public/sweetalert2/dark.css">


    <link rel="stylesheet" href="Site/public/css/star-rating-svg.css" type="text/css">
    <link rel="stylesheet" href="Site/public/css/style-rating.css" type="text/css">
    <link rel="stylesheet" href="Site/public/css/product.css" type="text/css">
    <link rel="stylesheet" href="Site/public/css/header.css" type="text/css">
    <link rel="stylesheet" href="Site/public/css/home__page.css" type="text/css">
    <link rel="stylesheet" href="Site/public/css/thang_responsive.css" type="text/css">
    <link rel="stylesheet" href="Site/public/css/client.css" type="text/css">
    <link rel="stylesheet" href="Site/public/css/detail_order.css" type="text/css">
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-4 col-12 mbds_none_770">
                <!-- <ul class="navbar__links">
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav__link__header color-white text_top_header ">
								Kết nối
							</a>
                        </li>
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav__link__header color-white text_top_header pjy1mut-background pjy1mut-ic_facebook-2x-png text_top_header" title="Kết nối Facebook" target="_blank">
                            </a>
                        </li>
                    </ul> -->
            </div>
            <div class="col-xl-9 col-lg-9 col-md-8 col-12 mbdsNone mbds_none_770">
                <ul class="navbar__links float-right navbar__links768">

                    <li class="nav-item">
                        <a href="#" onclick="notify();" class="nav-link nav__link__header color-white text_top_header" style="color: black;">
                            Thông báo
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="#" onclick="help();" class="nav-link nav__link__header color-white text_top_header" style="color: black">
                            Trợ giúp
                        </a>
                    </li>


                    <li class="nav-item">
                        <?php
                        if (isset($_SESSION['name'])) {
                            echo '<a href="order_index.php" class="nav-link nav__link__header color-white text_top_header " style=" color: black"><i class="fa fa-user mr-2"></i>' . $_SESSION['name'] . '</a>';
                            echo '<span style="color: black !important;">|</span>';
                            echo '<a href="controller/logout.php" class="nav-link nav__link__header color-white text_top_header" style="display: inline-block; color:black;">Thoát</a>';
                        } else {

                            echo ' <a href="#" data-toggle="modal" data-target="#loginModal" class="nav-link nav__link__header color-white text_top_header" style="display: inline-block; color: black"> Đăng nhập  </a>';
                            echo '<span style="color: black !important;">|</span>';
                            echo '<a href="register.php" class="nav-link nav__link__header color-white text_top_header" style="display: inline-block; color: black">Đăng ký</a>';
                        }
                        ?>
                    </li>


                    <!--  <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav__link__header color-white text_top_header">
                                Đăng ký
                            </a>
                        </li>
                        <div class="navbar__link-separator"></div>

                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link nav__link__header color-white text_top_header" data-toggle="modal"
                               data-target="#loginForm">
                                Đăng nhập
                            </a>
                        </li> -->
                    <li class="nav-item">
                        <div class="col-md-1 col-2 cart_user li_cart_user d-none">
                            <a href="javascript:;">
                                <div class="cart">
                                    <i class="fa fa-shopping-cart icon__cart"></i>
                                </div>
                            </a>
                            <div>
                                <div class="cart">
                                    <i class="fa fa-user-circle icon__cart d-none"></i>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
    </div>
    <div class="row" style="background-color: #DB1D24;">
        <div class="col-lg-1">
            <div><a href="#"><img class="image" style="max-width: 100%; border-radius: 5px; height: 80px; padding-left: 20px;" src="img/core-img/huyhieu.jpg"></a></div>
        </div>
        <div class="col-lg-2">
            <h1 style="color:aliceblue; font-family: sans-serif; padding-top: 10px;">Shop MU</h1>
        </div>
        <div class="col-lg-5">
            <div class="section-header-search" style="padding-top: 20px;">
                <div class="form-search__input" style="position: relative">
                    <input type="text" name="keySearch" placeholder="Tìm kiếm sản phẩm" autocomplete="off" class="input__header__search" value="">
                    <span class="box__header__search">
                        <button type="button" style="background-color: white;" class="btn__header__search background_top_header" onclick="document.getElementById('formSearchHeader').submit();">
                            <i class="fa fa-search icon__header__search" style="color:black"></i>
                        </button>
                    </span>
                </div>
                </form>
                <div class="show__data__search_header"></div>
            </div>
        </div>
    </div>
    <div class="row" style="background-color: #242424;">
        <div class="container">
            <ul class="nav nav-pills nav-justified">
                <li class="nav-item" style="justify-items: center;">
                    <a class="nav-link" href="#" style="color:aliceblue; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Trang phục thi đấu</a>
                </li>
                <li class="nav-item" style="justify-items: center;">
                    <a class="nav-link" href="#" style="color:aliceblue; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Trang phục tập luyện</a>
                </li>
                <li class="nav-item" style="justify-items: center;">
                    <a class="nav-link" href="#" style="color:aliceblue; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Quần áo</a>
                </li>
                <li class="nav-item" style="justify-items: center;">
                    <a class="nav-link" href="#" style="color:aliceblue; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Phụ kiện</a>
                </li>
                <li class="nav-item" style="justify-items: center;">
                    <a class="nav-link" href="#" style="color:aliceblue; font-family: Arial, Helvetica, sans-serif; font-weight: bold;">Bộ sưu tập</a>
                </li>
            </ul>
        </div>
    </div>
</body>