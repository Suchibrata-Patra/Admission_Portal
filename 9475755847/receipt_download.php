<?php
require 'database.php';
require 'session.php';
require 'super_admin.php';
require_once __DIR__ . '/../dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

$dompdf = new Dompdf();

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
    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTOynYhzPBCpR9F2AQlIqBe7yU_LYFAHSpGGCYCyTmd_g&s" alt="Your Image" style="width: 200px; height: auto;">
</body>
</html>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');

// Try to render PDF
try {
    $dompdf->render();
} catch (\Exception $e) {
    // Handle rendering errors
    echo 'Error rendering PDF: ' . $e->getMessage();
    exit;
}

// Output the generated PDF to browser
$dompdf->stream("sample_pdf.pdf", array("Attachment" => false));
?>
