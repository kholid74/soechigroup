<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../controller/auth-login.php';
$auth = new auth_login();
if (isset($_GET['logout'])) 
{
    $auth->logout();
    $auth->redirect('login.php');
    unset($auth);
}
