<?php include 'includes/session.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/home.css" />
    <link rel="stylesheet" href="/css/products_data.css">
    <link rel="stylesheet" href="/css/order.css">
    <title>Product Data</title>
</head>

<body>
    <!-- SIDEBAR -->
    <section id="sidebar">
        <a href="#" class="brand"><img src="/images/jumpman_logo.svg" alt="" /></a>
        <ul class="side-menu">
            <li>
                <a href="home.php" class="active"><i class="bx bxs-dashboard icon"></i> Dashboard</a>
            </li>
            <li class="divider" data-text="main">Main</li>
            <li>
                <a href="#"><i class="bx bxs-user icon"></i> Users</a>
            </li>
            <li>
                <a href="/admin/products_data.php"><i class="bx bx-shopping-bag icon"></i> Products</a>
            </li>
        </ul>
    </section>
    <section id="content">
        <nav>
            <i class="bx bx-menu toggle-sidebar" style="font-size: 1.5rem"></i>
            <h1 style="font-size: 2rem">MR. CARTER</h1>
            <div class="profile">
                <img src="/images/user_icon.svg" alt="" />
                <ul class="profile-link">
                    <li>
                        <a href="#"><i class="bx bxs-user-circle"></i> Profile</a>
                    </li>
                    <li>
                        <a href="#"><i class="bx bxs-cog"></i> Settings</a>
                    </li>
                    <li>
                        <a href="/logout.php"><i class="bx bxs-log-out-circle"></i> Logout</a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- MAIN -->
        <main>
            <h1 class="title">Dashboard</h1>
            <ul class="breadcrumbs">
                <li><a href="home.php">Home</a></li>
                <li class="divider">/</li>
                <li><a href="home.php" class="active">Dashboard</a></li>
            </ul>
            <?php
            $conn = $pdo->connect();
            $output = '';

            try {
                $stmt = $conn->prepare("SELECT *, products.name AS product_name, category.name AS category_name, category.description FROM products LEFT JOIN category ON category.category_id = products.category_id ORDER BY category.category_id");
                $stmt->execute();

                foreach ($stmt->fetchAll() as $row) {
                    $image = '/images/' . $row['photo'];
                    $name = $row['product_name'];
                    $categoryName = $row['category_name'];
                    $description = $row['description'];
                    $date = $row['created_at'];
                    $price = $row['price'];
                    $total = $row['price'];

                    echo "
                    <div class='order-item-details' style='background: white; margin:1% 10%; padding: 2%; border: 1px solid #grey; border-radius: 15px;'>
                        <div class='order-product'>
                            <div class='order-product-img'>
                                <img src='" . $image . "' alt='" . $name . "'>
                            </div>
                            <div class='order-product-info'>
                                <h3>" . $name . "</h3>
                                <p>Category : " . $categoryName . "</p>
                                <p>Slogan: " . $description . "</p>
                            </div>
                            <div class='order-product-id'>
                                <p>Price : " . $price . "$</p>
                                <p class='date'>Date Created: " . $date . "</p>
                            </div>
                        </div>
                    <div class='divider-order'></div>
                    </div>
                        ";
                }
            } catch (PDOException $e) {
                echo 'Error' . $e->getMessage();
            }
            ?>
        </main>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/home.js" type="module"></script>
</body>

</html>