<?php
session_start();
include '../config/connect.php';
// register user
if(isset($_POST['but_register'])){
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cf_password = $_POST['cf_password'];

    $sql_select = "SELECT `email` FROM `users` WHERE `email` = '$email'";
    $statement = $pdo -> query($sql_select);
    $result = $statement -> rowCount();

    if ($result > 0){
        $_SESSION['msg'] = "Email đã tồn tại";
        header('Location: ../register.php');
    }
    else{
        if ($password == $cf_password){
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $statement = $pdo -> prepare("INSERT INTO users (name, birthday, gender, phone, address, email, password) VALUES ('$name', '$birthday', '$gender', '$phone', '$address', '$email', '$hash')");
            $result = $statement->execute();
            if ($result){
                $_SESSION['msg'] = "Đăng ký thành công";
                header('Location: ../login.php');
            }
            else {
                $_SESSION['msg'] = "Có lỗi xảy ra";
                header('Location: ../register.php');
            }
        }
        else{
            $_SESSION['msg'] = "Xác nhận mật khẩu không trùng khớp";
            header('Location: ../register.php');
        }
    }
}
?>
