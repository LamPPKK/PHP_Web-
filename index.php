<?php
//Khai báo sử dụng session
session_start();

//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
if (isset($_POST['dangnhap'])) {
    //Kết nối tới database
    include('connection.php');

    //Lấy dữ liệu nhập vào
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);
    //Kiểm tra đã nhập đủ tên đăng nhập với mật khẩu chưa
    if (!$email || !$password) {
        echo "Vui lòng nhập đầy đủ email và mật khẩu";
        exit;
    }
    // mã hóa pasword
    $password = md5($password);

    //Kiểm tra tên đăng nhập có tồn tại không
    $sql = "select * from users where email = '$email' and password = '$password' ";
    $query = mysqli_query($conn, $sql);
    $num_rows = mysqli_num_rows($query);
    if ($num_rows == 0) {
        echo "tên đăng nhập hoặc mật khẩu không đúng !";
        exit;
    } else {
        $row = mysqli_fetch_array($query);
        //tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $row['name'];
        $_SESSION['phone'] = $row['phone'];
        $_SESSION['address'] = $row['address'];
        $_SESSION['user_id'] = $row['id'];
        // Thực thi hành động sau khi lưu thông tin vào session
        // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
        if ($row['is_admin'] == 1) {
            header('Location: /BT2_LT_Web/admin/index.php');
        } else {
            header('Location: index.php');
        }
    }
}
include "partials/header.php";
?>

<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Đăng nhập</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="controller/doLogin.php" method="post" id="formLogin">
                    <input type="hidden" name="login">
                    <div class="form-group">
                        <label for="exampleInputEmail1">Tài khoản</label>
                        <input type="email" name="email" class="form-control" required id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Mật khẩu</label>
                        <input type="password" name="password" required class="form-control" id="exampleInputPassword1" placeholder="Password">
                    </div>
                    <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary btnSubLogin">Đăng nhập</button>
            </div>
        </div>
    </div>
</div>
<div class="container-fluid" style="background-color: rgb(211, 211, 211);">
    <div class="row" style="padding-top: 10px;">
        <div class="col-lg-9">
            <a href="#"><img src="img/bg-img/b23e1379-c5c3-4f6b-8352-67b0faf8d564__1250X60.jpg" style="max-width: 100%;"></a>
        </div>
        <div class="col-lg-3" style="background-color: rgb(211, 211, 211);">
            <h2 style="padding-top: 10px; font-family:cursive; font-weight: bold;">Nhanh lên nào !!!</h2>
        </div>
    </div>
    <div>
        <a href="#"><img src="img/bg-img/38a21e37-a47b-4646-bc5b-f585f8946028__1600X612.jpg" style="max-width: 100%;"></a>
    </div>
    <div>
        <a href="#"><img src="img/bg-img/7dd8c0fa-722c-4d78-a9d7-8e9b9771a00f__1600X612.jpg" style="max-width: 100%;"></a>
    </div>
    <div class="row">
        <div class="col-xl col-lg col-md col-sm">
            <a href="#"><img src="img/bg-img/b_spot_winter_warmers_en.webp" style="max-width: 100%;"></a>
        </div>
        <div class="col-xl col-lg col-md col-sm">
            <a href="#"><img src="img/bg-img/b_spot_gifts_accessories_en.jpg" style="max-width: 100%;"></a> 
        </div>
    </div>
    <div class="row" style="background-color: white;">
        <div class="col-lg">
            <a href="#"><img src="img/bg-img/e_spot_brands_adidas.webp" style="max-width: 100%;"></a>
        </div>
        <div class="col-lg">
            <a href="#"><img src="img/bg-img/e_spot_brands_maui_jim.webp" style="max-width: 100%;"></a>
        </div>
        <div class="col-lg">
            <a href="#"><img src="img/bg-img/e_spot_brands_new_era.webp" style="max-width: 100%;"></a>
        </div>
        <div class="col-lg">
            <a href="#"><img src="img/bg-img/e_spot_brands_paul_smith.webp" style="max-width: 100%;"></a>
        </div>
        <div class="col-lg">
            <a href="#"><img src="img/bg-img/e_spot_brands_remington.webp" style="max-width: 100%;"></a>
        </div>
        <div class="col-lg">
            <a href="#"><img src="img/bg-img/e_spot_brands_tag_heuer.webp" style="max-width: 100%;"></a>
        </div>
    </div>
</div>
<?php
include "partials/footer.php";
?>