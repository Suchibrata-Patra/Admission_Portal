<?php include('_DIR_/../../exception_handler.php') ?>
<?php include('../favicon.php') ?>
<?php
require 'session.php';
require 'super_admin.php';

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
            color: #FF5A5F;
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
        .btn-danger {
            background-color: #484848;
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
            height: 50px;
        }
        .footer {
            text-align: center;
            margin-top: 20px;
            font-size: 0.8em;
            color: #95a5a6;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Email Verification</h2>
        <div>
            <p>Welcome, <strong><?php echo htmlspecialchars($first_name); ?></strong> | <a href="welcome.php?logout='1'" style="color: #FF5A5F; text-decoration: none;">Logout</a></p>
            
            <?php if (isset($error_message)): ?>
                <div class="alert alert-danger">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>

            <form method="post">
                <div class="input-group mb-3">
                    <input type="text" name="code" class="form-control" placeholder="Enter verification code" required>
                    <button type="submit" name="email_code" class="btn btn-primary">Verify</button>
                </div>
            </form>
            <button id="resendButton" class="btn btn-primary" onclick="resendEmail()">Resend OTP</button>
            <form method="post" style="display: inline;">
                <button type="submit" name="edit" class="btn btn-danger">Edit Contact Information</button>
            </form>
        </div>
        <p class="footer">Need help? Contact support</p>
    </div>
    <script>
        function resendEmail() {
            const button = document.getElementById('resendButton');
            button.innerText = 'Sending...';
            button.disabled = true;

            fetch('email.php', { method: 'POST' })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        button.innerText = 'Sent!';
                    } else {
                        alert(data.message || 'Failed to resend OTP. Try again.');
                        button.innerText = 'Resend OTP';
                        button.disabled = false;
                    }
                })
                .catch(() => {
                    alert('An error occurred. Please try again.');
                    button.innerText = 'Resend OTP';
                    button.disabled = false;
                });
        }
    </script>
</body>
</html>
