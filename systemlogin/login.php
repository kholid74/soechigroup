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
  include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../controller/auth-login.php';
  $auth = new auth_login();
  if($auth->is_loggedin()!="")
  {
    $auth->redirect('login');
  }

  if(isset($_POST['login']))
  {
      $username =  stripslashes(strip_tags($_POST['_username']));
      $upass =  stripslashes(strip_tags($_POST['_password']));

      if (strlen($upass) >= 8) {
      if($auth->login($username,$upass)){
          $auth->redirect('main');
      }else{
          $error = "Wrong details !";
      } 
    }else{
        $error = "Please check your username/password !";
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
              <?php endif;
              if(!empty($_SESSION['msg'])){
                    echo 
                      '<div class="alert alert-warning" role="alert">
                        '.$_SESSION['msg'].'
                       </div>';
                    unset($_SESSION['msg']);
                  } 
              ?>
              <h1 style="color: #FFFFFF;">Login</h1>
              <p class="text-muted" style="color: #FFFFFF!important;">Sign In to your account</p>
              <form role="form" method="POST" enctype="multipart/form-data">
                <div class="input-group mb-3">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-user"></i></span>
                </div>
                <input type="text" class="form-control" name="_username"  placeholder="Username" required autocomplete="on">
              </div>
              <div class="input-group mb-4">
                <div class="input-group-prepend">
                  <span class="input-group-text"><i class="icon-lock"></i></span>
                </div>
                <input type="password" class="form-control" name="_password" placeholder="Password" required>
              </div>
              <div class="row">
                <div class="col-6">
                  <input type="submit" class="btn btn-primary px-4" style="color: #034e93;background-color: #e4e5e6;border-color: #e4e5e6;" name="login" value="Login">
                </div>
              </form>
                <div class="col-6 text-right">
                  <a href="forgot_password.php" class="btn btn-link px-0" style="color: #e4e5e6;">Forgot password?</a>
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