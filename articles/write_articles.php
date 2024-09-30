<?php
session_start();

// Redirect if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit;
}

require '../includes/db.php'; // Include the database connection

// Handle article submission
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];
    if (!empty($title) && !empty($content)) {
        // Insert the article into the database
        $stmt = $conn->prepare('INSERT INTO articles (user_id, title, content) VALUES (?, ?, ?)');
        $stmt->execute([$user_id, $title, $content]);
        header('Location: articles.php'); // Redirect to articles page after submission
        exit;
    } else {
        $error = "All fields are required.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Write Article - EcoFit Life</title>
    <link rel="stylesheet" href="../assets/styles.css"> <!-- Correct relative path to CSS -->
</head>

<body>

    <?php include '../includes/header.php'; ?> <!-- Include the header -->

    <main>
        <section>
            <h2>Share Your Knowledge</h2>
            <?php if (isset($error)): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>
            <form action="write_articles.php" method="POST">
                <label for="title">Title:</label><br>
                <input type="text" id="title" name="title" required><br><br>
                <label for="content">Content:</label><br>
                <textarea id="content" name="content" rows="8" required></textarea><br><br>
                <button type="submit">Submit Article</button>
            </form>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?> <!-- Include the footer -->

</body>

</html>