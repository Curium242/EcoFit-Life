<?php
session_start(); // Start the session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EcoFit Life</title>
    <link rel="stylesheet" href="../assets/styles.css"> <!-- Modify path if needed -->
</head>
<body>

<header>
    <nav>
        <div class="logo-container">
            <a href="/index.php" class="logo"><img id="logo" src="/assets/images/logo.png" alt="EcoFit Life Logo"></a>
            <a href="/index.php" class="site-name">EcoFit Life</a>
        </div>
        <ul>
            <li><a href="/articles/articles.php">Articles</a></li>
            <li><a href="/fitness-tips.php">Fitness Tips</a></li>
            <li><a href="/about.php">About Us</a></li>
            <li><a href="/resources.php">Resources</a></li>
            <li><a href="/contact.php">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="/articles/write_articles.php">Write an Article</a></li> 
                <li><a href="/auth/logout.php">Logout</a></li>
            <?php else: ?>
                <li><a href="/auth/login.php">Login</a></li>
                <li><a href="/auth/register.php">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>
