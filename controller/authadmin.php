<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'database.php';
/**
* auth login
*/
class authadminlogin extends database {
	protected $db;
    protected $sql;
    function __construct(){
        $database = $this->DB();
        $this->db = $database;
    }
   
    
    public function is_loggedin() {
        if(isset($_SESSION['user_session'])) {
          return true;
        }
    }
 
    public function redirect($url) {
       header("Location: $url");
    }
 
    public function logout() {
        //session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }
}