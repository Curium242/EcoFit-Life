<?php
session_start();
include('../includes/db.php');

// Check if the article ID is passed in the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid article ID.";
    exit();
}

$article_id = $_GET['id'];

// Fetch the article from the database using the article ID
$stmt = $conn->prepare('SELECT articles.*, users.username FROM articles JOIN users ON articles.user_id = users.id WHERE articles.id = :id');
$stmt->bindParam(':id', $article_id, PDO::PARAM_INT);
$stmt->execute();

// Fetch the article (returns false if no article found)
$article = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$article) {
    echo "Article not found.";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($article['title']); ?> - EcoFit Life</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <nav>
        <a href="articles.php">Back to Articles</a>
    </nav>
</header>

<main>
    <!-- Article Details -->
    <article>
        <h1><?php echo htmlspecialchars($article['title']); ?></h1>
        <p>By <?php echo htmlspecialchars($article['username']); ?> on <?php echo date('F j, Y', strtotime($article['created_at'])); ?></p>
        <div>
            <?php echo nl2br(htmlspecialchars($article['content'])); ?> <!-- nl2br() converts newlines to <br> for better formatting -->
        </div>
    </article>

    <!-- Display Comments -->
    <section class="comments">
        <h2>Comments</h2>

        <?php
        // Fetch comments for this article
        $comment_sql = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.article_id = :article_id ORDER BY comments.created_at DESC";
        $comment_stmt = $conn->prepare($comment_sql);
        $comment_stmt->bindParam(':article_id', $article_id, PDO::PARAM_INT);
        $comment_stmt->execute();
        $comments = $comment_stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($comments):
            foreach ($comments as $comment): ?>
                <div class="comment">
                    <p><strong><?php echo htmlspecialchars($comment['username']); ?></strong> on <?php echo date('F j, Y, g:i a', strtotime($comment['created_at'])); ?></p>
                    <p><?php echo nl2br(htmlspecialchars($comment['comment'])); ?></p>
                </div>
            <?php endforeach;
        else:
            echo "<p>No comments yet. Be the first to comment!</p>";
        endif;
        ?>

        <!-- Add Comment Form -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <h3>Add a Comment</h3>
            <form method="POST" action="comment.php">
                <textarea name="comment" placeholder="Write your comment..." required></textarea>
                <input type="hidden" name="article_id" value="<?php echo $article_id; ?>">
                <button type="submit">Submit</button>
            </form>
        <?php else: ?>
            <p><a href="../auth/login.php">Login</a> to post a comment.</p>
        <?php endif; ?>
    </section>
</main>

<footer>
    <!-- Your footer content -->
</footer>

</body>
</html>
