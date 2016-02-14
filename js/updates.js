var allLocations;
var oldscrollHeight;
/* 
// Alternative method to retrieving updates HTML5
// check for browser support
if(typeof(EventSource) !== "undefined") {
	//create an object amd pass it the name and server-side script
	var eventSource = new EventSource("retrieve.php");
	//detect changes
	eventSource.onmessage = function(event) {
	    document.getElementById("notify").innerHTML="s";
		allLocations = event.data;
		console.log("E:" + event.data);
	};
	
	eventSource.onerror = function(e) {
       
    };
}
else {
	document.getElementById("notify").innerHTML="Your browser doesn't receive server-sent events. You must refresh page manually.";
}  */

function updateLocations(){
        var xmlhttp;
        if (window.XMLHttpRequest) {
            // For IE7+, Firefox, Chrome, Opera, Safari compatability
            xmlhttp = new XMLHttpRequest();
        } else {
            // IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                allLocations = JSON.parse(xmlhttp.responseText);
                //console.log(allLocations);
            }
        };
        xmlhttp.open("GET","./locations/retrieve.php",true);
        xmlhttp.send();            
}

function updateComments(){
        var xmlhttp;
        if (window.XMLHttpRequest) {
            // For IE7+, Firefox, Chrome, Opera, Safari compatability
            xmlhttp = new XMLHttpRequest();
        } else {
            // IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("comment_box").innerHTML = "" + xmlhttp.responseText;
            }
        };
        xmlhttp.open("GET","./comments/comments.php",true);
        xmlhttp.send();
}        

// Initialize
updateLocations();
var updateInterval, updateCommentInterval;
var scrollInterval;
function active(){
    updateInterval = setInterval(updateLocations, 5000);
    updateCommentInterval = setInterval(updateComments, 2000);
}
active();
function inactive(){
    clearInterval(updateInterval);
}
// Only activate when user is on the window, disabled for now
//window.addEventListener('focus', active);    
//window.addEventListener('blur', inactive);