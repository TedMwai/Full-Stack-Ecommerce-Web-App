<?php
include '../includes/session.php';

$conn = $pdo->connect();

$requestPayload = file_get_contents("php://input");
$object = json_decode($requestPayload, true);

var_dump($object);

$output = array('error' => false);
$id = $object['id'];
$idTwo = $object['idTwo'];

if (isset($_SESSION['user'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM cart WHERE cart_id=:cart_id");
        $stmt->execute(['cart_id' => $id]);
        $output['message'] = 'Deleted';
    } catch (PDOException $e) {
        $output['message'] = $e->getMessage();
    }
} else {
    var_dump($_SESSION['cart']);
    foreach($_SESSION['cart'] as $key => $row){
        if($row['productid'] == $idTwo){
            unset($_SESSION['cart'][$key]);
            $output['message'] = 'Deleted';
        }
    }
}

echo json_encode($output);
