<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST["name"]) ? $_POST["name"] : '';
    $email = isset($_POST["email"]) ? $_POST["email"] : '';
    $mobile = isset($_POST["mobile"]) ? $_POST["mobile"] : '';
    $package = isset($_POST["package"]) ? $_POST["package"] : '';
    $dateOfJourney = isset($_POST["dateOfJourney"]) ? $_POST["dateOfJourney"] : '';
    $returnDate = isset($_POST["returnDate"]) ? $_POST["returnDate"] : '';
    $numberOfPersons = isset($_POST["numberOfPersons"]) ? (int)$_POST["numberOfPersons"] : 0;
    $selectCar = isset($_POST["selectCar"]) ? $_POST["selectCar"] : '';
    $numberOfCars = isset($_POST["numberOfCars"]) ? $_POST["numberOfCars"] : '';
    $numberOfRooms = ceil($numberOfPersons / 2);

    // Calculate date duration
    $dateDiff = strtotime($returnDate) - strtotime($dateOfJourney);
    $daysDifference = floor($dateDiff / (60 * 60 * 24));
    $price = 10; // Initialize price to 0

    if ($package == 'package1') {
        $package = 'Same Day Return';
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
            $price = $numberOfPersons * 1200;
        }
    }

    // Echo only the variable values
    echo "$name<br>";
    echo "$email<br>";
    echo "$mobile<br>";
    echo "$package<br>";
    echo "$dateOfJourney<br>";
    echo "$returnDate<br>";
    echo "$numberOfPersons<br>";
    echo "$selectCar<br>";
    echo "$numberOfCars<br>";
    echo "$numberOfRooms<br>";
    echo "$daysDifference<br>";
    echo "$price<br>";
}
?>
