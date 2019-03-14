<?php


  $msg = "";

  use PHPMailer\PHPMailer\PHPMailer;
  use PHPMailer\PHPMailer\Exception;
   
  require_once dirname( __FILE__ ) . '/../vendor/autoload.php';

  if (isset($_POST['submit'])) {
  
    $email = trim($_POST['email']);

    if ($email == "") {

      $msg = "Please check your inputs!";
    
    } else {
    
      $sql = "SELECT id FROM sch_verify_email WHERE email='$email'";
      $count  = $object->fetch_all($sql);
    
      if (count($count) > 0) {
    
        $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789';
        $token = str_shuffle($token);
        $token = substr($token, 0, 10);

        $verifyEmail = "UPDATE `sch_verify_email` SET `code`='".$token."', `job_type`='".$_SESSION['type']."' WHERE `email`='".$email."'";

        $object->add($verifyEmail);

        $message = file_get_contents(''.$halaman->base_path().'emailtemplates/token.html');
        $message = str_replace("%token%", $token, $message);

        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0;    
        $mail->isSMTP();                         
        $mail->Host = 'smtp.mailtrap.io'; 
        $mail->SMTPAuth = true;                      
        $mail->Username = 'a1526266572f65';   
        $mail->Password = '49a15dc8363a34';                
        $mail->SMTPSecure = 'tls';                         
        $mail->Port = 2525;          

        $mail->setFrom('demo@essentials.id', 'Soechi Recruitment');
        $mail->addAddress($email);
        $mail->Subject = "[no-reply] Please verify your email!";
        $mail->MsgHTML($message);

        if ($mail->send()) {
            echo "<script> window.location.assign('".$object->base_path()."excrew-verify-code');</script>";
            $_SESSION['email'] = $email;
        }else {
            $msg = "Something wrong happened! Please try again!";
      }
    
      } else {
        $token = 'qwertzuiopasdfghjklyxcvbnmQWERTZUIOPASDFGHJKLYXCVBNM0123456789';
        $token = str_shuffle($token);
        $token = substr($token, 0, 10);

        $verifyEmail = "INSERT INTO `sch_verify_email` SET `email`='".$email."', `code`='".$token."', `job_type`='".$_SESSION['type']."'";

        $object->add($verifyEmail);

        $message = file_get_contents(''.$halaman->base_path().'emailtemplates/token.html');
        $message = str_replace("%token%", $token, $message);

        $mail = new PHPMailer(true);

        $mail->SMTPDebug = 0;    
        $mail->isSMTP();                         
        $mail->Host = 'smtp.mailtrap.io'; 
        $mail->SMTPAuth = true;                      
        $mail->Username = 'a1526266572f65';   
        $mail->Password = '49a15dc8363a34';                
        $mail->SMTPSecure = 'tls';                         
        $mail->Port = 2525;          

        $mail->setFrom('demo@essentials.id', 'Soechi Recruitment');
        $mail->addAddress($email);
        $mail->Subject = "[no-reply] Please verify your email!";
        $mail->MsgHTML($message);

        if ($mail->send()) {
            echo "<script> window.location.assign('".$object->base_path()."excrew-verify-code');</script>";
            $_SESSION['email'] = $email;
        }else {
            $msg = "Something wrong happened! Please try again!";
      }
    }
  }
}
  ?>
 <style>
     .form-control {
        font-size: small!important;
      }
     .col-form-label {
        font-size: small;
      }
   </style>

    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">

        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h5>PLEASE VERIFY YOUR EMAIL</h5>
        </div> 
        <div class="col-md-4 offset-md-4" style="margin-bottom: 50px;margin-top: 10px;">
              
            <?php if ($msg != ""): ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span style="font-size: small;"><?php echo $msg ?></span>
              </div> 
            <?php endif;?>

            <form method="post" >
              
              <input class="form-control" name="email" type="email" placeholder="Email..." required>
              <span style="font-size: 10px;">*make sure your email is valid, verification code will be sent to your email</span><br>
              <input class="btn btn-primary btn-sm" type="submit" name="submit" value="SUBMIT" style="padding: 0.25rem 0.5rem;font-size: 0.875rem !important;line-height: 1.5 !important;border-radius: 0rem !important;">

            </form>
            
        </div>

    </div>
  </div>
