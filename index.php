<?php
session_start();
include 'includes/header.php';
include 'includes/slider.php';
include 'config/connect.php';

?>

<div class="py-5">
    <div class="container">
        <div class="row">
            <?php
            $getCategoryDog = $pdo -> prepare("SELECT * FROM categories WHERE popular = '1' AND type ='1' AND status = '0' LIMIT 5");
            $getCategoryDog -> execute();
            $result = $getCategoryDog-> fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="col-md-9">
                <h4 class="float-start fw-bold">Giống chó nổi bật</h4>
            </div>
            <div class="col-md-3">
                <form action="search.php" method="get">
                <div class="d-flex align-items-center">
                    <input type="text" name="searProd" placeholder="Nhập tên sp" class="w-50 mx-2 form-control">
                    <input type="submit" class="btn btn-primary" value="Tìm">
                </div>
                </form>
            </div>


            <div class="col-md-12">
                <?php if(isset($_SESSION['msg'])) { ?>
                    <div class="w-75 alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $_SESSION['msg']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['msg']);
                } ?>
                <div class="row">
                <?php
                foreach ($result as $item){
                    ?>
                    <div class="col-md-2 mb-2">
                        <a href="products.php?category_id=<?=$item['id']?>">
                            <div class="card shadow">
                                <div class="card-body">
                                    <img src="uploads/<?=$item['image']?>" class="w-100" alt="">
                                    <h4 class="text-center"><?= $item['name']?></h4>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
        <hr>
        <div class="row">
            <?php
            $getCategoryCat = $pdo -> prepare("SELECT * FROM categories WHERE popular = '1' AND type ='2' AND status = '0'");
            $getCategoryCat -> execute();
            $result = $getCategoryCat-> fetchAll(PDO::FETCH_ASSOC);
            ?>
            <h4 class="float-start fw-bold">Giống mèo nổi bật</h4>
            <div class="col-md-12">
                <?php if(isset($_SESSION['msg'])) { ?>
                    <div class="w-75 alert alert-warning alert-dismissible fade show" role="alert">
                        <?= $_SESSION['msg']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    <?php
                    unset($_SESSION['msg']);
                } ?>
                <div class="row">
                    <?php
                    foreach ($result as $item){
                        ?>
                        <div class="col-md-2 mb-2">
                            <a href="products.php?category_id=<?=$item['id']?>">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <img src="uploads/<?=$item['image']?>" class="w-100" alt="">
                                        <h4 class="text-center"><?= $item['name']?></h4>
                                    </div>
                                </div>
                            </a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'includes/footer.php'?>
