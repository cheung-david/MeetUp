
// Post comment to database and return status
function postComment(){
    oldscrollHeight = $("#comment_box")[0].scrollHeight;
    var comment = document.getElementById("comment").value;
    jQuery.ajax({
        type: "POST", 
        url:  "./comments/add_comment.php", 
        data: { comment: comment }, 
        success: function (response) {
            //console.log("Post" + response);
        },
        error: function(jqXHR, textStatus, errorThrown) {
           console.log(textStatus, errorThrown);
        }
    });
}

// Scroll to bottom of the chat window when newer comments posted
function scrollDown(){
    var newscrollHeight = $("#comment_box")[0].scrollHeight;
    if(newscrollHeight > oldscrollHeight){
        var commentBox = document.getElementById("comment_box");
        commentBox.scrollTop = commentBox.scrollHeight;
    }
}

// Call function for a post request
document.getElementById('send').onclick = function(event) {
      event.preventDefault(); // Prevent default functionality of submit form
      postComment();
      document.getElementById("comment").value = "";
};

// Check if a new comment was posted every second
scrollInterval = setInterval(scrollDown, 1000);