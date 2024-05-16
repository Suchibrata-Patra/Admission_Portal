<?php
// Include the dompdf library
require_once 'dompdf/vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Collect form data, including mobile number
$name = isset($_POST["name"]) ? $_POST["name"] : '';
$email = isset($_POST["email"]) ? $_POST["email"] : '';
$mobile = isset($_POST["mobile"]) ? $_POST["mobile"] : '';
$package = isset($_POST["package"]) ? $_POST["package"] : '';
$dateOfJourney = isset($_POST["dateOfJourney"]) ? $_POST["dateOfJourney"] : '';
$returndate  = isset($_POST["returndate"]) ? $_POST["returndate"] : '';
$numberOfPersons = isset($_POST["numberOfPersons"]) ? $_POST["numberOfPersons"] : 0;
$selectcar = isset($_POST["selectcar"]) ? $_POST["selectcar"] : 0;
$payment_done = isset($_POST["payment_done"]) ? $_POST["payment_done"] : 0;
$price = isset($_POST["price"]) ? $_POST["price"] : 0;
$numberOfRooms = ceil($numberOfPersons / 2);
$due_amount = $price - $payment_done;

// Create a PDF document using dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('isFontSubsettingEnabled', true);
$options->set('isRemoteEnabled', true); // Enable remote URLs

$dompdf = new Dompdf($options);
$currentTimestamp = date("YmdHis");
// Load HTML content
$htmlContent = "<!DOCTYPE html>
<html lang='en'>

<head>
    <meta charset='UTF-8'>
    <meta name='viewport' initial-scale=1.0'>
    <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
<link rel='stylesheet' href='https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap'>
   <style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&display=swap')
</style>
<style>
@import url('https://fonts.googleapis.com/css2?family=Cinzel:wght@400..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap')
</style>
    <title>Invoice</title>
    <style>
               body {
font-family: 'Poppins', sans-serif;           
color: BLACK;
            margin: 0px; /* Adjust the margin as needed for equal spacing */
            padding: 0;
        }



        .container {
        font-family: Poppins, sans-serif; 
            max-width:1500px;
            margin: 0 auto;
            overflow: hidden;
            padding:10px;
        }

        .invoice {
        font-family: Poppins, sans-serif; 
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 0px;
            width: 100%;
            margin-top: 30px;
            background-color: #fff;
            margin-right:20px !important;
        }

        .header {
        font-family: Poppins, sans-serif; 
            background-color: #fdf2e3; /* Primary color */
            color: #fff;
            padding: 20px;
            text-align: center;
            border-top-right-radius: 20px;
            border-bottom-right-radius:20px;
            position: relative;
        }

       .brand-icon img {
    width: 17%;
    height: auto;
    border-left: 30px solid WHITE;
    border-bottom: 30px solid WHITE;
    position: absolute;
    margin-top:-20px;
    margin-left:-7px;
    top: 12px;
    left: 2px;
}


        .details {
            margin-top: 20px;
        }

        .details h4 {
            color: #333; /* Dark Gray text color */
        }

        .customer-info,
        .travel-details,
        .price-details,
        .authorised-signatory {
            margin-top: 30px;
        }

        .total-amount {
            margin-top: 20px;
            text-align: right;
            font-size: 1.2em;
        }

        .signature {
            width: 150px;
            height: 60px;
            margin-top: 20px;
        }

        .contact-info {
            background-color: #1f0c0e; 
             font-family: Poppins, sans-serif; 
            color:WHITE;
            padding: 0px;
            border-radius: 0px;
            margin-bottom: 10px;
            text-align: center;
        }

        .price-table {
        font-family:'Cinzel';
            width: 100%;
            margin-top: 20px;
            color:BLACK;
        }

        .price-table th,
        .price-table td {
            border: 1px solid #fdf2e3;
            color:BLACK;
            padding: 8px;
            text-align: left;
        }

        .price-table th {
            background-color: #fdf2e3 ; /* Primary color */
            color: BLACK;
        }
    </style>
</head>

