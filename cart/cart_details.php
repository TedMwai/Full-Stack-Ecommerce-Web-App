<?php
include '../includes/session.php';
$conn = $pdo->connect();

$output = '';
$now = date('Y-m-d');

if (isset($_SESSION['user'])) {
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $row) {
            $stmt = $conn->prepare("SELECT *, COUNT(*) AS numrows FROM cart WHERE user_id=:user_id AND product_id=:product_id");
            $stmt->execute(['user_id' => $user['user_id'], 'product_id' => $row['productid']]);
            $crow = $stmt->fetch();
            if ($crow['numrows'] < 1) {
                $stmt = $conn->prepare("INSERT INTO cart (user_id, product_id, size, quantity, created_at)
                VALUES (:user_id, :product_id, :size, :quantity, :created_at)");
                $stmt->execute(['user_id' => $user['user_id'], 'product_id' => $row['productid'], 'size' => $row['size'], 'quantity' => $row['quantity'], 'created_at' => $now]);
            } else {
                $stmt = $conn->prepare("UPDATE cart SET quantity=:quantity WHERE user_id=:user_id");
                $stmt->execute(['quantity' => $row['quantity'], 'user_id' => $user['user_id']]);
            }
        }
        unset($_SESSION['cart']);
    }

    try {
        $total = 0;
        $stmt = $conn->prepare("SELECT * FROM cart LEFT JOIN products ON products.products_id=cart.product_id WHERE user_id=:user");
        $stmt->execute(['user' => $user['user_id']]);
        foreach ($stmt as $row) {
            $name = $row['name'];
            $image = '../images/' . $row['photo'];
            $price = $row['price'];
            $size = $row['size'];
            $quantity = $row['quantity'];
            $subtotal = $row['price'] * $row['quantity'];
            $total += $subtotal;

            $output .= "
            <div class='cart-product'>
                <div class='cart-product-img'>
                    <img src='" . $image . "' alt='" . $name . "'>
                </div>
                <div class='cart-product-info'>
                    <h3>" . $name . "</h3>
                    <p>Men's Road Running Shoes</p>
                    <p>Size : " . $size . "</p>
                    <p class='quantity'>Quantity : " . $quantity . "</p>
                    <button class='like-btn' data-id='" . $row['cart_id'] . "' value='" . $row['product_id'] . "'><img src='../images/favourite.svg' alt='favourite'></button>
                    <button class='delete-btn' data-id='" . $row['cart_id'] . "' value='" . $row['product_id'] . "'><img src='../images/delete.svg' alt='delete'></button>
                </div>
                <div class='cart-product-price'>
                    <p>" . $price . "$</p>
                </div>
            </div>
            <div class='divider-cart'></div>
            ";
        }
    } catch (PDOException $e) {
        $output .= $e->getMessage();
    }
} else {
    if (count($_SESSION['cart']) != 0) {
        $total = 0;
        foreach ($_SESSION['cart'] as $row) {
            $x = 0;
            $stmt = $conn->prepare("SELECT products.name, photo, price, quantity FROM products LEFT JOIN cart ON cart.product_id = products.products_id WHERE products.products_id=:id");
            $stmt->execute(['id' => $row['productid']]);
            $product = $stmt->fetchAll();
            $name = $product[$x]['name'];
            $image = '../images/' . $product[$x]['photo'];
            $price = $product[$x]['price'];
            $subtotal = $product[$x]['price'] * $product[$x]['quantity'];
            $total += $subtotal;

            $output .= "
            <div class='cart-product'>
                <div class='cart-product-img'>
                    <img src='" . $image . "' alt='" . $name . "'>
                </div>
                <div>
                    <h3>" . $name . "</h3>
                    <p>Men's Road Running Shoes</p>
                    <p>Quantity : 1</p>
                    <br>
                    <button class='like-btn' value='" . $row['productid'] . "'><img src='../images/favourite.svg' alt='favourite'></button>
                    <button class='delete-btn' value='" . $row['productid'] . "'><img src='../images/delete.svg' alt='delete'></button>
                </div>
                <div class='cart-product-price'>
                    <p>" . $price . "$</p>
                </div>
            </div>
            <div class='divider-cart'></div>
            ";
            $x++;
        }
    } else {
        $output .= "
        <div style='text-align:center;'>
            <h1>Shopping Cart Empty</h1>
        </div>
        ";
    }
}

echo json_encode($output);
