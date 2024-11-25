
<?php include('../favicon.php') ?>
<?php
require 'super_admin.php';
include_once ('session.php');
$table_name = $udise_code . '_Student_Details';
$school_table = $udise_code . '_HOI_Login_Credentials';


// Fetch user details from the database
$query = "SELECT * FROM $table_name WHERE email='$email'";
$results = mysqli_query($db, $query);
$user = mysqli_fetch_assoc($results);

 
$registration_no = $user['reg_no'];
// Calculate total and obtained marks
$total_marks = ($user['bengali_full_marks'] + $user['english_full_marks'] + $user['mathematics_full_marks'] + $user['physical_science_full_marks'] + $user['life_science_full_marks'] + $user['history_full_marks'] + $user['geography_full_marks']);
// $obtained_marks = ($user['bengali_marks'] + $user['english_marks'] + $user['mathematics_marks'] + $user['physical_science_marks'] + $user['life_science_marks'] + $user['history_marks'] + $user['geography_marks']);

$school_query = "SELECT `HOI_Mobile_No`,`HOI_Mobile_No`, `HOI_Whatsapp_No`, `Institution_Name`, `HOI_Name`, `Institution_Address`, `Formfillup_Start_Date`, `Formfillup_Last_Date`, `First_merit_list_date`, `Admission_Beginning_for_First_List`, `Admission_Closes_For_First_List`, `Second_List` from $school_table;";
$info = mysqli_query($db, $school_query);
$school_info = mysqli_fetch_assoc($info);

