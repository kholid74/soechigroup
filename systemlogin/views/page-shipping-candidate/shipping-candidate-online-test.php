<?php 

  /*Number of Crew Applied Pending Review*/
  $sql1   = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='PENDING_REVIEW'";
  $show1  = $object->fetch_all($sql1);
  $count1 = count($show1); 

  /*Number of Shortlisted for Interview*/
  $sql2   = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='SHORTLISTED'";
  $show2  = $object->fetch_all($sql2);
  $count2 = count($show2);

  /*Reject Review*/
  $sql3   = "SELECT a.*,b.status FROM sch_candidate_shipping a JOIN sch_cand_shipping_status b ON a.candidate_code=b.candidate_code WHERE b.status='REJECT_MANAGER_DECISION' OR b.status='REJECTED'";
  $show3  = $object->fetch_all($sql3);
  $count3 = count($show3);

  /*Interview Schedule Approve and Online Test*/
  $test   = "SELECT a.*, b.first_name,b.last_name,b.email,b.candidate_code, c.id_job_name, d.status FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate=b.id JOIN sch_job_shipping c ON b.id_job=c.id JOIN sch_cand_shipping_status d ON b.candidate_code=d.candidate_code WHERE a.category='shipping' AND d.status='SHORTLISTED'";
  $showtest  = $object->fetch_all($test);
  $countest = count($showtest); 

  /*INTERVIEW PASSED*/
  $sql4   = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='INTERVIEW_PASS'";
  $show4  = $object->fetch_all($sql4);
  $count4 = count($show4);

  /*INTERVIEW FAILED*/
  $sql5   = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='INTERVIEW_FAIL'";
  $show5  = $object->fetch_all($sql5);
  $count5 = count($show5);

  /*REFUSE JOINED*/
  $sql6   = "SELECT a.*,b.status FROM sch_candidate_shipping a JOIN sch_cand_shipping_status b ON a.candidate_code=b.candidate_code WHERE b.status='REFUSE_JOINED'";
  $show6  = $object->fetch_all($sql6);
  $count6 = count($show5);

  /*JOINED*/
  $sql7   = "SELECT a.*,b.status FROM sch_candidate_shipping a JOIN sch_cand_shipping_status b ON a.candidate_code=b.candidate_code WHERE b.status='JOINED'";
  $show7  = $object->fetch_all($sql7);
  $count7 = count($show7);


  if(isset($_POST['_sendTest'])){

  	  $namatable = 'sch_interview_schedule';
	    $data = array(
	      'online_test'=>$_POST['status'],
	      'online_test_url'=> $_POST['urlTest']
	  );
	    $conditions = array('id' =>strip_tags($_POST['id']));
	    $statusMsg =  $object->updatedata($namatable,$data,$conditions);

  }

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Shipping</li>
        <li class="breadcrumb-item active">Online Test Candidate</li>

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
				<h4 style="text-align: center">ONLINE TEST CANDIDATE</h4>
				<center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">
						
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
                    <div align="center">
                    	<a href="<?php echo $object->base_path()?>shipping-candidate-pending" class="btn btn-outline-secondary ">
                    		<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING REVIEW
                    	</a>

	                    <a href="<?php echo $object->base_path()?>shipping-candidate-shortlisted" class="btn btn-outline-secondary ">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> SHORTLISTED</a>
	                    
	                    <a href="<?php echo $object->base_path()?>shipping-candidate-rejected" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED</a>
	                    
	                    <a href="<?php echo $object->base_path()?>shipping-candidate-online-test" class="btn btn-outline-secondary active">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $countest; ?></span> ONLINE TEST</a>

	                    <a href="<?php echo $object->base_path()?>shipping-candidate-interview-passed" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count4; ?></span> INTERVIEW PASSED</a>
	                    
	                    <a href="<?php echo $object->base_path()?>shipping-candidate-interview-failed" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count5; ?></span> INTERVIEW FAILED</a>
                    </div>
					<br>

					<form method="post">
	                    <div class="form-inline">
	                        <div class="form-group">
	                          <label>Filter by :&nbsp;</label>
	                            <select class="form-control" name="_jobvac" style="border-radius: 0px;">
	                              <option selected disabled>Job Vacancy</option>
	                              <?php 

	                              	$sql = "SELECT a.*, b.first_name,b.last_name,b.email,b.candidate_code, c.id_job_name, d.status FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate=b.id JOIN sch_job_shipping c ON b.id_job=c.id JOIN sch_cand_shipping_status d ON b.candidate_code=d.candidate_code WHERE a.category='shipping' AND d.status='SHORTLISTED'";
									$jobName = $object->fetch_all($sql);
									foreach ($jobName as $vacancy) {?>

	                               ?>
	                              <option value="<?= $vacancy['name'] ?>"><?= $vacancy['name'] ?></option>

	                             <?php } ?>
	                              
	                            </select>
	                        </div>
	                        &nbsp;&nbsp;
	                        <div class="form-group">
	                            <input type="submit" name="_filterCand" class="btn btn-primary" value="Filter">
	                        </div>
	                        &nbsp;&nbsp;
	                        <div class="form-group">
	                            <a href="" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;RESET FILTER</a>
	                        </div>

	                    </div>
	                </form>

					<br>

				
					<div class="tab-content" id="myTab1Content">
						<br>
						
						<div class="tab-pane fade active show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
							<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
								<thead>
									<tr>
										<td style="font-weight: bold;text-align: center;">No</td>
										<td style="font-weight: bold;text-align: center;">Name</td>
										<td style="font-weight: bold;text-align: center;">Job Position</td>
										<td style="font-weight: bold;text-align: center;">Online Test</td>
										<td style="font-weight: bold;text-align: center;">Action</td>
									</tr>
								</thead>
								<tbody>
									<?php

								    	$sql = "SELECT a.*, b.first_name,b.last_name,b.email,b.candidate_code, c.id_job_name, d.status FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate=b.id JOIN sch_job_shipping c ON b.id_job=c.id JOIN sch_cand_shipping_status d ON b.candidate_code=d.candidate_code WHERE a.category='shipping' AND d.status='SHORTLISTED'"; 
								
										$candidate = $object->fetch_all($sql);
										if (count($candidate) > 0) {
											$number = 1;
											foreach ($candidate as $cand) {

											if(isset($_POST['_filterCand'])){

											$jobVac  = $_POST['_jobvac']; 

									    	$job = "SELECT name FROM sch_master_crewrank WHERE id='".$cand['id_job_name']."' AND name='$jobVac'";

											}else{

												$job = "SELECT name FROM sch_master_crewrank WHERE id='".$cand['id_job_name']."'";
											}

											$jobName = $object->fetch($job);
										
										?>
									<tr>
										<td><?php echo $number;?></td>
										<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
										<td><?= $jobName['name'] ?></td>
										<td align="center">

											<?php if($cand['online_test'] == "off"){echo "<span class='badge badge-danger'>NOT ACTIVE</span>";}elseif($cand['online_test'] == "on"){echo "<span class='badge badge-success'>ACTIVE</span>";} ?>
										</td>
										<td align="center">

											<!-- Modal -->
											<div class="modal" id="sendtest<?= $cand['id_candidate'] ?>" tabindex="-1" role="dialog" aria-labelledby="sendtest" aria-hidden="true">
											  <div class="modal-dialog modal-dialog-centered" role="document">
											    <div class="modal-content">
											      <div class="modal-header">
											        <h5 class="modal-title" id="exampleModalLongTitle">Input URL Test</h5>
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

										                	<div class="row">
										                      <label class="col-md-4 col-form-label">Online Test Status</label>
										                      <div class="col-md-8 col-form-label" align="left">
										                        <div class="form-check">
										                          <input class="form-check-input" type="radio" value="off" id="off" name="status" <?php if($cand['online_test'] == "off"){echo "checked";} ?>>
										                          <label class="form-check-label" for="off">
										                            Not Active
										                          </label>
										                        </div>
										                        <div class="form-check">
										                          <input class="form-check-input" type="radio" value="on" id="on" name="status" <?php if($cand['online_test'] == "on"){echo "checked";} ?>>
										                          <label class="form-check-label" for="on">
										                            Active
										                          </label>
										                        </div>
										                      </div>
										                    </div>

										                    <div class="form-group row">
										                  	<label class="col-md-4 col-form-label" for="urlTest">Insert URL Test</label>
										                  	<div class="col-md-8">
										                    	<input type="text" id="text-input" name="urlTest" class="form-control" value="<?= $cand['online_test_url'] ?>" placeholder="http://">
										 
										                  	</div>
										                   </div>
										                </div>
										              </div>
										          </div>
										             
										            </div>
											      </div>
											      <div class="modal-footer">
											      	<input type="hidden" name="id" value="<?= $cand['id'] ?>">
											        <input type="submit" name="_sendTest" class="btn btn-flat btn-primary" value="SAVE" />
											        </form>
											      </div>
											    </div>
											  </div>
											</div>
										<!-- end modal -->
											
											<span data-toggle="modal" data-target="#sendtest<?= $cand['id_candidate'] ?>" class="btn btn-primary btn-sm"><i class="fa fa-gear"></i>&nbsp;&nbsp;SETTINGS</span>
											<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>shipping-candidate-online-test-detail/<?= $cand['id_candidate'] ?>" title="View <?= $cand['first_name'] ?> <?= $cand['last_name'] ?>">
											<i class="fa fa-eye"></i>&nbsp;VIEW
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
		</div>
	</div>

	