<?php
    function my_autoload($class_name) {

        $dirs = [
            '../lib/',
            '../model/',
        ];

        foreach($dirs as $dir) {
            $file = __DIR__."/$dir$class_name.class.php";
            if(file_exists($file)) {
                require_once($file);
                break;
            }
        }
    }

    spl_autoload_register('my_autoload');