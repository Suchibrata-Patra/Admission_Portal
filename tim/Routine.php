<?php
$host = "localhost";
$dbname = "Timora";
$username = "root";
$password = "root";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    die();
}

// Fetch all teachers
$teachersQuery = $conn->query("SELECT Teacher_ID, Teacher_Name FROM teacher_profile");
$teachers = $teachersQuery->fetchAll(PDO::FETCH_ASSOC);

// Fetch existing schedules for Monday (or any other default weekday)
$weekday = 'Monday'; // Default to Monday, can change dynamically based on user input
$scheduleQuery = $conn->prepare("SELECT * FROM class_schedule WHERE Weekday = :weekday");
$scheduleQuery->execute([':weekday' => $weekday]);
$schedules = $scheduleQuery->fetchAll(PDO::FETCH_ASSOC);

// Handle GET request for fetching schedules by weekday
if (isset($_GET['weekday'])) {
    $weekday = $_GET['weekday'];

    // Fetch schedules for the selected weekday
    $stmt = $conn->prepare("SELECT * FROM class_schedule WHERE Weekday = :weekday");
    $stmt->execute([':weekday' => $weekday]);
    $schedulesForWeekday = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Prepare response as a JSON array
    echo json_encode($schedulesForWeekday);
    exit;
}

// Handle form submission (same as before)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $weekday = $_POST['weekday'];
    $entries = json_decode($_POST['entries'], true);

    foreach ($entries as $entry) {
        $teacherID = $entry['teacher_id'];
        $classSection = $entry['class_section'];
        $period = $entry['period'];
    
        // Check if an entry exists for the given weekday, class section, and period
        $stmtCheck = $conn->prepare("SELECT * FROM class_schedule WHERE Weekday = :weekday AND Class = :classSection AND Class_Time = :period");
        $stmtCheck->execute([
            ':weekday' => $weekday,  // Ensure this variable holds the correct value for the weekday
            ':classSection' => $classSection,  // Correct parameter binding for classSection
            ':period' => $period  // Correct parameter binding for period
        ]);
    
        // Debug: Check how many rows are returned
        if ($stmtCheck->rowCount() > 0) {
            // If the entry exists, check if it's the same teacher for the same period
            $existingSchedule = $stmtCheck->fetch(PDO::FETCH_ASSOC);
            
            // If the teacher is the same, update the entry; otherwise, insert a new entry
            if ($existingSchedule['Teacher_ID'] == $teacherID) {
                // Update the schedule only if the teacher is the same
                // echo "Updating existing schedule for $classSection, $period with teacher ID $teacherID\n"; // Debugging line
                $stmt = $conn->prepare("UPDATE class_schedule SET Teacher_ID = :teacherID WHERE Weekday = :weekday AND Class = :classSection AND Class_Time = :period");
                $stmt->execute([
                    ':teacherID' => $teacherID,
                    ':weekday' => $weekday,
                    ':classSection' => $classSection,
                    ':period' => $period
                ]);
            } else {
                // Insert a new schedule if the teacher is different
                echo "Inserting new schedule for $classSection, $period with a different teacher\n"; // Debugging line
                $stmt = $conn->prepare("INSERT INTO class_schedule (Weekday, Class, Teacher_ID, Class_Time) VALUES (:weekday, :classSection, :teacherID, :period)");
                $stmt->execute([
                    ':weekday' => $weekday,
                    ':teacherID' => $teacherID,
                    ':classSection' => $classSection,
                    ':period' => $period
                ]);
            }
        } else {
            // If no entry exists, insert a new schedule
            echo "Inserting new schedule for $classSection, $period\n"; // Debugging line
            $stmt = $conn->prepare("INSERT INTO class_schedule (Weekday, Class, Teacher_ID, Class_Time) VALUES (:weekday, :classSection, :teacherID, :period)");
            $stmt->execute([
                ':weekday' => $weekday,
                ':teacherID' => $teacherID,
                ':classSection' => $classSection,
                ':period' => $period
            ]);
        }
    }
    
    echo "Schedule Saved successfully!";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Insert Class Schedule</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Timora</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
    <style>
        /* Remove the default dropdown arrow */
        .class-section-dropdown {
            appearance: none;
            /* Removes the default arrow for modern browsers */
            -webkit-appearance: none;
            /* Removes the default arrow for Safari */
            -moz-appearance: none;
            /* Removes the default arrow for Firefox */
            background-color: #f8f9fa;
            /* Light background */
            border: 1px solid #ffffff;
            /* Border color */
            border-radius: 0px;
            /* Rounded corners */
            padding: 1px;
            /* Padding inside the dropdown */
            font-size: 16px;
            /* Font size */
            color: #495057;
            /* Text color */
            width: 100%;
            /* Full width */
            max-width: 300px;
            /* Maximum width */
            cursor: pointer;
            /* Pointer cursor on hover */
            outline: none;
            /* Removes outline on focus */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        /* Add hover and focus effects */
        .class-section-dropdown:hover {
            border-color: #80bdff;
            /* Change border color on hover */
        }

        .class-section-dropdown:focus {
            border-color: #80bdff;
            /* Change border color on focus */
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
            /* Add a subtle shadow */
        }

        .btn-primary {
            padding: 16px 30px;
            background-color: black;
            border-radius: 5px;
            border: none;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: rgb(0, 0, 0);
            color: rgb(255, 255, 255);
        }

        #weekday {
            padding: 15px;
            border: 2px solid black;
            font-weight: 300;
            font-size: 15px;
        }

        /* Hide the dropdown arrow */
        .class-section-dropdown {
            -webkit-appearance: none;
            /* For Safari and Chrome */
            -moz-appearance: none;
            /* For Firefox */
            appearance: none;
            /* For modern browsers */
            background: transparent;
            /* Remove the default background */
            border: none;
            /* Optional: Add border for styling */
            text-align: center;
            color: black
        }

        .class-section-dropdown::-ms-expand {
            display: none;
            /* Hide the arrow in IE/Edge */
        }
    </style>

