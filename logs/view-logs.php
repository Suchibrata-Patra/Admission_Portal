<?php
// Path to the error log file
$logFile = 'error.log';

// Check if the log file exists
if (!file_exists($logFile)) {
    echo "<p>Error log file not found.</p>";
    exit;
}

// Read and decode the JSON log file
$logs = json_decode(file_get_contents($logFile), true);

// Check if the logs are in valid JSON format
if (!$logs || !is_array($logs)) {
    echo "<p>Error log file is not in valid JSON format.</p>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Logs</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
            background-color: #f9f9f9;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            background-color: #fff;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h1>Error Logs</h1>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Message</th>
                <th>File</th>
                <th>Line</th>
                <th>Timestamp</th>
                <th>Request Method</th>
                <th>Request URI</th>
                <th>Remote Address</th>
                <th>User Agent</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $index => $log): ?>
                <tr>
                    <td><?= $index + 1 ?></td>
                    <td><?= htmlspecialchars($log['type']) ?></td>
                    <td><?= htmlspecialchars($log['message']) ?></td>
                    <td><?= htmlspecialchars($log['file']) ?></td>
                    <td><?= htmlspecialchars($log['line']) ?></td>
                    <td><?= htmlspecialchars($log['timestamp']) ?></td>
                    <td><?= htmlspecialchars($log['request_method']) ?></td>
                    <td><?= htmlspecialchars($log['request_uri']) ?></td>
                    <td><?= htmlspecialchars($log['remote_addr']) ?></td>
                    <td><?= htmlspecialchars($log['user_agent']) ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
