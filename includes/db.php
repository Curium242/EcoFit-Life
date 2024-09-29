<?php
// Database connection
$host = 'localhost';
$dbname = 'ecofit_life';
$username = 'root';  // Change if necessary
$password = '';      // Add your MySQL password if necessary

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
