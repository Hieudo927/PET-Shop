<?php
include_once '../authorization/admin_author.php';
include_once 'includes/header.php';

include '../config/connect.php';


$stmt = $pdo->prepare("SELECT COUNT(*) as total_products FROM products");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$totalProducts = $result['total_products'];

$stmt = $pdo->prepare("SELECT COUNT(*) as total_user FROM users WHERE role_as = '0'");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_user = $result['total_user'];

$stmt = $pdo->prepare("SELECT COUNT(*) as total_category FROM categories");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_category = $result['total_category'];

$stmt = $pdo->prepare("SELECT COUNT(*) as total_order FROM orders WHERE status ='0'");
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);
$total_order = $result['total_order'];

?>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card ">
                        <div class="card-body bg-dark p-3 pt-2">
                            <div class="text-end text-white  pt-1">
                                <p class="text-sm fw-bold mb-0 text-capitalize">Sản phẩm</p>
                                <h4 class="mb-0 text-white" ><?=$totalProducts?></h4>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card">
                        <div class="card-body bg-primary fw-bold p-3 pt-2">

                            <div class="text-end  pt-1">
                                <p class="text-sm fw-bold mb-0 text-white text-capitalize fw-bold">Khách hàng</p>
                                <h4 class="mb-0 text-white"><?=$total_user?></h4>
                            </div>
                        </div>

                    </div>
                    </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card mb-2">
                        <div class="card-body bg-secondary p-3 pt-2 ">
                            <div class="text-end text-white  pt-1">
                                <p class="text-sm fw-bold mb-0 text-capitalize ">Danh mục</p>
                                <h4 class="mb-0 text-white "><?=$total_category?></h4>
                            </div>
                        </div>


                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                    <div class="card ">
                        <div class="card-body  p-3 pt-2 bg-success">

                            <div class="text-end  text-white pt-1">
                                <p class="text-sm fw-bold mb-0 text-capitalize ">Đơn hàng gần đây</p>
                                <h4 class="mb-0 "><?=$total_order?></h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="assets/admin.png">
    </div>
</div>
<?php include ('includes/footer.php'); ?>