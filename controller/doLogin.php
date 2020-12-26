<?php
//Khai báo sử dụng session
session_start();
 
//Khai báo utf-8 để hiển thị được tiếng việt
header('Content-Type: text/html; charset=UTF-8');
//Xử lý đăng nhập
if (isset($_POST['login'])) 
{
   
    //Kết nối tới database
    include('../connection.php');
    // echo $conn;
    // die;
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
	$query = mysqli_query($conn,$sql);
	$num_rows = mysqli_num_rows($query);
	if ($num_rows==0) {
        echo "tên đăng nhập hoặc mật khẩu không đúng !";
        exit; 
	}else{
        $row = mysqli_fetch_array($query);
		//tiến hành lưu tên đăng nhập vào session để tiện xử lý sau này
		$_SESSION['email'] = $email;
		$_SESSION['name'] = $row['name'];
		$_SESSION['phone'] = $row['phone'];
		$_SESSION['address'] = $row['address'];
        $_SESSION['user_id'] = $row['id'];
        $_SESSION['is_admin'] = $row['is_admin'];
        // echo $row['id']
        // Thực thi hành động sau khi lưu thông tin vào session
        // ở đây mình tiến hành chuyển hướng trang web tới một trang gọi là index.php
        if($row['is_admin'] == 1){
            header('Location: /BT3_VuMinhDuc/quantri/order.php?action=order');
        }else{
            header('Location: /BT3_VuMinhDuc/index.php');
        }
        
    }
}