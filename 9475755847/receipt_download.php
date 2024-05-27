<?php
require 'database.php';
require 'session.php';
require 'super_admin.php';
require_once __DIR__ . '/../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$table_name = $udise_code . '_student_details';

// Fetch user details from the database
$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

// Check if user's number is verified, if not, redirect to verify.php
if ($user['issubmitted'] == 0) {
    header('location: payment_details.php');
    exit; // Add exit to stop further execution
} 

$registration_no = $user['reg_no'];
// Calculate total and obtained marks
$total_marks = ($user['bengali_full_marks'] + $user['english_full_marks'] + $user['mathematics_full_marks'] + $user['physical_science_full_marks'] + $user['life_science_full_marks'] + $user['history_full_marks'] + $user['geography_full_marks']);
$obtained_marks = ($user['bengali_marks'] + $user['english_marks'] + $user['mathematics_marks'] + $user['physical_science_marks'] + $user['life_science_marks'] + $user['history_marks'] + $user['geography_marks']);

// Handle form submission
if (isset($_POST['submit'])) {
    $updateQuery = "UPDATE $table_name SET issubmitted = 1 WHERE reg_no = '$reg_no'";
    $update_result = mysqli_query($db, $updateQuery);

    if ($update_result) {
        $_SESSION['success'] = "Marks updated successfully";
        header('Location: payment_details.php');
        exit;
    } else {
        header('Location: error.php');
        exit;
    }
}

// Create a PDF document using dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isFontSubsettingEnabled', true);
$options->set('isRemoteEnabled', true); // Enable remote URLs

$dompdf = new Dompdf($options);
$currentTimestamp = date("YmdHis");

// Build HTML content with fetched data
$htmlContent = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details</title>
</head>
<body>
    <h1>Student Details</h1>
    <p>Registration Number: ' . $registration_no . '</p>
    <p>Total Marks: ' . $total_marks . '</p>
    <p>Obtained Marks: ' . $obtained_marks . '</p>
    <p>First Name '.$user['fname'].'</p>
    <!-- Add more data fields here as needed -->
</body>
</html>';

// Load HTML content into dompdf
$dompdf->loadHtml($htmlContent);

// Set paper size (A4)
$dompdf->setPaper('A4', 'portrait');

// Render PDF (first pass to get total pages)
$dompdf->render();

// Save the PDF to a file
$pdfOutput = $dompdf->output();
file_put_contents('student_details.pdf', $pdfOutput);

// Provide a download link
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="student_details.pdf"');
readfile('student_details.pdf');
?>
