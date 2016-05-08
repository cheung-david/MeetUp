<?php
header("Content-Type: text/javascript; charset=utf-8");
   
include "../config/config.php";

class Comment{
    public function __construct($row){
        $this->data = $row;
    }
    
    public function message(){
        $data = &$this->data;
        return ' <p class="text-left">&nbsp;&nbsp;' . '<strong>' . $data['name'] . '</strong>' . ":" . $data['body'] . '</p> ';
    }
}

function loadComments(){
    global $connection;
    global $group;
    
    $comments = array();
    $result = mysqli_query($connection, "SELECT * FROM comments WHERE group_name='" . $group . "'");
    // Determine if comments loaded
    if($result){
        while($row = mysqli_fetch_assoc($result))
        {
        	$comments[] = new Comment($row);
        }
        
        foreach($comments as $comment){
            echo $comment->message();
        }
    } else {
        echo "No comments posted.";
    }
    ob_end_flush();
    flush();
}

loadComments();

?>