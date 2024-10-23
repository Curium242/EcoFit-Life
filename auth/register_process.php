<?php
session_start();
include('../includes/db.php'); // Correct path to database connection

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        $_SESSION['error'] = 'Passwords do not match';
        header('Location: register.php');
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    // Check if the username already exists
    $stmt = $conn->prepare('SELECT id FROM users WHERE username = ?');
    $stmt->execute([$username]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = 'Username already exists';
        header('Location: register.php');
        exit();
    }

    // Insert new user into the database
    $stmt = $conn->prepare('INSERT INTO users (username, password, role) VALUES (?, ?, ?)');
    $stmt->execute([$username, $hashed_password, 'user']); // Default role is 'user'

    $_SESSION['user_id'] = $conn->lastInsertId();
    $_SESSION['username'] = $username;
    $_SESSION['role'] = 'user';

    // Redirect to home
    header('Location: ../index.php');
    exit();
}
?>
