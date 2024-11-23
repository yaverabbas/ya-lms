<?php
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<div class='error'>Passwords do not match. Please try again.</div>";
        exit();
    }

    // Hash the password
    $hashed_password = password_hash($password, PASSWORD_BCRYPT);

    try {
        // Check if email is already registered
        $stmt = $pdo->prepare("SELECT * FROM ya_users WHERE email = ?");
        $stmt->execute([$email]);
        if ($stmt->rowCount() > 0) {
            echo "<div class='error'>This email is already registered.</div>";
            exit();
        }

        // Insert the user into the database
        $stmt = $pdo->prepare("INSERT INTO ya_users (name, email, password) VALUES (?, ?, ?)");
        $stmt->execute([$name, $email, $hashed_password]);

        // Redirect to login page with success message
        header('Location: ../views/login.php?success=1');
        exit();
    } catch (PDOException $e) {
        echo "<div class='error'>An error occurred. Please try again later.</div>";
    }
} else {
    echo "<div class='error'>Invalid request.</div>";
}
?>
