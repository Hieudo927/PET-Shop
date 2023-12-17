<?php
include '../authorization/admin_author.php';
include('includes/header.php');

?>

    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Thêm danh mục</h4>
                    </div>
                    <div class="card-body">
                        <form method="post" action="code.php" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-md-8">
                                    <label for="name">Tên danh mục:</label>
                                    <input class="form-control" type="text" name="name" id="name" placeholder="Alaska" required>
                                </div>
                                <div class="col-md-4">
                                    <label for="type">Loại:</label>
                                    <select name="type" id="type" class="form-select form-control mb-3" aria-label="Default select example">
                                        <option value="1">Chó</option>
                                        <option value="2">Mèo</option>
                                        <option value="3">Phụ kiện</option>
                                    </select>
                                </div>
                                <div class="col-md-12 mb-3">
                                    Hình ảnh: <input type="file" id="image" name="image" onchange="readURL(this);">
                                    <img id="preview" src="#" alt=""/>
                                </div>
                                <div class="col-md-12">
                                    <label for="title">Tiêu đề:</label>
                                    <input class="form-control mb-3" type="text" name="title" id="title">
                                </div>
                                <div class="col-md-6 mb-3">
                                    Trạng thái <input type="checkbox" id="status" name="status">
                                </div>
                                <div class="col-md-6 mb-3">
                                    Phổ biến <input type="checkbox" id="popular" name="popular">
                                </div>
                                <div class="col-md-12">
                                    <button class="btn btn-primary" id="btn_add_category" name="btn_add_category">Save</button>
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
