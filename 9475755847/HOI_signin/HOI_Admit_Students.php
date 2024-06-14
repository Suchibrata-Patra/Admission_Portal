<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_session.php';
require 'HOI_super_admin.php';

// Ensure $student_table_name is properly defined (assuming $udise_code is set elsewhere)
$student_table_name = $udise_code . '_Student_Details';

$stream = isset($_GET['stream']) ? $_GET['stream'] : 'all';
$num_students = isset($_GET['num_students']) ? intval($_GET['num_students']) : ''; // Initialize as empty string

// Adjust $num_students based on input
if ($num_students == '') {
    $num_students = '1000'; // Default to empty string to signify all students
} else {
    $num_students = max($num_students, 1); // Ensure at least 1 student if a number is provided
}
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.css" rel="stylesheet" />


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
            box-shadow: 5px 5px 15px #c9c9c9,
                -5px -5px 15px #ffffff;
            color: white;
        }

        .btn-primary:hover {
            background-color: #2980b9;
            color: #fff;
        }

        .circle-checkbox {
            /* Hide default checkbox */
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            -o-appearance: none;
            -ms-appearance: none;
            position: relative;
            /* Ensure the checkbox is visible and clickable */
            display: inline-block;
            width: 20px;
            height: 20px;
            /* Set styles for the custom checkbox */
            background-color: #fff;
            border: 2px solid #999;
            border-radius: 50%;
            /* Make it a circle */
            cursor: pointer;
            outline: none;
            /* Remove default focus outline */
        }

        /* Style for when the checkbox is checked */
        .circle-checkbox:checked {
            background-color: #2196F3;
            border-color: #2196F3;
        }

        /* Label style (optional, adjust as needed) */
        label {
            font-size: 16px;
            font-weight: bold;
            vertical-align: middle;
            margin-left: 5px;
            cursor: pointer;
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
                        <i class='bx'><span class="material-symbols-outlined">download</span></i>Download Merit List
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
                                            Streams</option>
                                        <option value="Science" <?php if ($stream==='Science' ) echo 'selected' ; ?>
                                            >Science</option>
                                        <option value="Arts" <?php if ($stream==='Arts' ) echo 'selected' ; ?>>Arts
                                        </option>
                                        <option value="Commerce" <?php if ($stream==='Commerce' ) echo 'selected' ; ?>
                                            >Commerce</option>
                                    </select>
                                </div>


                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="num_students"
                                        style="font-weight: normal; color: #333; font-size: 14px; display: inline-block; width: 120px; margin-bottom: 5px;">No
                                        of Students</label>
                                    <input type="number" name="num_students" id="num_students" class="form-control"
                                        style="border: 1px solid #ccc; border-radius: 4px; padding: 8px; margin-bottom: 5px; display: inline-block; width: calc(100% - 130px);"
                                        placeholder="No. of Students" min="1"
                                        value="<?php echo htmlspecialchars($num_students); ?>">
                                </div>

                            </div>

                            <div class="col-md-2">
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit"
                                        class="btn btn-primary btn-block d-flex align-items-center justify-content-center">
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
        <thead class='text-xs text-gray-700 uppercase dark:text-gray-400'>
                    <tr class='bg-gray-200'>
                        <th class='px-4 py-2 text-center'>Profile</th>
                        <th class='px-4 py-2 text-center'>Stream <span class='material-symbols-outlined'>swap_vert</span></th>
                        <th class='px-4 py-2 text-center'>Marks <span class='material-symbols-outlined'>filter_list</span></th>
                        <th class='px-4 py-2 text-center'>Status</th>
                        <th class='px-4 py-2 text-center'>Round</th>
                        <th class='px-4 py-2 text-center'>
                            <input type='checkbox' class='circle-checkbox' id='select-all-checkbox' onchange='toggleAllCheckboxes(this)'>
                            <label for='select-all-checkbox'>Select All</label>
                        </th>
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
        <tr class='border-b border-gray-200'>
            <td class='px-4 py-2 flex items-center'>
                <img class='w-10 h-10 rounded-full mr-4' src='http://localhost:8888/9475755847/uploads/{$row['reg_no']}_passportsizephoto.png' alt='Passport Size Photo'>
                <div>
                    <div class='text-base font-semibold'>{$row['fname']} {$row['lname']}</div>
                    <div class='text-gray-500'>{$row['email']}</div>
                </div>
            </td>
            <td class='px-4 py-2 text-center'>{$row['select_stream']}</td>
            <td class='px-4 py-2 text-center'>{$obtained_marks} / {$total_marks}</td>
            <td class='px-4 py-2 text-center'>{$admission_status}</td>
            <td class='px-4 py-2 text-center'>{$row['Merit_List_No']}</td>
            <td class='px-4 py-2 text-center'>
                <input class='form-check-input circle-checkbox' type='checkbox' id='checkbox_{$row['reg_no']}' name='admission_allow[]' value='{$row['reg_no']}' onchange='toggleAdmissionButton();'>
            </td>
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
    echo "<p class='text-gray-500'>No students found matching the selected criteria.</p>";
}
?>
</div>                 
<!-- End Filtered students display -->


 <!-- This is the Source Code for Tailwind Tables -->

                <!-- 
                <span class="institution-name">
                    <?php echo $row['Institution_Name']; ?>
                </span> -->
            </div>
            

