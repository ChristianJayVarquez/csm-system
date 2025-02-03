<?php
session_start();
include 'functions.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (loginUser($username, $password)) {
        header("Location: home.php");
        exit();
    } else {
        $_SESSION['error'] = "Invalid credentials. Please try again.";
        header("Location: index.php");
        exit();
    }
}
?>
