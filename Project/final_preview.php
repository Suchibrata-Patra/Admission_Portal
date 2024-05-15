<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Student Details Preview</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
   <style>
        .disabled-input {
            background-color: #e9ecef;
            opacity: 1;
        }

        .preview_item_heading {
            background-color: rgb(170, 243, 170);
            padding-left: 4px;
            padding-right: 4px;
            border-top-left-radius: 4px;
            border-top-right-radius: 4px;
            margin-bottom: -7px;
            margin-left: 5px;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h2>Student Profile</h2>
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">Registration No</label>
                    <input type="text" id="fname" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-6" style="width: 100px; height: auto">
                    <div class="form-group col-md-6 d-flex justify-content-center" style="margin-left: 25%">
                        <?php echo '<img src="uploads/1233122_passportsizephoto.jpg" class="img-fluid" alt="Passport Size Photo" style="width: 120px; height:auto;">'
              ?>
                    </div>
                </div>
            </div>
            <div class="form-row" style="margin-top: -3%">
                <div class="form-group col-md-4">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-4">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-4">
                    <label for="lname">DOB</label>
                    <input type="text" id="lname" class="form-control disabled-input" disabled />
                </div>
            </div>
            <div class="personal_details" style="background-color: #f9f5f5; border:2px dashed rgb(254, 211, 211); border-radius: 10px; padding:10px;">
                <div style="margin-bottom: -2%;">Personal Details</div>
                <button style="margin-left: 95%;background-color:#f9f5f5;border: none;" > 
                    <a href="personal_details.php" style="text-decoration: none;">
                    <span class="material-symbols-outlined" style="color: black;">
                    edit_document</span>Edit</a></button>
                <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">Father's Name</label>
                    <input type="text" id="fname" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-6">
                    <label for="lname">Mother's Name</label>
                    <input type="text" id="lname" class="form-control disabled-input" disabled />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="student_religion">Email ID</label>
                    <input type="text" id="student_religion" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-4">
                    <label for="student_caste">Mobile No</label>
                    <input type="text" id="student_caste" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-4">
                    <label for="is_student_pwd">WhatsApp No</label>
                    <input type="text" id="is_student_pwd" class="form-control disabled-input" disabled />
                </div>
            </div>
            <!-- <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" class="form-control disabled-input" disabled>
            </div> -->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">Address</label>
                    <input type="text" id="fname" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-6">
                    <label for="lname">Previous School Name</label>
                    <input type="text" id="lname" class="form-control disabled-input" disabled />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="city">City</label>
                    <input type="text" id="city" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-3">
                    <label for="pinCode">PIN Code</label>
                    <input type="text" id="pinCode" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-3">
                    <label for="district">District</label>
                    <input type="text" id="district" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-3">
                    <label for="state">State</label>
                    <input type="text" id="state" class="form-control disabled-input" disabled />
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="city">Aadhar Card No</label>
                    <input type="text" id="city" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-2">
                    <label for="district">Caste</label>
                    <input type="text" id="district" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-2">
                    <label for="state">Religion</label>
                    <input type="text" id="state" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-2">
                    <label for="pinCode">EWS</label>
                    <input type="text" id="pinCode" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-3">
                    <label for="pinCode">PWD</label>
                    <input type="text" id="pinCode" class="form-control disabled-input" disabled />
                </div>
            </div>
            </div>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="previous_school_name">Bank</label>
                    <input type="text" id="previous_school_name" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-4">
                    <label for="current_whatsapp_no">Bank Account No</label>
                    <input type="text" id="current_whatsapp_no" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-4">
                    <label for="current_whatsapp_no">IFSC</label>
                    <input type="text" id="current_whatsapp_no" class="form-control disabled-input" disabled />
                </div>
            </div>
            <!-- <div class="form-group">
                <label for="aadhar_card_no">Aadhar Card Number</label>
                <input type="text" id="aadhar_card_no" class="form-control disabled-input" disabled>
            </div> -->
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="student_religion">First Language</label>
                    <input type="text" id="student_religion" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-4">
                    <label for="student_caste">Second Language</label>
                    <input type="text" id="student_caste" class="form-control disabled-input" disabled />
                </div>
                <div class="form-group col-md-4">
                    <label for="is_student_pwd">Selected Stream</label>
                    <input type="text" id="is_student_pwd" class="form-control disabled-input" disabled />
                </div>
            </div>
            <div class="form-group">
                <label for="address">Subject Combinations</label>
                <input type="text" id="address" class="form-control disabled-input" disabled />
            </div>
            <div class="container">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th scope="col">Full Marks</th>
                            <th scope="col">Obtained Marks</th>
                            <th scope="col">% of Marks</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>Bengali</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <td>English</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <td>Mathematics</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <td>Physical Sc.</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <td>Life Sc.</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <td>History</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <td>Geography</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Add more fields if necessary -->
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>