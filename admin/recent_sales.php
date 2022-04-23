<?php
include 'includes/session.php';

$conn = $pdo->connect();
$output = '';

try {
    $stmt = $conn->prepare("SELECT payment.payment_id, payment.date, first_name, last_name, quantity, price FROM payment 
    LEFT JOIN USER ON USER.user_id = payment.user_id LEFT JOIN order_details ON order_details.payment_id = payment.id 
    LEFT JOIN products ON products.products_id = order_details.product_id ORDER BY DATE DESC LIMIT 10");
    $stmt->execute();
    foreach ($stmt as $row) {
        $total = 0;
        $total = $row['price'] * $row['quantity'];
        $output .=
            "<tr>
            <td>" . $row['date'] . "</td>
            <td>" . $row['first_name'] . " ".$row['last_name']."</td>
            <td>" . $row['payment_id'] . "</td>
            <td>" . $total . "$</td>
            </tr>"
            ;
    }
} catch (PDOException $e) {
    $output .= 'Error: ' . $e->getMessage;
}

echo json_encode($output);
