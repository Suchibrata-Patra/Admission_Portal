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
    <title>Server Log Viewer</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .filter-buttons { margin-bottom: 20px; }
        .filter-buttons input, .filter-buttons select, .filter-buttons button { margin-right: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; cursor: pointer; }
        tr:nth-child(even) { background-color: #f9f9f9; }
    </style>
</head>
<body>
    <h1>Server Log Viewer</h1>
    <div class="filter-buttons">
        <label for="filterDate">Filter by Date:</label>
        <input type="date" id="filterDate">
        <label for="filterType">Filter by Type:</label>
        <select id="filterType">
            <option value="">All Types</option>
            <?php
            $types = array_unique(array_column($logs, 'type'));
            foreach ($types as $type) {
                echo "<option value='" . htmlspecialchars($type) . "'>" . htmlspecialchars($type) . "</option>";
            }
            ?>
        </select>
        <button onclick="applyFilters()">Apply Filters</button>
        <button onclick="clearFilters()">Clear Filters</button>
    </div>
    <table id="logTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Message</th>
                <th>Timestamp</th>
                <th>File</th>
                <th>Line</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($logs as $index => $log): ?>
            <tr>
                <td><?= $index + 1 ?></td>
                <td><?= htmlspecialchars($log['type']) ?></td>
                <td><?= htmlspecialchars($log['message']) ?></td>
                <td><?= htmlspecialchars($log['timestamp']) ?></td>
                <td><?= htmlspecialchars($log['file']) ?></td>
                <td><?= htmlspecialchars($log['line']) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        function applyFilters() {
            const dateInput = document.getElementById('filterDate').value;
            const typeInput = document.getElementById('filterType').value;
            const rows = document.querySelectorAll('#logTable tbody tr');

            rows.forEach(row => {
                const date = row.cells[3].textContent.split(' ')[0]; // Extract date from timestamp
                const type = row.cells[1].textContent;

                const matchesDate = !dateInput || date === dateInput;
                const matchesType = !typeInput || type === typeInput;

                row.style.display = matchesDate && matchesType ? '' : 'none';
            });
        }

        function clearFilters() {
            document.getElementById('filterDate').value = '';
            document.getElementById('filterType').value = '';
            applyFilters();
        }
    </script>
</body>
</html>
