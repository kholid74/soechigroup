<?php
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
   
    require_once dirname( __FILE__ ) . '../../../../vendor/autoload.php';
	include '../systemlogin/assets/plugin/phpqrcode/qrlib.php';

    /*PENDING*/
    $sql1   = "SELECT * FROM sch_interview_schedule WHERE category='office' AND status='0'";
    $show1  = $object->fetch_all($sql1);
    $count1 = count($show1); 

    /*SHORTLIST*/
    $sql2   = "SELECT * FROM sch_interview_schedule WHERE category='office' AND status='1'";
    $show2  = $object->fetch_all($sql2);
    $count2 = count($show2);

    /*REJECT SCHEDULE*/
    $sql3   = "SELECT * FROM sch_interview_schedule WHERE category='office' AND status='2'";
    $show3  = $object->fetch_all($sql3);
    $count3 = count($show3);

    /*FAILED*/

	if(isset($_POST['_failed'])){ 

        $namatable = 'sch_candidate_office';
        $data = array(
            'status'=>'5', 
            'reason_reject'=>$_POST['reason'] 
      	);
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'successfully moved to failed interview list.':'Some problem occurred, please try again.';
        @$msg = $_SESSION['statusMsg'] = $statusMsg;

        $updateStatus="UPDATE `sch_interview_schedule` SET `status`='4' WHERE id_candidate=".$_POST['id']."";
	    $object->add($updateStatus);

        echo "<script> window.location.assign('".$object->base_path()."o-interview-schedule-approved'); </script>";
    }
 

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Office</li>
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
                    	<a href="<?php echo $object->base_path()?>o-interview-schedule-pending" class="btn btn-outline-secondary">
                    		<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING
                    	</a>
	                    <a href="<?php echo $object->base_path()?>o-interview-schedule-approved" class="btn btn-outline-secondary active">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> APPROVED</a>
	                    <a href="<?php echo $object->base_path()?>o-interview-schedule-rejected" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED</a>
                    </div>
					<center><b>STATUS : <span class='badge badge-success'>APPROVED</span></b></center>
					<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
						<thead>
							<tr>
								<td style="font-weight: bold;text-align: center;">No</td>
								<td style="font-weight: bold;text-align: center;">Candidate Name</td>
								<td style="font-weight: bold;text-align: center;">Job Name</td>
								<td style="font-weight: bold;text-align: center;">Detail</td>
								<td style="font-weight: bold;text-align: center;">Input Result</td>
							</tr>
						</thead>
						<tbody>
							<?php 
						    	$sql = "SELECT a.*,b.full_name,b.email,b.candidate_code,c.job_title FROM sch_interview_schedule a JOIN sch_candidate_office b ON a.id_candidate = b.id JOIN sch_job_office c ON b.id_job=c.id WHERE a.category='office' AND a.status='1'";
								$candidate = $object->fetch_all($sql);
								if (count($candidate) > 0) {
									$number = 1;
									foreach ($candidate as $cand) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $cand['full_name'] ?></td>
								<td><?= $cand['job_title'] ?></td>
								<td>

								<?php 

									/*PASSED*/
	
									if(isset($_POST['_passed'])){ 

								        $namatable = 'sch_candidate_office';
								        $data = array(
								            'status'=>'4'
								      	);
								      	
								        $conditions = array('id' =>strip_tags($_POST['id']));
								        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'successfully moved to passed interview list.':'Some problem occurred, please try again.';

								        $updateStatus="UPDATE `sch_interview_schedule` SET `status`='3' WHERE id_candidate=".$_POST['id']."";
								        $object->add($updateStatus);

								        $mail = new PHPMailer(true);

								        $object->setting_smtp($mail);
        
								      	$message = file_get_contents(''.BASE_URL.'emailtemplates/office-passes-interview.html');
								      	$message = str_replace("%cand['full_name']%", $cand['full_name'], $message);
								      	
								      	//Recipients
								      	$mail->setFrom('no-reply@soechi.com', 'Soechi Recruitment');
								      	$mail->addAddress(''.$cand['email'].'', 'Candidate');  
								      	$mail->addReplyTo('no-reply@soechi.com', 'Information');

								      	//Content
								      	$mail->isHTML(true);              
								      	$mail->Subject = '[no-reply] Interview Results';
								      	$mail->MsgHTML($message);

								      	$mail->send();

								        @$msg = $_SESSION['statusMsg'] = $statusMsg;
								        echo "<script> window.location.assign('".$object->base_path()."o-interview-schedule-approved'); </script>";
								    }

								 ?>
								
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
                                                : <b><?= $cand['full_name'] ?></b>
                                            </div>
                                            <div class="col-md-4">
                                                Position
                                            </div>
                                            <div class="col-md-8">
                                                : <b><?= $cand['job_title'] ?></b>
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
									 <form role="form" method="POST" enctype="multipart/form-data">
									 	<input type="hidden" value="<?= $cand['id_candidate'] ?>" name="id">
										<input type="submit" name="_passed"  class="btn btn-flat btn-primary btn-sm" title="Set Passed Interview" value="PASSED" onclick="return confirm('Set Passed Interview for <?= $cand['first_name'] ?> <?= $cand['last_name'] ?> ?');"/>
									</form>
									<span class="btn btn-flat btn-danger btn-sm" data-toggle="modal" data-target="#failedInterview">FAILED</span>
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

<!-- Modal -->
	<div class="modal" id="failedInterview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Reason Failed</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>

	      <div class="modal-body">
	       <form role="form" method="POST" enctype="multipart/form-data">
	          <div class="form-group row">
              <div class="col-sm-12">
                <select class="form-control" id="reason" name="reason" required>
                  <option selected disabled>- Choose Reason Reject -</option>
                  <?php $sql = "SELECT * FROM sch_master_reason_reject ORDER BY reason ASC";
                        $reason = $object->fetch_all($sql);
                          foreach ($reason as $rsn) { ?>

                  <option value="<?= $rsn['reason'] ?>"><?= $rsn['reason'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
	        <input type="hidden" name="id" value="<?=$cand['id_candidate']?>">
	        <input type="submit" name="_failed"  class="btn btn-flat btn-danger" class="btn btn-flat btn-success" title="Reject Candidate" value="SAVE" />
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
<!-- end modal -->