<body>
    <div class='container'>
        <div class='invoice'>
            <div class='header'>
                <div style='border-left:px solid red;'>  <div class='brand-icon' >
                    <img src='https://trip-admin.000webhostapp.com/Asset/image.png' alt='brand icon'>
                </div></div>
                <div style='font-family: Poppins, sans-serif; color: BLACK; font-weight: 900; font-size: 25px;'>     <h1>Invoice</h1>

                <p style='font-fanily:Poppins;'>GANGASAGAR Tourism</p> </div>
               
               
            </div>

            <div class='details'>
               <div class='customer-info'>
    <h4>Customer Information</h4>
    <p style='margin-bottom: -2px !important;'><strong>Name: </strong> $name</p>
    <p style='margin-bottom: -2px !important;'><strong>Email: </strong> $email</p>
    <p style='margin-bottom: -2px !important;'><strong>Mobile: </strong> $mobile</p>
    
</div>


                <div class='travel-details'>
                    <h4>Travel Details</h4>
                    <!-- Add the relevant PHP variables here -->
                                   <div class='customer-info'>

                    <p style='margin-bottom: -2px !important;'><strong>Date of Journey : </strong> $dateOfJourney</p>
    <p style='margin-bottom: -2px !important;'><strong>Return Date : </strong> $returndate</p>
    <p style='margin-bottom: -2px !important;'><strong>No of Persons : </strong> $numberOfPersons</p>
                    </div>

                </div>
            </div>

            <div class='details price-details'>
                <h4>Price Details</h4>
                <table class='price-table'>
                    <thead>
                        <tr>
                            <th>Description</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Add the relevant PHP variables here -->
                        <tr>
                            <td>$package</td>
                            <td>1</td>
                            <td>Rs.$price </td>
                        </tr>
                        <tr>
                            <td>Token Amount Paid</td>
                            <td> - X - </td>
                            <td>$payment_done</td>
                        </tr>
                        <tr>
                            <td>Residue</td>
                             <td> - X - </td>
                            <td>$due_amount</td>
                        </tr>
                    </tbody>
                </table>

                <div class='total-amount'>
                    <p><strong>Total Amount:</strong> Rs. " . number_format($price) . "</p>
                    <p><strong>Residue :</strong> Rs. " . number_format($due_amount) . "</p>

                </div>
            </div>

          <div class='authorised-signatory' style='position: relative; text-align: right;'>
    <img src='http://trip-admin.000webhostapp.com/Asset/signature.png' alt='Signature' class='signature' style='position: relative; display: inline-block;'>
    <div style='display: block;'>
        <br> <!-- Add a line break -->
        <h5 style='margin-top:-5px;'>Authorised Signatory</h5>
    </div>
</div>


            <div class='contact-info' style='margin-top: 30px; background-color: #ffcda3; color: BLACK ; padding: 15px; border-radius: 5px; text-align: center;'>
    <p style='margin: 5px 0; font-family: 'Poppins', sans-serif; font-weight: bold; font-size: 18px;'>Gangasagar Tourism</p>
    <p style='margin: 5px 0; font-family: 'Poppins', sans-serif;'>Phone: 8145302135 | Email: official@gmail.com     | Digital Signature ID : $currentTimestamp</p>
    <p style='margin: 5px 0; font-family: 'Poppins', sans-serif;'>Website: <a href='https://gangasagartourism.co.in/' style='color: #fff; text-decoration: underline;'>https://gangasagartourism.co.in/</a></p>
</div>

        </div>

        
    </div>
</body>

</html>
";

// Load HTML content into dompdf
$dompdf->loadHtml($htmlContent);

// Set paper size (A4)
$dompdf->setPaper('A3', 'portrait');

// Set base path for images
$dompdf->setBasePath(__DIR__);

// Render PDF (first pass to get total pages)
$dompdf->render();

// Save the PDF to a file
$pdfOutput = $dompdf->output();
file_put_contents('invoice.pdf', $pdfOutput);

// Provide a download link
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="invoice.pdf"');
readfile('invoice.pdf');
?>
