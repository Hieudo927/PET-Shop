<?php
session_start();
include 'includes/header.php';
include 'config/connect.php';
$category_id = $_GET['category_id'];
$statement = $pdo -> prepare("SELECT * FROM products WHERE status = '0' and category_id = '$category_id' ");
$statement ->execute();
$products = $statement ->fetchAll(PDO::FETCH_ASSOC);

$select_category = $pdo-> prepare("SELECT name FROM categories WHERE id = '$category_id'");
$select_category->execute();
$category = $select_category ->fetch(PDO::FETCH_ASSOC);
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
        <h6 class="text-white"> <a href="index.php">Home</a> / <a href="categories.php">Danh mục</a> / <?= $category['name']?></h6>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <?php
                    foreach ($products as $item)
                    {
                        ?>
                        <div class="col-md-3 mb-2">
                            <a href="product-view.php?id=<?=$item['id']?>">
                                <div class="card shadow">
                                    <div class="card-body">
                                        <img src="uploads/<?=$item['image']?>" class="w-100" alt="">
                                        <h5 class="text-center mt-2"><?= $item['name']?></h5>
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
