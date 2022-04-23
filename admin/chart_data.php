<?php
include 'includes/session.php';
$year = date('Y');
$months = array();
$sales = array();

$conn = $pdo->connect();

for ($m = 1; $m <= 12; $m++) {
    try {
        $stmt = $conn->prepare("SELECT * FROM order_details LEFT JOIN payment ON payment.id = order_details.payment_id 
        LEFT JOIN products ON products.products_id = order_details.product_id WHERE MONTH(date)=:month AND YEAR(date)=:year");
        $stmt->execute(['month' => $m, 'year' => $year]);
        $total = 0;
        foreach ($stmt as $srow) {
            $subtotal = $srow['price'] * $srow['quantity'];
            $total += $subtotal;
        }
        array_push($sales, round($total, 2));
    } catch (PDOException $e) {
        echo 'Error' . $e->getMessage();
    }
    $month =  date('M', mktime(0, 0, 0, $m, 1));
    array_push($months, $month);
}
$months = json_encode($months);
$sales = json_encode($sales);

// echo $months;
echo $sales;
