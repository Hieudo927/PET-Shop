<?php
session_start();
include 'includes/header.php';
include 'config/connect.php';
$product_id = $_GET['id'];
$statement = $pdo ->prepare("SELECT * FROM products WHERE id = '$product_id' and status ='0'");
$statement -> execute();
$product = $statement -> fetch(PDO::FETCH_ASSOC);

?>

<?php
if (empty($product))
{
    ?>
    <h5 class="text-danger">Có lỗi xảy ra</h5>
    <?php
}
else
{
    ?>
    <div class="py-3 bg-secondary">
        <div class="container">
            <h6 class="text-white"> <a href="index.php">Home</a> / <a href="categories.php">Danh mục</a> / <?= $product['name']?></h6>
        </div>
    </div>

    <div class="bg-light py-4">
        <div class="container product_data mt-3">
            <div class="row">
                <div class="col-md-4">
                    <div class="shadow">
                        <img src="uploads/<?=$product['image']?>" alt="" class="w-100">
                    </div>
                </div>
                <div class="col-md-8">
                    <h4 class="fw-bold"><?=$product['name']?></h4>
                    <hr>
                    <p>
                        <?=$product['gender'] == '0'?'Giới tính: Đực':''?>
                        <?=$product['gender'] == '1'?'Giới tính: Cái':''?>
                    </p>
                    <p>Tuổi: <?=$product['month']?> tháng</p>
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Giá khuyến mãi: <span class="text-success"><?=$product['selling_price']?> đ</span></h4>
                        </div>
                        <div class="col-md-6">
                            <h5>Giá gốc: <s class="text-danger"><?=$product['original_price']?> đ</s></h5>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="input-group mb-3" style="width: 130px">
                                <button class="input-group-text btn-giam">-</button>
                                <input type="text" class="form-control text-center bg-white qty" value="1" disabled>
                                <button class="input-group-text btn-tang">+</button>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <button class="btn btn-primary px-4 addToCartBtn" value="<?=$product['id']?>"> <i class="fa fa-shopping-cart me-2"></i>Thêm vào giỏ hàng</button>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-danger px-4"> <i class="fa fa-heart me-2"></i>Yêu thích</button>
                        </div>
                    </div>
                    <hr>

                    <p class="fw-bold">Mô tả: </p>
                    <p><?=$product['description']?></p>

                </div>
            </div>
        </div>
    </div>

    <?php
}
?>

<?php include 'includes/footer.php'?>
