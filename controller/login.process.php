<?php
session_start();
require_once '../config/connect.php';

if (isset($_POST['login'])) {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    // 1. Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    // 2. Verify existence and password
    if ($user && password_verify($password, $user['password'])) {
        // SUCCESS: Set session variables
        $_SESSION['name'] = $user['name'];
        $_SESSION['email'] = $user['email'];
        $_SESSION['role'] = $user['role'];

        // Redirect based on role
        // Note: JS Fetch will detect this 'redirected' status and move the browser
        if ($user['role'] === 'admin') {
            header("Location: ../admin/dashboard.php");
        } else {
            header("Location: ../user/dashboard.php");
        }
        exit();
    } else {
        // FAILURE: 
        // Instead of redirecting, we simply echo the error message.
        // The AJAX 'fetch' on your login page will receive this text.
        echo 'Incorrect Email or Password';
        exit();
    }
}

// Security: If accessed directly without POST
header("Location: ../index.php");
exit();
