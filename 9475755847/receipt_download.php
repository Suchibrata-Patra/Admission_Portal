<?php
require 'database.php';
require 'session.php';
require 'super_admin.php';
require_once __DIR__ . '/../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$table_name = $udise_code . '_student_details';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';
// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Fetch the data
$sql = "SELECT * FROM $table_name WHERE `reg_no`= $user['reg_no']";
$result = $db->query($sql);

if ($result->num_rows > 0) {
    // Fetch the data
    $row = $result->fetch_assoc();

    // Prepare HTML content
    ob_start();
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Student Details</title>
        <style>
            body { font-family: Arial, sans-serif; }
            .container { width: 100%; margin: 0 auto; padding: 20px; }
            .header { text-align: center; margin-bottom: 20px; }
            .details { margin-bottom: 20px; }
            .details th, .details td { padding: 8px 12px; border: 1px solid #ddd; }
            .details th { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h2>Student Details</h2>
            </div>
            <table class="details">
                <tr><th>Registration No</th><td><?php echo $row['reg_no']; ?></td></tr>
                <tr><th>First Name</th><td><?php echo $row['fname']; ?></td></tr>
                <tr><th>Last Name</th><td><?php echo $row['lname']; ?></td></tr>
                <tr><th>Email</th><td><?php echo $row['email']; ?></td></tr>
                <tr><th>Phone Number</th><td><?php echo $row['phoneNumber']; ?></td></tr>
                <tr><th>Date of Birth</th><td><?php echo $row['dob']; ?></td></tr>
                <tr><th>Previous School Name</th><td><?php echo $row['previous_school_name']; ?></td></tr>
                <tr><th>Father's Name</th><td><?php echo $row['fathers_name']; ?></td></tr>
                <tr><th>Mother's Name</th><td><?php echo $row['mothers_name']; ?></td></tr>
                <tr><th>Current WhatsApp Number</th><td><?php echo $row['current_whatsapp_no']; ?></td></tr>
                <tr><th>Aadhar Card Number</th><td><?php echo $row['aadhar_card_no']; ?></td></tr>
                <tr><th>Religion</th><td><?php echo $row['student_religion']; ?></td></tr>
                <tr><th>Caste</th><td><?php echo $row['student_caste']; ?></td></tr>
                <tr><th>Village/Town</th><td><?php echo $row['student_village_town']; ?></td></tr>
                <tr><th>City</th><td><?php echo $row['student_city']; ?></td></tr>
                <tr><th>PIN Code</th><td><?php echo $row['student_pin_code']; ?></td></tr>
                <tr><th>Police Station</th><td><?php echo $row['student_police_station']; ?></td></tr>
                <tr><th>District</th><td><?php echo $row['student_district']; ?></td></tr>
                <tr><th>State</th><td><?php echo $row['student_state']; ?></td></tr>
            </table>
        </div>
    </body>
    </html>
    <?php
    $html = ob_get_clean();

    // Initialize Dompdf
    $options = new Options();
    $options->set('isHtml5ParserEnabled', true);
    $dompdf = new Dompdf($options);

    // Load HTML to Dompdf
    $dompdf->loadHtml($html);

    // (Optional) Setup the paper size and orientation
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    // Output the generated PDF (1 = download and 0 = preview)
    $dompdf->stream("student_details.pdf", array("Attachment" => 0));
} else {
    echo "No records found.";
}

$db->close();
?>
