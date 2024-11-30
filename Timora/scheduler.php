<?php
// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the raw POST data
    $inputData = file_get_contents("php://input");

    // Decode the JSON data
    $absentTeachersData = json_decode($inputData, true);

    if (json_last_error() === JSON_ERROR_NONE) {
        // Now $absentTeachersData contains the absent teachers and their periods
        // Example of processing the data:
        foreach ($absentTeachersData as $teacherName => $periods) {
            // Here you can perform whatever logic you need to manipulate the provisional routine
            // For example, saving the absent teacher data to the database or updating a schedule

            echo "Teacher: $teacherName, Absent Periods: " . implode(", ", $periods) . "\n";
        }

        // You can send a response back to the frontend if needed
        echo json_encode(['status' => 'success', 'message' => 'Data processed successfully']);
    } else {
        // Handle invalid JSON data
        echo json_encode(['status' => 'error', 'message' => 'Invalid JSON data']);
    }
} else {
    // Handle non-POST requests
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>
