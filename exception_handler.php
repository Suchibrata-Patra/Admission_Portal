<?php
// Define the log file location
$logFile = __DIR__ . '/logs/error.log';

// Ensure the logs directory exists
$logDir = dirname($logFile);
if (!is_dir($logDir)) {
    mkdir($logDir, 0777, true); // Create the directory if it doesn't exist
}

// Custom Exception Handler
function exceptionHandler(Throwable $exception)
{
    global $logFile;

    // Log exception details
    error_log("Exception: " . $exception->getMessage() . PHP_EOL, 3, $logFile);
    error_log("File: " . $exception->getFile() . " on Line: " . $exception->getLine() . PHP_EOL, 3, $logFile);
    error_log("Trace: " . $exception->getTraceAsString() . PHP_EOL . str_repeat("=", 80) . PHP_EOL, 3, $logFile);

    // Display the "sorry" page content
    http_response_code(500); // Set HTTP status code to 500 (Internal Server Error)
    include __DIR__ . '/sorry.php';
    exit;
}

// Custom Error Handler
function errorHandler($errno, $errstr, $errfile, $errline)
{
    // Convert PHP errors to exceptions
    throw new ErrorException($errstr, $errno, 0, $errfile, $errline);
}

// Shutdown Handler for Fatal Errors
function shutdownHandler()
{
    global $logFile;

    $error = error_get_last();
    if ($error && in_array($error['type'], [E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR])) {
        // Log the fatal error details
        error_log("Fatal Error: " . $error['message'] . PHP_EOL, 3, $logFile);
        error_log("File: " . $error['file'] . " on Line: " . $error['line'] . PHP_EOL, 3, $logFile);
        error_log(str_repeat("=", 80) . PHP_EOL, 3, $logFile);

        // Display the "sorry" page content
        http_response_code(500); // Set HTTP status code to 500 (Internal Server Error)
        include __DIR__ . '/sorry.php';
        exit;
    }
}

// Register the custom handlers
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');
register_shutdown_function('shutdownHandler');

// Example to trigger an error or exception
// throw new Exception("This is a test exception");
// echo $undefinedVariable; // Will trigger the error handler
// syntax error example (uncomment to test): echo 'Syntax Error';
?>
