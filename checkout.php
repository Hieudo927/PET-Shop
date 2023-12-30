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
if (count($carts) == 0){
    header('Location: cart.php');
}
?>
<div class="py-3 bg-secondary">
    <div class="container">
        <h6 class="text-white"> <a href="index.php" class="text-white text-decoration-none">Home</a> / <a class="text-white text-decoration-none" href="checkout.php">Đặt hàng</a></h6>
    </div>
</div>

<div class="py-5">
    <div class="container">
        <div class="card shadow">
            <div class="card-body">
                <form action="function/placeorder.php" method="post">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Thông tin người nhận</h5>
                            <hr>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold ">Tên người nhân:</label>
                                    <input type="text" id="name" name="name" placeholder="Enter your full name" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold">E-mail:</label>
                                    <input type="text" id="email" name="email" placeholder="Enter your email" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold ">Số điện thoại:</label>
                                    <input type="text" id="phone" name="phone" placeholder="Enter your phone number" class="form-control">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="fw-bold ">Pin Code:</label>
                                    <input type="text" id="pincode" name="pincode" placeholder="Enter your pin code" class="form-control">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="fw-bold ">Địa chỉ:</label>
                                    <textarea name="address" id="address" class="form-control" rows="5"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h5>Chi tiết đơn hàng</h5>
                            <hr>
                            <div class="row align-items-center">
                                <div class="col-md-5">
                                    <h6>Sản phẩm</h6>
                                </div>
                                <div class="col-md-3">
                                    <h6>Đơn giá</h6>
                                </div>
                                <div class="col-md-2">
                                    <h6>Số lượng</h6>
                                </div>
                            </div>
                            <div id="myCart">
                                <?php
                                $totalPrice = 0;
                                foreach ($carts as $item)
                                {
                                    ?>
                                    <div class="card product_data shadow-sm mb-3">
                                        <div class="row align-items-center">
                                            <div class="col-md-2">
                                                <img src="uploads/<?=$item['image']?>" alt="" width="80px">
                                            </div>
                                            <div class="col-md-3">
                                                <h6><?=$item['name']?></h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6><?=$item['selling_price']?> đ</h6>
                                            </div>
                                            <div class="col-md-3">
                                                <h6>x <?=$item['product_qty']?></h6>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    $totalPrice += $item['selling_price']*$item['product_qty'];
                                }
                                ?>
                            </div>
                            <hr>
                            <h5>Tổng tiền: <span class="float-end"><?=$totalPrice?> đ</span></h5>

                            <div class="">
                                <input type="hidden" name="payment_mode" value="COD">
                                <button type="submit" name="placeOrderBtn" class="btn btn-primary w-100 mb-3 p-2">Thanh toán | COD</button>


                </form>
                                <form method="post" action="https://www.sandbox.paypal.com/cgi-bin/webscr">
                                    <input type="hidden" name="business" value="sb-jjefm28777859@business.example.com">
                                    <input type="hidden" name="item_name" value="x">
                                    <input type="hidden" name="item_number" value="x">
                                    <input type="hidden" name="amount" value="<?=$totalPrice/24000?>">
                                    <input type="hidden" name="no_shipping" value="1">
                                    <input type="hidden" name="currency_code" value="USD">
                                    <input type="hidden" name="cmd" value="_xclick">
                                    <input type="hidden" name="return" value="http://localhost/test/paysucsess.php">
                                    <input type="hidden" name="cancel_return" value="http://localhost/test/checkout.php">
                                    <button type="submit" id="paypal" class="btn btn-warning w-100 mb-3 p-2 btn-paypal" >Thanh toán | PayPal</button>
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'?>

<script>
    $(document).ready(function (){
        $('.btn-paypal').click(function (){
            var name = $('#name').val();
            var email = $('#email').val();
            var phone = $('#phone').val();
            var pincode = $('#pincode').val();
            var address = $('#address').val();
            var myButton = document.getElementById("paypal");

            // Thay đổi thuộc tính type của button
             // hoặc "reset"

            if (name == ''|| email == '' || phone == '' || pincode == '' || address == ''){
                alert("Bạn chưa điền đủ thông tin");
                myButton.type = "button";
            }
            else {

                $.ajax({
                    type:"POST",
                    url:"function/placeorder.php",
                    data:{
                        name:name,
                        email:email,
                        phone:phone,
                        pincode:pincode,
                        address:address,
                        paypal:true
                    }
                })
                myButton.type = "submit";
                setTimeout(function() {
                    location.reload();
                }, 5000);
            }
        })
    })
</script>



