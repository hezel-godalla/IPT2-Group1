<?php
    $servername = "localhost";
    $db_name = "IPT2_G1";
    $username = "root";
    $password = "";

    
    $conn=  new mysqli($servername, $username, $password, $db_name);

    
    if ($conn->connect_error) {
        die("Connection failed: ". $conn->connect_server);
    }
    echo "Connected";

?>