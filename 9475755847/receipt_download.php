<?php
require 'database.php';
require 'session.php';
require 'super_admin.php';
require_once __DIR__ . '/../dompdf/vendor/autoload.php';
$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

//Extracting all the variable Names


use Dompdf\Dompdf;
use Dompdf\Options;
$dompdf = new Dompdf();

// HTML content that you want to convert to PDF
$html = '
<!DOCTYPE html>
<html>
<head>
    <title>Sample PDF</title>
</head>
<body>
    <h1>Hello, World!</h1>
    <span>' . $user['fname'] . '</span>
    <p>This is a sample PDF generated using Dompdf in PHP.</p>
</body>
</html>';


// Load HTML content into Dompdf
$dompdf->loadHtml($html);

// Set paper size and orientation (optional)
$dompdf->setPaper('A4', 'portrait');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to browser (optional: you can save it to a file as well)
$dompdf->stream("sample_pdf.pdf", array("Attachment" => false));
?>
