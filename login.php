<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "@Mwigs4134";
$dbname = "library";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form input
    $user_username = $_POST['username'];
    $user_password = $_POST['password'];

    // Check if it's an admin login (Hardcoded for simplicity)
    if ($user_username == 'admin' && $user_password == 'adminpassword') {
        // If it’s the admin, create an admin session
        $_SESSION['user_role'] = 'admin';
        $_SESSION['username'] = $user_username;  // Save admin username to session
        header("Location: admin_dashboard.php"); // Redirect to admin dashboard
        exit();
    }

    // For regular users, check the database using prepared statements and password verification
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $user_username);  // Bind the username parameter
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // Verify password using password_verify
        if (password_verify($user_password, $user['password'])) {
            // User found, set session variables
            $_SESSION['user_role'] = 'user';
            $_SESSION['username'] = $user_username;
            header("Location: user_dashboard.php"); // Redirect to user dashboard
            exit();
        } else {
            echo "Invalid login credentials.";
        }
    } else {
        echo "Invalid login credentials.";
    }
}

$conn->close();
?>
