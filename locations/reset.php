<?php 
    //session_start();
    include "../config/config.php";

    function leaveGroup(){
        global $connection;
        global $user;
        global $group;
            $query = "DELETE FROM location WHERE name='" . $user . "' AND group_name='". $group ."'";
            clear();
            $result = mysqli_query($connection, $query);
            header("location: ../join.php");
            exit();
    }
    
    function clear(){
            unset($_COOKIE['user']);
            setcookie('user', '0', time() - (3600*24));
            unset($_COOKIE['group']);
            setcookie('group', '0', time() - (3600*24));
    }
    
    leaveGroup();
?>
