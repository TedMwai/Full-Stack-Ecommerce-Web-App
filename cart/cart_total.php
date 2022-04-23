<?php
include '../includes/session.php';

if (isset($_SESSION['user'])) {
    $conn = $pdo->connect();

    $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products on products.products_id = cart.product_id 
    WHERE user_id=:user_id");
    $stmt->execute(['user_id' => $user['user_id']]);

    $total = 0;
    foreach ($stmt as $row) {
    $subtotal = $row['price'] * $row['quantity'];
    $total += $subtotal;
    }

    echo json_encode($total);
}
else {
    $total = 0;
    echo json_encode($total);
} 
