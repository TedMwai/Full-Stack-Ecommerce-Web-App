<?php include '../includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <script src="https://www.paypal.com/sdk/js?client-id=AREluXSp0qjZ3pjYx2c2sEAtUd6E3kxjF8XBOAGvGZ1c2e9KgoREHQHyIf6SV9k7wUQJ7yOkeKk0QUw1&currency=USD"></script>
    <link rel="stylesheet" href="../css/cart_view.css">
    <title>Jumpman</title>
</head>

<body>
    <?php include '../includes/header.php' ?>
    <section class="container">
        <div class="container-cart">
            <div class="cart-item-details" id="cart-container">
            </div>
            <div class="summary">
                <h2>Order Summary</h2>
                <span>
                    <p>Subtotal</p>
                    <div id="subtotal-price">0$</div>
                </span>
                <span>
                    <p>Shipping</p>
                    <p>Free</p>
                </span>
                <span class="span-total">
                    <h1>Total</h1>
                    <div id="total-price">0$</div>
                </span>
                <div id="paypal-button-container"></div>
                <script>

                </script>
            </div>
        </div>
    </section>

    <h1>Favourites</h1>
    <section class="favourite-products">
    </section>
    <h3 style="margin-top: 2rem; font-size: 1.5rem">You might also like</h3>
    <section class="similar-container">
        <?php
        $conn = $pdo->connect();
        if (isset($_SESSION['user'])) {
            $stmt = $conn->prepare("SELECT product_id FROM cart LEFT JOIN products ON products.products_id = cart.product_id WHERE user_id =:user_id");
            $stmt->execute(['user_id' => $_SESSION['user']]);
            $row = $stmt->fetchAll();
            if (!empty($row)) {
                $stmtTwo = $conn->prepare("SELECT * FROM jumpman.products WHERE products_id <> :products_id ORDER BY RAND() LIMIT 6");
                $stmtTwo->execute(['products_id' => $row['0']['product_id']]);
                foreach ($stmtTwo as $rowTwo) {
                    $image = '../images/' . $rowTwo['photo'];
                    echo "
                    <div class='similar-card'>
                        <div class='similar-card-image'>
                            <img src='" . $image . "' alt='" . $rowTwo['name'] . "'/>
                        </div>
                        <div class='similar-card-content'>
                            <h4><a href='../products.php?product=" . $rowTwo['product_slug'] . "'>" . $rowTwo['name'] . "</a></h4>
                            <span>" . $rowTwo['price'] . '$' . "</span>
                        </div>
                    </div>
                    ";
                }
            } else {
                $stmt = $conn->prepare("SELECT * FROM jumpman.products ORDER BY RAND() LIMIT 6");
                $stmt->execute();
                foreach ($stmt as $row) {
                    $image = '../images/' . $row['photo'];
                    echo "
                    <div class='similar-card'>
                        <div class='similar-card-image'>
                            <img src='" . $image . "' alt='" . $row['name'] . "'/>
                        </div>
                        <div class='similar-card-content'>
                            <h4><a href='../products.php?product=" . $row['product_slug'] . "'>" . $row['name'] . "</a></h4>
                            <span>" . $row['price'] . '$' . "</span>
                        </div>
                    </div>
                    ";
                }
            }
        } else {
            try {
                $stmt = $conn->prepare("SELECT * FROM jumpman.products ORDER BY RAND() LIMIT 6");
                $stmt->execute();
                foreach ($stmt as $row) {
                    $image = '../images/' . $row['photo'];
                    echo "
                    <div class='similar-card'>
                        <div class='similar-card-image'>
                            <img src='" . $image . "' alt='" . $row['name'] . "'/>
                        </div>
                        <div class='similar-card-content'>
                            <h4><a href='products.php?product=" . $row['product_slug'] . "'>" . $row['name'] . "</a></h4>
                            <span>" . $row['price'] . '$' . "</span>
                        </div>
                    </div>
                ";
                }
            } catch (PDOException $e) {
                echo "There is some problem in connection: " . $e->getMessage();
            }
        }
        ?>
    </section>
    <!-- Footer Section -->
    <?php include '../includes/footer.php' ?>
    <script src="../js/cart_view.js"></script>
    <script src="../js/checkout.js" type="module"></script>
</body>

</html>