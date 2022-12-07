<?php

/**
 * Autoloader class allow you to auto load every other classes from "./class" folder.
 */

class Autoloader
{
    static function register()
    {
        spl_autoload_register(array(__CLASS__, "autoload"));

    }
    
    static function autoload($class)
    {
        if (file_exists(__DIR__ . "/" . $class . ".php")) {
            require __DIR__ . "/" . $class . ".php";
        } else {
            die("fail load class bg");
        }
    }

}