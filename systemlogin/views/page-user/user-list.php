<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">User Settings</li>

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
				<h4 style="text-align: center"><i class="fa fa-user"></i> USER SETTINGS</h4>
				<div class="card">
					<div class="card-header">
						<a href="<?php echo $object->base_path()?>add-user" class="btn btn-primary"><i class="fa fa-plus "></i>&nbsp;Add New User</a>
						<!-- <a href="<?php echo $object->base_path()?>manage-menu" class="btn btn-primary"><i class="fa fa-gear "></i>&nbsp;Manage Menu</a> -->
					</div>
					
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

					<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
						<thead>
							<tr>
								<td style="font-weight: bold;">No</td>
								<td style="font-weight: bold;">Name</td>
								<td style="font-weight: bold;">Username</td>
								<td style="font-weight: bold;">Role</td>
								<td style="font-weight: bold;">User Type</td>
								<td style="font-weight: bold;">Status</td>
								<!-- <td style="font-weight: bold;">Date Registered</td> -->
								<td style="font-weight: bold;">Action</td>
							</tr>
						</thead>
						<tbody>
							<?php 
						    	$sql = "SELECT * FROM sch_user";
								$usr = $object->fetch_all($sql);
								if (count($usr) > 0) {
									$number = 1;
									foreach ($usr as $user) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $user['name'] ?></td>
								<td><?= $user['username'] ?></td>
								<td><?php if($user['level'] == 1){echo "Superadmin";}else if($user['level'] == 2){echo "Manager";}else if($user['level'] == 3){echo "HR";}else if($user['level'] == 4){echo "Staff";}else if($user['level'] == 5){echo "Security";} ?></td>
								<td><?= $user['user_type'] ?></td>
								<td align="center"><?php if ($user['active'] == 1) {
									echo "<span class='badge badge-success'>Active</span>";}else if ($user['active'] == 0){ echo "<span class='badge badge-dark'>Inactive</span>"; } ?>
								</td>
								<!-- <td><?= $user['created'] ?></td> -->
								<td align="center">
									
									<!-- <a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>menu-role/<?php echo $user['id']?>" style="<?php if($user['level'] == 1){echo "display: none;";}?>" title="Setting Module Menu">
									<i class="fa fa-gear"></i>
									</a> -->

									<a class="btn btn-info btn-sm" href="<?php echo $object->base_path()?>edit-user/<?php echo $user['id']?>" title="Edit User">
									<i class="fa fa-edit"></i>
									</a>

									<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-user/<?php echo $user['id']?>" onclick="return confirm('Confirm delete ?')" <?php if($authadmin['id'] == $user['id']){echo "style='display:none'";} ?> title="Delete User">
									<i class="fa fa-trash-o "></i>
									</a>

								</td>
							</tr>
							<?php
					    	$number++;
					    	}}?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
		</div>
	</div>