<?php
session_start();
include "../config/connect.php";

if(isset($_SESSION['login']))
{
    if(isset($_POST['scope'])){
        $scope = $_POST['scope'];
        switch ($scope)
        {
            case "add":
                $product_id = $_POST['id'];
                $product_qty = $_POST['qty'];

                $user_id = $_SESSION['user_id'];
                $check_cart = "SELECT * FROM carts WHERE product_id = '$product_id' AND user_id = '$user_id'";
                $statement_check = $pdo -> prepare($check_cart);
                $statement_check -> execute();
                $check = $statement_check ->fetch(PDO::FETCH_ASSOC);
                if($check != '')
                {
                    echo 'ok';
                }
                else
                {
                    $statement = $pdo ->prepare("INSERT INTO `carts`(`user_id`, `product_id`, `product_qty`) VALUES ('$user_id','$product_id','$product_qty')");
                    $result = $statement -> execute();
                    if($result)
                    {
                        echo 201;
                    }
                    else
                    {
                        echo 500;
                    }
                }
                break;
            case "update":
                $product_id = $_POST['id'];
                $product_qty = $_POST['qty'];

                $user_id = $_SESSION['user_id'];

                $check_cart = "SELECT * FROM carts WHERE product_id = '$product_id' AND user_id = '$user_id'";
                $statement_check = $pdo -> prepare($check_cart);
                $statement_check -> execute();
                $check = $statement_check ->fetch(PDO::FETCH_ASSOC);
                if($check != '')
                {
                    $update = "UPDATE carts SET product_qty= '$product_qty' WHERE product_id='$product_id' and user_id = '$user_id'";
                    $stat_update = $pdo -> prepare($update);
                    $result = $stat_update -> execute();
                    if ($result){
                        echo 200;
                    }else{
                        echo 500;
                    }
                }
                else
                {
                    echo "Có lỗi xảy ra";
                }
                break;
            case "delete":
                $cart_id = $_POST['cart_id'];

                $user_id = $_SESSION['user_id'];

                $check_cart = "SELECT * FROM carts WHERE id = '$cart_id' AND user_id = '$user_id'";
                $statement_check = $pdo -> prepare($check_cart);
                $statement_check -> execute();
                $check = $statement_check ->fetch(PDO::FETCH_ASSOC);
                if ($check != ''){
                    $delete = "DELETE FROM carts WHERE id ='$cart_id' AND user_id = '$user_id'";
                    $stat_delete = $pdo -> prepare($delete);
                    $result = $stat_delete -> execute();

                    if ($result){
                        echo 200;
                    }
                    else{
                        echo "Có lỗi xảy ra";
                    }
                }else{
                    echo "Có lỗi xảy ra";
                }
                break;
            default:
                echo 500;
        }
    }
}
else
{
    echo 401;
}
?>