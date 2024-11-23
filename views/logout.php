<?php

// Logout the user by destroying the session
session_start(); // Start the session
session_destroy(); // Destroy the session
header('Location: /ya-lms/views/login.php'); // Redirect to the login page
exit(); // Stop the script
?>
