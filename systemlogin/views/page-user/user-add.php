  <?php
  if(isset($_POST['_publish'])) { 
    $namatable = 'sch_user';
    $password  = password_hash($_POST['_password'], PASSWORD_DEFAULT);

    $userCheck   = "SELECT username FROM sch_user WHERE username='".$_POST['_username']."'";
    $usernameCheck   = $object->fetch_all($userCheck);

    $mailCheck    = "SELECT email FROM sch_user WHERE email='".$_POST['_email']."'";
    $emailCheck   = $object->fetch_all($mailCheck);

    if(count($usernameCheck) > 0){
        
        echo "<script>alert('Username already exist !')</script>";
        echo "<script> window.location.assign('".$object->base_path()."add-user');</script>";

    }else if(count($emailCheck) > 0){ 
        
        echo "<script>alert('Email already exist !')</script>";
        echo "<script> window.location.assign('".$object->base_path()."add-user');</script>";

    }else if(strlen($_POST['_password']) < 8) {

        echo "<script>alert('Password minimum 8 character !')</script>";
        echo "<script> window.location.assign('".$object->base_path()."add-user');</script>";

    }else{
        $data = array(
          'name'=>$_POST['_name'],
          'username'=>$_POST['_username'], 
          'email'=>$_POST['_email'],
          'password'=>$password,  
          'level'=>$_POST['_role'],
          'user_type'=>$_POST['_user_type'], 
          'active'=>$_POST['_active'],
        ); 
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."user-settings');</script>";
    }
        
  }
?>
<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>user-settings">User Settings</a></li>
        <li class="breadcrumb-item active">Add User</li>

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
				<h4 style="text-align: center"><i class="fa fa-user"></i> ADD USER</h4>
				<div class="col-md-6 offset-md-3">
	              <div class="card">
	             	<div class="card-header"></div>
	                <div class="card-body">
                    <form role="form" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="name">Name</label>
                        <div class="col-md-9">
                          <input type="text" id="text-input" name="_name" class="form-control" placeholder="Enter your name" required>
                          <span class="help-block"></span>
                        </div>
                       </div>

	                  <div class="form-group row">
                      	<label class="col-md-3 col-form-label" for="username">Username</label>
                      	<div class="col-md-9">
                        	<input type="text" id="username" name="_username" class="form-control" placeholder="Enter your username" onBlur="checkAvailability()" required>
                        	<span class="help-block" id="user-availability-status"></span>
                          <!-- <p><img src="<?php echo $object->base_path()?>assets/img/ajax-loader.gif" id="loaderIcon" style="display:none" /></p> -->
                      	</div>
                       </div>

	                  <div class="form-group row">
                      	<label class="col-md-3 col-form-label" for="email">Email</label>
                      	<div class="col-md-9">
                        	<input type="email" id="text-input" name="_email" class="form-control" placeholder="Enter your email" required>
                        	<span class="help-block"></span>
                      	</div>
                       </div>

	                  <div class="form-group row">
                      	<label class="col-md-3 col-form-label" for="email">Password</label>
                      	<div class="col-md-9">
                        	<input type="password" id="text-input" name="_password" class="form-control" placeholder="Enter your password" required>
                        	<small><i>* password minimum 8 character</i></small>
                      	</div>
                       </div>

					          <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="role">Role</label>
                      <div class="col-md-9">
                        <select id="role" name="_role" class="form-control" required> 
                          <option selected disabled>Select role</option>
                          <option value="1">Superadmin</option>
                          <option value="2">Manager</option>
                          <option value="3">HR</option>
                          <option value="4">Staff</option>
                          <option value="5">Security</option>
                        </select>
                      </div>
                    </div>
					         
                   <div class="row">
                      <label class="col-md-3 col-form-label">User Type</label>
                      <div class="col-md-9 col-form-label">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="shipping" id="usrShipping" name="_user_type" >
                          <label class="form-check-label" for="usrShipping">
                            Shipping
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="office" id="usrOffice" name="_user_type" checked>
                          <label class="form-check-label" for="usrOffice">
                            Office
                          </label>
                        </div>
                      </div>
                    </div>

					         <div class="row">
                      <label class="col-md-3 col-form-label">Active ?</label>
                      <div class="col-md-9 col-form-label">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="1" id="activeYes" name="_active" >
                          <label class="form-check-label" for="activeYes">
                            Yes
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="0" id="activeNo" name="_active" checked>
                          <label class="form-check-label" for="activeNo">
                            No
                          </label>
                        </div>
                      </div>
                    </div>

                    <!-- <table class="table table-responsive-sm table-bordered table-striped table-sm" id="">
                      <thead>
                        <tr>
                          <td align="center" style="font-weight: bold;">List Menu</td>
                          <td align="center" style="font-weight: bold;">Select</td>
                          <td style="font-weight: bold;">Action</td>
                        </tr>
                      </thead>
                      <tbody>
                        <?php 
                          $sql  = 'SELECT * FROM sch_menu ';
                          $usr = $object->fetch_all($sql);
                          if (count($usr) > 0) {
                            $number = 1;
                            foreach ($usr as $user) {?>
                        <tr>
                          <td><?= $user['menu_name'] ?></td>
                          <td align="center"><input type="checkbox" name="checkboxvar[]" value="<?= $user['id'] ?>"></td>
                        </tr>
                    
                        <?php
                          }}?>
                      </tbody>
                    </table> -->

	                </div>
	                <div class="card-footer">
	                  <input type="submit" name="_publish"  class="btn btn-sm btn-primary" value="ADD USER" />
	                </div>
                  </form>
	              </div>
	            </div>
			</div>
		</div>
	</div>