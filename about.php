<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About - Sweet Pilipinas</title>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="about.css">
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
            <a href="about.php" class="active">About</a>
            <a href="contact.php">Contact</a>
            <?php if ($is_logged_in): ?>
                <a href="logout.php">Logout</a>
            <?php else: ?>
                <a href="login.php">Log-In</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="about-hero">
        <img src="resources/star.png" class="sparkle" alt="Sparkle">
        <h1 class="about-hero-title">Meet the Creator</h1>
        <p class="about-hero-desc">
            <strong>Sweet Pilipinas</strong> is more than just a dessert blog—it's a vibrant celebration of Filipino culture, heritage, and the sweet moments that bring us together. Here, every recipe, story, and trivia is crafted to spark your curiosity and satisfy your cravings for both knowledge and kakanin! <br><br>
            Dive into a world where <b>sapin-sapin</b> is more than a rainbow treat, <b>halo-halo</b> is a festival in a glass, and every bite tells a story of family, fiesta, and Filipino pride. Whether you’re a home baker, a foodie, or simply someone with a sweet tooth, Sweet Pilipinas is your passport to the most exciting and delicious side of the Philippines!
        </p>
        <img src="resources/confetti.png" class="confetti confetti1" alt="Confetti">
        <img src="resources/confetti.png" class="confetti confetti2" alt="Confetti">
        <img src="resources/confetti.png" class="confetti confetti3" alt="Confetti">
    </section>

    <section class="about-main-content">
        <div class="about-img-wrap">
            <img src="resources/pic1.png" alt="Brylle Moreno" class="about-img">
        </div>
        <div class="about-info-wrap">
            <div class="about-name">Brylle Moreno</div>
            <div class="about-role">Founder &amp; Dessert Enthusiast</div>
            <div class="about-bio">
                <strong>Brylle Moreno</strong> is a passionate Filipino foodie, digital creator, and storyteller. Inspired by childhood memories of kitchen adventures and festive gatherings, Brylle created Sweet Pilipinas to share the magic of Filipino desserts with the world.<br><br>
                With every post, Brylle aims to make you feel the warmth of a Filipino kitchen—where <em>lola’s</em> secret recipes, colorful street treats, and modern twists come together in a joyful celebration. Brylle believes that desserts are more than food—they’re memories, celebrations, and a taste of home.<br><br>
                <em>“Let’s explore, taste, and celebrate the sweetest stories of the Philippines—one dessert at a time!”</em>
            </div>
            <div class="about-socials">
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
</body>
</html>