<?php
include '../authorization/admin_author.php';
include('includes/header.php');
include '../config/connect.php';
$statement = $pdo -> prepare("SELECT * FROM users WHERE role_as = '0'");
$statement -> execute();
$items = $statement -> fetchAll(PDO::FETCH_ASSOC);
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
                        <thead>
                        <tr>
                            <th class="col-md-1">ID</th>
                            <th>Tên</th>
                            <th class="col-md-1">Số điện thoại</th>
                            <th>Email</th>
                            <th>Giới tính</th>
                            <th>Địa chỉ</th>
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
                                <td><?=$item['phone']?></td>
                                <td><?=$item['email']?></td>
                                <td><?=$item['gender']?></td>
                                <td><?=$item['address']?></td>
                                <td>
                                    <button type="button" value="<?= $item['id']?>" class="btn btn-danger btn_delete_user">Xóa</button>
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
    $(document).ready(function () {
        $('.btn_delete_user').click(function (){
            var id = $(this).val();
            swal({
                title: "Bạn có chắc chắn muốn xóa?",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
                .then((willDelete) => {
                    if (willDelete) {
                        $.ajax({
                            type: "POST",
                            url: "code.php",
                            data:{
                                id:id,
                                btn_delete_user: true
                            },
                            success: function (response) {
                                console.log(response);
                                if(response == 200){
                                    swal("Xóa thành công", {
                                        icon: "success",
                                    });
                                    location.reload();
                                    //$('#myTable').load(location.href + " #myTable");

                                }else if(response == 500){
                                    swal("Có lỗi xảy ra", {
                                        icon: "error",
                                    });
                                }
                            }
                        });
                    }
                });
        });
    });
</script>

