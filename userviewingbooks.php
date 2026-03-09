<?php
session_start();
if ($_SESSION['user_role'] != 'user') {
    header("Location: login.php");
    exit();
}

// Fetch books from the database
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Books</title>
</head>
<body>
    <h1>Available Books</h1>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Year</th>
            <th>Quantity</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr><td>" . $row["title"]. "</td><td>" . $row["author"]. "</td><td>" . $row["year"]. "</td><td>" . $row["quantity"]. "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No books available</td></tr>";
        }
        ?>
    </table>
</body>
</html>

<?php
$conn->close();
?>
