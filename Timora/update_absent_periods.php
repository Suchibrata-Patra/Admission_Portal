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

// Retrieve the posted data
$absentData = json_decode($_POST['absentData'], true);

foreach ($absentData as $data) {
    $teacherName = $data['teacher_name'];
    $periods = $data['periods'];

    // Update the teacher_profile table with the absent periods
    foreach ($periods as $period) {
        $periodColumn = strtolower(str_replace(' ', '_', $period)) . '_allowed'; // Convert period name to column name
        $sql = "UPDATE teacher_profile SET $periodColumn = 1 WHERE Teacher_Name = ?";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $teacherName); // Bind the teacher's name
        $stmt->execute();
    }
}

// Close the connection
$conn->close();
?>
