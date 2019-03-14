<?php 

	if(isset($_POST['_publish'])) { 
	    $namatable = 'sch_menu';
	    $data = array(
	      'menu_name'=>$_POST['name'],
	      'menu_link'=>$_POST['url'],
	      'menu_for'=>$_POST['_menuFor']
	    ); 
	    $insert = $object->tambahdata($namatable,$data);
	    $object->messagesin($insert);
	    echo "<script> window.location.assign('".$object->base_path()."manage-menu');</script>";
	        
	  }

	  if(isset($_POST['_update'])){ 
        $namatable = 'sch_menu';
        $data = array(
          'menu_name'=>$_POST['name'],
	      'menu_link'=>$_POST['url'],
	      'menu_for'=>$_POST['_menuFor']
      );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Data has been updated successfully.':'Some problem occurred, please try again.';
        @$msg = $_SESSION['statusMsg'] = $statusMsg;
        echo "<script> window.location.assign('".$object->base_path()."manage-menu'); </script>";
    }

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">User Settings</li>
        <li class="breadcrumb-item active">Manage Menu</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <span>You logged as <b><?php if ($authadmin['level'] == 1) { echo "Superadmin";} ?></b></span>
          </div>
        </li>
      </ol>

	<div class="container-fluid">
		<div id="ui-view" style="opacity: 1;">
			<div class="animated fadeIn">
				<h4 style="text-align: center"><i class="fa fa-gear"></i> MANAGE MENU</h4>
				<div class="card">
					<div class="card-header">
						<span class="btn btn-flat btn-primary" data-toggle="modal" data-target="#addMenu">ADD MENU</span>
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
								<td style="font-weight: bold;">Menu Name</td>
								<td style="font-weight: bold;">URL</td>
								<td style="font-weight: bold;">Menu For</td>
								<td style="font-weight: bold;">Action</td>
							</tr>
						</thead>
						<tbody>
							<?php 
						    	$sql = "SELECT * FROM sch_menu ORDER BY menu_for ASC";
								$usr = $object->fetch_all($sql);
								if (count($usr) > 0) {
									$number = 1;
									foreach ($usr as $user) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $user['menu_name'] ?></td>
								<td><?= $user['menu_link'] ?></td>
								<td><?= $user['menu_for'] ?></td>
								<td align="center">

									<span class="btn btn-flat btn-primary btn-sm" data-toggle="modal" data-target="#editMenu<?php echo $user['id']?>"><i class="fa fa-edit"></i></span>

									<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-menu/<?php echo $user['id']?>" onclick="return confirm('Confirm delete ?')" >
									<i class="fa fa-trash-o "></i>
									</a>
								
								</td>
							</tr>

							<!-- Modal -->
							<div class="modal" id="editMenu<?php echo $user['id']?>" tabindex="-1" role="dialog" aria-labelledby="editMenu<?php echo $user['id']?>" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Edit Crew Rank</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							       <div class="modal-body">
						              <form role="form" method="POST" enctype="multipart/form-data">
						              <div class="container-fluid">
						              <div class="row">

						                <div class="col-md-12">

						                	 <div class="form-group row">
							                  <label class="col-md-4 col-form-label" for="name">Menu Name</label>
							                  <div class="col-md-8">
							                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['menu_name'] ?>" required>
							                  </div>
							                 </div>

							                 <div class="form-group row">
							                  <label class="col-md-4 col-form-label" for="url">URL</label>
							                  <div class="col-md-8">
							                    <input type="text" class="form-control" id="url" name="url" value="<?= $user['menu_link'] ?>" required>
							                  </div>
							                 </div>

						                     <div class="row">
						                      <label class="col-md-3 col-form-label">Menu For</label>
						                      <div class="col-md-9 col-form-label">
						                        <div class="form-check">
						                          <input class="form-check-input" type="radio" value="shipping" id="shipping" name="_menuFor" <?php if($user['menu_for'] == "shipping")echo "checked"; ?>>
						                          <label class="form-check-label" for="shipping">
						                            Shipping
						                          </label>
						                        </div>
						                        <div class="form-check">
						                          <input class="form-check-input" type="radio" value="office" id="office" name="_menuFor" <?php if($user['menu_for'] == "office")echo "checked"; ?>>
						                          <label class="form-check-label" for="office">
						                            Office
						                          </label>
						                        </div>
						                      </div>
						                    </div>

						                </div>
						              </div>
						          </div>
						             
						            </div>
							      </div>
							      <div class="modal-footer">
							      	<input type="hidden" name="id" value="<?= $user['id'] ?>">
							        <input type="submit" name="_update" class="btn btn-flat btn-primary" value="UPDATE" />
							        </form>
							      </div>
							    </div>
							  </div>
							</div>
						<!-- end modal -->

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

		<!-- Modal -->
	<div class="modal" id="addMenu" tabindex="-1" role="dialog" aria-labelledby="crewRank" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Menu</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <div class="modal-body">
              <form role="form" method="POST" enctype="multipart/form-data">
              <div class="container-fluid">
              <div class="row">

                <div class="col-md-12">

                   <div class="form-group row">
	                  <label class="col-md-4 col-form-label" for="name">Menu Name</label>
	                  <div class="col-md-8">
	                    <input type="text" class="form-control" id="name" name="name" required>
	                  </div>
	                 </div>

	                 <div class="form-group row">
	                  <label class="col-md-4 col-form-label" for="url">URL</label>
	                  <div class="col-md-8">
	                    <input type="text" class="form-control" id="url" name="url" required>
	                  </div>
	                 </div>

                     <div class="row">
                      <label class="col-md-3 col-form-label">Menu For</label>
                      <div class="col-md-9 col-form-label">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="shipping" id="shipping" name="_menuFor" checked>
                          <label class="form-check-label" for="shipping">
                            Shipping
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="office" id="office" name="_menuFor">
                          <label class="form-check-label" for="office">
                            Office
                          </label>
                        </div>
                      </div>
                    </div>

                </div>
              </div>
          </div>
             
            </div>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" name="_publish" class="btn btn-flat btn-primary" value="SAVE" />
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
<!-- end modal -->