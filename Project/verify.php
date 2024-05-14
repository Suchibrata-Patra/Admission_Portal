<?php
require 'session.php';

// Handle form submission for email verification
if (isset($_POST['email_code'])) {
    if ($user['emailVerify'] == $_POST['code']) {
        $user_id = $user['reg_no'];
        $query = "UPDATE student_details SET numberVerify = 1, emailVerify = 1 WHERE reg_no = '$user_id'";
        $results = mysqli_query($db, $query);
        unset($_SESSION['codeSend']);
        header('location: welcome.php');
    } else {
        $error_message = "Incorrect verification code. Please try again.";
    }
}

$user_id = $user['reg_no'];
$query = "SELECT fname FROM student_details WHERE reg_no = '$user_id'";
$result = mysqli_query($db, $query);
$row = mysqli_fetch_assoc($result);
$first_name = $row['fname'];

// Handle edit option
if (isset($_POST['edit'])) {
    $user_id = $user['reg_no'];
    $query = "DELETE FROM student_details WHERE reg_no = '$user_id'";
    mysqli_query($db, $query);
    header('location: signup.php');
    exit(); // Ensure script stops here
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
            color: #484848; /* Airbnb's dark grey text color */
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
            color: Black; /* Airbnb's coral red */
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
            background-color: #FF5A5F; /* Airbnb's coral red */
            color: white;
        }
        .btn-danger {
            background-color: #484848; /* Dark grey as an alternative to black */
            color: white;
        }
        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }
        .form-control {
            border-radius: 4px;
            border: 1px solid #ced4da;
            height:50px;
        
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8em;
            color: #95a5a6;
        }
        .btn:hover {
    background-color:#ed4c51;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification</h2>
        <div class="card-body">
            <?php if (isset($_SESSION['email'])): ?>
                <p>Welcome, <strong><?php echo htmlspecialchars($first_name); ?></strong> | <a href="welcome.php?logout='1'" style="color: #FF5A5F; text-decoration: none;">Logout</a></p>
            <?php endif ?>

            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?php echo $error_message; ?>
                </div>
            <?php endif ?>

            <form method="post">
                <div class="input-group mb-3">
                    <input type="text" name="code" class="form-control" placeholder="Enter a code sent to your email" required>
                    <button type="submit" name="email_code" class="btn btn-primary" style="margin-top:0px;padding-left:20px;padding-right:20px;">Verify</button>
                </div>
            </form>

            <!-- Modified button with onclick event to trigger email resend -->
            <button type="button" onclick="resendEmail();" id="resendButton" class="btn btn-primary">Send OTP</button>

            <!-- Your existing button for editing contact information -->
            <button type="submit" name="edit" class="btn btn-primary">Edit Contact Information</button>

            <!-- Empty form for proper HTML structure -->
            <form method="post"></form>
        </div>
        <p class="footer">Need help? Contact support</p>
    </div>

    <script>
        // Function to trigger email resend
        function resendEmail() {
            // Use AJAX to send a request to a PHP script that handles email resend
            var xhr = new XMLHttpRequest();
            xhr.open('POST', 'email.php', true);
            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE && xhr.status === 200) {
                    document.getElementById("resendButton").innerText = "OTP Sent!";
                }
            };
            xhr.send();
        }
    </script>
</body>
</html>