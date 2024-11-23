<?php

// Define ya-lms root path
define('ROOT_PATH', dirname(__DIR__));

// Set up custom error log file in the 'ya-lms' folder
ini_set('log_errors', '1'); // Enable error logging
error_reporting(E_ALL); // Report all types of errors
ini_set('error_log', ROOT_PATH . '/debug.log');

// Check if logging is enabled and the path is correct
if (!ini_get('log_errors')) {
    error_log("Error logging is not enabled!");
}
//else {
//    error_log("\t\tLOGGING NEW MESSAGES");
//}

// Database configuration
const DB_HOST = 'localhost';
const DB_NAME = 'db_ya_lms';
const DB_USER = 'yvcmer';  // Replace with your MySQL username
const DB_PASS = 'u1%F$IV^rxK89QYg0cp61(D7';  // Replace with your MySQL password
const HEADER_FILE_PATH = ROOT_PATH . '/includes/header.php'; // Header file path
const FOOTER_FILE_PATH = ROOT_PATH . '/includes/footer.php'; // Footer file path
const DB_FILE_PATH = ROOT_PATH . '/config/db.php'; // Database file path
const PAGE_LOGIN = '/ya-lms/views/login.php'; // Login page URL
const PAGE_LOGOUT = '/ya-lms/views/logout.php'; // Logout page URL
const PAGE_REGISTRATION = '/ya-lms/views/register.php'; // Registration page URL
const PAGE_HOME = '/ya-lms/'; // Home page URL
const PAGE_DASHBOARD = '/ya-lms/views/dashboard.php'; // Dashboard page URL
const PAGE_COURSE = '/ya-lms/views/course.php'; // Course page URL
const PAGE_LESSON = '/ya-lms/views/lesson.php'; // Lesson page URL


?>
