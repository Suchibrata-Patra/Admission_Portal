<?php
session_start();

if (!isset($_SESSION['username'])) {
    header('Location: login.php');
    exit();
}
require_once('dbconnectionrequest.php');

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get the SQL query from the form
    $sqlQuery = $_POST['sqlQuery'];

    // Check for potentially harmful keywords
    $harmfulKeywords = array('DROP', 'ALTER', 'TRUNCATE', 'DELETE');
    $isSafeQuery = true;

    foreach ($harmfulKeywords as $keyword) {
        if (stripos($sqlQuery, $keyword) !== false) {
            $isSafeQuery = false;
            break;
        }
    }

    // Check if the query is targeting the "PriceMatrix" table
    $targetTable = "PriceMatrix";
    if ($isSafeQuery && stripos($sqlQuery, $targetTable) !== false) {
        // Execute the SQL query
        $result = $conn->query($sqlQuery);

        if ($result) {
            echo '<div class="text-danger">Succesful.</div>';
        } else {
            echo "Error executing query: " . $conn->error;
        }
    } } else {
    echo '<div class="text-danger">Error: Potentially harmful keywords detected in the query or attempting to modify unauthorized tables. Aborted execution.</div>';

}

// Retrieve current data from the PriceMatrix table for preview
$previewQuery = "SELECT * FROM PriceMatrix";
$previewResult = $conn->query($previewQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Price Matrix</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
  @import url('https://fonts.googleapis.com/css2?family=Roboto:wght@100;300&display=swap');
</style>
<style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
font-family: 'Roboto', sans-serif; 
            
        }

        h2 {
            color: #007bff;
        }

        p {
            margin-bottom: 20px;
        }

        textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-family: 'Source Code Pro', monospace;
        }
        .keyword-suggestion {
            font-family: 'Roboto', sans-serif;
            cursor: pointer;
            text-decoration: none;
            color: #ddef75; /* Green color */
            margin: 5px;
            padding: 5px 10px;
            border-radius: 4px;
        }
 input[type="submit"] {
            background-color: #000;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Arial', sans-serif;
        }

        input[type="submit"]:hover {
            background-color: #333;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-family: 'Arial', sans-serif;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        table-container {
            overflow-x: auto;
        }

        table {
            width: 100%;
            margin-top: 20px;
            border-collapse: collapse;
font-family: 'Roboto', sans-serif;        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: BLACK;
        }

      
         .keyword-suggestions {
     margin-bottom:15px;
         }
        .keyword-suggestion {
            cursor: pointer;
            text-decoration: none;
            background-color: #ddef75;
            color:black;
            margin: 3px;
            padding: 5px 10px;
            border: 2px;
            border-radius: 5px;
            transition: background-color 0.3s, color 0.3s;
            margin:10px;
        }

        /* Additional Styles for Mobile Responsiveness */
        @media (max-width: 768px) {
            table-container {
                overflow-x: auto;
            }a
        }
    </style>
</head>

<body>
    <h2>Modify Price Matrix</h2>
    <p>Enter your SQL query below to modify the Price Matrix table:</p>

    <!-- Template -->
    <!-- Keyword suggestions -->
    <div class="keyword-suggestions">
        <span class="keyword-suggestion" onclick="addKeywordToQuery('SELECT')">SELECT</span>
        <span class="keyword-suggestion" onclick="addKeywordToQuery('UPDATE')">UPDATE</span>
        <span class="keyword-suggestion" onclick="addKeywordToQuery('INSERT')">INSERT</span>
        <span class="keyword-suggestion" onclick="addKeywordToQuery('DELETE')">DELETE</span>
    <select id="templateCode" class="keyword-suggestion" onchange="insertTemplateCode()">
        <option value=""><b><i><u>Select Template</u></i></b></option>
        <option value="CHANGE_COLUMN">Change Column Value</option>
        <option value="CHANGE_ROW">Change Row Values</option>
        <option value="CHANGE_CELL">Change Specific Cell</option>
        <!-- Add more template options as needed -->
    </select>
        <!-- Add more keywords as needed -->
    </div>

    <!-- Template codes dropdown -->
    

   <form method="post" action="">
        <textarea name="sqlQuery" id="sqlQuery" rows="5" cols="50" style="resize: none;" required></textarea><br>
        <!-- Updated button with Bootstrap classes -->
        <input type="submit" class="btn btn-dark" value="Execute Query" style="background-color:BLACK;">
    </form>

    <h3>Preview of Current Data</h3>
    <?php
    if ($previewResult && $previewResult->num_rows > 0) {
        // Display the current data in a table
        echo '<table class="table table-bordered">';
        echo '<thead><tr>';

        // Fetch the column names and display them in the table header
        $previewResult->fetch_fields(); // Move the pointer to the first field
        foreach ($previewResult->fetch_fields() as $column) {
            echo '<th>' . $column->name . '</th>';
        }

        echo '</tr></thead>';
        echo '<tbody>';

        $previewResult->data_seek(0); // Reset result pointer to start

        while ($row = $previewResult->fetch_assoc()) {
            echo '<tr>';
            foreach ($row as $value) {
                echo '<td>' . $value . '</td>';
            }
            echo '</tr>';
        }

        echo '</tbody></table>';
    } else {
        echo 'No data available.';
    }
    ?>

    <script>
        function addKeywordToQuery(keyword) {
            document.getElementById('sqlQuery').value += keyword + ' ';
        }

        function insertTemplateCode() {
            var templateCode = document.getElementById('templateCode').value;

            // Add the corresponding template SQL code based on the selected option
            switch (templateCode) {
                case "CHANGE_COLUMN":
                    document.getElementById('sqlQuery').value += 'UPDATE PriceMatrix SET columnName = newValue WHERE condition;\n';
                    break;
                case "CHANGE_ROW":
                    document.getElementById('sqlQuery').value += 'UPDATE PriceMatrix SET columnName1 = newValue1, columnName2 = newValue2, ... WHERE condition;\n';
                    break;
                case "CHANGE_CELL":
                    document.getElementById('sqlQuery').value += 'UPDATE PriceMatrix SET columnName = newValue WHERE specificCondition;\n';
                    break;
                // Add more cases for additional templates
                default:
                    break;
            }
        }
    </script>

    <!--End of templates-->
</body>

</html>
