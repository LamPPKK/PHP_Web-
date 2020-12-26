<?php
    // header("Content-type: text/html; charset=utf-8");
    $servername = "localhost";
    $database = "bt3_vuminhduc";
    $username = "root";
    $password = "";
    // Create connection
    $conn = mysqli_connect($servername, $username, $password, $database);
    mysqli_set_charset($conn, 'UTF8');

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
 