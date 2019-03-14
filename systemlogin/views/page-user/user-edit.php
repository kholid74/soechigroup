  <?php
    $sql  = 'SELECT * FROM sch_user WHERE id="'.$_GET['ids'].'"';
    $data = $object->fetch($sql);
    if (!empty($data)){
    if(isset($_POST['_publish'])){ 
        $namatable = 'sch_user';
        $data = array(
            'name'=>$_POST['_name'],
            'username'=>$_POST['_username'], 
            'email'=>$_POST['_email'],  
            'level'=>$_POST['_role'], 
            'active'=>$_POST['_active'],
      );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Data has been updated successfully.':'Some problem occurred, please try again.';
        @$msg = $_SESSION['statusMsg'] = $statusMsg;
        echo "<script> window.location.assign('".$object->base_path()."user-settings'); </script>";
    }}
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
				<h4 style="text-align: center"><i class="fa fa-user"></i> EDIT USER</h4>
				<div class="col-md-6 offset-md-3">
	              <div class="card">
	             	<div class="card-header"></div>
	                <div class="card-body">
                    <form role="form" method="POST" enctype="multipart/form-data">

                    <div class="form-group row">
                        <label class="col-md-3 col-form-label" for="name">Name</label>
                        <div class="col-md-9">
                          <input type="text" id="text-input" name="_name" class="form-control" placeholder="Enter your name" value="<?= $data['name']?>" required>
                          <span class="help-block"></span>
                        </div>
                       </div>

	                  <div class="form-group row">
                      	<label class="col-md-3 col-form-label" for="username">Username</label>
                      	<div class="col-md-9">
                        	<input type="text" id="username" name="_username" class="form-control" placeholder="Enter your username" onBlur="checkAvailability()" value="<?= $data['username']?>" required>
                        	<span class="help-block" id="user-availability-status"></span>
                      	</div>
                       </div>

	                  <div class="form-group row">
                      	<label class="col-md-3 col-form-label" for="email">Email</label>
                      	<div class="col-md-9">
                        	<input type="email" id="text-input" name="_email" class="form-control" placeholder="Enter your email" value="<?= $data['email']?>" required>
                        	<span class="help-block"></span>
                      	</div>
                       </div>

	                  <div class="form-group row">
                      	<label class="col-md-3 col-form-label" for="email">Password</label>
                      	<div class="col-md-9">
                        	<input type="password" id="text-input" name="_password" class="form-control" placeholder="Enter your password" value="********" disabled>
                        	<span class="help-block"></span>
                      	</div>
                       </div>

					          <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="role">Role</label>
                      <div class="col-md-9">
                        <select id="role" name="_role" class="form-control" required> 
                          <option selected disabled>Select role</option>
                          <option value="1" <?php if($data['level'] == 1){echo "selected";} ?> >Superadmin</option>
                          <option value="2" <?php if($data['level'] == 2){echo "selected";} ?>>Manager</option>
                          <option value="3" <?php if($data['level'] == 3){echo "selected";} ?>>HR</option>
                          <option value="4" <?php if($data['level'] == 4){echo "selected";} ?>>Staff</option>
                          <option value="4" <?php if($data['level'] == 5){echo "selected";} ?>>Security</option>
                        </select>
                      </div>
                    </div>
					         
                   <div class="row">
                      <label class="col-md-3 col-form-label">User Type</label>
                      <div class="col-md-9 col-form-label">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="shipping" id="usrShipping" name="_user_type" <?php if($data['user_type'] == "shipping"){echo "checked";} ?> >
                          <label class="form-check-label" for="usrShipping">
                            Shipping
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="office" id="usrOffice" name="_user_type" <?php if($data['user_type'] == "office"){echo "checked";} ?>>
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
                          <input class="form-check-input" type="radio" value="1" id="activeYes" name="_active" <?php if($data['active'] == 1){echo "checked";} ?>>
                          <label class="form-check-label" for="activeYes">
                            Yes
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="0" id="activeNo" name="_active" <?php if($data['active'] == 0){echo "checked";} ?>>
                          <label class="form-check-label" for="activeNo">
                            No
                          </label>
                        </div>
                      </div>
                    </div>

	                </div>
                  <input type="hidden" name="id" value="<?php echo $data['id']?>">
	                <div class="card-footer">
	                  <input type="submit" name="_publish"  class="btn btn-sm btn-primary" value="UPDATE USER" />
	                </div>
                  </form>
	              </div>
	            </div>
			</div>
		</div>
	</div>