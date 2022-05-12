<?php
    $serverName = 'localhost';
    $userName = "root";
    $password = "";
    $dbName = 'blog';
    $con = new mysqli($serverName, $userName, $password, $dbName);

    if($con->connect_error){
        echo "Database Not connected";
    }

?>