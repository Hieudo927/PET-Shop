<?php
include '../authorization/admin_author.php';
include('includes/header.php');
include '../config/connect.php';
$searchName = '';
if (isset($_POST['TimProd'])){
    $searchName = $_POST['searchProd'];
    if ($searchName != ''){
        $statement = $pdo -> prepare("SELECT * FROM products WHERE name LIKE '%$searchName%'");
        $statement -> execute();
        $items = $statement -> fetchAll(PDO::FETCH_ASSOC);
    }else{
        $statement = $pdo -> prepare("SELECT * FROM products order by id DESC ");
        $statement -> execute();
        $items = $statement -> fetchAll(PDO::FETCH_ASSOC);
    }
}else{
    $statement = $pdo -> prepare("SELECT * FROM products order by id DESC ");
    $statement -> execute();
    $items = $statement -> fetchAll(PDO::FETCH_ASSOC);
}

?>
    <div class="container">
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Sản phẩm</h4>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-bordered table-hover table-striped">
                            <a class="btn btn-dark" href="add-product.php">Thêm mới</a>

                            <div class="float-end">
                                <form action="" method="post">
                                    <input class=" w-75" type="text" placeholder="Nhập tên sp" value="<?=$searchName?>" name="searchProd">
                                    <button type="submit" name="TimProd" class="w-20">Tìm</button>
                                </form>
                            </div>
                            <thead>
                            <tr>
                                <th class="col-md-1">ID</th>
                                <th>Tên</th>
                                <th class="col-md-1">Số lượng</th>
                                <th>Hình ảnh</th>
                                <th>Giới tính</th>
                                <th>Trạng thái</th>
                                <th>Hành động</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            foreach ($items as $item)
                            {
                                ?>
                                <tr>
                                    <td><?=$item['id']?></td>
                                    <td><?= $item['name'] ?></td>
                                    <td><?=$item['quantity']?></td>
                                    <td>
                                        <img alt="" height="70px" width="70px" src="../uploads/<?= $item['image'] ?>">
                                    </td>
                                    <td>
                                        <?php
                                        if($item['gender'] == "0"){ echo 'Cái';}
                                        else if($item['gender'] == "1") {echo 'Đực';}
                                        else {echo 'Khác';}
                                        ?>
                                    </td>
                                    <td>
                                        <?= $item['status'] == '0' ? 'Hiện' : 'Ẩn' ?>
                                    </td>
                                    <td>
                                        <a href="detail-product.php?id=<?= $item['id']?>" class="btn btn-warning">Chi tiết</a>
                                        <a href="edit-product.php?id=<?= $item['id']?>" class="btn btn-success">Sửa</a>
                                        <button type="button" value="<?= $item['id']?>" class="btn btn-danger btn_delete_product">Xóa</button>
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



