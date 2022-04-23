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
    $stmt = $conn->prepare('SELECT *, COUNT(*) AS numrows FROM wishlist WHERE
    user_id=:user_id AND product_id=:product_id');
    $stmt->execute(['user_id' => $user['user_id'], 'product_id' => $id]);
    $row = $stmt->fetch();

    if ($row['numrows'] < 1) {
        try {
            $stmt = $conn->prepare("INSERT INTO wishlist (product_id, user_id, size, quantity, created_at)
            VALUES (:product_id, :user_id, :size, :quantity, :created_at)");
            $stmt->execute(['product_id' => $id, 'user_id' => $user['user_id'], 'size' => $size, 'quantity' => $quantity, 'created_at' => $now]);
            $output['message'] = 'Item added to Favourites';
        } catch (PDOException $e) {
            $output['error'] = true;
            $output['message'] = $e->getMessage();
        }
    } else {
        $output['error'] = true;
        $output['message'] = 'Product already in Favourites';
    }
} else {
    if (!isset($_SESSION['wishlist'])) {
        $_SESSION['wishlist'] = array();
    }
    $exist = array();

    foreach ($_SESSION['wishlist'] as $row) {
        array_push($exist, $row['productid']);
    }
    if (in_array($id, $exist)) {
        $output['error'] = true;
        $output['message'] = 'Product already in Wishlist';
    } else {
        $data['productid'] = $id;

        if (array_push($_SESSION['cart'], $data)) {
            $output['message'] = 'Product added to wishlist';
        } else {
            $output['error'] = true;
            $output['message'] = 'Cannot add product to wishlist';
        }
    }
}

echo json_encode($output);
