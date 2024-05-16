<?php
// Include session.php or any other required files
require_once 'session.php';
require_once '/dompdf/vendor/autoload.php'; // Assuming you've installed dompdf using Composer

// Your database connection code here

// Fetch user details from the database
$query = "SELECT * FROM student_details WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

// Check if the form has been submitted
if (isset($_POST['submit'])) {
    // Generate PDF using dompdf
    $dompdf = new Dompdf\Dompdf();
    $html = '
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <!-- Your HTML head content here -->
    </head>
    <body>
        <!-- Your HTML body content here -->
    </body>
    </html>';

    $dompdf->loadHtml($html);
    $dompdf->setPaper('A4', 'portrait'); // Set paper size and orientation
    $dompdf->render();
    $dompdf->stream('student_profile.pdf', array('Attachment' => 0));
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Your HTML head content here -->
</head>
<body>
    <!-- Your HTML body content here -->
    <!-- Add your form here -->
    <form method="post">
        <!-- Your form fields here -->
        <button type="submit" name="submit">Download PDF</button>
    </form>
</body>
</html>
