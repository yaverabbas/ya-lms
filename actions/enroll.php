<?php
session_start();
include '../config/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ' . PAGE_LOGIN);  // Redirect to the login page if not logged in
    exit();
}

// Enroll the user in the selected course
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user_id'];
    $course_id = $_POST['course_id'];

    // Check if the user is already enrolled in the course
    $stmt = $pdo->prepare("SELECT * FROM ya_user_courses WHERE user_id = ? AND course_id = ?");
    $stmt->execute([$user_id, $course_id]);
    $existingEnrollment = $stmt->fetch();

    // If the user is already enrolled, redirect to the dashboard with a message
    if ($existingEnrollment) {
        // Get the course name for the message
        $stmt = $pdo->prepare("SELECT title FROM ya_courses WHERE id = ?");
        $stmt->execute([$course_id]);
        $course = $stmt->fetch();

        // Store the message in the session
        $_SESSION['enroll_message'] = "You are already enrolled in '" . $course['title'] . "'.";

        // Redirect to the dashboard
        header('Location: ' . PAGE_DASHBOARD);
        exit();
    }

    // Insert the user-course enrollment into the database
    $stmt = $pdo->prepare("INSERT INTO ya_user_courses (user_id, course_id) VALUES (?, ?)");
    $stmt->execute([$user_id, $course_id]);
    // Get the course name for the message
    $stmt = $pdo->prepare("SELECT title FROM ya_courses WHERE id = ?");
    $stmt->execute([$course_id]);
    $course = $stmt->fetch();

    // Store the message in the session
    $_SESSION['enroll_message'] = "You are successfully enrolled in '" . $course['title'] . "'.";

    // Redirect to the dashboard
    header('Location: ' . PAGE_DASHBOARD);
    exit();
}
?>
