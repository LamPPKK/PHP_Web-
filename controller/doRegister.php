<?php
    session_start();

    include('../connection.php');
        $name = addslashes($_POST['name']);
        $password = addslashes($_POST['password']);
        $email =addslashes($_POST['email']);
        
        $error = array();
       

        // Mã khóa mật khẩu
        $password = md5($password);
        $queryRegis = "INSERT INTO users (name, email , password, is_admin)
        VALUES ('.$name.', '.$email.', '.$password.' , 0)";
        $excuteRegis = $conn->query($queryRegis);
        if($excuteRegis){
            $_SESSION['statusRegiter'] = 200;
            // $last_id = $conn->insert_id;
            header('Location: /BT3_NguyenBaHung/register.php');
        }else{
            $_SESSION['statusRegiter'] = 500;
            // $last_id = $conn->insert_id;
            header('Location: /BT3_NguyenBaHung/register.php');
        }
        
       
?>