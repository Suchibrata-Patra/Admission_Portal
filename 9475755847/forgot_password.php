<?php include('../favicon.php') ?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'database.php';
require 'super_admin.php';

$table_name = $udise_code . '_student_details';

$sql = "SELECT School_Name FROM edu_org_records WHERE udise_id='$udise_code'"; // Use quotes around $udise_code
$results = mysqli_query($db, $sql);

if (!$results) {
    die("Query failed: " . mysqli_error($db)); // Error handling
}

$school_name = mysqli_fetch_assoc($results);
// if ($school_name) {
//     echo $school_name['School_Name']; // Access the specific key
// } else {
//     echo "No school found with the given UDISE ID."; // Handle case where no record is found
// }

// echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
// echo 'Table name: ' . $table_name . '<br>';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../vendor/autoload.php';

$rand = rand(100000, 999999);  // Ensure the OTP is a 6-digit number

// Function to generate a random password
function generateRandomPassword($length = 10)
{
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
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
    $mail->Password = 'cymp mmut sqzu vzim';  // Use the correct password

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
        <html>
        <head>
          <title>New Password</title>
          <style>
            body {
              font-family: Arial, sans-serif;
              background-color: #f4f4f4;
              margin: 0;
              padding: 0;
            }
            .container {
              max-width: 400px;
              margin: 50px auto;
              background-color: #fff;
              padding: 20px;
              border-radius: 8px;
              box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
              text-align: center;
              margin-bottom: 20px;
            }
            p {
              margin-bottom: 20px;
            }
            .btn {
              display: inline-block;
              background-color: #4caf50;
              color: #fff;
              padding: 10px 20px;
              border: none;
              border-radius: 5px;
              text-decoration: none;
              font-size: 16px;
              transition: background-color 0.3s ease;
            }
            .btn:hover {
              background-color: #45a049;
            }
          </style>
        </head>
        <body>
          <div class='container'>
            <h2>New Password</h2>
            <p>Your new password is: <strong>$newPassword</strong></p>
            <p>Please login using this new password and consider changing it to a more secure one.</p>
            <p>If you did not request this change, please contact us immediately.</p>
            <p>Best regards,<br>Your Company Name</p>
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
    <title>Responsive Forgot Password Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Optional: Include the Material Icons CDN for the lock icon -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <style>
        body{
            background-color: #eaeaea;
        }
        .formbox{
            background-color: white;
            border-radius: 20px;
            padding-left:12%;
            padding-right:12%;
            padding-top:5%;
            padding-bottom:5%;
        }
    p {
    text-align: justify;
}
#submitBtn {
    background-color: rgb(242, 240, 240);
    color: black;
    border: none;
    padding: 10px 80px;
    border-radius: 5px;
}

#submitBtn:hover {
    color: #ffffff;
    background-color: black;
}

    </style>
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand mx-auto" href="#">
                <?php echo htmlspecialchars($school_name['School_Name']); ?>
            </a>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="formbox">
                    <center>
                        <span class="material-icons" style="font-size: 48px; padding-top: 10px;">
                            lock
                        </span>
                    </center>
                <h2 class="text-center">Forgot Password</h2>
                <p class="text-center" style="color: grey;">
                    Once you've successfully reset your password, you'll be redirected to the login page.
                    Use the password sent to your email to log in for future access.
                </p>
                <form method="post" action="forgot_password.php">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" name="email" id="email" placeholder="Enter Registered Email Only" required>
                    </div>
                    <div class="form-group text-center">
                        <button type="submit" class="submit_button" name="forgot_password" id="submitBtn">Submit</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>