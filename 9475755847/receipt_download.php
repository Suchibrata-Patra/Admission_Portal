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
<title>Admission Receipt</title>
<style>
  body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #fff;
  }
  
  .container {
    width: 88.5%;
    height: auto;
    margin: auto;
    padding: 40px;
    box-sizing: border-box;
    border: 1px solid #000;
  }
  
  table {
    width: 88%;
    border-collapse: collapse;
  }
   
  th, td {
    padding: 15px;
    border-bottom: 1px solid #000;
  }
  
  th {
    text-align: left;
  }
  
  h1 {
    text-align: center;
    color: #000;
    margin-bottom: 20px;
  }
  
  .total {
    margin-top: 20px;
    float: right;
    font-weight: bold;
    color: #000;
  }
  
  .footer {
    margin-top: 20px;
    text-align: center;
    font-size: 14px;
    color: #888;
  }
</style>
</head>
<body>
<div class="container">
  <h1>Admission Receipt</h1>
  <table>
    <tr>
      <th>Student Name:</th>
      <td>John Doe</td>
    </tr>
    <tr>
      <th>Admission Number:</th>
      <td>ABC123456</td>
    </tr>
    <tr>
      <th>Date:</th>
      <td>May 28, 2024</td>
    </tr>
    <tr>
      <th>Program:</th>
      <td>Bachelor of Science in Computer Science</td>
    </tr>
    <tr>
      <th>Amount Paid:</th>
      <td>$5000.00</td>
    </tr>
    <tr>
      <th>Payment Method:</th>
      <td>Credit Card</td>
    </tr>
    <tr>
      <th>Transaction ID:</th>
      <td>1234567890</td>
    </tr>
    <tr>
      <th>Receipt ID:</th>
      <td>9876543210</td>
    </tr>
    <tr>
      <th>Term Start Date:</th>
      <td>September 1, 2024</td>
    </tr>
    <tr>
      <th>Term End Date:</th>
      <td>June 30, 2025</td>
    </tr>
    <tr>
      <th>Payment Deadline:</th>
      <td>August 15, 2024</td>
    </tr>
    <tr>
      <th>Payment Status:</th>
      <td>Paid</td>
    </tr>
    <tr>
      <th>Additional Notes:</th>
      <td>This is a sample receipt template.</td>
    </tr>
  </table>
  <div class="total">Total: $5000.00</div>
  <div class="footer">
    <p>Thank you for choosing our institution!</p>
  </div>
</div>
</body>
</html>
';

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
