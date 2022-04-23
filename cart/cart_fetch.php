<?php

include '../includes/session.php';
$conn = $pdo->connect();

$output = array('count' => 0);

if (isset($_SESSION['user'])) {
    try {
        $stmt = $conn->prepare("SELECT * FROM `cart` WHERE user_id =:user_id");
        $stmt->execute(['user_id' => $user['user_id']]);
        foreach ($stmt as $row) {
            $output['count']++;
        }
    } catch (PDOException $e) {
        $output['message'] = 'Error: ' . $e->getMessage();
    }
} else {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    if (empty($_SESSION['cart'])) {
        $output['count'] = 0;
    } else {
        foreach ($_SESSION['cart'] as $row) {
            $output['count']++;
        }
    }
}

echo json_encode($output);
