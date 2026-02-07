<?php
session_start();
require_once '../config/connect.php';

if (isset($_POST['register'])) {
    // 1. Sanitize and Validate Inputs
    $name     = trim(filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS));
    $email    = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $role     = $_POST['role']; // Ensure your HTML select only allows specific roles
    $password = $_POST['password'];
    $confirm  = $_POST['confirm_password'];

    // Check for empty fields or invalid email
    if (!$name || !$email || empty($password)) {
        $_SESSION['register_error'] = 'All fields are required and email must be valid.';
        header("Location: ../register.php");
        exit();
    }

    // 2. Password Match Check
    if ($password !== $confirm) {
        $_SESSION['register_error'] = 'Passwords do not match!';
        header("Location: ../register.php");
        exit();
    }

    // 3. Password Complexity (Optional but recommended)
    if (strlen($password) < 8) {
        $_SESSION['register_error'] = 'Password must be at least 8 characters long.';
        header("Location: ../register.php");
        exit();
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // 4. Check if email exists
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ? LIMIT 1");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $_SESSION['register_error'] = 'Email is already registered!';
        header("Location: ../register.php");
        exit();
    }

    $stmt->close(); // Close the first statement

    // 5. Attempt to Insert
    $insert = $conn->prepare("INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)");
    $insert->bind_param("ssss", $name, $email, $hashed_password, $role);

    if ($insert->execute()) {
        $_SESSION['register_success'] = 'Registration successful! Please log in.';
        header("Location: ../login.php");
        exit();
    } else {
        error_log($insert->error); // Log the error for the developer, don't show it to the user
        $_SESSION['register_error'] = 'An internal error occurred. Please try again later.';
        header("Location: ../register.php");
        exit();
    }
}
