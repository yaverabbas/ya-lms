<?php
session_start();
include '../includes/header.php';

// Fetch enrolled courses
$stmt = $pdo->prepare("SELECT c.id, c.title FROM ya_courses c 
                       JOIN ya_user_courses uc ON c.id = uc.course_id
                       WHERE uc.user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$enrolledCourses = $stmt->fetchAll();
?>

<!-- Display messages -->
<?php if (isset($_SESSION['enroll_message'])): ?>
    <div class="success message">
        <p><?php echo $_SESSION['enroll_message']; ?></p>
    </div>
    <?php unset($_SESSION['enroll_message']); // Clear the message after displaying it ?>
<?php endif; ?>

<?php if (isset($_SESSION['drop_message'])): ?>
    <div class="success message">
        <p><?php echo $_SESSION['drop_message']; ?></p>
    </div>
    <?php unset($_SESSION['drop_message']); // Clear the message after displaying it ?>
<?php endif; ?>

<h1>Your Enrolled Courses</h1>

<div class="my-courses">
    <?php if (empty($enrolledCourses)): ?>
        <p>You are not enrolled in any courses yet.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($enrolledCourses as $course): ?>
                <li>
                    <a class="enrolled-course" href="/ya-lms/views/course.php?id=<?php echo $course['id']; ?>">
                        <?php echo htmlspecialchars($course['title']); ?>
                    </a>
                    <!-- Add Drop Course Link -->
                    <a class="drop-course" href="/ya-lms/actions/drop_course.php?course_id=<?php echo $course['id']; ?>" onclick="return confirm('Are you sure you want to drop this course?');">Drop</a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
    <a href="/ya-lms/views/courses.php">Browse Available Courses</a>
</div>

<?php include '../includes/footer.php'; ?>
