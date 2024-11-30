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
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period1-$teacherID' data-teacher='$teacherName' data-period='1st' >
                                        <label class='form-check-label' for='period1-$teacherID'>1st Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period2-$teacherID' data-teacher='$teacherName' data-period='2nd' >
                                        <label class='form-check-label' for='period2-$teacherID'>2nd Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period3-$teacherID' data-teacher='$teacherName' data-period='3rd' >
                                        <label class='form-check-label' for='period3-$teacherID'>3rd Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period4-$teacherID' data-teacher='$teacherName' data-period='4th' >
                                        <label class='form-check-label' for='period4-$teacherID'>4th Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period5-$teacherID' data-teacher='$teacherName' data-period='5th' >
                                        <label class='form-check-label' for='period5-$teacherID'>5th Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period5-$teacherID' data-teacher='$teacherName' data-period='6th' >
                                        <label class='form-check-label' for='period5-$teacherID'>6th Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period5-$teacherID' data-teacher='$teacherName' data-period='7th' >
                                        <label class='form-check-label' for='period5-$teacherID'>7th Period</label>
                                    </div>
                                    <div class='form-check'>
                                        <input class='form-check-input period-checkbox' type='checkbox' id='period5-$teacherID' data-teacher='$teacherName' data-period='8th' >
                                        <label class='form-check-label' for='period5-$teacherID'>8th Period</label>
                                    </div>
                                </form>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-light' data-bs-dismiss='modal'>Save</button>
                                <!-- <button type='button' class='btn btn-primary save-absent-data' data-teacher='$teacherName'>Save Changes</button> -->
                                <button type='button' class='btn btn-danger' id='erase-$teacherID'>Reset</button> <!-- Erase button -->
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

    <!-- Button to get the absent teachers list -->
    <div class="text-center mt-4">
        <button class="btn btn-info" id="getAbsentList">Get List</button>
    </div>

    <!-- Table to display absent teachers and their periods -->
    <div id="absentTeachersTable" class="container mt-4">
        <h3>Absent Teachers</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Teacher Name</th>
                    <th>Absent Periods</th>
                </tr>
            </thead>
            <tbody id="absentTeachersBody">
                <!-- Rows will be added dynamically -->
            </tbody>
        </table>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.querySelectorAll('.teacher-box').forEach(function (card) {
    card.addEventListener('click', function () {
        const teacherID = card.id.split('-')[1]; // Get teacher ID from card
        const modal = document.getElementById('modal-' + teacherID); // Get the corresponding modal

        // Select all checkboxes inside the modal and check them by default
        const checkboxes = modal.querySelectorAll('.period-checkbox');
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = true;
        });

        // Reset the card border to black when the modal is opened (checkboxes checked by default)
        card.classList.add('selected');

        // Handle erase button click
        const eraseButton = document.getElementById('erase-' + teacherID);
        eraseButton.addEventListener('click', function () {
            checkboxes.forEach(function (checkbox) {
                checkbox.checked = false; // Uncheck all checkboxes
            });
            // Remove the 'selected' class from the card if all checkboxes are unchecked
            card.classList.remove('selected');
        });
    });
});

        // Add event listener to each card
        document.querySelectorAll('.teacher-box').forEach(function (card) {
            card.addEventListener('click', function () {
                const teacherID = card.id.split('-')[1]; // Get teacher ID from card
                const modal = document.getElementById('modal-' + teacherID); // Get the corresponding modal

                // Select all checkboxes inside the modal and check them by default
                const checkboxes = modal.querySelectorAll('.period-checkbox');
                checkboxes.forEach(function (checkbox) {
                    checkbox.checked = true;
                });

                // Reset the card border to black when the modal is opened (checkboxes checked by default)
                card.classList.add('selected');
            });
        });

        // Add event listener to checkboxes to track changes
        document.querySelectorAll('.period-checkbox').forEach(function (checkbox) {
            checkbox.addEventListener('change', function () {
                const teacherID = checkbox.id.split('-')[1]; // Get teacher ID from checkbox
                const card = document.getElementById('card-' + teacherID); // Get the corresponding card element

                // If any checkbox is checked, add the 'selected' class to the card
                if (checkbox.checked) {
                    card.classList.add('selected');
                } else {
                    // If no checkboxes are selected, remove the 'selected' class
                    const checkboxesForCard = document.querySelectorAll(`#modal-${teacherID} .period-checkbox`);
                    const isAnyChecked = Array.from(checkboxesForCard).some(input => input.checked);

                    if (!isAnyChecked) {
                        card.classList.remove('selected');
                    }
                }
            });
        });

        document.getElementById("getAbsentList").addEventListener("click", function () {
            const absentTeachersBody = document.getElementById("absentTeachersBody");
            absentTeachersBody.innerHTML = ""; // Clear the table body

            // Collect data from checkboxes
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

            // Populate the table
            for (const [teacher, periods] of Object.entries(absentData)) {
                const row = document.createElement("tr");
                row.innerHTML = `
                    <td>${teacher}</td>
                    <td>${periods.join(", ")}</td>
                `;
                absentTeachersBody.appendChild(row);
            }
        });
    </script>
</body>
</html>
