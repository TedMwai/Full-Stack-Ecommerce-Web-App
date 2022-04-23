<?php include './includes/session.php' ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="/css/search.css">
    <title>Search</title>
</head>

<body>
    <?php include './includes/header.php' ?>

    <section class="container">
        <!-- <div class="brand-container"> -->
            <?php
            $conn = $pdo->connect();

            $stmt = $conn->prepare("SELECT COUNT(*) AS numrows FROM products WHERE name LIKE :keyword");
            $stmt->execute(['keyword' => '%' . $_POST['input-search'] . '%']);
            $row = $stmt->fetch();

            if ($row['numrows'] < 1) {
                echo '<h1>No results found for <i>' . $_POST['input-search'] . '</i></h1>';
            } else {
                try {
                    $stmt = $conn->prepare('SELECT * FROM products WHERE name LIKE :keyword');
                    $stmt->execute(['keyword' => '%' . $_POST['input-search'] . '%']);
                    echo "<h1>Search Results for " . $_POST['input-search'] . "</h1>";
                    echo "<div class='brand-container'>";
                    foreach ($stmt as $row) {
                        $name = $row['name'];
                        $image = './images/' . $row['photo'];
                        $price = $row['price'];
                        echo "
                        <div class='brand-card'>
                            <div class='brand-card-image'>
                                <img src='" . $image . "' alt='" . $row['name'] . "'/>
                            </div>
                            <div class='brand-card-content'>
                                <h4><a href='products.php?product=" . $row['product_slug'] . "'>" . $row['name'] . "</a></h4>
                                <span>" . $row['price'] . '$' . "</span>
                            </div>
                        </div>
                        ";
                    }
                    echo"</div>";
                } catch (PDOException $e) {
                    echo "There is some problem in connection: " . $e->getMessage();
                }
            }
            ?>
        <!-- </div> -->
    </section>
    <?php include './includes/footer.php' ?>
    <script src="/js/search.js"></script>
</body>

</html>