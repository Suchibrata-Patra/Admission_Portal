<?php
include 'database.php';

// Initialize variables
$query = '';
$result = '';
$error = '';
$tables = [];
$rows = [];

// Function to get the list of tables in the database
function getTables($db) {
    $tables = [];
    $result = $db->query("SHOW TABLES");

    if ($result) {
        while ($row = $result->fetch_array(MYSQLI_NUM)) {
            $tables[] = $row[0];
        }
    } else {
        echo "<p>Error executing SHOW TABLES query: " . $db->error . "</p>";
    }

    return $tables;
}

// Function to get the first few rows of a specific table
function getTableRows($db, $tableName, $limit = 5) {
    $rows = [];
    $result = $db->query("SELECT * FROM `$tableName` LIMIT $limit");

    if ($result) {
        $rows = $result->fetch_all(MYSQLI_ASSOC);
    } else {
        echo "<p>Error executing SELECT query: " . $db->error . "</p>";
    }

    return $rows;
}

// Retrieve the list of tables
$tables = getTables($db);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $query = trim($_POST['query']);

    if ($query) {
        // Display the query for debugging purposes
        echo "<p>Executing query: " . htmlspecialchars($query) . "</p>";

        // Execute the query
        $res = $db->query($query);

        if ($res) {
            if (stripos($query, "CREATE TABLE") !== false || stripos($query, "ALTER TABLE") !== false) {
                // Query was a table creation or modification query
                echo "<p>Table created or modified successfully.</p>";
                // Refresh the list of tables after modification
                $tables = getTables($db);
            } elseif (stripos($query, "DROP TABLE") !== false) {
                // Check if table exists before dropping
                $tableName = trim(str_ireplace('DROP TABLE', '', $query));
                $tableName = str_replace('`', '', $tableName); // Remove backticks if any

                if (in_array($tableName, $tables)) {
                    echo "<p>Table '$tableName' exists and will be dropped.</p>";
                    // Remove the table from the list of tables
                    $tables = array_filter($tables, function($table) use ($tableName) {
                        return $table !== $tableName;
                    });
                } else {
                    $error = "Table '$tableName' does not exist.";
                }
            } else {
                // Fetch all results
                $result = $res->fetch_all(MYSQLI_ASSOC);
            }
        } else {
            $error = "Error executing query: " . $db->error;
        }
    }
}

// Check if a specific table is requested for row preview
if (isset($_GET['table'])) {
    $tableName = $_GET['table'];
    $rows = getTableRows($db, $tableName);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SQL Table Visualizer</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h1 {
            margin-top: 0;
            color: #333;
            font-size: 2rem;
            text-align: center;
        }
        h2 {
            color: #555;
            font-size: 1.5rem;
        }
        textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 1rem;
        }
        button {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 15px;
            font-size: 1rem;
            border-radius: 4px;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .error {
            background-color: #f8d7da;
            color: #721c24;
            padding: 10px;
            border: 1px solid #f5c6cb;
            border-radius: 4px;
            margin-bottom: 20px;
        }
        .tables-list {
            margin-bottom: 20px;
        }
        .tables-list ul {
            list-style-type: none;
            padding: 0;
        }
        .tables-list li {
            background: #e9ecef;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 10px;
            margin: 5px 0;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .tables-list li:hover {
            background-color: #ddd;
        }
        .table-preview {
            display: none;
            margin-top: 10px;
        }
        .table-preview table {
            width: 100%;
            border-collapse: collapse;
        }
        .table-preview table, .table-preview th, .table-preview td {
            border: 1px solid #ddd;
        }
        .table-preview th, .table-preview td {
            padding: 12px;
            text-align: left;
        }
        .table-preview th {
            background-color: #007bff;
            color: white;
        }
        tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>SQL Table Visualizer</h1>

        <!-- Display the list of tables -->
        <div class="tables-list">
            <h2>Current Tables</h2>
            <ul>
                <?php if ($tables): ?>
                    <?php foreach ($tables as $table): ?>
                        <li onclick="toggleTablePreview('<?php echo htmlspecialchars($table); ?>')">
                            <?php echo htmlspecialchars($table); ?>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No tables found.</li>
                <?php endif; ?>
            </ul>
        </div>

        <!-- Form to execute SQL queries -->
        <form method="POST" action="">
            <textarea name="query" rows="6" placeholder="Enter SQL query here..."><?php echo htmlspecialchars($query); ?></textarea><br>
            <button type="submit">Run Query</button>
        </form>

        <!-- Display error messages -->
        <?php if ($error): ?>
            <div class="error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>

        <!-- Display results of SELECT queries -->
        <?php if ($result): ?>
            <h2>Query Results</h2>
            <table>
                <thead>
                    <tr>
                        <?php
                        // Display table headers
                        $first_row = reset($result);
                        if ($first_row) {
                            foreach ($first_row as $key => $value) {
                                echo "<th>" . htmlspecialchars($key) . "</th>";
                            }
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Display table rows
                    foreach ($result as $row) {
                        echo "<tr>";
                        foreach ($row as $cell) {
                            echo "<td>" . htmlspecialchars($cell) . "</td>";
                        }
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
        <?php endif; ?>
 
        <!-- Table previews (collapsed by default) -->
        <?php foreach ($tables as $table): ?>
            <div id="preview-<?php echo htmlspecialchars($table); ?>" class="table-preview">
                <h2>Preview of <?php echo htmlspecialchars($table); ?></h2>
                <?php
                $previewRows = getTableRows($db, $table);
                if ($previewRows): ?>
                    <table>
                        <thead> 
                            <tr>
                                <?php
                                $first_row = reset($previewRows);
                                if ($first_row) {
                                    foreach ($first_row as $key => $value) {
                                        echo "<th>" . htmlspecialchars($key) . "</th>";
                                    }
                                }
                                ?>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($previewRows as $row): ?>
                                <tr>
                                    <?php foreach ($row as $cell): ?>
                                        <td><?php echo htmlspecialchars($cell); ?></td>
                                    <?php endforeach; ?>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>No rows found.</p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <script>
        function toggleTablePreview(tableName) {
            const previewElement = document.getElementById('preview-' + tableName);
            if (previewElement.style.display === 'none' || previewElement.style.display === '') {
                previewElement.style.display = 'block';
            } else {
                previewElement.style.display = 'none';
            }
        }
    </script>
</body>
</html>
