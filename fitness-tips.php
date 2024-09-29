<?php
include('includes/db.php'); // Database connection
include('includes/header.php'); 
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

   <!-- Footer -->
   <footer>
    <div class="footer-content">
        <img id="footer-logo" src="assets/images/logo.png" alt="EcoFit Life Logo">
        <div class="address-author-wrapper">
            <address>
                123 Green Lane<br>
                EcoCity, Earth<br>
                98765
            </address>
            <div class="author-info">
                <div class="author-column">
                    <p>Abhay kejriwal<br>1234567890</p>
                </div>
                <div class="author-column">
                    <p>Govind Sankar H<br>1234567890</p>
                </div>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
<?php include('includes/footer.php'); ?>
