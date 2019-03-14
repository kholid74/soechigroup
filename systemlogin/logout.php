<?php
error_reporting(0);
ini_set('default_charset', 'UTF-8');
$dir = realpath(dirname(__FILE__));
define('base_app', "http://".$_SERVER['HTTP_HOST'].'/soechi/');
defined('PROJECT_BASE') OR define('PROJECT_BASE', realpath($dir.'/'));
include_once PROJECT_BASE.DIRECTORY_SEPARATOR.'../controller/Autoloader'.'.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../controller/database.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../controller/authadmin.php';
$authadmin = new authadminlogin();
$authadmin->logout();
echo "<script> window.location.assign('".$object->base_path()."login.php'); </script>";
unset($auth);