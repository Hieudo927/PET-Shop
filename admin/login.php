<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <title>Admin Login</title>
</head>
<body class="bg-success-subtle">
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
                        <h4 class="text-center">Đăng nhập</h4>
                    </div>
                    <div class="card-body">
                        <form action="../function/func_login.php" method="post">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="floatingInput" name="email" placeholder="" required>
                                <label for="floatingInput">Email <sup class="text-danger fw-bold">*</sup></label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" name="password" id="floatingPassword" placeholder="" required>
                                <label for="floatingPassword">Mật khẩu <sup class="text-danger fw-bold">*</sup></label>
                            </div>
                            <div class="d-flex justify-content-center">
                                <input type="submit" name="btn_login2" id="" value="Đăng nhập" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
