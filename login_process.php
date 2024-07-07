<?php
session_start();
require 'config.php'; // Include your database connection file

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Fetch input values
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare and execute the select query
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute([':username' => $username]);
    $user = $stmt->fetch();

    // Verify credentials
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['loggedin'] = true;
        $_SESSION['username'] = $user['username'];
        // echo $_SESSION['username'];
        header('Location: Home.html'); // Redirect to a welcome page after successful login
        exit();
    } else {
        $error = "Invalid username or password";
        header("Location: index.php?error=" . urlencode($error));
        exit();
    }
}
?>
