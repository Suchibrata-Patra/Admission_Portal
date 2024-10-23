<?php
require 'HOI_Session.php';
require 'HOI_Super_Admin.php';

$student_table_name = $udise_code . '_Student_Details';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['allow_admission']) && isset($_POST['admission_allow']) && is_array($_POST['admission_allow'])) {
    // Sanitize and validate $_POST['admission_allow'] to prevent SQL injection
    $allowedStudents = array_map(function($value) use ($db) {
        return "'" . mysqli_real_escape_string($db, $value) . "'";
    }, $_POST['admission_allow']);

    if (!empty($allowedStudents)) {
        // Construct SQL update query
        $allowedStudentsList = implode(',', $allowedStudents);
        $updateQuery = "UPDATE $student_table_name SET is_Admission_Allowed = 0,Merit_List_No='1' WHERE reg_no IN ($allowedStudentsList)";

        // Execute query
        if (mysqli_query($db, $updateQuery)) {
            header("Location: HOI_Final_List.php");
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