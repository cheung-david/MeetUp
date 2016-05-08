<?php
include "../config/config.php";

// Retrieve position of user
$lat = $_POST['lat']; 
$lng = $_POST['lng'];

$sql = "";

// Find user in database
$exist = "SELECT name FROM location WHERE name='" . $user . "' AND group_name='" . $group . "'";
$result = mysqli_query($connection, $exist);

// Add or update the user's position
if(mysqli_num_rows($result) == 0){
    $sql = "INSERT INTO location (id, latitude, longitude, name, last_login, group_name) VALUES ('','" . $lat  . "','" . $lng . "','" . $user . "','" .  date("Y-m-d H:i:s") . "','" . $group ."')";
} else {
    $sql = "UPDATE location SET last_login ='" . date("Y-m-d H:i:s") . "',latitude='". $lat ."',longitude='". $lng . "',group_name='";
    $sql .= $_COOKIE['group'] ."' WHERE name='" . $user ."' AND group_name='" . $group . "'";
}                                                                 

$result = mysqli_query($connection, $sql);
?>