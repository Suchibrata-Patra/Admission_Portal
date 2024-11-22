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

    $data['timestamp'] = date('Y-m-d H:i:s'); // Add timestamp
    file_put_contents($logFile, json_encode($data) . PHP_EOL, FILE_APPEND); // Append JSON to the log file
}

// Custom Exception Handler
function exceptionHandler(Throwable $exception)
{
    logError([
        'type' => 'Exception',
        'message' => $exception->getMessage(),
        'file' => $exception->getFile(),
        'line' => $exception->getLine(),
        'trace' => $exception->getTraceAsString()
    ]);

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
        'line' => $errline
    ]);

    // Convert PHP errors to exceptions
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
            'line' => $error['line']
        ]);

        http_response_code(500);
        include __DIR__ . '/sorry.php';
        exit;
    }
}

// Register the custom handlers
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');
register_shutdown_function('shutdownHandler');
