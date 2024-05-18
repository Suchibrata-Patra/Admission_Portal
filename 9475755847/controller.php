<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();  // Initiate session at the very top to avoid 'headers already sent' issues


require_once 'database.php';  // Include database connection
require 'super_admin.php';    // Assuming this sets $udise_code

$table_name = $udise_code . '_student_details';

// Start buffering output to manage header redirections later
ob_start();

echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';

$errors = array();

if (isset($_POST['reg_user'])) {
    // Collect input from form and sanitize
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    $countryCode = filter_input(INPUT_POST, 'countryCode', FILTER_SANITIZE_STRING);
    $phoneNumber = filter_input(INPUT_POST, 'phoneNumber', FILTER_SANITIZE_STRING);
    $dob = filter_input(INPUT_POST, 'dob', FILTER_SANITIZE_STRING);
    $terms = filter_input(INPUT_POST, 'terms', FILTER_SANITIZE_STRING);
    $reg_no = filter_input(INPUT_POST, 'reg_no', FILTER_SANITIZE_STRING);

    // Basic input validation
    if (empty($fname)) { $errors[] = "First name is required"; }
    if (empty($lname)) { $errors[] = "Last name is required"; }
    if (empty($email)) { $errors[] = "Email is required"; }
    if (empty($password)) { $errors[] = "Password is required"; }
    if (empty($countryCode)) { $errors[] = "Country Code is required"; }
    if (empty($phoneNumber)) { $errors[] = "Phone number is required"; }
    if (empty($dob)) { $errors[] = "Date of birth is required"; }
    if (empty($terms)) { $errors[] = "Acceptance of terms is required"; }

    // Check if there are no errors before querying the database
    if (empty($errors)) {
        // Database query to check if the user already exists
        $stmt = $db->prepare("SELECT email, reg_no, phoneNumber FROM $table_name WHERE email = ? OR reg_no = ? OR phoneNumber = ?");
        $stmt->bind_param("sss", $email, $reg_no, $phoneNumber);
        $stmt->execute();
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            while ($user = $result->fetch_assoc()) {
                if ($user['email'] === $email) {
                    $errors[] = "Email already exists";
                }
                if ($user['reg_no'] === $reg_no) {
                    $errors[] = "Registration number already registered";
                }
                if ($user['phoneNumber'] === $phoneNumber) {
                    $errors[] = "Mobile number already registered";
                }
            }
        }

        if (empty($errors)) {
            // Encrypt password
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            // Insert new user into the database
            $stmt = $db->prepare("INSERT INTO $table_name (reg_no, fname, lname, email, phoneNumber, dob, terms, password) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssss", $reg_no, $fname, $lname, $email, $phoneNumber, $dob, $terms, $passwordHash);
            $stmt->execute();

            $_SESSION['email'] = $email;
            $_SESSION['success'] = "You are now logged in";
            header('Location: welcome.php');
            exit;
        }
    }

    // If there are errors, redirect back to the form with errors
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;  // Store errors in session to show them in the form later
        header('Location: signup.php');
        exit;
    }
}

// Flush the output buffer and turn off output buffering
ob_end_flush();
?>
