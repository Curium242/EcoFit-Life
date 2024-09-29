<?php
include('includes/db.php'); // Database connection
include('includes/header.php'); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - EcoFit Life</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

    <main>
        <!-- Contact Hero Section -->
        <section class="get-in-touch">
            <h1>Get in Touch</h1>
            <p>We'd love to hear from you! Reach out with any questions or feedback.</p>
        </section>

        <!-- Contact Form Section -->
        <section class="contact-form-section">
            <form action="submit_form.php" method="post" class="contact-form">
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" id="subject" name="subject" required>
                </div>

                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea id="message" name="message" rows="5" required></textarea>
                </div>

                <button type="submit" class="submit-button">Send Message</button>
            </form>
        </section>
    </main>

 
    
</body>
</html>
<?php include('includes/footer.php'); ?>
