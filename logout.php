<?php
session_start(); // Start the session

// Check if the user is already logged in
if (!isset($_SESSION["login"])) {
    // Redirect to the login page if not logged in
    header("Location: login.php");
    exit();
}

// Clear all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page after logout
header("Location: index.html");
exit();
?>
