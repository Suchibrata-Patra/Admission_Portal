<?php
// Start the session
session_start();
require 'session.php';  // Ensure you have session management and DB connection

$uploadDirectory = __DIR__ . '/Uploaded_documents/';

// Define allowed file size (20 KB)
$maxFileSize = 20480; // 20 KB in bytes

// Function to handle file uploada
function uploadFile($fileInput, $fileName) {
    global $uploadDirectory, $maxFileSize;

    if (isset($_FILES[$fileInput]) && $_FILES[$fileInput]['error'] == 0) {
        $fileTmpPath = $_FILES[$fileInput]['tmp_name'];
        $fileSize = $_FILES[$fileInput]['size'];
        $fileType = $_FILES[$fileInput]['type'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        // Validate file size
        if ($fileSize > $maxFileSize) {
            return ['success' => false, 'message' => "File size exceeds limit (20 KB)."];
        }

        // Validate file type (if needed, add specific file types)
        if ($fileExtension != "jpg" && $fileExtension != "jpeg" && $fileExtension != "png") {
            return ['success' => false, 'message' => "Unsupported file type. Only JPG, JPEG, PNG are allowed."];
        }

        $newFileName = $uploadDirectory . $fileName;

        if (move_uploaded_file($fileTmpPath, $newFileName)) {
            return ['success' => true, 'message' => "File uploaded successfully."];
        } else {
            return ['success' => false, 'message' => "Error uploading file."];
        }
    }
    return ['success' => false, 'message' => "No file uploaded or file upload error."];
}

// Handling multiple document uploads
$results = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (!empty($_FILES)) {
        // List all expected files as per form input names
        $filesToUpload = [
            'passportPhoto' => 'passport_photo.jpg',
            'aadharCard' => 'aadhar_card.jpg',
            'mpAdmit' => 'madhyamik_admit.jpg',
            'MP_Marksheet' => 'madhyamik_marksheet.jpg',
            'MP_Certificate' => 'madhyamik_certificate.jpg'
        ];

        foreach ($filesToUpload as $inputName => $savedAs) {
            if (isset($_FILES[$inputName])) {
                $results[$inputName] = uploadFile($inputName, $savedAs);
            }
        }
    }

    // Check if any files were uploaded without errors
    $allSuccess = true;
    foreach ($results as $result) {
        if (!$result['success']) {
            $allSuccess = false;
            break;
        }
    }

    // Redirect based on the result of file uploads
    if ($allSuccess) {
        header("Location: choose_sub.php"); // Next page or success page
        exit;
    } else {
        // Error handling, could pass error messages via session or similar
        header("Location: error_page.php"); // Redirect to an error page
        exit;
    }
}
?>
