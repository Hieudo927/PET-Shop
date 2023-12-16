<?php
//session_start();
include '../config/connect.php';
include ('../function/redirect.php');
//add-category
if(isset($_POST['btn_add_category']))
{
    $name = $_POST['name'];
    $type = $_POST['type'];
    $title = $_POST['title'];

    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $image = $_FILES['image']['name'];

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $statement = $pdo->prepare("INSERT INTO `categories` (`name`, `type`, `image`, `meta_title`, `status`, `popular`) VALUES (?, ?, ?, ?, ?, ?)");

    // Bind parameters
    $statement->bindParam(1, $name);
    $statement->bindParam(2, $type);
    $statement->bindParam(3, $filename);
    $statement->bindParam(4, $title);
    $statement->bindParam(5, $status);
    $statement->bindParam(6, $popular);
    $result = $statement -> execute();

    if ($result)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect("category.php", "Thêm thành công");
    }else
    {
        redirect("add-category.php","Có lỗi xảy ra");
    }
}
//edit-category
else if(isset($_POST['btn_update_category']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $type = $_POST['type'];
    $title = $_POST['title'];

    $status = isset($_POST['status']) ? '1' : '0';
    $popular = isset($_POST['popular']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != ""){
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $path = "../uploads";

    $statement = $pdo -> prepare("UPDATE `categories` SET `name`='$name',`type`='$type',`image`='$update_filename',`meta_title`='$title',`status`='$status',`popular`='$popular' WHERE id = '$id'");
    $result = $statement -> execute();

    if ($result){
        if($_FILES['image']['name'] != ""){
            move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image)){
                unlink("../uploads/".$old_image);
            }
        }
        redirect("category.php","Sửa danh mục thành công");
    }


}
//delete-category
else if(isset($_POST['btn_delete_category'])){
    $category_id = $_POST['id'];

    $select_category = $pdo -> prepare("SELECT `image` FROM categories WHERE `id` = '$category_id'");
    $select_category -> execute();

    $category= $select_category->fetch(PDO::FETCH_ASSOC);
    $image = $category['image'];

    $delete_product = $pdo -> prepare("DELETE FROM categories WHERE id = '$category_id'");
    $result = $delete_product -> execute();

    if($result){
        if(file_exists("../uploads/".$image)){
            unlink("../uploads/".$image);
        }
        echo 200;
    }else
    {
        //redirect('products.php','Có lỗi xảy ra');
        echo 500;
    }
}
//add-product
else if(isset($_POST['btn_add_product'])){
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $month = $_POST['month'];
    $quantity = $_POST['quantity'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];

    $image = $_FILES['image']['name'];

    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1' : '0';

    $path = "../uploads";

    $image_ext = pathinfo($image, PATHINFO_EXTENSION);
    $filename = time().'.'.$image_ext;

    $statement = $pdo-> prepare("INSERT INTO `products`(`category_id`, `name`, `gender`, `month`, `description`, `original_price`, `selling_price`, `image`, `quantity`, `status`) VALUES (?,?,?,?,?,?,?,?,?,?)");
    $statement->bindParam(1, $category_id);
    $statement->bindParam(2, $name);
    $statement->bindParam(3, $gender);
    $statement->bindParam(4, $month);
    $statement->bindParam(5, $description);
    $statement->bindParam(6, $original_price);
    $statement->bindParam(7, $selling_price);
    $statement->bindParam(8, $filename);
    $statement->bindParam(9, $quantity);
    $statement->bindParam(10, $status);

    $result = $statement->execute();
    if ($result)
    {
        move_uploaded_file($_FILES['image']['tmp_name'], $path.'/'.$filename);
        redirect("product.php", "Thêm sản phẩm thành công");
    }else
    {
        redirect("add-product.php","Có lỗi xảy ra");
    }

}
//edit-product
else if(isset($_POST['btn_edit_product'])){
    $id = $_POST['id'];
    $category_id = $_POST['category_id'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $month = $_POST['month'];
    $quantity = $_POST['quantity'];
    $original_price = $_POST['original_price'];
    $selling_price = $_POST['selling_price'];
    $description = $_POST['description'];
    $status = isset($_POST['status']) ? '1' : '0';

    $new_image = $_FILES['image']['name'];
    $old_image = $_POST['old_image'];

    if ($new_image != ""){
        //$update_filename = $new_image;
        $image_ext = pathinfo($new_image, PATHINFO_EXTENSION);
        $update_filename = time().'.'.$image_ext;
    }
    else
    {
        $update_filename = $old_image;
    }

    $path = "../uploads";

    $statement = $pdo -> prepare("UPDATE `products` SET `category_id`='$category_id',`name`='$name',`gender`='$gender',`month`='$month',`description`='$description',`original_price`='$original_price',`selling_price`='$selling_price',`image`='$update_filename',`quantity`='$quantity',`status`='$status' WHERE `id` = '$id'");
    $result = $statement -> execute();

    if ($result){
        if($_FILES['image']['name'] != ""){
            move_uploaded_file($_FILES['image']['tmp_name'],$path.'/'.$update_filename);
            if(file_exists("../uploads/".$old_image)){
                unlink("../uploads/".$old_image);
            }
        }
        redirect("product.php","Sửa sản phẩm thành công");
    }
}
//delete-product
else if(isset($_POST['btn_delete_product'])){
    $product_id = $_POST['id'];

    $select_product = $pdo -> prepare("SELECT `image` FROM products WHERE `id` = '$product_id'");
    $select_product -> execute();

    $product= $select_product->fetch(PDO::FETCH_ASSOC);
    $image = $product['image'];

    $delete_product = $pdo -> prepare("DELETE FROM products WHERE id = '$product_id'");
    $result = $delete_product -> execute();

    if($result){
        if(file_exists("../uploads/".$image)){
            unlink("../uploads/".$image);
        }
        echo 200;
    }else
    {
        //redirect('products.php','Có lỗi xảy ra');
        echo 500;
    }
}
//update status order
else if(isset($_POST['btnUpdateOrder'])){
    $tracking_no = $_POST['tracking_no'];
    $status = $_POST['order_status'];

    $statement = $pdo -> prepare("UPDATE orders SET status = '$status' WHERE tracking_no = '$tracking_no'");
    $statement -> execute();

    redirect("orders.php", "Cập nhật thành công");
}
//delete_user
else if(isset($_POST['btn_delete_user'])){
    $user_id = $_POST['id'];
    $delete_user = $pdo -> prepare("DELETE FROM users WHERE id = '$user_id'");
    $result = $delete_user -> execute();
    if($result){
        echo 200;
    }else
    {
        //redirect('products.php','Có lỗi xảy ra');
        echo 500;
    }
}

