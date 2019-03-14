<?php 
  /*PENDING REVIEW*/
  $sql1   = "SELECT * FROM sch_candidate_shipping WHERE status='0'";
  $show1  = $object->fetch_all($sql1);
  $count1 = count($show1); 

  /*SHORTLIST*/
  $sql2   = "SELECT * FROM sch_candidate_shipping WHERE status='1'";
  $show2  = $object->fetch_all($sql2);
  $count2 = count($show2);

  /*REJECT REVIEW*/
  $sql3   = "SELECT * FROM sch_candidate_shipping WHERE status='2'";
  $show3  = $object->fetch_all($sql3);
  $count3 = count($show3);

  /*INTERVIEW PASSED*/
  $sql4   = "SELECT * FROM sch_candidate_shipping WHERE status='4'";
  $show4  = $object->fetch_all($sql4);
  $count4 = count($show4);

  /*INTERVIEW FAILED*/
  $sql5   = "SELECT * FROM sch_candidate_shipping WHERE status='5'";
  $show5  = $object->fetch_all($sql5);
  $count5 = count($show5); 

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Shipping</li>
        <li class="breadcrumb-item active">Candidate</li>

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
				<h4 style="text-align: center">CANDIDATE</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
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
					<ul class="nav nav-tabs" id="myTab1" role="tablist">
						<li class="nav-item">
							<a class="nav-link active show" id="pending-tab" data-toggle="tab" href="#pending" role="tab" aria-controls="pending" aria-selected="true">
								<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING REVIEW
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="shortlisted-tab" data-toggle="tab" href="#shortlisted" role="tab" aria-controls="shortlisted" aria-selected="false">
								<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> SHORTLISTED
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="reject-tab" data-toggle="tab" href="#reject" role="tab" aria-controls="reject" aria-selected="false">
								<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="interview-pass-tab" data-toggle="tab" href="#interview-pass" role="tab" aria-controls="interview-pass" aria-selected="false">
								<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count4; ?></span> INTERVIEW PASSED
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link" id="interview-fail-tab" data-toggle="tab" href="#interview-fail" role="tab" aria-controls="interview-fail" aria-selected="false">
								<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count5; ?></span> INTERVIEW FAILED
							</a>
						</li>
					</ul>
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
								    	$sql = "SELECT a.*,b.job_name FROM sch_candidate_shipping a JOIN sch_jobs b ON a.id_job = b.id WHERE a.status='0'";
										$candidate = $object->fetch_all($sql);
										if (count($candidate) > 0) {
											$number = 1;
											foreach ($candidate as $cand) {?>
									<tr>
										<td><?php echo $number;?></td>
										<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
										<td><?= $cand['job_name'] ?></td>
										<td><?= $cand['email'] ?></td>
										<td align="center">
											<?php if ($cand['status'] == 0) {
											echo "<span class='badge badge-warning'>PENDING REVIEW</span>";} ?>
										</td>
										<td><?= $cand['created'] ?></td>
										<td align="center">
											<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>shipping-candidate-details/<?= $cand['id'] ?>" title="view <?= $cand['first_name'] ?> <?= $cand['last_name'] ?>">
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
						<div class="tab-pane fade" id="shortlisted" role="tabpanel" aria-labelledby="shortlisted-tab">
							<table class="table table-responsive-sm table-bordered table-striped table-sm" id="">
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
								    	$sql = "SELECT a.*,b.job_name FROM sch_candidate_shipping a JOIN sch_jobs b ON a.id_job = b.id WHERE a.status='1'";
										$candidate = $object->fetch_all($sql);
										if (count($candidate) > 0) {
											$number = 1;
											foreach ($candidate as $cand) {?>
									<tr>
										<td><?php echo $number;?></td>
										<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
										<td><?= $cand['job_name'] ?></td>
										<td><?= $cand['email'] ?></td>
										<td align="center">
											<?php if ($cand['status'] == 1) {
											echo "<span class='badge badge-success'>SHORTLISTED</span>";} ?>
										</td>
										<td><?= $cand['created'] ?></td>
										<td align="center">
											<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>shortlisted-candidate/<?= $cand['id'] ?>" title="view <?= $cand['first_name'] ?> <?= $cand['last_name'] ?>">
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
						<div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="reject-tab">
							<table class="table table-responsive-sm table-bordered table-striped table-sm" id="">
								<thead>
									<tr>
										<td style="font-weight: bold;text-align: center;">No</td>
										<td style="font-weight: bold;text-align: center;">Name</td>
										<td style="font-weight: bold;text-align: center;">Job Vacancy</td>
										<td style="font-weight: bold;text-align: center;">Status</td>
										<td style="font-weight: bold;text-align: center;">Reason</td>
										<td style="font-weight: bold;text-align: center;">Process Date</td>
										<!-- <td style="font-weight: bold;text-align: center;">Action</td> -->
									</tr>
								</thead>
								<tbody>
									<?php 
								    	$sql = "SELECT a.*,b.job_name FROM sch_candidate_shipping a JOIN sch_jobs b ON a.id_job = b.id WHERE a.status='2'";
										$candidate = $object->fetch_all($sql);
										if (count($candidate) > 0) {
											$number = 1;
											foreach ($candidate as $cand) {?>
									<tr>
										<td><?php echo $number;?></td>
										<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
										<td><?= $cand['job_name'] ?></td>
										<td align="center">
											<?php if ($cand['status'] == 2) {
											echo "<span class='badge badge-danger'>REJECTED</span>";} ?>
										</td>
										<td><?= $cand['reason_reject'] ?></td>
										<td><?= $cand['created'] ?></td>
										<!-- <td align="center">
											<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>view-candidate/<?= $cand['id'] ?>" title="view <?= $cand['first_name'] ?> <?= $cand['last_name'] ?>">
											<i class="fa fa-eye"></i>&nbsp;VIEW
											</a>
										</td> -->
									</tr>
									<?php
							    	$number++;
							    	}}?>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="interview-pass" role="tabpanel" aria-labelledby="interview-pass-tab">
							<table class="table table-responsive-sm table-bordered table-striped table-sm" id="">
								<thead>
									<tr>
										<td style="font-weight: bold;text-align: center;">No</td>
										<td style="font-weight: bold;text-align: center;">Name</td>
										<td style="font-weight: bold;text-align: center;">Job Vacancy</td>
										<td style="font-weight: bold;text-align: center;">Status</td>
										<td style="font-weight: bold;text-align: center;">Process Date</td>
										<td style="font-weight: bold;text-align: center;">Action</td>
									</tr>
								</thead>
								<tbody>
									<?php 
								    	$sql = "SELECT a.*,b.job_name FROM sch_candidate_shipping a JOIN sch_jobs b ON a.id_job = b.id WHERE a.status='4'";
										$candidate = $object->fetch_all($sql);
										if (count($candidate) > 0) {
											$number = 1;
											foreach ($candidate as $cand) {?>
									<tr>
										<td><?php echo $number;?></td>
										<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
										<td><?= $cand['job_name'] ?></td>
										<td align="center">
											<?php if ($cand['status'] == 4) {
											echo "<span class='badge badge-success'>INTERVIEW PASSED</span>";} ?>
										</td>
										<td><?= $cand['created'] ?></td>
										<!-- <td align="center">
											<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>view-candidate/<?= $cand['id'] ?>" title="view <?= $cand['first_name'] ?> <?= $cand['last_name'] ?>">
											<i class="fa fa-eye"></i>&nbsp;VIEW
											</a>
										</td> -->
									</tr>
									<?php
							    	$number++;
							    	}}?>
								</tbody>
							</table>
						</div>
						<div class="tab-pane fade" id="interview-fail" role="tabpanel" aria-labelledby="interview-fail-tab">
							<table class="table table-responsive-sm table-bordered table-striped table-sm" id="">
								<thead>
									<tr>
										<td style="font-weight: bold;text-align: center;">No</td>
										<td style="font-weight: bold;text-align: center;">Name</td>
										<td style="font-weight: bold;text-align: center;">Job Vacancy</td>
										<td style="font-weight: bold;text-align: center;">Status</td>
										<td style="font-weight: bold;text-align: center;">Reason</td>
										<td style="font-weight: bold;text-align: center;">Process Date</td>
										<!-- <td style="font-weight: bold;text-align: center;">Action</td> -->
									</tr>
								</thead>
								<tbody>
									<?php 
								    	$sql = "SELECT a.*,b.job_name FROM sch_candidate_shipping a JOIN sch_jobs b ON a.id_job = b.id WHERE a.status='5'";
										$candidate = $object->fetch_all($sql);
										if (count($candidate) > 0) {
											$number = 1;
											foreach ($candidate as $cand) {?>
									<tr>
										<td><?php echo $number;?></td>
										<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
										<td><?= $cand['job_name'] ?></td>
										<td align="center">
											<?php if ($cand['status'] == 5) {
											echo "<span class='badge badge-danger'>INTERVIEW FAILED</span>";} ?>
										</td>
										<td><?= $cand['reason_reject'] ?></td>
										<td><?= $cand['created'] ?></td>
										<!-- <td align="center">
											<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>view-candidate/<?= $cand['id'] ?>" title="view <?= $cand['first_name'] ?> <?= $cand['last_name'] ?>">
											<i class="fa fa-eye"></i>&nbsp;VIEW
											</a>
										</td> -->
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