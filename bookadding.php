<?php
session_start();

// Check if admin is logged in
if ($_SESSION['user_role'] !== 'admin') {
    header("Location: adminlogin.html");
    exit();
}

// Database connection
include("db_connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $book_code = $_POST['book_code'];
    $book_name = $_POST['book_name'];
    $author1 = $_POST['author1'];
    $author2 = $_POST['author2'];
    $subject = $_POST['subject'];
    $tags = $_POST['tags'];

    // Handle file upload
    $upload_dir = "uploads/";
    $file_name = $_FILES['myfile']['name'];
    $file_tmp = $_FILES['myfile']['tmp_name'];
    $file_path = $upload_dir . basename($file_name);

    if (move_uploaded_file($file_tmp, $file_path)) {
        // Successfully uploaded the file
        $file_status = "File uploaded successfully!";
    } else {
        // If file upload fails
        $file_status = "File upload failed.";
    }

    // Prepare SQL to insert book details into the database
    $sql = "INSERT INTO books (book_code, book_name, author1, author2, subject, tags, ebook_path) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issssss", $book_code, $book_name, $author1, $author2, $subject, $tags, $file_path);

    if ($stmt->execute()) {
        echo "Book added successfully!";
    } else {
        echo "Error adding book: " . $stmt->error;
    }
}

$conn->close();
?>
