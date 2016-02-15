<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Meet Up - Join Group</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
</head>
    <body>
        <div class="container">
            <h1>Join Group</h1>
            <h4>Create or join a group of your choice by typing in a group name. Share the group name with your friends to get started.</h4>
            <form action="index.php" method="POST">
                <div class="form-group">
                    <input type="text" name="name" placeholder="Set your display name" class="form-control">
                </div>
                <div class="form-group">
                    <input type="text" name="group" placeholder="Your unique group name" class="form-control">
                </div>                
                <div class="form-group">
                    <button class="btn btn-primary">Continue</button>
                </div>
            </form>
        </div>
        
    </body>
</html>