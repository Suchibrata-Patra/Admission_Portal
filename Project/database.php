<?php
    $servername = "localhost"; 
    $username = "root"; 
    $password = "root"; 
    $database = "user"; 

    // Create a connection 
    $db = mysqli_connect($servername, $username, $password, $database); 
    echo "Connection Succesful";
?>
