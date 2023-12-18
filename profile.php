<?php

include 'config/connect.php';
include 'authen.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];

$statement = $pdo ->prepare("SELECT * FROM users WHERE id = '$user_id'");
$statement -> execute();
$user = $statement-> fetch(PDO::FETCH_ASSOC);
?>
<div class="py-3 bg-secondary">
    <div class="container">
        <h6 class="text-white"> <a href="index.php" class="text-white text-decoration-none">Home</a> / <a class="text-white text-decoration-none" href="profile.php">Thông tin cá nhân</a></h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                    <div class="col-md-12 d-flex justify-content-center">
                        <div class="card w-75">
                            <div class="card-header">
                                <h4 class="text-center">Thông tin cá nhân</h4>
                            </div>
                            <div class="card-body">
                                <form action="function/saveProfile.php" method="post">
                                    <input type="hidden" name="id" value="<?=$user_id?>">
                                    <div class="d-flex me-3">
                                        <div class="col-7 form-floating mb-3 me-3">
                                            <input type="text" class="form-control" id="name" name="name" placeholder="" value="<?=$user['name']?>" required>
                                            <label for="name">Họ tên <sup class="text-danger fw-bold">*</sup></label>
                                        </div>
                                        <div class="col-5 form-floating mb-3">
                                            <input type="text" class="form-control" id="birthday" name="birthday" value="<?=$user['birthday']?>" placeholder="01/01/2000" required>
                                            <label for="birthday">Ngày sinh <sup class="text-danger fw-bold">*</sup></label>
                                        </div>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="birthday" name="phone" value="<?=$user['phone']?>" placeholder="01/01/2000" required>
                                        <label for="birthday">Số điện thoại <sup class="text-danger fw-bold">*</sup></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" id="birthday" name="gender" value="<?=$user['gender']?>" placeholder="01/01/2000" required>
                                        <label for="birthday">Giới tính <sup class="text-danger fw-bold">*</sup></label>
                                    </div>
                                    <div class="form-floating mb-3">
                                        <input type="text" class="form-control" name="address" id="address" placeholder="" value="<?=$user['address']?>" required>
                                        <label for="address">Địa chỉ <sup class="text-danger fw-bold">*</sup></label>
                                    </div>
                                    <div class=" mb-3">
                                        <label class="">Email (không đc sửa)</label>
                                        <div class="border p-1">
                                            <?=$user['email']?>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <input type="submit" name="but_saveProfile" id="" value="Lưu" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'?>
