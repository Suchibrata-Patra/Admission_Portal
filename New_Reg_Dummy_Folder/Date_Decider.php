<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'database.php';
require 'super_admin.php';
$school_table = $udise_code . '_HOI_Login_Credentials';
echo $udise_code;
$school_query = "SELECT `Formfillup_Start_Date`, `Formfillup_Last_Date`, `First_merit_list_date`, `Admission_Beginning_for_First_List`, `Admission_Closes_For_First_List`, `Second_List` FROM $school_table";

$info = mysqli_query($db, $school_query);
echo $school_table;
echo "<br>";
if ($info) {
    $school_info = mysqli_fetch_assoc($info);
    $current_date = date('Y-m-d'); 
    echo "Programme Debug Info";
    // echo "<br>";
    echo "Current Date - ".$current_date;
    // echo "<br>";
    echo "Formfillup State Date - ".$school_info['Formfillup_Start_Date'];
    // echo "<br>";
    echo "Formfillup Last Date - ".$school_info['Formfillup_Last_Date'];
    // echo "<br>";
    echo "First Merit List Date - ".$school_info['First_merit_list_date'];
    // echo "<br>";
    echo "Admission Begins for First List - ".$school_info['Admission_Beginning_for_First_List'];
    // echo "<br>";
    echo "Admission Closes For Last Date Date - ".$school_info['Admission_Closes_For_First_List'];
    // echo "<br>";


    if ($current_date >= $school_info['Formfillup_Start_Date'] && $current_date <= $school_info['Formfillup_Last_Date']) {
        $is_Application_live = 1;
    } else {
        $is_Application_live = 0;
    }
    // $current_date >= $school_info['First_merit_list_date'] && 
    if ($current_date >= $school_info['Admission_Beginning_for_First_List'] && $current_date <= $school_info['Admission_Closes_For_First_List']) {
        $is_Admission_live = 1;
    } else {
        $is_Admission_live = 0; 
    }
} else {
    echo "Failed to fetch school information.";
}
echo "Application Status ".$is_Application_live;
echo "<br>";
echo "Admission Status ".$is_Admission_live;
echo "<br>";
?>
