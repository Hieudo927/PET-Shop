<?php

include 'config/connect.php';
include 'authen.php';
include 'includes/header.php';

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
<div class="py-3 bg-secondary">
    <div class="container">
        <h6 class="text-white">
            <a href="index.php" class="text-white text-decoration-none">Home</a> /
            <a class="text-white text-decoration-none" href="my-order.php">Đơn hàng</a> /
            <a class="text-white text-decoration-none" href="#">Chi tiết đơn hàng</a>
        </h6>

    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header bg-secondary">
                            <span class="fs-4 text-white">Chi tiết đơn hàng <b><?=$tracking_no?></b></span>
                            <a href="my-order.php" class="float-end btn btn-warning"><i class="fa fa-reply"></i> Quay lại</a>
                            <a href="print-order.php?t=<?=$tracking_no?>" target="_blank" class="float-end btn btn-success mx-2">In đơn hàng</a>
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
                                    <div class="border p-1 mb-3">
                                        <label class="fw-bold">Trạng thái: </label>
                                        <?php
                                        if ($orderData['status']== 0){
                                            echo "<span class='text-warning fw-bold'>Đang xử lý</span>";
                                        } else if ($orderData['status'] == 1){
                                            echo "<span class='text-success fw-bold'>Hoàn thành</span>";
                                        }else if($orderData['status'] == 2)
                                        {
                                            echo "<span class='text-danger fw-bold'>Đã hủy</span>";
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
</div>


<?php include 'includes/footer.php'?>
