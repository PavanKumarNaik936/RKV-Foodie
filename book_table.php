<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Foodie";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $number_of_people = $_POST['number_of_people'];

    // Check for available tables
    $stmt = $conn->prepare("SELECT COUNT(*) AS count FROM TableBookings WHERE date = ? AND time = ?");
    $stmt->bind_param("ss", $date, $time);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if ($row['count'] < 3) {
        // Find next available table number
        $stmt = $conn->prepare("SELECT table_number FROM TableBookings WHERE date = ? AND time = ?");
        $stmt->bind_param("ss", $date, $time);
        $stmt->execute();
        $result = $stmt->get_result();
        $bookedTables = [];
        while ($row = $result->fetch_assoc()) {
            $bookedTables[] = $row['table_number'];
        }

        $tableNumber = null;
        for ($i = 1; $i <= 3; $i++) {
            if (!in_array($i, $bookedTables)) {
                $tableNumber = $i;
                break;
            }
        }

        // Insert booking into database
        $stmt = $conn->prepare("INSERT INTO TableBookings (name, email, phone, date, time, number_of_people, table_number) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssis", $name, $email, $phone, $date, $time, $number_of_people, $tableNumber);
        if ($stmt->execute()) {
            echo '<h4 style="text-align:center;color:green;font-size:40px;">Table booked successfully!</h4>';
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo '<h4 style="text-align:center;color:red;font-size:40px;">Sorry! No tables available for the selected time. <br> Please try again at different timeslot...</h4>';
    }
}

$conn->close();
?>
