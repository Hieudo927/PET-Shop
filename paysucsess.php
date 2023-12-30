<?php
include 'config/connect.php';
include 'authen.php';
include 'includes/header.php';

$user_id = $_SESSION['user_id'];

$select = $pdo -> prepare("SELECT MAX(id) AS order_id FROM orders");
$select ->execute();
$res = $select-> fetch(PDO::FETCH_ASSOC);
$order_id = $res['order_id'];
if (isset($_GET['txn_id'])){
    $pay_id = $_GET['txn_id'];
    $update = $pdo -> prepare("UPDATE `orders` SET `payment_id`='$pay_id' WHERE id ='$order_id' and user_id = '$user_id'");
    $res = $update -> execute();
//    if ($res){
//        $_SESSION['msg'] = "Đặt hàng thành công";
//        header('Location: ./my-order.php');
//        die();
//    }
}

?>

<?php
if (isset($_GET['txn_id'])){
    ?>
    <div style="margin-bottom: 200px">
        <div class="d-flex justify-content-center flex-column align-items-center" style="padding: 50px">
            <h1 class="text-success">Thanh toán thành công!</h1>

            <p>Bạn sẽ tự động chuyển hướng sau <span id="countdown">5</span> s</p>
        </div>
    </div>
<?php
}
else
{
?>
    <div style="margin-bottom: 200px">
        <div class="d-flex justify-content-center flex-column align-items-center" style="padding: 50px">
            <h1 class="text-danger">Có lỗi xảy ra</h1>
            <p>Bạn sẽ tự động chuyển hướng sau <span id="countdown">5</span> s</p>
        </div>
    </div>
<?php
}
?>

<?php include 'includes/footer.php'?>
<script>
    $(document).ready(function() {
        var count = 5; // Thời gian đếm ngược ban đầu
        var countdownDisplay = $("#countdown");

        function updateCountdown() {
            countdownDisplay.text(count);
            if (count === 0) {
                clearInterval(countdownInterval);
                // Thực hiện hành động sau khi đếm ngược kết thúc (ví dụ: reload trang)
                setTimeout(function() {
                    window.location.href = "http://localhost/test/my-order.php";
                }, 5000); // Chuyển hướng sau 5 giây
            } else {
                count--;
            }
        }
        var countdownInterval = setInterval(updateCountdown, 1000); // Cập nhật mỗi 1 giây
    });
</script>


