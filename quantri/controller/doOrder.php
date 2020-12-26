<?php
//Khai báo sử dụng session
session_start();
$orderWaitConfirm = [];
$orderWaitGetItem = [];
$orderDelivering = [];
$orderDelivered = [];
$orderCancelled = [];

include '../../connection.php';
$user_id = $_SESSION['user_id'];

$sqlWaitConfirm = "select * from orders where user_id = $user_id  and status =0";
$query = $conn->query($sqlWaitConfirm);
while ($WaitConfirm = $query->fetch_assoc()){
   
    $orderWaitConfirm[] = $WaitConfirm;    
}

$sqlWaitGetItem = "select * from orders where user_id = $user_id  and status =1";
$query = $conn->query($sqlWaitGetItem);
while ($WaitGetItem = $query->fetch_assoc()){
   
    $orderWaitGetItem[] = $WaitGetItem;    
}

$sqlDelivering = "select * from orders where user_id = $user_id  and status =2";
$query = $conn->query($sqlDelivering);
while ($Delivering = $query->fetch_assoc()){
   
    $orderDelivering[] = $Delivering;    
}

$sqlDelivered = "select * from orders where user_id = $user_id  and status =3";
$query = $conn->query($sqlDelivered);
while ($Delivered = $query->fetch_assoc()){
   
    $orderDelivered[] = $Delivered;    
}

$sqlCancelled = "select * from orders where user_id = $user_id  and status =4";
$query = $conn->query($sqlCancelled);
while ($Cancelled = $query->fetch_assoc()){
   
    $orderCancelled[] = $Cancelled;    
}
?>