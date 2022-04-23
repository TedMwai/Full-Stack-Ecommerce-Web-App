<?php
include 'includes/session.php';
$date = array();
$jordans = array();
$nike = array();
$adidas = array();
$puma = array();
$data = array();

$conn = $pdo->connect();

try {
    $stmt = $conn->prepare("SELECT *, SUM(quantity) total FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id
    LEFT JOIN products ON products.products_id = order_details.product_id WHERE payment.date > NOW() - INTERVAL 1 WEEK AND category_id = 1 GROUP BY payment.date ORDER BY payment.date ASC");
    $stmt->execute();
    foreach ($stmt as $srow) {
        array_push($jordans, $srow['date'], $srow['total']);
    }
    $stmt2 = $conn->prepare("SELECT *, SUM(quantity) total FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id
    LEFT JOIN products ON products.products_id = order_details.product_id WHERE payment.date > NOW() - INTERVAL 1 WEEK AND category_id = 2 GROUP BY payment.date ORDER BY payment.date ASC");
    $stmt2->execute();
    foreach ($stmt2 as $srow) {
        array_push($nike, $srow['date'], $srow['total']);
    }
    $stmt3 = $conn->prepare("SELECT *, SUM(quantity) total FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id
    LEFT JOIN products ON products.products_id = order_details.product_id WHERE payment.date > NOW() - INTERVAL 1 WEEK AND category_id = 3 GROUP BY payment.date ORDER BY payment.date ASC");
    $stmt3->execute();
    foreach ($stmt3 as $srow) {
        array_push($adidas, $srow['date'], $srow['total']);
    }
    $stmt4 = $conn->prepare("SELECT *, SUM(quantity) total FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id
    LEFT JOIN products ON products.products_id = order_details.product_id WHERE payment.date > NOW() - INTERVAL 1 WEEK AND category_id = 4 GROUP BY payment.date ORDER BY payment.date ASC");
    $stmt4->execute();
    foreach ($stmt4 as $srow) {
        array_push($puma, $srow['date'], $srow['total']);
    }
} catch (PDOException $e) {
    echo 'Error' . $e->getMessage();
}
array_push($data, $jordans);
array_push($data, $nike);
array_push($data, $adidas);
array_push($data, $puma);

echo json_encode($data);
