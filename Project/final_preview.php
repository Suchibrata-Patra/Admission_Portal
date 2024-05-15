<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Details Preview</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
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
                    <input type="text" id="fname" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-6" style="width:100px;height:auto;">
                <div class="form-group col-md-6 d-flex justify-content-center">
    <?php echo '<img src="uploads/1233122_passportsizephoto.jpeg" class="img-fluid" alt="Passport Size Photo" style="width: 100px; height:auto;">' ?>
</div>

               
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">First Name</label>
                    <input type="text" id="fname" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="lname">Last Name</label>
                    <input type="text" id="lname" class="form-control disabled-input" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="fname">Father's Name</label>
                    <input type="text" id="fname" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-6">
                    <label for="lname">Mother's Name</label>
                    <input type="text" id="lname" class="form-control disabled-input" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="student_religion">Email ID</label>
                    <input type="text" id="student_religion" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="student_caste">Mobile No</label>
                    <input type="text" id="student_caste" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="is_student_pwd">WhatsApp No</label>
                    <input type="text" id="is_student_pwd" class="form-control disabled-input" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="dob">Date of Birth</label>
                <input type="date" id="dob" class="form-control disabled-input" disabled>
            </div>
            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" class="form-control disabled-input" disabled>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="city">City</label>
                    <input type="text" id="city" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="pinCode">PIN Code</label>
                    <input type="text" id="pinCode" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="district">District</label>
                    <input type="text" id="district" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="state">State</label>
                    <input type="text" id="state" class="form-control disabled-input" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="city">Aadhar Card No</label>
                    <input type="text" id="city" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="district">Caste</label>
                    <input type="text" id="district" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="state">Religion</label>
                    <input type="text" id="state" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-2">
                    <label for="pinCode">EWS</label>
                    <input type="text" id="pinCode" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-3">
                    <label for="pinCode">PWD</label>
                    <input type="text" id="pinCode" class="form-control disabled-input" disabled>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="previous_school_name">Bank</label>
                    <input type="text" id="previous_school_name" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="current_whatsapp_no">Bank Account No</label>
                    <input type="text" id="current_whatsapp_no" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="current_whatsapp_no">IFSC</label>
                    <input type="text" id="current_whatsapp_no" class="form-control disabled-input" disabled>
                </div>
            </div>
            <!-- <div class="form-group">
                <label for="aadhar_card_no">Aadhar Card Number</label>
                <input type="text" id="aadhar_card_no" class="form-control disabled-input" disabled>
            </div> -->
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="student_religion">First Language</label>
                    <input type="text" id="student_religion" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="student_caste">Second Language</label>
                    <input type="text" id="student_caste" class="form-control disabled-input" disabled>
                </div>
                <div class="form-group col-md-4">
                    <label for="is_student_pwd">Selected Stream</label>
                    <input type="text" id="is_student_pwd" class="form-control disabled-input" disabled>
                </div>
            </div>
            <div class="form-group">
                <label for="address">Subject Combinations</label>
                <input type="text" id="address" class="form-control disabled-input" disabled>
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