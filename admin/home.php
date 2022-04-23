<?php include 'includes/session.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/home.css" />
    <title>AdminSite</title>
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
    <!-- NAVBAR -->
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
            <div class="info-data">
                <div class="card">
                    <div class="head">
                        <div>
                            <?php
                            $conn = $pdo->connect();
                            $total = 0;
                            try {
                                $stmt = $conn->prepare("SELECT quantity, price FROM order_details LEFT JOIN products ON order_details.product_id = products.products_id WHERE order_details.product_id = products.products_id");
                                $stmt->execute();
                                foreach ($stmt as $row) {
                                    $subtotal = $row['quantity'] * $row['price'];
                                    $total += $subtotal;
                                }
                                echo "
                                <h2>" . $total . "$</h2>
                                <p>Total Sales</p>
                                ";
                            } catch (PDOException $e) {
                                echo "error : " . $e->getMessage();
                            }
                            ?>
                        </div>
                        <i class="bx bxs-dollar-circle" style="font-size: 5rem"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="head">
                        <div>
                            <?php
                            $conn = $pdo->connect();
                            $total = 0;
                            $now = date('Y-m-d');
                            $yesterday = date('d.m.Y', strtotime("-1 days"));
                            try {
                                $stmt = $conn->prepare("SELECT quantity, price, date FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id
                                                        LEFT JOIN products ON order_details.product_id = products.products_id WHERE order_details.product_id = products.products_id");
                                $stmt->execute();
                                foreach ($stmt as $row) {
                                    if ($row['date'] === $now) {
                                        $subtotal = $row['quantity'] * $row['price'];
                                        $total += $subtotal;
                                    }
                                }
                                $stmt2 = $conn->prepare("SELECT quantity, price, price * quantity AS total FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
                                                        LEFT JOIN products ON products.products_id = order_details.product_id WHERE DATE(DATE) = CURDATE() -1");
                                $stmt2->execute();
                                $totalYesterday = 0;
                                foreach ($stmt2 as $row2) {
                                    $totalYesterday += $row2['total'];
                                }
                                $profit = $total - $totalYesterday;
                                $value = ($profit / 1) * 100;
                                if($value < 0) {
                                    $value = -$value;
                                }
                                echo "
                                <h2>" . $total . "$</h2>
                                <p>Sales Today</p>
                                </div>
                                ";
                                if ($total > $totalYesterday) {
                                    echo "
                                    <i class='bx bx-trending-up icon' style='font-size: 5rem'></i>
                                    </div>
                                    <span class='progress' data-value='" . $value . "%'></span>
                                    <span class='label'>" . $value . "%</span>
                                    </div>
                                    ";
                                } else {
                                    echo "
                                    <i class='bx bx-trending-down icon down' style='font-size: 5rem'></i>
                                    </div>
                                    <span class='progress' data-value='" . $value . "%'></span>
                                    <span class='label'>" . $value . "%</span>
                                    </div>
                                    ";
                                }
                            } catch (PDOException $e) {
                                echo "error : " . $e->getMessage();
                            }
                            ?>
                            <div class="card">
                                <div class="head">
                                    <div>
                                        <?php
                                        $conn = $pdo->connect();
                                        $products = 0;
                                        try {
                                            $stmt = $conn->prepare("SELECT COUNT(*) FROM products");
                                            $stmt->execute();
                                            $row = $stmt->fetch();
                                            $products = $row['COUNT(*)'];
                                            echo "
                                            <h2>" . $products . "</h2>
                                            <p>Products</p>
                                            ";
                                        } catch (PDOException $e) {
                                            echo "error : " . $e->getMessage();
                                        }
                                        ?>
                                    </div>
                                    <i class="bx bx-shopping-bag" style="font-size: 5rem"></i>
                                </div>
                            </div>
                            <div class="card">
                                <div class="head">
                                    <div>
                                        <?php
                                        $conn = $pdo->connect();
                                        $users = 0;
                                        try {
                                            $stmt = $conn->prepare("SELECT COUNT(*) FROM user");
                                            $stmt->execute();
                                            $row = $stmt->fetch();
                                            $users = $row['COUNT(*)'];
                                            echo "
                                            <h2>" . $users . "</h2>
                                            <p>Users</p>
                                            ";
                                        } catch (PDOException $e) {
                                            echo "error : " . $e->getMessage();
                                        }
                                        ?>
                                    </div>
                                    <i class="bx bxs-user" style="font-size: 5rem"></i>
                                </div>
                            </div>
                        </div>
                        <div class="data">
                            <div class="content-data">
                                <div class="chart">
                                    <div id="monthly-sales"></div>
                                </div>
                            </div>
                            <div class="content-data">
                                <div class="chart">
                                    <div id="donut-chart"></div>
                                </div>
                            </div>
                            <div class="content-data">
                                <div class="chart">
                                    <div id="chart"></div>
                                </div>
                            </div>
                            <div class="content-data">
                                <div class="chart">
                                    <div id="today-chart"></div>
                                </div>
                            </div>
                        </div>
                        <h1 style="font-size : 2rem; margin-bottom : -3rem; margin-top:2rem;">Recent Sales</h1>
                        <div class="data">
                            <div class="sales">
                                <div class="recent-sales">
                                    <table id="records">
                                        <tr>
                                            <th>Date</th>
                                            <th>Name</th>
                                            <th>Transaction ID</th>
                                            <th>Total</th>
                                        </tr>
                                    </table>
                                </div>
                                <div class="top-product">

                                </div>
                            </div>
                        </div>
        </main>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="/js/home.js" type="module"></script>
    <script src="/js/sale_data.js"></script>
</body>

</html>