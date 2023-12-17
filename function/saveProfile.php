<?php

include 'redirect.php';
include '../config/connect.php';

if (isset($_POST['but_saveProfile'])) {
    $id =$_POST['id'];
    $name = $_POST['name'];
    $birthday = $_POST['birthday'];
    $phone = $_POST['phone'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    $statement = $pdo->prepare("UPDATE `users` SET `name`=?, `birthday`=?, `gender`=?, `phone`=?, `address`=? WHERE id = ?");
    $res = $statement->execute([$name, $birthday, $gender, $phone, $address, $id]);

    if($res){
        redirect("../profile.php", "Sủa thành công");
    }


}
?>
