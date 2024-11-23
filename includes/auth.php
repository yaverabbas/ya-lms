<?php
// Check if user is logged in
function isLoggedIn(): bool
{
    // Debugging: Check if the session variables are set
    if (isset($_SESSION['user_id'])) {
        error_log("Current User ID: " . $_SESSION['user_id']); // Log the user ID
        return true;
    } else {
        error_log("User is NOT logged in."); // Log if the user is not logged in
        return false;
    }
}
?>