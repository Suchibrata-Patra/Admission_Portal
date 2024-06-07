<?php
// Set error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Start session
session_start();

// Include necessary files
require_once 'database.php';
require 'super_admin.php';

// Set table name
$table_name = $udise_code . '_student_details';

// Start output buffering
ob_start();

// Display school information
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';

// Array to store errors
$errors = [];

// Check if registration form is submitted
if (isset($_POST['reg_user'])) {
    // Sanitize input data
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $phoneNumber = mysqli_real_escape_string($db, $_POST['phoneNumber']);
    $reg_no = mysqli_real_escape_string($db, $_POST['reg_no']);

    // Check if user exists
    $user_check_query = "SELECT * FROM $table_name WHERE email='$email' LIMIT 1";
    $result = mysqli_query($db, $user_check_query);
    $user = mysqli_fetch_assoc($result);

    if ($user) { // if user exists
        if ($user['email'] === $email || $user['reg_no'] === $reg_no || $user['phoneNumber'] === $phoneNumber) {
            // Display form for entering email OTP
            echo '<form method="post" action="" onsubmit="event.preventDefault(); sendEmailOTP();">
                    <input type="submit" value="Send Email OTP">
                </form>';
            echo '<div id="otp_status"></div>';

            // Process form submission for verifying email OTP
            if (isset($_POST['verify_email_otp'])) {
                $email_otp = mysqli_real_escape_string($db, $_POST['email_otp']);

                if ($email_otp === $user['Forgot_Password_Otp']) {
                    // Display form for new password
                    echo '<form method="post" action="">
                            <label for="new_password">New Password:</label>
                            <input type="password" id="new_password" name="new_password" required><br>
                            <label for="email_otp">Email OTP:</label>
                            <input type="text" id="email_otp" name="email_otp" required><br>
                            <input type="submit" name="update_password" value="Update Password">
                        </form>';
                } else {
                    echo "Email OTP doesn't match!";
                }
            }

            // Process form submission for password update
            if (isset($_POST['update_password'])) {
                $new_password = mysqli_real_escape_string($db, $_POST['new_password']);
                // Update password query
                $update_query = "UPDATE $table_name SET password='$new_password' WHERE email='$email'";
                mysqli_query($db, $update_query);
                echo "Password updated successfully!";
            }
        }
    }
}
?>
