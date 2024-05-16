2<?php
session_start();
require 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paymentId'])) {
    $paymentId = $_POST['paymentId'];
    $email = $_SESSION['email'];
    $query = "UPDATE student_details SET institution_fees_payment_done = 1, institution_fees_payments_ID='$paymentId' WHERE email = '$email'";
    $result = mysqli_query($db, $query);

    if($result) {
        // Payment verification successful, you can echo any response if needed
        echo "Payment verification successful!";
    } else {
        // Payment verification failed, you can echo any error response if needed
        echo "Error: Payment verification failed!";
    }
} else {
    // If paymentId is not set or empty, redirect the user back to the payment page
    header("Location: payment_details.php");
    exit();
}
?>
