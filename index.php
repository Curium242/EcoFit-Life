<?php
session_start();
include('includes/db.php'); // Ensure db connection is correct
include('includes/header.php');

// Fetch the latest 3 articles
$stmt = $conn->query('SELECT articles.*, users.username FROM articles JOIN users ON articles.user_id = users.id ORDER BY articles.created_at DESC LIMIT 3');
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if the user is logged in
$loggedIn = isset($_SESSION['user_id']);
$isAdmin = $loggedIn && $_SESSION['role'] === 'admin';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoFit Life</title>
    <link rel="stylesheet" href="assets/styles.css?v=<?php echo time(); ?>"> <!-- Force CSS reload with cache busting -->
</head>

<body>
    <?php include 'includes/header.php'; ?> <!-- Ensure correct path -->

    <main>
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
                <img src="assets/images/image2.jpg" alt="Eco-friendly practices" class="what-we-do-image">
                <div class="what-we-do-text">
                    <p>At EcoFit Life, we're all about helping you lead a balanced, sustainable lifestyle. We offer expert tips on eco-friendly practices, nutrition, and fitness, while also giving you the space to share your own thoughts through blogs on lifestyle, the environment, and more. Together, we can promote both personal and environmental well-being.</p>
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
                            <img src="uploads/<?= htmlspecialchars($article['header_image']) ?>" alt="<?= htmlspecialchars($article['title']) ?>"> <!-- Referencing uploaded images correctly -->
                            <h2><?= htmlspecialchars($article['title']) ?></h2>
                            <p><?= substr(htmlspecialchars($article['content']), 0, 100) ?>...</p>
                            <a href="articles/article.php?id=<?= $article['id'] ?>">Read More...</a>
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

    <?php include 'includes/footer.php'; ?> <!-- Include the footer -->
    <script src="assets/script.js"></script> <!-- Ensure script is linked correctly -->
</body>
</html>
