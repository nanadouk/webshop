<?php
    session_start();

    $users = User::getUsers();

    if(isset($_POST["login"])) {
        $email = $_POST["login"];
        foreach ($users as $user) {
            if ($user->getEmail() == $email && $user->getPassword() == $_POST["pw"]) {
                $_SESSION["id"] = $user->getID();
                $_SESSION["user"] = $user->getName();
                $_SESSION["email"] = $email;
            } else {
                $err_login = true;
            }
        }
    }
