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

// Fetch teachers and their period off
$teachersQuery = "SELECT * FROM teacher_profile";
$teachersResult = $conn->query($teachersQuery);

// Fetch available classes and time slots
$classesQuery = "SELECT Weekday, Class, Class_Time FROM class_schedule WHERE Teacher_ID IS NULL";
$classesResult = $conn->query($classesQuery);

if ($teachersResult->num_rows > 0 && $classesResult->num_rows > 0) {
    $routine = [];

    // Generate routine
    while ($classRow = $classesResult->fetch_assoc()) {
        $weekday = $classRow['Weekday'];
        $class = $classRow['Class'];
        $time = $classRow['Class_Time'];

        // Find an available teacher
        $teachersResult->data_seek(0); // Reset pointer
        while ($teacherRow = $teachersResult->fetch_assoc()) {
            $teacherId = $teacherRow['Teacher_ID'];
            $teacherName = $teacherRow['Name'];
            $periodOff = explode(',', $teacherRow['Period_Off']); // Assuming comma-separated periods

            if (!in_array($time, $periodOff)) {
                // Assign teacher
                $routine[] = [
                    'Weekday' => $weekday,
                    'Class' => $class,
                    'Time' => $time,
                    'Teacher' => $teacherName,
                ];

                // Update database
                $updateQuery = "UPDATE class_schedule SET Teacher_ID = $teacherId WHERE Weekday = '$weekday' AND Class = '$class' AND Class_Time = '$time'";
                $conn->query($updateQuery);
                break;
            }
        }
    }

    // Display the routine
    echo "<h1>Provisional Routine</h1>";
    echo "<table border='1' style='width: 100%; text-align: center;'>";
    echo "<tr><th>Weekday</th><th>Class</th><th>Time</th><th>Teacher</th></tr>";
    foreach ($routine as $entry) {
        echo "<tr>";
        echo "<td>{$entry['Weekday']}</td>";
        echo "<td>{$entry['Class']}</td>";
        echo "<td>{$entry['Time']}</td>";
        echo "<td>{$entry['Teacher']}</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No data available to generate routine.";
}

$conn->close();
?>
