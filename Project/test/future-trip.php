<?php
session_start();
if (!isset($_SESSION["username"])) {
    header("Location: login.php");
    exit();
}

require_once "dbconnectionrequest.php";

if (isset($_POST["logout"])) {
    session_destroy();
    header("Location: login.php");
    exit();
}

$today = date("Y-m-d");
$futureTripsQuery = "SELECT * FROM trip_register WHERE dateOfJourney >= '$today'";

$sortByTimestamp = isset($_GET["sort"]) && $_GET["sort"] == "timestamp";

if ($sortByTimestamp) {
    $futureTripsQuery .= " ORDER BY time_stamp DESC";
}

$futureTripsResult = $conn->query($futureTripsQuery);

if (
    $_SERVER["REQUEST_METHOD"] === "POST" &&
    isset($_POST["id"], $_POST["payment_done"])
) {
    $id = $_POST["id"];
    $payment_done = $_POST["payment_done"];

    $updateQuery = "UPDATE trip_register SET payment_done = '$payment_done' WHERE id = $id";
    if ($conn->query($updateQuery)) {
        // Handle successful update (you can redirect or display a success message here)
    } else {
        // Handle update failure (you can redirect or display an error message here)
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Future Trips</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600&display=swap');
</style>
    <style>
       body {
font-family: 'Poppins', sans-serif;
font-weight: 400; 
        }
        .Dashboard {
            margin-left: 20px;
            margin-top: 7px;
            background-color: black;
            color: white;
            padding-top: 19px;
            padding-left: 7px;
            padding-right: 7px;
            border-radius: 5px;
        }

        .btn-back {
            background-color: #343a40;
            color: #fff;
            padding: 8px;
            margin-left: 10px;
            margin-top: 10px;
        }

        .btn-modify {
            background-color: #ffc107;
            color: #fff;
            padding: 3px;
            color: BLACK;
            border-radius: 7px;
        }

        .btn-download {
            background-color: #fff;
            color: #343a40;
        }

     .card {
    margin-top: 10px;
    border-radius: 30px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Light grey shadow */
    transition: transform 0.3s ease-in-out;
}


.card:hover {
    transform: scale(1.001); /* Hover zoom effect */
}


    .card-title {
        border-bottom: 2px solid #bcbad1; /* Add this line for the horizontal line */
        padding-bottom:7px;
    }
       .filter_buttons{
           background-color:#1777ed;
           color:WHITE;
           border-radius:50px;
       }
      
    </style>

</head>

<body style="background-color: #f5f5f7;">
    <a href="index.php" class="Dashboard">
        <i class="material-icons">arrow_back</i>
    </a>
    <div class="container">
        <h1>Future Trips</h1>
        <div class="mb-3">
            <a href="future-trip.php" class="btn btn-outline-primary btn-sm mr-2 filter_buttons">
                <i class="fas fa-list"></i> By Date
            </a>
            <?php
            $sortButtonText = "Sort by Time Stamp";
            if (isset($_GET["sort"]) && $_GET["sort"] == "timestamp") {
                $sortButtonText = "Sorted by Time Stamp";
            }
            ?>
            <a href="?sort=timestamp" class="btn btn-outline-primary btn-sm filter_buttons">
                <i class="fas fa-sort"></i> <?= $sortButtonText ?>
            </a>
        </div>

  <!--Printing the cards--->
<?php while ($row = $futureTripsResult->fetch_assoc()): ?>
    <?php if ($row["dateOfJourney"] >= $today): ?>
        <div class="card mb-4">
            <div class="card-body" style="padding-left:8%;padding-right:8%;padding-bottom:3%;">
                <h5 class="card-title"><?= $row["name"] ?></h5>
                <p class="card-text text-center mb-3" style="margin-top:-5px;">
                    <span style="margin-left:-3px;"><?= $row["pickuplocation"] ?></span>
                    <span class="circle" style="display: inline-block; background-color:WHITE; width: 40px; height: 40px; border-radius: 50%; margin-left:-3px;">
                        <i class="material-icons" style="font-size: 20px; color: BLACK; line-height: 40px;">trending_flat</i>
                    </span> 
                    <span class="circle" style="display: inline-block; background-color: #ddef75; width: 40px; height: 40px; border-radius: 50%; margin-left:-3px;">
                        <i class="material-icons" style="font-size: 20px; color: BLACK; line-height: 40px;">sailing</i>
                    </span>
                    <span class="circle" style="display: inline-block; background-color:WHITE; width: 40px; height: 40px; border-radius: 50%; margin-left:-3px;">
                        <i class="material-icons" style="font-size: 20px; color: BLACK; line-height: 40px;">trending_flat</i>
                    </span>
                    <span style="margin-left:-3px;"><?= $row["dropLocation"] ?></span>
                </p>
                
                <div class="row mt-3" style="margin-top:-4px;">
                    <div class="col-md-6">
                        
                        <p class="card-text text-center mb-3" >
                             <span class="circle" style="display: inline-block; background-color: #ddef75; width: 30px; height: 30px; border-radius: 50%; margin: 0 4px;">
        <i class="material-icons" style="font-size: 20px; color: BLACK; line-height: 30px;">event</i>
    </span>
<span><?= date("d-M-Y", strtotime($row["dateOfJourney"])) ?></span>
   <span class="circle" style="display: inline-block; background-color: #ddef75; width: 30px; height: 30px; border-radius: 50%; margin: 0 4px;">
        <i class="material-icons" style="font-size: 20px; color: BLACK; line-height: 30px;">event</i>
    </span>
<span><?= date("d-M-Y", strtotime($row["returndate"])) ?></span>
</p>
<div style="display: flex; align-items: center;">
                            <i class="material-icons" style="color: #9e4649; margin-top:-4px; margin-right: 5px; line-height: 30px;background-color:#fce2e2; border-radius:50px;padding-right:8px;padding-left:3.5px;margin-bottom:3px;">group</i>
                            <span><?= $row["numberOfPersons"] ?> Persons </span>
                        </div>
                        <p style="font-weight:400; margin:-1px;" ><i class="material-icons" style="color:WHITE; margin-right: 5px; line-height: 30px;background-color:#1c4e6f; border-radius:50px;padding-right:3.5px;padding-left:3.5px;">currency_rupee</i><?= $row[
                            "price"
                        ] ?> ( Token: <?= $row["payment_done"] ?>)</p>
                        <div class="d-flex justify-content-between align-items-start">
                </div>
                        <p><i class="material-icons" style="color: BLACK; margin-top:2px; margin-right: 5px; line-height: 30px;background-color:#f1b749; border-radius:50px;padding-right:5px;padding-left:3.5px;">directions_car</i><?= $row[
                            "selectcar"
                        ] ?>( <?= $row["numberOfCars"] ?> )</p>

                          
                          <!---Add Button Here -->
                          <div class="d-flex align-items-center justify-content-center" style="border-radius:30px;background-color:#efeff2; border:1px solid GREY; margin-left:3%;margin-right:3%;padding-top:2%;padding-bottom:2%;">
    <!-- Modify Button -->
    <button type="button" class="btn btn-sm btn-modify" style="padding-top:7px; padding-right:7px;padding-left:7px; border-radius:40px; background-color:#ddef75; margin-right:7px;"
                                    data-id="<?= $row["id"] ?>"
                                    data-payment_done="<?= $row[
                                        "payment_done"
                                    ] ?>">
                                <i class="material-icons">create</i>
                            </button>

    <!-- Download Button -->
    <form method="post" action="generate_pdf_clone.php" target="_blank" class="d-inline-block mr-2">
        <?php foreach ($row as $key => $value): ?>
            <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
        <?php endforeach; ?>
        <button type="submit" class="btn btn-download" style="padding-top:7px; padding-right:7px;padding-left:7px; border-radius:40px; background-color:#ddef75;">
            <i class="material-icons">cloud_download</i>
        </button>
    </form>

    <!-- Caller Button -->
    <a href="tel:<?= $row[
        "mobile"
    ] ?>" class="btn  mr-2" style="padding-top:7px; padding-right:7px;padding-left:7px; border-radius:40px; background-color:#ddef75;">
        <i class="material-icons">call</i>
    </a>

    <!-- WhatsApp Button -->
    <a href="https://wa.me/<?= $row[
        "mobile"
    ] ?>" target="_blank" class="btn" style="background-color:#efeff2 !important;">
        <img src="Asset/whatsapplogo.png" alt="WhatsApp" width="40" height="40" >
    </a>
