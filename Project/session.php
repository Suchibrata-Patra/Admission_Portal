<?php
session_start();

require_once "database.php"; // Ensure this file contains the database connection

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

// Fetch user details from the database using a safer approach
$email = $_SESSION['email']; // Assuming email is already sanitized when saved in session
$query = "SELECT * FROM student_details WHERE email = ?";

// Prepare statement to avoid SQL injection
if ($stmt = $db->prepare($query)) {
    $stmt->bind_param("s", $email); // 's' specifies the variable type => 'string'
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        // User details fetched successfully
        // You can now use $user['fieldname'] to access user details
    } else {
        // Handle case where no user data is found
        echo "No user found.";
    }

    $stmt->close();
} else {
    // Error in preparing the statement
    echo "Database query failed: " . $db->error;
}

// Proceed with further processing, if needed
?>