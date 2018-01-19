<?php
    $dbconnect = simplexml_load_file(__DIR__."/data/configDB.xml");
    $host = $dbconnect->host->title;
    $user = $dbconnect->user->title;
    $pw = $dbconnect->pw->title;;
    $dbname = $dbconnect->dbname->title;


   if (!DB::create($host,$user,$pw,$dbname))
    {
        die("Unable to connect to database [".DB::getInstance()->connect_error."]");
    }