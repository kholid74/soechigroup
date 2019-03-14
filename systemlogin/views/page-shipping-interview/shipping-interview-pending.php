<?php
	
    /*PENDING*/
    $sql1   = "SELECT * FROM sch_interview_schedule WHERE category='shipping' AND status='0'";
    $show1  = $object->fetch_all($sql1);
    $count1 = count($show1); 

    /*SHORTLIST*/
    $sql2   = "SELECT * FROM sch_interview_schedule WHERE category='shipping' AND status='1'";
    $show2  = $object->fetch_all($sql2);
    $count2 = count($show2);

    /*REJECT SCHEDULE*/
    $sql3   = "SELECT * FROM sch_interview_schedule WHERE category='shipping' AND status='2'";
    $show3  = $object->fetch_all($sql3);
    $count3 = count($show3);
 
 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Shipping</li>
        <li class="breadcrumb-item active">Interview Schedule</li>

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
				<h4 style="text-align: center">INTERVIEW SCHEDULE PENDING</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>	
				<div class="card">
					
				<div class="card-body">

					<div align="center">
                    	<a href="<?php echo $object->base_path()?>s-interview-schedule-pending" class="btn btn-outline-secondary active">
                    		<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING SCHEDULE
                    	</a>
	                    <a href="<?php echo $object->base_path()?>s-interview-schedule-approved" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> APPROVED SCHEDULE</a>
	                    <a href="<?php echo $object->base_path()?>s-interview-schedule-rejected" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED SCHEDULE</a>
                    </div>
                    <center><b>STATUS : <span class='badge badge-warning'>PENDING</span></b></center>		

					<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
						<thead>
							<tr>
								<td style="font-weight: bold;text-align: center;">No</td>
								<td style="font-weight: bold;text-align: center;">Candidate Name</td>
								<td style="font-weight: bold;text-align: center;">Job Name</td>
								<td style="font-weight: bold;text-align: center;">Date</td>
								<td style="font-weight: bold;text-align: center;">Time</td>
								<td style="font-weight: bold;text-align: center;">Action</td>
							</tr>
						</thead>
						<tbody>
							<?php 
						    	$sql = "SELECT a.*, b.first_name,b.last_name,b.email,b.candidate_code, c.id_job_name FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate=b.id JOIN sch_job_shipping c ON b.id_job=c.id WHERE a.category='shipping' AND a.status='0'";
								$candidate = $object->fetch_all($sql);
								if (count($candidate) > 0) {
									$number = 1;
									foreach ($candidate as $cand) {

								$job = "SELECT name FROM sch_master_crewrank WHERE id='".$cand['id_job_name']."'";
								$jobName = $object->fetch($job);
										?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
								<td><?= $jobName['name'] ?></td>
								<td align="center"><?= $object->dateConvertEng($cand['date']); ?></td>
								<td align="center"><?= $cand['time'] ?></td>
								<td align="center">
									<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>s-interview-schedule-pending-details/<?= $cand['id_candidate'] ?>" >
									ACTION
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

