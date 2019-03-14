  <?php

	  if(isset($_POST['_publish'])) { 
	    $namatable = 'sch_master_vessel';
	    $data = array(
	      'name'=>$_POST['name'],
	      'short_name'=>$_POST['shortName'],
	      'vessel_type'=>$_POST['vesselType'],
	      'vessel_flag'=>$_POST['vesselFlag']
	    ); 
	    $insert = $object->tambahdata($namatable,$data);
	    $object->messagesin($insert);
	    echo "<script> window.location.assign('".$object->base_path()."master-vessel');</script>";
	        
	  }

	   if(isset($_POST['_update'])){ 
        $namatable = 'sch_master_vessel';
        $data = array(
          'name'=>$_POST['name'],
	      'short_name'=>$_POST['shortName'],
	      'vessel_type'=>$_POST['vesselType'],
	      'vessel_flag'=>$_POST['vesselFlag']
      );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Data has been updated successfully.':'Some problem occurred, please try again.';
        @$msg = $_SESSION['statusMsg'] = $statusMsg;
        echo "<script> window.location.assign('".$object->base_path()."master-vessel'); </script>";
    }

?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item active">Vessel</li>

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
				<h4 style="text-align: center">VESSEL</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">
						<span class="btn btn-flat btn-primary" data-toggle="modal" data-target="#addVessel">ADD VESSEL</span>
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
								<td style="font-weight: bold;">Vessel Type</td>
								<td style="font-weight: bold;">Vessel Flag</td>
								<td style="font-weight: bold;">Modified</td>
								<td style="font-weight: bold;">Action</td>
							</tr>
						</thead>
						<tbody>
							<?php 
						    	$sql = "SELECT * FROM sch_master_vessel";
								$usr = $object->fetch_all($sql);
								if (count($usr) > 0) {
									$number = 1;
									foreach ($usr as $job) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $job['name'] ?></td>
								<td><?= $job['short_name'] ?></td>
								<td><?= $job['vessel_type'] ?></td>
								<td><?= $job['vessel_flag'] ?></td>
								<td><?= $job['modified'] ?></td>
								<td align="center">
									<span class="btn btn-flat btn-primary btn-sm" data-toggle="modal" data-target="#editCrew<?php echo $job['id']?>"><i class="fa fa-edit"></i></span>
									<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-vessel/<?php echo $job['id']?>" onclick="return confirm('Confirm delete ?')">
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
						                      <label class="col-md-4 col-form-label" for="vesselType">Vessel Type</label>
						                      <div class="col-md-8">
						                        <select name="vesselType" id="vesselType" class="form-control">
						                          <option selected>- Choose Vessel Type -</option>
						                          <option value="CRUDE TANKER" <?php if($job['vessel_type'] == "CRUDE TANKER"){echo "selected";} ?> >CRUDE TANKER</option>
						                          <option value="GAS CARRIER" <?php if($job['vessel_type'] == "GAS CARRIER"){echo "selected";} ?> >GAS CARRIER</option>
						                          <option value="PRODUCT OIL TANKER" <?php if($job['vessel_type'] == "PRODUCT OIL TANKER"){echo "selected";} ?> >PRODUCT OIL TANKER</option>
						                          <option value="CHEMICAL TANKER" <?php if($job['vessel_type'] == "CHEMICAL TANKER"){echo "selected";} ?> >CHEMICAL TANKER</option>
						                          <option value="LPG" <?php if($job['vessel_type'] == "LPG"){echo "selected";} ?> >LPG</option>
						                          
						                        </select>
						                      </div>
						                     </div>

						                     <div class="form-group row">
								              <label for="vesselFlag" class="col-sm-4 col-form-label">Vessel Flag</label>
								              <div class="col-sm-8">
								                <select class="form-control" id="vesselFlag" name="vesselFlag" required>
								                  <option selected disabled>- Choose Vessel Flag -</option>
								                  <?php $sql = "SELECT * FROM sch_countries ORDER BY en_short_name ASC";
								                        $countries = $object->fetch_all($sql);
								                          foreach ($countries as $nation) {
								                          $nameCountry = strtoupper($nation['en_short_name']);?>

								                  <option value="<?= $nameCountry ?>" <?php if($job['vessel_flag'] == $nameCountry ){echo "selected";} ?>><?= $nameCountry ?></option>
								                  <?php } ?>
								                </select>
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
	<div class="modal" id="addVessel" tabindex="-1" role="dialog" aria-labelledby="addVessel" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Vessel</h5>
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
                      <label class="col-md-4 col-form-label" for="vesselType">Vessel Type</label>
                      <div class="col-md-8">
                        <select name="vesselType" id="vesselType" class="form-control">
                          <option selected>- Choose Vessel Type -</option>
                          <option value="CRUDE TANKER">CRUDE TANKER</option>
                          <option value="GAS CARRIER">GAS CARRIER</option>
                          <option value="PRODUCT OIL TANKER">PRODUCT OIL TANKER</option>
                          <option value="CHEMICAL TANKER">CHEMICAL TANKER</option>
                          <option value="LPG">LPG</option>
                          
                        </select>
                      </div>
                     </div>

                     <div class="form-group row">
	                  <label for="vesselFlag" class="col-sm-4 col-form-label">Vessel Flag</label>
	                  <div class="col-sm-8">
	                    <select class="form-control" id="vesselFlag" name="vesselFlag" required>
	                      <option selected disabled>- Choose Vessel Flag -</option>
	                      <?php $sql = "SELECT * FROM sch_countries ORDER BY en_short_name ASC";
	                            $countries = $object->fetch_all($sql);
	                              foreach ($countries as $nation) {
	                              $nameCountry = strtoupper($nation['en_short_name']);?>

	                      <option value="<?= $nameCountry ?>"><?= $nameCountry ?></option>
	                      <?php } ?>
	                    </select>
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