<?php
session_start();
include 'includes/header.php';

if(isset($_SESSION['login'])) {
    $_SESSION['msg'] = "Bạn đã đăng nhập rồi!";
    header('Location: index.php');
    exit();
}
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
                <div class="card w-75">
                    <div class="card-header">
                        <h4 class="text-center">Đăng ký</h4>
                    </div>
                    <div class="card-body">
                        <form action="function/func_register.php" method="post">
                            <div class="d-flex me-3">
                                <div class="col-7 form-floating mb-3 me-3">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="" required>
                                    <label for="name">Họ tên <sup class="text-danger fw-bold">*</sup></label>
                                </div>
                                <div class="col-5 form-floating mb-3">
                                    <input type="text" class="form-control" id="birthday" name="birthday" placeholder="01/01/2000" required>
                                    <label for="birthday">Ngày sinh <sup class="text-danger fw-bold">*</sup></label>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="col-5 p-0">
                                    <p class="m-2 d-inline-block">Giới tính: </p>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="Nam" checked>
                                        <label class="form-check-label" for="gender">Nam</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="Nữ">
                                        <label class="form-check-label" for="gender">Nữ</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="gender" value="Khác">
                                        <label class="form-check-label" for="gender">Khác</label>
                                    </div>
                                </div>
                                <div class="form-floating mb-3 col-7">
                                    <input type="text" class="form-control" id="phone" name="phone" placeholder="" required>
                                    <label for="phone">Điện thoại <sup class="text-danger fw-bold">*</sup></label>
                                </div>
                            </div>

                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" name="address" id="address" placeholder="" required>
                                <label for="address">Địa chỉ <sup class="text-danger fw-bold">*</sup></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="" required>
                                <label for="floatingInput">Email <sup class="text-danger fw-bold">*</sup></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="" required>
                                <label for="floatingPassword">Mật khẩu <sup class="text-danger fw-bold">*</sup></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="cf_password" id="floatingPassword" placeholder="" required>
                                <label for="floatingPassword">Xác nhận mật khẩu <sup class="text-danger fw-bold">*</sup></label>
                            </div>
                            <div class="d-flex justify-content-end">
                                <p class="description text-danger">* không được để trống</p>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" name="but_register" id="" value="Đăng ký" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'?>

