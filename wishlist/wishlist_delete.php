<?php
include '../includes/session.php';

$conn = $pdo->connect();

$output = array('error' => false);
$id = $_POST['id'];

if (isset($_SESSION['user'])) {
    try {
        $stmt = $conn->prepare("DELETE FROM wishlist WHERE wishlist_id=:wishlist_id");
        $stmt->execute(['wishlist_id' => $id]);
        $output['message'] = 'Deleted';
    } catch (PDOException $e) {
        $output['message'] = $e->getMessage();
    }
} else {
    var_dump($_SESSION['wishlist']);
    foreach($_SESSION['wishlist'] as $key => $row){
        if($row['productid'] == $id){
            unset($_SESSION['wishlist'][$key]);
            $output['message'] = 'Deleted';
        }
    }
}

echo json_encode($output);