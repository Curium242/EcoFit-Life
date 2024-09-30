<?php
session_start();
require '../includes/db.php';

// Fetch articles from the database
$stmt = $conn->query('SELECT articles.id, articles.title, articles.content, articles.created_at, users.username FROM articles JOIN users ON articles.user_id = users.id ORDER BY articles.created_at DESC');
$articles = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Articles - EcoFit Life</title>
    <link rel="stylesheet" href="../assets/styles.css?v=<?php echo time(); ?>">
</head>

<body>
    <?php include '../includes/header.php'; ?> <!-- Include the header -->

    <main>
        <section class="articles-hero">
            <h1>All Articles</h1>
        </section>
        <section class="articles-container">
            <?php if ($articles): ?>
                <?php foreach ($articles as $article): ?>
                    <div class="article-card">
                        <h2>
                            <a href="article.php?id=<?= htmlspecialchars($article['id']) ?>">
                                <?= htmlspecialchars($article['title']) ?>
                            </a>
                        </h2>
                        <p><?= htmlspecialchars(substr($article['content'], 0, 100)) ?>...</p>
                        <small>By <?= htmlspecialchars($article['username']) ?> on <?= $article['created_at'] ?></small>
                        <br>
                        <a href="article.php?id=<?= htmlspecialchars($article['id']) ?>">Read More</a>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No articles found</p>
            <?php endif; ?>
        </section>
    </main>
    <?php include '../includes/footer.php'; ?> <!-- Include the footer -->
</body>

</html>