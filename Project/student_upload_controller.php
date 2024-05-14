<?php
// Start session to manage user sessions (if not already started in your app)
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

require 'session.php';  // Ensure this is the path to your session management script

$uploadDir = 'Project/uploaded_folder/';  // Path where the files will be uploaded
$allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];  // Allowed file types
$maxSize = 20 * 1024;  // Maximum file size (20KB)

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Process each file
    foreach ($_FILES as $file) {
        // Check for file upload errors
        if ($file['error'] == UPLOAD_ERR_OK) {
            // Validate file size
            if ($file['size'] > $maxSize) {
                echo "Error: " . htmlspecialchars($file['name']) . " is too large (max 20KB).<br>";
                continue;
            }

            // Validate file type
            if (!in_array($file['type'], $allowedTypes)) {
                echo "Error: " . htmlspecialchars($file['name']) . " has an invalid file type.<br>";
                continue;
            }

            // Set target file path
            $targetFilePath = $uploadDir . basename($file['name']);

            // Check if file already exists
            if (file_exists($targetFilePath)) {
                echo "Notice: " . htmlspecialchars($file['name']) . " already exists and will be overwritten.<br>";
            }

            // Move uploaded file to target directory
            if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
                echo "The file " . htmlspecialchars($file['name']) . " has been uploaded.<br>";
            } else {
                echo "Error: There was an error uploading " . htmlspecialchars($file['name']) . ".<br>";
            }
        } else {
            echo "Error: " . $file['error'] . " encountered with file " . htmlspecialchars($file['name']) . ".<br>";
        }
    }
} else {
    echo "Error: Invalid request method.";
}

?>
