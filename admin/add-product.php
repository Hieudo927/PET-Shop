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
            <div class="card">
                <div class="card-header">
                    <h4>Thêm sản phẩm</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="code.php" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-4">
                                <label for="name">Tên danh mục:</label>
                                <select name="category_id" class="form-select form-control" aria-label="">
                                    <option selected>Chọn danh mục</option>
                                    <?php foreach ($categories as $item) {
                                        ?>
                                        <option value="<?= $item['id']?>"><?= $item['name']?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="col-md-8">
                                <label for="name">Tên sản phẩm:</label>
                                <input class="form-control" type="text" name="name" id="name" placeholder="Alaska" required>
                            </div>
                            <div class="col-md-6">
                                <label for="gender">Giới tính:</label>
                                <select name="gender" id="gender" class="form-select form-control mb-3" aria-label="Default select example">
                                    <option selected value="0">Cái</option>
                                    <option value="1">Đực</option>
                                    <option value="2">None</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="name">Tháng tuổi:</label>
                                <input class="form-control" type="number" name="month" id="month" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="name">Số lượng:</label>
                                <input class="form-control" type="number" name="quantity" id="quantity" required>
                            </div>

                            <div class="col-md-4">
                                <label for="title">Giá gốc:</label>
                                <input class="form-control mb-3" type="text" name="original_price" id="original_price">
                            </div>
                            <div class="col-md-4">
                                <label for="title">Giá khuyến mãi:</label>
                                <input class="form-control mb-3" type="text" name="selling_price" id="selling_price">
                            </div>
                            <div class="col-md-12 mb-3">
                                Hình ảnh: <input type="file" id="image" name="image" onchange="readURL(this);">
                                <img id="preview" src="#" alt=""/>
                            </div>
                            <div class="col-md-12">
                                <label for="description">Mô tả:</label>
                                <textarea class="form-control" id="description" name="description" rows="5" cols="1000"></textarea>
                            </div>
                            <div class="col-md-6 mb-3">
                                Trạng thái <input type="checkbox" id="status" name="status">
                            </div>
                            <div class="col-md-12">
                                <button class="btn btn-primary" id="btn_add_category" name="btn_add_product">Lưu</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
