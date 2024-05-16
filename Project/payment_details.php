<?php
session_start();
require 'session.php';

// Process form submission if it's a POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data and update the database
    // Redirect the user to another page after processing the form data
    header("Location: payment_details.php");
    exit(); // Ensure that no other code is executed after the redirect
}

$query = "SELECT * FROM student_details WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
$registration_no = $user['reg_no'];
echo $registration_no;

// Debugging statement
echo $user['institution_fees_payment_done'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400&display=swap">
    <title>Payment Details</title>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

        .verified-icon {
            width: 24px;
        }

        .status-verified {
            color: green;
        }

        .status-pending {
            color: orange;
        }

        .total-row th,
        .total-row td {
            font-weight: bold;
        }

        .jumbotron-custom {
            background-color: #f8f9fa;
            border-bottom: 2px solid #e9ecef;
        }

        .button-container {
            display: flex;
            justify-content: center; /* Centers the button horizontally */
            margin-top: 20px; /* Adds some space between the table and the button */
        }
    </style>
</head>
<body>
<div class="jumbotron jumbotron-fluid jumbotron-custom">
  <div class="container">
    <h1 class="display-4">Payment Details</h1>
    <p class="lead">Confirm the payment details below.</p>
    <button type="button"><a href="logout.php">logout</a></button>
  </div>
</div>

<div class="container">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Receiver</th>
          <th scope="col">Amount</th>
          <th scope="col">Status</th>
          <th scope="col">Payment Link</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td>Admitting Institute</td>
          <td>Rs. 100</td>
          <td>
    <?php if ($user['instittuion_fees_payment_done'] == 1): ?>
        <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
    <?php else: ?>
        Pending
    <?php endif; ?>
</td>
<td>
    <?php if ($user['instittuion_fees_payment_done'] == 1): ?>
      <button id="portal-fee-button" class="btn btn-light" type="button" disabled> Paid</button>    <?php else: ?>
        <button id="portal-fee-button" type="button" class="btn btn-info" >Pay Inst Fees Fees</button>
    <?php endif; ?>
</td>        </tr>
        <tr>
          <td>Portal Charges + GST</td>
          <td>Rs. 10</td>
          <td>
    <?php if ($user['portal_fees_payment_done'] == 1): ?>
        <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
    <?php else: ?>
        Pending
    <?php endif; ?>
</td>
<td>
    <?php if ($user['portal_fees_payment_done'] == 1): ?>
      <button id="portal-fee-button" type="button" class="btn btn-light" disabled> Paid</button>    <?php else: ?>
        <button id="portal-fee-button" type="button" class="btn btn-info" >Pay Portal Fees</button>
    <?php endif; ?>
</td>
        </tr>
        <tr class="total-row">
          <td>TOTAL</td>
          <td>RS. 110</td>
          
<td>
    <?php if ($user['portal_fees_payment_done'] == 1 & $user['instittuion_fees_payment_done'] == 1 ): ?>
        <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
    <?php else: ?>
        Pending
    <?php endif; ?>
</td>
<td>
    <?php if ($user['portal_fees_payment_done'] == 1): ?>
      <a href="download_receipt.php" class="btn btn-info" id="portal-fee-button">Download <br> Receipt</a>
 <?php else: ?>
        
        <button id="portal-fee-button" type="button" class="btn btn-info" disabled>Complete All Payment</button>
    <?php endif; ?>
</td>
        </tr>
      </tbody>
    </table>
    <div class="button-container">
        <!-- <button type="button" class="btn btn-info">Submit and Download Payment Receipt</button> -->
    </div>
</div>


<!-- Razorpay Payment Integration Script -->
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
  // Payment handler for Inst. Fees
  var instFeeOptions = {
    "key": "rzp_test_MJgA4fLLQnLghp",
    "amount": "10000", // 100 INR (multiplying by 100 as Razorpay takes amount in paisa)
    "currency": "INR",
    "description": "Institution Fees",
    "image": "example.com/image/rzp.jpg",
    "handler": function (response) {
      var paymentId = response.razorpay_payment_id;
      // Send payment ID to server for database update using AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "institution_fees_verify.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              console.log(xhr.responseText); // Log server response (for debugging)
          }
      };
      xhr.send("paymentId=" + paymentId);
    }
  };
  var instFeeRzp = new Razorpay(instFeeOptions);
  document.getElementById('inst-fee-button').onclick = function (e) {
    instFeeRzp.open();
    e.preventDefault();
  };

  // Payment handler for Portal Fees
  var portalFeeOptions = {
    "key": "rzp_test_MJgA4fLLQnLghp",
    "amount": "1000", // 10 INR (multiplying by 100 as Razorpay takes amount in paisa)
    "currency": "INR",
    "description": "Portal Fees",
    "image": "example.com/image/rzp.jpg",
    "handler": function (response) {
      var paymentId = response.razorpay_payment_id;
      // Send payment ID to server for database update using AJAX
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "portal_fees_verify.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function() {
          if (xhr.readyState === 4 && xhr.status === 200) {
              console.log(xhr.responseText); // Log server response (for debugging)
          }
      };
      xhr.send("paymentId=" + paymentId);
    }
  };
  var portalFeeRzp = new Razorpay(portalFeeOptions);
  document.getElementById('portal-fee-button').onclick = function (e) {
    portalFeeRzp.open();
    e.preventDefault();
  };
</script>

</body>
</html>
