var message = document.getElementById("notify");
var watcher = null;
var travelMode = google.maps.DirectionsTravelMode.TRANSIT; // Default
var destination = "275 Yorkland Rd."
var source = "";
var routeFound = false;

function execute(){
    if(navigator.geolocation){
        var options = {
            enableHighAccuracy: true,
            timeout : Infinity,
            maximumAge: 0
        };
        watcher = navigator.geolocation.watchPosition(success, fail, options);

        //navigator.geolocation.getCurrentPosition(success, fail);
    } else {
        message.innerHTML = "Geolocation is not supported by this browser.";
    }
    
    var stop = document.getElementById("stop");
    stop.onclick = function(){
        if(watcher){
            navigator.geolocation.clearWatch(watcher);
            watcher = null;
        }
    };
};

// Find current location and fill into field
    $("#get-pos-s, #get-pos-d").click(function (event){
        event.preventDefault();
        var myId = null;
        if(this.id == "get-pos-s"){
            myId = document.getElementById("source");
        } else {
            myId = document.getElementById("destination");
        }
        navigator.geolocation.getCurrentPosition(function(address) {
            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({
              "location": new google.maps.LatLng(address.coords.latitude, address.coords.longitude)
            },
            function(results, status) {
              if (status == google.maps.GeocoderStatus.OK){
                myId.value = results[0].formatted_address;
              }
              else{
                message.innerHTML = ("Could not retrieve address");
              }
            });
        }, fail,
        {
            enableHighAccuracy: true,
            timeout: Infinity
        });        
});


function fail(err){
    switch(err.code){
        case error.PERMISSION_DENIED:
            errorMsg = "Permission denied by user.";
            break;
        case error.POSITION_UNAVAILABLE:
            errorMsg = "Position of the user not available.";
            break;
        case error.TIMEOUT:
            errorMsg = "Request timed out."
            break;
        default:    
            errorMsg = "An unknown error occurred."
    } 
}

function success(pos){
    var googleLatLng = new google.maps.LatLng(pos.coords.latitude, pos.coords.longitude);
    var mapOptions = {
        zoom: 10,
        center : googleLatLng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };
    var displayMap = document.getElementById("map");
    var googleMap = new google.maps.Map(displayMap, mapOptions);
    //message.innerHTML = ("Latitude: " + pos.coords.latitude + " Longitude: " + pos.coords.longitude);
    addMarker("Me", googleLatLng, googleMap, "<b>I'm here!</b>");
    if(!routeFound){
        routeFound = true;
        findRoute(googleLatLng, destination, googleMap); 
    }
}

function findRoute(src, dest, map){
        var directionsService = new google.maps.DirectionsService();
        if(dest == ""){
            dest = src;
        }
        var directionsRequest = {
          origin: src,
          destination: dest,
          travelMode: travelMode,
          unitSystem: google.maps.UnitSystem.METRIC
        };
        directionsService.route(
          directionsRequest,
          function(response, status){
            if (status == google.maps.DirectionsStatus.OK){
              var directionsDisplay = new google.maps.DirectionsRenderer({
                map: map,
                directions: response
              });
                directionsDisplay.setPanel(document.getElementById('panel'));
            }
            else{
             message.innerHTML = ("Unable to retrieve your route<br />");
            }
          }
        );    
}

function addMarker(title, googleLatLng, map, text){
    var markerOptions = {
        position: googleLatLng,
        map: map,
        title: title,
        animation: google.maps.Animation.BOUNCE
    };
    
    var marker = new google.maps.Marker(markerOptions);
    var infoWindow = new google.maps.InfoWindow({ 
        content: text,
        position: googleLatLng
    });
    
    google.maps.event.addListener(marker, "click", function(){
       infoWindow.open(map); 
    });
}


document.getElementById('calculate').onclick = function(event) {
  event.preventDefault();
  source = document.getElementById("source").value;
  destination = document.getElementById("destination").value;

  execute();
};
