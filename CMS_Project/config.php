<?php
session_start(); // Start the session

// Define constants for database connection
define('DB_HOST', 'localhost'); // Database host
define('DB_NAME', 'cms_project'); // Database name
define('DB_USER', 'root'); // Database username
define('DB_PASS', ''); // Database password

// Function to check if a user is logged in
function isLoggedIn() {
    return isset($_SESSION['user_id']);
}

// Function to redirect to a specific page
function redirect($url) {
    header("Location: $url");
    exit();
}
?>
