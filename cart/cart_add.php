<?php
include '../includes/session.php';

$conn = $pdo->connect();

$output = array('error' => false);

$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

$now = date('Y-m-d');

$id = $object['id'];
$quantity = $object['quantity'];
$size = $object['shoeSize'];

if (isset($_SESSION['user'])) {
    $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM cart WHERE 
    user_id=:user_id AND product_id=:product_id");
    $stmt->execute(['user_id' => $user['user_id'], 'product_id' => $id]);
    $row = $stmt->fetch();

    if ($row['numrows'] < 1) {
        try {
            $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, size, quantity, created_at)
            VALUES (:user_id, :product_id, :size, :quantity, :created_at)");
            $stmt->execute(['user_id' => $user['user_id'], 'product_id' => $id, 'size'=>$size, 'quantity' => $quantity, 'created_at' => $now]);
            $output['message'] = 'Item added to bag';
        } catch (PDOException $e) {
            $output['error'] = true;
            $output['message'] = $e->getMessage();
        }
    } else {
        $output['error'] = true;
        $output['message'] = 'Product already in bag';
    }
} else {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = array();
    }

    $exist = array();

    foreach ($_SESSION['cart'] as $row) {
        array_push($exist, $row['productid']);
    }

    if (in_array($id, $exist)) {
        $output['error'] = true;
        $output['message'] = 'Product already in cart';
    } else {
        $data['productid'] = $id;
        $data['quantity'] = $quantity;
        $data['size'] = $size;

        if (array_push($_SESSION['cart'], $data)) {
            $output['message'] = 'Item added to cart';
        } else {
            $output['error'] = true;
            $output['message'] = 'Cannot add item to cart';
        }
    }
}

echo json_encode($output);
