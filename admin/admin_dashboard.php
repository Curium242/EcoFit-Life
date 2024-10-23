<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: ../auth/login.php');
    exit();
}
include('../includes/db.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - EcoFit Life</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>

<main>
    <h1>Admin Dashboard</h1>
    <ul>
        <li><a href="view_users.php">View All Users</a></li>
        <li><a href="approve_articles.php">Approve Articles</a></li>
        <li><a href="manage_comments.php">Manage Comments</a></li>
    </ul>
</main>

</body>
</html>
