<?php
include 'database.php';

// Check if the search parameter is set
if(isset($_GET['search'])) {
    $search = $_GET['search'];

    // SQL query to search for schools
    $sql = "SELECT * FROM schools WHERE school_name LIKE '%$search%'";

    $result = mysqli_query($db, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            echo "School Name: " . $row["school_name"]. "<br>";
            // Add more fields as needed
        }
    } else {
        echo "0 results found for '$search'";
    }
}

mysqli_close($db);
?>
