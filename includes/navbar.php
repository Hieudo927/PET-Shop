<?php $page = substr($_SERVER['SCRIPT_NAME'], strrpos($_SERVER['SCRIPT_NAME'],"/")+1); ?>
<nav class="navbar navbar-expand-lg navbar-dark sticky-top bg-dark shadow">
    <div class="container">
        <a class="navbar-brand" href="index.php">PET-SHOP</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'index.php'? 'active':''?>" aria-current="page" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'dog.php'? 'active':''?>" href="dog.php">Chó</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?= $page == 'cat.php'? 'active':''?>" href="cat.php">Mèo</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="categories.php">Danh mục</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="cart.php">Giỏ hàng</a>
                </li>
                <?php
                    if (isset($_SESSION['login']))
                    {?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <?= $_SESSION['user_name'] ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="my-order.php">Đơn hàng</a></li>
                        <li><a class="dropdown-item" href="profile.php">Thông tin cá nhân</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <?php
                    }
                    else
                    {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="register.php">Đăng ký</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Đăng nhập</a>
                        </li>
                        <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</nav>