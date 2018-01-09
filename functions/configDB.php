<?php
    if (!DB::create('localhost', 'root', '', 'terraemare')) {
        die("Unable to connect to database [".DB::getInstance()->connect_error."]");
    }