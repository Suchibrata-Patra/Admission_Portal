<?php include(__DIR__ . './../exception_handler.php'); ?>
<?php
// Path to the error log file
$logFile = 'error.log';

// // Check if the log file exists
// if (!file_exists($logFile)) {
//     echo "<p>Error log file not found.</p>";
//     exit;
// }

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
    <title>ERROR Log</title>
    <link rel="shortcut icon" href="/Assets/images/favicon.png" type="image/svg+xml">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0&icon_names=keyboard_arrow_down" />    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        .filter-buttons { margin-bottom: 20px; }
        .filter-buttons input, .filter-buttons select, .filter-buttons button { margin-right: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 10px; border: 1px solid #ddd; text-align: left; }
        th { background-color: #f4f4f4; cursor: pointer; }
        tr:nth-child(even) { background-color: #f9f9f9; }
        .json-details { display: none; background-color: #f8f9fa; border: 1px solid #ddd; margin-top: 10px; padding: 10px; font-family: monospace; }
    </style>
</head>
<body>
    <h1><center>Server Logs <p style="font-size:15px;font-weight:300;">Powered by TheApplication.in</p></center> </h1>
    
    <div class="filter-buttons">
        <label for="filterDate" style="font-weight:300;font-size:15px;">Date:</label>
        <input type="date" id="filterDate" style="border:2px solid black; padding:5px; border-radius:4px;">
        <label for="filterType" >Type:</label>
        <select id="filterType" style="border:2px solid black; padding:5px; border-radius:4px;">
            <option value="">All Types</option>
            <?php
            $types = array_unique(array_column($logs, 'type'));
            foreach ($types as $type) {
                echo "<option value='" . htmlspecialchars($type) . "'>" . htmlspecialchars($type) . "</option>";
            }
            ?>
        </select>
        <button class="btn btn-light" onclick="applyFilters()">Apply Filters</button>
        <button class="btn btn-light" onclick="clearFilters()">Clear Filters</button>
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
                <td>
                    <?= $index + 1 ?>
                    <button style="border:none;background-color:rgb(255, 255, 255,0.1);border-radius:100px;" onclick="toggleDetails(<?= $index ?>)"><span class="material-symbols-outlined">
keyboard_arrow_down
</span></button>
                    <div id="json-details-<?= $index ?>" class="json-details">
                        <?= htmlspecialchars(json_encode($log, JSON_PRETTY_PRINT)) ?>
                    </div>
                </td>
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

        function toggleDetails(index) {
            const details = document.getElementById(`json-details-${index}`);
            if (details.style.display === 'none' || details.style.display === '') {
                details.style.display = 'block';
            } else {
                details.style.display = 'none';
            }
        }
    </script>
</body>
</html>
