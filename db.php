<?php
$host = 'localhost';
$db   = 'sweetpilipinas1';
$user = 'dessertsite';
$pass = 'dessertblog';
$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>