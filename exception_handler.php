<?php

date_default_timezone_set('Asia/Kolkata');

// Define the log file location
$logFile = __DIR__ . '/logs/error.log';

// Ensure the logs directory exists
$logDir = dirname($logFile);
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
}

// Base directory to strip from full paths
$baseDir = '/home/u955994755/domains/theapplication.in/';

// Function to remove base directory and keep the relative file path
function getRelativePath($fullPath)
{
    global $baseDir;
    return str_replace($baseDir, '', $fullPath);
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

    // Add the file path to log (with relative path)
    if (isset($data['file'])) {
        $data['file'] = getRelativePath($data['file']);
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
        'trace_details' => $exception->getTrace()
    ]);

    // Show only the sorry.php page and no error details on screen
    http_response_code(500);
    include __DIR__ . '/sorry.php';
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

    // Convert PHP errors to exceptions for better logging
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

        // Show only the sorry.php page and no fatal error details on screen
        http_response_code(500);
        include __DIR__ . '/sorry.php';
        exit;
    }
}

// Register the custom handlers
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');
register_shutdown_function('shutdownHandler');
