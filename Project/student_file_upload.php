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
        background-size: contain; /* Adjusted to 'contain' */
        background-repeat: no-repeat; /* Prevent background repetition */
        background-position: center center;
    }
    .custom-upload-btn {
      background-color:rgb(255, 253, 208);
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
                   <a class="nav-link active" href="personal_details.php"
                     >Personal Details</a
                   >
                 </li>
                 <li class="nav-item">
                   <a class="nav-link disabled" href="#">Address Details</a>
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
<div class="container mt-5">
    <h2 class="mb-4">Upload Documents</h2>
    <form>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th style="width: 35%;">Document</th>                        <th>Preview</th>
                        <th>Choose </th>
                    </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>Passport Size Photo (20 Kb)</td>
                    <td class="document-preview" id="passportPreview">No image chosen</td>
                    <td>
                        <label class="custom-upload-btn">
                            Upload
                            <input type="file" class="form-control-file" id="passportPhoto" accept="image/*" onchange="previewFile('passportPhoto', 'passportPreview')">
                        </label>
                        <br> 
                        <div class="upload_buton_size_limit_text">
                          (Max 20 Kb) 
                        </div>
                    </td>
                  </tr>
                  

                  <tr>
                    <td>Aadhar Card(20 Kb)</td>
                    <td class="document-preview" id="aadharPreview">No image chosen</td>
                    <td>
                        <label class="custom-upload-btn">
                            Upload
                            <input type="file" class="form-control-file" id="aadharCard" accept="image/*" onchange="previewFile('aadharCard', 'aadharPreview')">
                        </label>
                        <br> 
                        <div class="upload_buton_size_limit_text">
                            (Max 20 Kb) 
                        </div>
                    </td>
                </tr>
                


                <tr>
                  <td>Madhymik Admit (20 Kb)</td>
                  <td class="document-preview" id="MPAdmittPreview">No image chosen</td>
                  <td>
                      <label class="custom-upload-btn">
                          Upload
                          <input type="file" class="form-control-file" id="mpAdmit" accept="image/*" onchange="previewFile('mpAdmit', 'MPAdmittPreview')">
                      </label>
                      <br> 
                      <div class="upload_buton_size_limit_text">
                        (Max 20 Kb) 
                      </div>
                  </td>
              </tr>
              
              <tr>
                  <td>Madhyamik Marksheet (20 Kb)</td>
                  <td class="document-preview" id="MPMarksheetPreview">No image chosen</td>
                  <td>
                      <label class="custom-upload-btn">
                          Upload
                          <input type="file" class="form-control-file" id="MP_Marksheet" accept="image/*" onchange="previewFile('MP_Marksheet', 'MPMarksheetPreview')">
                      </label>
                      <br> 
                      <div class="upload_buton_size_limit_text">
                        (Max 20 Kb) 
                      </div>
                  </td>
              </tr>
              
              <tr>
                  <td>Madhyamik Certificate (20 Kb)</td>
                  <td class="document-preview" id="MPCertificatePreview">No image chosen</td>
                  <td>
                      <label class="custom-upload-btn">
                          Upload 
                          <input type="file" class="form-control-file" id="MP_Certificate" accept="image/*" onchange="previewFile('MP_Certificate', 'MPCertificatePreview')">
                      </label> 
                      <br> 
                      <div class="upload_buton_size_limit_text">
                        (Max 20 Kb) 
                      </div>
                  </td>
              </tr>
              
                  <!-- Add similar rows for other document types -->
                </tbody>
            </table>
        </div>
       
    </form>
</div>
<div style="margin-left: 30%; padding-bottom: 2%">
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
    href="address_details.php"
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
 <!-- Link to file optimization website -->
 <div class="mt-4">
  <p>If you're facing any Issue with uploading the documents, then Before uploading, you can optimize your files using <a href="https://www.example.com" target="_blank">this website</a>.</p>
</div>
<div class="mt-4" style="display:block; text-align: left;">
  <h3>T&C for this Page</h3>
  <ul>
    <li>By uploading documents, you agree to comply with all applicable laws and regulations.</li>
    <li>The documents you upload must be genuine and accurate.</li>
    <li>You are solely responsible for the content of the documents you upload.</li>
    <li>Any fraudulent activity or misuse of this platform will result in immediate termination of your account.</li>
    <li>We reserve the right to verify the authenticity of the documents uploaded.</li>
    <li>We may use the information provided for verification and communication purposes.</li>
    <li>We are not responsible for any loss or damage resulting from the use of this platform.</li>
    <li>We reserve the right to modify these terms and conditions at any time without prior notice.</li>
  </ul>
</div>


<script>
    function previewFile(inputId, previewId) {
        const preview = document.getElementById(previewId);
        const file = document.getElementById(inputId).files[0];
        const reader = new FileReader();

        reader.addEventListener("load", function () {
            // Convert image file to base64 string
            preview.style.backgroundImage = 'url(' + reader.result + ')';
            preview.textContent = '';
        }, false);

        if (file) {
            reader.readAsDataURL(file);
        } else {
            preview.style.backgroundImage = 'none';
            preview.textContent = 'No image chosen';
        }
    }
</script>
</body>
</html>
