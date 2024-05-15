<?php 
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'session.php';

// initializing variables
$username = "";
$email    = "";
$errors = array(); 

// Check if user is logged in
if (!isset($_SESSION['reg_no']) || !isset($_SESSION['email'])) {
    // Redirect user to login page or handle authentication error
    header('Location: login.php');
    exit(); // Stop further execution
}
// Initialize session variables
$reg_no = $_SESSION['reg_no'];
$email = $_SESSION['email'];

// Fetch user details from the database
$query = "SELECT * FROM student_details WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
$registration_no = $user['reg_no'];

// Check if form is submitted
if (isset($_POST['submit_documents'])) {
    // Receive and sanitize input values
    // Assuming $language_1, $language_2, $select_stream, and $sub_comb are received from the form
    $language_1 = mysqli_real_escape_string($db, $_POST['language_1']);
    $language_2 = mysqli_real_escape_string($db, $_POST['language_2']);
    $select_stream = mysqli_real_escape_string($db, $_POST['select_stream']);
    $sub_comb = mysqli_real_escape_string($db, $_POST['sub_comb']);

    // Update the specified variables in the database
    $update_query = "UPDATE student_details 
                     SET language_1 = '$language_1', 
                         language_2 = '$language_2', 
                         select_stream = '$select_stream', 
                         sub_comb = '$sub_comb'  
                     WHERE reg_no = '$registration_no'";
    $update_result = mysqli_query($db, $update_query);
    
    
    if ($update_result) {
        $_SESSION['success'] = "Marks updated successfully";
        header('Location: final_preview.php');
        exit(); // Stop further execution
    } else {
        header('Location: error.php');
        exit(); // Stop further execution
    }
}
?>
