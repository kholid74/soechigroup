<?php
/*
*version 0.1 juan ladoeng 2017
*/
spl_autoload_extensions(".php");
spl_autoload_register();

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'database.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'controller.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'systemAdmin.php';


function __autoloader($className){
    $file_position = strrpos($className, '\\');
    if($file_position === false) {
        return;
    }

    $drive = DIRECTORY_SEPARATOR;
    $path = str_replace('\\', $drive, strtolower(substr($className, 0, $file_position + 1)));
    $file = $path . substr($className, $file_position + 1) . '.php';
    if(file_exists($file)) {
        require_once($file);
    }

}

$halaman = new home(); //load controller home
$object = new SystemAdmin(); //load controller system Admin