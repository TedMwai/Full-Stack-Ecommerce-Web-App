<?php
include 'includes/session.php';
$total = 0;
$total1 = 0;
$total2 = 0;
$total3 = 0;
$jordans = array();
$nike = array();
$adidas = array();
$puma = array();
$data = array();

$conn = $pdo->connect();

try {
    $stmt = $conn->prepare("SELECT * FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
    LEFT JOIN products ON products.products_id = order_details.product_id WHERE DATE(DATE) = CURDATE() AND category_id = 1");
    $stmt->execute();
    foreach ($stmt as $row) {
        $subtotal = $row['quantity'] * $row['price'];
        $total += $subtotal;
    }
    array_push($jordans, $total);

    $stmt2 = $conn->prepare("SELECT * FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
    LEFT JOIN products ON products.products_id = order_details.product_id WHERE DATE(DATE) = CURDATE() AND category_id = 2");
    $stmt2->execute();
    foreach ($stmt2 as $row) {
        $subtotal = $row['quantity'] * $row['price'];
        $total1 += $subtotal;
    }
    array_push($nike, $total1);

    $stmt3 = $conn->prepare("SELECT * FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
    LEFT JOIN products ON products.products_id = order_details.product_id WHERE DATE(DATE) = CURDATE() AND category_id = 3");
    $stmt3->execute();
    foreach ($stmt3 as $row) {
        $subtotal = $row['quantity'] * $row['price'];
        $total2 += $subtotal;
    }
    array_push($adidas, $total2);

    $stmt4 = $conn->prepare("SELECT * FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
    LEFT JOIN products ON products.products_id = order_details.product_id WHERE DATE(DATE) = CURDATE() AND category_id = 4");
    $stmt4->execute();
    foreach ($stmt4 as $row) {
        $subtotal = $row['quantity'] * $row['price'];
        $total3 += $subtotal;
    }
    array_push($puma, $total3);
} catch (PDOException $e) {
    echo 'Error' . $e->getMessage();
}

array_push($data, $jordans);
array_push($data, $nike);
array_push($data, $adidas);
array_push($data, $puma);

echo json_encode($data);
