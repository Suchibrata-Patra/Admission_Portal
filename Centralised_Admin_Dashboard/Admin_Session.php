<?php
session_start();
require_once "Secure_Admin_DataBase_Connection.php"; // Ensure this file contains the database connection

// Check if the user is not logged in
if (!isset($_SESSION['secure_admin_username'])) {
    $_SESSION['msg'] = "You must log in first";
    echo '<script>window.location.href="Admin_Login.php";</script>';
    exit(); // It's important to call exit() after header redirection
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['secure_admin_username']);
    echo '<script>window.location.href="Admin_Login.php";</script>';
    exit();
}
$table_name = 'Secure_Login_Stack';
// echo $table_name;

// Fetch user details from the database using a safer approach
$secure_admin_username = $_SESSION['secure_admin_username']; // Assuming email is already sanitized when saved in session
$query = "SELECT * FROM $table_name WHERE secure_admin_username = ?";

// Prepare statement to avoid SQL injection
if ($stmt = $db->prepare($query)) {
    $stmt->bind_param("s", $secure_admin_username); // 's' specifies the variable type => 'string'
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $reg_no = $user['secure_admin_username'];
        $_SESSION['secure_admin_username'] = $reg_no;
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
