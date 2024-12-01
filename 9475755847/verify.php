<?php
require 'session.php';
require 'super_admin.php';

// Check if the user is not logged in
if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login.php');
    exit(); // It's important to call exit() after header redirection
}
// Database table name based on UDISE code
$table_name = $udise_code . '_Student_Details';

if (isset($_POST['email_code'])) {
    if ($user['emailVerify'] == $_POST['code']) {
        $user_id = $user['reg_no'];
        $query = "UPDATE $table_name SET numberVerify = 1, emailVerify = 1 WHERE reg_no = '$user_id'";
        mysqli_query($db, $query);
        unset($_SESSION['codeSend']);
        echo '<script>window.location.href="welcome.php";</script>';
        exit();
    } else {
        $error_message = "Incorrect verification code. Please try again.";
    }
}

// Redirect if already verified
if ($user['numberVerify'] == 1 && $user['emailVerify'] == 1) {
    echo "<script>window.location.href = 'welcome.php';</script>"; 
    exit();
}

// Fetch first name
$user_id = $user['reg_no'];
$query = "SELECT fname FROM $table_name WHERE reg_no = '$user_id'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$first_name = $row['fname'];

// Handle editing option
if (isset($_POST['edit'])) {
    $query = "DELETE FROM $table_name WHERE reg_no = '$user_id'";
    mysqli_query($db, $query);
    echo '<script>window.location.href="signup.php";</script>';
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f7f7f7; /* Soft gray background */
            font-family: 'Roboto', sans-serif;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }
        .container {
            background-color: white;
            border-radius: 20px;
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
            width: 100%;
            text-align: center;
        }
        h2 {
            font-weight: 500;
            font-size: 28px;
            color: #333;
            margin-bottom: 30px;
        }
        .form-control {
            padding: 16px 20px;
            font-size: 16px;
            border-radius: 12px;
            border: 1px solid #d1d1d6;
            width: 100%;
            margin-bottom: 24px;
            transition: border-color 0.3s ease;
        }
        .form-control:focus {
            border-color: #007aff; /* Apple Blue */
            outline: none;
        }
        .btn {
            padding: 14px 20px;
            font-size: 16px;
            border-radius: 12px;
            color: white;
            border: none;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.3s ease;
            width: 100%;
            margin-top: 20px;
        }
        .btn-primary {
            background-color: #007aff; /* Apple Blue */
        }
        .btn-primary:hover {
            background-color: #0051a8;
            transform: scale(1.05); /* Slight zoom effect */
        }
        .btn-primary:disabled {
            background-color: #c7c7cc;
            cursor: not-allowed;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .btn-container button {
            flex: 1;
            margin: 0 10px;
        }
        .modal-dialog {
            max-width: 400px;
        }
        .modal-header {
            background-color: #007aff; /* Apple Blue */
            color: white;
            border-radius: 12px 12px 0 0;
        }
        .modal-footer {
            border-top: 1px solid #ddd;
        }
        .modal-title {
            font-weight: 500;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification</h2>
        <form method="post">
            <input type="text" name="code" class="form-control" placeholder="Enter the code sent to your email" required>
            <button type="submit" name="email_code" class="btn btn-primary">Verify</button>
        </form>
        
        <div class="btn-container">
            <button type="button" onclick="resendEmail();" id="resendButton" class="btn btn-primary">
                Resend OTP
            </button>
            <form method="post">
                <button type="submit" name="edit" class="btn btn-primary">Edit Info</button>
            </form>
        </div>
    </div>

    <!-- Modal for OTP Sent -->
    <div class="modal fade" id="otpSentModal" tabindex="-1" aria-labelledby="otpSentModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="otpSentModalLabel">Success</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    OTP has been sent successfully!
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Show the OTP Sent popup on page load
        window.onload = function () {
            var otpModal = new bootstrap.Modal(document.getElementById('otpSentModal'));
            otpModal.show();
            sendOTP();
        };

        function sendOTP() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'email.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status !== 200) {
                        alert("Failed to send OTP. Please try again.");
                    }
                }
            };
            xhr.send();
        }

        // Resend OTP functionality with progress bar
        function resendEmail() {
            var resendButton = document.getElementById("resendButton");
            resendButton.disabled = true; // Disable the button
            resendButton.innerText = "Sending...";

            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'email.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        resendButton.innerText = "Sent!";
                        setTimeout(() => {
                            resendButton.disabled = false; // Re-enable the button after 10 seconds
                            resendButton.innerText = "Resend OTP";
                        }, 10000);
                    } else {
                        alert("Failed to resend OTP. Please try again.");
                        resendButton.disabled = false; // Re-enable immediately on error
                        resendButton.innerText = "Resend OTP";
                    }
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
