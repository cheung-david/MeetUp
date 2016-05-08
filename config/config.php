<?php
    $cleardb_url = parse_url(getenv("CLEARDB_DATABASE_URL"));
    $servername = $cleardb_url["host"]; 
    $username = $cleardb_url["user"]; 
    $password = $cleardb_url["pass"]; 
    $database = "letsmeet";
    $dbport = 3306;

    // Create connection
    $connection = new mysqli($servername, $username, $password, $database, $dbport);

    // Check connection
    if ($connection->connect_error) {
        die("Connection failed: " . $db->connect_error);
    } 
    
    $user = mysqli_escape_string($connection, $_COOKIE['user']);
    $group = mysqli_escape_string($connection, $_COOKIE['group']);
?>