<?php
    session_start();

    $users = ["bob"=>"123","alice"=>"456","eve"=>"789"];
    if(isset($_POST["login"])) {
        $login = $_POST["login"];
        if (isset($users[$login]) && $users[$login] == $_POST["pw"]) {
            $_SESSION["user"] = $login;
        }
    }
