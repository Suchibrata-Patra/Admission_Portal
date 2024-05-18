<?php 
require 'session.php';
require 'super_admin.php';
ob_start();  // Start buffering the output

$table_name = $udise_code . '_student_details';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Check if user is logged in
if (!isset($_SESSION['reg_no']) || !isset($_SESSION['email'])) {
    header('Location: login.php');
    exit(); // Stop further execution
}

$reg_no = $_SESSION['reg_no'];
$email = $_SESSION['email'];

$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
$registration_no = $user['reg_no'];

// Check if form is submitted
if (isset($_POST['submit_marks'])) {
    // Receive and sanitize input values
    $bengali_marks = mysqli_real_escape_string($db, $_POST['bengali_marks']);
    $bengali_full_marks = mysqli_real_escape_string($db, $_POST['bengali_full_marks']);
    $english_marks = mysqli_real_escape_string($db, $_POST['english_marks']);
    $english_full_marks = mysqli_real_escape_string($db, $_POST['english_full_marks']);
    $mathematics_marks = mysqli_real_escape_string($db, $_POST['mathematics_marks']);
    $mathematics_full_marks = mysqli_real_escape_string($db, $_POST['mathematics_full_marks']);
    $physical_science_marks = mysqli_real_escape_string($db, $_POST['physical_science_marks']);
    $physical_science_full_marks = mysqli_real_escape_string($db, $_POST['physical_science_full_marks']);
    $life_science_marks = mysqli_real_escape_string($db, $_POST['life_science_marks']);
    $life_science_full_marks = mysqli_real_escape_string($db, $_POST['life_science_full_marks']);
    $history_marks = mysqli_real_escape_string($db, $_POST['History_marks']);
    $history_full_marks = mysqli_real_escape_string($db, $_POST['History_full_marks']);
    $geography_marks = mysqli_real_escape_string($db, $_POST['geography_marks']);
    $geography_full_marks = mysqli_real_escape_string($db, $_POST['geography_full_marks']);

    // Validation: Check if obtained marks are less than or equal to full marks
    if ($bengali_marks > $bengali_full_marks || $english_marks > $english_full_marks || $mathematics_marks > $mathematics_full_marks || $physical_science_marks > $physical_science_full_marks || $life_science_marks > $life_science_full_marks || $history_marks > $history_full_marks || $geography_marks > $geography_full_marks) {
        // Redirect with error message if validation fails
        header("Location: marks_details.php?error=Obtained marks cannot exceed full marks");
        exit();
    }

# Check if Data is empty or not
# Check if Data is empty or not
if (empty($bengali_marks)) { 
    array_push($errors, "Bengali marks are required");
    header("location: marks_details.php?error=Bengali marks are required"); 
}
if (empty($bengali_full_marks)) { 
    array_push($errors, "Bengali full marks are required");
    header("location: marks_details.php?error=Bengali full marks are required"); 
}
if (empty($english_marks)) { 
    array_push($errors, "English marks are required");
    header("location: marks_details.php?error=English marks are required"); 
}
if (empty($english_full_marks)) { 
    array_push($errors, "English full marks are required");
    header("location: marks_details.php?error=English full marks are required"); 
}
if (empty($mathematics_marks)) { 
    array_push($errors, "Mathematics marks are required");
    header("location: marks_details.php?error=Mathematics marks are required"); 
}
if (empty($mathematics_full_marks)) { 
    array_push($errors, "Mathematics full marks are required");
    header("location: marks_details.php?error=Mathematics full marks are required"); 
}
if (empty($physical_science_marks)) { 
    array_push($errors, "Physical Science marks are required");
    header("location: marks_details.php?error=Physical Science marks are required"); 
}
if (empty($physical_science_full_marks)) { 
    array_push($errors, "Physical Science full marks are required");
    header("location: marks_details.php?error=Physical Science full marks are required"); 
}
if (empty($life_science_marks)) { 
    array_push($errors, "Life Science marks are required");
    header("location: marks_details.php?error=Life Science marks are required"); 
}
if (empty($life_science_full_marks)) { 
    array_push($errors, "Life Science full marks are required");
    header("location: marks_details.php?error=Life Science full marks are required"); 
}
if (empty($history_marks)) { 
    array_push($errors, "History marks are required");
    header("location: marks_details.php?error=History marks are required"); 
}
if (empty($history_full_marks)) { 
    array_push($errors, "History full marks are required");
    header("location: marks_details.php?error=History full marks are required"); 
}
if (empty($geography_marks)) { 
    array_push($errors, "Geography marks are required");
    header("location: marks_details.php?error=Geography marks are required"); 
}
if (empty($geography_full_marks)) { 
    array_push($errors, "Geography full marks are required");
    header("location: marks_details.php?error=Geography full marks are required"); 
}

    // Update marks details in the database
    $update_query = "UPDATE $table_name 
                     SET bengali_marks = '$bengali_marks', 
                         bengali_full_marks = '$bengali_full_marks', 
                         english_marks = '$english_marks', 
                         english_full_marks = '$english_full_marks', 
                         mathematics_marks = '$mathematics_marks', 
                         mathematics_full_marks = '$mathematics_full_marks', 
                         physical_science_marks = '$physical_science_marks', 
                         physical_science_full_marks = '$physical_science_full_marks', 
                         life_science_marks = '$life_science_marks', 
                         life_science_full_marks = '$life_science_full_marks', 
                         history_marks = '$history_marks', 
                         history_full_marks = '$history_full_marks', 
                         geography_marks = '$geography_marks', 
                         geography_full_marks = '$geography_full_marks' 
                     WHERE reg_no = '$registration_no'";
    $update_result = mysqli_query($db, $update_query);

   if ($update_result) {
        $_SESSION['success'] = "Marks updated successfully";
        header('Location: personal_details.php');
        exit();
    } else {
        header('Location:marks_details.php');
    }
}

ob_end_flush();  // Send the buffered output
?>