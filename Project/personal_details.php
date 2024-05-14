<?php 
require 'session.php';

// echo $user['fname'];

    if ($user['numberVerify'] == 0) {
      header('location: verify.php');
    } 
 $query = "SELECT * FROM student_details WHERE email='$email'";
 $results = mysqli_query($db, $query);
 $user = mysqli_fetch_assoc($results);
 echo '  Session Registration ID - '.$user['reg_no'];
 echo $user['lname']; 

 ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Welcome</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
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
  </style>
</head>

<body>
  <div class="header">
    <h2 style="margin: 0">
      Welcome
      <?php echo $user['fname']; ?>
    </h2>
    <a href="welcome.php?logout='1'" class="logout">Logout</a>
  </div>
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <div class="card text-center">
          <div class="card-header">
            <ul class="nav nav-pills card-header-pills">
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Student Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="marks_details.php">Marks Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link active" href="personal_details.php">Personal Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Address Details</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">File Upload</a>
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

          <!--- This is the beginning of the Card Body portion-->

          <div class="card-body">
            <label for="inputCity" style="display: flex; color:rgb(189, 94, 94);">* Please Provide Personal Details
              Accurately</label>
              <?php if(isset($_GET['error'])) { ?>
          <div class="alert alert-danger">
            <?php echo $error = $_GET['error']; ?>
          </div>
          <?php } ?>

            <form method="post" action="personal_details_controller.php">
              <!-- Start of the Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex; color:rgb(189, 94, 94);"
                      >* Please Provide Personal Details Accurately</label
                    > -->
                  <input type="text" class="form-control" id="inputSubject" value="Previous School Name" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex"
                      >Enter Details</label
                    > -->
                  <input type="text" class="form-control" id="inputCity" name="previous_school_name"
                    placeholder="Schhol Name" />
                </div>
                <div class="form-group col-md-2"></div>
              </div>
              <!-- End of the Marks Entering Page -->

              <!-- Start of the 2nd Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="Father's Name" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <input type="text" class="form-control" id="inputCity" name="fathers_name"
                    placeholder="Enter Father's Name" />
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 2nd Marks Entering Page -->

              <!-- Start of the 3rd Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="Mother's Name" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <input type="text" class="form-control" id="inputCity" name="mothers_name"
                    placeholder="Enter Mother's Name " />
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 3rd Marks Entering Page -->

              <!-- Start of the 4th Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="Whatsapp No" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <input type="text" class="form-control" id="inputSubject" name="current_whatsapp_no"
                    placeholder="Provide Current Whatsapp No" />
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 4th Marks Entering Page -->

              <!-- Start of the 5th Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="Aadhar Card No" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <input type="text" class="form-control" id="inputCity" name="aadhar_card_no"
                    placeholder=" XXXX - XXXX - XXXX" />
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 5th Marks Entering Page -->

              <!-- Start of the 6th Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="Religion" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <select id="inputState" name="student_religion" class="form-control">
                    <!-- <option  selected value="Choose">Choose...</option> -->
                    <option selected value="Hindu">Hindu</option>
                    <option value="Muslim">Muslim</option>
                    <option value="Christ">Christ</option>
                    <option value="Jain">Jain</option>
                    <option value="Buddhist">Buddhist</option>
                    <option value="Buddhist">Other</option>
                    <option value="Buddhist">Don't Want to specify</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 6th Marks Entering Page -->

              <!-- Start of the 6th Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject"  value="Caste"
                    disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <select id="inputState" class="form-control" name="student_caste">
                    <option value="General">General</option>
                    <option value="SC/ST">SC/ST</option>
                    <option value="OBC">OBC</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 6th Marks Entering Page -->

              <!-- Start of the 6th Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="PWD (Person With Diabilities)"
                    disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <select id="inputState" class="form-control" name="is_student_PWD">
                    <option value="No" Selected>No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 6th Marks Entering Page -->
              <!-- Start of the 6th Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputCity" value="EWS (Economically Weaker Section)"
                    disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <select id="inputState" class="form-control" name="is_student_EWS">
                    <option value="No" Selected>No</option>
                    <option value="Yes">Yes</option>
                  </select>
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 6th Marks Entering Page -->
              <hr style="height: 4px;background-color: rgb(193, 147, 78);">

              <!-- This is the Address Collection Page -->
              <!-- Start of the Marks Entering Details -->
              <label for="inputState" style="display: flex; color: rgb(245, 117, 162);">Address Details</label>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex"
        >Your Address Details</label
      > -->
                  <input type="text" class="form-control" id="inputSubject" value="Village/Town" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex"
        >Enter Details</label
      > -->
                  <input type="text" class="form-control" id="inputCity" name="student_village_town"
                    placeholder="Provide complete Address Details." />
                </div>
                <div class="form-group col-md-2"></div>
              </div>
              <!-- End of the Marks Entering Page -->


              <!-- Start of the 6th Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="City" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <input type="text" class="form-control" id="inputCity" name="student_city" placeholder="Enter Your City " />

                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 6th Marks Entering Page -->

              <!-- Start of the 2nd Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="PIN" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <input type="text" class="form-control" id="inputCity" name="student_pin_code"
                    placeholder="Enter PIN" />
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 2nd Marks Entering Page -->

              <!-- Start of the 3rd Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="Police Station" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <input type="text" class="form-control" id="inputCity" name="student_police_station"
                    placeholder="Enter Police Station" />
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 3rd Marks Entering Page -->

              <!-- Start of the 4th Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="District" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <input type="text" class="form-control" id="inputCity" name="student_district"
                    value="Enter District" />
                </div>
                <div class="form-group col-md-2">
                  <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                </div>
              </div>
              <!-- End of the 4th Marks Entering Page -->






              <!-- Start of the 4th Marks Entering Details -->
              <div class="form-row">
                <div class="form-group col-md-6">
                  <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                  <input type="text" class="form-control" id="inputSubject" value="State" disabled />
                </div>
                <div class="form-group col-md-4">
                  <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                  <select id="inputState" class="form-control" name="student_state">
                    <option selected>Choose...</option>
                    <option value="Andhra Pradesh">Andhra Pradesh</option>
                    <option value="Arunachal Pradesh">
                      Arunachal Pradesh
                    </option>
                    <option value="Assam">Assam</option>
                    <option value="Bihar">Bihar</option>
                    <option value="Chhattisgarh">Chhattisgarh</option>
                    <option value="Goa">Goa</option>
                    <option value="Gujarat">Gujarat</option>
                    <option value="Haryana">Haryana</option>
                    <option value="Himachal Pradesh">Himachal Pradesh</option>
                    <option value="Jharkhand">Jharkhand</option>
                    <option value="Karnataka">Karnataka</option>
                    <option value="Kerala">Kerala</option>
                    <option value="Madhya Pradesh">Madhya Pradesh</option>
                    <option value="Maharashtra">Maharashtra</option>
                    <option value="Manipur">Manipur</option>
                    <option value="Meghalaya">Meghalaya</option>
                    <option value="Mizoram">Mizoram</option>
                    <option value="Nagaland">Nagaland</option>
                    <option value="Odisha">Odisha</option>
                    <option value="Punjab">Punjab</option>
                    <option value="Rajasthan">Rajasthan</option>
                    <option value="Sikkim">Sikkim</option>
                    <option value="Tamil Nadu">Tamil Nadu</option>
                    <option value="Telangana">Telangana</option>
                    <option value="Tripura">Tripura</option>
                    <option value="Uttarakhand">Uttarakhand</option>
                    <option value="Uttar Pradesh">Uttar Pradesh</option>
                    <option value="West Bengal">West Bengal</option>
                  </select>
                </div>
              </div>
              <a href="personal_details.php"
                style="color: black; text-decoration: none"
              >
              <button
                  type="button"
                  class="btn btn-primary"
                  style="
                    margin-right: 2%;
                    background-color: rgb(255, 255, 255);
                    color: black;
                  "
                >
                  Back
                </button>
              </a>
              <a
                href="personal_details.php"
                style="color: black; text-decoration: none"
              >
              <button
                  type="submit"
                  name="submit_personal_details"
                  class="btn btn-primary"
                  style="
                    margin-right: 2%;
                    background-color: rgb(255, 255, 255);
                    color: black;
                  "
                >
                  Save & Next
                </button></a
              >
            </form>
          </div>

          <!-- This is the End of Card Body Portion-->


        </div>
      </div>
    </div>
  </div>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>

</html>