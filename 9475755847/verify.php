<?php include('../favicon.php') ?>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
            font-family: 'Montserrat', sans-serif;
            color: #484848;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: 0 auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }
        h2 {
            color: #333;
            font-weight: 600;
            text-align: center;
            margin-bottom: 20px;
        }
        .btn {
            border: none;
            padding: 10px 20px;
            font-size: 14px;
            border-radius: 25px;
            text-transform: uppercase;
            transition: background-color 0.3s ease;
        }
        .btn-primary {
            background-color: #FF5A5F;
            color: white;
        }
        .btn-primary:hover {
            background-color: #ed4c51;
        }
        .btn-primary:disabled {
            background-color: #ccc;
        }
        .form-control {
            border-radius: 25px;
            border: 1px solid #ccc;
            padding: 15px;
            font-size: 14px;
        }
        .input-group {
            margin-bottom: 20px;
        }
        .btn-container {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }
        .progress-bar {
            position: absolute;
            bottom: 0;
            left: 0;
            height: 2px;
            background-color: black;
            width: 0%;
        }
        .modal-dialog {
            max-width: 400px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification</h2>
        <form method="post">
            <div class="input-group">
                <input type="text" name="code" class="form-control" placeholder="Enter code sent to your email" required>
                <button type="submit" name="email_code" class="btn btn-primary">Verify</button>
            </div>
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

    <!-- Modal for "OTP Sent" -->
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
            var progressBar = document.getElementById("progressBar");
            
            resendButton.disabled = true; // Disable the button
            resendButton.innerText = "Sending...";
            progressBar.style.width = '0%';  // Reset progress bar

            // Start progress bar animation
            var progress = 0;
            var progressInterval = setInterval(function() {
                progress += 1;
                progressBar.style.width = progress + '%';
                if (progress >= 100) {
                    clearInterval(progressInterval);
                }
            }, 100); // Increase progress every 100ms

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