</head>

<body class="bg-light">
    <div style="position:sticky;">
        <?php include('header.php') ?>

    </div>

    <div class="container mt-5">
        <h2 class="mb-4">Edit Schedule</h2>
        <!-- Weekday Selection -->
        <form id="scheduleForm" method="POST">

            <div class="row align-items-center">
                <div class="col-md-4 d-flex align-items-center">
                    <select class="form-select" id="weekday" name="weekday" required>
                        <option value="" disabled selected>Choose...</option>
                        <?php
                            $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                            foreach ($weekdays as $day) {
                                echo "<option value=\"$day\">$day</option>";
                            }
                        ?>
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-center">
                    <button type="submit" class="btn btn-primary">Save Schedule</button>
                </div>
            </div>


            <!-- Table Display -->
            <div id="scheduleTable" class="mt-4">
                <table class="table table-bordered">
                    <thead id="tableHeader">
                        <tr style="text-align:center;">
                            <th>Teacher</th>
                            <?php
                            // Periods for columns
                            $periods = ['1st', '2nd', '3rd', '4th', '5th', '6th', '7th', '8th'];
                            foreach ($periods as $period) {
                                echo "<th>$period</th>";
                            }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($teachers as $teacher): ?>
                        <tr style="text-align:center;vertical-align:middle;">
                            <td>
                                <?= htmlspecialchars($teacher['Teacher_Name']) ?>
                            </td>
                            <?php foreach ($periods as $period): ?>
                            <td>
                                <!-- Class Dropdown for each period -->
                                <select class="form-select class-section-dropdown"
                                    data-teacher-id="<?= $teacher['Teacher_ID'] ?>" data-period="<?= $period ?>">
                                    <option value="" disabled selected></option>
                                    <!-- Predefined list of classes -->
                                    <?php 
                                            $classes = ['5A', '5B', '6A', '6B', '7A', '7B', '8A', '8B', '9A', '9C', '10A', '10B', '11 ARTS', '11 SCIENCE', '12 ARTS', '12 SCIENCE'];
                                            foreach ($classes as $class) {
                                                echo "<option value=\"$class\">$class</option>";
                                            }
                                            ?>
                                </select>
                            </td>
                            <?php endforeach; ?>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

        </form>
    </div>

    <script>
        $(document).ready(function () {
            function updateTable(weekday) {
                // Clear the current table data
                $('.class-section-dropdown').val('');

                // Update the table header with the selected weekday
                $('#tableHeader tr').find('th').first().text('Teacher - ' + weekday);

                // Fetch schedule data for the selected weekday
                $.ajax({
                    type: 'GET',
                    url: '', // Use the same PHP file
                    data: { weekday: weekday },
                    success: function (response) {
                        const schedules = JSON.parse(response);

                        // Populate the table with the fetched data
                        schedules.forEach(schedule => {
                            const teacherId = schedule.Teacher_ID;
                            const period = schedule.Class_Time;
                            const classSection = schedule.Class;

                            // Find the corresponding dropdown and update its value
                            $(`.class-section-dropdown[data-teacher-id="${teacherId}"][data-period="${period}"]`).val(classSection);
                        });
                    }
                });
            }

            // Set default weekday to Monday on page load
            const defaultWeekday = 'Monday';
            $('#weekday').val(defaultWeekday);

            // Trigger the updateTable function for Monday on page load
            updateTable(defaultWeekday);

            // Listen for changes in the weekday dropdown
            $('#weekday').on('change', function () {
                const selectedWeekday = $(this).val();
                if (selectedWeekday) {
                    updateTable(selectedWeekday);
                }
            });

            // Handle form submission as before
            $('#scheduleForm').on('submit', function (e) {
                e.preventDefault();

                const weekday = $('#weekday').val();
                if (!weekday) {
                    alert('Please select a weekday.');
                    return;
                }

                const entries = [];
                $('.class-section-dropdown').each(function () {
                    const teacherId = $(this).data('teacher-id');
                    const period = $(this).data('period');
                    const classSection = $(this).val();

                    if (classSection) {
                        entries.push({
                            teacher_id: teacherId,
                            class_section: classSection,
                            period: period
                        });
                    }
                });

                $.ajax({
                    type: 'POST',
                    url: '',
                    data: {
                        weekday: weekday,
                        entries: JSON.stringify(entries)
                    },
                    success: function (response) {
                        alert(response);
                        location.reload();
                    }
                });
            });
        });

    </script>
</body>

</html>