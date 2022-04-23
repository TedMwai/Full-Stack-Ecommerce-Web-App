<?php
include 'includes/session.php';
$year = date('Y');
$month = date('m');
$sales = array();
$jordans = array();
$nike = array();
$adidas = array();
$puma = array();
$data = array();

$conn = $pdo->connect();

try {
    $stmt = $conn->prepare("SELECT *, SUM(quantity)total FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
            LEFT JOIN products ON products.products_id = order_details.product_id WHERE MONTH(date) =:month AND YEAR(DATE) =:year AND category_id = 1");
    $stmt->execute(['month' => $month, 'year' => $year]);
    $row = $stmt->fetch();
    array_push($jordans, $row['total']);

    $stmt2 = $conn->prepare("SELECT *, SUM(quantity)total FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
            LEFT JOIN products ON products.products_id = order_details.product_id WHERE MONTH(date) =:month AND YEAR(DATE) =:year AND category_id = 2");
    $stmt2->execute(['month' => $month, 'year' => $year]);
    $row2 = $stmt2->fetch();
    array_push($nike, $row2['total']);

    $stmt3 = $conn->prepare("SELECT *, SUM(quantity)total FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
            LEFT JOIN products ON products.products_id = order_details.product_id WHERE MONTH(date) =:month AND YEAR(DATE) =:year AND category_id = 3");
    $stmt3->execute(['month' => $month, 'year' => $year]);
    $row3 = $stmt3->fetch();
    array_push($adidas, $row3['total']);

    $stmt4 = $conn->prepare("SELECT *, SUM(quantity)total FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
            LEFT JOIN products ON products.products_id = order_details.product_id WHERE MONTH(date) =:month AND YEAR(DATE) =:year AND category_id = 4");
    $stmt4->execute(['month' => $month, 'year' => $year]);
    $row4 = $stmt4->fetch();
    array_push($puma, $row4['total']);
} catch (PDOException $e) {
    echo 'Error' . $e->getMessage();
}

array_push($data, $jordans);
array_push($data, $nike);
array_push($data, $adidas);
array_push($data, $puma);

echo json_encode($data);
