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

// Fetch teacher data from the database, including whether they have any absent periods
$sql = "SELECT Teacher_ID, Teacher_Name, 
               (1st_period = 0 OR 2nd_period = 0 OR 3rd_period = 0 OR 4th_period = 0 OR 
                5th_period = 0 OR 6th_period = 0 OR 7th_period = 0 OR 8th_period = 0) AS HasAbsent 
        FROM teacher_profile";
$result = $conn->query($sql);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $teachers = json_decode(file_get_contents('php://input'), true); // Decode JSON input

    if ($teachers) {
        foreach ($teachers as $teacherName => $periods) {
            $teacherName = $conn->real_escape_string($teacherName);
            $updateQuery = "UPDATE teacher_profile SET ";

            foreach ($periods as $period) {
                $column = strtolower($period) . "_period";
                $updateQuery .= "$column = 0, ";
            }

            $updateQuery = rtrim($updateQuery, ', ');
            $updateQuery .= " WHERE Teacher_Name = '$teacherName'";

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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Absent Teachers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body { padding: 20px; }
        .teacher-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 20px;
        }
        .teacher-box { border: 1px solid #ddd; border-radius: 8px; padding: 10px; text-align: center; cursor: pointer; }
        .teacher-box:hover { box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); }
        .teacher-box .teacher-name { font-size: 16px; font-weight: bold; }
        .teacher-box.border-danger { border: 2px solid rgb(231, 33, 99); }
        #absentTeachersTable { margin-top: 20px; }
    </style>
</head>
<body>
    <div class="teacher-grid">
        <?php if ($result->num_rows > 0) { while ($row = $result->fetch_assoc()) { ?>
            <div class="teacher-box <?= $row['HasAbsent'] ? 'border-danger' : '' ?>" 
                 id="card-<?= $row['Teacher_ID'] ?>" 
                 data-has-absent="<?= $row['HasAbsent'] ?>" 
                 data-bs-toggle="modal" 
                 data-bs-target="#modal-<?= $row['Teacher_ID'] ?>">
                <div class="teacher-name"><?= $row['Teacher_Name'] ?></div>
                <div class="teacher-classes">Classes</div>
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
                                            data-teacher="<?= $row['Teacher_Name'] ?>" data-period="<?= $period ?>">
                                        <label class="form-check-label"><?= $period ?> Period</label>
                                    </div>
                                <?php } ?>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } } else { echo "<p>No teachers found</p>"; } ?>
    </div>
    <div class="text-center mt-4">
        <button id="getAbsentList" class="btn btn-dark">Modify Database</button>
    </div>
    <div id="absentTeachersTable" class="container mt-4">
        <h3>Absent Teachers</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Teacher Name</th>
                    <th>Absent Periods</th>
                </tr>
            </thead>
            <tbody id="absentTeachersBody"></tbody>
        </table>
    </div>
    <script>
        // Add an event listener to each teacher card
        document.querySelectorAll(".teacher-box").forEach((card) => {
            card.addEventListener("click", function () {
                const teacherName = this.querySelector(".teacher-name").innerText;

                // Select all checkboxes for this teacher and mark them as checked
                document.querySelectorAll(`.period-checkbox[data-teacher="${teacherName}"]`).forEach((checkbox) => {
                    checkbox.checked = true;
                });
            });
        });

        // Update the absent teachers' list and send data to the server
        document.querySelectorAll(".period-checkbox").forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                const teacherName = this.getAttribute("data-teacher");
                const teacherCard = Array.from(document.querySelectorAll(".teacher-box"))
                                        .find(card => card.querySelector(".teacher-name").innerText === teacherName);

                const checkboxes = document.querySelectorAll(`.period-checkbox[data-teacher="${teacherName}"]`);
                const hasAbsent = Array.from(checkboxes).some(cb => cb.checked);

                if (hasAbsent) {
                    teacherCard.classList.add("border-danger");
                } else {
                    teacherCard.classList.remove("border-danger");
                }
            });
        });

        document.getElementById("getAbsentList").addEventListener("click", function () {
            const checkboxes = document.querySelectorAll(".period-checkbox");
            const absentData = {};

            checkboxes.forEach((checkbox) => {
                if (checkbox.checked) {
                    const teacherName = checkbox.getAttribute("data-teacher");
                    const period = checkbox.getAttribute("data-period");

                    if (!absentData[teacherName]) {
                        absentData[teacherName] = [];
                    }
                    absentData[teacherName].push(period);
                }
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
    </script>
</body>
</html>
