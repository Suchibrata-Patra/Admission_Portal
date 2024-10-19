<?php
// Enable error reporting for debugging (disable in production)
// ini_set('display_errors', 1);
// error_reporting(E_ALL);

// Start session and require the Admin_Session file
require 'Admin_Session.php';

// Function to copy a directory recursively
function copyDirectory($source, $destination) {
    if (!is_dir($destination)) {
        mkdir($destination, 0755, true);  // Create destination folder if it doesn't exist
    }
    $files = scandir($source);  // Get files and directories in the source folder
    foreach ($files as $file) {
        if ($file !== '.' && $file !== '..') {
            $sourceFile = $source . '/' . $file;
            $destinationFile = $destination . '/' . $file;
            if (is_dir($sourceFile)) {
                copyDirectory($sourceFile, $destinationFile);  // Recursively copy subdirectories
            } else {
                copy($sourceFile, $destinationFile);  // Copy individual files
            }
        }
    }
}

// Function to sanitize UDISE ID
function sanitizeUdiseId($id) {
    // Only allow alphanumeric characters and underscores
    return preg_replace('/[^a-zA-Z0-9_]/', '', $id);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get UDISE ID from the form input and sanitize it
    $udise_id = sanitizeUdiseId($_POST['udise_id']);
    
    if (!empty($udise_id)) {
        // Define source and destination paths
        $source_folder = realpath('../New_Reg_Dummy_Folder');  // Use absolute path for source
        $destination_folder = realpath('..') . '/' . basename($udise_id);  // Absolute path for destination

        // Check if source folder exists
        if (is_dir($source_folder)) {
            // Copy the directory
            copyDirectory($source_folder, $destination_folder);
            $message = "Folder copied successfully to <strong>" . htmlspecialchars($destination_folder) . "</strong>.";
        } else {
            $message = "Source folder does not exist.";
        }
    } else {
        $message = "UDISE ID cannot be empty.";
    }
} else {
    $message = "";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="robots" content="noindex, nofollow">
    <title>Copy Folder</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            color: #333;
        }

        .container {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            padding: 30px;
            max-width: 400px;
            width: 100%;
            transition: transform 0.3s;
        }



        h1 {
            text-align: center;
            color: #000000;
            margin-bottom: 20px;
            font-size: 24px;
        }

        label {
            font-weight: 700;
            margin-bottom: 5px;
            display: block;
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-bottom: 15px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus {
            border-color: #000000;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #000000;
            color: #fff;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #000000;
        }

        p {
            text-align: center;
            font-weight: 200;
            color: #28a745;
            margin-top: 15px;
        }

        .error {
            color: #dc3545;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Clone Directory</h1>

        <!-- Display a message if exists -->
        <?php if (!empty($message)): ?>
            <p class="<?php echo strpos($message, 'successfully') !== false ? '' : 'error'; ?>">
                <?php echo $message; ?>
            </p>
        <?php endif; ?>

        <!-- Form to input UDISE ID and submit the copy operation -->
        <form method="POST" action="">
            <label for="udise_id">Enter UDISE ID:</label>
            <input type="text" id="udise_id" name="udise_id" required>
            <button type="submit">Copy Folder</button>
        </form>
       
    </div>
</body>
</html>