</div>

                          
                          
                    </div>
                    <div class="col-md-6">
                        <!-- Other Info -->
                        <!-- ... (Add any other information you want to display) ... -->
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endwhile; ?>
<!--End of Printing the cards-->

       
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

   <!-- Existing scripts... -->

<script>
    function setModifyPaymentModalData(id, payment_done) {
        $('#modifyPaymentId').val(id);
        $('#paymentStatus').val(payment_done);
    }

    $('.btn-modify').click(function () {
        var id = $(this).data('id');
        var payment_done = $(this).data('payment_done');
        setModifyPaymentModalData(id, payment_done);
        $('#modifyPaymentModal').modal('show');
    });
</script>

<!-- Missing part: Add the modification modal here -->
<div class="modal" id="modifyPaymentModal" tabindex="-1" role="dialog" aria-labelledby="modifyPaymentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modifyPaymentModalLabel">Modify Payment Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="modifyPaymentForm" method="post" action="">
                            <input type="hidden" name="id" id="modifyPaymentId" value="">
                            <div class="form-group">
                                <label for="paymentStatus">Payment Status:</label>
                                <input type="text" class="form-control" id="paymentStatus" name="payment_done" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
<script>
 function setModifyPaymentModalData(id, payment_done) {
            $('#modifyPaymentId').val(id);
            $('#paymentStatus').val(payment_done);
        }

        $('.btn-modify').click(function () {
            var id = $(this).data('id');
            var payment_done = $(this).data('payment_done');
            setModifyPaymentModalData(id, payment_done);
            $('#modifyPaymentModal').modal('show');
        });
      
</script>

</body>

</html>
