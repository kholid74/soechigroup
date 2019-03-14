<?php 

  /*PENDING REVIEW*/
  $sql1   = "SELECT * FROM sch_candidate_office WHERE status='0'";
  $show1  = $object->fetch_all($sql1);
  $count1 = count($show1); 

  /*SHORTLIST*/
  $sql2   = "SELECT * FROM sch_candidate_office WHERE status='1'";
  $show2  = $object->fetch_all($sql2);
  $count2 = count($show2);

  /*REJECT REVIEW*/
  $sql3   = "SELECT * FROM sch_candidate_office WHERE status='2'";
  $show3  = $object->fetch_all($sql3);
  $count3 = count($show3);

  /*INTERVIEW PASSED*/
  $sql4   = "SELECT * FROM sch_candidate_office WHERE status='4'";
  $show4  = $object->fetch_all($sql4);
  $count4 = count($show4);

  /*INTERVIEW FAILED*/
  $sql5   = "SELECT * FROM sch_candidate_office WHERE status='5'";
  $show5  = $object->fetch_all($sql5);
  $count5 = count($show5);

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Office</li>
        <li class="breadcrumb-item active">Pending Candidate</li>

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
				<h4 style="text-align: center">PENDING CANDIDATE</h4>
				<center><span style="font-size: 15px;">SOECHI LINES</span></center>
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
                    	<a href="<?php echo $object->base_path()?>office-candidate-pending" class="btn btn-outline-secondary active">
                    		<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING REVIEW
                    	</a>
	                    <a href="<?php echo $object->base_path()?>office-candidate-shortlisted" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> SHORTLISTED</a>
	                    <a href="<?php echo $object->base_path()?>office-candidate-rejected" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED</a>
	                    <a href="<?php echo $object->base_path()?>office-candidate-interview-passed" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count4; ?></span> INTERVIEW PASSED</a>
	                    <a href="<?php echo $object->base_path()?>office-candidate-interview-failed" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count5; ?></span> INTERVIEW FAILED</a>
                    </div>
					<br>

					<form method="post">
		                <div class="form-inline" align="center">
		                    <div class="form-group">
		                        <select class="form-control" name="_jobTitle" style="border-radius: 0px;">
		                          <option selected disabled>Filter by Vacancy</option>
		                          <?php 

		                          	$jobtitle = "SELECT job_title FROM sch_job_office";
		                          	$job =$object->fetch_all($jobtitle);
									foreach ($job as $showJob){

		                           ?>
		                          <option value="<?= $showJob['job_title'] ?>"><?= $showJob['job_title'] ?></option>
		                          <?php } ?>
		                        </select>
		                    </div>
		                    &nbsp;
		                    <div class="form-group">
		                        <input type="submit" name="_filterJob" class="btn btn-success" value="Filter">
		                    </div>
							&nbsp;
		                    <div class="form-group">
		                        <a href="<?php echo $object->base_path()?>office-candidate-pending" class="btn btn-success"><i class="fa fa-refresh"></i>&nbsp;Reset Filter</a>
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

										if(isset($_POST['_filterJob'])){

							                $jobtitle  = $_POST['_jobTitle'];

							                $sql = "SELECT a.*,b.job_title FROM sch_candidate_office a JOIN sch_job_office b ON a.id_job = b.id WHERE a.status='0' OR a.status='3' AND b.job_title='$jobtitle'";
							                
							                $fetchAll = $object->fetch_all($sql);
							                $rows = count($fetchAll);
							                
							                echo '<p><b>'.$rows.'</b> result of <b>'.$_POST['_jobTitle'].'</b></p>';
						                
						                }else{

						                	$sql = "SELECT a.*,b.job_title FROM sch_candidate_office a JOIN sch_job_office b ON a.id_job = b.id WHERE a.status='0' OR a.status='3'";

						                } 
								    	
										$candidate = $object->fetch_all($sql);
										if (count($candidate) > 0) {
											$number = 1;
											foreach ($candidate as $cand) {?>
									<tr>
										<td><?php echo $number;?></td>
										<td><?= $cand['full_name'] ?></td>
										<td><?= $cand['job_title'] ?></td>
										<td><?= $cand['email'] ?></td>
										<td align="center">
											<?php if ($cand['status'] == 0) {
												echo "<span class='badge badge-warning'>PENDING REVIEW</span>";
											}elseif($cand['status'] == 3){
												echo "<span class='badge badge-dark'>WAITING MANAGER DECISION</span>";
											} ?>
										</td>
										<td><?= $cand['created'] ?></td>
										<td align="center">
											<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>office-candidate-pending-details/<?= $cand['id'] ?>" title="View <?= $cand['full_name'] ?>">
											<i class="fa fa-eye"></i>&nbsp;VIEW
											</a>
											<a class="btn btn-primary btn-sm" href="<?php echo $object->base_path()?>office-candidate-print/<?= $cand['id'] ?>" target="_blank" title="Print <?= $cand['full_name'] ?>">
											<i class="fa fa-print"></i>&nbsp;PRINT
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