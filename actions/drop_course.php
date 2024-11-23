<?php
// Include necessary files
include '../includes/header.php';

// Check if the user is logged in
if (!isLoggedIn()) {
    header('Location: ' . PAGE_LOGIN);
    exit();
}

// Check if course_id is provided in the URL
if (isset($_GET['course_id'])) {
    $course_id = $_GET['course_id'];

    try {
        // Prepare the SQL query to delete the user's enrollment for the course
        $stmt = $pdo->prepare("DELETE FROM ya_user_courses WHERE user_id = :user_id AND course_id = :course_id");
        $stmt->bindParam(':user_id', $_SESSION['user_id']);
        $stmt->bindParam(':course_id', $course_id);
        $stmt->execute();

        // Fetch the course details
        $stmt = $pdo->prepare("SELECT title FROM ya_courses WHERE id = ?");
        $stmt->execute([$course_id]);
        $course = $stmt->fetch();

        // Set a success message
        $_SESSION['drop_message'] = 'You have successfully dropped <span style="color:black;">' . $course['title'] . '</span> course.';
        // Redirect to the dashboard with a success message
        header('Location: ' . PAGE_DASHBOARD);
        exit();
    } catch (PDOException $e) {
        // Log the error and display an error message
        error_log("Error dropping course: " . $e->getMessage());

        // Set an error message
        $_SESSION['drop_message'] = 'An error occurred while dropping the course. Please try again.';

        header('Location: ' . PAGE_DASHBOARD);
        exit();
    }
} else {
    // If no course_id is provided, redirect back to the dashboard
    header('Location: ' . PAGE_DASHBOARD);
    exit();
}
?>
