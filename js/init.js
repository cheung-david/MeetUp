// Initialize source and destination to last known state
function init(){
    document.getElementById("source").onchange = function() {
        localStorage['source'] = document.getElementById("source").value;
    }

    document.getElementById("destination").onchange = function() {
        localStorage['destination'] = document.getElementById("destination").value;
    }
    
    window.onload = function(){
        if(localStorage['source']){
            document.getElementById("source").value = localStorage['source'];  
        }
        if(localStorage['destination']){
            document.getElementById("destination").value = localStorage['destination'];      
        }            
    }
}

init();

// Remove last known states from memory
function reset(){
    localStorage.removeItem('source');
    localStorage.removeItem('destination');
}