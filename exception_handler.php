<?php
// Define the log file location using relative paths
$logFile = __DIR__ . '/logs/error.log'; // This is relative to the current directory

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

    // Additional environment/contextual info
    $data['request_method'] = $_SERVER['REQUEST_METHOD'];
    $data['request_uri'] = $_SERVER['REQUEST_URI'];
    $data['remote_addr'] = $_SERVER['REMOTE_ADDR'];
    $data['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

    // If PHP session is active, log session data
    if (session_status() == PHP_SESSION_ACTIVE) {
        $data['session'] = $_SESSION;
    }

    // Initialize or load the existing log entries
    $logEntries = [];
    if (file_exists($logFile)) {
        $existingContent = file_get_contents($logFile);
        if (!empty($existingContent)) {
            $logEntries = json_decode($existingContent, true);
            if ($logEntries === null) {
                $logEntries = []; // Reset if decoding fails
            }
        }
    }

    // Add the new log entry
    $logEntries[] = $data;

    // Save the updated log entries back to the file
    file_put_contents($logFile, json_encode($logEntries, JSON_PRETTY_PRINT));
}

// Custom Exception Handler
function exceptionHandler(Throwable $exception)
{
    logError([
        'type' => 'Exception',
        'message' => $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'trace' => $exception->getTraceAsString(),
        'trace_details' => $exception->getTrace(),
    ]);

    // Send HTTP response code 500 and include the generic error page
    http_response_code(500);
    include __DIR__ . '/sorry.php'; // Relative path
    exit;
}

// Custom Error Handler
function errorHandler($errno, $errstr, $errfile, $errline)
{
    logError([
        'type' => 'Error',
        'message' => $errstr,
        'file' => $errfile,
        'line' => $errline,
        'error_code' => $errno,
    ]);

    // Convert PHP errors to exceptions for unified handling
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}

// Shutdown Handler for Fatal Errors
function shutdownHandler()
{
    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR])) {
        logError([
            'type' => 'Fatal Error',
            'message' => $error['message'],
            'file' => $error['file'],
            'line' => $error['line'],
            'error_code' => $error['type'],
        ]);

        // Send HTTP response code 500 and include the generic error page
        http_response_code(500);
        include __DIR__ . '/sorry.php'; // Relative path
        exit;
    }
}

// Register the custom handlers
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');
register_shutdown_function('shutdownHandler');
