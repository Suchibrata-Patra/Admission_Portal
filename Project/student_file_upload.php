<?php
session_start();
require 'session.php';

$query = "SELECT * FROM student_details WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
$registration_no = $user['reg_no'];

if ($user['issubmitted'] == 1) {
    header('location: payment_details.php');
    exit; // Add exit to stop further execution
} 

// Set a directory for uploads
$uploadDir = 'uploads/';

$allFilesUploaded = false;
// Check if all files are uploaded successfully
if(isset($uploadMessages) && count($uploadMessages) == 5 && !in_array("File $i: Either not uploaded or exceeds size limit of 80 KB.", $uploadMessages)) {
    $allFilesUploaded = true;
}
// Check if the directory exists, if not create it
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$uploadMessages = [];
$documents = array(
  "Passport Size Photo",
  "Aadhar Card",
  "Madhyamik Marksheet",
  "Madhyamik Certificate",
  "Signature"
);

// Maximum file size allowed (80 KB)
$maxFileSize = 80 * 1024; // 80 KB in bytes

// Check for each file upload individually
for ($i = 1; $i <= 5; $i++) {
    // Check if the form is submitted and the upload button for this file is clicked
    $fileKey = "newImage$i";
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["upload$i"])) {
        // Check if the file is uploaded successfully and within size limit
        if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]["error"] == 0 && $_FILES[$fileKey]["size"] <= $maxFileSize) {
            $originalName = $_FILES[$fileKey]["name"];
            $fileType = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

            // Allow only certain file formats
            $allowedFormats = ["jpg", "jpeg", "png", "gif"];
            if (in_array($fileType, $allowedFormats)) {
                // Create a unique file name with registration number and document name
                $documentName = str_replace(' ', '', strtolower($documents[$i - 1])); // Remove spaces and convert to lowercase
                $newFileName = $registration_no . '_' . $documentName; // Remove the file extension from the new filename
                $targetFile = $uploadDir . $newFileName . '.' . $fileType;

                // Check if any file with the same name (without extension) already exists
                $existingFiles = glob($uploadDir . $registration_no . '_' . $documentName . '.*');
                foreach ($existingFiles as $existingFile) {
                    unlink($existingFile); // Delete existing files with the same name (irrespective of extension)
                }

                // Move the uploaded file to the upload directory with the new filename
                if (move_uploaded_file($_FILES[$fileKey]["tmp_name"], $targetFile)) {
                    $uploadMessages[$i] = "File $i uploaded successfully!";
                } else {
                    $uploadMessages[$i] = "File $i could not be uploaded.";
                }
            } else {
                $uploadMessages[$i] = "File $i: Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
            }
        } else {
            $uploadMessages[$i] = "File $i: Either not uploaded or exceeds size limit of 80 KB.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Cache-Control" content="public, max-age=3600">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        .header {
            background-color: white;
            color: black;
            text-align: right;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .container {
            margin: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .row {
            margin-left: -15px;
            margin-right: -15px;
        }

        .col-xs-6 {
            width: 50%;
            float: left;
            padding-left: 15px;
            padding-right: 15px;
        }

        .tab-content {
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            margin-top: 20px;
        }

        .logout {
            color: white;
            background-color: red;
            padding: 7px;
            border-radius: 5px;
            text-decoration: none;
        }

        .logout:hover {
            background-color: yellow;
            color: black;
        }

        .document-preview {
            width: 100px;
            height: auto;
            border: 2px dashed #ddd;
            display: flex;
            align-items: center;
            justify-content: center;
            /* font-weight: bold; */
            color: #888888;
            margin-top: 20px;
            background-size: contain;
            /* Adjusted to 'contain' */
            background-repeat: no-repeat;
            /* Prevent background repetition */
            background-position: center center;
        }

        .custom-upload-btn {
            background-color: rgb(255, 253, 208);
            color: rgb(0, 0, 0);
            padding: 4px 7px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        .preview-img {
            max-height: 150px;
            width: 150px;
            border: 1px solid #ddd;
            display: block;
            margin: auto;
        }

        .custom-file-input {
            color: #ffffff;
            width: 120px;
            border: none;
        }

        .custom-file-input::-webkit-file-upload-button {
            visibility: hidden;
        }

        .custom-file-input::before {
            content: 'Choose';
            display: inline-block;
            background-color: rgb(0, 0, 0);
            color: white;
            padding: 4px 8px;
            border-radius: 5px;
            cursor: pointer;
        }

        .custom-file-input:hover::before {
            background-color: #333;
        }

        .custom-file-input:active::before {
            background-color: #666;
        }

        .td {
            border: 1px solid red;
        }
        @keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.fade-in {
    animation: fadeIn 0.5s ease-in-out;
}

    </style>
</head>

<body>
    <div class="header">
        <h2>Welcome
            <?php echo $user['fname']; ?>
        </h2>
        <a href="welcome.php?logout='1'" class="logout">Logout</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-pills card-header-pills">
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Student Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="marks_details.php">Marks Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="personal_details.php">Personal Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Address Details</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="#">File Upload</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Choose Sub.</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Preview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Final Submission</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link disabled" href="#">Payment</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <h5 class="card-title mb-4">Upload Necessary Documents</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle text-center" style="background-color: #e1e1e1;">File</th>
                                    <th scope="col" class="align-middle text-center" style="background-color: #e1e1e1;">Image Preview</th>
                                    <th scope="col" class="align-middle text-center" style="background-color: #e1e1e1;">Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <?php echo $documents[$i-1]; ?>
                                        <span style="font-weight: bold;color: rgb(239, 159, 84);"><br>(Max 80 kb)</span>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <!-- This is File <?php echo $i; ?> -->
                                        <?php
                                $uploadedFilePaths = glob($uploadDir . $registration_no . '_' . str_replace(' ', '', strtolower($documents[$i - 1])) . '.*');
                                if (!empty($uploadedFilePaths)) {
                                  $uploadedFilePath = $uploadedFilePaths[0];
                                  echo '<img src="' . $uploadedFilePath . '?t=' . time() . '" alt="Uploaded Image" class="preview-img">';
                  # This is the logic for Cahe Bursting to show fresh copy of images...
                                } else {
                                  echo '<p style="text-align: center;">No file uploaded</p>';
                                }
                                ?>
                                    </td>

                                    <td class="align-middle text-center <?php if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]["size"] <= $maxFileSize): ?> fade-in <?php endif; ?>">
    <div class="d-flex flex-column align-items-center">
        <form action="" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <span style="font-weight: 100;font-size: small;margin-bottom: -1px;">After Choosing,</span> 
                <br>
                <span style="font-weight: 100;font-size: small;margin-top:-3px;">Click on upload</span>
                <input type="file" class="form-control custom-file-input"
                    id="newImage<?php echo $i; ?>" name="newImage<?php echo $i; ?>"
                    accept="image/*" onchange="updateFileName(this)">
            </div>
            <button type="submit" name="upload<?php echo $i; ?>"
                class="btn btn-primary" style="margin-top:-20%;margin-left:-20%;padding-top: 4px;padding-bottom: 4px;">Upload</button>
        </form>
    </div>
</td>


                                    <?php if (isset($uploadMessages[$i])): ?>
                                    <!-- <td>
                                        <p class="upload-message">
                                            <?php echo $uploadMessages[$i]; ?>
                                        </p>
                                    </td> -->
                                    <?php endif; ?>
                                </tr>
                                <?php endfor; ?>
                            </tbody>
                        </table>
                    </div>
                    <div style="margin-left: 50%; padding-bottom: 2%">
                        <a href="marks_details.php" style="color: black; text-decoration: none">
                            <button type="button" class="btn btn-primary" style="
        margin-right: 2%;
        background-color: rgb(0, 0, 0);
        color: rgb(255, 255, 255);
        border: 0px;
      ">
                                Back
                            </button>
                        </a>
                        <a href="choose_sub.php" style="color: black; text-decoration: none">
                            <button type="button" class="btn btn-primary" name="file Upload" style="
        margin-right: 2%;
        background-color: rgb(0, 0, 0);
        color: rgb(255, 255, 255);
        border: 0px;
      ">
                                Save & Next
                            </button></a>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script>
        function updateFileName(input) {
            var fileName = input.files[0].name;
            var label = document.getElementById('fileName' + input.id.slice(-1));
            label.textContent = fileName;
        }
    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" crossorigin="anonymous"></script>
</body>

</html>