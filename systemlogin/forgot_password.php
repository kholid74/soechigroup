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

  ini_set('default_charset', 'UTF-8');
  $dir = realpath(dirname(__FILE__));
  defined('PROJECT_BASE') OR define('PROJECT_BASE', realpath($dir.'/'));
  include_once PROJECT_BASE.DIRECTORY_SEPARATOR.'/../controller/Autoloader'.'.php';
  include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'/../controller/auth-login.php';

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
   
  require_once dirname( __FILE__ ) . '/../vendor/autoload.php';
  
if (isset($_POST['submit'])) {
  
    $email = trim($_POST['email']);

    if ($email == "") {

      $error = "Please check your inputs!";
    
    } else {
    
      $sql = "SELECT * FROM sch_user WHERE email='$email'";
      $count  = $object->fetch_all($sql);
    
      if (count($count) > 0) {
    
        $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789';
        $token = str_shuffle($token);
        $token = substr($token, 0, 30);

        $verifyEmail = "UPDATE `sch_user` SET `token`='".$token."' WHERE `email`='".$email."'";

        $object->add($verifyEmail);

        $message = file_get_contents('../emailtemplates/forgotpass_admin.html');
        $message = str_replace("%token%", $token, $message);
        $message = str_replace("%email%", $email, $message);

        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0;    
        $mail->isSMTP();                         
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;                      
        $mail->Username = 'no-reply@soechi.com';   
        $mail->Password = 'autocount2018!';                
        $mail->SMTPSecure = 'tls';                         
        $mail->Port = 587;

        $mail->setFrom('no-reply@soechi.com', 'Soechi Recruitment');
        $mail->addAddress($email);
        $mail->Subject = "[no-reply] Reset Password!";
        $mail->MsgHTML($message);

        if ($mail->send()) {
            
            $error = "Check your inbox for a password reset email ";

        }else {
            $error = "Something wrong happened! Please try again!";
        }
    
      }else {

        $error = "Email not found in our database, please enter correct email..";
      
      } 
  }
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

              <h1 style="color: #FFFFFF;">Forgot Password</h1>
              <p class="text-muted" style="color: #FFFFFF!important;">Please enter your registered Email</p>
              <form role="form" method="POST" >
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-envelope"></i></span>
                </div>
                <input type="email" class="form-control" name="email"  placeholder="email" required autocomplete="off">
              </div>
              <div class="row">
                <div class="col-6">
                  <input type="submit" class="btn btn-primary px-4" style="color: #034e93;background-color: #e4e5e6;border-color: #e4e5e6;" name="submit" value="Submit">
                </div>
              </form>
                <div class="col-6 text-right">
                  <a href="login.php" class="btn btn-link px-0" style="color: #e4e5e6;">< back to login page</a>
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