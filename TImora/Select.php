<?php require('dummy.php') ?>

<?php
$host = "localhost";
$dbname = "Timora";
$username = "root";
$password = "root";

// Create connection
$conn = new mysqli($host, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch teacher data from the database
$sql = "SELECT Teacher_ID, Teacher_Name,
               1st_period, 2nd_period, 3rd_period, 4th_period, 
               5th_period, 6th_period, 7th_period, 8th_period
        FROM teacher_profile";
$result = $conn->query($sql);

// Handle POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teachers = json_decode(file_get_contents('php://input'), true); // Decode JSON input

    if ($teachers) {
        foreach ($teachers as $teacherName => $periods) {
            $teacherName = $conn->real_escape_string($teacherName);
            $updateQuery = "UPDATE teacher_profile SET 
                            1st_period = {$periods['1st']},
                            2nd_period = {$periods['2nd']},
                            3rd_period = {$periods['3rd']},
                            4th_period = {$periods['4th']},
                            5th_period = {$periods['5th']},
                            6th_period = {$periods['6th']},
                            7th_period = {$periods['7th']},
                            8th_period = {$periods['8th']}
                            WHERE Teacher_Name = '$teacherName'";

            if ($conn->query($updateQuery) === FALSE) {
                echo "Error: " . $conn->error;
            }
        }

        echo json_encode(["status" => "success", "message" => "Database updated successfully"]);
    } else {
        echo json_encode(["status" => "error", "message" => "No data received"]);
    }
    exit;
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1.0"> -->
    <title>Mark Absent Teachers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
        body {
            padding-top:0px;
        }

        .teacher-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
            margin-top:30px;
            padding-left:20px;
            padding-right:20px;
        }

        .teacher-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            cursor: pointer;
        }

        .teacher-box:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .teacher-box .teacher-name {
            font-size: 16px;
            font-weight: bold;
        }

        .teacher-box.border-modern {
            border: 2px solid rgb(235, 75, 136);
            background-color: #fefefe;
        }
        .teacher-class-counter{
            font-size: 10px;
            color: rgb(114, 113, 112);
        }
    </style>
</head>

<body>
    <div class="teacher-grid">
        <?php if ($result->num_rows > 0) { 
        while ($row = $result->fetch_assoc()) {
            // Check if any period is marked as 0 (absent)
            $isAbsent = false;
            foreach (["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th"] as $period) {
                if ($row["$period" . "_period"] == 0) {
                    $isAbsent = true;
                    break; // Exit loop if one period is absent
                }
            }
    ?>
        <div class="teacher-box <?= $isAbsent ? 'border-modern' : '' ?>" id="card-<?= $row['Teacher_ID'] ?>"
            data-bs-toggle="modal" data-bs-target="#modal-<?= $row['Teacher_ID'] ?>">
            <div class="teacher-name">
                <?= $row['Teacher_Name'] ?>
            </div>
            <div class="teacher-class-counter">
                Click to Select
            </div>
        </div>
        <div class="modal fade" id="modal-<?= $row['Teacher_ID'] ?>" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5>Select Absent Periods for <?= $row['Teacher_Name'] ?></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        
                        <form>
                            <?php foreach (["1st", "2nd", "3rd", "4th", "5th", "6th", "7th", "8th"] as $period) { ?>
                            <div class="form-check">
                                <input class="form-check-input period-checkbox" type="checkbox"
                                    id="period-<?= $period ?>-<?= $row['Teacher_ID'] ?>"
                                    data-teacher="<?= $row['Teacher_Name'] ?>" data-period="<?= $period ?>"
                                    <?= $row["$period" . "_period"] == 0 ? "checked" : "" ?>>
                                <label class="form-check-label">
                                    <?= $period ?> Period
                                </label>
                            </div>
                            <?php } ?>
                        </form>
                        <button type="button" class="btn btn-warning mb-3 toggle-all" 
                                data-teacher-id="<?= $row['Teacher_ID'] ?>">Select All</button>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Save</button>
                    </div>
                </div>
            </div>
        </div>

        <?php } } else { echo "<p>No teachers found</p>"; } ?>
    </div>

    <div class="text-center mt-4">
        <button id="getAbsentList" class="btn"
            style="background-color: rgb(0, 0, 0);padding:15px 30px;border-radius: 50px;color: white;font-size: 20px;font-weight: 300;">Generate</button>
    </div>
    <script>

document.addEventListener("DOMContentLoaded", () => {
    const toggleButtons = document.querySelectorAll(".toggle-all");

    toggleButtons.forEach(button => {
        button.addEventListener("click", () => {
            const teacherId = button.getAttribute("data-teacher-id");
            const checkboxes = document.querySelectorAll(`#modal-${teacherId} .period-checkbox`);

            // Determine if we need to select or deselect all
            const allChecked = Array.from(checkboxes).every(checkbox => checkbox.checked);
            
            checkboxes.forEach(checkbox => {
                checkbox.checked = !allChecked; // Toggle all checkboxes
            });
        });
    });
});

        document.getElementById("getAbsentList").addEventListener("click", function () {
            const checkboxes = document.querySelectorAll(".period-checkbox");
            const absentData = {};

            checkboxes.forEach((checkbox) => {
                const teacherName = checkbox.getAttribute("data-teacher");
                const period = checkbox.getAttribute("data-period");
                const value = checkbox.checked ? 0 : 1; // 0 for checked (absent), 1 for unchecked (present)

                if (!absentData[teacherName]) {
                    absentData[teacherName] = {};
                }
                absentData[teacherName][period] = value;
            });

            if (Object.keys(absentData).length > 0) {
                fetch("", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify(absentData)
                })
                    .then(response => response.json())
                    .then(data => {
                        alert(data.message);
                    })
                    .catch(error => console.error("Error:", error));
            }
        });




        // Code for Modifying the cards when at least one entry is 0
    </script>
</body>

</html>