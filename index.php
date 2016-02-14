<?php
    define('deny', TRUE);
    // Accessed through join page, set cookie for current user
    if(isset($_POST['name'])){
        $name = 'user';
        $value = $_POST['name'];
        $expire = time() + 60 * 60 * 24; // a day
        setcookie($name, $value, $expire);
        // Set cookie for group
        $name = 'group';
        $value = $_POST['group'];
        setcookie($name, $value, $expire);  
    }
?>
<?php
    // Redirect if not a member (No display name)
    if(!($_COOKIE['user'] || isset($_POST['name']))){
        header("location: join.php");  
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meet Up</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
    <script src="js/jquery-1.12.0.min.js"></script>
    <script src="https://maps.google.com/maps/api/js?v=3.20"></script>
    <script type='text/javascript' src="js/updates.js"></script>
</head>
<body>
   <div class="container text-center">
        <h1>Meet Up</h1>
        <p id="notify"></p>
        <div id="map" class="center-block"></div>
        <div id="panel" class="center-block"></div>
        <button id="stop" class="btn btn-default" onclick="alert('Your location will stop updating. Submit a search again to keep tracking.')">Stop Tracking</button>
        <a href="./locations/reset.php" class="btn btn-default">Leave Group</a>
    </div>
    <form id="find-route" name="find-route" action="#" method="GET" class="container text-center">
     <div class="form-group">
      <label for="source">From:</label>
      <input type="text" class="form-control" id="source" name="source" placeholder="Address: leave blank to use current position" size="30" />
      <a id="get-pos-s" href="#">Get my approximate position</a>
      <br />
    </div>
    <div class="form-group"> 
      <label for="destination">To:</label>
      <input type="text" class="form-control" id="destination" name="destination" placeholder="Destination Address" size="30" />
      <a id="get-pos-d" href="#">Get my approximate position</a>
      <br />
    </div>
     <div class="form-group">
          <label class="radio-inline"><input type="radio" name="mode" value="transit" class="radio-inline" checked> Transit<br></label>
          <label class="radio-inline">
           <input type="radio" name="mode" value="car" class="radio-inline"> Car<br>
          </label>
          <label class="radio-inline">
           <input type="radio" name="mode" value="walk" class="radio-inline"> Walk
         </label>
     </div>    
     <div class="form-group">
      <input type="submit" id="calculate" class="btn btn-default"/>
      <input type="reset" onclick="reset()" class="btn btn-default"/>
     </div>

    </form>
    <div class="container">
        <div class="align-left">
            
            <div class="row">
                <div class="col-md-12">
                    <h4>&nbsp;Comments</h4>
                    <div id="comment_box">
                        
                    </div>
                <form action="" method="POST" class="full-width">
                    <div class="form-inline">
                        <input type="text" name="comment" id="comment" class="form-control "/>
                        <input type="submit" id="send" class="btn btn-sm btn-primary"/>
                    </div>
                </form>
                </div>
            </div>
        </div>        
    </div>

    <br>
</body>
<!-- GEOLOCATION LOGIC in trackN.js file -->
<script type="text/javascript" src="js/trackN.js"></script>
<script type="text/javascript" src="js/comment.js"></script>
<script type="text/javascript" src="js/init.js"></script>
</html>