<?php

include 'config/connect.php';
include 'authen.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];

$getCart = "SELECT c.id as cid, c.product_id, c.product_qty, p.id as pid, p.name, p.image,p.selling_price
            FROM carts c, products p
            WHERE c.product_id = p.id AND c.user_id = '$user_id'
            ORDER BY c.id DESC";
$statement = $pdo ->prepare($getCart);
$statement -> execute();
$carts = $statement-> fetchAll(PDO::FETCH_ASSOC);
?>
<div class="py-3 bg-secondary">
    <div class="container">
        <h6 class="text-white"> <a href="index.php" class="text-white text-decoration-none">Home</a> / <a class="text-white text-decoration-none" href="cart.php">Giỏ hàng</a></h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="">
            <div class="row">
                <div class="col-md-12">
                    <div id="myCart">
                    <?php
                    if (count($carts)>0)
                    {
                        ?>

                                <div class="row align-items-center">
                                    <div class="col-md-5">
                                        <h6>Sản phẩm</h6>
                                    </div>
                                    <div class="col-md-3">
                                        <h6>Giá bán</h6>
                                    </div>
                                    <div class="col-md-2">
                                        <h6>Số lượng</h6>
                                    </div>
                                    <div class="col-md-2">
                                    </div>
                                </div>
                                <?php

                                foreach ($carts as $item)
                                {
                                    ?>
                                    <div class="card product_data shadow-sm mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="uploads/<?=$item['image']?>" alt="" width="100px">
                                            </div>
                                            <div class="col-md-3">
                                                <h6><?=$item['name']?></h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6><?=$item['selling_price']?></h6>
                                            </div>
                                            <div class="col-md-2">
                                                <input type="hidden" class="id" value="<?=$item['product_id']?>">
                                                <div class="input-group mb-3" style="width: 130px">
                                                    <button class="input-group-text btn-giam updateQty">-</button>
                                                    <input type="text" class="form-control text-center bg-white qty" value="<?=$item['product_qty']?>" disabled>
                                                    <button class="input-group-text btn-tang updateQty">+</button>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <button class="btn btn-danger btn-sm deleteItem" value="<?=$item['cid']?>">
                                                    <i class="fa fa-trash me-2"></i>
                                                    Xóa</button>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                }
                                ?>

                                <div class="float-end">
                                    <a href="checkout.php" class="btn btn-outline-primary">Tiến hành đặt hàng</a>
                                </div>

                        <?php
                    }else{
                        ?>
                        <div class="card card-body text-center">
                            <h4 class="pt-3" style="padding-bottom: 300px">Bạn chưa thêm sản phẩm nào vào giỏ hàng</h4>
                        </div>
                        <?php
                    }
                    ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php include 'includes/footer.php'?>
