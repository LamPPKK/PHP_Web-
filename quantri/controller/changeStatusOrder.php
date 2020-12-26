<?php
include "PHPMailer-master/src/Exception.php";
include "PHPMailer-master/src/OAuth.php";
include "PHPMailer-master/src/PHPMailer.php";
include "PHPMailer-master/src/POP3.php";
include "PHPMailer-master/src/SMTP.php";
use PHPMailer\PHPMailer\PHPMailer;

session_start();
include('../../connection.php');
// $user_id = $_SESSION['user_id'];

$order_id = $_GET['order_id'];

$queryOrderInfo = "SELECT orders.user_id, users.email FROM orders 
                    
                    JOIN users ON users.id = orders.user_id
                    WHERE  orders.id =$order_id";
$excuteOrderInfo = $conn->query($queryOrderInfo);

$resultOrderInfo = $excuteOrderInfo->fetch_assoc();
$email_user= $resultOrderInfo['email'];
$user_id= $resultOrderInfo['user_id'];
// var_dump($excuteOrderInfo->fetch_assoc()['email']);die;
$status = $_GET['status'];
// echo $_SESSION['is_admin'];die;
$queryOrder = "UPDATE orders
SET status = $status
WHERE id = $order_id";
$excuteOrder = $conn->query($queryOrder);

$queryHistory = "INSERT INTO history_orders (order_id,  status)
VALUES ($order_id , $status)";

$excuteHistory = $conn->query($queryHistory);


if($status ==1){
    $statusContent ='đã được xác nhận.';
}
if($status ==2){
    $statusContent ='đã được vận chuyển.';
}
if($status ==3){
    $statusContent ='đã giao thành công.';
}
if($status ==4){
    $statusContent ='đã bị hủy.';
}
$content = "Đơn hàng số " . $order_id . " của bạn " . $statusContent;
$queryNoti = "INSERT INTO notifications (user_id, order_id, content, status)
VALUES ($user_id, $order_id, '.$content.' , 0)";
$excuteNoti = $conn->query($queryNoti);

//   var_dump($excuteNoti);die; 

function sendMail($email, $body, $subject)
    {
        $mail = new PHPMailer(true);
        $config_email = 'testltweb@gmail.com';
        $config_pass = 'minhduc3004';
        $mail->IsSMTP(); // set mailer to use SMTP
        $mail->CharSet = 'UTF-8';
        $mail->Host = "smtp.gmail.com"; // specify main and backup server
        $mail->Port = 587; // set the port to use
        $mail->SMTPAuth = true; // turn on SMTP authentication
        $mail->SMTPSecure = 'tls';
        $mail->Username = $config_email; // your SMTP username or your gmail username
        $mail->Password = $config_pass; // your SMTP password or your gmail password
        $from = $config_email; // Reply to this email
        //$to=$email; // Recipients email ID
        $name = 'Shop MU'; // Recipient's name
        $mail->From = $from;
        $mail->FromName = 'Shop MU'; // Name to indicate where the email came from when the recepient received

        $mail->AddAddress($email, $name);
        $mail->AddReplyTo($from, $subject);
        $mail->IsHTML(true); // send as HTML
        $mail->Subject = $subject;
        $mail->Body = $body; //HTML Body
        if ($mail->Send()) {
            return true;
        } else {
            return false;
        }
    }
    $subject = "Thông báo shop MU";
    $body = $content;
    if (isset($email_user)) {
        $email = $email_user;
        sendMail($email, $body, $subject);
    }
if($excuteOrder &&  $excuteHistory){
    $_SESSION['statusChangeOrder'] = 200;
}else{
    $_SESSION['statusChangeOrder'] = 500 ;

}
if($_SESSION['is_admin'] == 1){
    header('Location: /BT3_VuMinhDuc/quantri/order.php?action=order');
}else{
    header('Location: /BT3_VuMinhDuc/order_index.php');
}
?>