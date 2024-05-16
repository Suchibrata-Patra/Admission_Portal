<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Start session to manage user authentication
session_start();

// Check if the user is not logged in, redirect to login page
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

// Include the database connection script
require_once('dbconnectionrequest.php');

// Logout logic
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

// Initialize variable to check if there was an error during insertion
$insertError = false;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $email = isset($_POST['email']) ? $_POST['email'] : '';
    $mobile = isset($_POST['mobile']) ? $_POST['mobile'] : '';
    $package = isset($_POST['package']) ? $_POST['package'] : '';
    $dateOfJourney = isset($_POST['dateOfJourney']) ? $_POST['dateOfJourney'] : '';
    $returnDate = isset($_POST['returnDate']) ? $_POST['returnDate'] : '';
    $numberOfPersons = isset($_POST['numberOfPersons']) ? $_POST['numberOfPersons'] : 0;
    $selectCar = isset($_POST['selectCar']) ? $_POST['selectCar'] : '';
    $numberOfCars = isset($_POST['numberOfCars']) ? $_POST['numberOfCars'] : '';
    $pickupLocation = isset($_POST['pickupLocation']) ? $_POST['pickupLocation'] : '';
    $dropLocation = isset($_POST['dropLocation']) ? $_POST['dropLocation'] : '';

    // Calculate date duration
    $dateDiff = strtotime($returnDate) - strtotime($dateOfJourney);
    $daysDifference = floor($dateDiff / (60 * 60 * 24));
    
if ($daysDifference == 0) {
    $returnDate = $dateOfJourney;
}

