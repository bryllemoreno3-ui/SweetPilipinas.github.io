<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
if (!$is_logged_in) {
    header("Location: login.php");
    exit;
}

$conn = new mysqli("localhost", "dessertsite", "dessertblog", "sweetpilipinas1");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$user_id = $_SESSION['user_id'];
$update_success = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_type'])) {
    if ($_POST['update_type'] === 'username') {
        $new_username = $conn->real_escape_string($_POST['username']);
        $sql = "UPDATE users SET username='$new_username' WHERE id='$user_id'";
        $conn->query($sql);
        $update_success = true;
    }
    if ($_POST['update_type'] === 'email') {
        $new_email = $conn->real_escape_string($_POST['email']);
        $sql = "UPDATE users SET email='$new_email' WHERE id='$user_id'";
        $conn->query($sql);
        $update_success = true;
    }
    if ($_POST['update_type'] === 'profile_image' && isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION);
        $upload_dir = 'resources/';
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0755, true);
        }
        $filename = 'profile_' . $user_id . '_' . time() . '.' . $ext;
        $target_path = $upload_dir . $filename;
        move_uploaded_file($_FILES['profile_image']['tmp_name'], $target_path);
        $sql = "UPDATE users SET profile_image='$target_path' WHERE id='$user_id'";
        $conn->query($sql);
        $update_success = true;
    }
}

$sql = "SELECT username, email, profile_image FROM users WHERE id='$user_id'";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$conn->close();

$profile_img = (!empty($user['profile_image']) && file_exists($user['profile_image'])) ? $user['profile_image'] : 'profile.png';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - Sweet Pilipinas</title>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="profile.css">
</head>
<body>
    <header class="navbar">
        <div class="navbar-logo">
            <img src="resources/logo1.png" alt="Sweet Pilipinas Logo">
            <div class="navbar-title">
                <span class="brand-main">SWEET</span>
                <span class="brand-sub">Pilipinas</span>
            </div>
        </div>
        <nav class="navbar-links" style="display: flex; align-items: center; gap: 20px;">
            <a href="index.php">Home</a>
            <a href="top10.html">Top 10</a>
            <a href="regional.html">Regional Dessert</a>
            <a href="modern.html">Modern Twist</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
            <div class="navbar-profile-dropdown" style="margin-left: auto;">
                <button class="profile-btn">
                    <img src="<?php echo htmlspecialchars($profile_img); ?>" alt="Profile" class="profile-icon"> Profile <span class="dropdown-arrow">&#9662;</span>
                </button>
                <div class="profile-dropdown-content">
                    <a href="profile.php"><span class="dropdown-icon">&#128100;</span> Profile</a>
                    <a href="logout.php"><span class="dropdown-icon">&#128682;</span> Logout</a>
                </div>
            </div>
        </nav>
    </header>

    <div class="profile-container">
        <div class="profile-header">
            <h1>Welcome, <?php echo htmlspecialchars($user['username']); ?>!</h1>
            <p>This is your Sweet Pilipinas profile. Here you can update your username, email, and profile image.<br>
            Personalize your account and let your dessert journey shine!</p>
        </div>
        <div class="profile-avatar-wrap">
            <img src="<?php echo htmlspecialchars($profile_img); ?>" alt="Avatar" class="profile-avatar">
            <button class="edit-avatar-btn" onclick="openModal('profile_image')" title="Edit Profile Image">&#9998;</button>
        </div>
        <div class="avatar-note">
            Recommended: Square image, JPG/PNG, max 2MB. Your photo will be resized to fit perfectly.
        </div>
        <div class="profile-info-row">
            <span class="profile-label">Username:</span>
            <span class="profile-value"><?php echo htmlspecialchars($user['username']); ?></span>
            <button class="edit-btn" onclick="openModal('username')" title="Edit Username">&#9998;</button>
        </div>
        <div class="profile-info-row">
            <span class="profile-label">Email:</span>
            <span class="profile-value"><?php echo htmlspecialchars($user['email']); ?></span>
            <button class="edit-btn" onclick="openModal('email')" title="Edit Email">&#9998;</button>
        </div>
        <div class="profile-actions">
            <a href="logout.php" class="profile-action-btn logout-btn">
                <span class="logout-icon">&#128682;</span> Logout
            </a>
        </div>
        <div class="profile-footer">
            <b>Tip:</b> Keep your profile updated so we can send you the sweetest updates and dessert news!<br>
            Need help? Contact us anytime at <a href="mailto:SweetPilipinas@gmail.com" style="color:#ffe6b7;text-decoration:underline;">SweetPilipinas@gmail.com</a>
        </div>
    </div>

    <div class="modal-bg" id="editModal">
        <form class="modal-content" id="editForm" method="post" enctype="multipart/form-data">
            <input type="hidden" name="update_type" id="update_type" value="">
            <div id="modalFields"></div>
            <button type="submit" class="modal-btn">Save</button>
            <button type="button" class="modal-btn" style="background:#b96e5a;color:#fff;" onclick="closeModal()">Cancel</button>
        </form>
    </div>

    <div id="profileUpdatePopup" style="display: <?php echo $update_success ? 'flex' : 'none'; ?>;">
        <div class="modal-content">
            <h2>Profile Updated!</h2>
            <button class="modal-btn" onclick="document.getElementById('profileUpdatePopup').style.display='none'">OK</button>
        </div>
    </div>

    <script src="profile.js"></script>
</body>
</html>