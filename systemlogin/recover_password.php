<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Soechi Lines E-Recruitment System">
  <meta name="author" content="Soechi">
  <meta name="keyword" content="Soechi Lines E-Recruitment System">
  <!-- <link rel="shortcut icon" href="assets/ico/favicon.png"> -->

  <title>Soechi Lines - E-Recruitment Login</title>

  <!-- Icons -->
  <link rel="shortcut icon" href="assets/img/favicon.png">
  <link href="assets/icon/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="assets/icon/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="assets/css/style.css" rel="stylesheet">
  <!-- Styles required by this views -->

</head>

<?php

  error_reporting(E_ALL);
  date_default_timezone_set('Asia/Jakarta');
  ini_set('default_charset', 'UTF-8');
  $dir = realpath(dirname(__FILE__));
  defined('PROJECT_BASE') OR define('PROJECT_BASE', realpath($dir.'/'));
  include_once PROJECT_BASE.DIRECTORY_SEPARATOR.'/../controller/Autoloader'.'.php';
  include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'/../controller/auth-login.php';

  $email = $_GET['email'];
  $token = $_GET['token'];

  $sql = "SELECT * FROM sch_user WHERE email='$email' AND token='$token'";
  $show  = $object->fetch($sql);
  $count  = $object->fetch_all($sql);

  $date_token = $show['modified'];
  $awal  = date_create($date_token);
  $akhir = date_create(); // waktu sekarang
  $diff  = date_diff( $awal, $akhir );

  $menit = $diff->i;
  //echo $menit;

  if (count($count) > 0) {

    if ($menit > 30) {

      echo "<script> window.location.assign('".$object->base_path()."); </script>";
    
    }else {

      if(isset($_POST['_savepass'])) { 
      
        $namatable = 'sch_user';
        $upass_2 = stripcslashes(strip_tags($_POST['_new_pass']));
        $upass_3 = stripcslashes(strip_tags($_POST['_repeat_pass']));

          if ($upass_2 == $upass_3) {
            if(strlen($upass_3) >= 8){
                    $hashpass = password_hash($upass_3, PASSWORD_DEFAULT);
                    $data = array('password' =>$hashpass,);
              $conditions = array('email' =>stripcslashes(strip_tags($email)));
              $statusMsg =  $object->updatedata($namatable,$data,$conditions);
              if($statusMsg){

                      $error = "Password Changed, you can login with your new password !";
                
                    }else{

                      $error = "Failed, password not changed !";
                    
                    }
              }else{

                    $error = "Password must be more than 8 character..";
                
                }
            }else{

              $error = "Confirmation Password not match!";
            }
      }
    }
  }else {

    echo "<script> window.location.assign('".$object->base_path()."); </script>";
  
  }

?>
<body class="app flex-row align-items-center">
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card-group">
          <div class="card p-4" style="background-color: #034e93;">
            <div class="card-body">
              <?php if (isset($error)): ?>
                  <div class="alert alert-danger" role="alert">
                    <?php echo $error ?>
                  </div>                  
              <?php endif; ?>
              <h1 style="color: #FFFFFF;">New Password</h1>
              <p class="text-muted" style="color: #FFFFFF!important;">Enter your New Password</p>
              <form role="form" method="POST" enctype="multipart/form-data">
                
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-lock"></i></span>
                </div>
                <input type="password" class="form-control" name="_new_pass" placeholder="New Password" required>
              </div>

              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-lock"></i></span>
                </div>
                <input type="password" class="form-control" name="_repeat_pass" placeholder="Repeat New Password" required>
              </div>
              <div class="row">
                <div class="col-6">
                  <input type="submit" class="btn btn-primary px-4" style="color: #034e93;background-color: #e4e5e6;border-color: #e4e5e6;" name="_savepass" value="Save">
                </div>
              </form>
                <div class="col-6 text-right">
                  <a href="login.php" class="btn btn-link px-0" style="color: #e4e5e6;">Login</a>
                </div>
              </div>
            </div>
          </div>
          <div class="card text-white bg-primary py-5 d-md-down-none" style="width:44%;background-color: #FFFFFF!important;">
            <div class="card-body text-center">
              <div>
                <h2 style="color: #000000">E-RECRUITMENT</h2>
                <p style="color: #000000">Welcome to Soechi Lines E-Recruitment Portal</p>
                <img src="assets/img/logo.png" alt="soechi_logo" style="max-width:150px;">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap and necessary plugins -->
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>

</body>
</html>