// Ensure $returnDate has a valid value before using it in the SQL query
$returnDate = ($returnDate != '') ? "'$returnDate'" : 'NULL';
    // Extract MatrixID
    $idextraction = "SELECT MatrixID FROM PriceMatrix
                     WHERE MinPersons <= '$numberOfPersons' AND '$numberOfPersons' <= MaxPersons";
    $resultMatrix = $conn->query($idextraction);

    if ($resultMatrix->num_rows > 0) {
        $row = $resultMatrix->fetch_assoc();
        $Matrixid = $row['MatrixID'];

        // Determine the correct column based on the number of days
        if ($daysDifference == 0) {
            $priceColumn = "SingleDayPricePerPerson";
        } else {
            $priceColumn = "MultiDayPricePerPerson";
        }

        // Retrieve the price from PriceMatrix
        $sql = "SELECT $priceColumn FROM PriceMatrix WHERE MatrixID = $Matrixid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $pricePerPerson = $row[$priceColumn];

            // Calculate the total price
            $price = $pricePerPerson * $numberOfPersons;

            // Set payment_done to 0
            $payment_done = 0;

            // SQL query to insert data into the database
            $sqlInsert = "INSERT INTO trip_register (name, email, mobile, package, dateOfJourney, returndate, numberOfPersons, selectcar, numberOfCars, pickuplocation, dropLocation, price, payment_done) 
                          VALUES ('$name', '$email', '$mobile', '$package', '$dateOfJourney', $returnDate, '$numberOfPersons', '$selectCar', '$numberOfCars', '$pickupLocation', '$dropLocation', $price, $payment_done)";

            // Execute the query
            if ($conn->query($sqlInsert) === TRUE) {
                // Redirect to future-trip.php after successful insertion
                header('Location: future-trip.php');
                exit();
            } else {
                $insertError = true;
                echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
            }
        } else {
            $insertError = true;
            echo '<div class="alert alert-danger" role="alert">Error retrieving price from PriceMatrix.</div>';
        }
    } else {
        $insertError = true;
        echo '<div class="alert alert-danger" role="alert">Error: No MatrixID found for the specified number of persons.</div>';
    }
} else {
    unset($_SESSION['form_data']);
}

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;400&display=swap');
</style>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Roboto', sans-serif;
        }

        .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 50px;
        }

        .form-label {
            color: #495057;
            background-color:#ddef75;
            padding-left:5px;
            padding-right:5px;
            padding-top:2.5px;
            padding-bottom:2.5px;
            margin-top:4px;
            margin-bottom:-2px;
            border-top-right-radius:6.5px;
            border-top-left-radius:6.5px;
            
            
        }
       .form-control{
      border-radius:3.5px;
      border-color:NONE;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-success {
            background-color: #28a745;
            border-color: #28a745;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }
        .Dashboard{
            margin-left: 20px;
            margin-top: -20px;
            margin-bottom: -70px;
            background-color: black;
            color: white;
        }
    </style>
</head>

<body>
<a href="index.php" class="btn btn-primary btn-block Dashboard">
        <i class="material-icons">arrow_back</i>
    </a>
    
    <div class="container mt-5" style="border-radius:20px; margin-bottom:200px;border:4px;border-color:GREEN;">
        <div class="row justify-content-center">
            <form id="invoiceForm" action="duplicate.php" method="post" class="col-sm-8 col-md-6 needs-validation"
                enctype="multipart/form-data" novalidate>
                <h2 class="text-center mb-4">Register Trip</h2>

                <?php
                if ($insertError) {
                    echo '<div class="alert alert-danger" role="alert">
                            Error occurred while inserting data!
                          </div>';
                }
                ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Name: <span style="color: red;"> *</span></label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email: </label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+91 INDIA <span style="color: red;"> *</span></span>
                        </div>
                        <input type="tel" class="form-control" id="mobile" name="mobile" pattern="[0-9]{10}" required>
                    </div>
                </div>

                <div class="mb-3" id="dateOfJourneyDiv" style="display: none;">
                    <label for="dateOfJourney">Date of Journey:<span style="color: red;"> *</span> </label>
                    <input type="date" class="form-control" id="dateOfJourney" name="dateOfJourney">
                </div>

                <div class="mb-3" id="dateOfReturnDiv" style="display: none;">
                    <label for="returnDate">Return Date: <span style="color: red;"> *</span></label>
                    <input type="date" class="form-control" id="returnDate" name="returnDate">
                </div>
                <div class="mb-3">
                    <label for="numberOfPersons">Number of Persons: <span style="color: red;"> *</span></label>
                    <input type="number" class="form-control" id="numberOfPersons" name="numberOfPersons" required>
                      <div class="mb-3" id="dateOfJourneyDiv" style="display: none;">
                    <label for="dateOfJourney">Date of Journey:<span style="color: red;"> *</span></label>
                    <input type="date" class="form-control" id="dateOfJourney" name="dateOfJourney">
                </div>

                <div class="mb-3" id="dateOfReturnDiv" style="display: none;">
                    <label for="returnDate">Return Date:<span style="color: red;"> *</span></label>
                    <input type="date" class="form-control" id="returnDate" name="returnDate">
                </div>
                </div>
                
                <div class="mb-3">
                    <div class="row">
                        <div class="col-md-6">
                            <label for="selectCar" class="form-label">Select Car: <span style="color: red;"> *</span></label>
                            <select class="form-select" id="selectCar" name="selectCar" required>
                                <option selected disabled value="">Choose...</option>
                                 <option value="Swift Dezire">Swift Dezire</option>
    <option value="Innova">Innova</option>
    <option value="Xylo">Xylo</option>
    <option value="Honda Civic">Honda Civic</option>
    <option value="Toyota Corolla">Toyota Corolla</option>
    <option value="Ford Mustang">Ford Mustang</option>
    <option value="Volkswagen Golf">Volkswagen Golf</option>
    <option value="Chevrolet Camaro">Chevrolet Camaro</option>
    <option value="Nissan Altima">Nissan Altima</option>
                                <!-- Add more options as needed -->
                            </select>
                            <div class="invalid-tooltip">
                                Please select a valid car.
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="numberOfCars" class="form-label">Number of Cars:</label>
                            <input type="number" class="form-control" id="numberOfCars" name="numberOfCars" required>
                            <div class="invalid-tooltip">
                                Please provide a valid number of cars.
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="mb-3">
    <label for="pickupLocation" class="form-label">Pickup Location: <span style="color: red;"> *</span></label>
    <select class="form-control" id="pickupLocation" name="pickupLocation" required>
        <option selected value="Airport">Airport</option>
        <option value="Howrah Station">Howrah Station</option>
        <option value="Sealdah">Sealdah</option>
        <option value="Salt Lake City">Salt Lake City</option>
        <option value="New Town">New Town</option>
        <option value="Behala">Behala</option>
        <option value="Dum Dum">Dum Dum</option>
        <option value="Kasba">Kasba</option>
        <option value="Tollygunge">Tollygunge</option>
        <option value="Ballygunge">Ballygunge</option>
        <option value="Jadavpur">Jadavpur</option>
        <option value="Garia">Garia</option>
        <option value="Rajarhat">Rajarhat</option>
        <option value="Kolkata Maidan">Kolkata Maidan</option>
        <option value="Shyambazar">Shyambazar</option>
        <option value="Joka">Joka</option>
        <option value="Lake Gardens">Lake Gardens</option>
        <option value="Baguiati">Baguiati</option>
        <!-- Add other residential areas as needed -->
    </select>
</div>

<div class="mb-3">
    <label for="dropLocation"  class="form-label">Drop Location: <span style="color: red;"> *</span></label>
    <select class="form-control" id="dropLocation" name="dropLocation" required>
        <option selected value="Airport">Airport</option>
        <option value="Howrah Station">Howrah Station</option>
        <option value="Sealdah">Sealdah</option>
        <option value="Salt Lake City">Salt Lake City</option>
        <option value="New Town">New Town</option>
        <option value="Behala">Behala</option>
        <option value="Dum Dum">Dum Dum</option>
        <option value="Kasba">Kasba</option>
        <option value="Tollygunge">Tollygunge</option>
        <option value="Ballygunge">Ballygunge</option>
        <option value="Jadavpur">Jadavpur</option>
        <option value="Garia">Garia</option>
        <option value="Rajarhat">Rajarhat</option>
        <option value="Kolkata Maidan">Kolkata Maidan</option>
        <option value="Shyambazar">Shyambazar</option>
        <option value="Joka">Joka</option>
        <option value="Lake Gardens">Lake Gardens</option>
        <option value="Baguiati">Baguiati</option>
        <!-- Add other residential areas as needed -->
    </select>
</div>
                
                
                <button type="submit" class="btn btn-primary btn-block">Submit</button>
            </form>
        </div>
        
    </div>
    <script>
        function toggleDateFields() {
            const packageSelect = document.getElementById('package');
            const dateOfJourneyDiv = document.getElementById('dateOfJourneyDiv');
            const dateOfReturnDiv = document.getElementById('dateOfReturnDiv');

            if (packageSelect.value === 'package1') {
                dateOfJourneyDiv.style.display = 'block';
                dateOfReturnDiv.style.display = 'none';
            } else {
                dateOfJourneyDiv.style.display = 'block';
                dateOfReturnDiv.style.display = 'block';
            }
        }

        toggleDateFields();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
