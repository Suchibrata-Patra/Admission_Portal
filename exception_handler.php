<?php
// Define the base directory (this should be the root path of your application)
$baseDir = '/home/u955994755/domains/theapplication.in'; // Change this to your actual base directory

// Define the log file location
$logFile = __DIR__ . '/logs/error.log';

// Ensure the logs directory exists
$logDir = dirname($logFile);
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true);
}

// Function to trim file paths from the base directory
function trimFilePath($filePath, $baseDir)
{
    return str_replace($baseDir, '', $filePath);
}

// Function to log error details in structured format (JSON)
function logError($data)
{
    global $logFile, $baseDir;

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

    // Modify the file path to be relative
    if (isset($data['file'])) {
        $data['file'] = trimFilePath($data['file'], $baseDir);
    }

    // Trim file paths in the trace
    if (isset($data['trace_details']) && is_array($data['trace_details'])) {
        foreach ($data['trace_details'] as &$trace) {
            if (isset($trace['file'])) {
                $trace['file'] = trimFilePath($trace['file'], $baseDir);
            }
        }
    }

    // Log the error data (complete details) in the file
    file_put_contents($logFile, json_encode($data, JSON_PRETTY_PRINT) . PHP_EOL, FILE_APPEND);
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
        'message' => $errstr,
        'file' => $errfile,
        'line' => $errline,
        'error_code' => $errno,
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
            'message' => $error['message'],
            'file' => $error['file'],
            'line' => $error['line'],
            'error_code' => $error['type'],
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
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', $logFile);

// Example to test the error handling
// Uncomment the next line to test the error handling
// trigger_error("This is a test error", E_USER_ERROR);
?>
