<?php
session_start();
include "../config/connect.php";

if(isset($_SESSION['login']))
{
    if (isset($_POST['placeOrderBtn']))
    {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $pincode = $_POST['pincode'];
        $address = $_POST['address'];
//        $total_price = $_POST['totalPrice'];
        $payment_mode = $_POST['payment_mode'];
        $payment_id = $_POST['payment_id'];
        if($name == "" || $email == "" || $phone == "" || $pincode == "" || $address == ""){
            $_SESSION['msg'] = "Bạn chưa điền đủ thông tin";
            header('Location: ../checkout.php');
            exit(0);
        }
        $tracking_no = "DH".rand(1111,9999).substr($phone,2);
        $user_id = $_SESSION['user_id'];

        $getCart = "SELECT c.id as cid, c.product_id, c.product_qty, p.id as pid, p.name, p.image,p.selling_price
            FROM carts c, products p
            WHERE c.product_id = p.id AND c.user_id = '$user_id'
            ORDER BY c.id DESC";
        $statement = $pdo ->prepare($getCart);
        $statement -> execute();
        $carts = $statement-> fetchAll(PDO::FETCH_ASSOC);

        $total_price = 0;
        foreach ($carts as $item){
            $total_price += $item['selling_price']*$item['product_qty'];
        }

        $statement =$pdo ->prepare("INSERT INTO `orders`(`tracking_no`, `user_id`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `payment_mode`, `payment_id`) 
        VALUES ('$tracking_no','$user_id','$name','$email','$phone','$address','$pincode','$total_price','$payment_mode','$payment_id')");
        $result = $statement->execute();
        if ($result){
            $order_id = $pdo -> lastInsertId();
            foreach ($carts as $item){
                $product_id = $item['product_id'];
                $product_qty = $item['product_qty'];
                $price = $item['selling_price'];

                $insert_order_items = $pdo -> prepare("INSERT INTO `order_items`(`order_id`, `product_id`, `qty`, `price`) VALUES ('$order_id','$product_id','$product_qty','$price')");
                $insert_order_items ->execute();

                $product_query = $pdo -> prepare("SELECT quantity FROM products WHERE id = '$product_id' LIMIT 1");
                $product_query -> execute();
                $product = $product_query -> fetch(PDO::FETCH_ASSOC);
                $currentQty = $product['quantity'];
                $newQty = $currentQty - $product_qty;

                $updateQty = $pdo -> prepare("UPDATE products SET quantity = '$newQty' WHERE id ='$product_id'");
                $updateQty -> execute();

            }

            $delete_cart = $pdo->prepare("DELETE FROM carts WHERE user_id ='$user_id'");
            $delete_cart -> execute();
            $_SESSION['msg'] = "Đặt hàng thành công";
            header('Location: ../my-order.php');
            die();
        }
    }
}else
{
    header('Location: ../index.php');
}
?>
