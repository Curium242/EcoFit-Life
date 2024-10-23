<?php
session_start();
include('../includes/db.php'); // Correct path for db.php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - EcoFit Life</title>
    <link rel="stylesheet" href="../assets/styles.css?v=<?php echo time() ?>">
</head>
<body>

<?php include('../includes/header.php'); ?> <!-- Include header -->

<main class="login">
    <section class="login-hero">
        <h1>Login</h1>
        <p>Login to access your account.</p>
    </section>
    <section class="form-section">
        <?php if (isset($_SESSION['error'])): ?>
            <p class="error" style="color:red;"><?= $_SESSION['error']; unset($_SESSION['error']); ?></p>
        <?php endif; ?>
        <form action="login_process.php" method="POST" class="login-form">
            <div class="form-group">
                <label for="username">Username: </label>
                <input type="text" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="submit-button">Login</button>
        </form>
        <p>Don't have an account? <a href="register.php">Register here</a></p>
    </section>
</main>

<?php include('../includes/footer.php'); ?> <!-- Include footer -->

</body>
</html>
