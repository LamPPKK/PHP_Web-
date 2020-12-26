<?php
session_start();
include('../connection.php');
if(isset($_GET['action'])){
    // var_dump($_GET['product_id']);echo '<br>';
    // var_dump($_GET['star']);echo '<br>';
    // var_dump($_GET['content']);echo '<br>';
    $product_id = $_GET['product_id'];
    $user_id = $_SESSION['user_id'];
    $star = $_GET['star'];
    $content = $_GET['content'];
    $sqlAddReview = "INSERT INTO review_products (product_id, user_id,star,content, status)
    VALUES ($product_id , $user_id, $star, '.$content.' , 0)";
    // echo $sqlAddReview ;die;
    $excute = $conn->query($sqlAddReview);
    if($excute){
        echo 200;
    }else{
        echo 500;
    }
}
?>