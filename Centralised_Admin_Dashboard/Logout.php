<?php
// session_start();

// // Unset all of the session variables
// $_SESSION = array();

// // Destroy the session
// session_destroy();

// // Redirect to the login page
// header("location: Admin_Login.php");
// exit; // Stop further execution of the script
?>
<!-- <script>
        window.history.forward();
</script> -->

<?php
// Start the session securely
session_start();

// Unset all of the session variables
$_SESSION = array();

// If you want to destroy the session cookie as well
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Destroy the session
session_destroy();

// Secure the redirection to the login page
header("Location: Admin_Login.php");
exit; // Stop further execution of the script

// Prevent back navigation
echo '<script>window.history.forward();</script>';
?>