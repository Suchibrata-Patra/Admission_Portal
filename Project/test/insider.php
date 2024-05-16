<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}

require_once('dbconnectionrequest.php');

// Get the selected year and month from the form submission
$selectedYear = isset($_POST['yearFilter']) ? $_POST['yearFilter'] : 'all';
$selectedMonth = isset($_POST['monthFilter']) ? $_POST['monthFilter'] : 'all';

// Modify the chart query to include the selected year and month conditions
$chartQuery = "SELECT DATE_FORMAT(dateOfJourney, '%Y-%m') AS month, SUM(price) AS totalSales 
               FROM trip_register 
               WHERE (? = 'all' OR YEAR(dateOfJourney) = ?)
                 AND (? = 'all' OR MONTH(dateOfJourney) = ?)
               GROUP BY month";

// Prepare and bind the parameters
$stmt = $conn->prepare($chartQuery);
$stmt->bind_param('ssss', $selectedYear, $selectedYear, $selectedMonth, $selectedMonth);
$stmt->execute();

// Fetch the chart data
$chartResult = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);

// Get unique years for the year filter
$yearFilterQuery = "SELECT DISTINCT YEAR(dateOfJourney) AS year FROM trip_register ORDER BY year DESC";
$yearFilterResult = $conn->query($yearFilterQuery);

if (!$yearFilterResult) {
    die('Error fetching year filter data: ' . $conn->error);
}

// Create an array for the year filter data
$years = [];

while ($yearFilterRow = $yearFilterResult->fetch_assoc()) {
    $years[] = $yearFilterRow['year'];
}

// Get unique months for the month filter
$monthFilterQuery = "SELECT DISTINCT MONTH(dateOfJourney) AS month FROM trip_register ORDER BY month ASC";
$monthFilterResult = $conn->query($monthFilterQuery);

if (!$monthFilterResult) {
    die('Error fetching month filter data: ' . $conn->error);
}

// Create an array for the month filter data
$months = [];

while ($monthFilterRow = $monthFilterResult->fetch_assoc()) {
    $months[] = $monthFilterRow['month'];
}

// Calculate the percentage of one-day tours
$oneDayTourQuery = "SELECT COUNT(*) AS oneDayTours FROM trip_register WHERE DATEDIFF(returnDate, dateOfJourney) = 1";
$oneDayTourResult = $conn->query($oneDayTourQuery);

if (!$oneDayTourResult) {
    die('Error fetching one-day tour data: ' . $conn->error);
}

$oneDayTours = $oneDayTourResult->fetch_assoc()['oneDayTours'];

// Calculate the percentage of tours that are more than 1 day
$totalToursQuery = "SELECT COUNT(*) AS totalTours FROM trip_register";
$totalToursResult = $conn->query($totalToursQuery);

if (!$totalToursResult) {
    die('Error fetching total tour data: ' . $conn->error);
}

$totalTours = $totalToursResult->fetch_assoc()['totalTours'];

// Calculate the percentage
$percentageOneDay = ($oneDayTours / $totalTours) * 100;
$percentageMoreThanOneDay = 100 - $percentageOneDay;

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Business Insider</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap" rel="stylesheet">

    <style>
        /* Your existing styles here */
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f7;
            margin: 0;
            padding: 0;
        }
        #submitBtn {
            border-radius: 65px;
            background: black;
            color: white;
        }
        #monthFilter, #yearFilter {
            border-color: black;
            color: black;
            background-color: white;
            border-radius: 3px;
        }
        .sidebar {
            padding: 10px;
            background-color: #ffffff;
            color: BLACK;
            text-align: left;
            margin-bottom:2%;
        }

        .card {
           font-family: 'Roboto', sans-serif;

            max-width: 80%;
            margin: 20px auto;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 2px;
        }
