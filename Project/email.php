<?php 
require 'Project/session.php';
require 'Project/database.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "Project/vendor/autoload.php";
$rand = rand(999999, 100000);
$mail = new PHPMailer(true);

//Enable SMTP debugging.
// $mail->SMTPDebug = 3;                               
//Set PHPMailer to use SMTP.
$mail->isSMTP();            
//Set SMTP host name                          
$mail->Host = "smtp.googlemail.com";
//Set this to true if SMTP host requires authentication to send email
$mail->SMTPAuth = true;                          
//Provide username and password     
$mail->Username = "otpverifier.2023@gmail.com";                 
$mail->Password = "dvhy cimg fpyl pbng";                           
//If SMTP requires TLS encryption then set it
$mail->SMTPSecure = "ssl";                           
//Set TCP port to connect to
$mail->Port = 465; 

$mail->From = "otpverifier.2023@gmail.com";
$mail->FromName = "No Reply";

$mail->addAddress($student_details['email'], $student_details['fname']);

$mail->Subject = "Verification Code";

// HTML email body
$mail->isHTML(true);
$mail->Body = '
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Email Verification</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #fff;
        margin: 0;
        padding: 0;
    }

    .container {
        max-width: 600px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    h1 {
        text-align: center;
        color: #000;
        font-size: 24px;
    }

    p {
        font-size: 16px;
        color: #000;
    }

    .verification-code {
        margin-top: 20px;
        padding: 10px 20px;
        background-color: #333;
        color: #fff;
        border-radius: 5px;
        text-align: center;
        font-size: 20px;
    }

    .copy-button {
        display: block;
        width: 100%;
        padding: 10px 0;
        background-color: #000;
        color: #fff;
        border: none;
        border-radius: 5px;
        text-align: center;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        margin-top: 20px;
    }

    .copy-button:hover {
        background-color: #333;
    }

    .footer {
        margin-top: 30px;
        text-align: center;
    }

    .footer p {
        font-size: 14px;
        color: #888;
    }
</style>
</head>
<body>
<div class="container">
    <h1>Email Verification</h1>
    <p>Hi there,</p>
    <p>This is your verification code:</p>
    <input type="text" id="verificationCode" class="verification-code" value="' . $rand . '" readonly>
    <div class="footer">
        <p>Please use this code to verify your email address.</p>
    </div>
</div>
</body>
</html>
';

try {
    $mail->send();
    echo "Message has been sent successfully";
    $_SESSION['codeSend'] = 1;
    $_SESSION['success'] = "Code has been sent to your email";

    $user_id = $student_details['id'];
    $query = "UPDATE student_details SET emailVerify= $rand WHERE id ='$user_id'";
    $results = mysqli_query($db, $query);
    header('location: Project/verify.php');
} catch (Exception $e) {
     "Mailer Error: " . $mail->ErrorInfo;
     echo "Mail is not reachable!";
}
?>
