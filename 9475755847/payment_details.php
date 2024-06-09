<?php include('../favicon.php') ?>

<?php
session_start();
require 'session.php';
require 'super_admin.php';
 $table_name = $udise_code . '_student_details';
 echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
 echo 'Table name: ' . $table_name . '<br>';
$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
$registration_no = $user['reg_no'];

if ($user['issubmitted'] == 0) {
  header('location: welcome.php');
  exit(); // Add exit to stop further execution
} 
if ($user['numberVerify'] == 0) {
  header('location: verify.php');
  exit(); // Add exit to stop further execution
} 

echo $registration_no;
// Debugging statement
echo $user['institution_fees_payment_done'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Cache-Control" content="public, max-age=3600">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
    integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <link rel="stylesheet"
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,400;0,700;1,400&display=swap">
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
      justify-content: center;
      /* Centers the button horizontally */
      margin-top: 20px;
      /* Adds some space between the table and the button */
    }
    /* Custom CSS */
.custom-disabled-color {
  color: black !important;
}

  </style>
</head>

<body>
  <!--PageLoader-->
<?php require ('../Secure_Pageloader.php') ?>
<?php require ('../Student_Process_header.php') ?>
<!--PageLoader-->
  <div class="jumbotron jumbotron-fluid jumbotron-custom">
    <div class="container">
      <h1 class="display-4">Payment Details</h1>
      <p class="lead">Confirm the payment details below.</p>
      <button type="button" class="btn btn-info" onclick="window.location.href='logout.php';">Logout</button>
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
          <td>Rs.100</td>
          <td>
            <?php if ($user['institution_fees_payment_done'] == 1): ?>
            <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
            <?php else: ?>
            Pending
            <?php endif; ?>
          </td>
          <td>
            <?php if ($user['institution_fees_payment_done'] == 1): ?>
            <button id="inst-fee-button" type="button" class="btn btn-light" disabled>Paid</button>
            <?php else: ?>
            <button id="inst-fee-button" type="button" class="btn btn-info" onclick="handleInstFeeButtonClick()">Pay
              Inst. Fees</button>
            <?php endif; ?>
          </td>
        </tr>
        <tr>
          <td>Portal Charges + GST</td>
          <td>Rs.10</td>
          <td>
            <?php if ($user['portal_fees_payment_done'] == 1): ?>
            <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
            <?php else: ?>
            Pending
            <?php endif; ?>
          </td>

          <td>
            <?php if ($user['portal_fees_payment_done'] == 1): ?>
            <button id="portal-fee-button" type="button" class="btn btn-light" disabled>Paid</button>
            <?php else: ?>
            <button id="portal-fee-button" type="button" class="btn btn-info" onclick="handlePortalFeeButtonClick()">Pay
              Platform Fees</button>
            <?php endif; ?>
          </td>
        </tr>

        <tr>
          <td>
            GST <br>
            <span style="font-size:11px; color:RED;">Merged with Platform Fees</span>
          </td>
          <td>
           2.76 % 
          </td>
          <td>
          <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
          </td>
          <td>
            <?php if ($user['portal_fees_payment_done'] == 1): ?>
            <button id="portal-fee-button" type="button" class="btn btn-light" disabled>Paid</button>
            <?php else: ?>
              <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
            <?php endif; ?>
          </td>
        </tr>
        <tr class="total-row">
          <td>TOTAL</td>
          <td>Rs.110</td>
          <td>
            <?php if ($user['portal_fees_payment_done'] == 1 & $user['institution_fees_payment_done'] == 1): ?>
            <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
            <?php else: ?>
            Pending
            <?php endif; ?>
          </td>
          <td>
            <?php if ($user['institution_fees_payment_done'] == 1 & $user['portal_fees_payment_done'] == 1 ): ?>
            <button id="total-payment-button" type="button" class="btn btn-light"><a
                href="receipt_download.php">Download</a></button>
            <?php else: ?>
            <button id="total-payment-button" type="button" class="btn btn-info" disabled>Form Receipt</button>
            <?php endif; ?>
          </td>
        </tr>
      </tbody>
    </table>

<!-- Final Submission Button -->
<div class="container d-flex flex-column align-items-center">
  <div class="text-center mb-3">After Successful payment, <u><b><i>refresh the page</i></b></u> to update the details</div>
  <?php if ($user['institution_fees_payment_done'] == 1 && $user['portal_fees_payment_done'] == 1 ): ?>
    <button id="total-payment-button" type="button" class="btn btn-warning"><a href="receipt_download.php" style="color:black;">Submit Application</a></button>
  <?php else: ?>
    <button id="total-payment-button" type="button" class="btn btn-warning custom-disabled-color" disabled>Final Submission</button>
  <?php endif; ?>
</div>
<!-- End of Final Submission Button -->


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
      "prefill": {
      "contact": "9475755847",  // Prefill mobile number
      "email": "example@example.com"  // Optionally prefill the email as well
     },
      "handler": function (response) {
        var paymentId = response.razorpay_payment_id;
        // Send payment ID to server for database update using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "institution_fees_verify.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Log server response (for debugging)
            // Update button status based on server response
            var responseObj = JSON.parse(xhr.responseText);
            if (responseObj.success) {
              document.getElementById("inst-fee-button").innerText = "Paid";
              document.getElementById("inst-fee-button").classList.remove("btn-info");
              document.getElementById("inst-fee-button").classList.add("btn-light");
              document.getElementById("inst-fee-button").disabled = true;
            }
          }
        };
        xhr.send("paymentId=" + paymentId);
      }
    };
    var instFeeRzp = new Razorpay(instFeeOptions);
    function handleInstFeeButtonClick() {
      instFeeRzp.open();
    }

    // Payment handler for Portal Fees
    var portalFeeOptions = {
      "key": "rzp_test_MJgA4fLLQnLghp",
      "amount": "1000", // 10 INR (multiplying by 100 as Razorpay takes amount in paisa)
      "currency": "INR",
      "description": "Portal Fees",
      "image": "example.com/image/rzp.jpg",
      "prefill": {
      "contact": "9475755847",  // Prefill mobile number
      "email": "example@example.com"  // Optionally prefill the email as well
     },
      "handler": function (response) {
        var paymentId = response.razorpay_payment_id;
        // Send payment ID to server for database update using AJAX
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "portal_fees_verify.php", true);
        xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function () {
          if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText); // Log server response (for debugging)
            // Update button status based on server response
            var responseObj = JSON.parse(xhr.responseText);
            if (responseObj.success) {
              document.getElementById("portal-fee-button").innerText = "Paid";
              document.getElementById("portal-fee-button").classList.remove("btn-info");
              document.getElementById("portal-fee-button").classList.add("btn-light");
              document.getElementById("portal-fee-button").disabled = true;
            }
          }
        };
        xhr.send("paymentId=" + paymentId);
      }
    };
    var portalFeeRzp = new Razorpay(portalFeeOptions);
    function handlePortalFeeButtonClick() {
      portalFeeRzp.open();
    }

    
  </script>

</body>

</html>