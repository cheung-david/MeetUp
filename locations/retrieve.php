<?php
    // File retrieves locations from database

   header("Access-Control-Allow-Origin: *");
   //header("Content-Type: text/event-stream\n\n"); Used for Event Source method
   header("Content-Type: text/javascript; charset=utf-8");
   include "../../config/config.php";
   $locations = [];
    

    $query = "SELECT * FROM location WHERE name<>'" . $user . "' AND group_name='" . $group . "'";
    $result = mysqli_query($connection, $query);
    
    while($row = mysqli_fetch_assoc($result)){
        // Store and retrieve later
        array_push($locations, $row);
    }
    $json = json_encode($locations);
    //$_SESSION['locations'] = $json;
    //echo "var allLocations=" . $json . ";\n";
    echo $json;
    ob_end_flush();
    flush();
?>