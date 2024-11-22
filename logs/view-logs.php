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
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: left;
        }
        table th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>
    <h1>Error Logs</h1>
    <table>
        <thead>
            <tr>
                <th>Type</th>
                <th>Message</th>
                <th>File</th>
                <th>Line</th>
                <th>Trace</th>
                <th>Timestamp</th>
                <th>Request URI</th>
                <th>Remote Addr</th>
                <th>User Agent</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $logFile = 'error.log'; // Path to your error log file

            if (file_exists($logFile)) {
                $logContent = file_get_contents($logFile);
                $logData = json_decode($logContent, true);

                if ($logData) {
                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($logData['type']) . '</td>';
                    echo '<td>' . htmlspecialchars($logData['message']) . '</td>';
                    echo '<td>' . htmlspecialchars($logData['file']) . '</td>';
                    echo '<td>' . htmlspecialchars($logData['line']) . '</td>';
                    echo '<td>';
                    if (!empty($logData['trace_details'])) {
                        foreach ($logData['trace_details'] as $trace) {
                            echo 'File: ' . htmlspecialchars($trace['file']) . '<br>';
                            echo 'Line: ' . htmlspecialchars($trace['line']) . '<br>';
                            echo 'Function: ' . htmlspecialchars($trace['function']) . '<br>';
                            echo '<hr>';
                        }
                    } else {
                        echo 'No Trace Available';
                    }
                    echo '</td>';
                    echo '<td>' . htmlspecialchars($logData['timestamp']) . '</td>';
                    echo '<td>' . htmlspecialchars($logData['request_uri']) . '</td>';
                    echo '<td>' . htmlspecialchars($logData['remote_addr']) . '</td>';
                    echo '<td>' . htmlspecialchars($logData['user_agent']) . '</td>';
                    echo '</tr>';
                } else {
                    echo '<tr><td colspan="9">Invalid log data format</td></tr>';
                }
            } else {
                echo '<tr><td colspan="9">Log file not found</td></tr>';
            }
            ?>
        </tbody>
    </table>
</body>
</html>
