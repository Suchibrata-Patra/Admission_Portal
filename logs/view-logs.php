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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f7fc;
            color: #333;
        }
        .container {
            width: 99%;
            margin: 0 auto;
            padding-top: 30px;
        }
        h1 {
            text-align: center;
            font-size: 2.5em;
            color: #4a4a4a;
            margin-bottom: 20px;
        }
        .card {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 30px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        th:hover {
            background-color: #45a049;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        tr:hover {
            background-color: #f1f1f1;
        }
        td {
            word-wrap: break-word;
        }
        .table-wrapper {
            overflow-x: auto;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Error Logs</h1>
        
        <div class="card">
            <div class="table-wrapper">
                <table id="logTable">
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
            </div>
        </div>
    </div>

    <script>
        // Sorting functionality for columns
        const headers = document.querySelectorAll('th');
        headers.forEach((header, index) => {
            header.addEventListener('click', () => {
                sortTable(index);
            });
        });

        function sortTable(columnIndex) {
            const table = document.getElementById('logTable');
            const rows = Array.from(table.rows).slice(1); // Skip header row
            const sortedRows = rows.sort((rowA, rowB) => {
                const cellA = rowA.cells[columnIndex].innerText;
                const cellB = rowB.cells[columnIndex].innerText;

                // Compare based on type of content (numeric or string)
                const isNumeric = !isNaN(cellA) && !isNaN(cellB);
                if (isNumeric) {
                    return parseFloat(cellA) - parseFloat(cellB);
                } else {
                    return cellA.localeCompare(cellB);
                }
            });

            // Rebuild the table with sorted rows
            sortedRows.forEach(row => table.appendChild(row));
        }
    </script>

</body>
</html>