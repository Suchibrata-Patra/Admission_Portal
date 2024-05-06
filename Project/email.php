<?php 
require 'session.php';
require 'database.php';
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
$mail->FromName = "Authentication Code";

$mail->addAddress($user['email'], $user['fname']);

$mail->Subject = "Verification Code";
$mail->isHTML(true);

// HTML Email Template
$mail->Body = "
<!DOCTYPE html>
<html lang='en'>
<head>
<meta charset='UTF-8'>
<meta name='viewport' content='width=device-width, initial-scale=1.0'>
<title>Email Verification</title>
<style>
  body {
    font-family: Arial, sans-serif;
    background-color: #f8f9fa;
    margin: 0;
    padding: 0;
  }
  .container {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    box-sizing: border-box;
  }
  .logo {
    text-align: center;
    margin-bottom: 20px;
  }
  .logo img {
    max-width: 150px;
  }
  .content {
    background-color: #fff;
    padding: 30px;
    border-radius: 8px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
  }
  .content h2 {
    color: #333;
    text-align: center;
    margin-bottom: 20px;
  }
  .content p {
    font-size: 16px;
    line-height: 1.6;
    color: #555;
    margin-bottom: 20px;
  }
  .btn {
    display: inline-block;
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
  }
  .footer {
    text-align: center;
    margin-top: 20px;
    color: #999;
    font-size: 14px;
  }
</style>
</head>
<body>
  <div class='container'>
    <div class='logo'>
      <img src='Assets/duck.png' alt='Logo'>
    </div>
    <div class='content'>
      <h2>Email Verification</h2>
      <p>Dear " . $user['fname'] . ",</p>
      <p>This is to inform you that a verification code has been generated for your account.</p>
      <p><strong>Verification Code:</strong> ".$rand."</p>
      <p>Please use this code to verify your email address.</p>
      <p>Thank you,<br>Patra Inc.</p>
    </div>
    <div class='footer'>
      &copy; 2024 Patra Inc. All rights reserved.
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

    $user_id = $user['id'];
    $query = "UPDATE student_details SET emailVerify= $rand WHERE id ='$user_id'";
    $results = mysqli_query($db, $query);
    header('location: verify.php');
} catch (Exception $e) {
     "Mailer Error: " . $mail->ErrorInfo;
     echo "Mail is not reachable!";
}
?>
