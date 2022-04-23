<?php include './includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/order.css">
    <title>Orders</title>
</head>

<body>
    <?php include './includes/header.php' ?>
    <h1>Your Orders : </h1>
    <div class="order-item-details" id="order-container">
        <?php
        $conn = $pdo->connect();
        $output = '';
        try {
            $stmt = $conn->prepare("SELECT * FROM payment WHERE user_id = :user_id ORDER BY date DESC");
            $stmt->execute(['user_id' => $user['user_id']]);
            foreach ($stmt as $row) {
                $stmt2 = $conn->prepare("SELECT * FROM order_details LEFT JOIN products ON products.products_id = order_details.product_id WHERE payment_id = :id");
                $stmt2->execute(['id' => $row['id']]);
                $total = 0;
                foreach ($stmt2 as $row2) {
                    $total = 0;
                    $image = './images/' . $row2['photo'];
                    $name = $row2['name'];
                    $quantity = $row2['quantity'];
                    $transactionID = $row['payment_id'];
                    $price = $row2['price'];
                    $date = $row['date'];
                    $size = $row2['size'];
                    $subtotal = $row2['price'] * $row2['quantity'];

                    $total += $subtotal;
                    echo "
                    <div class='order-product'>
                         <div class='order-product-img'>
                             <img src='" . $image . "' alt='" . $name . "'>
                         </div>
                         <div class='order-product-info'>
                             <h3>" . $name . "</h3>
                             <p class='date'>Date : " . $date . "</p>
                             <p>Price : " . $price . "$</p>
                             <p class='quantity'>Quantity : " . $quantity . "</p>
                         </div>
                         <div class='order-product-id'>
                             <p>Transaction ID : " . $transactionID . "$</p>
                             <p>Status : Completed</p>
                             <p>Total : " . $total . "$</p>
                             <p>Size : " . $size . "</p>
                         </div>
                     </div>
                     <div class='divider-order'></div>
                    ";
                }
            }
        } catch (PDOException $e) {
            $output .= $e->getMessage();
        }
        ?>
    </div>
    <?php include './includes/footer.php' ?>
    <script src="./js/orders.js"></script>
</body>

</html>