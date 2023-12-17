<?php
require 'fpdf/fpdf.php';


include 'config/connect.php';
include 'authen.php';

if (isset($_GET['t'])){
    $tracking_no = $_GET['t'];

    $user_id = $_SESSION['user_id'];

    $checkTrackingNo = $pdo -> prepare("SELECT * FROM orders WHERE tracking_no ='$tracking_no' AND user_id = '$user_id'");
    $checkTrackingNo -> execute();
    $orderData = $checkTrackingNo->fetch(PDO::FETCH_ASSOC);
    //var_dump($orderData);
    if ($orderData == ""){
        echo "<h4>Có lỗi xảy ra</h4>";
        die();
    }

    $selectOrderData = $pdo -> prepare("SELECT o.id as oid, o.tracking_no, o.user_id, oi.*,p.* 
                                    FROM orders o, order_items oi, products p
                                    WHERE o.user_id = '$user_id' AND oi.order_id = o.id AND p.id = oi.product_id
                                    AND o.tracking_no = '$tracking_no'");

    $selectOrderData -> execute();
    $result = $selectOrderData -> fetchAll(PDO::FETCH_ASSOC);
}
else{
    echo "<h4>Có lỗi xảy ra</h4>";
    die();
}

// Function to generate PDF for an order
function generateOrderPDF($orderData, $orderItems) {
    $pdf = new FPDF();
    $pdf->AddPage();

    // Set font
    $pdf->SetFont('Arial', '', 12);

    // Output order details
    $pdf->Cell(0, 10, 'Thong tin don hang '.$orderData['tracking_no'], 0, 1, 'C');
    $pdf->Ln(10);

    // Output user information
    $pdf->Cell(0, 10, 'Thong tin nguoi nhan', 0, 1, 'L');
    $pdf->Cell(0, 10, 'Ten: ' . $orderData['name'], 0, 1, 'L');
    $pdf->Cell(0, 10, 'Email: ' . $orderData['email'], 0, 1, 'L');
    $pdf->Cell(0, 10, 'SDT: ' . $orderData['phone'], 0, 1, 'L');
    $pdf->Cell(0, 10, 'Pincode: ' . $orderData['pincode'], 0, 1, 'L');
    $pdf->Cell(0, 10, 'Dia chi: ' . $orderData['address'], 0, 1, 'L');
    $pdf->Ln(10);

    // Output order items
    $pdf->Cell(0, 10, 'Sản pham', 0, 1, 'L');
    $pdf->Ln(5);

    foreach ($orderItems as $item) {
        $pdf->Cell(0, 10, 'Ten: ' . $item['name'], 0, 1, 'L');
        $pdf->Cell(0, 10, 'Gia: ' . $item['price'] . ' d', 0, 1, 'L');
        $pdf->Cell(0, 10, 'So luong: ' . $item['qty'], 0, 1, 'L');
        $pdf->Ln(5);
    }

    // Output total price
    $pdf->Cell(0, 10, 'Tong tien: ' . $orderData['total_price'] . ' vnd', 0, 1, 'L');
    $pdf->Ln(10);

    // Output payment mode
    $pdf->Cell(0, 10, 'Hinh thuc thanh toan: ' . $orderData['payment_mode'], 0, 1, 'L');

    // Output PDF to browser
    $pdf->Output('order_invoice.pdf', 'I');
}

// Retrieve order data and items (modify this based on your data retrieval)
// Assuming you have already fetched $orderData and $result (order items) as shown in your code

// Call the function to generate PDF
generateOrderPDF($orderData, $result);
?>

