<?php
session_start();
require 'session.php';
require 'super_admin.php';
 $table_name = $udise_code . '_Student_Details';
 echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
 echo 'Table name: ' . $table_name . '<br>';
// Maximum number of retries
$maxRetries = 3;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paymentId'])) {
    $paymentId = $_POST['paymentId'];
    $email = $_SESSION['email'];

    // Retry logic
    $retryCount = 0;
    $success = false;
    while (!$success && $retryCount < $maxRetries) {
        $query = "UPDATE $table_name SET portal_fees_payment_done = 1, portal_payment_id = '$paymentId' WHERE email = '$email'";
        $result = mysqli_query($db, $query);

        if ($result) {
            // Portal fees payment updated successfully
            $success = true;
            echo "Portal fees payment updated successfully.";
        } else {
            // Error updating portal fees payment, retry
            $retryCount++;
            usleep(500000); // Wait for 500ms before retrying (adjust as needed)
        }
    }

    if (!$success) {
        // All retries failed, handle the error
        echo "Error updating portal fees payment after $maxRetries retries.";
    }
} else {
    echo "Invalid request.";
}
?>
