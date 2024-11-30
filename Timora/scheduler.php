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
$sql = "SELECT Teacher_ID, Teacher_Name, Subjects FROM teacher_profile";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mark Absent Teachers</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }

        .teacher-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap:20px;
        }

        .teacher-box {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px;
            text-align: center;
            position: relative;
            background: #f9f9f9;
            cursor: pointer;
        }

        .teacher-box:hover {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .teacher-box .teacher-name {
            font-size: 16px;
            font-weight: bold;
        }

        .teacher-box .teacher-classes {
            color: orange;
            font-size: 12px;
        }

        .teacher-box.selected {
            border:2px solid rgb(231, 33, 99);
        }

        #absentTeachersTable {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="teacher-grid">
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $teacherID = $row['Teacher_ID'];
                $teacherName = $row['Teacher_Name'];
                echo "
                <div class='teacher-box' id='card-$teacherID' data-bs-toggle='modal' data-bs-target='#modal-$teacherID'>
                    <div class='teacher-name'>$teacherName</div>
                    <div class='teacher-classes'>Classes</div>
                </div>

                <!-- Modal for selecting periods -->
                <div class='modal fade' id='modal-$teacherID' tabindex='-1' aria-labelledby='modalLabel-$teacherID' aria-hidden='true'>
                    <div class='modal-dialog'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <h5 class='modal-title' id='modalLabel-$teacherID'>Select Absent Periods for $teacherName</h5>
                                <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                            </div>
                            <div class='modal-body'>
                                <form>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period1-$teacherID' data-teacher='$teacherName' data-period='1'>
                                        <label class='form-check-label' for='period1-$teacherID'>1st Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period2-$teacherID' data-teacher='$teacherName' data-period='2'>
                                        <label class='form-check-label' for='period2-$teacherID'>2nd Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period3-$teacherID' data-teacher='$teacherName' data-period='3'>
                                        <label class='form-check-label' for='period3-$teacherID'>3rd Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period4-$teacherID' data-teacher='$teacherName' data-period='4'>
                                        <label class='form-check-label' for='period4-$teacherID'>4th Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period5-$teacherID' data-teacher='$teacherName' data-period='5'>
                                        <label class='form-check-label' for='period5-$teacherID'>5th Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period6-$teacherID' data-teacher='$teacherName' data-period='6'>
                                        <label class='form-check-label' for='period6-$teacherID'>6th Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period7-$teacherID' data-teacher='$teacherName' data-period='7'>
                                        <label class='form-check-label' for='period7-$teacherID'>7th Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period8-$teacherID' data-teacher='$teacherName' data-period='8'>
                                        <label class='form-check-label' for='period8-$teacherID'>8th Period</label>
                                    </div>
                                </form>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Close</button>
                                <button type='button' class='btn btn-danger' id='erase-$teacherID'>Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
                ";
            }
        } else {
            echo "<p>No teachers found</p>";
        }

        $conn->close();
        ?>
    </div>

    <div class="text-center mt-4">
        <button class="btn btn-info" id="getAbsentList">Get List</button>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const teacherAbsentData = {}; // Store teacher absent periods

        document.querySelectorAll('.teacher-box').forEach(function (card) {
            card.addEventListener('click', function () {
                const teacherID = card.id.split('-')[1]; 
                const modal = document.getElementById('modal-' + teacherID); 

                const checkboxes = modal.querySelectorAll('.period-checkbox');

                // Restore previous checkbox states (if any)
                checkboxes.forEach(function (checkbox) {
                    const teacherName = checkbox.getAttribute('data-teacher');
                    const period = checkbox.getAttribute('data-period');
                    checkbox.checked = teacherAbsentData[teacherName] && teacherAbsentData[teacherName].includes(period);
                });

                card.classList.add('selected');
            });
        });

        document.querySelectorAll('.period-checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const teacherName = checkbox.getAttribute('data-teacher');
                const period = checkbox.getAttribute('data-period');

                if (!teacherAbsentData[teacherName]) {
                    teacherAbsentData[teacherName] = [];
                }

                if (checkbox.checked) {
                    teacherAbsentData[teacherName].push(period);
                } else {
                    const index = teacherAbsentData[teacherName].indexOf(period);
                    if (index !== -1) {
                        teacherAbsentData[teacherName].splice(index, 1);
                    }
                }

                // Update the teacher's card border based on checkbox status
                const card = document.getElementById('card-' + teacherName);
                if (teacherAbsentData[teacherName].length > 0) {
                    card.classList.add('selected');
                } else {
                    card.classList.remove('selected');
                }
            });
        });

        document.getElementById('getAbsentList').addEventListener('click', function () {
            const absentTeachersBody = document.getElementById('absentTeachersBody');
            absentTeachersBody.innerHTML = ''; 

            for (const [teacher, periods] of Object.entries(teacherAbsentData)) {
                const row = document.createElement('tr');
                row.innerHTML = `<td>${teacher}</td><td>${periods.join(', ')}</td>`;
                absentTeachersBody.appendChild(row);
            }
        });

        document.querySelectorAll('.btn-danger').forEach(function (btn) {
            btn.addEventListener('click', function () {
                const teacherID = btn.id.split('-')[1];
                const modal = document.getElementById('modal-' + teacherID);
                const checkboxes = modal.querySelectorAll('.period-checkbox');

                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = false;
                });

                const teacherName = modal.querySelector('.modal-title').textContent.replace('Select Absent Periods for ', '');
                teacherAbsentData[teacherName] = []; 
                
                // Remove selected border from teacher card
                document.getElementById('card-' + teacherID).classList.remove('selected');
            });
        });
    </script>
</body>
</html>
