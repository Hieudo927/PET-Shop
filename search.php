<?php
session_start();
include 'includes/header.php';
include 'config/connect.php';
$nameSear = $_GET['searProd'];
$statement = $pdo -> prepare("SELECT * FROM products WHERE status = '0' and name LIKE '%$nameSear%'");
$statement ->execute();
$products = $statement ->fetchAll(PDO::FETCH_ASSOC);


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
        <h4 class="text-white">Sản phẩm có chữ <?=$nameSear?></h4>
    </div>
</div>
<div class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="row">
                    <?php
                    if (count($products)>0)
                    {
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
                    }else{
                        echo "<h4 style='padding-bottom: 300px'>Không tìm thấy sản phẩm này</h4>";
                    }
                    ?>
                </div>

            </div>

        </div>
    </div>
</div>

<?php include 'includes/footer.php'?>
