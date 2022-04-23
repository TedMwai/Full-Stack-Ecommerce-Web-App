<?php
include '../includes/session.php';
$conn = $pdo->connect();

$output = '';
$now = date('Y-m-d');

if (isset($_SESSION['user'])) {
    if (isset($_SESSION['wishlist'])) {
        foreach ($_SESSION['wishlist'] as $row) {
            $stmt = $conn->prepare('SELECT *, COUNT(*) AS numrows FROM wishlist WHERE user_id=:user_id AND product_id=:product_id');
            $stmt->execute(['user_id' => $user['user_id'], 'product_id' => $row['productid']]);
            $crow = $stmt->fetch();
            if ($crow['numrows'] < 1) {
                $stmt = $conn->prepare("INSERT INTO wishlist (product_id, user_id, created_at)
            VALUES (:product_id, :user_id, :created_at)");
                $stmt->execute(['user_id' => $user['user_id'], 'product_id' => $row['productid'], 'created_at' => $now]);
            }
            unset($_SESSION['wishlist']);
        }
    }
    try {
        $stmt = $conn->prepare("SELECT * FROM wishlist LEFT JOIN products ON products.products_id = wishlist.product_id WHERE user_id=:user");
        $stmt->execute(['user' => $user['user_id']]);
        foreach ($stmt as $row) {
            $name = $row['name'];
            $image = '../images/' . $row['photo'];
            $price = $row['price'];
            $size = $row['size'];
            $quantity = $row['quantity'];
            $output .= "
            <div class='cart-product'>
                <div class='cart-product-img'>
                    <img src='" . $image . "' alt=" . $name . ">
                </div>
                <div class='cart-product-content'>
                    <h3>" . $name . "</h3>
                    <div class='more-info'>
                        <p class='size' style='font-size: 1rem;'>Size : " . $size . "</p>
                        <p class='quantity' style='font-size: 1rem;'>Quantity : " . $quantity . "</p>
                    </div>
                    <div class='buttons'>
                        <button class='btn-bag' data-id='" . $row['wishlist_id'] . "'>Add To Bag</button>
                        <button class='btn-delete' data-id='" . $row['wishlist_id'] . "'>Delete</button>
                        <input type='hidden' class='prodID' name='product-id' value='" . $row['product_id'] . "'>
                    </div>
                </div>
                <div class='cart-product-price'>
                    <p>Price : " . $price . "$</p>
                </div>
            </div>
            ";
        }
    } catch (PDOException $e) {
        $output .= $e->getMessage();
    }
} else {
    if (count($_SESSION['wishlist']) != 0) {
        foreach ($_SESSION['wishlist'] as $row) {
            $stmt = $conn->prepare("SELECT products.name, photo, price FROM products LEFT JOIN category ON category.category_id = products.category_id WHERE products.products_id=:id");
            $stmt->execute(['id' => $row['products_id']]);
            $product = $stmt->fetch();
            $name = $product['name'];
            $image = '../images/' . $row['photo'];
            $price = $product['price'];

            $output .= "
            <div class='cart-product'>
                <div class='cart-product-img'>
                    <img src='" . $image . "' alt=" . $name . ">
                </div>
                <div>
                    <h3>" . $name . "</h3>
                    <p>Men's Road Running Shoes</p>
                    <button class='btn-bag' data-id='" . $row['wishlist_id'] . "'>Add To Bag</button>
                </div>
                <div class='cart-product-price'>
                    <p>" . $price . "$</p>
                </div>
            </div>
            ";
        }
    } else {
        $output .= "
        <div style='text-align:center;'>
            <h1>Wishlist Cart Empty</h1>
        </div>
        ";
    }
}

echo json_encode($output);
