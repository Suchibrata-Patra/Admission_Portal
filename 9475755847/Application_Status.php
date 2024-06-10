<?php include('../favicon.php') ?>
<?php
require 'session.php';
require 'super_admin.php';
 $table_name = $udise_code . '_student_details';
//  echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
//  echo 'Table name: ' . $table_name . '<br>';
$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
$registration_no = $user['reg_no'];
// echo $registration_no;
if ($user['is_finally_submitted'] == 0) {
    if($user['issubmitted'] == 0){
        header('location: welcome.php');
        exit(); // Add exit to stop further execution
    }
}
if ($user['numberVerify'] == 0) {
  header('location: verify.php');
  exit(); // Add exit to stop further execution
} 

// echo $registration_no;
// Debugging statement
// echo $user['institution_fees_payment_done'];
?>
<?php
$timestamp = $user['Registration_Time_Stamp']; // '2024-06-09 12:34:56'
$encryptedTimestamp = bin2hex($timestamp);
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
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <title>Application Status</title>
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

        .profile-image {
            width: 90px;
            height: 90px;
            object-fit:scale-down;
            border-radius: 100%;
            position: absolute;
            top: 60%;
            right: 10%;
            border: 1px solid BLAck;
        }

        .card {
            font-family: "Roboto Mono", monospace;
            max-width: 450px;
            margin: 0 auto;
            background-color: rgb(249, 249, 249);
            border-radius: 20px;
            color: rgb(0, 0, 0);
        }

        .jumbotron-custom {
            background-color: #f0f0f0;
            padding-top: 100px;
            /* Adjust this value to your liking */
            padding-bottom: 100px;
            /* Adjust this value to your liking */
        }

    </style>
</head>

<body>
    <!--PageLoader-->
    <?php require ('../Secure_Pageloader.php') ?>

    <!--PageLoader-->
    <?php
// Define the possible file extensions
$allowedExtensions = ['png', 'jpg', 'jpeg'];

// Initialize the photoPath variable
$photoPath = null;

// Loop through each allowed extension
foreach ($allowedExtensions as $extension) {
    // Construct the file path with the current extension
    $tempPhotoPath = "uploads/{$registration_no}_passportsizephoto.{$extension}";

    // Check if the file exists
    if (file_exists($tempPhotoPath)) {
        // Assign the file path if the image is found
        $photoPath = $tempPhotoPath;
        break; // Exit the loop once the image is found
    }
}
?>

    <div class="jumbotron jumbotron-fluid jumbotron-custom position-relative">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="display-4">Application Status</h1>
                    <p class="lead">
                    </p>
                    <p style="font-size:14px;color:grey;">This is Your Application Status Window</p>
                    <button type="button" class="btn btn-info"
                        onclick="window.location.href='logout.php';">Logout</button>
                        <p style="margin-top:6%;color:grey;">
                            After the publication of the Merit Lists, we kindly request your visitation to this page for subsequent updates regarding admissions and fee payments
                        </p>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <img src="../../Assets/images/favicon.png" alt="icon" style="width:20%"><span style="padding-left: 10px;font-weight:400;"><b>Profile</b></span>
                                    <h5 class="card-title"></h5>
                                </div>
                                <div class="col text-end">
                                    <?php if ($photoPath): ?>
                                    <img src="<?php echo htmlspecialchars($photoPath); ?>" class="profile-image"
                                        alt="Passport Size Photo">
                                    <?php endif; ?>
                                </div>
                            </div>
                            <p class="card-text"><?php echo htmlspecialchars($user['fname']) . " " . htmlspecialchars($user['lname']); ?></p>
                            <p class="card-text" style="font-size: 0.7em;">Contact</p>
                            <p class="card-text" style="font-size: 1em;margin-top:-18px;">+91 <?php echo $user['phoneNumber'] ?></p>
                            <p class="card-text" style="font-size: 0.7em;margin-top:-12px;">Regn</p>
                            <p class="card-text" style="font-size: 1em;margin-top:-18px;"><?php echo $user['reg_no'] ?></p>
                            <p class="card-text" style="font-size: 0.7em;margin-top:-12px;">Digital Fingerprint</p>
                            <p class="card-text" style="font-size: 1em;margin-top:-18px;"><?php echo $encryptedTimestamp ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Step</th>
                    <th scope="col">Status</th>
                    <th scope="col">Link</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Fees Payment</td>
                    <td style="color: rgb(255, 170, 0);">
                        <?php if ($user['institution_fees_payment_done'] == 1 & $user['portal_fees_payment_done'] == 1 ): ?>
                        <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
                        <?php else: ?>
                        Pending
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($user['institution_fees_payment_done'] == 1 & $user['portal_fees_payment_done'] == 1 ): ?>
                        <button id="inst-fee-button" type="button" class="btn btn-light" disabled>Paid</button>
                        <?php else: ?>
                        <button id="inst-fee-button" type="button" class="btn btn-info"><a href="payment_details.php" style="color: white; text-decoration: none;">Pay</a></button>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Finally Submitted</td>
                    <td style="color: rgb(255, 170, 0);">
                        <?php if ($user['institution_fees_payment_done'] == 1 & $user['portal_fees_payment_done'] == 1 ): ?>
                        <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
                        <?php else: ?>
                        Pending
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($user['institution_fees_payment_done'] == 1 & $user['portal_fees_payment_done'] == 1 ): ?>
                        <button id="inst-fee-button" type="button" class="btn btn-light" disabled>Submitted</button>
                        <?php else: ?>
                        <button id="inst-fee-button" type="button" class="btn btn-info"><a href="payment_details.php" style="color: white; text-decoration: none;">Submit</a></button>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Download Receipt</td>
                    <td style="color: rgb(255, 170, 0);">
                        <?php if ($user['institution_fees_payment_done'] == 1 & $user['portal_fees_payment_done'] == 1 ): ?>
                        <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
                        <?php else: ?>
                        Pending
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($user['institution_fees_payment_done'] == 1 & $user['portal_fees_payment_done'] == 1 ): ?>
                        <button id="inst-fee-button" type="button" class="btn btn-light" ><a href="receipt_download.php">Download</a></button>
                        <?php else: ?>
                        <button id="inst-fee-button" type="button" class="btn btn-light" disabled></a></button>
                        <?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td>Admission</td>
                    <td style="color: rgb(255, 170, 0);">
                        <?php if ($user['institution_fees_payment_done'] == 1 & $user['portal_fees_payment_done'] == 1 ): ?>
                        <img src="Assets/verified.svg" alt="Verified" class="verified-icon">
                        <?php else: ?>
                        Pending
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($user['institution_fees_payment_done'] == 0 & $user['portal_fees_payment_done'] == 1 ): ?>
                        <button id="inst-fee-button" type="button" class="btn btn-warning" disabled>Wait</button>
                        <?php else: ?>
                        <button id="inst-fee-button" type="button" class="btn btn-warning"><a href="payment_details.php" style="color: white; text-decoration: none;">Proceed</a></button>
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
</body>

</html>
