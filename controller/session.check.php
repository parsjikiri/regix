<?php
// 1. Define the session duration (e.g., 7 days for better user experience)
// 1 hour = 3600 | 24 hours = 86400 | 7 days = 604800
$timeout = 604800;

// 2. Set the cookie parameters BEFORE session_start
// This is the 'key' to keeping the user logged in after closing the browser
session_set_cookie_params([
    'lifetime' => $timeout,
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => false, // Set to true if using HTTPS
    'httponly' => true,
    'samesite' => 'Lax'
]);

// 3. Ensure the server doesn't clean up the session file too early
ini_set('session.gc_maxlifetime', $timeout);

session_start();

// 4. Handle Inactivity Disconnect (Logic for the "Open Token")
// If the user is inactive for more than 1 hour while the browser is OPEN, disconnect them.
$inactivity_limit = 3600;

if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactivity_limit)) {
    session_unset();
    session_destroy();
    header("Location: ../index.php?reason=timeout");
    exit();
}

// Update timestamp only if they are actively clicking/reloading
$_SESSION['last_activity'] = time();

// 5. Standard Login Check
if (!isset($_SESSION['email'])) {
    header("Location: ../index.php");
    exit();
}

$userName = $_SESSION['name'];
$userEmail = $_SESSION['email'];
$userRole = $_SESSION['role'];
