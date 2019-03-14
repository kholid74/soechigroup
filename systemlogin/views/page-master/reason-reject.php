  <?php

	  if(isset($_POST['_publish'])) { 
	    $namatable = 'sch_master_reason_reject';
	    $data = array(
	      'reason'=>$_POST['reason']
	    ); 
	    $insert = $object->tambahdata($namatable,$data);
	    $object->messagesin($insert);
	    echo "<script> window.location.assign('".$object->base_path()."master-reason-reject');</script>";
	        
	  }

	   if(isset($_POST['_update'])){ 
        $namatable = 'sch_master_reason_reject';
        $data = array(
          'reason'=>$_POST['reason']
      );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Data has been updated successfully.':'Some problem occurred, please try again.';
        @$msg = $_SESSION['statusMsg'] = $statusMsg;
        echo "<script> window.location.assign('".$object->base_path()."master-reason-reject'); </script>";
    }

?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item active">Reason Reject</li>

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
				<h4 style="text-align: center">REASON REJECT</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">
						<span class="btn btn-flat btn-primary" data-toggle="modal" data-target="#addReject">ADD REJECT REASON</span>
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
								<td style="font-weight: bold;">Reason</td>
								<td style="font-weight: bold;">Modified</td>
								<td style="font-weight: bold;">Action</td>
							</tr>
						</thead>
						<tbody>
							<?php 
						    	$sql = "SELECT * FROM sch_master_reason_reject";
								$usr = $object->fetch_all($sql);
								if (count($usr) > 0) {
									$number = 1;
									foreach ($usr as $job) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $job['reason'] ?></td>
								<td><?= $job['modified'] ?></td>
								<td align="center">
									<span class="btn btn-flat btn-primary btn-sm" data-toggle="modal" data-target="#reason<?php echo $job['id']?>"><i class="fa fa-edit"></i></span>
									<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-reason-reject/<?php echo $job['id']?>" onclick="return confirm('Confirm delete ?')">
									<i class="fa fa-trash-o "></i>
									</a>
								</td>
							</tr>

							<!-- Modal -->
							<div class="modal" id="reason<?php echo $job['id']?>" tabindex="-1" role="dialog" aria-labelledby="reason<?php echo $job['id']?>" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Edit Reject Reason</h5>
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
										   
										   <div class="form-group">
								            <textarea class="form-control" id="message-text" name="reason"><?= $job['reason'] ?></textarea>
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
	<div class="modal" id="addReject" tabindex="-1" role="dialog" aria-labelledby="addReject" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Reject Reason</h5>
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

                   <div class="form-group">
		            <textarea class="form-control" id="message-text" name="reason"></textarea>
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