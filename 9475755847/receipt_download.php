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
    <title>Application Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            width: 800px;
            margin: 20px auto;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .header img {
            max-height: 120px;
            max-width: 120px;
            position: absolute;
            top: 25%;
            left: 0;
        }
        .header h1 {
            margin: 10px 0 10px 60px; /* Added margin-left to create space for the logo */
            font-size: 24px;
            font-weight: normal;
        }
        .header p {
            margin: 5px 0 5px 60px; /* Added margin-left to create space for the logo */
            font-size: 14px;
        }
        .photo {
            position: absolute;
            top: 50%;
            right: 4%;
            width: 100px;
            height: 120px;
        }
        .section {
            margin-bottom: 20px;
            clear: both;
        }
        .section h2 {
            font-size: 18px;
            margin: 0 0 10px 0;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }
        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        .info-table th,
        .info-table td {
            padding: 8px 10px;
            border: 1px solid #ccc;
            text-align: left;
        }
        .info-table th {
            width: 20%;
            background-color: #f2f2f2;
            font-weight: 400;
        }
        .info-table td {
            width: 30%;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
        }
        .details-table th,
        .details-table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }
        .details-table th {
            background-color: #f2f2f2;
            font-weight: 400;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="Template/img/HOI_logo.png" alt="Logo" style="width:90px;height: auto;padding-left: 2%;">
            <h1 style="margin-left: 10%; margin-right: 7%;padding-top: 2%;">Diamond Harbour Bharat Sevasram Sangha Pranab Vidyapith</h1>
            <p>UDISE Code - 320873240676</p>
            <p>30, Mother Teresa Sarani, Kolkata - 700016, West Bengal</p>
            <p>Contact Mobile - 9475755847</p>
            <p>Email - contact@email.com</p>
            <div class="photo" style="display: flex; justify-content: center; align-items: center; margin-top: -4%;">
                <img src="9475755847/uploads/profile_image.jpeg" style="border: 2px solid rgb(168, 168, 168);">
            </div>
    </div>
        <div class="section">
            <h2>Application Receipt</h2>
            <table class="info-table">
                <tr>
                    <th>Registration No</th>
                    <td colspan="3">2180392</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>Suchibrata Patra</td>
                    <th>Year</th>
                    <td>2023/24</td>
                </tr>
                <tr>
                    <th>Father's Name</th>
                    <td>Kamal Kumar Patra</td>
                    <th>Mother's Name</th>
                    <td>Susmita Maity Patra</td>
                </tr>
                <tr>
                    <th>Ph.</th>
                    <td>9475755847</td>
                    <th>Email</th>
                    <td>Suchibratapatra2003@gmail.com</td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td>01/01/2003</td>
                    <th>Aadhar</th>
                    <td>32087324</td>
                </tr>
                <tr>
                    <th>Whatsapp</th>
                    <td>9475755847</td>
                    <th>Caste</th>
                    <td>General</td>
                </tr>
                <tr>
                    <th>Religion</th>
                    <td>Hindu</td>
                    <th>PWD</th>
                    <td>No</td>
                </tr>
                <tr>
                    <th>EWS</th>
                    <td colspan="3">No</td>
                </tr>
                <tr>
                    <th>Previous School</th>
                    <td colspan="3">Lorem ipsum dolor sit amet, consectetur adipiscing School</td>
                </tr>
            </table>
        </div>
        <div class="section">
            <h2>Marks Details</h2>
            <table class="details-table">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Bengali</th>
                        <th>English</th>
                        <th>Maths</th>
                        <th>Phy. Sc</th>
                        <th>Life Sc</th>
                        <th>Geography</th>
                        <th>History</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Obtained</td>
                        <td>98</td>
                        <td>95</td>
                        <td>100</td>
                        <td>100</td>
                        <td>95</td>
                        <td>99</td>
                        <td>94</td>
                    </tr>
                    <tr>
                        <td>Full Marks</td>
                        <td>100</td>
                        <td>100</td>
                        <td>100</td>
                        <td>100</td>
                        <td>100</td>
                        <td>100</td>
                        <td>100</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="section">
            <h2 style="color: #333;">Bank Details</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Bank Name:</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">State Bank of India</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Account No:</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">320810003578</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">IFSC:</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">320873240676</td>
                </tr>
            </table>
        </div>
        
        <div class="section">
            <h2 style="color: #333;">Application Details</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Stream</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">Science</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Language</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">Bengali + English</td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Combination</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">Maths + Coms + Stat + Physics</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;"></td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"></td>

                </tr>
            </table>
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
