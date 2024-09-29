<?php
session_start();
require '../includes/db.php'; // Include the database connection

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login if the user is not logged in
    header('Location: ../auth/login.php');
    exit();
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $article_id = $_POST['article_id'];
    $user_id = $_SESSION['user_id'];
    $comment_content = trim($_POST['comment']);

    // Validate form inputs
    if (!empty($comment_content) && !empty($article_id)) {
        // Insert the comment into the database
        $stmt = $conn->prepare('INSERT INTO comments (article_id, user_id, comment) VALUES (?, ?, ?)');
        if ($stmt->execute([$article_id, $user_id, $comment_content])) {
            // Redirect back to the article page after successful comment
            header("Location: article.php?id=" . $article_id);
            exit();
        } else {
            // Handle the error (if the query fails)
            echo "Error: Unable to add the comment.";
        }
    } else {
        // If validation fails, redirect back with an error
        header("Location: article.php?id=" . $article_id . "&error=empty");
        exit();
    }
} else {
    // If the request method is not POST, redirect to homepage
    header('Location: ../index.php');
    exit();
}
?>
