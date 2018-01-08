<?php
    session_start();
    session_regenerate_id(true); // forces a new session id
    session_destroy();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    </head>
    <body>
        <h3>You have logged out</h3>
        <p>&raquo; <a href="adminlogin.php">Login</a></p>
    </body>
</html>