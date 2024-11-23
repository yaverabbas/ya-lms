<?php
// Include necessary files
include '../includes/header.php'; // Header

// Fetch all available courses from the ya_courses table
try {
    $stmt = $pdo->prepare("SELECT * FROM ya_courses");
    $stmt->execute();
    $courses = $stmt->fetchAll();
} catch (PDOException $e) {
    error_log("Error fetching courses: " . $e->getMessage());
    $courses = [];
}
?>

<div class="container">
    <h1>Available Courses</h1>

    <?php if (empty($courses)): ?>
        <p>No courses available at the moment. Please check back later.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($courses as $course): ?>
                <li>
                    <a href="/ya-lms/views/course.php?id=<?php echo $course['id']; ?>">
                        <?php echo htmlspecialchars($course['title']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; // Footer ?>
