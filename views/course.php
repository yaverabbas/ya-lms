<?php
// Include necessary files
include '../includes/header.php';  // Include header and necessary files

// Get the course ID from the URL
if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<p>Invalid course.</p>";
    exit();
}

$courseId = $_GET['id'];

// Fetch course details from the database
$stmt = $pdo->prepare("SELECT * FROM ya_courses WHERE id = :id");
$stmt->bindParam(':id', $courseId, PDO::PARAM_INT);
$stmt->execute();
$course = $stmt->fetch();

if (!$course) {
    echo "<p>Course not found.</p>";
    exit();
}

// Fetch lessons for the course
$stmt = $pdo->prepare("SELECT * FROM ya_lessons WHERE course_id = :course_id");
$stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
$stmt->execute();
$lessons = $stmt->fetchAll();

// Check if the user is logged in and enrolled in the course
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;
$isEnrolled = false;

if ($user_id) {
    $stmt = $pdo->prepare("SELECT * FROM ya_user_courses WHERE user_id = :user_id AND course_id = :course_id");
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':course_id', $courseId, PDO::PARAM_INT);
    $stmt->execute();
    $enrollment = $stmt->fetch();
    if ($enrollment) {
        $isEnrolled = true;
    }
}
?>

<h1><?php echo htmlspecialchars($course['title']); ?></h1>
<p><?php echo htmlspecialchars($course['description']); ?></p>

<div>
    <h2>Lessons</h2>
    <?php if (empty($lessons)): ?>
        <p>No lessons available for this course.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($lessons as $lesson): ?>
                <li class="lessons-list">
                    <h3 class="single-course-heading"><?php echo htmlspecialchars($lesson['title']); ?></h3>
                    <p class="single-course-content"><?php echo htmlspecialchars($lesson['content']); ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>

    <!-- Enrollment Button -->
    <?php if ($isEnrolled): ?>
        <!-- Button for enrolled user -->
        <button disabled>Start the Course</button>
    <?php else: ?>
        <!-- Enrollment form for not enrolled users -->
        <form action="../actions/enroll.php" method="POST">
            <input type="hidden" name="course_id" value="<?php echo $course['id']; ?>">
            <button type="submit">Enroll in this Course</button>
        </form>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?>
