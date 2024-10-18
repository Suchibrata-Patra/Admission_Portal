<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Redirect to the login page
header("location: Admin_Login.php");
exit; // Stop further execution of the script
?>
<script>
        window.history.forward();
</script>