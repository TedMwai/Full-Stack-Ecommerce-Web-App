<?php include './includes/session.php' ?>
<?php
$pdo = new Database();
$conn = $pdo->connect();
$productSlug = $_GET['product'];

try {
    $stmt  = $conn->prepare("SELECT products_id,name,price,description,image, category_id FROM jumpman.products
    LEFT JOIN product_image ON products.product_slug = product_image.product_slug
    WHERE products.product_slug = :productSlug");
    $stmt->execute(['productSlug' => $productSlug]);
    $product = $stmt->fetch();
    $productTwo = $stmt->fetchAll();
    $imageOne = $productTwo[0]['image'];
    $imageTwo = $productTwo[1]['image'];
    $imageThree = $productTwo[2]['image'];
    $imageFour = $product["image"];
} catch (PDOException $e) {
    echo "There is some problem in connection: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="./css/product.css">
    <title>Product</title>
</head>

<body>
    <?php include './includes/header.php' ?>
    <section class="product">
        <div class="product-container">
            <div class="product-container-img1">
                <img src="<?php echo 'images/' . $imageThree ?>" alt="Jordan 1 Mid SE">
            </div>
            <div class="product-container-img1">
                <img src="<?php echo 'images/' . $imageTwo ?>" alt="Jordan 1 Mid SE">
            </div>
            <div class="product-container-img1">
                <img src="<?php echo 'images/' . $imageOne ?>" alt="Jordan 1 Mid SE">
            </div>
            <div class="product-container-img1">
                <img src="<?php echo 'images/' . $imageFour ?>" alt="Jordan 1 Mid SE">
            </div>
        </div>
        <?php
        echo "
        <div class='product-container-info'>
            <div class='product-info-start'>
            <h3>" . $product['name'] . "</h3>
            <h4>StreetWear</h4>
            <span>" . $product['price'] . '$' . "</span>
            </div>
            <h2 class='before-sizes'>Select Size</h2>
            <div class='sizes'>
              <button class='size-popular'>37</button>
              <button class='size-popular'>38</button>
              <button class='size-popular'>39</button>
              <button class='size-popular'>40</button>
              <button class='size-popular'>41</button>
              <button class='size-popular'>42</button>
              <button class='size-popular'>43</button>
              <button class='size-popular'>44</button>
              <button class='size-popular'>45</button>
            </div>
            <div class='dropdown_input'>
            <label>Quantity</label>
            <select name='quantity' id='quantity'>
            <option value='1'>1</option>
            <option value='2'>2</option>
            <option value='3'>3</option>
            <option value='4'>4</option>
            <option value='5'>5</option>
            <option value='6'>6</option>
            <option value='7'>7</option>
            <option value='8'>8</option>
            <option value='9'>9</option>
            <option value='10'>10</option>
            </select>
            </div>
            <div class='final-buttons'>
              <button class='bag-btn' type='submit'>Add to Bag</button>
              <button class='heart-btn' type='submit'>
                Favourite
                <i class='far fa-heart'></i>
              </button>
            </div>
            <div class='shoe-description'>
                <p>" . $product['description'] . "</p>
            </div>
            <input type='hidden' value=" . $product['products_id'] . " name='id' id='hiddenValue'>
            <div style='display: none' id='productId'>" . $product['products_id'] . "</div>
        </div>
        "
        ?>
    </section>
    <div class="copy-container">
        <div class="copy-popup">
            <h3>Added To Favourite</h3>
            <!-- <h4 style="color : red;">&#10084;</h4> -->
        </div>
    </div>
    <h3 style="margin-top: 2rem; font-size: 1.5rem">You might also like</h3>
    <section class="similar-container">
        <?php
        try {
            $stmt = $conn->prepare("SELECT * FROM jumpman.products WHERE category_id <> :category_id ORDER BY RAND() LIMIT 6");
            $stmt->execute(['category_id' => $product['category_id']]);
            foreach ($stmt as $row) {
                $image = 'images/' . $row['photo'];
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
        ?>
    </section>
    <?php include 'includes/footer.php' ?>
    <script src="https://unpkg.com/boxicons@2.1.2/dist/boxicons.js"></script>
    <script src="./js/products.js" defer type="module"></script>
</body>

</html>