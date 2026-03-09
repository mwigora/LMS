<?php
session_start();

// Redirect to login if the user is not logged in or doesn't have the correct role
if ($_SESSION['user_role'] != 'user') {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>!</h1>
    <p>Here you can view and borrow books.</p>

    <!-- User functions -->
    <button onclick="location.href='view_books.php'">View Available Books</button>
    <a href="logout.php">Logout</a>
</body>
</html>
