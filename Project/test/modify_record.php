<?php
session_start();

// Check if the user is not logged in
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

// Initialize variable to check if there was an error during update
$updateError = false;

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Collect form data
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $pendingPayment = isset($_POST['pending_payment']) ? $_POST['pending_payment'] : '';

    // Ensure $pendingPayment is numeric and not empty before proceeding
    if (!empty($pendingPayment) && is_numeric($pendingPayment)) {
        // Sanitize input to prevent SQL injection
        $name = $conn->real_escape_string($name);
        $pendingPayment = $conn->real_escape_string($pendingPayment);

        // Construct the SQL query
        $sql = "UPDATE `trip_register` SET `pending_payment` = '$pendingPayment' WHERE `name` = '$name'";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            header('Location: future-trip.php');
            exit();
        } else {
            // Set the error flag
            $updateError = true;
            // Display the specific error message
            echo '<div class="alert alert-danger" role="alert">Error: ' . $conn->error . '</div>';
        }
    } else {
        // Display an error if pending_payment is not valid
        echo '<div class="alert alert-danger" role="alert">Invalid pending payment value!</div>';
    }
}

// Close the database connection
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
</head>

<body>
    <a href="index.php" class="btn btn-primary btn-block Dashboard">
        <i class="material-icons">arrow_back</i>
    </a>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <form id="invoiceForm" action="register-trip.php" method="post" class="col-sm-8 col-md-6 needs-validation"
                enctype="multipart/form-data" novalidate>
                <h2 class="text-center mb-4">Invoice Generator</h2>

                <?php
                if ($updateError) {
                    echo '<div class="alert alert-danger" role="alert">
                            Error occurred while updating data!
                          </div>';
                }
                ?>

                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="mb-3">
                    <label for="pending_payment" class="form-label">Pending Payment:</label>
                    <input type="text" class="form-control" id="pending_payment" name="pending_payment" required>
                </div>

                <button type="submit" class="btn btn-primary">Update Pending Payment</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
