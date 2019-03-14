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

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Shipping</li>
        <li class="breadcrumb-item active">Interview Passed Candidate</li>

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
				<h4 style="text-align: center">INTERVIEW PASSED</h4>
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
	                    
	                    <a href="<?php echo $object->base_path()?>shipping-candidate-shortlisted" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> SHORTLISTED</a>
	                    
	                    <a href="<?php echo $object->base_path()?>shipping-candidate-rejected" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED</a>

	                    <a href="<?php echo $object->base_path()?>shipping-candidate-online-test" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $countest; ?></span> ONLINE TEST</a>
	                    
	                    <a href="<?php echo $object->base_path()?>shipping-candidate-interview-passed" class="btn btn-outline-secondary active">
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

	                              	$sql = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='SHORTLISTED'";
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
						<div class="tab-pane fade active show" id="pending" role="tabpanel" aria-labelledby="pending-tab">
							<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
								<thead>
									<tr>
										<td style="font-weight: bold;text-align: center;">No</td>
										<td style="font-weight: bold;text-align: center;">Name</td>
										<td style="font-weight: bold;text-align: center;">Job Vacancy</td>
										<td style="font-weight: bold;text-align: center;">Email</td>
										<td style="font-weight: bold;text-align: center;">Status</td>
										<td style="font-weight: bold;text-align: center;">Apply Date</td>
										<td style="font-weight: bold;text-align: center;">Action</td>
									</tr>
								</thead>
								<tbody>
									<?php

										if(isset($_POST['_filterCand'])){

										$jobVac  = $_POST['_jobvac']; 
								    	$sql = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='INTERVIEW_PASS' AND c.name='$jobVac'";

										}else{

											$sql = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='INTERVIEW_PASS'";
										} 
								
								    	
										$candidate = $object->fetch_all($sql);
										if (count($candidate) > 0) {
											$number = 1;
											foreach ($candidate as $cand) {?>
									<tr>
										<td><?php echo $number;?></td>
										<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
										<td><?= $cand['name'] ?></td>
										<td><?= $cand['email'] ?></td>
										<td align="center">
											<span class='badge badge-success'>PASSED</span>
										</td>
										<td><?= $cand['created'] ?></td>
										<td align="center">
											<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>shipping-candidate-interview-passed-detail/<?= $cand['id'] ?>" title="view <?= $cand['first_name'] ?> <?= $cand['last_name'] ?>">
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