<?php
require_once '../function/redirect.php';

if(isset($_SESSION['login']))
{
    if($_SESSION['role_as'] == 0){
        redirect("../index.php", "Bạn không có quyền truy cập trang này!");
    }
}
else
{
    redirect("../login.php", "Đăng nhập để tiếp tục");
}
?>