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
        'message' => $exception->getMessage(), // The error message
        'file' => $exception->getFile(), // The file where the exception occurred
        'line' => $exception->getLine(), // The line where the exception occurred
        'trace' => $exception->getTraceAsString(), // Full stack trace
        'trace_details' => $exception->getTrace() // Stack trace as an array (detailed info)
    ]);

    // Show the error details on the screen in development mode (for debugging purposes)
    echo "<h2>Exception Occurred:</h2>";
    echo "<strong>Message:</strong> " . htmlspecialchars($exception->getMessage()) . "<br>";
    echo "<strong>File:</strong> " . htmlspecialchars($exception->getFile()) . " <strong>Line:</strong> " . $exception->getLine() . "<br>";
    echo "<pre><strong>Trace:</strong><br>" . htmlspecialchars($exception->getTraceAsString()) . "</pre>";

    // Send HTTP response code 500 and include a generic error page
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

    // Show the error details on the screen in development mode (for debugging purposes)
    echo "<h2>Error Occurred:</h2>";
    echo "<strong>Message:</strong> " . htmlspecialchars($errstr) . "<br>";
    echo "<strong>File:</strong> " . htmlspecialchars($errfile) . " <strong>Line:</strong> " . $errline . "<br>";

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
            'message' => $error['message'], // The fatal error message
            'file' => $error['file'], // The file where the fatal error occurred
            'line' => $error['line'], // The line where the fatal error occurred
            'error_code' => $error['type'], // The error type (e.g., E_ERROR, E_PARSE)
        ],);

        // Show the fatal error details on the screen in development mode
        echo "<h2>Fatal Error Occurred:</h2>";
        echo "<strong>Message:</strong> " . htmlspecialchars($error['message']) . "<br>";
        echo "<strong>File:</strong> " . htmlspecialchars($error['file']) . " <strong>Line:</strong> " . $error['line'] . "<br>";

        // Send HTTP response code 500 and include a generic error page
        http_response_code(500);
        include __DIR__ . '/sorry.php';
        exit;
    }
}

// Register the custom handlers
set_exception_handler('exceptionHandler');
set_error_handler('errorHandler');
register_shutdown_function('shutdownHandler');
