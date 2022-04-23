<?php
include './includes/session.php';

if (isset($_POST['signup'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $telephone = $_POST['mobile'];

    $_SESSION['firstName'] = $firstName;
    $_SESSION['lastName'] = $lastName;
    $_SESSION['email'] = $email;

    $conn = $pdo->connect();

    $now = date('Y-m-d');

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    try {
        $stmt = $conn->prepare("INSERT INTO user (email, password, first_name, last_name, telephone, created_at) VALUES (:email, :password, :first_name, :last_name, :telephone, :created_at)");
        $stmt->execute(['email'=>$email, 'password'=>$hashedPassword, 'first_name'=>$firstName, 'last_name'=>$lastName, 'telephone'=>$telephone, 'created_at'=>$now]);
        $userid = $conn->lastInsertId();
        header('location: ./index.php');
    } catch (PDOException $e) {
        $_SESSION['error'] = $e->getMessage();
        echo $e;
    }
} 
