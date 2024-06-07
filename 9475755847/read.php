<?php
include 'super_admin.php';
// Ensure errors are not displayed to users
ini_set('display_errors', 0);
error_reporting(0);
// Ensure UDISE code is set, otherwise terminate execution
// $udise_code = 9475755847;
// Define JSON file path using __DIR__
$json_file = 'HOI_signin/' . $udise_code . '_profile_data.json';
// Load profile data securely
$profile_data = [];
if (file_exists($json_file)) {
    $json_data = file_get_contents($json_file);
    $profile_data = json_decode($json_data, true);
    if ($profile_data === null) {
        echo "Error decoding profile data.";
        $profile_data = []; // Reset to empty array
    }
} else {
    echo "Profile data file not found.";
}

// Output the profile data
echo json_encode($profile_data, JSON_PRETTY_PRINT);
?>
