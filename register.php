<?php
session_start();
$conn = new mysqli("localhost", "dessertsite", "dessertblog", "sweetpilipinas1");

$error = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    if ($password !== $confirm) {
        $error = "Passwords do not match!";
    } else {
        // Check for duplicate username or email
        $stmt = $conn->prepare("SELECT id FROM users WHERE username=? OR email=?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $stmt->store_result();
        if ($stmt->num_rows > 0) {
            $error = "Username or email already exists!";
        } else {
            $hash = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $username, $email, $hash);
            if ($stmt->execute()) {
                $_SESSION['registered_user'] = $username;
                header("Location: register_success.php");
                exit();
            } else {
                $error = "Registration failed. Please try again.";
            }
        }
        $stmt->close();
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <meta charset="utf-8">
    <link href="login.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700|Dancing+Script&display=swap" rel="stylesheet">
</head>
<body>
    <div class="login-container">
        <img src="resources/logo1.png" alt="Sweet Filipinas Logo" class="logo">
        <h2>Register</h2>
        <div class="subtitle">Create your account below.</div>
        <?php if (!empty($error)): ?>
            <div class="alert alert-danger" style="color:#b96e5a;background:#ffe6b7;border:none;border-radius:8px;padding:10px 0;margin-bottom:16px;">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <label>Username</label>
            <input type="text" name="username" placeholder="Enter your username" required>
            <label>Email</label>
            <input type="email" name="email" placeholder="Enter your email" required>
            <label>Password</label>
            <input type="password" name="password" placeholder="Enter your password" required>
            <label>Confirm Password</label>
            <input type="password" name="confirm_password" placeholder="Confirm your password" required>
            <button type="submit" class="btn">REGISTER</button>
        </form>
        <div class="register-link">
            Have an account? <a href="login.php">Login here</a>
        </div>
    </div>
</body>
</html>