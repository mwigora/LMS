<?php
session_start();

// Check if the user is an admin
if ($_SESSION['user_role'] != 'admin') {
    header("Location: login.php"); // Redirect to login if not an admin
    exit();
}

// Get the data from the form
$book_title = $_POST['book_title'];
$author = $_POST['author'];
$year = $_POST['year'];
$quantity = $_POST['quantity'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "@Mwigs4134";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Insert book into the database
$sql = "INSERT INTO books (title, author, year, quantity) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssii", $book_title, $author, $year, $quantity);
$stmt->execute();

echo "Book added successfully!";
header("Location: admin_dashboard.php");
exit();

$conn->close();
?>
