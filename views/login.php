<?php
include '../includes/header.php';
?>

<div class="container">
    <div class="login-form">
        <h1>Login</h1>
        <?php if (isset($_GET['success'])): ?>
            <div class="success">Registration successful! You can now log in.</div>
        <?php endif; ?>
        <?php if (isset($_GET['error'])): ?>
            <div class="error">Invalid email or password. Please try again.</div>
        <?php endif; ?>
        <form action="../actions/login.php" method="POST">
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
        </form>

        <p class="register-prompt">
            Don't have an account? <a href="/ya-lms/views/register.php">Register here</a> to get started.
        </p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
