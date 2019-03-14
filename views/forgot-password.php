   <?php
   $msg = "";

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
          <h5>Reset your Password</h5>
        </div>
        <div class="col-md-4 offset-md-4" style="margin-bottom: 50px;margin-top: 10px;">
           <?php if ($msg != ""): ?>
              <div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $msg ?>
              </div> 
            <?php endif;?>

            <form method="post" >
              <input class="form-control" name="email" type="email" placeholder="Email..."><br>
              <center><input class="btn btn-primary btn-sm" type="submit" name="submit" value="RESET PASSWORD" style="padding: 0.25rem 0.5rem;font-size: 0.875rem !important;line-height: 1.5 !important;border-radius: 0rem !important;"></center>
            </form>
           
        </div>

    </div>
  </div>
