<?php
session_start();

// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../auth/login.php');
    exit();
}

include('../includes/db.php'); // Include the database connection
include('../includes/header.php'); // Include the header

// Fetch user data
$user_id = $_SESSION['user_id'];
$stmt = $conn->prepare('SELECT * FROM users WHERE id = ?');
$stmt->execute([$user_id]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Fetch articles written by the logged-in user
$article_stmt = $conn->prepare('SELECT * FROM articles WHERE user_id = ? ORDER BY created_at DESC');
$article_stmt->execute([$user_id]);
$articles = $article_stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle password change request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate the current password
    if (!password_verify($current_password, $user['password'])) {
        $error = "Current password is incorrect.";
    } elseif ($new_password !== $confirm_password) {
        $error = "New passwords do not match.";
    } else {
        // Hash the new password and update it
        $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);
        $update_stmt = $conn->prepare('UPDATE users SET password = ? WHERE id = ?');
        if ($update_stmt->execute([$hashed_password, $user_id])) {
            $success = "Password successfully changed.";
        } else {
            $error = "An error occurred. Please try again.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - EcoFit Life</title>
    <link rel="stylesheet" href="/assets/styles.css?v=<?php echo time(); ?>">
</head>
<body>

<main class="dashboard">
    <section class="dashboard-header">
        <h1>Welcome, <?= htmlspecialchars($user['username']); ?></h1>
        <p>Account created on: <?= date('F j, Y', strtotime($user['created_at'])); ?></p>
        <p>Email: <?= htmlspecialchars($user['email']); ?></p>
    </section>

    <section class="dashboard-articles">
        <h2>Your Articles</h2>
        <ul>
            <?php if ($articles): ?>
                <?php foreach ($articles as $article): ?>
                    <li><a href="../articles/article.php?id=<?= $article['id'] ?>"><?= htmlspecialchars($article['title']); ?></a> (Written on <?= date('F j, Y', strtotime($article['created_at'])); ?>)</li>
                <?php endforeach; ?>
            <?php else: ?>
                <p>You haven't written any articles yet.</p>
            <?php endif; ?>
        </ul>
    </section>

    <!-- Change Password Section -->
    <section class="dashboard-password">
        <h2>Change Password</h2>
        <?php if (isset($error)): ?>
            <p style="color:red;"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <?php if (isset($success)): ?>
            <p style="color:green;"><?= htmlspecialchars($success); ?></p>
        <?php endif; ?>
        <form action="user_dashboard.php" method="POST">
            <div class="form-group">
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" required>
            </div>
            <div class="form-group">
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" required>
            </div>
            <div class="form-group">
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" name="confirm_password" required>
            </div>
            <button type="submit" class="submit-button">Change Password</button>
        </form>
    </section>
</main>

<?php include('../includes/footer.php'); ?> <!-- Include the footer -->

</body>
</html>
