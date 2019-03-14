<?php
if(isset($_POST['publish'])) { 
  $namatable = 'sch_user';
  $upass_1 = stripcslashes(strip_tags($_POST['_old_pass']));
  $upass_2 = stripcslashes(strip_tags($_POST['_new_pass']));
  $upass_3 = stripcslashes(strip_tags($_POST['_repeat_pass']));

  $hashcek = password_hash($upass_1, PASSWORD_DEFAULT);
  $authsql = "SELECT username, password FROM sch_user WHERE username='".$authadmin['username']."' AND password='".$hashcek."'";
  $authcek = $object->fetch($authsql);

  if(count($authcek) == 0){
    $warning = "5";
        $errMSG = "Wrong Current Password!";
  }else{
    if ($upass_2 == $upass_3) {
      if(strlen($upass_3) >= 8){
              $hashpass = password_hash($upass_3, PASSWORD_DEFAULT);
              $data = array('password' =>$hashpass,);
        $conditions = array('id' =>stripcslashes(strip_tags($uid)));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
        if($statusMsg){
                $warning = "1";
                $errMSG = "Password Changed !";
              }else{
                $warning = "2";
                $errMSG = "Failed, password not changed !";
              }
        }else{
              $warning = "3";
              $errMSG = "Password must be more than 8 character..";
          }
      }else{
        $warning = "4";
        $errMSG = "Confirmation Password not match!";
      }
  }
}
?>
<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Account Settings</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <span>You logged as <b><?php echo $object->logged_as($level); ?></b></span>
          </div>
        </li>
      </ol>

	<div class="container-fluid">
		<div id="ui-view" style="opacity: 1;">
			<div class="animated fadeIn">
				<h4 style="text-align: center"><i class="fa fa-gear"></i> ACCOUNT SETTINGS</h4>
				<div class="col-md-6 offset-md-3">
	              <div class="card">
	             	<div class="card-header"></div>
                    <div class="card-body">
                      
                       <?php
                          if(!empty($_SESSION['statusMsg'])){
                              echo '
                                 <div class="alert alert-success" role="alert">
                                  '.$_SESSION['statusMsg'].'
                                 </div>';
                              unset($_SESSION['statusMsg']);
                          }
                        ?>
                  <form role="form" method="POST" enctype="multipart/form-data">
                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="username">Username</label>
                      <div class="col-md-9">
                        <input type="text" id="username" name="username" class="form-control" value="<?= $authadmin['username'] ?>" disabled>
                        <span class="help-block">Username can't be changed</span>
                      </div>
                     </div>

                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="email">Email</label>
                      <div class="col-md-9">
                        <input type="email" id="text-input" name="email" class="form-control" value="<?= $authadmin['email'] ?>" disabled>
                        <span class="help-block">Email can't be changed</span>
                      </div>
                     </div>

                    <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="_old_pass">Old Password</label>
                      <div class="col-md-9">
                        <input type="password" id="_old_pass" name="_old_pass" class="form-control" placeholder="Enter old password" required>
                        <span class="help-block"></span>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="email">New Password</label>
                      <div class="col-md-9">
                        <input type="password" id="_new_pass" name="_new_pass" class="form-control" placeholder="Enter new password" required>
                        <span class="help-block"></span>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="email">Repeat New Password</label>
                      <div class="col-md-9">
                        <input type="password" id="_repeat_pass" name="_repeat_pass" class="form-control" placeholder="Repeat new password" required>
                        <span class="help-block"></span>
                      </div>
                     </div>

                  </div>
                  <div class="card-footer">
                    <input type="submit" name="publish"  class="btn btn-sm btn-primary" value="CHANGE PASSWORD" />
                  </div> 
                  </form>
	              </div>

	            </div>
			</div>
		</div>
	</div>