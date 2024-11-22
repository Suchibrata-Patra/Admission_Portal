<?php
// Define the log file location
$logFile = __DIR__ . '/logs/error.log';

// Ensure the logs directory exists
$logDir = dirname($logFile);
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
}

// Function to log error details in structured format (JSON)
function logError($data)
{
    global $logFile;

    // Add timestamp
    $data['timestamp'] = date('Y-m-d H:i:s');

    // Additional environment/contextual info (e.g., request URI, user agent, etc.)
    $data['request_method'] = $_SERVER['REQUEST_METHOD']; // HTTP method (GET, POST, etc.)
    $data['request_uri'] = $_SERVER['REQUEST_URI']; // Full requested URI
    $data['remote_addr'] = $_SERVER['REMOTE_ADDR']; // Client's IP address
    $data['user_agent'] = $_SERVER['HTTP_USER_AGENT']; // Client's browser info

    // If PHP session is active, log session data
    if (session_status() == PHP_SESSION_ACTIVE) {
        $data['session'] = $_SESSION;
    }

    // Log the error data (complete details) in the file
    file_put_contents($logFile, json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);
}

// Custom Exception Handler
function exceptionHandler(Throwable $exception)
{
    logError([
        'type' => 'Exception',
        'message' => $exception->getMessage(), // The error message
        'file' => $exception->getFile(), // The file where the exception occurred
        'line' => $exception->getLine(), // The line where the exception occurred
        'trace' => $exception->getTraceAsString(), // Full stack trace
        'trace_details' => $exception->getTrace() // Stack trace as an array (detailed info)
    ]);

    // Redirect to a generic sorry page
    http_response_code(500);
    include __DIR__ . '/sorry.php';
    exit;
}

// Custom Error Handler
function errorHandler($errno, $errstr, $errfile, $errline)
{
    logError([
        'type' => 'Error',
        'message' => $errstr, // The error message
        'file' => $errfile, // The file where the error occurred
        'line' => $errline, // The line where the error occurred
        'error_code' => $errno, // The error number
    ]);

    // Convert PHP errors to exceptions for better logging and handling
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}

// Shutdown Handler for Fatal Errors
function shutdownHandler()
{
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR])) {
        logError([
            'type' => 'Fatal Error',
            'message' => $error['message'], // The fatal error message
            'file' => $error['file'], // The file where the fatal error occurred
            'line' => $error['line'], // The line where the fatal error occurred
            'error_code' => $error['type'], // The error type (e.g., E_ERROR, E_PARSE)
        ]);

        // Redirect to a generic sorry page for fatal errors
        http_response_code(500);
        include __DIR__ . '/sorry.php';
        exit;
    }
}

// Register the custom handlers
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');
register_shutdown_function('shutdownHandler');

// Disable error display to the browser (production environment behavior)
ini_set('display_errors', '0');  // Don't display errors on the browser
ini_set('log_errors', '1');       // Ensure errors are logged
ini_set('error_log', $logFile);   // Define the log file location for PHP errors

// Example to test the error handling
// Uncomment the next line to test the error handling
// trigger_error("This is a test error", E_USER_ERROR);
