<?php include('../favicon.php') ?>
<?php
session_start();
require 'session.php';
require 'super_admin.php';
$table_name = $udise_code . '_student_details';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';
$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);
$registration_no = $user['reg_no'];

if ($user['issubmitted'] == 1) {
    header('location: payment_details.php');
    exit; // Add exit to stop further execution
} 

// Set a directory for uploads
$uploadDir = 'uploads/';

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
    <title>File Upload</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="partials/style.css">
    <link rel="stylesheet" href="../Assets/css/student_file_upload.css">
</head>
<body>
    <?php require ('../Student_Process_header.php') ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <?php include('../card_header.php') ?>
                    <div class="card-body">
                        <h5 class="card-title mb-4">Upload Necessary Documents</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col" class="align-middle text-center">File</th>
                                    <th scope="col" class="align-middle text-center">Image Preview</th>
                                    <th scope="col" class="align-middle text-center">Upload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;">
                                        <?php echo $documents[$i-1]; ?>
                                        <span style="color:rgb(184, 28, 88);"><br>(80 Kb)</span>
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
                                  echo '<p style="text-align: center;color: rgb(179, 230, 98);">No file uploaded</p>';
                                }
                                ?>
                                    </td>

                                    <td class="align-middle text-center <?php if (isset($_FILES[$fileKey]) && $_FILES[$fileKey]["size"] <= $maxFileSize): ?> fade-in <?php endif; ?>">

                                        <div class="d-flex flex-column align-items-center">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                <div class="mb-3">
                                                    <span
                                                        style="font-weight: 100;font-size: small;margin-bottom: -1px;">After
                                                        Choosing,</span>
                                                    <br>
                                                    <span
                                                        style="font-weight: 100;font-size: small;line-height: 1;">click
                                                        on upload</span>
                                                    <input type="file" class="form-control custom-file-input"
                                                        id="newImage<?php echo $i; ?>" name="newImage<?php echo $i; ?>"
                                                        accept="image/*" onchange="updateFileName(this)">
                                                </div>
                                                <button type="submit" name="upload<?php echo $i; ?>"
                                                    class="btn btn-primary mt-2">Upload</button>
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
                    <div style="padding-bottom: 2%; text-align: center;">
                        <a href="marks_details.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-info" style="margin-right: 2%;">
                                Back
                            </button>
                        </a>
                        <a href="choose_sub.php" style="text-decoration: none;">
                            <button type="button" class="btn btn-info" name="file Upload">
                                Save & Next
                            </button>
                        </a>
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