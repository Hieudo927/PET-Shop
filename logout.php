<?php
session_start();

if (isset($_SESSION['login'])){
    unset($_SESSION['login']);
    unset($_SESSION['user_name']);
    unset($_SESSION['user_id']);
    $_SESSION['msg'] = "Đăng xuất thành công";
}

header('Location: login.php');