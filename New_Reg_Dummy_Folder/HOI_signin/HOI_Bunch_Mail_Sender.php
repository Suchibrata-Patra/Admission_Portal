<?php 
ini_set('display_errors', 1); 
error_reporting(E_ALL);

require 'database.php';
require 'HOI_Session.php';
require 'HOI_super_admin.php';
require __DIR__ . '../../../Assets/vendor/autoload.php';
require '.../../../../Assets/Mail_Login_Credentials.php';

// Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$student_table_name = $udise_code . '_Student_Details';

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['allow_admission']) && isset($_POST['admission_allow']) && is_array($_POST['admission_allow'])) {
    $allowedStudents = array_map(function($value) use ($db) {
        return "'" . mysqli_real_escape_string($db, $value) . "'";
    }, $_POST['admission_allow']);

    if (!empty($allowedStudents)) {
        $allowedStudentsList = implode(',', $allowedStudents);

        // Retrieve email addresses of the selected students
        $mailingQuery = "SELECT reg_no, email FROM $student_table_name WHERE reg_no IN ($allowedStudentsList)";
        $result = mysqli_query($db, $mailingQuery);
        if ($result) {
            $emails = [];
            $reg_nos = [];
            while ($row = mysqli_fetch_assoc($result)) {
                $emails[] = $row['email'];
                $reg_nos[] = $row['reg_no'];
            }
            
            // Function to generate a 6-character alphanumeric string
            function generateRandomString($length = 6) {
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                for ($i = 0; $i < $length; $i++) {
                    $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                return $randomString;
            }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../../Assets/images/favicon.png" type="image/svg+xml">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="../..//../../../../Assets/css/Generalised_HOI_Stylesheet.css">


    <title style="font-family: 'Roboto', Times, serif;">Haggle</title>
</head>

<body style="font-family: 'Roboto', sans-serif;">


    <!-- SIDEBAR -->
    <?php include('HOI_Sidebar.php') ?>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <!-- <a href="#" class="nav-link">Categories</a> -->
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <?php 
                            echo '<center>';
                            echo '<table class="table table-bordered">';
                            echo '<tr><th>Email </th> <th>Status </th></tr>';
		$rand = generateRandomString();  // Generate the OTP
		foreach ($emails as $index => $email) {
			$mail = new PHPMailer(true);
			try {
				// Enable SMTP debugging
				$mail->SMTPDebug = 0;  // Change to 0 or 1 for less verbose debugging
				
				// Set PHPMailer to use SMTP
				$mail->isSMTP();
				
				// Set SMTP host name
				$mail->Host = 'smtp.gmail.com';
				
				// Set this to true if SMTP host requires authentication to send email
				$mail->SMTPAuth = true;
				
				// Provide username and password
				$mail->Username = $mailid; // This is Fetched from the 'Mail_Login_Credentials.php' File
				$mail->Password = $mailid_login_password ;  // Use the correct password or app-specific password
				
				// If SMTP requires TLS encryption then set it
				$mail->SMTPSecure = 'ssl';
				
				// Set TCP port to connect to
				$mail->Port = 465;
				
				$mail->From = $mailid;
				$mail->FromName = 'Patra Inc.';
				
				$mail->addAddress($email);  // Add the student's email address
				
				$mail->Subject = 'Take Admissions';
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
						<p>Dear Student,</p>
						<p>You have been Selected for Admission at Our Institution.</p>
						<p>To ensure the admission Kindly Visit the Admission Login Page On or Before the Following Date - </p>
						<p style='text-align: center; font-size: 24px;'><strong> 12/01/2024</strong></p>
						<p>If you've Already Taken Admission , You Can Safely Ignore this Messages.</p>
						<p>Thank you for choosing us.</p>
						<div class='footer'>
							<p>Best Regards,</p>
							<p>The Patra Inc. Team</p>
						</div>
					</div>
				</body>
				</html>
				";
				$mail->send();

				// Update the Reminder_Email_Sent field after successfully sending the email
                $updateQuery = "UPDATE $student_table_name SET Reminder_Email_Sent = 1 WHERE reg_no = '" . $reg_nos[$index] . "'";
                mysqli_query($db, $updateQuery);
                
				// Print the email address immediately after sending the email
                echo '<tr><td> ' . $email . '</td><td>Sent</td></tr>';

                
				ob_flush(); // Flush the output buffer to ensure the message is displayed immediately
				flush(); // Ensure the buffer is sent to the browser
			} catch (Exception $e) {
				echo '<center>';
				echo 'Mailer Error: ' . $mail->ErrorInfo . '<br>';
				echo 'Mail is not reachable!<br>';
				echo '<center>';
			}
		}

		echo 'Messages have been sent successfully<br>';
		echo '<a href="index.php">Send </a>';
	} else {
		echo "Error fetching email addresses: " . mysqli_error($db);
	}
} else {
	echo "No students selected for admission.";
}
} else {
echo "Invalid request.";
}
echo '</table>';
echo '</center>';
$table_name = $udise_code . '_HOI_Login_Credentials';
// echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
// echo 'Table name: ' . $table_name . '<br>';
ob_flush(); 
flush();
?>
</main>
        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script> document.getElementById('currentYear').textContent = new Date().getFullYear(); </script>
    <script src="script.js"></script>
</body>
</html>