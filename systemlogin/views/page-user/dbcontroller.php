<?php
    define('HOST_NAME','localhost');
    define('DATABASE_NAME','soechi_prod');
    define('DATABASE_USER_NAME','root');
    define('DATABASE_PASSWORD','');

    $connect = new MySQLi(HOST_NAME, DATABASE_USER_NAME, DATABASE_PASSWORD, DATABASE_NAME);
  
     if($connect->connect_errno)
     {
       die("ERROR : -> ".$connect->connect_error);
     }
?>