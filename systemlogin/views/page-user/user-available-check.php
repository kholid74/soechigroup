<?php 
require_once("dbcontroller.php");

if(!empty($_POST["_username"])) {
  $authsql = "SELECT username FROM sch_user WHERE username='".$_POST['username']."'";
  $authcek = $connect->prepare($authsql);

  if(count($authcek) > 0){
      echo "<span style='color:#2FC332;'> Username Not Available.</span>";
  }else{
      echo "<span style='color:#D60202;'> Username Available.</span>";
  }
}
 ?>