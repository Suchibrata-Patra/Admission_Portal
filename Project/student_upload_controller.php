<?php
require 'session.php';

if (!isset($_SESSION['email'])) {
    header('location: login.php');
    exit; // Stop further execution
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uploadDirectory = "uploads/";

    if (!file_exists($uploadDirectory)) {
        mkdir($uploadDirectory, 0777, true);
    }

    foreach ($_FILES as $inputName => $file) {
        if ($file['error'] == UPLOAD_ERR_OK) {
            $tmpName = $file["tmp_name"];

            $fileName = uniqid() . "_" . basename($file["name"]);

            $destination = $uploadDirectory . $fileName;

            if (move_uploaded_file($tmpName, $destination)) {
                echo "File uploaded successfully: " . $fileName . "<br>";
            } else {
                echo "Error uploading file: " . $file["name"] . "<br>";
            }
        } else {
            echo "Error uploading file: " . $file["name"] . "<br>";
        }
    }
} else {
    header('location: upload.php');
    exit; 
}
?>
