<?php
require '../includes/db.php'; // Include the database connection
session_start(); // Start the session if needed

// Fetch articles from the database
$stmt = $conn->query('SELECT articles.*, users.username FROM articles JOIN users ON articles.user_id = users.id ORDER BY articles.created_at DESC');
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>All Articles - EcoFit Life</title>
    <link rel="stylesheet" href="../assets/styles.css"> 
</head>
<body>
<header>
        <nav>
            <div class="logo-container">
                <a href="index.php" class="logo"><img id="logo" src="assets/images/logo.png" alt="EcoFit Life Logo"></a>
                <a href="index.php" class="site-name">EcoFit Life</a>
            </div>
            <ul>
                <li><a href="articles.php">Articles</a></li>
                <li><a href="../fitness-tips.html">Fitness Tips</a></li>
                <li><a href="../about.html">About Us</a></li>
                <li><a href="../resources.html">Resources</a></li>
                <li><a href="../contact.html">Contact</a></li>
                <?php if (isset($_SESSION['user_id'])): ?>
                    <li><a href="write_articles.php">Write an Article</a></li> 
                    <li><a href="../auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="../auth/login.php">Login</a></li>
                    <li><a href="../auth/register.php">Register</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <?php if ($articles): ?>
                <?php foreach ($articles as $article): ?>
                    <div class="article-card">
                        <h2><?= htmlspecialchars($article['title']) ?></h2>
                        <p><?= htmlspecialchars($article['content']) ?></p>
                        <small>By <?= htmlspecialchars($article['username']) ?> on <?= $article['created_at'] ?></small>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No articles found</p>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
