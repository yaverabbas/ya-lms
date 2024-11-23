<?php include '../includes/header.php'; ?>

<div class="container">
    <div class="registration-form">
        <h1>Register</h1>
        <?php if (isset($_GET['error'])): ?>
            <div class="error">An error occurred. Please try again later.</div>
        <?php endif; ?>
        <form action="../actions/register.php" method="POST">
            <input type="text" name="name" placeholder="Full Name" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <button type="submit">Sign Up</button>
        </form>
        <p>If you already have an account, <a href="../views/login.php">Login here</a>.</p>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
