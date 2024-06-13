<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';

// Ensure $student_table_name is properly defined (assuming $udise_code is set elsewhere)
$student_table_name = $udise_code . '_Student_Details';

// Default values
$stream = isset($_GET['stream']) ? $_GET['stream'] : 'all';
$num_students = isset($_GET['num_students']) ? intval($_GET['num_students']) : 10;
$num_students = max($num_students, 10000);

$whereClause = "WHERE is_finally_submitted = 1"; // Always include this condition

if ($stream !== "all") {
    // Append the stream condition to the where clause
    $whereClause .= " AND select_stream = '$stream'";
}

// Query to fetch students with limit
$filteredQuery = "SELECT * FROM $student_table_name $whereClause ORDER BY obtained_marks DESC LIMIT $num_students";
$filteredResults = mysqli_query($db, $filteredQuery);
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
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />

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
            <form action="#" method="POST">
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
                <div class="filter-options text-center">
                    <h4 style="margin-top:-3%;">Filter Students</h4>
                    <p style="font-size:15px;color:rgb(32, 142, 122);margin-top:0%;">Showing Those Students Who have
                        Submitted their Applications and Paid their fees.</p>
                    <form action="#" method="GET">
                        <div class="form-row align-items-end justify-content-center">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="stream" id="stream" class="form-control" required>
                                        <option value="" <?php if ($stream==='' ) echo 'selected' ; ?>>Select Stream
                                        </option>
                                        <option value="all" <?php if ($stream==='all' ) echo 'selected' ; ?>>All
                                            Students</option>
                                        <option value="Science" <?php if ($stream==='Science' ) echo 'selected' ; ?>
                                            >Science</option>
                                        <option value="Arts" <?php if ($stream==='Arts' ) echo 'selected' ; ?>>Arts
                                        </option>
                                        <option value="Commerce" <?php if ($stream==='Commerce' ) echo 'selected' ; ?>
                                            >Commerce</option>
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <input type="number" name="num_students" id="num_students" class="form-control"
                                        placeholder="No. of Students" min="1">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="Merit_List_No" id="Merit_List_No" class="form-control" required>
                                        <option value="all">Admission Round</option>
                                        <option value="1">Round 1</option>
                                        <option value="2">Round 2</option>
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-block d-flex align-items-center justify-content-center">
                                        <span class="material-symbols-outlined mr-2">filter_alt</span> Filter
                                    </button>
                                </div>
                            </div>
                            
                        </div>
                    </form>
                </div>

                <!-- End Filter options -->


                <!-- Filtered students display -->
                <div class="filtered-students">
                    <?php
if (isset($filteredResults) && mysqli_num_rows($filteredResults) > 0) {
    echo "
    <div class='table-responsive'>
        <form action='HOI_process_admission.php' method='POST'>
           <div class='mb-3'>
    <button type='submit' class='btn btn-primary' name='allow_admission' style='display:none;'>Allow Admission</button>
</div>

            <table class='table'>
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Stream <span class='material-symbols-outlined'>swap_vert</span></th>
                        <th>Marks <span class='material-symbols-outlined'>filter_list</span></th>
                        <th>Admission Status</th> <!-- Updated column header -->
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
    ";

    while ($row = mysqli_fetch_assoc($filteredResults)) {
        $obtained_marks = ($row['bengali_marks'] + $row['english_marks'] + $row['mathematics_marks'] + $row['physical_science_marks'] + $row['life_science_marks'] + $row['history_marks'] + $row['geography_marks']);
        $total_marks = ($row['bengali_full_marks'] + $row['english_full_marks'] + $row['mathematics_full_marks'] + $row['physical_science_full_marks'] + $row['life_science_full_marks'] + $row['history_full_marks'] + $row['geography_full_marks']);

        // Conditional block for admission status
        $admission_status = ($row['is_Admission_Allowed'] == 1) ? "<span class='badge rounded-pill bg-success' style='font-weight:500;color: white;'>Allowed</span>" : "<span class='badge rounded-pill bg-warning' style='font-weight:500;'>Waiting</span>";

        echo "
        <tr>
            <td>{$row['fname']}</td>
            <td>{$row['lname']}</td>
            <td>{$row['select_stream']}</td>
            <td>{$obtained_marks} / {$total_marks}</td>
            <td> <!-- Start of the new column for admission status -->
                <p>{$admission_status}</p>
            </td> <!-- End of the new column -->
            <td> <!-- Start of the new column for checkbox and action button -->
                <div class='form-check form-check-inline'>
<input class='form-check-input' type='checkbox' id='checkbox_{$row['reg_no']}' name='admission_allow[]' value='{$row['reg_no']}' onchange='toggleAdmissionButton();'>
                    <label class='form-check-label' for='checkbox_{$row['reg_no']}'></label>
                </div>
            </td> <!-- End of the new column -->
        </tr>
        ";
    }

    echo "
        </tbody>
    </table>
    </form>
    </div>
    ";

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

    <script>
        function toggleAdmissionButton() {
            var admissionButtonAllow = document.querySelector('.btn.btn-primary[name=\"allow_admission\"]');
            var admissionButtonDisable = document.querySelector('.btn.btn-danger[name=\"disable_admission\"]');

            // Check if any checkbox is checked
            var checkboxes = document.querySelectorAll('.form-check-input');
            var anyChecked = false;
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    anyChecked = true;
                    break;
                }
            }

            // Show both buttons if any checkbox is checked
            if (anyChecked) {
                admissionButtonAllow.style.display = 'inline-block';
                admissionButtonDisable.style.display = 'inline-block';
            } else {
                admissionButtonAllow.style.display = 'none';
                admissionButtonDisable.style.display = 'none';
            }
        }
    </script>

    <!-- Your custom script.js if needed -->
    <script src="script.js"></script>
</body>

</html>