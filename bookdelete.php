<?php
session_start();

// Check if the user is an admin
if ($_SESSION['user_role'] != 'admin') {
    header("Location: login.php");
    exit();
}

// Get the book ID from the URL
$book_id = $_GET['id'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "@Mwigs4134";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Delete the book from the database
$sql = "DELETE FROM books WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $book_id);
$stmt->execute();

echo "Book deleted successfully!";
header("Location: admin_dashboard.php");
exit();

$conn->close();
?>
