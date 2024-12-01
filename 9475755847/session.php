<?php
session_start([
    'cookie_lifetime' => 3600, // 1 Hour
    'cookie_secure' => true,    // Only send the cookie over HTTPS
    'cookie_httponly' => true,  // Accessible only through the HTTP protocol
    'cookie_samesite' => 'Strict', // CSRF protection
    'use_strict_mode' => true,  // Prevent session fixation
    'use_only_cookies' => true, // Force sessions to only use cookies
]);

require_once "database.php"; // Ensure this file contains the database connection
require "super_admin.php";

// Check if the user is not logged in
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
    exit(); // It's important to call exit() after header redirection
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['email']);
    header("location: login.php");
    exit();
}

// Regenerate session ID after login to prevent session fixation
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Optionally, you can regenerate the session ID periodically
if (!isset($_SESSION['last_regenerate'])) {
    $_SESSION['last_regenerate'] = time();
} elseif (time() - $_SESSION['last_regenerate'] > 600) { // Regenerate every 10 minutes
    session_regenerate_id(true);
    $_SESSION['last_regenerate'] = time();
}

// Validate the session to prevent hijacking
if (!isset($_SESSION['IPaddress'])) {
    $_SESSION['IPaddress'] = $_SERVER['REMOTE_ADDR'];
}
if (!isset($_SESSION['userAgent'])) {
    $_SESSION['userAgent'] = $_SERVER['HTTP_USER_AGENT'];
}

if ($_SESSION['IPaddress'] != $_SERVER['REMOTE_ADDR'] || $_SESSION['userAgent'] != $_SERVER['HTTP_USER_AGENT']) {
    session_unset();
    session_destroy();
    header('location: login.php');
    exit();
}

$table_name = $udise_code . '_Student_Details';

// Fetch user details from the database using a safer approach
$email = $_SESSION['email']; // Assuming email is already sanitized when saved in session
$query = "SELECT * FROM $table_name WHERE email = ?";

// Prepare statement to avoid SQL injection
if ($stmt = $db->prepare($query)) {
    $stmt->bind_param("s", $email); // 's' specifies the variable type => 'string'
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $reg_no = $user['reg_no'];
        
        // Store reg_no in session
        $_SESSION['reg_no'] = $reg_no;
    } else {
        // Handle case where no user data is found
        echo "No user found.";
    }

    $stmt->close();
} else {
    // Error in preparing the statement
    echo "Database query failed: " . $db->error;
}
?>