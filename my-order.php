<?php

include 'config/connect.php';
include 'authen.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];
$getOrders = $pdo->prepare("SELECT * FROM orders WHERE user_id ='$user_id' ORDER BY id DESC");
$getOrders -> execute();
$orders = $getOrders -> fetchAll(PDO::FETCH_ASSOC);

?>
<div class="py-3 bg-secondary">
    <div class="container">
        <h6 class="text-white"> <a href="index.php" class="text-white text-decoration-none">Home</a> / <a class="text-white text-decoration-none" href="my-order.php">Đơn hàng</a></h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tracking No</th>
                                <th>Tổng tiền</th>
                                <th>Ngày đặt</th>
                                <th>Trạng thái</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        if (count($orders)>0){
                            foreach ($orders as $item)
                            {
                                ?>
                                <tr>
                                    <td><?=$item['id']?></td>
                                    <td><?=$item['tracking_no']?></td>
                                    <td><?=$item['total_price']?> đ</td>
                                    <td><?=$item['create_at']?></td>
                                    <td>
                                        <?php
                                        if ($item['status']== 0){
                                            echo "<span class='text-warning fw-bold'>Đang xử lý</span>";
                                        } else if ($item['status'] == 1){
                                            echo "<span class='text-success fw-bold'>Hoàn thành</span>";
                                        }else if($item['status'] == 2)
                                        {
                                            echo "<span class='text-danger fw-bold'>Đã hủy</span>";
                                        }
                                        ?>
                                    </td>
                                    <td><a href="view-order.php?t=<?=$item['tracking_no']?>" class="btn btn-primary">Chi tiết</a></td>
                                </tr>
                                <?php
                            }
                        }else{
                            ?>
                            <tr>
                                <td colspan="5">Bạn chưa có đơn hàng nào</td>
                            </tr>
                            <?php
                        }
                        ?>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'?>
