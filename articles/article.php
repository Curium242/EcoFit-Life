<?php
session_start();
include('../includes/db.php');

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "Invalid article ID.";
    exit();
}

$article_id = $_GET['id'];

$sql = "SELECT articles.*, users.username FROM articles JOIN users ON articles.user_id = users.id WHERE articles.id = $article_id";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    echo "Article not found.";
    exit();
}

$article = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $article['title']; ?> - EcoFit Life</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>

<header>
    <nav>
        <!-- Your navigation code -->
        <a href="articles.php">Back to Articles</a>
    </nav>
</header>

<main>
    <article>
        <h1><?php echo $article['title']; ?></h1>
        <p>By <?php echo $article['username']; ?> on <?php echo date('F j, Y', strtotime($article['created_at'])); ?></p>
        <div>
            <?php echo nl2br($article['content']); ?> 
        </div>
    </article>

    <section class="comments">
        <h2>Comments</h2>

        <?php
        $comment_sql = "SELECT comments.*, users.username FROM comments JOIN users ON comments.user_id = users.id WHERE comments.article_id = $article_id ORDER BY comments.created_at DESC";
        $comment_result = $conn->query($comment_sql);

        if ($comment_result->num_rows > 0) {
            while ($comment = $comment_result->fetch_assoc()) {
                echo "<div class='comment'>";
                echo "<p><strong>" . $comment['username'] . "</strong> on " . date('F j, Y, g:i a', strtotime($comment['created_at'])) . "</p>";
                echo "<p>" . nl2br($comment['comment']) . "</p>";
                echo "</div>";
            }
        } else {
            echo "<p>No comments yet. Be the first to comment!</p>";
        }
        ?>

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
