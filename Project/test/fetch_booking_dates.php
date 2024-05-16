<?php
// fetch_booking_dates.php
header('Content-Type: application/json');

// Include the database connection script
require_once('dbconnectionrequest.php');

// Fetch booking dates from the database
$sqlBookingDates = "SELECT dateOfJourney FROM trip_register";
$resultBookingDates = mysqli_query($conn, $sqlBookingDates);

$bookingDates = array();

while ($row = mysqli_fetch_assoc($resultBookingDates)) {
    $bookingDates[] = $row['dateOfJourney'];
}

echo json_encode($bookingDates);
?>
<?php
// fetch_booking_dates.php
header('Content-Type: application/json');

// Include the database connection script
require_once('dbconnectionrequest.php');

// Fetch booking dates from the database
$sqlBookingDates = "SELECT dateOfJourney FROM trip_register";
$resultBookingDates = mysqli_query($conn, $sqlBookingDates);

$bookingDates = array();

while ($row = mysqli_fetch_assoc($resultBookingDates)) {
    $bookingDates[] = $row['dateOfJourney'];
}

echo json_encode($bookingDates);
?>
