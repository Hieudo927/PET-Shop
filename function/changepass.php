<?php

include 'redirect.php';
include '../config/connect.php';

$id = $_SESSION['user_id'];

if (isset($_POST['btn_changepass']))
{
    $pass_old = $_POST['password'];
    $pass_new = $_POST['password_new'];
    $pass_xn =  $_POST['password_xacnhan'];

    $statement = $pdo -> prepare("SELECT password FROM users WHERE id = '$id'");
    $statement -> execute();
    $result = $statement -> fetch(PDO::FETCH_ASSOC);
    $hash = $result['password'];

    if (password_verify($pass_old, $hash))
    {
        if ($pass_new == $pass_xn){
            $hash2 = password_hash($pass_new, PASSWORD_DEFAULT);
            $statement = $pdo -> prepare("UPDATE users SET password = '$hash2' WHERE id = '$id'");
            $result = $statement -> execute();
            if ($result) {
                redirect("../changepassword.php", "Đổi mật khẩu thành công");
            }
        }else{
            redirect("../changepassword.php", "Xác nhận không trùng khớp");
        }
    }else{
        redirect("../changepassword.php", "Mật khẩu không đúng");
    }

}
