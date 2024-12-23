<?php include('_DIR_/../../exception_handler.php') ?>
<?php 
require 'session.php';
require 'super_admin.php';
echo $user['fname'];
$table_name = $udise_code . '_Student_Details';
echo 'This is for School with UDISE CODE - ' . $udise_code . '<br>';
echo 'Table name: ' . $table_name . '<br>';

if ($user['numberVerify'] == 0) {
      header('location: verify.php');
    } 

if ($user['issubmitted'] == 1) {
  header('location: payment_details.php');
  exit(); // Add exit to stop further execution
} 
 $query = "SELECT * FROM $table_name WHERE email='$email'";
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
  <title>Personal Details</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous" />
    <link rel="stylesheet" href="../Assets/css/personal_details.css">
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
        <?php include('../card_header.php') ?>


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
                    <input type="text" class="form-control" id="inputCity" name="previous_school_name" oninput="restrictSpecialChars(this)" <?php if ($user['previous_school_name'] == null): ?> placeholder="Enter your Previous School Name" <?php else: ?> value="<?php echo $user['previous_school_name']; ?>" <?php endif; ?> required>

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
                  <input type="text" class="form-control" id="inputCity" name="fathers_name" oninput="restrictSpecialChars(this)"
                  <?php if ($user['fathers_name'] == null): ?>
                    placeholder="Enter your Father's Name"
                    <?php else: ?>
                    value="<?php echo $user['fathers_name']; ?>"
                    <?php endif; ?>   
                    / required>
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
                  <input type="text" class="form-control" id="inputCity" name="mothers_name" oninput="restrictSpecialChars(this)"
                  <?php if ($user['mothers_name'] == null): ?>
                    placeholder="Enter your Mother's Name"
                    <?php else: ?>
                    value="<?php echo $user['mothers_name']; ?>"
                    <?php endif; ?>   
                    / required>
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
                  <input type="text" class="form-control" id="inputSubject" name="current_whatsapp_no" oninput="restrictSpecialChars(this)"
                  <?php if ($user['current_whatsapp_no'] == null): ?>
                    placeholder="Current Whatsapp No."
                    <?php else: ?>
                    value="<?php echo $user['current_whatsapp_no']; ?>"
                    <?php endif; ?>   
                    / required>                </div>
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
                  <input type="text" class="form-control" id="inputCity" name="aadhar_card_no" oninput="restrictSpecialChars(this)"
                  <?php if ($user['aadhar_card_no'] == null): ?>
                    placeholder="XXXX - XXXX - XXXX"
                    <?php else: ?>
                    value="<?php echo $user['aadhar_card_no']; ?>"
                    <?php endif; ?>   
                    / required>    
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
                  <select id="inputState" name="student_religion" class="form-control" >
    <!-- <option  selected value="Choose">Choose...</option> -->
    <option <?php if ($user['student_religion'] == null || $user['student_religion'] == 'Hindu'): ?> selected <?php endif; ?>>Hindu</option>
    <option <?php if ($user['student_religion'] == 'Muslim'): ?> selected <?php endif; ?>>Muslim</option>
    <option <?php if ($user['student_religion'] == 'Christ'): ?> selected <?php endif; ?>>Christ</option>
    <option <?php if ($user['student_religion'] == 'Jain'): ?> selected <?php endif; ?>>Jain</option>
    <option <?php if ($user['student_religion'] == 'Buddhist'): ?> selected <?php endif; ?>>Buddhist</option>
    <option <?php if ($user['student_religion'] == 'Other'): ?> selected <?php endif; ?>>Other</option>
    <option <?php if ($user['student_religion'] == "Don't Want to specify"): ?> selected <?php endif; ?>>Don't Want to specify</option>
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
    <option <?php if ($user['student_caste'] == 'General'): ?> selected <?php endif; ?> value="General">General</option>
    <option <?php if ($user['student_caste'] == 'SC/ST'): ?> selected <?php endif; ?> value="SC/ST">SC/ST</option>
    <option <?php if ($user['student_caste'] == 'OBC'): ?> selected <?php endif; ?> value="OBC">OBC</option>
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
    <option <?php if ($user['is_student_PWD'] == 'No'): ?> selected <?php endif; ?> value="No">No</option>
    <option <?php if ($user['is_student_PWD'] == 'Yes'): ?> selected <?php endif; ?> value="Yes">Yes</option>
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
    <option <?php if ($user['is_student_EWS'] == 'No'): ?> selected <?php endif; ?> value="No">No</option>
    <option <?php if ($user['is_student_EWS'] == 'Yes'): ?> selected <?php endif; ?> value="Yes">Yes</option>
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
                  <input type="text" class="form-control" id="inputCity" name="student_village_town" oninput="restrictSpecialChars(this)"
                  <?php if ($user['student_village_town'] == null): ?>
                    placeholder="Enter your Village/Town"
                    <?php else: ?>
                    value="<?php echo $user['student_village_town']; ?>"
                    <?php endif; ?>  
                  / required>
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
                  <input type="text" class="form-control" id="inputCity" name="student_city" oninput="restrictSpecialChars(this)" <?php if ($user['student_city'] == null): ?>
                    placeholder="Enter your City"
                    <?php else: ?>
                    value="<?php echo $user['student_city']; ?>"
                    <?php endif; ?>  
                  / required>

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
                  <input type="text" class="form-control" id="inputCity" name="student_pin_code" oninput="restrictSpecialChars(this)"
                  <?php if ($user['student_pin_code'] == null): ?>
                    placeholder="Enter your PIN"
                    <?php else: ?>
                    value="<?php echo $user['student_pin_code']; ?>"
                    <?php endif; ?>  
                  / required>
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
                  <input type="text" class="form-control" id="inputCity" name="student_police_station" oninput="restrictSpecialChars(this)"
                  <?php if ($user['student_police_station'] == null): ?>
                    placeholder="Enter your Police Station"
                    <?php else: ?>
                    value="<?php echo $user['student_police_station']; ?>"
                    <?php endif; ?>  
                  / required>                </div>
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
                  <input type="text" class="form-control" id="inputCity" name="student_district" oninput="restrictSpecialChars(this)"
                  <?php if ($user['student_district'] == null): ?>
                    placeholder="Enter Your District"
                    <?php else: ?>
                    value="<?php echo $user['student_district']; ?>"
                    <?php endif; ?>  
                  / required>   
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
    <option <?php if ($user['student_state'] == null): ?> selected <?php endif; ?>>Choose...</option>
    <option <?php if ($user['student_state'] == 'Andhra Pradesh'): ?> selected <?php endif; ?> value="Andhra Pradesh">Andhra Pradesh</option>
    <option <?php if ($user['student_state'] == 'Arunachal Pradesh'): ?> selected <?php endif; ?> value="Arunachal Pradesh">Arunachal Pradesh</option>
    <option <?php if ($user['student_state'] == 'Assam'): ?> selected <?php endif; ?> value="Assam">Assam</option>
    <option <?php if ($user['student_state'] == 'Bihar'): ?> selected <?php endif; ?> value="Bihar">Bihar</option>
    <option <?php if ($user['student_state'] == 'Chhattisgarh'): ?> selected <?php endif; ?> value="Chhattisgarh">Chhattisgarh</option>
    <option <?php if ($user['student_state'] == 'Goa'): ?> selected <?php endif; ?> value="Goa">Goa</option>
    <option <?php if ($user['student_state'] == 'Gujarat'): ?> selected <?php endif; ?> value="Gujarat">Gujarat</option>
    <option <?php if ($user['student_state'] == 'Haryana'): ?> selected <?php endif; ?> value="Haryana">Haryana</option>
    <option <?php if ($user['student_state'] == 'Himachal Pradesh'): ?> selected <?php endif; ?> value="Himachal Pradesh">Himachal Pradesh</option>
    <option <?php if ($user['student_state'] == 'Jharkhand'): ?> selected <?php endif; ?> value="Jharkhand">Jharkhand</option>
    <option <?php if ($user['student_state'] == 'Karnataka'): ?> selected <?php endif; ?> value="Karnataka">Karnataka</option>
    <option <?php if ($user['student_state'] == 'Kerala'): ?> selected <?php endif; ?> value="Kerala">Kerala</option>
    <option <?php if ($user['student_state'] == 'Madhya Pradesh'): ?> selected <?php endif; ?> value="Madhya Pradesh">Madhya Pradesh</option>
    <option <?php if ($user['student_state'] == 'Maharashtra'): ?> selected <?php endif; ?> value="Maharashtra">Maharashtra</option>
    <option <?php if ($user['student_state'] == 'Manipur'): ?> selected <?php endif; ?> value="Manipur">Manipur</option>
    <option <?php if ($user['student_state'] == 'Meghalaya'): ?> selected <?php endif; ?> value="Meghalaya">Meghalaya</option>
    <option <?php if ($user['student_state'] == 'Mizoram'): ?> selected <?php endif; ?> value="Mizoram">Mizoram</option>
    <option <?php if ($user['student_state'] == 'Nagaland'): ?> selected <?php endif; ?> value="Nagaland">Nagaland</option>
    <option <?php if ($user['student_state'] == 'Odisha'): ?> selected <?php endif; ?> value="Odisha">Odisha</option>
    <option <?php if ($user['student_state'] == 'Punjab'): ?> selected <?php endif; ?> value="Punjab">Punjab</option>
    <option <?php if ($user['student_state'] == 'Rajasthan'): ?> selected <?php endif; ?> value="Rajasthan">Rajasthan</option>
    <option <?php if ($user['student_state'] == 'Sikkim'): ?> selected <?php endif; ?> value="Sikkim">Sikkim</option>
    <option <?php if ($user['student_state'] == 'Tamil Nadu'): ?> selected <?php endif; ?> value="Tamil Nadu">Tamil Nadu</option>
    <option <?php if ($user['student_state'] == 'Telangana'): ?> selected <?php endif; ?> value="Telangana">Telangana</option>
    <option <?php if ($user['student_state'] == 'Tripura'): ?> selected <?php endif; ?> value="Tripura">Tripura</option>
    <option <?php if ($user['student_state'] == 'Uttarakhand'): ?> selected <?php endif; ?> value="Uttarakhand">Uttarakhand</option>
    <option <?php if ($user['student_state'] == 'Uttar Pradesh'): ?> selected <?php endif; ?> value="Uttar Pradesh">Uttar Pradesh</option>
    <option <?php if ($user['student_state'] == 'West Bengal'): ?> selected <?php endif; ?> value="West Bengal">West Bengal</option>
