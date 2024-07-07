<?php
session_start();
require 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch input values
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); // Hash the password
    $address = $_POST['address'];
    $phone = $_POST['phone'];

    // Prepare and execute the insert query
    $stmt = $pdo->prepare("INSERT INTO users (username, email, password,address,phone_number) VALUES (:username, :email, :password,:address,:phone)");
    $stmt->execute([
        ':username' => $username,
        ':email' => $email,
        ':password' => $password,
        ':address' => $address,
        ':phone'=>$phone
    ]);

    // Redirect to login page after successful sign-up
    header('Location: index.php');
    exit();
}
?>
