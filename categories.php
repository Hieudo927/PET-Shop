<?php
session_start();
include 'includes/header.php';
include 'config/connect.php';

$statement = $pdo -> prepare("SELECT * FROM categories WHERE status = '0' AND type ='1'");
$statement ->execute();
$categories = $statement ->fetchAll(PDO::FETCH_ASSOC);
?>

<style>
    a {
        color: white;
        text-decoration: none;
    }

    a:hover {

        color: dodgerblue;
    }
</style>
<div class="py-3 bg-secondary">
    <div class="container">
        <h6 class="text-white"> <a href="index.php">Home</a> / <a href="categories.php">Danh mục</a></h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h4>Chó</h4>
                <hr>
                <div class="row">
                    <?php
                    foreach ($categories as $item)
                    {
                        ?>
                            <div class="col-md-2 mb-2">
                                <a href="products.php?category_id=<?=$item['id']?>">
                                    <div class="card shadow">
                                        <div class="card-body">
                                            <img src="uploads/<?=$item['image']?>" class="w-100" alt="">
                                            <h5 class="text-center"><?= $item['name']?></h5>
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
        <h4>Mèo</h4>
        <hr>
        <div class="row">
            <?php
            $getCategoryCat = $pdo -> prepare("SELECT * FROM categories WHERE type ='2' AND status = '0'");
            $getCategoryCat -> execute();
            $result = $getCategoryCat-> fetchAll(PDO::FETCH_ASSOC);
            ?>
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
                                        <h5 class="text-center"><?= $item['name']?></h5>
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
