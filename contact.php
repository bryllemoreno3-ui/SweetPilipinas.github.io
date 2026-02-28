<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
$message_sent = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = new mysqli("localhost", "dessertsite", "dessertblog", "sweetpilipinas1");
    if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $message = $conn->real_escape_string($_POST['message']);

    $sql = "INSERT INTO contact_messages (name, email, message) VALUES ('$name', '$email', '$message')";
    $conn->query($sql);

    // Email notification
    $to = "cbrylle.moreno@gmail.com"; 
    $subject = "New Contact Message from Sweet Pilipinas";
    $body = "Name: $name\nEmail: $email\n\nMessage:\n$message";
    $headers = "From: $email\r\nReply-To: $email\r\n";
    @mail($to, $subject, $body, $headers);

    $conn->close();
    header("Location: contact.php?sent=1");
    exit;
}

if (isset($_GET['sent']) && $_GET['sent'] == '1') {
    $message_sent = true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Sweet Pilipinas</title>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="contact.css">
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
        <nav class="navbar-links">
            <a href="index.php">Home</a>
            <?php if ($is_logged_in): ?>
                <a href="top10.html">Top 10</a>
                <a href="regional.html">Regional Dessert</a>
                <a href="modern.html">Modern Twist</a>
            <?php else: ?>
                <a href="#" class="locked-link" title="Log in to unlock">Top 10</a>
                <a href="#" class="locked-link" title="Log in to unlock">Regional Dessert</a>
                <a href="#" class="locked-link" title="Log in to unlock">Modern Twist</a>
            <?php endif; ?>
            <a href="about.php">About</a>
            <a href="contact.php" class="active">Contact</a>
            <?php if ($is_logged_in): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Log-In</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="contact-hero">
        <img src="resources/star.png" class="sparkle" alt="Sparkle">
        <h1 class="contact-hero-title">Contact Us</h1>
        <p class="contact-hero-desc">
            Have a question, suggestion, or want to share your own sweet story?<br>
            We’d love to hear from you! Whether you’re a fellow foodie, a home baker, a student, or just someone with a craving for Filipino desserts, our inbox is always open.<br><br>
            Need a recipe tip? Want to feature your family’s heirloom dessert? Or maybe you just want to say hi? Reach out and let’s make the world a little sweeter—together!
        </p>
        <img src="resources/confetti.png" class="confetti confetti1" alt="Confetti">
        <img src="resources/confetti.png" class="confetti confetti2" alt="Confetti">
        <img src="resources/confetti.png" class="confetti confetti3" alt="Confetti">
    </section>

    <section class="contact-main-content">
        <div class="contact-img-wrap">
            <img src="resources/contactsillustration.png" alt="Contact Illustration" class="contact-img">
        </div>
        <div class="contact-form-wrap">
            <div class="contact-form-title">Send us a message</div>
            <form class="contact-form" id="contactForm" autocomplete="off" method="post">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
                <label for="message">Message</label>
                <textarea id="message" name="message" required></textarea>
                <button type="submit" class="contact-form-btn">Send Message</button>
            </form>
            <div id="messageSentPopup" style="display:none;">
                <div class="popup-card">
                    <img src="resources/star.png" alt="Sparkle" class="popup-sparkle" />
                    <h2>Message Sent!</h2>
                    <p>Thank you for reaching out. We will get back to you soon.</p>
                    <button class="popup-btn" onclick="document.getElementById('messageSentPopup').style.display='none'">OK</button>
                </div>
            </div>
            <div class="contact-details">
                <p><b>Email:</b> <a href="mailto:cbrylle.moreno@gmail.com">SweetPilipinas@gmail.com</a> <span title="We reply within 24 hours!">📧</span></p>
                <p><b>Phone:</b> <a href="tel:+639162546571">+63 916 254 6571</a> <span title="Text or call us anytime!">📱</span></p>
                <p><b>Address:</b> Lucena City, Philippines <span title="Visit us for a real kakanin experience!">📍</span></p>
                <p style="margin-top:10px; color:#fbe1d5;">
                    Follow us on social media for daily dessert inspiration, behind-the-scenes stories, and community shoutouts!
                </p>
            </div>
            <div class="contact-socials">
                <a href="https://facebook.com" target="_blank"><img src="resources/fb.png" alt="Facebook"></a>
                <a href="https://instagram.com" target="_blank"><img src="resources/insta.png" alt="Instagram"></a>
                <a href="https://twitter.com" target="_blank"><img src="resources/tw.png" alt="Twitter"></a>
            </div>
        </div>
    </section>

    <footer class="footer">
        <div class="footer-content">
            <div class="footer-about">
                <h3>About Sweet Pilipinas</h3>
                <p>Sweet Pilipinas is dedicated to showcasing the rich and diverse desserts of the Philippines. Explore recipes, trivia, and more!</p>
            </div>
            <div class="footer-links">
                <h3>Quick Links</h3>
                <ul>
                    <li><a href="index.php">Home</a></li>
                    <?php if ($is_logged_in): ?>
                        <li><a href="top10.html">Top 10</a></li>
                        <li><a href="regional.html">Regional Desserts</a></li>
                        <li><a href="modern.html">Modern Twist</a></li>
                    <?php else: ?>
                        <li><a href="#" class="locked-link" title="Log in to unlock">Top 10</a></li>
                        <li><a href="#" class="locked-link" title="Log in to unlock">Regional Desserts</a></li>
                        <li><a href="#" class="locked-link" title="Log in to unlock">Modern Twist</a></li>
                    <?php endif; ?>
                    <li><a href="contact.php">Contact</a></li>
                </ul>
            </div>
            <div class="footer-contact">
                <h3>Contact Us</h3>
                <p>Email: SweetPilipinas@gmail.com</p>
                <p>Phone: +63 916 254 6571</p>
                <p>Address: Lucena City, Philippines</p>
                <div class="social-media">
                    <a href="https://facebook.com" target="_blank" class="social-icon">
                        <img src="resources/fb.png" alt="Facebook">
                    </a>
                    <a href="https://twitter.com" target="_blank" class="social-icon">
                        <img src="resources/tw.png" alt="Twitter">
                    </a>
                    <a href="https://instagram.com" target="_blank" class="social-icon">
                        <img src="resources/insta.png" alt="Instagram">
                    </a>
                    <a href="https://youtube.com" target="_blank" class="social-icon">
                        <img src="resources/yt.png" alt="YouTube">
                    </a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 Sweet Pilipinas. All rights reserved.</p>
        </div>
    </footer>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if ($message_sent): ?>
            document.getElementById('messageSentPopup').style.display = 'flex';
            history.replaceState({}, document.title, "contact.php");
        <?php endif; ?>
    });
    </script>
</body>
</html>