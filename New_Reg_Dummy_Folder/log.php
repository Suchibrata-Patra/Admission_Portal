<?php

function secureLogger($log) {
    // Sanitize and validate log message
    $log = filter_var(trim($log), FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
    if (empty($log)) {
        return; // Exit if log message is empty
    }
    
    // Set absolute file path
    $logFilePath = 'application.log'; // Replace with actual absolute file path
    
    // Get client IP address
    $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : 'UNKNOWN'; // Use 'UNKNOWN' if REMOTE_ADDR is not set
    
    // Set timezone to IST (Indian Standard Time)
    date_default_timezone_set('Asia/Kolkata');
    $time = date('m/d/y h:iA', time());
    
    // Construct log entry
    $logEntry = "$ip\t$time\t$log\r\n";
    
    // Write to log file with file locking
    if ($fileHandle = fopen($logFilePath, 'a')) {
        if (flock($fileHandle, LOCK_EX)) { // Lock file for exclusive access
            fwrite($fileHandle, $logEntry);
            flock($fileHandle, LOCK_UN); // Release the lock
        }
        fclose($fileHandle);
    }
}

// Prevent direct access to the script
if (basename(__FILE__) == basename($_SERVER['PHP_SELF'])) {
    exit('This script cannot be accessed directly.');
}

?>
