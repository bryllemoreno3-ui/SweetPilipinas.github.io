<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <link href="login.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Dancing+Script&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <img src="resources/logo1.png" alt="Sweet Filipinas Logo" class="logo">
        <h2>Welcome!</h2>
        <div class="subtitle">
            Hello, <b><?php echo htmlspecialchars($username); ?></b>!<br>
            You are now logged in.
        </div>
        <a href="index.php" class="btn" style="margin-top:20px;">Go to Homepage</a>
    </div>
</body>
</html>