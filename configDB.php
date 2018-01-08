<?php
    if (!DB::create('localhost', 'root', 'project!2018)Web', 'terraemare')) {
        die("Unable to connect to database [".DB::getInstance()->connect_error."]");
    }