<?php
include 'includes/session.php';

$conn = $pdo->connect();
$output = '';

try {
    $stmt = $conn->prepare("SELECT * FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
    LEFT JOIN products ON products.products_id = order_details.product_id WHERE payment.date > NOW() - INTERVAL 1 WEEK 
    ORDER BY `order_details`.`quantity` DESC LIMIT 5");
    $stmt->execute();
    foreach ($stmt as $row) {
        $image = '/images/' . $row['photo'];
        $price = $row['price'];
        $name = $row['name'];
        $output .=
            "<div class='cart-product'>
            <div class='cart-product-img'>
                <img src='" . $image . "' alt='" . $name . "'>
            </div>
            <div class='cart-product-info'>
                <h3>" . $name . "</h3>
            </div>
            <div class='cart-product-price'>
                <p>" . $price . "$</p>
            </div>
        </div>
        <div class='divider-cart'></div>";
    }
} catch (PDOException $e) {
    $output .= 'Error: ' . $e->getMessage;
}

echo json_encode($output);
