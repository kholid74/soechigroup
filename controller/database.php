<?php
session_start();//start session
date_default_timezone_set("Asia/jakarta");//set time default
ini_set('default_charset', 'UTF-8');//UTF-8
error_reporting(E_ALL | E_STRICT);
isset($_SERVER['REMOTE_ADDR']) OR $_SERVER['REMOTE_ADDR'] = '127.0.0.1';//deteksi IP

/**
* class database
* version 0.1 juan ladoeng 2017
*/
require("log.php");

class database 
{
    private $dsn;

    private $error;
    private $qError;
    private $stmt;
    
    # @object, Object for logging exceptions    
    private $log;
    
    # @array, The parameters of the SQL query
    private $parameters;

    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'soechi_prod',
        'prefix' => 'sch_',
        'encoding' => 'UTF8',
        'port' => '',
    );

    public $test = array(
        'datasource' => 'Database/Sqlite',
        'persistent' => false,
        'host' => '',
        'login' => '',
        'password' => '',
        'database' => ':memory:',
        'prefix' => '',
        'encoding' => 'UTF8',
    );

    public function __construct()
    {
        $this->log = new Log();
        $this->DB();
        $this->parameters = array();
    }

    public function DB()
    {
        static $instance;
        if ($instance === null) {
            $opt = array(
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES => FALSE,
            );
            $dsn = 'mysql:host=' .$this->default['host'] . ';dbname=' .$this->default['database'] . ';charset=' .$this->default['encoding'];
            $instance = new PDO($dsn, $this->default['login'], $this->default['password'], $opt);
        }
        return $instance;
    }
}

