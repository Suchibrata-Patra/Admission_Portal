<?php
require 'database.php';
require 'super_admin.php';
$school_table = $udise_code . '_HOI_Login_Credentials';
$school_query = "SELECT `Formfillup_Start_Date`, `Formfillup_Last_Date`, `First_merit_list_date`, `Admission_Beginning_for_First_List`, `Admission_Closes_For_First_List`, `Second_List` FROM $school_table";

$info = mysqli_query($db, $school_query);
echo $school_table;

if ($info) {
    $school_info = mysqli_fetch_assoc($info);
    $current_date = date('Y-m-d'); 

    if ($current_date >= $school_info['Formfillup_Start_Date'] && $current_date <= $school_info['Formfillup_Last_Date']) {
        $is_Application_live = 1;
    } else {
        $is_Application_live = 0;
    }

    if ($current_date >= $school_info['First_merit_list_date'] && $current_date >= $school_info['Admission_Beginning_for_First_List']) {
        $is_Admission_live = 1;
    } else {
        $is_Admission_live = 0; 
    }
} else {
    echo "Failed to fetch school information.";
}
echo $is_Admission_live;
echo $is_Application_live;
?>
