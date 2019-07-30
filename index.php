<?php
    ini_set('display_errors',1);
    error_reporting(E_ALL);
    
    define('ROOT', dirname(__FILE__));

    function __autoload($class) {
        $class = str_replace("\\","/",$class);
        include $class.'.php';
    }

    require __DIR__ . '/app/Routes.php';
