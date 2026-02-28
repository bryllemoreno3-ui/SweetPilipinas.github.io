<?php
session_start();
$is_logged_in = isset($_SESSION['user_id']);
$profile_img = 'profile.png';

if ($is_logged_in) {
    $conn = new mysqli("localhost", "dessertsite", "dessertblog", "sweetpilipinas1");
    if (!$conn->connect_error) {
        $user_id = $_SESSION['user_id'];
        $sql = "SELECT profile_image FROM users WHERE id='$user_id'";
        $result = $conn->query($sql);
        if ($result && $row = $result->fetch_assoc()) {
            if (!empty($row['profile_image']) && file_exists($row['profile_image'])) {
                $profile_img = $row['profile_image'];
            }
        }
        $conn->close();
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sweet Pilipinas - Home</title>
    <link href="https://fonts.googleapis.com/css?family=Dancing+Script:700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="homepage.css">
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
            <a href="contact.php">Contact</a>
            <?php if ($is_logged_in): ?>
                <div class="navbar-profile-dropdown" style="margin-left: auto;">
                    <button class="profile-btn">
                        <img src="<?php echo htmlspecialchars($profile_img); ?>" alt="Profile" class="profile-icon"> Profile <span class="dropdown-arrow">&#9662;</span>
                    </button>
                    <div class="profile-dropdown-content">
                        <a href="profile.php"><span class="dropdown-icon">&#128100;</span> Profile</a>
                        <a href="logout.php"><span class="dropdown-icon">&#128682;</span> Logout</a>
                    </div>
                </div>
            <?php else: ?>
                <a href="login.php" style="margin-left: auto;">Log-In</a>
                <a href="register.php">Register</a>
            <?php endif; ?>
        </nav>
    </header>

    <section class="welcome-section">
        <h1 class="welcome-title">Welcome to Sweet Pilipinas</h1>
        <p class="welcome-slogan">
            <span style="font-size:1.15em;">🍮 Discover the Sweet Side of Filipino Culture 🍧</span>
            <br>
            <span style="color:#fbe1d5;">Explore a delicious heritage, one dessert at a time!</span>
        </p>
    </section>

    <div class="collage-mosaic">
        <div class="collage-mosaic-inner">
            <div class="collage-col">
                <img src="resources/taho.jpg" alt="Taho" class="collage-img tall">
                <img src="resources/lechec.jpg" alt="Leche Flan" class="collage-img square">
            </div>
            <div class="collage-col">
                <img src="resources/haloc.jpg" alt="Halo-Halo" class="collage-img square">
                <img src="resources/ubeh.webp" alt="Ube Halaya" class="collage-img wide">
                <img src="resources/bumbong.jpg" alt="Puto Bumbong" class="collage-img square">
            </div>
            <div class="collage-col">
                <img src="resources/buko.jpg" alt="Buko Pandan" class="collage-img tall">
                <img src="resources/cassava.jpg" alt="Cassava Cake" class="collage-img square">
            </div>
            <div class="collage-col">
                <img src="resources/sapin.jpg" alt="Sapin-Sapin" class="collage-img square">
                <img src="resources/turon.jpg" alt="Turon" class="collage-img wide">
                <img src="resources/majaa.jpg" alt="Maja Blanca" class="collage-img square">
            </div>
            <div class="collage-col">
                <img src="resources/putoc.jpg" alt="Puto Bumbong" class="collage-img tall">
                <img src="resources/bibingka.jpg" alt="Bibingka" class="collage-img square">
            </div>
            <!-- Duplicate for seamless infinite effect -->
            <div class="collage-col">
                <img src="resources/taho.jpg" alt="Taho" class="collage-img tall">
                <img src="resources/lechec.jpg" alt="Leche Flan" class="collage-img square">
            </div>
            <div class="collage-col">
                <img src="resources/haloc.jpg" alt="Halo-Halo" class="collage-img square">
                <img src="resources/ubeh.webp" alt="Ube Halaya" class="collage-img wide">
                <img src="resources/bumbong.jpg" alt="Puto Bumbong" class="collage-img square">
            </div>
            <div class="collage-col">
                <img src="resources/buko.jpg" alt="Buko Pandan" class="collage-img tall">
                <img src="resources/cassava.jpg" alt="Cassava Cake" class="collage-img square">
            </div>
            <div class="collage-col">
                <img src="resources/sapin.jpg" alt="Sapin-Sapin" class="collage-img square">
                <img src="resources/turon.jpg" alt="Turon" class="collage-img wide">
                <img src="resources/majaa.jpg" alt="Maja Blanca" class="collage-img square">
            </div>
            <div class="collage-col">
                <img src="resources/putoc.jpg" alt="Puto Bumbong" class="collage-img tall">
                <img src="resources/bibingka.jpg" alt="Bibingka" class="collage-img square">
            </div>
        </div>
    </div>

    <section class="featured-dessert-container">
        <div class="featured-dessert-header">
            <img src="resources/star.png" alt="Star" class="star-icon">
            <span>This Month's Featured Dessert</span>
            <img src="resources/star.png" alt="Star" class="star-icon">
        </div>
        <div class="featured-dessert-main">
            <img src="resources/haloc.jpg" alt="Halo-Halo" class="featured-dessert-img">
            <div class="featured-dessert-info">
                <span class="featured-dessert-title">Halo-Halo</span>
                <span class="featured-dessert-tag">#SummerInAGlass</span>
                <p class="featured-dessert-desc">
                    Dive into a rainbow of flavors! Halo-Halo is the Philippines’ ultimate summer cooler, loaded with shaved ice, sweet beans, jellies, leche flan, purple yam, and more—topped with creamy evaporated milk and a scoop of ice cream. Every spoonful is a surprise!
                </p>
                <div class="featured-dessert-funfact">
                    <span class="info-icon">🌈</span>
                    <span><b>Fun Fact:</b> "Halo-Halo" means "mix-mix"—the more you mix, the yummier it gets!</span>
                </div>
            </div>
        </div>
    </section>

    <section class="dessert-cards-row">
        <?php if ($is_logged_in): ?>
            <div class="dessert-card">
                <img src="resources/lechec.jpg" alt="Leche Flan" class="dessert-card-img">
                <span class="dessert-card-title">Leche Flan</span>
                <div class="dessert-card-info"><span class="info-icon">🍮</span> <span>Classic Caramel Custard</span></div>
                <div class="dessert-card-desc">
                    Silky smooth caramel custard with a golden syrupy top. The Filipino party staple, perfect for fiestas and family gatherings!
                </div>
                <div class="dessert-card-funfact">Did you know? Filipino leche flan uses more egg yolks for extra richness!</div>
            </div>
            <div class="dessert-card">
                <img src="resources/bumbong.jpg" alt="Puto Bumbong" class="dessert-card-img">
                <span class="dessert-card-title">Puto Bumbong</span>
                <div class="dessert-card-info"><span class="info-icon">🎶</span> <span>Christmas Sticky Rice</span></div>
                <div class="dessert-card-desc">
                    Purple, chewy, and steamed in bamboo tubes—topped with butter, coconut, and muscovado. A Simbang Gabi favorite!
                </div>
                <div class="dessert-card-funfact">Only comes out in the early mornings of December!</div>
            </div>
            <div class="dessert-card">
                <img src="resources/ubeh.webp" alt="Ube Halaya" class="dessert-card-img">
                <span class="dessert-card-title">Ube Halaya</span>
                <div class="dessert-card-info"><span class="info-icon">🟣</span> <span>Purple Yam Jam</span></div>
                <div class="dessert-card-desc">
                    Creamy, dreamy, and vibrantly purple! Ube Halaya is great on its own or as a topping for halo-halo and kakanin.
                </div>
                <div class="dessert-card-funfact">The secret: real ube, not just flavoring!</div>
            </div>
        <?php else: ?>
            <div class="dessert-card">
                <img src="resources/lechec.jpg" alt="Leche Flan" class="dessert-card-img">
                <span class="dessert-card-title">Leche Flan</span>
                <div class="dessert-card-info"><span class="info-icon">🍮</span> <span>Classic Caramel Custard</span></div>
                <div class="dessert-card-desc">
                    Silky smooth caramel custard with a golden syrupy top. The Filipino party staple, perfect for fiestas and family gatherings!
                </div>
                <div class="dessert-card-funfact">Did you know? Filipino leche flan uses more egg yolks for extra richness!</div>
                <a href="login.php" class="dessert-card-link">See More</a>
            </div>
            <div class="dessert-card">
                <img src="resources/bumbong.jpg" alt="Puto Bumbong" class="dessert-card-img">
                <span class="dessert-card-title">Puto Bumbong</span>
                <div class="dessert-card-info"><span class="info-icon">🎶</span> <span>Christmas Sticky Rice</span></div>
                <div class="dessert-card-desc">
                    Purple, chewy, and steamed in bamboo tubes—topped with butter, coconut, and muscovado. A Simbang Gabi favorite!
                </div>
                <div class="dessert-card-funfact">Only comes out in the early mornings of December!</div>
                <a href="login.php" class="dessert-card-link">See More</a>
            </div>
            <div class="dessert-card">
                <img src="resources/ubeh.webp" alt="Ube Halaya" class="dessert-card-img">
                <span class="dessert-card-title">Ube Halaya</span>
                <div class="dessert-card-info"><span class="info-icon">🟣</span> <span>Purple Yam Jam</span></div>
                <div class="dessert-card-desc">
                    Creamy, dreamy, and vibrantly purple! Ube Halaya is great on its own or as a topping for halo-halo and kakanin.
                </div>
                <div class="dessert-card-funfact">The secret: real ube, not just flavoring!</div>
                <a href="login.php" class="dessert-card-link">See More</a>
            </div>
        <?php endif; ?>
    </section>

    <section class="summary-section">
        <?php if ($is_logged_in): ?>
            <div class="summary-card">
                <a href="top10.html"><img src="resources/homeb1.png" alt="Vote & Discover: Top 10"></a>
            </div>
            <div class="summary-card">
                <a href="regional.html"><img src="resources/homeb2.png" alt="Region Explorer"></a>
            </div>
            <div class="summary-card">
                <a href="modern.html"><img src="resources/homeb3.png" alt="Modern Remixes"></a>
            </div>
        <?php else: ?>
            <div class="summary-card locked">
                <img src="resources/homeb1.png" alt="Wide Card">
            </div>
            <div class="summary-card locked">
                <img src="resources/homeb2.png" alt="Square Card 1">
            </div>
            <div class="summary-card locked">
                <img src="resources/homeb3.png" alt="Square Card 2">
            </div>
        <?php endif; ?>
    </section>

    <section class="about-creator-card">
        <div class="about-img-side">
            <img src="resources/pic1.png" alt="Creator Photo" class="about-creator-img">
        </div>
        <div class="about-info-side">
            <h2 class="about-title">About the Creator</h2>
            <p class="about-desc">
                Hi! I'm <strong>Brylle Moreno</strong>, a passionate dessert lover, home baker, and the creator of Sweet Pilipinas. My mission? To make you fall in love with Filipino sweets—whether it’s your first time or your hundredth!
            </p>
            <p class="about-desc">
                Sweet Pilipinas is more than just a blog. It’s a vibrant community, a digital recipe book, and a celebration of family memories, fiestas, and the joy of sharing dessert. I share stories, trivia, and creative twists so you can bring a bit of the Philippines to your own kitchen.
            </p>
            <div class="fun-fact-creator" style="background:rgba(255, 230, 183, 0.33);border-radius:12px;padding:10px 18px;margin:16px 0;color:#ffffff;">
                <b>Fun Fact:</b> My first dessert triumph was successfully flipping a leche flan at age 12 (after 3 epic fails)!
            </div>
            <a href="about.php" class="about-learn-btn">Meet Me & My Story</a>
        </div>
    </section>

    <section class="contact-pahapyaw-bg">
        <div class="contact-pahapyaw-inner">
            <div class="contact-pahapyaw-poster">
                <img src="resources/contactsbg.jpg" alt="Contact Poster" class="contact-poster-img">
            </div>
            <div class="contact-pahapyaw-info">
                <h2 class="contact-pahapyaw-title">Contact Us</h2>
                <p class="contact-pahapyaw-desc">
                    Have questions, suggestions, or want to share your sweet story? <br>
                    <span style="color:#b96e5a;">🍰 We love hearing from dessert fans, home bakers, and fellow foodies!</span>
                </p>
                <div class="contact-pahapyaw-details">
                    <p><img src="resources/mail.png" alt="Email" class="contact-icon"> SweetPilipinas@gmail.com</p>
                    <p><img src="resources/phone-call.png" alt="Phone" class="contact-icon"> +63 916 254 6571</p>
                    <p><img src="resources/home.png" alt="Chat" class="contact-icon"> Lucena City, Philippines</p>
                </div>
                <a href="contact.php" class="contact-learn-btn">Get in Touch & Share a Dessert Memory</a>
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