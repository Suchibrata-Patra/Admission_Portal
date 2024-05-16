<?php 
require_once('dompdf/vendor/autoload.php');
use Dompdf\Dompdf;

// Fetch user details from the database
$query = "SELECT * FROM student_details WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);


$fname = $user['fname'];
$dompdf = new Dompdf();
$html ='<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<div class="container">
    This is hello
</div>

</body>
</html>';
$dompdf->loadHtml($html); // Corrected typo here
$dompdf->setPaper('A4','porttait');
$dompdf->render();
$dompdf->stream();
?>
