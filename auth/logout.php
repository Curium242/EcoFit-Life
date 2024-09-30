<?php
session_start(); // Start the session
session_destroy(); // Destroy all session data
session_unset();
header('Location: ../index.php'); // Redirect to login page
exit;
?>
