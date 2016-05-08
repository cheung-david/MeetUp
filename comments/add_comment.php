<?php
include "../config/config.php";

$comment = $_POST['comment'];
$comment = mysqli_real_escape_string($connection, $comment);

$user = mysqli_real_escape_string($connection, $_COOKIE['user']);
$group = mysqli_real_escape_string($connection, $_COOKIE['group']);

// Add comment
if($comment){
    $sql = "INSERT INTO comments (id, name, body, group_name) VALUES ('','" . $user  . "','" . $comment . "','" . $group ."')";
    $result = mysqli_query($connection, $sql);
} 

?>