<?php
// Include necessary files and database connection
require 'HOI_session.php'; // Adjust as per your session handling
require 'HOI_super_admin.php'; // Adjust as per your admin handling

// Ensure $student_table_name is properly defined (assuming $udise_code is set elsewhere)
$student_table_name = $udise_code . '_Student_Details';

// Check if the form is submitted and process the admission allow action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['allow_admission']) && isset($_POST['admission_allow']) && is_array($_POST['admission_allow'])) {
    // Sanitize and validate $_POST['admission_allow'] to prevent SQL injection
    $allowedStudents = array_map(function($value) use ($db) {
        return "'" . mysqli_real_escape_string($db, $value) . "'";
    }, $_POST['admission_allow']);

    if (!empty($allowedStudents)) {
        // Construct SQL update query
        $allowedStudentsList = implode(',', $allowedStudents);
        $updateQuery = "UPDATE $student_table_name SET is_Admission_Allowed = 1,Merit_List_No='1' WHERE reg_no IN ($allowedStudentsList)";

        // Execute query
        if (mysqli_query($db, $updateQuery)) {
            // Redirect to HOI_Short_Listing.php after successful update
            header("Location: HOI_Short_Listing.php");
            exit; // Ensure that code execution stops after redirection
        } else {
            echo "Error updating admission status: " . mysqli_error($db);
        }
    } else {
        echo "No students selected for admission.";
    }
} else {
    echo "Invalid request.";
}
?>
