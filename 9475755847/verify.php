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
    <title>Verification</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #fff;
            font-family: 'Montserrat', sans-serif;
            color: #484848;
        }
        .container {
            max-width: 500px;
            margin: 50px auto;
            background: #ffffff;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h2 {
            color: black;
            font-weight: 600;
            text-align: center;
        }
        .btn {
            border: none;
            padding: 8px;
            margin-top: 10px;
            font-size: 14px;
            border-radius: 5px;
        }
        .btn-primary {
            background-color: #FF5A5F;
            color: white;
        }
        .btn-primary:hover {
            background-color: #ed4c51;
        }
        .form-control {
            border-radius: 4px;
            border: 1px solid #ced4da;
            height: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification</h2>
        <form method="post">
            <div class="input-group mb-3">
                <input type="text" name="code" class="form-control" placeholder="Enter a code sent to your email" required>
                <button type="submit" name="email_code" class="btn btn-primary">Verify</button>
            </div>
        </form>
        <button type="button" onclick="resendEmail();" id="resendButton" class="btn btn-primary">Send OTP</button>
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
        // Function to trigger email resend
        function resendEmail() {
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'email.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);
                        if (response.status === 'success') {
                            var otpModal = new bootstrap.Modal(document.getElementById('otpSentModal'));
                            otpModal.show();
                        } else {
                            alert(response.message || "Failed to send OTP. Please try again.");
                        }
                    } else {
                        alert("An error occurred. Please try again.");
                    }
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>
