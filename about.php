<?php
require 'includes/db.php'; // Include the database connection
session_start(); // Start the session if needed
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - EcoFit Life</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>

<body>
    <?php include 'includes/header.php'; ?> <!-- Include the header -->

    <!-- About Us Section -->
    <section class="about">
        <h1>About Us</h1>
        <p>Welcome to EcoFit Life! We are passionate about promoting healthy living through sustainable practices. Our goal is to provide you with the tools and knowledge to live a healthier, more eco-conscious life.</p>
        <h2>Our Mission</h2>
        <p>Our mission is to inspire individuals to adopt a lifestyle that is not only healthy for them but also beneficial for the planet. We believe that small changes can make a big impact, and we're here to guide you every step of the way.</p>
        <h2>Meet the Team</h2>
        <p>Our team is composed of health enthusiasts, sustainability advocates, and experts from various fields, all dedicated to helping you achieve a healthier and more sustainable lifestyle.</p>
        <h2>Our Story</h2>
        <p>What started as a small blog has grown into a comprehensive guide that reaches people all over the world. We’re excited to continue this journey with you and help make the world a better place, one step at a time.</p>
    </section>

    <?php include 'includes/footer.php'; ?> <!-- Include the footer -->
</body>

</html>