<?php
include '../authorization/admin_author.php';
include('includes/header.php');


include '../config/connect.php';

$user_id = $_SESSION['user_id'];
$getOrders = $pdo->prepare("SELECT o.* FROM orders o WHERE status = '0' ORDER BY id DESC");
$getOrders -> execute();
$orders = $getOrders -> fetchAll(PDO::FETCH_ASSOC);

?>


<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Đơn hàng đang xử lý</h4>
                    <a class="btn-primary btn" href="orders.php">Tất cả</a>
                    <a class="btn-warning btn" href="order-xuly.php">Đang xử lý</a>
                    <a class="btn btn-success" href="order-success.php">Đã Hoàn thành</a>
                    <a class="btn btn-danger" href="order-huy.php">Đã Hủy</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Người nhận</th>
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
                                    <td><?=$item['name']?></td>
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
                                <td colspan="7">Chưa có đơn hàng nào</td>
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
