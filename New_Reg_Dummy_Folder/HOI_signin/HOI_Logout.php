<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// If there's a session cookie, remove it as well
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000, 
        $params["path"], $params["domain"], 
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Prevent back button caching
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

// Redirect to the login page
header("location:HOI_Login.php");
exit; // Stop further execution of the script
?>
