<?php
include '../authorization/admin_author.php';
include('includes/header.php');

include '../config/connect.php';

?>
<div id="container" class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4>Danh mục sản phẩm</h4>
                </div>

                <div class="card-body">
                    <a class="btn btn-dark" href="add-category.php">Thêm mới</a>
                    <table id="myTablecate" class="table table-bordered table-hover table-striped">
                        <thead>
                            <tr>
                                <th class="col-md-1">ID</th>
                                <th>Tên</th>
                                <th>Hình ảnh</th>
                                <th>Loại</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                        $statement = $pdo -> prepare("SELECT * FROM categories");
                        $statement -> execute();
                        $items = $statement -> fetchAll(PDO::FETCH_ASSOC);
                        foreach ($items as $item)
                        {
                            ?>
                                <tr>
                                    <td><?=$item['id']?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td>
                                        <img alt="" height="150px" width="100px" src="../uploads/<?= $item['image'] ?>">
                                    </td>
                                    <td>
                                        <?php if($item['type'] == "1") echo 'Chó';
                                        if($item['type'] == "2") echo 'Mèo';
                                        if($item['type'] == "3") echo 'Phụ kiện'; ?>
                                    </td>
                                    <td>
                                        <?= $item['status'] == '0' ? 'Hiện' : 'Ẩn' ?>
                                    </td>
                                    <td>
                                        <a href="edit-category.php?id=<?= $item['id']?>" class="btn btn-success">Sửa</a>
                                        <button type="button" value="<?= $item['id']?>" class="btn btn-danger btn_delete_category">Xóa</button>
                                    </td>
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
<?php include ('includes/footer.php'); ?>
<script>

</script>
