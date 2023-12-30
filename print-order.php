<?php

include 'config/connect.php';
include 'authen.php';


if (isset($_GET['t'])){
    $tracking_no = $_GET['t'];

    $user_id = $_SESSION['user_id'];

    $checkTrackingNo = $pdo -> prepare("SELECT * FROM orders WHERE tracking_no ='$tracking_no' AND user_id = '$user_id'");
    $checkTrackingNo -> execute();
    $orderData = $checkTrackingNo->fetch(PDO::FETCH_ASSOC);
    //var_dump($orderData);
    if ($orderData == ""){
        echo "<h4>Có lỗi xảy ra</h4>";
        die();
    }
}
else{
    echo "<h4>Có lỗi xảy ra</h4>";
    die();
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/custom.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Alertify JS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css"/>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/bootstrap.min.css"/>
</head>
<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <span class="fs-4 text-white">Chi tiết đơn hàng <b><?=$tracking_no?></b></span>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Tên người nhận</label>
                                            <div class="border p-1">
                                                <?=$orderData['name']?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Email</label>
                                            <div class="border p-1">
                                                <?=$orderData['email']?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Số điện thoại</label>
                                            <div class="border p-1">
                                                <?=$orderData['phone']?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Pincode</label>
                                            <div class="border p-1">
                                                <?=$orderData['pincode']?>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mb-2">
                                            <label class="fw-bold">Địa chỉ</label>
                                            <div class="border p-1">
                                                <?=$orderData['address']?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <table class="table">
                                        <thead>
                                        <tr>
                                            <th>Sản phẩm</th>
                                            <th>Giá bán</th>
                                            <th>Số lượng</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $selectOrderData = $pdo -> prepare("SELECT o.id as oid, o.tracking_no, o.user_id, oi.*,p.* 
                                    FROM orders o, order_items oi, products p
                                    WHERE o.user_id = '$user_id' AND oi.order_id = o.id AND p.id = oi.product_id
                                    AND o.tracking_no = '$tracking_no'");

                                        $selectOrderData -> execute();
                                        $result = $selectOrderData -> fetchAll(PDO::FETCH_ASSOC);

                                        foreach ($result as $item)
                                        {
                                            ?>
                                            <tr>
                                                <td class="align-middle">
                                                    <img src="uploads/<?=$item['image']?>" width="50px" height="50px">
                                                    <?=$item['name']?>
                                                </td>
                                                <td class="align-middle">
                                                    <?=$item['price']?> đ
                                                </td>
                                                <td class="align-middle">
                                                    x <?=$item['qty']?>
                                                </td>

                                            </tr>
                                            <?php
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                    <hr>
                                    <h5>Tổng tiền: <span class="float-end"><?=$orderData['total_price']?> đ</span></h5>
                                    <hr>
                                    <div class="border p-1 mb-3">
                                        <label class="fw-bold">Phương thức thanh toán: </label>
                                        <?=$orderData['payment_mode']?>
                                    </div>
                                    <?php
                                    if ($orderData['payment_mode'] == 'PayPal'){
                                        ?>
                                        <div class="border p-1 mb-3">
                                            <label class="fw-bold">Mã giao dịch: </label>
                                            <?=$orderData['payment_id']?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.7.1.min.js"></script>
<script>
    $(document).ready(function (){
        window.print();
    })
</script>
