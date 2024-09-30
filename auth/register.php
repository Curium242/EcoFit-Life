<?php
require '../includes/db.php';  // Connect to the database
include('../includes/header.php'); 

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get and sanitize input
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate inputs
    if (empty($username) || empty($email) || empty($password)) {
        $error = "All fields are required.";
    } elseif ($password !== $confirm_password) {
        $error = "Passwords do not match.";
    } else {
        $stmt = $conn->prepare('SELECT * FROM users WHERE email = ? OR username = ?');
        $stmt->execute([$email, $username]);
        if ($stmt->rowCount() > 0) {
            $error = "Email or username already taken.";
        } else {
            // Hash the password and insert the user into the database
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $conn->prepare('INSERT INTO users (username, email, password) VALUES (?, ?, ?)');
            if ($stmt->execute([$username, $email, $hashed_password])) {
                // Redirect to login after successful registration
                header('Location: login.php');
                exit;
            } else {
                $error = "An error occurred. Please try again.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Register - EcoFit Life</title>
    <link rel="stylesheet" href="../assets/styles.css?v=<?php echo time() ?>">
</head>

<body>
    <?php include '../includes/header.php'; ?> <!-- Include the header -->

    <main class="login">
        <!-- Contact Hero Section -->
        <section class="login-hero">
            <h1>Register</h1>
            <p>Register to create an account.</p>
        </section>
        <section class="form-section">
            <?php if (isset($error)): ?>
                <p style="color:red;"><?= $error ?></p>
            <?php endif; ?>
            <form action="register.php" method="POST" class="login-form">
                <div class="form-group">
                    <label for="username">Username: </label>
                    <input type="text" name="username" placeholder="Username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email: </label>
                    <input type="email" name="email" placeholder="Email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password: </label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirm Password: </label>
                    <input type="password" name="confirm_password" placeholder="Confirm Password" required>
                </div>
                <button type="submit" class="submit-button">Register</button>
            </form>
        </section>
    </main>

    <?php include '../includes/footer.php'; ?> <!-- Include the footer -->
</body>

</html>