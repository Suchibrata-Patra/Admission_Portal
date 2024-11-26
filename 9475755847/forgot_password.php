<?php include('../favicon.php') ?>
<?php include('_DIR_/../../exception_handler.php') ?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'database.php';
require 'super_admin.php';

$table_name = $udise_code . '_Student_Details';

$sql = "SELECT School_Name FROM edu_org_records WHERE udise_id='$udise_code'"; // Use quotes around $udise_code
$results = mysqli_query($db, $sql);

if (!$results) {
    die("Query failed: " . mysqli_error($db)); // Error handling
}
$school_info = mysqli_fetch_assoc($results);
// if ($school_name) {
//     echo $school_name['School_Name']; // Access the specific key
// } else {
//     echo "No school found with the given UDISE ID."; // Handle case where no record is found
// }

// echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
// echo 'Table name: ' . $table_name . '<br>';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '../../Assets/vendor/autoload.php';

$rand = rand(100000, 999999);  // Ensure the OTP is a 6-digit number

// Function to generate a random password
function generateRandomPassword($length = 6)
{
    $characters = 'ABCDEFGHJKMNPQRSTUVWXYZ0123456789';
    $password = '';
    for ($i = 0; $i < $length; $i++) {
        $password .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $password;
}

// Create PHPMailer instance
$mail = new PHPMailer(true);

// Function to send email using SMTP
function sendEmail($to, $subject, $message)
{
    global $mail;

    // Configure SMTP settings
    $smtpUsername = 'your_email@gmail.com'; // Your Gmail address
    $smtpPassword = 'your_app_password'; // Your Gmail app password
    $smtpHost = 'smtp.gmail.com'; // Gmail SMTP server
    $smtpPort = 587; // Port for TLS encryption

    // Enable SMTP debugging (0 = off, 1 = client messages, 2 = client and server messages)
    $mail->SMTPDebug = 0;

    // Set mailer to use SMTP
    $mail->isSMTP();

    // Specify SMTP server
    $mail->Host = $smtpHost;

    // Enable SMTP authentication
    $mail->SMTPAuth = true;

    // Provide username and password
    $mail->Username = 'otpverifier.2023@gmail.com';
    $mail->Password = 'iigd kldu ttwv wsug';  // Use the correct password

    // Enable TLS encryption
    $mail->SMTPSecure = 'tls';

    // TCP port to connect to
    $mail->Port = $smtpPort;

    // Set sender and recipient
    $mail->setFrom($smtpUsername, 'Password Reset');
    $mail->addAddress($to);

    // Set email subject and body
    $mail->Subject = $subject;
    $mail->isHTML(true); // Set email format to HTML
    $mail->Body = $message;

    // Send email
    if (!$mail->send()) {
        return false;
    } else {
        return true;
    }
}

// Handle form submission
if (isset($_POST['forgot_password'])) {
    $email = mysqli_real_escape_string($db, $_POST['email']);

    // Check if the email exists in the database
    $query = "SELECT * FROM $table_name WHERE email='$email'";
    $results = mysqli_query($db, $query);

    if (mysqli_num_rows($results) == 1) {
        // Generate a new random password
        $newPassword = generateRandomPassword();

        // Hash the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // Update the user's password in the database
        $updateQuery = "UPDATE $table_name SET password='$hashedPassword' WHERE email='$email'";
        mysqli_query($db, $updateQuery);

        // Send the new password to the user via email
        $subject = "New Password";
        $message = "
        <!DOCTYPE html>
<html>
  <head>
    <title>Reset Your Password</title>
    <style>
      body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
        margin: 0;
        padding: 0;
      }

      .email-container {
        max-width: 600px;
        margin: 50px auto;
        background-color: #ffffff;
        border: 1px solid #e6e6e6;
        border-radius: 8px;
        overflow: hidden;
      }

      .email-header {
        background-color: #f1f1f1;
        text-align: center;
        padding: 20px 0;
      }

      .email-header img {
        width: 30%;
      }

      .email-body {
        padding: 30px;
        color: #333333;
      }

      .email-body h1 {
        font-size: 24px;
        margin-bottom: 10px;
        color: #000000;
      }

      .email-body p {
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 20px;
      }

      .reset-button {
        display: block;
        width: 100%;
        text-align: center;
        background-color: #e50914;
        color: #ffffff;
        text-decoration: none;
        font-size: 16px;
        padding: 12px;
        border-radius: 5px;
        margin-bottom: 20px;
      }

      .reset-button:hover {
        background-color: #d40813;
      }

      .email-footer {
        padding: 20px;
        font-size: 14px;
        color: #666666;
        text-align: center;
        border-top: 1px solid #e6e6e6;
      }

      .email-footer a {
        color: #e50914;
        text-decoration: none;
      }

      .email-footer a:hover {
        text-decoration: underline;
      }
    </style>
  </head>
  <body>
    <div class='email-container'>
      <div class='email-header'>
        <img src='https://upload.wikimedia.org/wikipedia/commons/thumb/6/63/The_application.in_navbara_icon.png/220px-The_application.in_navbara_icon.png' alt='TheApplication Logo' />
      </div>
      <div class='email-body'>
        <h1>Reset your password</h1>
        <p>Hi,</p>
        <p>
         Following is the OTP for resetting your Password. Login as usual using the following OTP as your password. Later On If You wish, You can change the Password as you want.
        </p>
        <a href='#' class='reset-button'>$newPassword</a>
        <p>
          If you did not ask to reset your password, you may want to review your
          account for any unusual activity.
        </p>
        <p>We're here to help if you need it.</p>
      </div>
      <div class='email-footer'>
        <p>
          Questions? Contact Us from our official Website.<br />
          <!-- <a href='#'>Notification Settings</a> | <a href='#'>Terms of Use</a> |
          <a href='#'>Privacy</a> | <a href='#'>Help Centre</a> -->
        </p>
        <p>
          Powered by
          <strong>TheApplication</strong>
        </p>
      </div>
    </div>
  </body>
</html>

        ";
        if (sendEmail($email, $subject, $message)) {
            $_SESSION['success'] = "A new password has been sent to your email address.";
            header('location: login.php');
            exit();
        } else {
            $_SESSION['error'] = "Failed to send email. Please try again later.";
        }
    } else {
        $_SESSION['error'] = "Email not found.";
    }
    header('location: forgot_password.php');
    exit();
} else {
    unset($_SESSION['email_sent']); // Clear session variable if form not submitted
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f3f3f3;
            font-family: Arial, sans-serif;
        }

        .formbox {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 500px;
            margin: 50px auto;
            text-align: center;
        }

        .formbox h2 {
            font-size: 24px;
            font-weight: bold;
            color: #333;
            margin-bottom: 20px;
        }

        .formbox p {
            color: #555;
            font-size: 14px;
            margin-bottom: 20px;
            line-height: 1.6;
        }

        .formbox .lock-icon {
            font-size: 40px;
            color: #e50914;
            margin-bottom: 20px;
        }

        .formbox .form-control {
            border-radius: 5px;
            height: 45px;
            font-size: 14px;
        }

        .formbox button {
            background-color: #e50914;
            color: white;
            font-size: 16px;
            font-weight: 400;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .formbox button:hover {
            background-color: #b00710;
        }

        .footer {
            font-size: 12px;
            color: #888;
            margin-top: 20px;
            text-align: center;
        }

        .footer a {
            color: #e50914;
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="formbox">
<img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/63/The_application.in_navbara_icon.png/220px-The_application.in_navbara_icon.png" alt="">        
<h2>Reset Your Password</h2>
        <p>Let's reset your password so you can get back to accessing your account.</p>
        <form method="post" action="forgot_password.php">
            <div class="form-group">
                <input type="email" class="form-control" name="email" id="email"
                    placeholder="Enter your registered email" required>
            </div>
            <div class="form-group">
                <button type="submit" name="forgot_password">Reset Password</button>
            </div>
        </form>
        <div class="footer">
            <p>Powered by <strong>TheApplication.in</strong></p>
        </div>
    </div>
</body>

</html>