<div data-dial-init class="fixed end-6 bottom-6 group">
    <div id="speed-dial-menu-default" class="flex flex-col items-center hidden mb-4 space-y-2">
        <button type="button" data-tooltip-target="tooltip-share" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                <path d="M14.419 10.581a3.564 3.564 0 0 0-2.574 1.1l-4.756-2.49a3.54 3.54 0 0 0 .072-.71 3.55 3.55 0 0 0-.043-.428L11.67 6.1a3.56 3.56 0 1 0-.831-2.265c.006.143.02.286.043.428L6.33 6.218a3.573 3.573 0 1 0-.175 4.743l4.756 2.491a3.58 3.58 0 1 0 3.508-2.871Z"/>
            </svg>
            <span class="sr-only">Share</span>
        </button>
        <div id="tooltip-share" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Share
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <button type="button" data-tooltip-target="tooltip-print" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M5 20h10a1 1 0 0 0 1-1v-5H4v5a1 1 0 0 0 1 1Z"/>
                <path d="M18 7H2a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2v-3a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v3a2 2 0 0 0 2-2V9a2 2 0 0 0-2-2Zm-1-2V2a2 2 0 0 0-2-2H5a2 2 0 0 0-2 2v3h14Z"/>
            </svg>
            <span class="sr-only">Print</span>
        </button>
        <div id="tooltip-print" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Print
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <button type="button" data-tooltip-target="tooltip-download" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 shadow-sm dark:hover:text-white dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
            </svg>
            <span class="sr-only">Download</span>
        </button>
        <div id="tooltip-download" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Download
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
        <button type="button" data-tooltip-target="tooltip-copy" data-tooltip-placement="left" class="flex justify-center items-center w-[52px] h-[52px] text-gray-500 hover:text-gray-900 bg-white rounded-full border border-gray-200 dark:border-gray-600 dark:hover:text-white shadow-sm dark:text-gray-400 hover:bg-gray-50 dark:bg-gray-700 dark:hover:bg-gray-600 focus:ring-4 focus:ring-gray-300 focus:outline-none dark:focus:ring-gray-400">
            <svg class="w-5 h-5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                <path d="M5 9V4.13a2.96 2.96 0 0 0-1.293.749L.879 7.707A2.96 2.96 0 0 0 .13 9H5Zm11.066-9H9.829a2.98 2.98 0 0 0-2.122.879L7 1.584A.987.987 0 0 0 6.766 2h4.3A3.972 3.972 0 0 1 15 6v10h1.066A1.97 1.97 0 0 0 18 14V2a1.97 1.97 0 0 0-1.934-2Z"/>
                <path d="M11.066 4H7v5a2 2 0 0 1-2 2H0v7a1.969 1.969 0 0 0 1.933 2h9.133A1.97 1.97 0 0 0 13 18V6a1.97 1.97 0 0 0-1.934-2Z"/>
            </svg>
            <span class="sr-only">Copy</span>
        </button>
        <div id="tooltip-copy" role="tooltip" class="absolute z-10 invisible inline-block w-auto px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip dark:bg-gray-700">
            Copy
            <div class="tooltip-arrow" data-popper-arrow></div>
        </div>
    </div>
    <button type="button" data-dial-toggle="speed-dial-menu-default" aria-controls="speed-dial-menu-default" aria-expanded="false" class="flex items-center justify-center text-white bg-blue-700 rounded-full w-14 h-14 hover:bg-blue-800 dark:bg-blue-600 dark:hover:bg-blue-700 focus:ring-4 focus:ring-blue-300 focus:outline-none dark:focus:ring-blue-800">
        <svg class="w-5 h-5 transition-transform group-hover:rotate-45" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
        </svg>
        <span class="sr-only">Open actions menu</span>
    </button>
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
            var admissionButtonAllow = document.querySelector('.btn.btn-primary[name="allow_admission"]');
            var admissionButtonRemove = document.querySelector('.btn.btn-danger[name="remove_admission"]');

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
                admissionButtonRemove.style.display = 'inline-block';
            } else {
                admissionButtonAllow.style.display = 'none';
                admissionButtonRemove.style.display = 'none';
            }
        }

    </script>
    <script>
        function toggleAllCheckboxes(source) {
            var checkboxes = document.querySelectorAll('.form-check-input');
            checkboxes.forEach(checkbox => {
                checkbox.checked = source.checked;
            });
            toggleAdmissionButton(); // Optional: Update button visibility based on checkboxes
        }
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.3.0/flowbite.min.js"></script>

    <script src="script.js"></script>
</body>

</html>