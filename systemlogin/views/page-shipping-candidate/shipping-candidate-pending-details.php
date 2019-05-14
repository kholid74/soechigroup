<?php 
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   
   require_once dirname( __FILE__ ) . '../../../../vendor/autoload.php';

	$sql = "SELECT a.*,b.id_job_name,c.name,c.deck_engine,c.category,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE a.id=".$_GET['ids']."";
	$candidate = $object->fetch($sql);
	$candCode = $candidate['candidate_code'];

	$sql2 = "SELECT * FROM sch_cand_ship_nextkin WHERE id_candidate=".$_GET['ids']."";
	$nextKin = $object->fetch($sql2);

	$country = "SELECT en_short_name FROM sch_countries WHERE num_code=".$candidate['id_countries']."";
	$showCountry = $object->fetch($country);

	$candHistory  = "SELECT * FROM sch_candidate_history WHERE candidate_code='$candCode'";
    $history      = $object->fetch_all($candHistory);
    $countHistory = count($history); 

    if(isset($_POST['_shorlist'])){ 

        $namatable = 'sch_cand_shipping_status';
        $data = array(
            'status'=>'SHORTLISTED'
      	);
      	
        $conditions = array('candidate_code' =>strip_tags($_POST['candidate_code']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'successfully moved to shortlisted candidate.':'Some problem occurred, please try again.';

        $password = $object->randomPassword(8);
		$hashpass = password_hash($password, PASSWORD_DEFAULT);

		$insertPass="INSERT INTO `sch_candidate_user` SET 
			      				`candidate_code`='".trim($candidate['candidate_code'])."', 
			      				`candidate_category`='shipping',
			      				`email`='".trim($candidate['email'])."',
			      				`password`='".trim($hashpass)."',
			      				`show_password`='".trim($password)."',
			      				`account_status`='1',
			      				`created`='".date("Y-m-d H:i:s")."', 
			      				`modified`='".date("Y-m-d H:i:s")."'
			      			";

	    $object->add($insertPass);

	    $activeCand ="UPDATE `sch_candidate_shipping` SET `active`='yes' WHERE id='".$_GET['ids']."'";
	    $object->add($activeCand);

        $mail = new PHPMailer(true);

		$mail->SMTPDebug = 0;    
        $mail->isSMTP();                         
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;                      
        $mail->Username = 'no-reply@soechi.com';   
        $mail->Password = 'autocount2018!';                
        $mail->SMTPSecure = 'tls';                         
        $mail->Port = 587;

	    $message = file_get_contents(''.BASE_URL.'emailtemplates/shipping-shortlisted-send-userpass.html');
	    $message = str_replace("%candidate['first_name']%", $candidate['first_name'], $message);
	    $message = str_replace("%candidate['email']%", $candidate['email'], $message);
	    $message = str_replace("%password%", $password, $message);
	    $message = str_replace("%BASE_URL%", BASE_URL, $message);          
	    
	    //Recipients
	    $mail->setFrom('no-reply@soechi.com', 'Soechi Recruitment');
	    $mail->addAddress(''.$candidate['email'].'', 'Candidate');  
	    $mail->addReplyTo('no-reply@soechi.com', 'Information');

	    //Content
	    $mail->isHTML(true);              
	    $mail->Subject = '[no-reply] Congratulation to the next process';
	    $mail->MsgHTML($message);

	    $mail->send();

        @$msg = $_SESSION['statusMsg'] = $statusMsg;
        echo "<script> window.location.assign('".$object->base_path()."shipping-candidate-pending'); </script>";
    }

/*REJECT*/

if($authadmin['level'] == '2'){

	if(isset($_POST['_reject'])){ /*jika reject dilakukan manager final decision*/

	    $namatable = 'sch_cand_shipping_status';
	    $data = array(
	        'status'=>'REJECTED', 
	        'notes'=>$_POST['_reason_reject']
	  	);
	    $conditions = array('candidate_code' =>strip_tags($_POST['candidate_code']));
	    $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'successfully moved to rejected candidate.':'Some problem occurred, please try again.';

	    	$insertHistory="INSERT INTO `sch_candidate_history` SET 
		      				`candidate_code`='".trim($candidate['candidate_code'])."', 
		      				`job_name`='".trim($candidate['name'])."',
		      				`status`='REJECTED',
		      				`action_by`='".trim($authadmin['username'])."',
		      				`reason_reject`='".trim($_POST['_reason_reject'])."',
		      				`action_date`='".date("Y-m-d H:i:s")."', 
		      				`register_date`='".trim($candidate['created'])."'
		      			";
		$object->add($insertHistory);

		$mail = new PHPMailer(true);

	    $mail->SMTPDebug = 0;    
        $mail->isSMTP();                         
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;                      
        $mail->Username = 'no-reply@soechi.com';   
        $mail->Password = 'autocount2018!';                
        $mail->SMTPSecure = 'tls';                         
        $mail->Port = 587;                 
	      
	    $message = file_get_contents(''.BASE_URL.'emailtemplates/shipping-reject-review-manager.html');
	    $message = str_replace("%candidate['first_name']%", $candidate['first_name'], $message);
	    $message = str_replace("%candidate['email']%", $candidate['email'], $message);
	    $message = str_replace("%BASE_URL%", BASE_URL, $message);          
	    
	    //Recipients
	    $mail->setFrom('no-reply@soechi.com', 'Soechi Recruitment');
	    $mail->addAddress(''.$candidate['email'].'', 'Candidate');  
	    $mail->addReplyTo('no-reply@soechi.com', 'Information');

	    //Content
	    $mail->isHTML(true);              
	    $mail->Subject = '[no-reply] Recruitment Notification';
	    $mail->MsgHTML($message);

	    $mail->send();

	    @$msg = $_SESSION['statusMsg'] = $statusMsg;
	    echo "<script> window.location.assign('".$object->base_path()."shipping-candidate-pending'); </script>";
	}

}else{ /*jika action reject dilakukan selain manager, maka masuk ke role manager terlebih dahulu untuk direview ulang*/

	if(isset($_POST['_reject'])){ 

	    $namatable = 'sch_cand_shipping_status';
	    $data = array(
	        'status'=>'REJECT_MANAGER_DECISION', 
	        'notes'=>$_POST['_reason_reject']
	  	);
	    $conditions = array('candidate_code' =>strip_tags($_POST['candidate_code']));
	    $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Rejected, waiting manager decision..':'Some problem occurred, please try again.';

	    @$msg = $_SESSION['statusMsg'] = $statusMsg;

	    $insertHistory="INSERT INTO `sch_candidate_history` SET 
	      				`candidate_code`='".trim($candidate['candidate_code'])."', 
	      				`job_name`='".trim($candidate['name'])."',
	      				`status`='REJECTED',
	      				`action_by`='".trim($authadmin['username'])."',
	      				`reason_reject`='".trim($_POST['_reason_reject'])."',
	      				`action_date`='".date("Y-m-d H:i:s")."', 
	      				`register_date`='".trim($candidate['created'])."'
	      			";
		      			
	    echo "<script> window.location.assign('".$object->base_path()."shipping-candidate-pending'); </script>";
	}

}

?>
<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Shipping</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>shipping-candidate-pending">Pending Candidate</a></li>
        <li class="breadcrumb-item active"><?=$candidate['first_name']?> <?=$candidate['last_name']?></li>

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
				<center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">
						
					</div>
				<div class="card-body">
					
					<!-- Main row -->
				      <div class="row">
				        <div class="col-lg-12">
				        <a href="<?php echo $object->base_path()?>shipping-candidate-pending" style="font-weight: bold;color: #084f93;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;&nbsp;BACK TO APPLICANT LIST</a>
				        <br><br>
				          <div class="col-lg-12" style="background-color: #f0f3f5;margin-bottom: 20px;">
				            <table style="font-weight: bold;line-height: 2;">
				            <tbody>
				            <tr>
		                      <td width="50%">Name</td>
		                      <td>:&nbsp;</td>
		                      <td><?=$candidate['first_name']?> <?=$candidate['last_name']?></td>
		                    </tr>
				            <tr>
				              <td width="55%">Applied For</td>
				              <td>:&nbsp;</td>
				              <td><?=$candidate['name']?></td>
				            </tr>
				            <tr>
				              <td width="35%">Category</td>
				              <td>:&nbsp;</td>
				              <td><?= $candidate['category'] ?> / <?= $candidate['deck_engine'] ?></td>
				            </tr>
				            <tr>
				              <td>Applied Date</td>
				              <td>:&nbsp;</td>
				              <td><?= $candidate['created']; ?></td>
				            </tr>
				            <tr>
				              <td>Status</td>
				              <td>:&nbsp;</td>
				              <td><span class='badge badge-warning'><?= $candidate['status']; ?></span></td>
				            </tr>
				            </tbody>
				          </table>
				          </div>
						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="personal-info-tab" data-toggle="tab" href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">Personal Information</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#attachment" role="tab" aria-controls="attach" aria-selected="false">Document Uploads</a>
						  </li>
						  <li class="nav-item">
						    <a class="nav-link" id="candidate-history-tab" data-toggle="tab" href="#candidate-history" role="tab" aria-controls="candidate-history" aria-selected="false"><span class='badge badge-danger'><?php echo $countHistory; ?></span>&nbsp;Candidate History</a>
						  </li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
						  	<!--PERSONAL INFORMATION-->
						  	   <div>
			                    <h3 style="font-weight: bold;">Personal Information</h3>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
			                    <table style="font-weight: bold;line-height: 2;">
			                    <tbody>
			                    <tr>
			                      <td width="50%">Legal Name</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['first_name']?> <?=$candidate['last_name']?></td>
			                    </tr>
			                    <tr>
			                      <td>ID Card (KTP/Passport)</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['card_number']?></td>
			                    </tr>
			                    <tr>
			                      <td>Gender</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['gender']?></td>
			                    </tr>
			                    <tr>
			                      <td>Birth Place</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['birth_place']?></td>
			                    </tr>
			                    <tr>
			                      <td>Birth Date</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['birth_date']?></td>
			                    </tr>
			                    <tr>
			                      <td width="50%">Nationality</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$showCountry['en_short_name']?></td>
			                    </tr>
			                    <tr>
			                      <td>City or Regency</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['city']?></td>
			                    <tr>
			                      <td>Email</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['email']?></td>
			                    </tr>
			                    <tr>
			                      <td width="50%">Mobile 1</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['mobile1']?></td>
			                    </tr>
			                    <tr>
			                      <td width="50%">Mobile 2</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['mobile2']?></td>
			                    </tr>
			                    </tbody>
			                    </table>
			                  </div>
						  	<!--END PERSONAL INFORMATION-->
						  </div>
					
						  <div class="tab-pane fade" id="attachment" role="tabpanel" aria-labelledby="attach-tab">
						  	<!-- ATTACHMENTS -->
			                  <div>
			                    <h3 style="font-weight: bold;">Document Uploads</h3>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
			                      <h6>FIRST UPLOAD DOCUMENTS</h6>
			                  <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                  <thead>
                                    <tr style="font-weight: bold;">
                                      <td align="center">Document Name</td>
                                      <td align="center">Status</td>
                                      <td align="center">View</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  
                                  <tr>
                                    <td>CV</td>
                                    <td align="center"><span class="badge badge-success">COMPLETE</span></td>
                                    <td align="center">
                                    	<a class="btn btn-success btn-sm" href="<?php echo BASE_URL ?>media/files/<?=$candidate['cv']?>" target='_blank'><i class="fa fa-eye "></i></a>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>Seaman Book</td>
                                    <td align="center"><span class="badge badge-success">COMPLETE</span></td>
                                    <td align="center">
                                    	<a class="btn btn-success btn-sm" href="<?php echo BASE_URL ?>media/files/<?=$candidate['seaman_book']?>" target='_blank'><i class="fa fa-eye "></i></a>
                                    </td>
                                  </tr>

                                  <tr>
                                    <td>Contract</td>
                                    <td align="center"><span class="badge badge-success">COMPLETE</span></td>
                                    <td align="center">
                                    	<a class="btn btn-success btn-sm" href="<?php echo BASE_URL ?>media/files/<?=$candidate['contract']?>" target='_blank'><i class="fa fa-eye "></i></a>
                                    </td>
                                  </tr>
                                 
                                  <hr>
                                  </tbody>
                                </table>
			                  </div>
			                <!--END ATTACHMENTS -->
						  </div>
						  <div class="tab-pane fade" id="candidate-history" role="tabpanel" aria-labelledby="candidate-history-tab">
						  	<!-- CANDIDATE HISTORY -->
			                  <div>
			                    <h3 style="font-weight: bold;">Candidate History</h3>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
			                    	<div class="col md-12">
				                    	<div class="timeline-centered">
				                    		<?php 

				                    			$candHistoryy  = "SELECT * FROM sch_candidate_history WHERE candidate_code='$candCode'";
    											$historyy      = $object->fetch_all($candHistoryy);
    											if (count($historyy) > 0) {
													foreach ($historyy as $hisCand) {

				                    		 ?>
									        <article class="timeline-entry">
									            <div class="timeline-entry-inner">
									                <div class="timeline-icon bg-danger">
									                    <i class="fa fa-history"></i>
									                </div>
									                <div class="timeline-label">
									                    <p style="font-weight: bold;">Register date: <?= $hisCand['register_date'] ?></p>
									                    <p style="font-weight: bold;">Position : <?= $hisCand['job_name'] ?></p>
									                    <p style="font-weight: bold;">Previous Step : <?= $hisCand['status'] ?></p>
									                    <p style="font-weight: bold;">Reason : <?= $hisCand['reason_reject'] ?></p>
									                    <p style="font-weight: bold;">Action by : <?= $hisCand['action_by'] ?></p>
									                    <p style="font-weight: bold;">Action date : <?= $hisCand['action_date'] ?></p>
									                </div>
									            </div>
									        </article>
									    <?php }}else{ ?>
											<?php echo "No history found on this Candidate.."; ?>
									    <?php } ?>
				                        </div>
			                    	</div>
			                <!--END CANDIDATE HISTORY -->
						  </div>
						</div>
						</div>
				          
				          <div align="center">
				                  <br>
							<form role="form" method="POST" enctype="multipart/form-data">
								<input type="hidden" name="candidate_code" value="<?= $candidate['candidate_code'] ?>">

								<?php if($candidate['status'] == 'REJECT_MANAGER_DECISION' AND $authadmin['level'] != '2'){}else{ ?>

								<input type="submit" name="_shorlist" class="btn btn-flat btn-success" title="Proceed to shotlist candidate" onclick="return confirm('Process to shortlisted candidate ?');" value="SHORTLIST" />
							
								<span class="btn btn-flat btn-danger" data-toggle="modal" data-target="#exampleModalCenter">&nbsp;&nbsp;&nbsp;REJECT&nbsp;&nbsp;&nbsp;</span>
								
								<?php } ?>

				           </form>
				           <!-- Modal -->
							<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Reason Reject</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							       <form role="form" method="POST" enctype="multipart/form-data">
							          <div class="form-group">
							            <label for="message-text" class="col-form-label">Please give rejection reason :</label>
							            
							            <select class="form-control" name="_reason_reject" id="_reason_reject">
													<option selected disabled>Select Reason to Reject</option>
							            <?php 
							            	$sql = "SELECT * FROM sch_master_reason_reject";
											$reject = $object->fetch_all($sql);
												if (count($reject) > 0) {
													foreach ($reject as $rejct) {?>
												<option value="<?= $rejct['reason'] ?>"><?= $rejct['reason'] ?></option>
											<?php }} ?>

										</select>
										<br>
										<textarea name="_reason_reject" id="_reason" cols="65" rows="4" placeholder="Input Reason Reject (Fill this if there are no suitable options above.)" ></textarea>
							            
							          </div>
							      </div>
							      <div class="modal-footer">
							        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
							        <input type="hidden" name="candidate_code" value="<?= $candidate['candidate_code'] ?>">
							        <input type="submit" name="_reject"  class="btn btn-flat btn-danger" class="btn btn-flat btn-success" title="Reject Candidate" value="REJECT" />
							        </form>
							      </div>
							    </div>
							  </div>
							</div>     
				          </div>
				          <br>
				          <a href="<?php echo $object->base_path()?>shipping-candidate-pending" style="font-weight: bold;color: #084f93;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;&nbsp;BACK TO APPLICANT LIST</a>
				        </div>
				      </div>

				</div>
				</div>
			</div>
		</div>
	</div>