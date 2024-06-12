<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';

$student_table_name = $udise_code . '_Student_Details';

// Check if the form is submitted
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Check if stream is selected
    if (isset($_GET['stream'])) {
        $stream = $_GET['stream'];
        
        // Construct the WHERE clause for filtering
        if ($stream === "all") {
            $whereClause = ""; // Empty WHERE clause to fetch all students
        } else {
            $whereClause = "select_stream = '$stream'";
        }
        
        // Query to fetch filtered students
        $filteredQuery = "SELECT * FROM $student_table_name";
        if (!empty($whereClause)) {
            $filteredQuery .= " WHERE $whereClause";
        }
        $filteredResults = mysqli_query($db, $filteredQuery);
    }
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
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- My CSS -->
    <link rel="stylesheet" href="/../../../../Assets/css/Generalised_HOI_Stylesheet.css">
    <style>
        /* Neomorphic styles for form elements */
        .form-control {
            background-color: #f0f0f0;
            border: none;
            border-radius: 3px;
            box-shadow: 5px 5px 15px #c9c9c9,
                -5px -5px 15px #ffffff;
        }

        .btn-primary {
            background-color: #3498db;
            border: none;
            border-radius: 30px;
            /* box-shadow: 5px 5px 15px #c9c9c9,
                -5px -5px 15px #ffffff; */
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            color: #fff;
        }

        /* Optional: Add more styles as needed */
    </style>
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
            <a href="#" class="notification">
                <i class='bx bxs-bell'></i>
                <span class="num">8</span>
            </a>
            <a href="#" class="profile">
                <img src="img/people.png">
            </a>
        </nav>
        <!-- NAVBAR -->

        <main>
            <div class="container">
                <div class="head-title">
                    <div class="left">
                        <ul class="breadcrumb">
                            <li><a href="#">Dashboard</a></li>
                            <li><i class='bx bx-chevron-right'></i></li>
                            <li><a class="active" href="HOI_Short_Listing.php">Short List</a></li>
                        </ul>
                    </div>
                    <a href="#" class="btn-download">
                        <i class='bx'><span class="material-symbols-outlined">download</span></i>
                        <!-- <span class="text"></span> -->
                    </a>
                </div>

                <!-- Filter options -->
                <div class="filter-options text-center"> <!-- Add 'text-center' class to center align -->
                    <h3>Filter Students</h3>
                    <form action="#" method="GET">
                        <div class="form-row align-items-end justify-content-center">
                            <!-- Add 'justify-content-center' class to center align -->
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="stream" id="stream" class="form-control">
                                        <option value="">Select Stream</option>
                                        <option value="all">All Students</option>
                                        <option value="Science">Science</option>
                                        <option value="Arts">Arts</option>
                                        <option value="Commerce">Commerce</option>
                                        <!-- Add more options as needed -->
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block">Apply Filter</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- End Filter options -->


                <!-- Filtered students display -->
                <div class="filtered-students">
                    <?php
            // Check if $filteredResults is set
            if (isset($filteredResults) && mysqli_num_rows($filteredResults) > 0) {
                echo "<div class='table-responsive'>";
                echo "<table class='table'>";
                echo "<thead>";
                echo "<tr>";
                echo "<th>First Name</th>";
                echo "<th>Last Name</th>";
                echo "<th>Stream</th>";
                echo "<th>Marks</th>";
                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";
                    while ($row = mysqli_fetch_assoc($filteredResults)) {
                        $obtained_marks = ($row['bengali_marks'] + $row['english_marks'] + $row['mathematics_marks'] + $row['physical_science_marks'] + $row['life_science_marks'] + $row['history_marks'] + $row['geography_marks']);
                        $total_marks = ($row['bengali_full_marks'] + $row['english_full_marks'] + $row['mathematics_full_marks'] + $row['physical_science_full_marks'] + $row['life_science_full_marks'] + $row['history_full_marks'] + $row['geography_full_marks']);
                        echo "<tr>";
                        echo "<td>" . $row['fname'] . "</td>";
                        echo "<td>" . $row['lname'] . "</td>";
                        echo "<td>" . $row['select_stream'] . "</td>";
                        echo "<td>" . $obtained_marks . " / " . $total_marks . "</td>";
                        echo "<td><button class='btn btn-primary btn-sm'>Allow Admission</button></td>"; // Add button here with btn-sm class
                        echo "</tr>";
                    }
                             
                echo "</tbody>";
                echo "</table>";
                echo "</div>";
            } else {
                echo "<p>No students found matching the selected criteria.</p>";
            }
            ?>
                </div>
                <!-- End Filtered students display -->
                <!-- 
                <span class="institution-name">
                    <?php echo $row['Institution_Name']; ?>
                </span> -->
            </div>
        </main>


    </section>
    <!-- CONTENT -->

    <!-- Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <!-- Your custom script.js if needed -->
    <script src="script.js"></script>
</body>

</html>