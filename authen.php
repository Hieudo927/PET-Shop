<?php
include 'function/redirect.php';
if (!isset($_SESSION['login']))
{
    redirect("login.php","Đăng nhập để tiếp tục");
}
?>
