<?php
session_start();
if(isset($_GET['order_id']) && $_GET['order_id'] != NULL){
    include('../connection.php');
    $order_id = $_GET['order_id'];
    $sql = "UPDATE orders SET delivery_status = 4 WHERE id = $order_id";
    $query = $conn->query($sql);
    if ($query === TRUE) {
        echo '<script language="javascript">';
        echo 'alert("Hủy đơn hàng thành công")';
        echo '</script>';
        header('Location: /BT2_LT_Web/order_user.php');
    } else {
        echo '<script language="javascript">';
        echo 'alert("Hủy đơn hàng không thành công")';
        echo '</script>';
    }
    
}

?>