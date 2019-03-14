<?php
	
	include '../systemlogin/assets/plugin/phpqrcode/qrlib.php';

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
				<h4 style="text-align: center">INTERVIEW SCHEDULE APPROVED</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>	
				<div class="card">
					
				<div class="card-body">

					<div align="center">
                    	<a href="<?php echo $object->base_path()?>s-interview-schedule-pending" class="btn btn-outline-secondary">
                    		<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING SCHEDULE
                    	</a>
	                    <a href="<?php echo $object->base_path()?>s-interview-schedule-approved" class="btn btn-outline-secondary active">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> APPROVED SCHEDULE</a>
	                    <a href="<?php echo $object->base_path()?>s-interview-schedule-rejected" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED SCHEDULE</a>
                    </div>
					<center><b>STATUS : <span class='badge badge-success'>APPROVED</span></b></center>
					<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
						<thead>
							<tr>
								<td style="font-weight: bold;text-align: center;">No</td>
								<td style="font-weight: bold;text-align: center;">Candidate Name</td>
								<td style="font-weight: bold;text-align: center;">Position</td>
                                <td style="font-weight: bold;text-align: center;">Date / Time</td>
                                <td style="font-weight: bold;text-align: center;">PIC</td>
								<td style="font-weight: bold;text-align: center;">Barcode</td>
								<td style="font-weight: bold;text-align: center;">Input Result</td>
							</tr>
						</thead>
						<tbody>
							<?php

								$sql = "SELECT a.*, b.first_name,b.last_name,b.email,b.candidate_code, c.id_job_name FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate=b.id JOIN sch_job_shipping c ON b.id_job=c.id WHERE a.category='shipping' AND a.status='1'"; 
								
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
                                <td align="center"><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></td>
                                <td><?= $cand['pic_name'] ?></td>
								<td>
								
								<!-- Modal -->
                                <div class="modal" id="view<?= $cand['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                   <div class="modal-dialog modal-dialog-centered" role="document">
                                     <div class="modal-content">
                                       <div class="modal-header">
                                         <h5 class="modal-title" id="exampleModalLongTitle">Detail Interview :</h5>
                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                           <span aria-hidden="true">&times;</span>
                                         </button>
                                       </div>
                                       <div class="modal-body">
                                         <form role="form" method="POST" enctype="multipart/form-data">
                                         <div class="container-fluid">
                                         <div class="row">
                                            <div class="col-md-4">
                                                Name
                                            </div>
                                            <div class="col-md-8">
                                                : <b><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></b>
                                            </div>
                                            <div class="col-md-4">
                                                Position
                                            </div>
                                            <div class="col-md-8">
                                                : <b><?= $jobName['name'] ?></b>
                                            </div>
                                            <div class="col-md-4">
                                                Date / Time
                                            </div>
                                            <div class="col-md-8">
                                                : <b><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></b>
                                            </div>
                                            <div class="col-md-4">
                                                PIC
                                            </div>
                                            <div class="col-md-8">
                                                : <b><?= $cand['pic_name'] ?></b>
                                            </div>
                                         </div>

                                            <div class="col-md-12" align="center">
                                                <img src="<?php echo BASE_URL; ?>media/images/qrcode_generate/<?= $cand['img_qrcode'] ?>" alt="">
                                            </div>
                                       
                                        </div>
                                        
                                       </div>
                                       <div class="modal-footer">
                                         
                                       </div>
                                     </div>
                                   </div>
                                     </div>
                                     <!-- end Modal -->

									<center>
										<span class="btn btn-flat btn-success btn-sm" data-toggle="modal" title="View Detail Candidate" data-target="#view<?= $cand['id'] ?>"><i class="fa fa-eye"></i></span>
									</center>	

								</td>

							
								<td align="center">
									 <a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>s-interview-schedule-approved-details/<?= $cand['id_candidate'] ?>" >
									<i class="fa fa-edit"></i>&nbsp;INPUT RESULT
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

