<?php

include('includes/header.php');
include '../authorization/admin_author.php';

include '../config/connect.php';

if (isset($_GET['t'])){
    $tracking_no = $_GET['t'];



    $checkTrackingNo = $pdo -> prepare("SELECT * FROM orders WHERE tracking_no ='$tracking_no'");
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


<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                            <div class="card-header bg-secondary">
                                <span class="fs-4 text-white">Chi tiết đơn hàng <b><?=$tracking_no?></b></span>
                                <a href="orders.php" class="float-end btn btn-warning"><i class="fa fa-reply"></i> Quay lại</a>
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
                                        WHERE oi.order_id = o.id AND p.id = oi.product_id
                                        AND o.tracking_no = '$tracking_no'");

                                            $selectOrderData -> execute();
                                            $result = $selectOrderData -> fetchAll(PDO::FETCH_ASSOC);

                                            foreach ($result as $item)
                                            {
                                                ?>
                                                <tr>
                                                    <td class="align-middle">
                                                        <img src="../uploads/<?=$item['image']?>" width="50px" height="50px">
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

                                            <label class="fw-bold">Trạng thái: </label>
                                        <form action="code.php" method="post">
                                            <input type="hidden" name="tracking_no" value="<?=$orderData['tracking_no']?>">
                                            <select <?=$orderData['status']!= 0 ?'disabled':''?> name="order_status" class="form-select form-control">
                                                <option value="0" <?=$orderData['status']== 0 ?'selected':''?>>Đang tiến hành</option>
                                                <option value="1" <?=$orderData['status']== 1 ?'selected':''?>>Hoàn thành</option>
                                                <option value="2" <?=$orderData['status']== 2 ?'selected':''?>>Đã hủy</option>
                                            </select>
                                            <button <?=$orderData['status']!= 0 ?'disabled':''?> type="<?=$orderData['status']== 1 ?'':''?>" name="btnUpdateOrder" class="mt-3 float-end btn btn-primary">Cập nhật</button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'?>
