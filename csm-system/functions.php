<?php
session_start();
include 'db.php';

function registerUser($username, $email, $password) {
    global $conn;

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashedPassword);

    if ($stmt->execute()) {
        $stmt->close();
        return true;
    } else {
        $stmt->close();
        return false;
    }
}

function loginUser($username, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();
    
    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $dbUsername, $dbPassword);
        $stmt->fetch();

        if (password_verify($password, $dbPassword)) {
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $dbUsername;
            $_SESSION['success'] = "Welcome back, $dbUsername!";
            return true;
        }
    }

    return false;
}
?>
