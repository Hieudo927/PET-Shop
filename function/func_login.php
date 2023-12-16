<?php
session_start();
include 'redirect.php';
include '../config/connect.php';

if (isset($_POST['btn_login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $statement = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $statement->execute([$email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);

    $hash = $user['password'];
    $role_as = $user['role_as'];
    //var_dump($user);
    if ($user) {
        if (password_verify($password, $hash)) {

            $_SESSION['login'] = true;
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['role_as'] = $role_as;
            if ($role_as == '1') {
                redirect("../admin/index.php", "Chào mừng bạn đến với trang Admin");
            }
            else
            {
                redirect("../index.php", "Đăng nhập thành công");
            }
        }
        else
        {
            redirect("../login.php", "Email/Password không đúng");
        }
    }
    else
    {
        redirect("../login.php", "Email/Password không đúng");
    }
}
?>
