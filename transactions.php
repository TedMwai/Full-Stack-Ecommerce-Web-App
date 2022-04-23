<?php
include './includes/session.php';

if (isset($_GET['pay'])) {
    $payment_id = $_GET['pay'];
    $date = date('Y-m-d');

    $conn = $pdo->connect();

    var_dump($user);

    try {

        $stmt = $conn->prepare("INSERT INTO payment (user_id, payment_id, date) VALUES (:user_id, :payment_id, :date)");
        $stmt->execute(['user_id' => $user['user_id'], 'payment_id' => $payment_id, 'date' => $date]);
        $salesid = $conn->lastInsertId();

        try {
            $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.products_id = cart.product_id WHERE user_id=:user_id");
            $stmt->execute(['user_id' => $user['user_id']]);

            foreach ($stmt as $row) {
                $stmt = $conn->prepare("INSERT INTO order_details (payment_id, product_id, quantity, size) VALUES (:payment_id, :product_id, :quantity, :size)");
                $stmt->execute(['payment_id' => $salesid, 'product_id' => $row['product_id'], 'quantity' => $row['quantity'], 'size' => $row['size']]);
            }

            $stmt = $conn->prepare("DELETE FROM cart WHERE user_id=:user_id");
            $stmt->execute(['user_id' => $user['user_id']]);

            $_SESSION['success'] = 'Transaction successful. Thank you.';
        } catch (PDOException $e) {
            $_SESSION['error'] = $e->getMessage();
        }
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
    }
}
header('location: orders.php');
