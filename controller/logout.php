<?php
session_start();

if(isset($_SESSION['name']) && $_SESSION['name'] != NULL && isset($_SESSION['email']) && $_SESSION['email'] != NULL){
    unset($_SESSION['name']);
    unset($_SESSION['email']);
    header('Location: /BT3_VuMinhDuc/index.php');
}

?>