@media (max-width: 600px) {
        .card {
            max-width: 97%;
            padding: 0px; /* Adjust padding for smaller screens */
        }
        #submitBtn{
            border-radius:4px;
        }
       
    }

        h1 {
            background-color:#ddef75;
            text-align: center;
            font-family: 'Playfair Display', serif;
            font-size:25px !important;
        }

        .filter-container {
            display: flex;
            justify-content: space-between;
            margin-bottom: 20px;
            align-items: center;
            flex-wrap: wrap;
        }

        label {
            font-size: 18px;
            margin-right: 10px;
            color: #495057;
        }

        select {
            padding: 8px;
            font-size: 16px;
            border: 1px solid #ced4da;
            border-radius: 4px;
            margin: 5px;
        }

        .btn-go {
            padding: 8px 15px;
            font-size: 16px;
            background-color: #0071e3;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }

        .btn-reset {
            padding: 8px 15px;
            font-size: 16px;
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin: 5px;
        }

        .btn-go:hover, .btn-reset:hover {
            filter: brightness(90%);
        }

        #totalSales {
                        font-family: 'Roboto', sans-serif;

            font-size: 18px;
            color: BLACK;
            text-align: center;
            background-color: yellow;
            margin-left: 28%;
            margin-right: 28%;
            padding-top: 1.2%;
            padding-bottom: 1.2%;
        }

        #tourLengthPercentage {
                        font-family: 'Roboto', sans-serif;

            font-size: 16px;
            color: #007bff;
            text-align: center;
            margin-top: 10px;
        }

        canvas {
            font-family: 'Roboto', sans-serif;
            max-width: 100%;
            height: auto;
            display: block;
            margin-top: 2px;
        }
    </style>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Include Chart.js library -->
    <style>
  @import url('https://fonts.googleapis.com/css2?family=Playfair+Display&display=swap');
</style>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body style="background-color: #f5f5f7;">
    <div class="sidebar">
        <a href="index.php" class="btn btn-secondary" style="background-color: black; padding-bottom:-10px;margin-bottom:-30px; margin-top:-10px;">Back</a>
    </div>

    <div class="card">
        <div style=" padding-botom:7px; padding-top:5px;">
    <h1 style="color: BLACK;">Insights</h1>
</div>


        <form method="post" action="">
            <div class="filter-container">
                <div>
                    <label for="yearFilter">Year:</label>
                    <select id="yearFilter" name="yearFilter" class="form-control">
                        <option value="all" <?php echo ($selectedYear === 'all') ? 'selected' : ''; ?>>All Years</option>
                        <?php foreach ($years as $year) : ?>
                            <option value="<?= $year ?>" <?php echo ($selectedYear === $year) ? 'selected' : ''; ?>>
                                <?= $year ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div>
                    <label for="monthFilter">Month:</label>
                    <select id="monthFilter" name="monthFilter" class="form-control">
                        <option value="all" <?php echo ($selectedMonth === 'all') ? 'selected' : ''; ?>>All Months</option>
                        <?php for ($i = 1; $i <= 12; $i++) : ?>
                            <option value="<?= $i ?>" <?php echo ($selectedMonth == $i) ? 'selected' : ''; ?>>
                                <?= date('F', mktime(0, 0, 0, $i, 1)) ?>
                            </option>
                        <?php endfor; ?>
                    </select>
                </div>

                <button id="submitBtn" type="submit" class="btn btn-go">Go</button>
            </div>
        </form>

        <p id="totalSales">Total Sales: Rs.<?= isset($chartResult) ? number_format(array_sum(array_column($chartResult, 'totalSales')) / 1000, 2) : 'N/A' ?>K</p>

        <!-- Add a new paragraph for the percentage information -->
        <p id="tourLengthPercentage">
            <?php echo "Same Day tours: " . number_format($percentageOneDay, 2) . "%, <br> More than one-day tours: " . number_format($percentageMoreThanOneDay, 2) . "%"; ?>
        </p>

        <!-- Add a canvas element for the chart -->
        <canvas id="salesChart"></canvas>
    </div>

    <script>
        // JavaScript code to initialize Chart.js
        var ctx = document.getElementById('salesChart').getContext('2d');

        // Assign fixed colors for each year
        var fixedColors = [
            'rgba(135, 206, 250, 0.7)', /* Sky Blue */
            'rgba(255, 182, 193, 0.7)', /* Light Pink */
            'rgba(154, 205, 50, 0.7)', /* Yellow Green */
            'rgba(70, 130, 180, 0.7)', /* Steel Blue */
            'rgba(240, 128, 128, 0.7)', /* Light Coral */
            'rgba(0, 191, 255, 0.7)', /* Deep Sky Blue */
            'rgba(218, 112, 214, 0.7)', /* Orchid */
            'rgba(255, 140, 0, 0.7)', /* Dark Orange */
            'rgba(173, 216, 230, 0.7)', /* Light Blue */
            'rgba(255, 250, 205, 0.7)'/* LemonChiffon */
            // Add more colors as needed
        ];

        var salesChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode(array_column($chartResult, 'month')); ?>,
                datasets: [{
                    label: 'Sales',
                    data: <?php echo json_encode(array_column($chartResult, 'totalSales')); ?>,
                    backgroundColor: fixedColors,
                    borderWidth: 2,
                }]
            },
            options: {
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Month'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Sales Amount (Rs. K)'
                        },
                        ticks: {
                            callback: function (value, index, values) {
                                return (value / 1000).toFixed(1) + 'K';
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>