</select>

                </div>
              </div>
      <!-- Start of Bank Details -->
      <hr style="height: 4px;background-color: rgb(193, 147, 78);">

      <!-- This is the Address Collection Page -->
      <!-- Start of the Marks Entering Details -->
      <label for="inputState" style="display: flex; color: rgb(245, 117, 162);">Bank Account Details</label>
<div class="form-row">
  <div class="form-group col-md-4">
    <label for="bank_name" style="margin-bottom: 0%;display: flex;">Bank Name</label>
    <input type="text" class="form-control" id="bank_name" name="bank_name" oninput="restrictSpecialChars(this)" <?php if ($user['bank_name'] == null): ?> placeholder="Enter Bank Name" <?php else: ?> value="<?php echo $user['bank_name']; ?>" <?php endif; ?> required>
  </div>
  <div class="form-group col-md-4">
    <label for="bank_account_no" style="margin-bottom: 0%;display: flex;">Bank Account No</label>
    <input type="text" class="form-control" id="bank_account_no" name="bank_account_no" oninput="restrictSpecialChars(this)" <?php if ($user['bank_account_no'] == null): ?> placeholder="Enter Bank Account No" <?php else: ?> value="<?php echo $user['bank_account_no']; ?>" <?php endif; ?> required>
  </div>
  <div class="form-group col-md-4">
    <label for="bank_ifsc_code" style="margin-bottom: 0%;display: flex;">Bank IFSC Code</label>
    <input type="text" class="form-control" id="bank_ifsc_code" name="bank_ifsc_code" oninput="restrictSpecialChars(this); limitLength(this, 11);" <?php if ($user['bank_ifsc_code'] == null): ?> placeholder="Enter Bank IFSC Code [11 Digits Long]" <?php else: ?> value="<?php echo $user['bank_ifsc_code']; ?>" <?php endif; ?> required>
  </div>
  <p style="margin-bottom: 0; color: rgb(146, 96, 36);"><strong style="margin: 0 5px; padding: 3px; background-color: #FFFF00; border-radius: 3px;">Note:</strong> If you don't have <u><i>Bank Account</i></u>, you may provide that of <u><i>your Guardian.</i></u></p>
</div>
<!-- End of Bank Details -->



              <a href="marks_details.php"
                style="color: black; text-decoration: none"
              >
              <button
                  type="button"
                  class="btn btn-primary"
                  style="
                    margin-right: 2%;
                    background-color: #000000;
                    color: rgb(255, 255, 255);
                    border: none;
                  "
                >
                  Back
                </button>
              </a>
              <a
                href="student_file_upload.php"
                style="color: rgb(255, 255, 255); text-decoration: none"
              >
              <button
                  type="submit"
                  name="submit_personal_details"
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
            </form>
          </div>

          <!-- This is the End of Card Body Portion-->


        </div>
      </div>
    </div>
  </div>
  </div>
  <script>
  // Function to restrict special characters
  function restrictSpecialChars(inputField) {
    // Regular expression to match special characters
    var regex = /[!@#$%^&*(),.?":{}|<>]/g;

    // Check if the input contains any special characters
    if (regex.test(inputField.value)) {
      // If special characters are found, replace them with an empty string
      inputField.value = inputField.value.replace(regex, '');
    }
  }
</script>
<script>
  function limitLength(element, maxLength) {
    if (element.value.length > maxLength) {
      element.value = element.value.slice(0, maxLength);
    }
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js"></script>
</body>

</html>