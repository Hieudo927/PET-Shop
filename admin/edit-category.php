<?php
include('includes/header.php');
include '../authorization/admin_author.php';
include '../config/connect.php';
?>

<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <?php
            if (isset($_GET['id']))
            {
                $id = $_GET['id'];

                $statement = $pdo ->prepare("SELECT * FROM categories WHERE `id` = '$id'");
                $statement-> execute();
                $category = $statement->fetch(PDO::FETCH_ASSOC);
                //var_dump($category);
                ?>
                <div class="card">
                    <div class="card-header">
                        <h4>Sửa danh mục</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="code.php" enctype="multipart/form-data">
                            <input type="hidden" name="id" value="<?= $category['id']?>">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="name">Tên danh mục:</label>
                                    <input class="form-control" type="text" name="name" id="name" value="<?= $category['name']?>" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="type">Loại:</label>
                                    <select name="type" id="type" class="form-select form-control mb-3" aria-label="Default select example">
                                        <option <?= $category['type'] == '1' ? "selected":"" ?> value="1">Chó</option>
                                        <option <?= $category['type'] == '2' ? "selected":"" ?> value="2">Mèo</option>
                                        <option <?= $category['type'] == '3' ? "selected":"" ?> value="3">Phụ kiện</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    Hình ảnh: <input type="file" id="image" name="image" onchange="readURL(this);">
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <h6>Ảnh mới: </h6>
                                        <img id="preview" src="#" alt=""/>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Ảnh hiện tại: </h6>
                                        <img src="../uploads/<?= $category['image']?>" height="100px" width="100px" alt="">
                                        <input type="hidden" name="old_image" value="<?= $category['image']?>">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="title">Tiêu đề:</label>
                                    <input class="form-control mb-3" value="<?= $category['meta_title']?>" type="text" name="title" id="title">
                                </div>
                                <div class="col-md-6 mb-3">
                                    Trạng thái <input <?= $category['status']? "checked": ""?> type="checkbox" id="status" name="status">
                                </div>
                                <div class="col-md-6 mb-3">
                                    Phổ biến <input <?= $category['popular']? "checked": ""?> type="checkbox" id="popular" name="popular">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary"  name="btn_update_category">Save</button>
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
                    .width(100)
                    .height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<?php include ('includes/footer.php'); ?>

