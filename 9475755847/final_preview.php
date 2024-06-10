<?php include('../favicon.php') ?>
<?php
require 'session.php';
require 'super_admin.php';

$table_name = $udise_code . '_student_details';
$school_table = $udise_code . '_HOI_Login_Credentials';

// Fetch user details from the database
$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

// Check if user's number is verified, if not, redirect to verify.php
if ($user['issubmitted'] == 1) {
    header('location: payment_details.php');
    exit; // Add exit to stop further execution
} 

$registration_no = $user['reg_no'];
// Calculate total and obtained marks
$total_marks = ($user['bengali_full_marks'] + $user['english_full_marks'] + $user['mathematics_full_marks'] + $user['physical_science_full_marks'] + $user['life_science_full_marks'] + $user['history_full_marks'] + $user['geography_full_marks']);
$obtained_marks = ($user['bengali_marks'] + $user['english_marks'] + $user['mathematics_marks'] + $user['physical_science_marks'] + $user['life_science_marks'] + $user['history_marks'] + $user['geography_marks']);

// Handle form submission
if (isset($_POST['submit'])) {
    $updateQuery = "UPDATE $table_name SET issubmitted = 1 WHERE reg_no = '$reg_no'";
    $update_result = mysqli_query($db, $updateQuery);

    if ($update_result) {
        $_SESSION['success'] = "Marks updated successfully";
        header('Location: payment_details.php');
        exit;
    } else {
        header('Location: error.php');
        exit;
    }
}

$school_query = "SELECT `HOI_Mobile_No`,`HOI_Mobile_No`, `HOI_Whatsapp_No`, `Institution_Name`, `HOI_Name`, `Institution_Address`, `Formfillup_Start_Date`, `Formfillup_Last_Date`, `First_merit_list_date`, `Admission_Beginning_for_First_List`, `Admission_Closes_For_First_List`, `Second_List` from $school_table;";
$info = mysqli_query($db, $school_query);
$school_info = mysqli_fetch_assoc($info);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Details Preview</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <link rel="stylesheet" href="../Assets/css/final_preview.css">
</head>

<body>
    <div class="container mt-5">
        <div class="school-info-container">
            <center><h2 class="school-name"><?php echo $school_info['Institution_Name'] ?></h2></center>
            <div class="school-details">
                <h6 class="school-detail">Address: <span><?php echo $school_info['Institution_Address'] ?></span></h6> |
                <h6 class="school-detail">Contact: <span><?php echo $school_info['HOI_Mobile_No'] ?></span></h6> |
                <h6 class="school-detail">WhatsApp: <span><?php echo $school_info['HOI_Whatsapp_No'] ?></span></h6>
            </div>
        </div>
        <br>
        <h5>
            <center>Pre-Submission Preview</center>
        </h5>
        <p style="font-size:14px;color:grey;">Kindly Recheck All the details Before Submitting the Details. Once
            Submitted, You can't No Longer Modify them.</p>
        <form method="post" action="final_preview.php">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">Registration No</label>
                    <input type="text" id="fname" class="form-control disabled-input"
                        value="<?php echo $user['reg_no'] ?>" disabled />
                </div>
                <div class="form-group col-md-6" style="width: 100px; height: auto">
                    <div class="form-group col-md-6 d-flex justify-content-center" style="margin-left: 25%;">
                        <?php
// Define the possible file extensions
$allowedExtensions = ['png', 'jpg', 'jpeg'];

