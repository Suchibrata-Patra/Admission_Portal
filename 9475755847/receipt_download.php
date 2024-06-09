<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
require 'database.php'; 
require 'session.php';
require 'super_admin.php';
require_once __DIR__ . '/../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$table_name = $udise_code . '_student_details';

// Fetch user details from the database
$query = "SELECT * FROM $table_name WHERE email='" . mysqli_real_escape_string($db, $email) . "'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

// Check if user's number is verified, if not, redirect to verify.php
if ($user['issubmitted'] != 1) {
    header('location: payment_details.php');
    exit; // Add exit to stop further execution
} 

// Handle form submission
if (isset($_POST['submit'])) {
    // Sanitize input
    $reg_no = mysqli_real_escape_string($db, $_POST['reg_no']);
    $updateQuery = "UPDATE $table_name SET issubmitted = 1 WHERE reg_no = '$reg_no'";
    $update_result = mysqli_query($db, $updateQuery);
}

// Include and execute the file to generate HTML content
ob_start();
include 'generate_html.php';
$htmlContent = ob_get_clean();

// Create a PDF document using dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isFontSubsettingEnabled', true);
$options->set('isRemoteEnabled', true); // Enable remote URLs

$dompdf = new Dompdf($options);
$currentTimestamp = date("YmdHis");

// Load HTML content into dompdf
$dompdf->loadHtml($htmlContent);

// Set paper size (A4)
$dompdf->setPaper('A4', 'portrait');

// Render PDF (first pass to get total pages)
$dompdf->render();

// Provide a download link
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="student_details.pdf"');
echo $dompdf->output();
?>
