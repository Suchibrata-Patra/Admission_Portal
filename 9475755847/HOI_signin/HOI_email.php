<?php 
ini_set('display_errors', 1); 
error_reporting(E_ALL);

require 'database.php';
require 'HOI_session.php';
require 'HOI_super_admin.php';

$table_name = $udise_code . '_HOI_Login_Credentials';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../vendor/autoload.php';
# Function to generate a 6-character alphanumeric string
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

$rand = generateRandomString();  // Generate the OTP
$mail = new PHPMailer(true);
$haggle = 'suchibratapatra2003@gmail.com';

try {
    // Enable SMTP debugging
    $mail->SMTPDebug = 2;  // Change to 0 or 1 for less verbose debugging
    
    // Set PHPMailer to use SMTP
    $mail->isSMTP();
    
    // Set SMTP host name
    $mail->Host = 'smtp.gmail.com';
    
    // Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
    
    // Provide username and password
    $mail->Username = 'otpverifier.2023@gmail.com';
    $mail->Password = 'cymp mmut sqzu vzim';  // Use the correct password or app-specific password
    
    // If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = 'ssl';
    
    // Set TCP port to connect to
    $mail->Port = 465;
    
    $mail->From = 'otpverifier.2023@gmail.com';
    $mail->FromName = 'Patra Inc.';
    
    $mail->addAddress($haggle, 'Suchibrata');
    
    $mail->Subject = 'New Hoi Registration';
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
            <p>Dear " . $user['HOI_Name'] . ",</p>
            <p>Greetings Suchibrata, A New School in Onboarding.</p>
            <p>To ensure the security of your account, please verify your email address by using the code below:</p>
            <p style='text-align: center; font-size: 24px;'><strong>" . $rand . "</strong></p>
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

    echo $user['HOI_Name'];  // Ensure $user array has the correct data
    $mail->send();
    echo 'Message has been sent successfully';
    $_SESSION['codeSend'] = 1;
    $_SESSION['success'] = 'Code has been sent to your email';
    
    $udise_code = $user['HOI_UDISE_ID'];
    $query = "UPDATE $table_name SET emailVerify = ? WHERE HOI_UDISE_ID = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param('ss', $rand, $udise_code);  // 'ss' because both $rand and $udise_code are strings
    $stmt->execute();
    
    if ($stmt->affected_rows > 0) {
        echo 'Database updated successfully';
    } else {
        echo 'Database update failed';
    }
    
    header('location: HOI_verify.php');
} catch (Exception $e) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
    echo 'Mail is not reachable!';
}
?>