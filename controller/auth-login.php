<?php
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'database.php';
/**
* auth login
* version 0.1 juan ladoeng 2017
*/
class auth_login extends database
{
	
	  protected $db;
    function __construct()
    {
        $database = $this->DB();
        $this->db = $database;
    }

    public function register($uname,$ulast,$umail,$upass) {
      try {
        $new_password = password_hash($upass, PASSWORD_DEFAULT);
        $stmt = $this->conn->prepare("INSERT INTO kks_admin(first_name,last_name,email,password) VALUES(:uname, :ulast, :umail, :upass)");
        $stmt->bindparam(":uname", $uname);
        $stmt->bindparam(":ulast", $ulast);
        $stmt->bindparam(":umail", $umail);
        $stmt->bindparam(":upass", $new_password);            
        $stmt->execute(); 
        return $stmt; 

      }catch(PDOException $e) {
        echo $e->getMessage();
      }    
    }

    public function login($username,$upass) {
     	try
     	{
          $qr = "SELECT * FROM sch_user WHERE username=:username LIMIT 1";
          $stmt = $this->db->prepare($qr);
          $stmt->execute(array(':username'=>$username));
          $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
        	if($stmt->rowCount() > 0)
        	{
        		if ($userRow['active']=='1') {
        		
	            if(password_verify($upass, $userRow['password']))
	            {
	                $_SESSION['user_session'] = $userRow['id'];
	                return true;
	            }else{
	                return false;
	            }
	        }else{
	        	header("Location: login.php");
	        	$_SESSION['msg'] = 'account not active';
				exit;
	        }
        	}
     	} catch(PDOException $e) {
         echo $e->getMessage();
     	}
    }

    public function loginCandidate($email,$upass) {
      try
      {
          $qr = "SELECT * FROM sch_candidate_user WHERE email=:email LIMIT 1";
          $stmt = $this->db->prepare($qr);
          $stmt->execute(array(':email'=>$email));
          $userRow = $stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() > 0)
          {
            if ($userRow['account_status']=='1') {
            
              if(password_verify($upass, $userRow['password']))
              {
                  $_SESSION['user_session'] = $userRow['candidate_code'];
                  $_SESSION['user_category'] = $userRow['candidate_category'];
                  return true;
              }else{
                  return false;
              }
          }else{
            header("Location: login.php");
            $_SESSION['msg'] = 'account not active';
        exit;
          }
          }
      } catch(PDOException $e) {
         echo $e->getMessage();
      }
    }

    public function is_loggedin() {
        if(isset($_SESSION['user_session']))
        {
          return true;
        }
    }
 
    public function redirect($url) {
       header("Location: $url");
    }
 
    public function logout() {
        session_destroy();
        unset($_SESSION['user_session']);
        return true;
    }

}