<?php
	use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
   
    require_once dirname( __FILE__ ) . '../../../../vendor/autoload.php';
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
				<h4 style="text-align: center">INTERVIEW SCHEDULE REJECTED</h4>
				<center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>	
				<div class="card">
					
				<div class="card-body">

					<div align="center">
                    	<a href="<?php echo $object->base_path()?>s-interview-schedule-pending" class="btn btn-outline-secondary">
                    		<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING SCHEDULE
                    	</a>
	                    <a href="<?php echo $object->base_path()?>s-interview-schedule-approved" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> APPROVED SCHEDULE</a>
	                    <a href="<?php echo $object->base_path()?>s-interview-schedule-rejected" class="btn btn-outline-secondary active">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED SCHEDULE</a>
                    </div>
					<center><b>STATUS : <span class='badge badge-danger'>REJECTED</span></b></center>
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

						    	$sql = "SELECT a.*, b.first_name,b.last_name,b.email,b.candidate_code, c.id_job_name FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate=b.id JOIN sch_job_shipping c ON b.id_job=c.id WHERE a.category='shipping' AND a.status='2'";
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
									<span data-toggle="modal" data-target="#interview" class="btn btn-primary btn-sm">SET MANUAL SCHEDULE</span>

								<?php 

								if(isset($_POST['_saveInterview'])) { 
									$tempDir = '../media/images/qrcode_generate/'; 
								    $fileName = 'cand_'.md5($cand['candidate_code']).'.png'; 
								     
								    $pngAbsoluteFilePath = $tempDir.$fileName; 
								    $urlRelativeFilePath = '../media/images/qrcode_generate/'.$fileName; 
								    
								    if (!file_exists($pngAbsoluteFilePath)) { 
								        QRcode::png($cand['candidate_code'], $pngAbsoluteFilePath,"H",8,2); 
								    } else { 
								    }

							        $namatable = 'sch_interview_schedule';
							        $data = array(
							          'id_candidate'=>$cand['id_candidate'],
								      'date'=>$_POST['interDate'],
								      'time'=>$_POST['interTime'],
								      'pic_name'=>$_POST['picName'],
								      'status'=> '1',
								      'img_qrcode'=> $fileName
							      );
							        $conditions = array('id' =>strip_tags($_POST['id']));
							        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
							        
							        $message = file_get_contents(''.BASE_URL.'emailtemplates/shipping-barcode.html');
							        $message = str_replace("%cand['first_name']%", $cand['first_name'], $message);
							        $message = str_replace("%cand['last_name']%", $cand['last_name'], $message);
							        $message = str_replace("%jobName['name']%", $jobName['name'], $message);
							        $message = str_replace("%cand['date']%", $cand['date'], $message);
							        $message = str_replace("%cand['time']%", $cand['time'], $message);
							        $message = str_replace("%cand['pic_name']%", $cand['pic_name'], $message);
							        $message = str_replace("%cand['img_qrcode']%", $cand['img_qrcode'], $message);
							        $message = str_replace("%BASE_URL%", BASE_URL, $message);
							       
							        $mail = new PHPMailer(true);                             
							      	
							      	$object->setting_smtp($mail);

											//Recipients
											$mail->setFrom('no-reply@soechi.com', 'Soechi Recruitment');
											$mail->addAddress(''.$cand['email'].'', ''.$cand['first_name'].' '.$cand['last_name'].'');    
											$mail->addReplyTo('no-reply@soechi.com', 'Information');

											//Content
											$mail->isHTML(true);                                 
											$mail->Subject = '[no-reply] Interview Schedule';
											$mail->MsgHTML($message);

											$mail->send();

							        @$msg = $_SESSION['statusMsg'] = $statusMsg;
							        echo "<script> window.location.assign('".$object->base_path()."s-interview-schedule-rejected'); </script>";
											  
								}

								 ?>

								<!-- Modal -->
							      <div class="modal" id="interview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							        <div class="modal-dialog modal-dialog-centered" role="document">
							          <div class="modal-content">
							            <div class="modal-header">
							              <h5 class="modal-title" id="exampleModalLongTitle">Set Schedule for <?= $cand['first_name'] ?> <?= $cand['last_name'] ?></h5>
							              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							                <span aria-hidden="true">&times;</span>
							              </button>
							            </div>
							            <div class="modal-body">
							              <form role="form" method="POST" enctype="multipart/form-data">
							              <div class="container-fluid">
							              <div class="row">

							                <div class="col-md-12">
							                   <div class="form-group row">
							                      <label class="col-md-4 col-form-label" for="interDate">Choose Date</label>
							                      <div class="col-md-8">
							                        <input type="date" class="form-control" id="txtDate" name="interDate" value="<?= $cand['date'] ?>" required>
							                      </div>
							                     </div>

							                     <div class="form-group row">
							                      <label class="col-md-4 col-form-label" for="interTime">Choose Time</label>
							                      <div class="col-md-8">
							                        <select name="interTime" id="interTime" class="form-control">
							                          <option selected>- Choose Time -</option>
							                          <option value="09.00">09.00</option>
							                          <option value="10.00">10.00</option>
							                          <option value="11.00">11.00</option>
							                          <option value="13.00">13.00</option>
							                          <option value="14.00">14.00</option>
							                          <option value="15.00">15.00</option>
							                        </select>
							                      </div>
							                     </div>

							                     <div class="form-group row">
							                      <label class="col-md-4 col-form-label" for="picName">PIC</label>
							                      <div class="col-md-8">
							                        <input type="text" class="form-control" id="picName" name="picName" value="<?= $authadmin['name'] ?>" required>
							                      </div>
							                     </div>

							                </div>
							              </div>
							          </div>
							             
							            </div>
							            <div class="modal-footer">
							              <input type="hidden" name="status" value="1">
							              <input type="hidden" name="id" value="<?= $cand['id'] ?>">
							              <input type="submit" name="_saveInterview" class="btn btn-flat btn-primary" class="btn btn-flat btn-success"  value="SUBMIT" />
							              </form>
							            </div>
							          </div>
							        </div>
							    </div>
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
