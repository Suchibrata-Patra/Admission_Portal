<?php
session_start();
require_once "database.php"; // Ensure this file contains the database connection
require "HOI_super_admin.php";
// Check if the user is not logged in
if (!isset($_SESSION['udiseid'])) {
    $_SESSION['msg'] = "You must log in first";
    echo '<script>window.location.href="HOI_Login.php";</script>';
    exit(); // It's important to call exit() after header redirection
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['udiseid']);
    echo '<script>window.location.href="HOI_Login.php";</script>';
    exit();
}
$table_name = $udise_code . '_HOI_Login_Credentials';
// echo $table_name;

// Fetch user details from the database using a safer approach
$udiseid = $_SESSION['udiseid']; // Assuming email is already sanitized when saved in session
$query = "SELECT * FROM $table_name WHERE HOI_UDISE_ID = ?";

// Prepare statement to avoid SQL injection
if ($stmt = $db->prepare($query)) {
    $stmt->bind_param("s", $udiseid); // 's' specifies the variable type => 'string'
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user) {
        $reg_no = $user['HOI_UDISE_ID'];
        $_SESSION['HOI_UDISE_ID'] = $reg_no;
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
