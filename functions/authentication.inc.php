<?php
    session_start();

    $users = simplexml_load_file("data/users.xml");

    if(isset($_POST["login"])) {
        $login = $_POST["login"];
        foreach ($users->user as $user) {
            if ($user->username == $login && $user->password == $_POST["pw"]) {
                $_SESSION["user"] = $login;
            }
        }
    }
