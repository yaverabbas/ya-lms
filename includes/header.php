<?php
session_start(); // Start the session to access session variables

include '../config/config.php'; // Include the config file to apply global settings
include '../config/db.php'; // Include the database connection
include '../includes/auth.php'; // Auth file

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>YA-LMS</title>
    <link rel="stylesheet" href="/ya-lms/assets/css/style.css?v=<?php echo filemtime(__DIR__ . '/../assets/css/style.css'); ?>">
</head>
<body>
<nav>
    <div class="logo">
        <a href="/ya-lms/">YA-LMS</a>
    </div>
    <div class="nav-toggle" onclick="toggleMenu()">☰</div>
    <div class="nav-links">
        <!-- Link visible to everyone -->
        <a href="/ya-lms/views/courses.php">Courses</a>

        <?php if (isset($_SESSION['user_id'])): ?>
            <!-- Links visible to logged-in users -->
            <a href="/ya-lms/views/dashboard.php">Dashboard</a>
            <a href="/ya-lms/views/logout.php">Logout</a>
        <?php else: ?>
            <!-- Links visible to non-logged-in users -->
            <a href="/ya-lms/views/login.php">Login</a>
            <a href="/ya-lms/views/register.php">Register</a>
        <?php endif; ?>
    </div>
</nav>


<script>
    function toggleMenu() {
        const navLinks = document.querySelector('.nav-links');
        navLinks.classList.toggle('show');
    }
</script>

<div class="container">
