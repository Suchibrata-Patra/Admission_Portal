<?php
session_start();
require 'session.php';
require 'super_admin.php';
 $table_name = $udise_code . '_student_details';
 echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
 echo 'Table name: ' . $table_name . '<br>';

// Maximum number of retries
$maxRetries = 3;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['paymentId'])) {
        $paymentId = $_POST['paymentId'];
        $email = $_SESSION['email'];

        // Retry logic
        $retryCount = 0;
        $success = false;
        while (!$success && $retryCount < $maxRetries) {
            $query = "UPDATE $table_name SET institution_fees_payment_done = 1, institution_fees_payments_ID='$paymentId' WHERE email = '$email'";
            $result = mysqli_query($db, $query);

            if ($result) {
                // Payment verification successful
                $success = true;
                echo "Payment verification successful!";
            } else {
                // Payment verification failed, retry
                $retryCount++;
                usleep(500000); // Wait for 500ms before retrying (adjust as needed)
            }
        }

        if (!$success) {
            // All retries failed, handle the error
            echo "Error: Payment verification failed after $maxRetries retries!";
        }
    } else {
        // If paymentId is not set or empty, redirect the user back to the payment page
        header("Location: payment_details.php");
        exit();
    }
} else {
    // If request method is not POST, redirect the user back to the payment page
    header("Location: payment_details.php");
    exit();
}
?>