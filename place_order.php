<?php
$servername = "localhost";
$username = "root";
$password = ""; // Your MySQL root password
$dbname = "Foodie";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $cart = json_decode($_POST['cart'], true);
    $order_date = date("Y-m-d H:i:s"); // Current date and time

    // Insert order details into database
    $stmt = $conn->prepare("INSERT INTO orders (email, item_name, price, quantity, order_date) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssdis", $email, $itemName, $itemPrice, $itemQuantity, $order_date);

    foreach ($cart as $item) {
        $itemName = $item['name'];
        $itemPrice = $item['price'];
        $itemQuantity = $item['quantity'];
        $stmt->execute();
    }

    $stmt->close();
    echo '<h4 style="text-align:center;color:green;font-size:40px;">Order Placed Successfully!</h4>';
}

$conn->close();
?>
