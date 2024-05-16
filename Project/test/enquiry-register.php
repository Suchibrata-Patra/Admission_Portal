<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once('dbconnectionrequest.php');

if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: login.php');
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enquiry Register</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    <style>
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

        .btn-download {
            background-color: #fff;
            color: #343a40;
        }
    </style>
</head>

<body style="background-color: #FCF5ED;">
    <a href="index.php" class="Dashboard">
        <i class="material-icons">arrow_back</i>
    </a>
    <div class="container">
        <h1>Enquiry Register</h1>
        <div class="mb-3">
            <a href="enquiry-register.php" class="btn btn-outline-primary btn-sm mr-2">
                <i class="fas fa-list"></i> By Date
            </a>
            <?php
            $sortButtonText = "Sort by Time Stamp";
            if (isset($_GET['sort']) && $_GET['sort'] == 'timestamp') {
                $sortButtonText = "Sorted by Time Stamp";
            }
            ?>
            <a href="?sort=timestamp" class="btn btn-outline-primary btn-sm">
                <i class="fas fa-sort"></i> <?= $sortButtonText ?>
            </a>
        </div>

        <?php
        $today = date('Y-m-d');
        $futureTripsQuery = "SELECT * FROM enquiry_register WHERE dateOfJourney >= '$today'";

        $sortByTimestamp = isset($_GET['sort']) && $_GET['sort'] == 'timestamp';

        if ($sortByTimestamp) {
            $futureTripsQuery .= " ORDER BY time_stamp DESC";
        }

        $futureTripsResult = $conn->query($futureTripsQuery);

        if ($futureTripsResult) {
            if ($futureTripsResult->num_rows > 0) {
                ?>
                <div class="table-responsive" style="background-color: WHITE;">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Contact</th>
                                <th>Package</th>
                                <th>Journey</th>
                                <th>Return</th>
                                <th>Persons</th>
                                <th>Car</th>
                                <th>No.</th>
                                <th>Pickup</th>
                                <th>Price</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php while ($row = $futureTripsResult->fetch_assoc()) : ?>
                                <?php if ($row['dateOfJourney'] >= $today) : ?>
                                    <tr>
                                        <td><?= $row['name'] ?></td>
                                        <td>
                                            <div style="display: flex; align-items: center;">
                                                <a href="tel:<?= $row['mobile'] ?>" class="material-icons"
                                                    style="color: black; background-color:#ffcc00;padding: 10px; border-radius: 5px; margin-right: 10px;">
                                                    call
                                                </a>
                                                <a href="https://wa.me/<?= $row['mobile'] ?>" target="_blank"
                                                    style="padding:-2px;border-radius: 5px;">
                                                    <img src="Asset/whatsapplogo.png" alt="WhatsApp" width="45"
                                                        height="45">
                                                </a>
                                            </div>
                                        </td>
                                        <td><?= $row['package'] ?></td>
                                        <td><?= $row['dateOfJourney'] ?></td>
                                        <td><?= $row['returndate'] ?></td>
                                        <td><?= $row['numberOfPersons'] ?></td>
                                        <td><?= $row['selectcar'] ?></td>
                                        <td><?= $row['numberOfCars'] ?></td>
                                        <td><?= $row['pickuplocation'] ?></td>
                                        <td><?= $row['price'] ?></td>
                                        <td>
                                            <input type="hidden" name="returndate" value="<?= $row['returndate'] ?>">
                                            <form method="post" action="generate_pdf.php" target="_blank"
                                                class="d-inline-block">
                                                <?php foreach ($row as $key => $value) : ?>
                                                    <input type="hidden" name="<?= $key ?>" value="<?= $value ?>">
                                                <?php endforeach; ?>
                                                <button type="submit" class="btn btn-sm btn-download">
                                                    <i class="material-icons">cloud_download</i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            <?php
            } else {
                echo '<p class="alert alert-info">No Enqueries for Upcoming Dates.</p>';
            }
        } else {
            echo '<p class="alert alert-danger">Error fetching future trips: ' . $conn->error . '</p>';
        }

        $futureTripsResult->close();
        $conn->close();
        ?>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
