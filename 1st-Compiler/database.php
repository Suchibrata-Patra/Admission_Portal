<?php
    $servername = "localhost"; 
    $username = "root"; 
    $password = "root"; 
    $database = "SQL_Engine"; 
    // Create a connection 
    $db = mysqli_connect($servername, $username, $password, $database);

    echo "Server Connected Succesfully.";
?>