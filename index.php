<?php include 'includes/header.php'; ?>

<div class="welcome">
    <h1>Welcome to YA-LMS</h1>
    <p>Your gateway to effective and simple learning management!</p>
    <?php
    // If user is logged in, then do not show the register and login buttons
    if (isset($_SESSION['user_id'])) {
        echo '<div class="actions">
            <a href="views/dashboard.php" class="btn">Dashboard</a>
            <a href="views/logout.php" class="btn">Logout</a>
        </div>';
    }
    else {
        echo '<div class="actions">
            <a href="views/register.php" class="btn">Register</a>
            <a href="views/login.php" class="btn">Login</a>
        </div>';
    }
    ?>
</div>

<?php include 'includes/footer.php'; ?>
