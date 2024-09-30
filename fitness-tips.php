<?php
require 'includes/db.php'; // Include the database connection
session_start(); // Start the session if needed
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Tips - EcoFit Life</title>
    <link rel="stylesheet" href="assets/styles.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex: 1;
        }
    </style>
</head>

<body>
    <?php include 'includes/header.php'; ?> <!-- Include the header -->

    <!-- Fitness Tips Section -->
    <main>
        <section class="fitness-tips">
            <h1>Fitness Tips</h1>
            <p>Explore our top fitness tips to help you stay active and healthy every day.</p>
            <ul class="tips-list">
                <li><a href="#">Beginner's Guide to Yoga</a></li>
                <li><a href="#">5-Minute Morning Stretch Routine</a></li>
                <li><a href="#">High-Intensity Interval Training (HIIT)</a></li>
                <li><a href="#">Cardio Workouts for a Healthy Heart</a></li>
                <li><a href="#">Strength Training Basics</a></li>
                <li><a href="#">Flexibility Exercises for Injury Prevention</a></li>
            </ul>
        </section>
    </main>

    <?php include 'includes/footer.php'; ?> <!-- Include the footer -->
    </footer>
</body>

</html>