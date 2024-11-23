<?php
session_start(); // Start the session to track login state
include '../config/db.php'; // Include the database connection

// Assign the PDO connection to $conn
$conn = $pdo;

// Enable error reporting for debugging
$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the form data
    $email = $_POST['email'];
    $password = $_POST['password'];

    try {
        // Query to fetch the user from the database
        $stmt = $conn->prepare("SELECT * FROM ya_users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch();

        // Check if the user exists and the password matches
        if ($user && password_verify($password, $user['password'])) {
            // Password is correct, store user information in session
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['name'];
            $_SESSION['user_email'] = $user['email'];

            // Redirect to the dashboard or any other page
            header('Location: ../views/dashboard.php');
            exit();
        } else {
            // Invalid credentials, redirect back to login page with error
            header('Location: ../views/login.php?error=1');
            exit();
        }
    } catch (PDOException $e) {
        // Handle error (optional)
        echo "Error: " . $e->getMessage();
        exit();
    }
}
