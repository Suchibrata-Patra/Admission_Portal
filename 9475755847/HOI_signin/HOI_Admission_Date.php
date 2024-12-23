<?php include(__DIR__ . '/../../exception_handler.php'); ?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_Session.php';
require 'HOI_Super_Admin.php';

if (!isset($udise_code) || !isset($udiseid)) {
    die("UDISE code and ID must be set");
}

$table_name = $udise_code . '_HOI_Login_Credentials';
$student_table_name = $udise_code .'_Student_Details';

$udiseid = mysqli_real_escape_string($db, $udiseid);
$query = "SELECT * FROM $table_name WHERE `HOI_UDISE_ID` = '$udiseid' LIMIT 1";
$results = mysqli_query($db, $query);

if (!$results) {
    die("Error in query: " . mysqli_error($db));
}

$user = mysqli_fetch_assoc($results);
if ($user['numberVerify'] != 1 || $user['emailVerify'] != 1) {
    echo "<script>window.location.href = 'HOI_verify.php';</script>"; 
}
if (!$user) {
    die("User not found");
}
// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $start_date = mysqli_real_escape_string($db, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($db, $_POST['end_date']);
    $First_merit_list_date = mysqli_real_escape_string($db, $_POST['First_merit_list_date']);
    $Admission_Beginning_for_First_List = mysqli_real_escape_string($db, $_POST['Admission_Beginning_for_First_List']);
    $Admission_Closes_For_First_List = mysqli_real_escape_string($db, $_POST['Admission_Closes_For_First_List']);
    $Second_List = mysqli_real_escape_string($db, $_POST['Second_List']);


    // Check if end date is before start date
    if (strtotime($end_date) < strtotime($start_date)) {
        $message = "Error: End date must be after the start date.";
    } else {
        // Update admission dates in the database
        $update_query = "UPDATE `$table_name`
                 SET `Formfillup_Start_Date` = '$start_date', 
                     `Formfillup_Last_Date` = '$end_date', 
                     `First_merit_list_date` = '$First_merit_list_date', 
                     `Admission_Beginning_for_First_List` = '$Admission_Beginning_for_First_List', 
                     `Admission_Closes_For_First_List` = '$Admission_Closes_For_First_List', 
                     `Second_List` = '$Second_List'
                 WHERE `HOI_UDISE_ID` = '$udiseid'";
$update_result = mysqli_query($db, $update_query);

        if ($update_result) {
            $message = "Admission dates updated successfully.";
        } else {
            $message = "Error updating admission dates: " . mysqli_error($db);
        }
    }
}


// Fetch the current admission dates
$admission_query = "SELECT `Formfillup_Start_Date`, `Formfillup_Last_Date`,`First_merit_list_date`,`Admission_Beginning_for_First_List`,`Admission_Closes_For_First_List`,`Second_List` FROM $table_name WHERE `HOI_UDISE_ID` = '$udiseid' LIMIT 1";
$admission_results = mysqli_query($db, $admission_query);
$admission_dates = mysqli_fetch_assoc($admission_results);

$current_date = date('Y-m-d');
if ($admission_dates['Formfillup_Last_Date'] < $current_date) {
    $application_status = "Admission Deadline is Over";
} else {
    $application_status = "Application Portal is Live !";
}

