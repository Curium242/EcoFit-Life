<?php
session_start();
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user by username
    $stmt = $conn->prepare('SELECT * FROM users WHERE username = ?');
    $stmt->execute([$username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Set session variables upon successful login
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Admin or user

        // Redirect based on role
        if ($user['role'] == 'admin') {
            header('Location: ../admin/admin_dashboard.php');
        } else {
            header('Location: ../index.php');
        }
        exit();
    } else {
        // Invalid login
        $_SESSION['error'] = 'Invalid username or password';
        header('Location: login.php');
        exit();
    }
}
?>
