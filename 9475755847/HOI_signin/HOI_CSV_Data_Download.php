<?php include(__DIR__ . '/../../exception_handler.php'); ?>
<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
require 'HOI_Session.php';
require 'HOI_Super_Admin.php';

$student_table_name = $udise_code . '_Student_Details';

// Fetch current server domain
$domain = isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : 'example.com'; // Replace 'example.com' with your default domain

// Query to fetch students with limit, including dynamically fetched image URLs
$filteredQuery = "
    SELECT 
        reg_no, fname, lname, email, phoneNumber, dob,
        previous_school_name, fathers_name, mothers_name, current_whatsapp_no,
        aadhar_card_no, student_religion, student_caste, is_student_PWD,
        is_student_EWS, student_village_town, student_city, student_pin_code,
        student_police_station, student_district, student_state,
        bengali_marks, bengali_full_marks, english_marks, english_full_marks,
        mathematics_marks, mathematics_full_marks, physical_science_marks,
        physical_science_full_marks, life_science_marks, life_science_full_marks,
        history_marks, history_full_marks, geography_marks, geography_full_marks,
        obtained_marks, language_1, language_2, select_stream, sub_comb,
        bank_name, bank_account_no, bank_ifsc_code,portal_payment_id,
        CONCAT('http://$domain/udise_code/uploads/', reg_no, '_passportsizephoto.',
            IF(passport_size_photo_uploaded = 1, 
                IF(LOCATE('.png', reg_no) > 0, 'png', 
                    IF(LOCATE('.jpeg', reg_no) > 0, 'jpeg', 
                        IF(LOCATE('.jpg', reg_no) > 0, 'jpg', ''))), '')) AS passport_photo_url,
        CONCAT('http://$domain/udise_code/uploads/', reg_no, '_aadharcard.',
            IF(aadhar_card_uploaded = 1, 
                IF(LOCATE('.png', reg_no) > 0, 'png', 
                    IF(LOCATE('.jpeg', reg_no) > 0, 'jpeg', 
                        IF(LOCATE('.jpg', reg_no) > 0, 'jpg', ''))), '')) AS aadhar_card_url,
        CONCAT('http://$domain/udise_code/uploads/', reg_no, '_madhyamikmarksheet.',
            IF(madhyamik_marksheet_uploaded = 1,
                IF(LOCATE('.png', reg_no) > 0, 'png', 
                    IF(LOCATE('.jpeg', reg_no) > 0, 'jpeg', 
                        IF(LOCATE('.jpg', reg_no) > 0, 'jpg', ''))), '')) AS madhyamik_marksheet_url,
        CONCAT('http://$domain/udise_code/uploads/', reg_no, '_madhyamikcertificate.',
            IF(madhyamik_certificate_uploaded = 1, 
                IF(LOCATE('.png', reg_no) > 0, 'png', 
                    IF(LOCATE('.jpeg', reg_no) > 0, 'jpeg', 
                        IF(LOCATE('.jpg', reg_no) > 0, 'jpg', ''))), '')) AS madhyamik_certificate_url,
        CONCAT('http://$domain/udise_code/uploads/', reg_no, '_signature.',
            IF(signature_uploaded = 1, 
                IF(LOCATE('.png', reg_no) > 0, 'png', 
                    IF(LOCATE('.jpeg', reg_no) > 0, 'jpeg', 
                        IF(LOCATE('.jpg', reg_no) > 0, 'jpg', ''))), '')) AS signature_url,
        Registration_Time_Stamp
    FROM $student_table_name
    ORDER BY obtained_marks DESC";

$filteredResults = mysqli_query($db, $filteredQuery);

header('Content-Type: text/csv');
header('Content-Disposition: attachment; filename="Student_Details.csv"');

// Open output stream
$output = fopen('php://output', 'w');

// Write headers to CSV file
$headers = array(
    'Registration No',
    'First name',
    'Last Name',
    'Email',
    'Phone No.',
    'Date Of Birth',
    'Previous School Name',
    'Father Name',
    'Mother Name',
    'Whatsapp No',
    'Aadhar Card No',
    'Religion',
    'Caste',
    'PWD',
    'EWS',
    'Village/Town',
    'City',
    'PIN Code',
    'Police Station',
    'District',
    'State',
    'Bengali Marks',
    'Bengali Full Marks',
    'English Marks',
    'English Full Marks',
    'Mathematics Marks',
    'Mathematics Full Marks',
    'Physical Science Marks',
    'Physical Science Full Marks',
    'Life Science Marks',
    'Life Science Full Marks',
    'History Marks',
    'History Full Marks',
    'Geography Marks',
    'Geography Full Marks',
    'Total',
    'First Language',
    'Second Language',
    'Select Stream',
    'Cubject Combination',
    'Bank Name',
    'Bank Acc. No',
    'Bank IFSC',
    'portal_payment_id',
    'Photo',
    'Aadhar Card',
    'Marek Sheet',
    'Certificate',
    'Signature',
    'Registration Time'
);
fputcsv($output, $headers);

// Write data rows to CSV
if (mysqli_num_rows($filteredResults) > 0) {
    while ($row = mysqli_fetch_assoc($filteredResults)) {
        fputcsv($output, $row);
    }
}

// Close output stream
fclose($output);
?>