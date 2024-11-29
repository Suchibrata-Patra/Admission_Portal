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

// Fetch existing schedules
$scheduleQuery = $conn->query("SELECT * FROM class_schedule WHERE weekday ='Monday'");
$schedules = $scheduleQuery->fetchAll(PDO::FETCH_ASSOC);

// Organize schedules by teacher and period for easy access
$scheduleData = [];
foreach ($schedules as $schedule) {
    $scheduleData[$schedule['Teacher_ID']][$schedule['Class_Time']] = $schedule['Subject'];
}

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

        // Check for existing allocation
        $checkStmt = $conn->prepare("SELECT COUNT(*) FROM class_schedule WHERE Weekday = :weekday AND Subject = :classSection AND Class_Time = :period");
        $checkStmt->execute([
            ':weekday' => $weekday,
            ':classSection' => $classSection,
            ':period' => $period
        ]);
        $count = $checkStmt->fetchColumn();

        if ($count > 0) {
            echo "Error: Duplicate allocation detected for $classSection during $period on $weekday.";
            exit;
        }

        // Insert the new schedule
        $stmt = $conn->prepare("INSERT INTO class_schedule (Weekday, Teacher_ID, Subject, Class_Time) VALUES (:weekday, :teacherID, :classSection, :period)");
        $stmt->execute([
            ':weekday' => $weekday,
            ':teacherID' => $teacherID,
            ':classSection' => $classSection,
            ':period' => $period
        ]);
    }
    echo "Schedule saved successfully!";
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
</head>
<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Insert Class Schedule</h2>
        <!-- Weekday Selection -->
        <form id="scheduleForm" method="POST">
            <div class="mb-3">
                <label for="weekday" class="form-label">Select Weekday</label>
                <select class="form-select" id="weekday" name="weekday" required>
                    <!-- <option value="" disabled selected>Choose...</option> -->
                    <?php
                    $weekdays = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    foreach ($weekdays as $day) {
                        echo "<option value=\"$day\">$day</option>";
                    }
                    ?>
                </select>
            </div>

            <!-- Table Display -->
            <div id="scheduleTable" class="mt-4">
                <table class="table table-bordered">
                    <thead id="tableHeader">
                        <tr>
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
                            <tr>
                                <td><?= htmlspecialchars($teacher['Teacher_Name']) ?></td>
                                <?php foreach ($periods as $period): ?>
                                    <td>
                                        <input type="text" 
                                               class="form-control class-section-input" 
                                               placeholder=" "
                                               value="<?= isset($scheduleData[$teacher['Teacher_ID']][$period]) ? htmlspecialchars($scheduleData[$teacher['Teacher_ID']][$period]) : '' ?>"
                                               data-teacher-id="<?= $teacher['Teacher_ID'] ?>" 
                                               data-period="<?= $period ?>">
                                    </td>
                                <?php endforeach; ?>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>

            <button type="submit" class="btn btn-primary mt-3">Save Schedule</button>
        </form>
    </div>

    <script>
       $(document).ready(function () {
    function updateTable(weekday) {
        // Clear the current table data
        $('.class-section-input').val('');

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
                    const classSection = schedule.Subject;

                    // Find the corresponding input field and update its value
                    $(`.class-section-input[data-teacher-id="${teacherId}"][data-period="${period}"]`).val(classSection);
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
        $('.class-section-input').each(function () {
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
