<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "@Mwigs4134";
$dbname = "library";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM books";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data for each book
    while($row = $result->fetch_assoc()) {
        echo "Title: " . $row["title"]. " - Author: " . $row["author"]. " - Published: " . $row["published_date"]. "<br>";
    }
} else {
    echo "No books found.";
}

$conn->close();
?>
