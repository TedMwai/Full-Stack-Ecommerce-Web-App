<?php
include '/xampp/htdocs/jumpman-test/includes/conn.php';
session_start();

if (!isset($_SESSION['admin']) || trim($_SESSION['admin']) == '') {  
    header('location: ../index.php');
    exit();
}

$conn = $pdo->connect();

$stmt = $conn->prepare("SELECT * FROM user WHERE user_id=:id");
$stmt->execute(['id' => $_SESSION['admin']]);
$admin = $stmt->fetch();
