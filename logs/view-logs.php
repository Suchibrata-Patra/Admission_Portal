<?php
// $allowedIps = ['117.227.99.124','::1']; // Replace with authorized IPs
// if (!in_array($_SERVER['REMOTE_ADDR'], $allowedIps)) {
//     http_response_code(403); // Forbidden
//     echo "Access Denied. Your IP address is: " . $_SERVER['REMOTE_ADDR'];
//     exit;
// }

$logFile = __DIR__ . '/error.log';

// Check if the log file exists
if (!file_exists($logFile)) {
    http_response_code(404); // Not Found
    die("No logs available.");
}

// Read and parse log entries
$logs = [];
$handle = @fopen($logFile, 'r');
if ($handle) {
    while (($line = fgets($handle)) !== false) {
        $logEntry = json_decode($line, true); // Decode each JSON line
        if (is_array($logEntry)) { // Ensure it's valid JSON
            $logs[] = $logEntry;
        }
    }
    fclose($handle);
} else {
    http_response_code(500); // Internal Server Error
    die("Unable to read the log file.");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Logs</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ccc; text-align: left; }
        th { background-color: #f4f4f4; }
        tr:hover { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Error Logs</h1>
    <?php if (empty($logs)): ?>
        <p>No logs available.</p>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Timestamp</th>
                    <th>Type</th>
                    <th>Message</th>
                    <th>File</th>
                    <th>Line</th>
                    <th>Trace</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($logs as $log): ?>
                    <tr>
                        <td><?= htmlspecialchars($log['timestamp'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($log['type'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($log['message'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars(basename($log['file'] ?? 'N/A'), ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= htmlspecialchars($log['line'] ?? 'N/A', ENT_QUOTES, 'UTF-8') ?></td>
                        <td><?= nl2br(htmlspecialchars($log['trace'] ?? 'N/A', ENT_QUOTES, 'UTF-8')) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</body>
</html>
