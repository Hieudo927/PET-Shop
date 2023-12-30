<?php
session_start();
include 'includes/header.php';
?>

<div class="py-5">
    <div class="container">
        <div class="d-flex justify-content-center">
            <?php if(isset($_SESSION['msg'])) { ?>
                <div class="w-75 alert alert-warning alert-dismissible fade show" role="alert">
                    <?= $_SESSION['msg']; ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <?php unset($_SESSION['msg']); } ?>
        </div>
        <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
                <div class="card w-50">
                    <div class="card-header">
                        <h4 class="text-center">Đổi mật khẩu</h4>
                    </div>
                    <div class="card-body">
                        <form action="function/changepass.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="floatingInput" name="password" placeholder="" required>
                                <label for="floatingInput">Mật khẩu hiện tại<sup class="text-danger fw-bold">*</sup></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password_new" id="floatingPassword" placeholder="" required>
                                <label for="floatingPassword">Mật khẩu mới<sup class="text-danger fw-bold">*</sup></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password_xacnhan" id="floatingPassword" placeholder="" required>
                                <label for="floatingPassword">Xác nhận mật khẩu<sup class="text-danger fw-bold">*</sup></label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" name="btn_changepass" id="" value="Xác nhận" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div style="padding-bottom: 90px"></div>
<?php include 'includes/footer.php' ?>

