<?php
include('includes/db.php'); // Database connection
include('includes/header.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resources - EcoFit Life</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>


    <!-- Resources Section -->
    <main>
        <section class="resources">
            <h1>Resources</h1>
            <p>Discover a variety of resources to help you on your journey to a sustainable and healthy lifestyle.</p>
            <ul class="resources-list">
                <li>
                    <a href="path/to/resource1.pdf" download>Download Guide 1</a>
                    <p>Explore our comprehensive guide on sustainable eating practices.</p>
                </li>
                <li>
                    <a href="path/to/resource2.pdf" download>Download Guide 2</a>
                    <p>Get started with eco-friendly fitness routines.</p>
                </li>
                <li>
                    <a href="path/to/resource3.pdf" download>Download Guide 3</a>
                    <p>Learn how to reduce your carbon footprint with practical tips.</p>
                </li>
                <!-- Add more resources as needed -->
            </ul>
        </section>
    </main>

    <?php include('includes/footer.php'); ?>

</body>
</html>
