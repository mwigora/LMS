<?php
session_start();
if ($_SESSION['user_role'] != 'admin') {
    // If the user is not an admin, redirect them to login page
    header("Location: adminlogin.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/adminportal.css">
</head>
<body>
    <div class="header">
        <h1>Welcome Admin</h1>
    </div>

    <div class="admin-portal-container">
        <h3>Welcome to the Admin Dashboard</h3>
        <!-- Tabs and Content for Students, Books, etc. -->
    </div>
</body>
</html>
