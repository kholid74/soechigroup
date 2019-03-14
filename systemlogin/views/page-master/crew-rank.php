  <?php

	  if(isset($_POST['_publish'])) { 
	    $namatable = 'sch_master_crewrank';
	    $data = array(
	      'name'=>$_POST['name'],
	      'short_name'=>$_POST['shortName'],
	      'category'=>$_POST['category'],
	      'deck_engine'=>$_POST['_deckEngine']
	    ); 
	    $insert = $object->tambahdata($namatable,$data);
	    $object->messagesin($insert);
	    echo "<script> window.location.assign('".$object->base_path()."master-crew-rank');</script>";
	        
	  }

	   if(isset($_POST['_update'])){ 
        $namatable = 'sch_master_crewrank';
        $data = array(
          'name'=>$_POST['name'],
	      'short_name'=>$_POST['shortName'],
	      'category'=>$_POST['category'],
	      'deck_engine'=>$_POST['_deckEngine']
      );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Data has been updated successfully.':'Some problem occurred, please try again.';
        @$msg = $_SESSION['statusMsg'] = $statusMsg;
        echo "<script> window.location.assign('".$object->base_path()."master-crew-rank'); </script>";
    }

?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item active">Crew Rank</li>

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
				<h4 style="text-align: center">CREW RANK</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">
						<span class="btn btn-flat btn-primary" data-toggle="modal" data-target="#crewRank">ADD CREW RANK</span>
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
								<td style="font-weight: bold;">Short Name</td>
								<td style="font-weight: bold;">Category</td>
								<td style="font-weight: bold;">Deck Engine</td>
								<td style="font-weight: bold;">Modified</td>
								<td style="font-weight: bold;">Action</td>
							</tr>
						</thead>
						<tbody>
							<?php 
						    	$sql = "SELECT * FROM sch_master_crewrank";
								$usr = $object->fetch_all($sql);
								if (count($usr) > 0) {
									$number = 1;
									foreach ($usr as $job) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $job['name'] ?></td>
								<td><?= $job['short_name'] ?></td>
								<td><?= $job['category'] ?></td>
								<td><?= $job['deck_engine'] ?></td>
								<td><?= $job['modified'] ?></td>
								<td align="center">
									<span class="btn btn-flat btn-primary btn-sm" data-toggle="modal" data-target="#editCrew<?php echo $job['id']?>"><i class="fa fa-edit"></i></span>
									<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-crew-rank/<?php echo $job['id']?>" onclick="return confirm('Confirm delete ?')">
									<i class="fa fa-trash-o "></i>
									</a>
								</td>
							</tr>

							<!-- Modal -->
							<div class="modal" id="editCrew<?php echo $job['id']?>" tabindex="-1" role="dialog" aria-labelledby="editCrew<?php echo $job['id']?>" aria-hidden="true">
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
							                  <label class="col-md-4 col-form-label" for="name">Name</label>
							                  <div class="col-md-8">
							                    <input type="text" class="form-control" id="name" name="name" value="<?= $job['name'] ?>" required>
							                  </div>
							                 </div>

							                 <div class="form-group row">
							                  <label class="col-md-4 col-form-label" for="shortName">Short Name</label>
							                  <div class="col-md-8">
							                    <input type="text" class="form-control" id="shortName" name="shortName" value="<?= $job['short_name'] ?>" required>
							                  </div>
							                 </div>

						                     <div class="form-group row">
						                      <label class="col-md-4 col-form-label" for="category">Category</label>
						                      <div class="col-md-8">
						                        <select name="category" id="category" class="form-control">
						                          <option selected>- Choose Category -</option>
						                          <option value="Deck Officer" <?php if($job['category'] == "Deck Officer")echo "selected"; ?>>Deck Officer</option>
						                          <option value="Deck Officer Junior" <?php if($job['category'] == "Deck Officer Junior")echo "selected"; ?>>Deck Officer Junior</option>
						                          <option value="Deck Officer Senior" <?php if($job['category'] == "Deck Officer Senior")echo "selected"; ?>>Deck Officer Senior</option>
						                          <option value="Deck Rating" <?php if($job['category'] == "Deck Rating")echo "selected"; ?>>Deck Rating</option>
						                          <option value="Deck Rating Senior" <?php if($job['category'] == "Deck Rating Senior")echo "selected"; ?>>Deck Rating Senior</option>
						                          <option value="Engine Officer" <?php if($job['category'] == "Engine Officer")echo "selected"; ?>>Engine Officer</option>
						                          <option value="Engine Officer Trainee" <?php if($job['category'] == "Engine Officer Trainee")echo "selected"; ?>>Engine Officer Trainee</option>
						                          <option value="Engine Officer Junior" <?php if($job['category'] == "Engine Officer Junior")echo "selected"; ?>>Engine Officer Junior</option>
						                          <option value="Engine Officer Senior" <?php if($job['category'] == "Engine Officer Senior")echo "selected"; ?>>Engine Officer Senior</option>
						                          <option value="Engine Rating" <?php if($job['category'] == "Engine Rating")echo "selected"; ?>>Engine Rating</option>
						                        </select>
						                      </div>
						                     </div>

						                     <div class="row">
						                      <label class="col-md-3 col-form-label">Deck/Engine</label>
						                      <div class="col-md-9 col-form-label">
						                        <div class="form-check">
						                          <input class="form-check-input" type="radio" value="Deck" id="deck" name="_deckEngine" <?php if($job['deck_engine'] == "Deck")echo "checked"; ?>>
						                          <label class="form-check-label" for="deck">
						                            Deck
						                          </label>
						                        </div>
						                        <div class="form-check">
						                          <input class="form-check-input" type="radio" value="Engine" id="engine" name="_deckEngine" <?php if($job['deck_engine'] == "Engine")echo "checked"; ?>>
						                          <label class="form-check-label" for="engine">
						                            Engine
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
							      	<input type="hidden" name="id" value="<?= $job['id'] ?>">
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
	<div class="modal" id="crewRank" tabindex="-1" role="dialog" aria-labelledby="crewRank" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Crew Rank</h5>
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
	                  <label class="col-md-4 col-form-label" for="name">Name</label>
	                  <div class="col-md-8">
	                    <input type="text" class="form-control" id="name" name="name" required>
	                  </div>
	                 </div>

	                 <div class="form-group row">
	                  <label class="col-md-4 col-form-label" for="shortName">Short Name</label>
	                  <div class="col-md-8">
	                    <input type="text" class="form-control" id="shortName" name="shortName" required>
	                  </div>
	                 </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="category">Category</label>
                      <div class="col-md-8">
                        <select name="category" id="category" class="form-control">
                          <option selected>- Choose Category -</option>
                          <option value="Deck Officer">Deck Officer</option>
                          <option value="Deck Officer Junior">Deck Officer Junior</option>
                          <option value="Deck Officer Senior">Deck Officer Senior</option>
                          <option value="Deck Rating">Deck Rating</option>
                          <option value="Deck Rating Senior">Deck Rating Senior</option>
                          <option value="Engine Officer">Engine Officer</option>
                          <option value="Engine Officer Trainee">Engine Officer Trainee</option>
                          <option value="Engine Officer Junior">Engine Officer Junior</option>
                          <option value="Engine Officer Senior">Engine Officer Senior</option>
                          <option value="Engine Rating">Engine Rating</option>
                        </select>
                      </div>
                     </div>

                     <div class="row">
                      <label class="col-md-4 col-form-label">Deck/Engine</label>
                      <div class="col-md-8 col-form-label">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Deck" id="deck" name="_deckEngine" checked>
                          <label class="form-check-label" for="deck">
                            Deck
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Engine" id="engine" name="_deckEngine">
                          <label class="form-check-label" for="engine">
                            Engine
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