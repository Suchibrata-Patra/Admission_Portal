<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $mobile = isset($_POST["mobile"]) ? $_POST["mobile"] : '';
    $package = isset($_POST["package"]) ? $_POST["package"] : '';
    $dateOfJourney = isset($_POST["dateOfJourney"]) ? $_POST["dateOfJourney"] : '';
    $returnDate = isset($_POST["returnDate"]) ? $_POST["returnDate"] : '';
    $numberOfPersons = isset($_POST["numberOfPersons"]) ? $_POST["numberOfPersons"] : 0;
    $selectCar = isset($_POST["selectCar"]) ? $_POST["selectCar"] : '';
    $numberOfCars = isset($_POST["numberOfCars"]) ? $_POST["numberOfCars"] : '';
    $numberOfRooms = ceil($numberOfPersons / 2);
    // Calculate date duration
    $dateDiff = strtotime($returnDate) - strtotime($dateOfJourney);
    $daysDifference = floor($dateDiff / (60 * 60 * 24));
    $price = 10; // Initialize price to 0
if ($package == 'package1') {
    $package = 'Same Day Return' ;
    $returnDate = $dateOfJourney;
    $numberOfRooms = 'Not Required ';
    
    if ($numberOfPersons <= 2) {
        $price = $numberOfPersons * 3000;
    } elseif ($numberOfPersons <= 5) {
        $price = $numberOfPersons * 2000;
    } else {
        $price = $numberOfPersons * 1500;
    }
} elseif ($package == 'package2') {
    if ($daysDifference == 1) {
        $package = 'One Night Two Days';
        if ($numberOfPersons <= 2) {
            $price = $numberOfPersons * 4000;
        } elseif ($numberOfPersons <= 5) {
            $price = $numberOfPersons * 6000;
        } else {
            $price = $numberOfPersons * 5000; // Change this value as needed
        }
    } elseif ($daysDifference > 1) {
        $package = $daysDifference . ' Nights ' . ($daysDifference + 1) . ' Days Package';
        if ($numberOfPersons <= 2) {
            $price = $numberOfPersons * 1200;
        } elseif ($numberOfPersons <= 5) {
            $price = $numberOfPersons * 1000;
        } else {
            $price = $numberOfPersons * 800; // Change this value as needed
        }
    } else {
        $package = 'Custom Package'; // Change this accordingly or handle other cases
        $price = $numberOfPersons*1200;
    }
}

    $digitalID = time();

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'patra.group.official@gmail.com';
    $mail->Password = 'qmsj xrsg cgfr ksfq';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    $mail->setFrom('patra.group.official@gmail.com', 'Patra');
    $mail->addAddress($email, $name);
    $mail->isHTML(true);

    $mail->Subject = 'Invoice from your website';

    $htmlTemplate = "
        <!DOCTYPE html>
        <html lang='en'>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Email Template</title>
            <!-- Bootstrap CSS -->
            <link href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css' rel='stylesheet'>
            <style>
                body {
                    font-family: 'Helvetica Neue', Arial, sans-serif;
                    background-color: #fff;
                    margin: 0;
                    padding: 20px;
                }
                .invoice-container {
                    max-width: 400px;
                    margin: 0 auto;
                    background-color: #fff;
                    padding: 20px;
                    border-radius: 8px;
                    box-shadow: 0 0 10px rgba(0,0,0,0.1);
                }
                .invoice-header {
                    background-color: #000;
                    color: #fff;
                    padding: 10px;
                    border-top-left-radius: 8px;
                    border-top-right-radius: 8px;
                    text-align: center;
                }
                .invoice-table {
                    width: 100%;
                    margin-top: 20px;
                    border-collapse: collapse;
                }
                .invoice-table th,
                .invoice-table td {
                    padding: 10px;
                    text-align: left;
                    border-bottom: 1px solid #ddd;
                }
                .total-amount {
                    font-size: 16px;
                    font-weight: bold;
                    color: #000;
                }
                .terms-and-conditions {
                    margin-top: 20px;
                    font-size: 12px;
                    color: #333;
                }
                .price-paid-square {
                    width: 85px;
                    height: 60px;
                    background-color: #000;
                    color: #fff;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 14px;
                    font-weight: bold;
                    border-radius: 4px;
                    margin-top: 20px;
                    padding-left :20px;
                    padding-top :20px;
                }
                .google-map-button {
                    display: block;
                    margin-top: 20px;
                    padding: 10px;
                    background-color: #000;
                    color: #fff;
                    text-align: center;
                    text-decoration: none;
                    border-radius: 4px;
                }
            </style>
        </head>
        <body>
            <div class='invoice-container'>
                <div class='invoice-header'>
                    <h2 style='margin-bottom: 0; font-size: 20px;'>Invoice</h2>
                </div>
                <table class='invoice-table'>
                <tr>
    <td><strong>Invoice Number:</strong></td>
    <td>INV-<?php echo time(); ?>
</td>
</tr>


<tr>
    <td><strong>Journey Date:</strong></td>
    <td>$dateOfJourney</td>
</tr>
<tr>
    <td><strong>Return Date:</strong></td>
    <td>$returnDate</td>
</tr>
<tr>
    <td><strong>Amount Due:</strong></td>
    <td class='total-amount'>$price</td>
</tr>
<tr>
    <td><strong>No of Persons:</strong></td>
    <td> $numberOfPersons </td>
</tr>
<tr>
    <td><strong>No of Rooms:</strong></td>
    <td>$numberOfRooms</td>
</tr>
<tr>
    <td><strong>Cars Selected:</strong></td>
    <td>$selectCar</td>
</tr>
<tr>
    <td><strong>Pickup Location:</strong></td>
    <td>Hotel XYZ</td>
</tr>
<tr>
    <td><strong>Drop Location:</strong></td>
    <td>Airport</td>
</tr>
<tr>
    <td><strong>Date of Journey:</strong></td>
    <td>$dateOfJourney</td>
</tr>
<tr>
    <td><strong>Return Date:</strong></td>
    <td>$returnDate</td>
</tr>
<tr>
    <td><strong>Package Name:</strong></td>
    <td>$package</td>
</tr>
</table>
<div class='terms-and-conditions'>
    <strong>Terms and Conditions:</strong>
    <p>Payment due within 30 days. Late payments may incur a fee.</p>
</div>
<div class='price-paid-square'>
    Total Cost: <br> RS.$price
</div>
<a href='https://www.google.com/maps' class='google-map-button'>View on Google Maps</a>
</div>
</body>

</html>
";

$mail->Body = $htmlTemplate;

if ($mail->send()) {
echo "success";
} else {
echo "error";
}
}
?>