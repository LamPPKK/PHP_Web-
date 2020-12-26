<?php
    include('../../connection.php');

    $status = $_GET['status'];
    $review_id = $_GET['review_id'];
    // var_dump($status);die;
    $queryReview = "UPDATE review_products
    SET status = $status 
    WHERE id = $review_id";
    $excuteReview = $conn->query($queryReview);
    if($excuteReview){
        header('Location: /BT3_VuMinhDuc/quantri/review.php?action=review');
    }
?>