<?php
// Start session
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "@Mwigs4134";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get and sanitize form input
    $name = $_POST['name'];
    $roll_number = $_POST['roll_number'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $user_password = $_POST['password'];

    // Hash the password
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);

    // Insert data into the database using prepared statements
    $sql = "INSERT INTO users (name, roll_number, dob, email, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssss", $name, $roll_number, $dob, $email, $hashed_password);

    if ($stmt->execute()) {
        echo "Registration successful. You can now log in.";
        header("Location: user_login.php"); // Redirect to login page
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>
