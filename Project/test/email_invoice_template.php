
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
                    width: 50px;
                    height: 50px;
                    background-color: #000;
                    color: #fff;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    font-size: 14px;
                    font-weight: bold;
                    border-radius: 4px;
                    margin-top: 20px;
                    padding:20px;
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
    Rs.<br>$price
</div>
<a href='https://www.google.com/maps' class='google-map-button'>View on Google Maps</a>
</div>
</body>

</html>