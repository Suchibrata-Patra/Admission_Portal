<?php 
require 'session.php';
require 'database.php';
require 'super_admin.php';
 $table_name = $udise_code . '_student_details';
 echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
 echo 'Table name: ' . $table_name . '<br>';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once "vendor/autoload.php";

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
$mail->FromName = "Patra Inc.";

$mail->addAddress($user['email'], $user['fname']);

$mail->Subject = "Verify Your Email with Patra Inc.";
$mail->isHTML(true); // Set email format to HTML

// HTML email template
$mail->Body = "
<!DOCTYPE html>
<html lang='en'>
<head>
    <meta charset='UTF-8'>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <title>Email Verification</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            color: #333;
            line-height: 1.6;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            border-radius: 17px;
            background-color: #f7f3e9;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        h1 {
            color: Black;
            margin-top: 0;
            text-align: center;
        }
        p {
            margin-bottom: 20px;
        }
        strong {
            color: #FF5A5F;
        }
        .footer {
            margin-top: 30px;
            text-align: center;
            color: #666;
        }
    </style>
</head>
<body>
    <div class='container'>
        <h1>Email Verification</h1>
        <p>Dear ".$user['fname'].",</p>
        <p>Greetings from Patra Inc.! We're delighted to have you onboard.</p>
        <p>To ensure the security of your account, please verify your email address by using the code below:</p>
        <p style='text-align: center; font-size: 24px;'><strong>".$rand."</strong></p>
        <p>If you did not request this verification, please disregard this email.</p>
        <p>Thank you for choosing Patra Inc. for your needs.</p>
        <div class='footer'>
            <p>Best Regards,</p>
            <p>The Patra Inc. Team</p>
        </div>
    </div>
</body>
</html>
";

try {
    $mail->send();
    echo "Message has been sent successfully";
    $_SESSION['codeSend'] = 1;
    $_SESSION['success'] = "Code has been sent to your email";

    $user_id = $user['reg_no'];
    $query = "UPDATE $table_name SET emailVerify= $rand WHERE reg_no ='$user_id'";
    $results = mysqli_query($db, $query);
    header('location: verify.php');
} catch (Exception $e) {
     "Mailer Error: " . $mail->ErrorInfo;
     echo "Mail is not reachable!";
}
?>
