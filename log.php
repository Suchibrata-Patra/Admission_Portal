<?php
$logFilePath = '../../../application.log';
function logErrors($errno, $errstr, $errfile, $errline) {
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'UNKNOWN'; // Use 'UNKNOWN' if REMOTE_ADDR is not set
    
    date_default_timezone_set('Asia/Kolkata');
    $time = date('m/d/y h:iA', time());

    $logEntry = "$time - IP: $ip - Error: $errstr in $errfile on line $errline\n";

    file_put_contents($GLOBALS['logFilePath'], $logEntry, FILE_APPEND | LOCK_EX);
}

// Set error handler
set_error_handler('logErrors');

// Set PHP error reporting level to hide errors from being displayed to users
error_reporting(0);

// Set PHP display_errors directive to hide errors from being displayed to users
ini_set('display_errors', 0);
