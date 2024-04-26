<?php
// Start session
session_start();

// Function to check if the user is logged in
function check_login() {
    // Check if email session variable is set
    if (isset($_SESSION['username'])) {
        // User is logged in
        return true;
    } else {
        // User is not logged in
        return false;
    }
}

// Usage example:
if (check_login()) {
    // User is logged in, proceed with the content
   //echo "Welcome, ".$_SESSION['name']."!";
} else {
    // Redirect to login page or show an error message
    header("Location: login.php");
    exit();
}
?>

