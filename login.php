<?php
session_start();
$conn = new mysqli("localhost", "dessertsite", "dessertblog", "sweetpilipinas1");

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $stmt->store_result();
    if ($stmt->num_rows == 1) {
        $stmt->bind_result($id, $db_username, $hash);
        $stmt->fetch();
        if (password_verify($password, $hash)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $db_username;
            header("Location: dashboard.php");
            exit();
        } else {
            $error = "Invalid username/email or password!";
        }
    } else {
        $error = "Invalid username/email or password!";
    }
    $stmt->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="utf-8">
    <link href="login.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Dancing+Script&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-page">
        <a href="index.php" class="back-btn">
    <img src="resources/back-button.png" alt="Back" style="width:22px;vertical-align:middle;margin-right:6px;">Back
</a>
    <div class="login-container">
        <img src="resources/logo1.png" alt="Sweet Filipinas Logo" class="logo">
        <h2>Login</h2>
        <div class="subtitle">Welcome back! Please login to your account.</div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" style="color:#b96e5a;background:#ffe6b7;border:none;border-radius:8px;padding:10px 0;margin-bottom:16px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <label>Username or Email</label>
            <input type="text" name="username" placeholder="Enter your username" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            <button type="submit" class="btn">LOGIN</button>
        </form>
        <div class="register-link">
            Don't have an account? <a href="register.php">Register here</a>
        </div>
    </div>
        </div>
</body>
</html>