function formatDate($date) {
    $datetime = new DateTime($date);
    return $datetime->format('l, jS F Y'); // 'l' gives the full textual representation of the day of the week
}
?>
<?php
$timestamp = $user['Registration_Time_Stamp']; // '2024-06-09 12:34:56'
$encryptedTimestamp = bin2hex($timestamp);
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 95%;
            margin: 10px auto;
            background-color: #fff;
            border: 1px solid #ccc;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
            position: relative;
        }
        .header img {
            height: 120px;
            width: 120px;
            position: absolute;
            top: 4.6%;
            left: 0;
        }

        .header h1 {
            margin: 3px 0 10px 20px;
            /* Added margin-left to create space for the logo */
            font-size: 24px;
            font-weight: normal;
        }

        .header p {
            margin: 0px;
            /* Added margin-left to create space for the logo */
            font-size: 14px;
        }

        .photo {
            position: absolute;
            top: 4%;
            right: 15%;
            /* Changed from percentage to fixed pixel value */
            width: 30px;
            height:40px;
        }

        .section {
            margin-bottom: 20px;
            clear: both;
        }

        .section h2 {
            font-size: 18px;
            margin: 0 0 10px 0;
            border-bottom: 1px solid #ccc;
            padding-bottom: 5px;
        }

        .info-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .info-table th,
        .info-table td {
            padding: 8px 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        .info-table th {
            width: 20%;
            background-color: #f2f2f2;
            font-weight: 400;
        }

        .info-table td {
            width: 30%;
        }

        .details-table {
            width: 100%;
            border-collapse: collapse;
        }

        .details-table th,
        .details-table td {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: center;
        }

        .details-table th {
            background-color: #f2f2f2;
            font-weight: 400;
        }
        
    </style>
        <link rel="preload" href="http://trip-admin.000webhostapp.com/Asset/image.png" as="image">
        <link rel="preload" href="https://i.imgur.com/GlWjPHh.png" as="image">
    
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="http://trip-admin.000webhostapp.com/Asset/image.png" alt="Logo"
                style="width:90px;height: auto;padding-left: 2%;">
            <h1 style="margin-left: 5%; margin-right: 5%;"><?php echo $school_info['Institution_Name']?>
            </h1>
            <p>UDISE Code -
                <?php echo $udise_code ?>
            </p>
            <p>
                <?php echo $school_info['Institution_Address'] ?>
            </p>
            <p>Contact Mobile -
                <?php echo $school_info['HOI_Mobile_No'] ?>
            </p>
            <p>Whatsapp -
                <?php echo $school_info['HOI_Whatsapp_No'] ?>
            </p>
            <!--This is the Profile Image-->
            <div class="photo">
                <img src="http://trip-admin.000webhostapp.com/Asset/image.png"
                    style="border: 0.7px solid rgb(211, 211, 211);">
            </div>
        </div>
        <div class="section">
            <h2>Application Receipt</h2>
            <table class="info-table">
                <tr>
                    <th>Registration No</th>
                    <td colspan="3">
                        <?php echo $user['reg_no']?>
                    </td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>
                        <?php echo $user['fname']?>
                        <?php echo $user['lname']?>
                    </td>
                    <th>Year</th>
                    <td>2023/24</td>
                </tr>
                <tr>
                    <th>Father's Name</th>
                    <td>
                        <?php echo $user['fathers_name']?>
                    </td>
                    <th>Mother's Name</th>
                    <td>
                        <?php echo $user['mothers_name']?>
                    </td>
                </tr>
                <tr>
                    <th>Ph.</th>
                    <td>
                        <?php echo $user['phoneNumber']?>
                    </td>
                    <th>Email</th>
                    <td>
                        <?php echo $user['email']?>
                    </td>
                </tr>
                <tr>
                    <th>DOB</th>
                    <td>
                        <?php echo $user['dob']?>
                    </td>
                    <th>Aadhar</th>
                    <td>
                        <?php echo $user['aadhar_card_no']?>
                    </td>
                </tr>
                <tr>
                    <th>Whatsapp</th>
                    <td>
                        <?php echo $user['current_whatsapp_no']?>
                    </td>
                    <th>Caste</th>
                    <td>
                        <?php echo $user['student_caste']?>
                    </td>
                </tr>
                <tr>
                    <th>Religion</th>
                    <td>
                        <?php echo $user['student_religion']?>
                    </td>
                    <th>PWD</th>
                    <td>
                        <?php echo $user['is_student_PWD']?>
                    </td>
                </tr>
                <tr>
                    <th>EWS</th>
                    <td colspan="3">
                        <?php echo $user['is_student_EWS']?>
                    </td>
                </tr>
                <tr>
                    <th>Previous School</th>
                    <td colspan="3">
                        <?php echo $user['previous_school_name']?>
                    </td>
                </tr>
            </table>
        </div>
        <div class="section">
            <h2>Marks Details</h2>
            <table class="details-table" style="font-size: 14px;">
                <thead>
                    <tr>
                        <th>Subject</th>
                        <th>Bengali</th>
                        <th>English</th>
                        <th>Maths</th>
                        <th>Phy. Sc</th>
                        <th>Life Sc</th>
                        <th>Geography</th>
                        <th>History</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Obtained</td>
                        <td>
                            <?php echo $user['bengali_marks']?>
                        </td>
                        <td>
                            <?php echo $user['english_marks']?>
                        </td>
                        <td>
                            <?php echo $user['mathematics_marks']?>
                        </td>
                        <td>
                            <?php echo $user['physical_science_marks']?>
                        </td>
                        <td>
                            <?php echo $user['life_science_marks']?>
                        </td>
                        <td>
                            <?php echo $user['history_marks']?>
                        </td>
                        <td>
                            <?php echo $user['geography_marks']?>
                        </td>
                        <td>
                            <?php echo $user['obtained_marks'] ?>
                        </td>

                    </tr>
                    <tr>
                        <td>Full Marks</td>
                        <td>
                            <?php echo $user['bengali_full_marks']?>
                        </td>
                        <td>
                            <?php echo $user['english_full_marks']?>
                        </td>
                        <td>
                            <?php echo $user['mathematics_full_marks']?>
                        </td>
                        <td>
                            <?php echo $user['physical_science_full_marks']?>
                        </td>
                        <td>
                            <?php echo $user['life_science_full_marks']?>
                        </td>
                        <td>
                            <?php echo $user['history_full_marks']?>
                        </td>
                        <td>
                            <?php echo $user['geography_full_marks']?>
                        </td>
                        <td>
                            <?php echo $total_marks ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="section" style="font-size: 14px;">
            <h2 style="color: #333;">Bank Details</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Bank
                        Name:</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        <?php echo $user['bank_name']?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">
                        Account No:</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        <?php echo $user['bank_account_no']?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">IFSC:
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        <?php echo $user['bank_ifsc_code']?>
                    </td>
                </tr>
                <tr>
                <!-- <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Payment Status</td> -->
                    <!-- <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        Succesful
                    </td> -->
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Payment ID</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        <?php echo $user['institution_fees_payments_ID']?>
                    </td>
                <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">School Fees</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        <?php echo $fees ?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">Portal Fees`</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        <?php echo $fees*0.10  ?>
                    </td>

                </tr>
            </table>
        </div>
        <br>
        <br>
        <hr><br>
        <div class="section">
            <h2 style="color: #333;">Application Details</h2>
            <table style="width: 100%; border-collapse: collapse;">
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">
                        Stream</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        <?php echo $user['select_stream']?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">
                        Language</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        <?php echo $user['language_1']?>+
                        <?php echo $user['language_2']?>
                    </td>
                </tr>
                <tr>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;">
                        Combination</td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;">
                        <?php echo $user['sub_comb']?>
                    </td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left; background-color: #f2f2f2;"></td>
                    <td style="border: 1px solid #ddd; padding: 8px; text-align: left;"></td>

                </tr>
            </table>
        </div>
        <div>
            <div style="padding-top:2%;">
                <h4>
                    <center>Important Dates To Note Down</center>
                </h4>
                <p tyle="font-size: 13px;"> Attention prospective students! It's crucial to stay on top of these important dates for your online
                    admission applications. Failure to act promptly may result in forfeiture of your eligibility. Please
                    take note and ensure timely completion of all required actions.</p>
                <table class="info-table" style="font-size: 12px;">
                    <tr>
                        <th>Online Application Started</th>
                        <td>
                            <?php echo formatDate($school_info['Formfillup_Start_Date']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Online Application Closes</th>
                        <td>
                            <?php echo formatDate($school_info['Formfillup_Last_Date']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Publication of 1st Merit List</th>
                        <td>
                            <?php echo formatDate($school_info['First_merit_list_date']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Admission Begins For 1st Merit List</th>
                        <td>
                            <?php echo formatDate($school_info['Admission_Beginning_for_First_List']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Admission Closes For 1st Merit List</th>
                        <td>
                            <?php echo formatDate($school_info['Admission_Closes_For_First_List']); ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Second Merit List (If Any)</th>
                        <td>
                            <?php echo formatDate($school_info['Second_List']); ?>
                        </td>
                    </tr>
                </table>
                <h5><center>Server Log File Details</center></h5>
                <table>
                    <tr>
                        <th>Digital Fingerprint ID : </th>
                        <td><?php echo $encryptedTimestamp; ?></td>
                    </tr>
                </table>
            </div>



        </div>
        <p><strong>Terms and Conditions:</strong></p>
        <ul style="text-align: justify; font-size: 12px;color: grey;">
            <li><b>Refund Policy: </b>Once the Application fees is Submitted It'll no longer Entertained by Refunding
                the Fees.</li>
            <li><b>Cancellation Procedures: </b>To cancel your application, please contact the admission department at
                [school's email/phone number]. Please note that cancellation may be subject to certain conditions.</li>
            <li><b>Privacy Statement:</b> Your privacy is important to us. We collect and process your personal
                information in accordance with applicable data protection laws. By submitting your application, you
                consent to the collection, use, and disclosure of your personal data as described in our Privacy Policy.
            </li>
        </ul>

        <p style="text-align: justify; font-size: 12px; color: grey;">
            Congratulations! We're delighted to inform you that your application has been successfully submitted. Rest assured, your submission marks the beginning of an exciting journey towards academic excellence. From this moment onward, our dedicated team is committed to ensuring that every aspect of your application receives the attention it deserves. Your journey with us embodies our shared commitment to nurturing talent, fostering growth, and creating a vibrant community of learners. As we embark on this journey together, we extend our assurance that every step of the way, your aspirations and ambitions will be our top priority. Thank you for choosing us as your partner in education. Assured by
        </p>
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <div style="flex: 1;">
                <img src="https://i.imgur.com/GlWjPHh.png" alt="Submitted Stamp Pad Image" style="width: 80px; height: auto;padding-left: 30px;">
            </div>
            <div style="text-align: right; flex: 1;margin-top: -50px;">
                <span style="font-weight: bold;font-size: 14px;"><?php echo $school_info['HOI_Name']; ?></span><br>
                <span style="font-size: 14px;">Head of the Institution</span><br>
                <span style="font-size: 12px;"><?php echo $school_info['Institution_Name']; ?></span>
            </div>
        </div>
        
    </div>

</body>

</html>