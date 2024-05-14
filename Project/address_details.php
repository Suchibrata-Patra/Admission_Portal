<?php 
require 'session.php';

// echo $user['fname'];

    if ($user['numberVerify'] == 0) {
      header('location: verify.php');
    } 
 $query = "SELECT * FROM student_details WHERE email='$email'";
 $results = mysqli_query($db, $query);
 $user = mysqli_fetch_assoc($results);
 //  echo $user['lname']; 
 ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Welcome</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
      integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
      crossorigin="anonymous"
    />
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
                  <a class="nav-link disabled" href="marks_details.php"
                    >Marks Details</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="personal_details.php"
                    >Personal Details</a
                  >
                </li>
                <li class="nav-item">
                  <a class="nav-link active" href="#">Address Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">File Upload</a>
                  </li>
                <li class="nav-item">
                  <a class="nav-link disabled" href="#">Final Submission</a>
                </li>
              </ul>
            </div>

            <!--- This is the beginning of the Card Body portion-->

            <div class="card-body">
              <form method="post" action="marks_details_controller.php">
                <!-- Start of the Marks Entering Details -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <!-- <label for="inputCity" style="display: flex"
                      >Your Address Details</label
                    > -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="Village/Town"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex"
                      >Enter Details</label
                    > -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputCity"
                      placeholder="Provide complete Address Details."
                    />
                  </div>
                  <div class="form-group col-md-2"></div>
                </div>
                <!-- End of the Marks Entering Page -->


                <!-- Start of the 6th Marks Entering Details -->
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <!-- <label for="inputCity" style="display: flex">Subjects</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="City"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputCity"
                      placeholder="Enter Your Marks "
                    />
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
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="PIN"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputCity"
                      placeholder="Enter PIN"
                    />
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
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="Police Station"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputCity"
                      placeholder="Enter Police Station"
                    />
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
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="District"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <input
                      type="text"
                      class="form-control"
                      id="inputCity"
                      value = "Enter District"
                    />
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
                    <input
                      type="text"
                      class="form-control"
                      id="inputSubject"
                      value="State"
                      disabled
                    />
                  </div>
                  <div class="form-group col-md-4">
                    <!-- <label for="inputState" style="display: flex">Obtained Marks</label> -->
                    <select id="inputState" class="form-control">
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
                  <div class="form-group col-md-2">
                    <!-- <label for="inputZip" style="display: flex" >Full Marks</label> -->
                  </div>
                </div>
                <!-- End of the 4th Marks Entering Page -->
              
                <button type="submit" name="reg_user" class="btn btn-primary">
                  Save
                </button>
              </form>
            </div>

            <!-- This is the End of Card Body Portion-->
            <div style="margin-left: 60%; padding-bottom: 2%">
              <a
                href="marks_details.php"
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
                href="student_file_upload.php"
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
                  Save & Next
                </button></a
              >
            </div>
          </div>
        </div>
      </div>
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
  </body>
</html>