// Loop through each allowed extension
foreach ($allowedExtensions as $extension) {
    // Construct the file path with the current extension
    $photoPath = "uploads/{$registration_no}_passportsizephoto.{$extension}";

    // Check if the file exists
    if (file_exists($photoPath)) {
        // Display the image with the detected file format
        echo "<img src='{$photoPath}' class='img-fluid' alt='Passport Size Photo' style='width: 120px; height: auto;'>";
        break; // Exit the loop once the image is found
    }
}
?> <a href="student_file_upload.php" style="margin-left:5%;">
                            <span class="material-symbols-outlined" style="font-size:20px;padding-top:80%">edit</span>
                            Edit
                        </a>
                    </div>
                </div>
            </div>
            <div class="form-row" style="margin-top: -3%">
                <div class="form-group col-md-4">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" class="form-control disabled-input check-input"
                        value="<?php echo $user['fname'] ?>" disabled />

                </div>
                <div class="form-group col-md-4">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" class="form-control disabled-input"
                        value="<?php echo $user['lname'] ?>" disabled />
                </div>
                <div class="form-group col-md-4">
                    <label for="lname">DOB</label>
                    <input type="text" id="lname" class="form-control disabled-input" value="<?php echo $user['dob'] ?>"
                        disabled />
                </div>
            </div>
            <div class="personal_details"
                style="background-color: #f9f5f5; border:1.8px dashed rgb(254, 211, 211); border-radius: 10px; padding:10px;">
                <div style="margin-bottom: -2%; margin-left:2%;font-weight: bold;">Personal Details</div>
                <a href="personal_details.php" class="btn btn-outline-dark" style="margin-left: 85%;">
                    <span class="material-symbols-outlined" style="font-size:20px;">edit_document</span> Edit
                </a>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fname">Father's Name</label>
                        <input type="text" id="fname" class="form-control disabled-input"
                            value="<?php echo $user['fathers_name'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname">Mother's Name</label>
                        <input type="text" id="lname" class="form-control disabled-input"
                            value="<?php echo $user['mothers_name'] ?>" disabled />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="student_religion">Email ID</label>
                        <input type="text" id="student_religion" class="form-control disabled-input"
                            value="<?php echo $user['email'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="student_caste">Mobile No</label>
                        <input type="text" id="student_caste" class="form-control disabled-input"
                            value="<?php echo $user['phoneNumber'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="is_student_pwd">WhatsApp No</label>
                        <input type="text" id="is_student_pwd" class="form-control disabled-input"
                            value="<?php echo $user['phoneNumber'] ?>" disabled />
                    </div>
                </div>
                <!-- <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" class="form-control disabled-input" disabled>
            </div> -->
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="fname">Address</label>
                        <input type="text" id="fname" class="form-control disabled-input"
                            value="<?php echo $user['student_village_town'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-6">
                        <label for="lname">Previous School Name</label>
                        <input type="text" id="lname" class="form-control disabled-input"
                            value="<?php echo $user['previous_school_name'] ?>" disabled />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="city">City</label>
                        <input type="text" id="city" class="form-control disabled-input"
                            value="<?php echo $user['student_city'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="pinCode">PIN Code</label>
                        <input type="text" id="pinCode" class="form-control disabled-input"
                            value="<?php echo $user['student_pin_code'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="district">District</label>
                        <input type="text" id="district" class="form-control disabled-input"
                            value="<?php echo $user['student_district'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="state">State</label>
                        <input type="text" id="state" class="form-control disabled-input"
                            value="<?php echo $user['student_state'] ?>" disabled />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="city">Aadhar Card No</label>
                        <input type="text" id="city" class="form-control disabled-input"
                            value="<?php echo $user['aadhar_card_no'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="district">Caste</label>
                        <input type="text" id="district" class="form-control disabled-input"
                            value="<?php echo $user['student_caste'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="state">Religion</label>
                        <input type="text" id="state" class="form-control disabled-input"
                            value="<?php echo $user['student_religion'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-2">
                        <label for="pinCode">EWS</label>
                        <input type="text" id="pinCode" class="form-control disabled-input"
                            value="<?php echo $user['is_student_EWS'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-3">
                        <label for="pinCode">PWD</label>
                        <input type="text" id="pinCode" class="form-control disabled-input"
                            value="<?php echo $user['is_student_PWD'] ?>" disabled />
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="previous_school_name">Bank</label>
                        <input type="text" id="previous_school_name" class="form-control disabled-input"
                            value="<?php echo $user['bank_name'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="current_whatsapp_no">Bank Account No</label>
                        <input type="text" id="current_whatsapp_no" class="form-control disabled-input"
                            value="<?php echo $user['bank_account_no'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="current_whatsapp_no">IFSC</label>
                        <input type="text" id="current_whatsapp_no" class="form-control disabled-input"
                            value="<?php echo $user['bank_ifsc_code'] ?>" disabled />
                    </div>
                </div>
            </div>



            <!-- <div class="form-group">
                <label for="aadhar_card_no">Aadhar Card Number</label>
                <input type="text" id="aadhar_card_no" class="form-control disabled-input" disabled>
            </div> -->
            <br>
            <div class="choose_subject"
                style="background-color: #ffffff; border:1.8px dashed rgb(254, 211, 211); border-radius: 10px; padding:10px;">
                <div style="margin-bottom: -2%; margin-left:2%;font-weight: bold;">Stream & Subject Combination</div>
                <a href="choose_sub.php" class="btn btn-outline-dark" style="margin-left: 85%;">
                    <span class="material-symbols-outlined" style="font-size:20px;">edit_document</span> Edit
                </a>



                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="student_religion">First Language</label>
                        <input type="text" id="student_religion" class="form-control disabled-input"
                            value="<?php echo $user['language_1']?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="student_caste">Second Language</label>
                        <input type="text" id="student_caste" class="form-control disabled-input"
                            value="<?php echo $user['language_2'] ?>" disabled />
                    </div>
                    <div class="form-group col-md-4">
                        <label for="is_student_pwd">Selected Stream</label>
                        <input type="text" id="is_student_pwd" class="form-control disabled-input"
                            value="<?php echo $user['select_stream'] ?>" disabled />
                    </div>
                </div>
                <div class="form-group">
                    <label for="address">Subject Combinations</label>
                    <input type="text" id="address" class="form-control disabled-input"
                        value="<?php echo $user['sub_comb'] ?>" disabled />
                </div>
            </div>


            <br>
            <div class="marks_details"
                style="background-color: #ffffff; border:1.8px dashed rgb(254, 211, 211); border-radius: 10px; padding:10px;">
                <div style="margin-bottom: -2%; margin-left:2%;font-weight: bold;">Marks Details</div>
                <a href="marks_details.php" class="btn btn-outline-dark" style="margin-left: 85%;">
                    <span class="material-symbols-outlined" style="font-size:20px;">edit_document</span> Edit
                </a>
                <div class="container" style="margin-top:1%;">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th scope="col">Full Marks</th>
                                <th scope="col">Marks Obtained</th>
                                <th scope="col">Full Marks</th>
                                <th scope="col">% of Marks</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Bengali</td>
                                <td>
                                    <?php echo $user['bengali_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['bengali_full_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['bengali_marks']*100/$user['bengali_full_marks']?>
                                </td>
                            </tr>
                            <tr>
                                <td>English</td>
                                <td>
                                    <?php echo $user['english_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['english_full_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['english_marks']*100/$user['english_full_marks']?>
                                </td>

                            </tr>
                            <tr>
                                <td>Mathematics</td>
                                <td>
                                    <?php echo $user['mathematics_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['mathematics_full_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['mathematics_marks']*100/$user['mathematics_full_marks']?>
                                </td>


                            </tr>
                            <tr>
                                <td>Physical Sc.</td>
                                <td>
                                    <?php echo $user['physical_science_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['physical_science_full_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['physical_science_marks']*100/$user['physical_science_full_marks']?>
                                </td>


                            </tr>
                            <tr>
                                <td>Life Sc.</td>
                                <td>
                                    <?php echo $user['life_science_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['life_science_full_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['life_science_marks']*100/$user['life_science_full_marks']?>
                                </td>


                            </tr>
                            <tr>
                                <td>History</td>
                                <td>
                                    <?php echo $user['history_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['history_full_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['history_marks']*100/$user['history_full_marks']?>
                                </td>


                            </tr>
                            <tr>
                                <td>Geography</td>
                                <td>
                                    <?php echo $user['geography_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['geography_full_marks']?>
                                </td>
                                <td>
                                    <?php echo $user['geography_marks']*100/$user['geography_full_marks']?>
                                </td>


                            </tr>
                            <tr>
                                <td><strong>Total</strong></td>
                                <td> <strong>
                                        <?php echo $obtained_marks ?>
                                    </strong></td>
                                <td><strong>
                                        <?php echo $total_marks ?>
                                    </strong></td>
                                <td> <strong>
                                        <?php echo round($obtained_marks*100/$total_marks,2)?>
                                    </strong></td>


                            </tr>

                        </tbody>
                    </table>
                </div>

            </div>



            <hr>
            <h5>Confirmation</h5>
            <div style="display: flex; align-items: center;">
                <div style="flex: 1;">
                    <p>I hereby confirm that all information provided herein is accurate and complete. My signature
                        serves as an attestation to the veracity of the aforementioned details.</p>
                </div>
                <?php
    // Define the possible file extensions
    $allowedExtensions = ['png', 'jpg', 'jpeg'];

    // Loop through each allowed extension
    foreach ($allowedExtensions as $extension) {
        // Construct the file path with the current extension
        $photoPath = "uploads/{$registration_no}_signature.{$extension}";

        // Check if the file exists
        if (file_exists($photoPath)) {
            // Display the image with the detected file format
            echo "<img src='{$photoPath}' class='img-fluid' alt='Signature' style='width: 120px; height: auto;'>";
            break; // Exit the loop once the image is found
        }
    }
    ?>
            </div>

            <hr>
            <div class="container mt-5">
                <h4>Wait ! Confirm Before Submission</h4>
                <form method="post" action="final_preview.php">
                    <!-- Your existing form fields -->

                    <!-- Checkbox and confirmation message -->
                    <div class="form-group form-check">
                        <input type="checkbox" class="form-check-input" id="confirmCheckbox" name="confirmCheckbox"
                            required>
                        <label class="form-check-label" for="confirmCheckbox">I Agree with the following condition.Once
                            this form is submitted, it can't be edited later.</label>
                    </div>

                    <!-- Additional instructions -->
                    <p class="text-muted">Please double-check all the information provided before submitting the form.
                        Once submitted, it cannot be edited.</p>

                    <button type="submit" name="submit" class="btn btn-info" id="confirmButton">Confirm
                        Submission</button>
                </form>
            </div>

            <!-- Add more fields if necessary -->
        </form>

    </div>
    <script>
        if$user['fname']
    </script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>