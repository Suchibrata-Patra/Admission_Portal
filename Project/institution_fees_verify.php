<?php
session_start();
require 'session.php';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['paymentId'])) {
    $paymentId = $_POST['paymentId'];
    $email = $_SESSION['email'];

    // Update portal_fees_payment_done and portal_payment_id in the database
    $query = "UPDATE student_details SET instituion_fees_payment_done = 1, instituion_payment_id = '$paymentId' WHERE email = '$email'";
    $result = mysqli_query($db, $query);

    if ($result) {
        echo "Portal fees payment updated successfully.";
    } else {
        echo "Error updating portal fees payment.";
    }
} else {
    echo "Invalid request.";
}
?>
