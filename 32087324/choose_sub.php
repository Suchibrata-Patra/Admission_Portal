<?php include('../favicon.php') ?>
<?php
require 'session.php';
require 'super_admin.php';
$table_name = $udise_code . '_student_details';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';

if ($user['issubmitted'] == 1) {
    echo '<script>window.location.href = "payment_details.php";</script>';
    exit(); // Add exit to stop further execution
} 

$query = "SELECT * FROM 9475755847_Subject_Details"; // Query to fetch data from the table
$results = mysqli_query($db, $query);
$subject_combinations = [];
while ($row = mysqli_fetch_assoc($results)) {
    $subject_combinations[] = $row;
}

$subject_combinations_json = json_encode($subject_combinations); // Encode fetched data into JSON
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Cache-Control" content="public, max-age=3600">
    <title>Choose Sub.</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
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
            width: 100%;
            height: 100px;
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

        /* Hide default file input button */
        .custom-upload-btn input[type="file"] {
            display: none;
        }

        @media (max-width: 1250px) {
            .row {
                width: 98% !important;
            }

            .col-xs-12 {
                padding-left: 0px;
            }
        }
    </style>
</head>

<body>
<?php require ('../Student_Process_header.php') ?>

    <form action="choose_sub_controller.php" method="POST">
    <div class="container">
        <div class="row" style="width: 120%;">
            <div class="col-xs-12">
                <div class="card text-center">
                <?php include('../card_header.php') ?>

<!-- This is the beginning of the Card Body portion-->
<div class="card-body">
<div class="container mt-5">
        <h4>Choose Stream, Subjects, and Languages</h4>
            <!-- Select Languages Section -->
            <div class="container mt-5">
                <!-- <h2>Select Your Languages</h2> -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <!-- <label for="language1Select" class="form-label">Select Language 1:</label> -->
                        <select id="language1Select" class="form-select" name="language_1" onchange="validateLanguages()" required>
                            <option value="">Select Language 1</option>
                            <option value="Bengali">Bengali</option>
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Nepali">Nepali</option>
                            <option value="Telegu">Telegu</option>


                            <!-- Add language options here -->
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <!-- <label for="language2Select" class="form-label">Select Language 2:</label> -->
                        <select id="language2Select" class="form-select" name="language_2" onchange="validateLanguages()" required>
                            <option value="">Select Language 2</option>
                            <option value="Bengali">Bengali</option>
                            <option value="English">English</option>
                            <option value="Hindi">Hindi</option>
                            <option value="Nepali">Nepali</option>
                            <option value="Telegu">Telegu</option>
                            <!-- Add language options here -->
                        </select>
                    </div>
                </div>
            </div>
            <!-- Select Stream and Subjects Section -->
            <div class="container mt-5">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <!-- <label for="streamSelect" class="form-label">Select a Stream:</label> -->
                        <select id="streamSelect" class="form-select"  name="select_stream"  onchange="updateSubjects()" required>
                            <option value="">Select a Stream</option> 
                            <option value="Arts">Arts</option>
                            <option value="Science">Science</option>
                            <option value="Commerce">Commerce</option>
                            <!-- Add stream options here -->
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <!-- <label for="subjectSelect" class="form-label">Select Subject Combinations:</label> -->
                        <select id="subjectSelect" name="sub_comb" class="form-select" disabled>
                            <option value="" required>Select a Subject</option>
                            <!-- Add subject options here -->
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- This is the End of Card Body -->

                        <div style="margin-left: 30%; padding-bottom: 2%">
                            <a href="marks_details.php" style="color: black; text-decoration: none">
                                <button type="button" class="btn btn-primary" style="
        margin-right: 2%;
        background-color: rgb(255, 255, 255);
        color: black;
      ">
                                    Back
                                </button>
                            </a>
                            <a
                href="final_preview.php"
                style="color: rgb(255, 255, 255); text-decoration: none"
              >
              <button
                  type="submit"
                  name="submit_documents"
                  class="btn btn-primary"
                  style="
                    margin-right: 2%;
                    background-color: rgb(0, 0, 0);
                    color: rgb(255, 255, 255);
                    border: none;
                  "
                >
                  Save & Next
                </button></a
              >
                        </div>
    </form>
                        <!-- Link to file optimization website -->
                        <div class="mt-4">
                            <p>If you're facing any Issue with uploading the documents, then Before uploading, you can
                                optimize your files using <a href="https://www.example.com" target="_blank">this
                                    website</a>.</p>
                        </div>
                        <div class="mt-4" style="display:block; text-align: left;">
                            <h3>T&C for this Page</h3>
                            <ol>
                                <li>By using our platform, you agree to comply with all applicable laws and regulations.
                                </li>
                                <li>You are solely responsible for ensuring the accuracy and legality of any information
                                    or
                                    documents you submit here.</li>
                                <li>The subject combinations offered by our institution are subject to our discretion.
                                    We do
                                    not provide recommendations or endorsements for any specific subject combinations.
                                </li>
                                <li>Your use of this platform must not involve any fraudulent activity or misuse. Any
                                    such
                                    actions will result in immediate termination of your access.</li>
                                <li>We reserve the right to verify the authenticity of any documents uploaded to ensure
                                    compliance with our policies and legal requirements.</li>
                                <li>The information you provide may be used for verification purposes and essential
                                    communications related to our services.</li>
                                <li>We disclaim all liability for any loss or damage that may arise from your use of
                                    this
                                    platform.</li>
                                <li>We may update or modify these terms and conditions at any time without prior notice,
                                    and
                                    such changes will be effective immediately upon posting on the platform.</li>
                            </ol>

                        </div>

<script>
            // Check if submission is already done, then redirect
            if (<?php echo $user['issubmitted']; ?> === 1) {
                window.location.href = "payment_details.php";
            }
        </script>
       <script>
    var subjectData = <?php echo $subject_combinations_json; ?>;

    function updateSubjects() {
        const streamSelect = document.getElementById('streamSelect');
        const subjectSelect = document.getElementById('subjectSelect');
        const stream = streamSelect.value;
        subjectSelect.innerHTML = '';
        subjectSelect.disabled = false;
        let subjects = [];

        // Filter subject combinations based on selected stream
        const filteredSubjects = subjectData.filter(subject => subject.Stream === stream);

        if (stream === "") {
            subjectSelect.disabled = true;
        }

        if (filteredSubjects.length > 0) {
            subjectSelect.add(new Option("--Select a Subject--", ""));
            filteredSubjects.forEach(function (subject) {
                subjectSelect.add(new Option(subject.Subject_Combinations, subject.Subject_Combinations));
            });
        }
    }
</script>

                        <script>
                          

                            function validateLanguages() {
                                const lang1 = document.getElementById('language1Select').value;
                                const lang2 = document.getElementById('language2Select').value;

                                if (lang1 && lang2 && lang1 === lang2) {
                                    alert("Please select different languages for Language 1 and Language 2.");
                                    document.getElementById('language2Select').value = "";
                                }
                            }
                            
                        </script>
</body>

</html>