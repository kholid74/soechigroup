<?php
  
  if (!isset($_SESSION['email'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
       
       }

  $msg = "";

  $mail     = 'SELECT * FROM sch_verify_email WHERE email="'.$_SESSION['email'].'"';
  $showMail = $object->fetch($mail);

 

  if (isset($_POST['submit'])) {
  
    if ($showMail['code'] == $_POST['code']) {

          if ($showMail['job_type'] == "excrew") {
 
              $insertEX = "INSERT INTO sch_ex_candidate SET email='".$showMail['email']."', created='".date("Y-m-d H:i:s")."'";

              if ($object->add($insertEX)) {

                 echo "<script> window.location.assign('".$object->base_path()."excrew-personal-data');</script>";
                 $_SESSION['email'] = $showMail['email'];

              }else {

                $msg = "error";

              }

          }
          
    }else {

      $msg = "Your verification code is invalid! Please try again!";
    
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
          <h5>ENTER YOUR CODE</h5>
        </div>

        <div class="col-md-4 offset-md-4" style="margin-bottom: 50px;margin-top: 10px;">
              <!-- <div class="alert alert-danger">
                  <span style="font-size: small;">*We will send verification code, make sure you have email active</span>
              </div> -->
            <?php if ($msg != ""): ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <span style="font-size: small;"><?php echo $msg ?></span>
              </div> 
            <?php endif;?>

            <form method="post" >
              
              <input class="form-control" name="email" type="email" value="<?= $showMail['email']; ?>" style="margin-bottom: 7px;" readonly>
              <input class="form-control" name="code" type="text" placeholder="Enter your 10 code here" style="margin-bottom: 7px;" required autocomplete="off">
              <input class="btn btn-primary btn-sm" type="submit" name="submit" value="VERIFY" style="padding: 0.25rem 0.5rem;font-size: 0.875rem !important;line-height: 1.5 !important;border-radius: 0rem !important;">
            </form>
            
        </div>

    </div>
  </div>
