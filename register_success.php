<?php
session_start();
if (!isset($_SESSION['registered_user'])) {
    header("Location: register.php");
    exit();
}
$username = $_SESSION['registered_user'];
unset($_SESSION['registered_user']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Registration Successful</title>
    <meta charset="utf-8">
    <link href="login.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Dancing+Script&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <img src="resources/logo1.png" alt="Sweet Filipinas Logo" class="logo">
        <h2 style="color:#6ed37a;text-shadow:0 2px 8px #6e37b2;">Congratulations!</h2>
        <div class="subtitle" style="color:#6ed37a;">
            Congratulations <b><?php echo htmlspecialchars($username); ?></b>, you are registered!<br>Your account has been created.
        </div>
        <a href="login.php" class="btn" style="margin-top:20px;">OK</a>
    </div>
</body>
</html>