function formatDate($date) {
    $datetime = new DateTime($date);
    return $datetime->format('l, jS F Y'); // 'l' gives the full textual representation of the day of the week
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- FAVICON -->
    <link rel="shortcut icon" href="../../../Assets/images/favicon.png" type="image/svg+xml">

    <!-- Boxicons -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- My CSS -->
    <link rel="stylesheet" href="/../../../../Assets/css/Generalised_HOI_Stylesheet.css">

    <title style="font-family: 'Roboto', Times, serif;">Haggle</title>
</head>

<body style="font-family: 'Roboto', sans-serif;">

    <!-- SIDEBAR -->
    <?php include('HOI_Sidebar.php') ?>
    <!-- SIDEBAR -->

    <!-- CONTENT -->
    <section id="content">
        <!-- NAVBAR -->
        <nav>
            <i class='bx bx-menu'></i>
            <form action="#">
                <div class="form-input">
                    <input type="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
                </div>
            </form>
            <input type="checkbox" id="switch-mode" hidden>
            <label for="switch-mode" class="switch-mode"></label>

	<!-- HOI_Notification_Icon -->
    <?php include 'HOI_Notification_Icon.php'; ?>
    
            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <!-- MAIN -->
        <main>
            <div class="container">
                <div class="head-title">
                    <div class="left">
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="HOI_Admission_Date.php">Admission Date</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class='bx'><span class="material-symbols-outlined">download</span></i>
                    </a>
                </div>
                <span class="institution-name">
                    <?php echo $user['Institution_Name']; ?>
                </span>

                <?php if (isset($message)) : ?>
                <div class="alert alert-info">
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>

                <!-- Admission Date Form -->
                <div class="admission-date-form">
                    <h3>Set Admission Dates</h3>
                    <form action="HOI_Admission_Date.php" method="POST" id="admission-form">
                        <ul class="box-info">
                            <li>
                                <?php if ($admission_dates['Formfillup_Last_Date'] < $current_date) : ?>
                                <i class='bx'><img src="../../../../../Assets/images/stopped_admission.png"
                                        alt="Application is Stopped"
                                        style="width:80px;height: auto; background-color: #f9f9f9;"></i>
                                <span class="text">
                                    <h3>
                                        <?php echo $application_status; ?>
                                    </h3>
                                    <p>Students Can No Longer Submit their Forms Details</p>
                                </span>
                                <?php else : ?>
                                <i class='bx'><img src="../../../../../Assets/images/live.gif"
                                        alt="Application Portal is Open"
                                        style="width:100px;height: auto; background-color: #f9f9f9;"></i>
                                <span class="text">
                                    <h3>
                                        <?php echo $application_status; ?>
                                    </h3>
                                    <p>Studnet Can Now Submit Application </p>
                                </span>
                                <?php endif; ?>
                            </li>
                        </ul>

                        <div class="row">
                            <!-- Start Date Group -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date">Start Date:</label>
                                    <input type="date" id="start_date" name="start_date" class="form-control"
                                        value="<?php echo isset($admission_dates['Formfillup_Start_Date']) ? $admission_dates['Formfillup_Start_Date'] : ''; ?>"
                                        required onchange="validateEndDate(); blockPastDates();"
                                        min="<?php echo date('Y-m-d'); ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="start_date_formatted">Start Date (Formatted):</label>
                                    <input type="text" id="start_date_formatted" class="form-control" disabled>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <!-- End Date Group -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date">End Date:</label>
                                    <input type="date" id="end_date" name="end_date" class="form-control"
                                        value="<?php echo isset($admission_dates['Formfillup_Last_Date']) ? $admission_dates['Formfillup_Last_Date'] : ''; ?>"
                                        required onchange="validateEndDate(); blockPastDates();">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="end_date_formatted">End Date (Formatted):</label>
                                    <input type="text" id="end_date_formatted" class="form-control" disabled>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="First_merit_list_date">1st Merit List Date:</label>
                                    <input type="date" class="form-control" id="First_merit_list_date"
                                        name="First_merit_list_date"
                                        value="<?php echo isset($admission_dates['First_merit_list_date']) ? $admission_dates['First_merit_list_date'] : ''; ?>">
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                
                                <div class="form-group">
                                    <label for="Admission_Beginning_for_First_List">Admission Starts For 1st List
                                        Date:</label>
                                    <input type="date" class="form-control" id="Admission_Beginning_for_First_List"
                                        name="Admission_Beginning_for_First_List"
                                        value="<?php echo isset($admission_dates['Admission_Beginning_for_First_List']) ? $admission_dates['Admission_Beginning_for_First_List'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Admission_Closes_For_First_List">Last Date for Admission Date:</label>
                                    <input type="date" class="form-control" id="Admission_Closes_For_First_List"
                                        name="Admission_Closes_For_First_List"
                                        value="<?php echo isset($admission_dates['Admission_Closes_For_First_List']) ? $admission_dates['Admission_Closes_For_First_List'] : ''; ?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="Second_List">Second Merit List Date (If Any):</label>
                                    <input type="date" class="form-control" id="Second_List" name="Second_List"
                                        value="<?php echo isset($admission_dates['Second_List']) ? $admission_dates['Second_List'] : ''; ?>">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info" id="submit-btn">Fix Dates</button>
                    </form>
                    <br>
                    <div class="instructions" style="padding:0.15rem;">
                        <!-- <button type="button" class="btn btn-warning">Guide to set Dates</button> -->
                        <h5>How to Use this Date Selection Page</h5>
                        <p>These dates are immutable. Once established, admissions will commence automatically from the
                            designated days. For example, if the start date is slated for August 15th, 2024, the
                            admission portal will open for students precisely after midnight (i.e, 12:00 AM IST) on the
                            14th.</p>
                    </div>
                </div>
                <!-- End of Admission Date Form -->
            </div>
        </main>

        <!-- MAIN -->
    </section>
    <!-- CONTENT -->
    <script>
        function validateEndDate() {
            var startDate = new Date(document.getElementById('start_date').value);
            var endDate = new Date(document.getElementById('end_date').value);

            if (endDate < startDate) {
                document.getElementById('end-date-error').innerText = "End date must be after the start date.";
                document.getElementById('submit-btn').disabled = true;
            } else {
                document.getElementById('end-date-error').innerText = "";
                document.getElementById('submit-btn').disabled = false;
            }
        }

        function blockPastDates() {
            var startDate = new Date(document.getElementById('start_date').value);
            var endDateInput = document.getElementById('end_date');
            if (startDate) {
                endDateInput.min = startDate.toISOString().split('T')[0];
                endDateInput.value = ''; // Reset end date to clear any previously selected date
            }
        }
        function formatSelectedDate(inputDate) {
            var date = new Date(inputDate);
            var day = date.getDate();
            var month = date.toLocaleString('default', { month: 'long' });
            var year = date.getFullYear();

            var suffix = "";
            if (day > 3 && day < 21) suffix = "th";
            switch (day % 10) {
                case 1: suffix = "st"; break;
                case 2: suffix = "nd"; break;
                case 3: suffix = "rd"; break;
                default: suffix = "th";
            }

            return day + suffix + " " + month + " " + year;
        }

        document.getElementById('start_date').addEventListener('change', function () {
            var formattedDate = formatSelectedDate(this.value);
            document.getElementById('start_date_formatted').value = formattedDate;
        });
        document.getElementById('end_date').addEventListener('change', function () {
            var formattedDate = formatSelectedDate(this.value);
            document.getElementById('end_date_formatted').value = formattedDate;
        });
        function formatSelectedDate(inputDate) {
            var date = new Date(inputDate);
            var day = date.getDate();
            var month = date.toLocaleString('default', { month: 'long' });
            var year = date.getFullYear();

            var suffix = "";
            if (day > 3 && day < 21) suffix = "th";
            switch (day % 10) {
                case 1: suffix = "st"; break;
                case 2: suffix = "nd"; break;
                case 3: suffix = "rd"; break;
                default: suffix = "th";
            }

            return day + suffix + " " + month + " " + year;
        }

        // Function to set the value of formatted date fields
        function setFormattedDates() {
            var startDate = document.getElementById('start_date').value;
            var endDate = document.getElementById('end_date').value;

            document.getElementById('start_date_formatted').value = formatSelectedDate(startDate);
            document.getElementById('end_date_formatted').value = formatSelectedDate(endDate);
        }

        // Call the function to set formatted dates when the page loads
        window.onload = setFormattedDates;

    </script>
    <script src="script.js"></script>
</body>

</html>