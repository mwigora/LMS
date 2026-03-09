<?php
// Start session for user authentication
session_start();

// Check if the user is logged in
if (!isset($_SESSION['loggedin'])) {
    // Redirect to the login page if the user is not logged in
    header("Location: login.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/mainpage.css">
    <script src="js/mainpage.js"></script>
    <title>Library Management System</title>
</head>
<body>
    <h1 id="portal">Mwigora Group Of Schools</h1>
    <hr>

    <!-- Admin Login -->
    <div class="main_user_block" id="admin">
        <!-- User image -->
        <img src="Images/pngtree-avatar-icon-profile-icon-member-login-vector-isolated-png-image_1978396.jpg"
             alt="Admin Avatar"
             class="user_logo"
             onerror="this.src='https://via.placeholder.com/150';">
        <br>
        <!-- Button login -->
        <button class="login_button" type="button" onclick="location.href='admin_dashboard.php'">Admin Portal</button>
    </div>

    <!-- User Login -->
    <div class="main_user_block" id="user">
        <!-- User image -->
        <img src="Images/pngtree-avatar-icon-profile-icon-member-login-vector-isolated-png-image_1978396.jpg"
             alt="User Avatar"
             class="user_logo"
             onerror="this.src='https://via.placeholder.com/150';">
        <br>
        <!-- Button login -->
        <button class="login_button" type="button" onclick="location.href='user_dashboard.php'">User Portal</button>
    </div>
</body>
</html>
