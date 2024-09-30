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
    <link rel="stylesheet" href="../assets/styles.css?v=<?php echo time(); ?>"> <!-- Correct relative path to CSS -->
</head>

<body>

    <?php include '../includes/header.php'; ?> <!-- Include the header -->

    <main>
        <!-- Contact Hero Section -->
        <section class="get-in-touch">
            <h1>Share Your Knowledge</h1>
        </section>

        <!-- Contact Form Section -->
        <section class="contact-form-section">
            <?php if (isset($error)): ?>
                <p style="color: red;"><?= $error ?></p>
            <?php endif; ?>
            <form action="write_articles.php" method="POST" class="contact-form">
                <div class="form-group">
                    <label for="title">Title:</label><br>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="content">Content:</label><br>
                    <textarea id="content" name="content" rows="8" required></textarea>
                </div>
                <button type="submit" class="submit-button">Submit Article</button>
            </form>

        </section>
    </main>

    <?php include '../includes/footer.php'; ?> <!-- Include the footer -->
</body>
</html>

