<?php
session_start();

// Destroy session
session_unset();
session_destroy();

// Redirect to login page with a success message
session_start(); // Start a new session to store the logout message
$_SESSION['success'] = "You have logged out successfully.";

header("Location: index.php");
exit();
?>
