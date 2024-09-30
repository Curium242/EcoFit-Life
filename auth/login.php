<?php
require '../includes/db.php';  
session_start(); 


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // Check if the user exists with the provided email
    $stmt = $conn->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        // Set session variable to track the logged-in user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        header('Location: ../index.php');
        exit;
    } else {
        $error = "Invalid email or password.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login - EcoFit Life</title>
    <link rel="stylesheet" href="../assets/styles.css?v=<?php echo time() ?>">
</head>

<body>
    <?php include '../includes/header.php'; ?> <!-- Include the header -->

    <main class="login">
        <!-- Contact Hero Section -->
        <section class="login-hero">
            <h1>Login</h1>
            <p>Login to post articles and comment.</p>
        </section>
        <section class="form-section">
            <?php if (isset($error)): ?>
                <p style="color:red;"><?= $error ?></p>
            <?php endif; ?>
            <form action="login.php" method="POST" class="login-form">
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <button type="submit" class="submit-button">Login</button>
            </form>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?> <!-- Include the footer -->
</body>

</html>