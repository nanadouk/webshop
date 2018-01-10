<?php
session_start();

$admin = "admin";
$pw = "pw2018!panel";

if(isset($_POST["login"])) {
    $login = $_POST["login"];
        if ($login == $admin && $_POST["pw"] == $pw) {
        $_SESSION["admin"] = $login;
    }
}
if (!isset($_SESSION["admin"])) {
    echo "<!DOCTYPE html>\n";
    echo "<html><head><meta charset=\"utf-8\">
            <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
            </head><body>";
    echo "<h3>Access Denied!</h3><p>Please login first.</p>";
    echo "<p>&raquo; <a href=\"adminlogin.php\">Login</a></p>";
    echo "</body></html>";
    exit;
}