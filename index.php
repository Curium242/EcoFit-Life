<?php
session_start();
require 'includes/db.php'; // Adjust path to db.php

// Fetch the latest 3 articles
$stmt = $conn->query('SELECT articles.*, users.username FROM articles JOIN users ON articles.user_id = users.id ORDER BY articles.created_at DESC LIMIT 3');
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoFit Life</title>
    <link rel="stylesheet" href="assets/styles.css"> 
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <div class="logo-container">
                <a href="index.php" class="logo"><img id="logo" src="assets/images/logo.png" alt="EcoFit Life Logo"></a>
                <a href="index.php" class="site-name">EcoFit Life</a>
            </div>
            <ul>
                <li><a href="articles/articles.php">Articles</a></li>
                <li><a href="fitness-tips.html">Fitness Tips</a></li>
                <li><a href="about.html">About Us</a></li>
                <li><a href="resources.html">Resources</a></li>
                <li><a href="contact.html">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="articles/write_articles.php">Write an Article</a></li> 
                    <li><a href="auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="auth/login.php">Login</a></li>
                    <li><a href="auth/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h1>EcoFit Life</h1>
                <h3>Embrace a Sustainable and Healthy Lifestyle</h3>
                <a href="articles/articles.php" class="cta-button">Get Started</a>
            </div>
        </section>

        <!-- What We Do Section -->
        <section class="what-we-do">
            <h2>What We Do</h2>
            <div class="what-we-do-content">
                <img src="assets/images/image2.jpg" alt="Eco-friendly practices" class="what-we-do-image"> <!-- Corrected image path -->
                <div class="what-we-do-text">
                    <p>At EcoFit Life, we help you lead a balanced, sustainable lifestyle. Learn about eco-friendly practices, fitness, and more!</p>
                </div>
            </div>
        </section>

        <!-- Featured Articles Section -->
        <section class="featured-articles">
            <h2>Our Latest Articles</h2>
            <div class="articles-container">
                <?php if ($articles): ?>
                    <?php foreach ($articles as $article): ?>
                        <div class="article-card">
                            <img src="assets/images/default-article-image.jpg" alt="<?= htmlspecialchars($article['title']) ?>">
                            <h3><?= htmlspecialchars($article['title']) ?></h3>
                            <p>By <?= htmlspecialchars($article['username']) ?></p>
                            <p><?= substr(htmlspecialchars($article['content']), 0, 100) ?>...</p>
                            <a href="article.php?id=<?= $article['id'] ?>">Read More</a>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p>No articles found</p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Newsletter Section -->
        <section class="newsletter">
            <h2>Subscribe to Our Newsletter</h2>
            <form id="newsletter-form">
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </form>
        </section>
    </main>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <img id="footer-logo" src="assets/images/logo.png" alt="EcoFit Life Logo">
            <div class="address-author-wrapper">
                <address>
                    123 Green Lane<br>
                    EcoCity, Earth<br>
                    98765
                </address>
                <div class="author-info">
                    <div class="author-column">
                        <p>Abhay Kejriwal<br>1234567890</p>
                    </div>
                    <div class="author-column">
                        <p>Govind Sankar H<br>1234567890</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="assets/script.js"></script> <!-- Corrected path to JS -->
</body>
</html>
