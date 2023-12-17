<?php
include '../authorization/admin_author.php';
include('includes/header.php');
include '../config/connect.php';
$statement = $pdo -> prepare("SELECT id, name FROM categories");
$statement ->execute();
$categories = $statement->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id'])){
                $id = $_GET['id'];

                $statement = $pdo -> prepare("SELECT * FROM products WHERE `id` = '$id'");
                $statement -> execute();
                $product = $statement -> fetch(PDO::FETCH_ASSOC);
                //var_dump($product);
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Sửa sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="code.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-4">
                                    <label for="name">Tên danh mục:</label>
                                    <select name="category_id" class="form-select form-control" aria-label="" disabled>
                                        <option selected>Chọn danh mục</option>
                                        <?php foreach ($categories as $item) {
                                            ?>
                                            <option value="<?= $item['id']?>"<?= $product['category_id'] == $item['id']?'selected':'' ?>><?= $item['name']?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-8">
                                    <label for="name">Tên sản phẩm:</label>
                                    <input class="form-control" type="text" name="name" id="name" value="<?= $product['name']?>" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label for="gender">Giới tính:</label>
                                    <select name="gender" id="gender" class="form-select form-control mb-3" aria-label="Default select example" disabled>
                                        <option <?= $product['gender'] == '0' ? "selected":"" ?> value="0">Cái</option>
                                        <option <?= $product['gender'] == '1' ? "selected":"" ?> value="1">Đực</option>
                                        <option <?= $product['gender'] == '2' ? "selected":"" ?> value="2">Khác</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="name">Tháng tuổi:</label>
                                    <input class="form-control" type="number" name="month" id="month" value="<?=$product['month']?>" disabled>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="name">Số lượng:</label>
                                    <input class="form-control" type="number" name="quantity" id="quantity" value="<?=$product['quantity']?>" disabled>
                                </div>

                                <div class="col-md-4">
                                    <label for="title">Giá gốc:</label>
                                    <input class="form-control mb-3" type="text" name="original_price"  value="<?=$product['original_price']?>" id="original_price" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label for="title">Giá khuyến mãi:</label>
                                    <input class="form-control mb-3" type="text" name="selling_price" id="selling_price" value="<?=$product['selling_price']?>" disabled>
                                </div>
                                <div class="col-md-3">
                                    <h6>Ảnh: </h6>
                                    <img src="../uploads/<?= $product['image']?>" height="100px" width="100px" alt="">
                                </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="description">Mô tả:</label>
                                    <textarea class="form-control" id="description" name="description" rows="5" cols="1000" disabled><?=$product['description']?></textarea>
                                </div>
                                <div class="col-md-6 mb-3">
                                    Trạng thái <input <?= $product['status']? "checked": ""?> type="checkbox" id="status" name="status" disabled>
                                </div>
                                <div class="col-md-12">
                                    <a class="btn btn-primary" href="product.php">Quay lại</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</div>
<script>
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#preview')
                    .attr('src', e.target.result)
                    .width(150)
                    .height(200);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php include ('includes/footer.php'); ?>
