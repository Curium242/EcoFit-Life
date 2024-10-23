<?php
$host = 'localhost';  // Database host
$db = 'ecofit_life';  // Database name
$user = 'root';       // Database username
$pass = '';           // Database password

try {
    $conn = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
