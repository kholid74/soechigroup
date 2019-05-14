<?php

	use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   
   require_once dirname( __FILE__ ) . '../../../../vendor/autoload.php'; 

	$sql = "SELECT a.*,b.id_job_name,c.name,c.deck_engine,c.category FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id WHERE a.id=".$_GET['ids']."";
	$candidate = $object->fetch($sql);
	$catCandidate = $candidate['category'];
	$canCode = $candidate['candidate_code'];

	$sql2 = "SELECT * FROM sch_cand_ship_nextkin WHERE id_candidate=".$_GET['ids']."";
	$nextKin = $object->fetch($sql2); 

	$country = "SELECT en_short_name FROM sch_countries WHERE num_code=".$candidate['id_countries']."";
	$showCountry = $object->fetch($country);

	$doc = "SELECT * FROM sch_master_document_shipping WHERE category ='$catCandidate'";
    $exp = $object->fetch_all($doc);
    $count_all_doc = count($exp);

    $doc2    = "SELECT * FROM sch_cand_ship_document WHERE id_candidate =".$_GET['ids']."";
    $candDoc = $object->fetch_all($doc2);
    $count_cand_doc = count($candDoc); 
    $totalDocupload = $count_all_doc - $count_cand_doc;

    $remark = "SELECT * FROM sch_cand_notes WHERE candidate_code ='$canCode' AND status='0'";
    $candRemark = $object->fetch_all($remark);
    $count_unremark = count($candRemark); 

    if(isset($_POST['_saveRemarks'])) {
	    $namatable = 'sch_cand_notes';
	    $data = array(
	      'candidate_code'=> $canCode,
	      'notes'=> $_POST['notes'],
	      'status'=> '0',
	      'action_by'=> $authadmin['name']
	    );
	    $insert = $object->tambahdata($namatable,$data);
	    $object->messagesin($insert);
    	echo "<script> window.location.assign('".$object->base_path()."shipping-candidate-online-test-detail/".$candidate['id']."'); </script>";
  }

	  if(isset($_POST['_complete'])){
	    $namatable = 'sch_cand_notes';

	    $data = array(
	      'status'=> '1'
	  	);
	    $conditions = array('id' =>strip_tags($_POST['id']));
	    $statusMsg =  $object->updatedata($namatable,$data,$conditions);
	    echo "<script> window.location.assign('".$object->base_path()."shipping-candidate-online-test-detail/".$candidate['id']."'); </script>";
	}

    /*PASSED*/
	
	if(isset($_POST['_passed'])){ 

        $namatable = 'sch_cand_shipping_status';
        $data = array(
            'status'=>'INTERVIEW_PASS'
      	);
      	
        $conditions = array('candidate_code' =>strip_tags($_POST['candidate_code']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'successfully moved to passed interview list.':'Some problem occurred, please try again.';

        $updateStatus="UPDATE `sch_interview_schedule` SET `status`='3' WHERE id_candidate=".$_GET['ids']."";
        $object->add($updateStatus);

        $mail = new PHPMailer(true);

	  	$mail->SMTPDebug = 0;    
        $mail->isSMTP();                         
        $mail->Host = 'smtp.gmail.com'; 
        $mail->SMTPAuth = true;                      
        $mail->Username = 'no-reply@soechi.com';   
        $mail->Password = 'autocount2018!';                
        $mail->SMTPSecure = 'tls';                         
        $mail->Port = 587;                            
      
      	$message = file_get_contents(''.BASE_URL.'emailtemplates/shipping-passes-interview.html');
      	$message = str_replace("%candidate['first_name']%", $candidate['first_name'], $message);
      	
      	//Recipients
      	$mail->setFrom('no-reply@soechi.com', 'Soechi Recruitment');
      	$mail->addAddress(''.$candidate['email'].'', 'Candidate');  
      	$mail->addReplyTo('no-reply@soechi.com', 'Information');

      	//Content
      	$mail->isHTML(true);              
      	$mail->Subject = '[no-reply] Interview Results';
      	$mail->MsgHTML($message);

      	$mail->send();

        @$msg = $_SESSION['statusMsg'] = $statusMsg;

        echo "<script> window.location('".$object->base_path()."s-interview-schedule-approved'); </script>";
    }

    /*FAILED*/

	if(isset($_POST['_failed'])){ 

        $namatable = 'sch_cand_shipping_status';
        $data = array(
            'status'=>'INTERVIEW_FAIL', 
            'reason_reject'=>$_POST['reason'] 
      	);
        $conditions = array('candidate_code' =>strip_tags($_POST['candidate_code']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'successfully moved to failed interview list.':'Some problem occurred, please try again.';

        $updateStatus="UPDATE `sch_interview_schedule` SET `status`='4' WHERE id_candidate=".$_POST['id']."";
	    $object->add($updateStatus);

        @$msg = $_SESSION['statusMsg'] = $statusMsg;

        $insertHistory="INSERT INTO `sch_candidate_history` SET 
		      				`candidate_code`='".trim($candidate['candidate_code'])."', 
		      				`job_name`='".trim($candidate['name'])."',
		      				`status`='REJECTED',
		      				`action_by`='".trim($authadmin['username'])."',
		      				`reason_reject`='".trim($_POST['reason'])."',
		      				`action_date`='".date("Y-m-d H:i:s")."', 
		      				`register_date`='".trim($candidate['created'])."'
		      			";
		      			
        echo "<script> window.location.assign('".$object->base_path()."s-interview-schedule-approved'); </script>";
    }


?>
<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Shipping</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>s-interview-schedule-approved">Interview Candidate</a></li>
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
				<h4 style="text-align: center">INTERVIEW</h4>
				<center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">
						
					</div>
				<div class="card-body">
					
					<!-- Main row -->
				      <div class="row">
				        <div class="col-lg-12">
				        <a href="<?php echo $object->base_path()?>s-interview-schedule-approved" style="font-weight: bold;color: #084f93;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;&nbsp;BACK TO APPLICANT LIST</a>
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
				              <td width="55%">Category</td>
				              <td>:&nbsp;</td>
				              <td><?= $candidate['deck_engine'] ?></td>
				            </tr>
				            <tr>
				              <td>Applied Date</td>
				              <td>:&nbsp;</td>
				              <td><?= $candidate['created']; ?></td>
				            </tr>
				            <tr>
				              <td>Status</td>
				              <td>:&nbsp;</td>
				              <td>
								<span class='badge badge-primary'>INTERVIEW PROCESS</span>
							  </td>
				            </tr>
				            </tbody>
				          </table>
				          </div>

						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="personal-info-tab" data-toggle="tab" href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">Personal Information</a>
						  </li>
						  
						  <li class="nav-item">
						    <a class="nav-link" id="next-kin-tab" data-toggle="tab" href="#next-kin" role="tab" aria-controls="next-kin" aria-selected="true">Next of Kin Details</a>
						  </li>
						  
						  <li class="nav-item">
						    <a class="nav-link" id="prejoining-exp-tab" data-toggle="tab" href="#prejoining-experience" role="tab" aria-controls="prejoining-exp" aria-selected="false">Pre Joining Experience</a>
						  </li>
						  
						  <li class="nav-item">
						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#attachment" role="tab" aria-controls="attach" aria-selected="false">Document Uploads&nbsp;&nbsp;<span class='badge badge-danger'><?php echo $totalDocupload; ?></span></a>
						  </li>

						  <li class="nav-item">
						    <a class="nav-link" id="remarks-tab" data-toggle="tab" href="#remarks" role="tab" aria-controls="remarks" aria-selected="false">Remarks</a>
						  </li>

						  <li class="nav-item" style="<?php if($count_unremark > 0){echo "background-color: #f86c6b;color: white;";} ?>">
						    <a class="nav-link" id="followup-tab" data-toggle="tab" href="#followup" role="tab" aria-controls="followup" aria-selected="false">Follow Up&nbsp;&nbsp;<span class='badge badge-danger'><?php echo $count_unremark; ?></span></a>
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
			                      <td>Address Line</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['address']?></td>
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
			                    <tr>
			                      <td width="50%">Nearest Airport</td>
			                      <td>:&nbsp;</td>
			                      <td><?=$candidate['nearest_airport']?></td>
			                    </tr>
			                    </tbody>
			                    </table>
			                  </div>
						  	<!--END PERSONAL INFORMATION-->
						  </div>
						  <div class="tab-pane fade" id="next-kin" role="tabpanel" aria-labelledby="next-kin-tab">
						  	 <!-- EDUCATION -->
				                  <div>
				                    <h3 style="font-weight: bold;">Next of Kin Details</h3>
				                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
				                    <table style="font-weight: bold;line-height: 2;">
					                    <tbody>
					                    <tr>
					                      <td width="50%">Legal Name</td>
					                      <td>:&nbsp;</td>
					                      <td><?=$nextKin['first_name']?> <?=$nextKin['last_name']?></td>
					                    </tr>
					                    <tr>
					                      <td>Date of Birth</td>
					                      <td>:&nbsp;</td>
					                      <td><?=$nextKin['date_of_birth']?></td>
					                    </tr>
					                    <tr>
					                      <td>Address</td>
					                      <td>:&nbsp;</td>
					                      <td><?=$nextKin['address']?></td>
					                    </tr>
					                    <tr>
					                      <td width="50%">Phone</td>
					                      <td>:&nbsp;</td>
					                      <td><?=$nextKin['phone']?></td>
					                    </tr>
					                    <tr>
					                      <td width="50%">Relationship</td>
					                      <td>:&nbsp;</td>
					                      <td><?=$nextKin['relationship']?></td>
					                    </tr>
					                    <tr>
					                      <td width="50%">Dependents</td>
					                      <td>:&nbsp;</td>
					                      <td><?=$nextKin['dependents']?></td>
					                    </tr>
					                    </tbody>
					                    </table>
				                 </div>
				               <!--  END EDUCATION  -->
						  </div>
						  <div class="tab-pane fade" id="prejoining-experience" role="tabpanel" aria-labelledby="prejoining-experience-tab">
						  	 <!-- EDUCATION -->
				                  <div>
				                    <h3 style="font-weight: bold;">Pre Joining Experience</h3>
				                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
				                    <table class="table table-responsive-sm table-bordered table-striped table-sm">
				                    <thead>
				                    	<tr style="font-weight: bold;font-size: 11px;">
				                    		<td>No</td>
				                    		<td>Vessel Name</td>
				                    		<td>Flag</td>
				                    		<td>Vessel Type</td>
				                    		<td>DWT GRT</td>
				                    		<td>M/E Make Model</td>
				                    		<td>M/E BHP</td>
				                    		<td>Rank</td>
				                    		<td>From</td>
				                    		<td>To</td>
				                    		<td>Month/Days</td>
				                    		<td>Company Name</td>
				                    	</tr>
				                    </thead>
				                    <tbody>
									<?php 
								    	$sql = "SELECT a.*,b.name,b.vessel_type,b.vessel_flag FROM sch_cand_ship_prejoin_exp a JOIN sch_master_vessel b ON a.id_vessel=b.id WHERE a.id_candidate = ".$_GET['ids']."";
										$exp = $object->fetch_all($sql);
										if (count($exp) > 0) {
											$number = 1;
											foreach ($exp as $preJoin) {
										$dateFrom = $preJoin['date_from'];
										$dateTo   = $preJoin['date_to'];
										$start_date = new DateTime($dateFrom);
										$end_date = new DateTime(date($dateTo,strtotime("+144 days")));
										$dd = date_diff($start_date,$end_date);
									?>
					                    <tr style="font-size: 11px;">
					                      <td><?php echo $number;?></td>
					                      <td><?= $preJoin['name'] ?></td>
					                      <td><?= $preJoin['vessel_flag'] ?></td>
					                      <td><?= $preJoin['vessel_type'] ?></td>
					                      <td><?= $preJoin['dwt_grt'] ?></td>
					                      <td><?= $preJoin['me_makemodel'] ?></td>
					                      <td><?= $preJoin['me_bhp'] ?></td>
					                      <td><?= $preJoin['rank'] ?></td>
					                      <td><?= $preJoin['date_from'] ?></td>
					                      <td><?= $preJoin['date_to'] ?></td>
					                      <td><?php echo "$dd->m months / $dd->d days"; ?></td>
					                      <td><?= $preJoin['company_name'] ?></td>
					                    </tr>
					                    <?php
									    	$number++;
									    	}}?>
					                    <hr>
				                    </tbody>
				                  </table>
				                 </div>
				               <!--  END EDUCATION  -->
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
			                  <br><br>
			                  <h6>OTHER DOCUMENTS</h6>
			                  <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                  <thead>
                                    <tr style="font-weight: bold;">
                                      <td align="center">Document Name</td>
                                      <td align="center">Date Issued</td>
                                      <td align="center">Date Expired</td>
                                      <td align="center">Status</td>
                                      <td align="center">View</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php

                                  	$doc = "SELECT * FROM sch_master_document_shipping WHERE category ='$catCandidate'";
    								$exp = $object->fetch_all($doc); 
                                    
                                    if (count($exp) > 0) {
                                      $number = 1;
                                      foreach ($exp as $docUpload) {

                                    $sql2    = "SELECT * FROM sch_cand_ship_document WHERE id_candidate =".$_GET['ids']." AND id_master_doc=".$docUpload['id']."";
                                    $candDoc = $object->fetch($sql2);

                                  ?>
                                  <tr>
                                    <td><?= $docUpload['document_name'] ?></td>
                                    <td align="center"><?= $candDoc['date_issued'] ?></td>
                                    <td align="center"><?= $candDoc['date_expired'] ?></td>
                                    <td align="center">
                                    <?php if ($candDoc['id_master_doc'] == $docUpload['id']) { ?>
                                      <span class="badge badge-success">COMPLETE</span>
                                    <?php }else{ ?>
                                      <span class="badge badge-danger">INCOMPLETE</span>
                                    <?php } ?>
                                    </td>
                                    <td align="center">
                                      <?php if ($candDoc['id_master_doc'] == $docUpload['id']) { ?>
                                      <a class="btn btn-success btn-sm" href="<?php echo BASE_URL ?>media/files/<?=$candDoc['file_upload']?>" target='_blank'>
                                      <i class="fa fa-eye "></i>
                                      </a>
                                    <?php }else{} ?>
                                     
                                    </td>
                                  </tr>
                                  <?php $number++; }}else{ ?>
                                  <tr>
                                    <td colspan="6" align="center">No document..</td>
                                  </tr>
                                  <?php } ?>
                                  <hr>
                                  </tbody>
                                </table>
			                <!--END ATTACHMENTS -->
						  </div>
						  <div class="tab-pane fade" id="remarks" role="tabpanel" aria-labelledby="attach-tab">
						  	<!-- REMARKS -->
						  	<span data-toggle="modal" data-target="#popup_remarks" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i></span>
						  	<br>
						  	<table class="table table-responsive-sm table-bordered table-striped table-sm">
                              <thead>
                                <tr style="font-weight: bold;">
                                  <td align="center">No</td>
                                  <td align="center">Date</td>
                                  <td align="center">By</td>
                                  <td align="center">Remarks</td>
                                </tr>
                              </thead>
                              <tbody>

                              	<?php 
                              		$remark = "SELECT * FROM sch_cand_notes WHERE candidate_code ='$canCode' AND status='0'";
    								$rmk = $object->fetch_all($remark); 
                                    
                                    if (count($rmk) > 0) {
                                      $number = 1;
                                      foreach ($rmk as $showrmk) { ?>
                              
                              <tr>
                                <td align="center"><?= $number; ?></td>
                                <td align="center"><?= $showrmk['created'] ?></td>
                                <td align="center"><?= $showrmk['action_by'] ?></td>
                                <td align="center"><?= $showrmk['notes'] ?></td>
                              </tr>
								<?php $number++; }}else{ ?>
                                  <tr>
                                    <td colspan="4" align="center">No data..</td>
                                  </tr>
                                  <?php } ?>
                              </tbody>
                            </table>

						  	<!-- END REMARKS -->	
						  </div>
						  <div class="tab-pane fade" id="followup" role="tabpanel" aria-labelledby="attach-tab">
						  	<!-- FOLLOW UP -->
							<table class="table table-responsive-sm table-bordered table-striped table-sm">
                              <thead>
                                <tr style="font-weight: bold;">
                                  <td align="center">No</td>	
                                  <td align="center">Date</td>
                                  <td align="center">By</td>
                                  <td align="center">Remarks</td>
                                  <td align="center">Action</td>
                                </tr>
                              </thead>
                              <tbody>

                              	<?php 
                              		$followup = "SELECT * FROM sch_cand_notes WHERE candidate_code ='$canCode'";
    								$flw = $object->fetch_all($followup); 
                                    
                                    if (count($flw) > 0) {
                                      $number = 1;
                                      foreach ($flw as $showflw) { ?>
                              
                              <tr>
                              	<td align="center"><?= $number; ?></td>
                                <td align="center"><?= $showflw['created'] ?></td>
                                <td align="center"><?= $showflw['action_by'] ?></td>
                                <td align="center"><?= $showflw['notes'] ?></td>
                                <td align="center">
                                
                                 <?php if($showflw['status'] == '0'){ ?>
									<form role="form" method="POST" enctype="multipart/form-data">
										<input type="hidden" name="id" value="<?=$showflw['id']?>">
										<button type="submit" class="btn btn-success btn-sm" name="_complete" title="Set as complete"><i class='fa fa-check'></i></button>
									</form>
								 <?php }else{ ?>
                                
                                	<span class='badge badge-success'>COMPLETED</span>

                                <?php } ?>
                                
                                </td>
                              </tr>
								<?php $number++; }}else{ ?>
                                  <tr>
                                    <td colspan="5" align="center">No data..</td>
                                  </tr>
                                  <?php } ?>
                              </tbody>
                            </table>
						  	<!-- END FOLLOW UP -->
						  </div>
						  
						  
						</div>
						<br>
				          <div align="center">
				          	<form role="form" method="POST" enctype="multipart/form-data">
							 	<input type="hidden" name="candidate_code" value="<?= $candidate['candidate_code'] ?>">
								<input type="submit" name="_passed"  class="btn btn-flat btn-primary" title="Set Passed Interview" value="SET PASSED INTERVIEW" onclick="return confirm('Set Passed Interview ?');"/>
								<span class="btn btn-flat btn-danger" data-toggle="modal" data-target="#failedInterview">SET FAILED INTERVIEW</span>
							</form>
							
				          </div>
				         
				          <br>
				          <a href="<?php echo $object->base_path()?>s-interview-schedule-approved" style="font-weight: bold;color: #084f93;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;&nbsp;BACK TO APPLICANT LIST</a>
				        </div>
				      </div>

				</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
      <div class="modal" id="popup_remarks" tabindex="-1" role="dialog" aria-labelledby="remarks" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Remarks</h5>
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
		              <div class="col-sm-12" align="center">
		              	
		              	<textarea name="notes" id="notes" cols="65" rows="4"></textarea>

		              </div>
                   
                  </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveRemarks"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add Remarks" value="SAVE" />
              </form>
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
              <div class="col-sm-12" align="center">
              	
              	<textarea name="reason" id="reason" cols="65" rows="4" placeholder="Input Reason Failed"></textarea>

              </div>
            </div>
	      </div>

	      <div class="modal-footer">
	        <button type="button" class="btn btn-secondary" data-dismiss="modal">CANCEL</button>
	        <<input type="hidden" name="candidate_code" value="<?= $candidate['candidate_code'] ?>">
	        <input type="submit" name="_failed"  class="btn btn-flat btn-danger" class="btn btn-flat btn-success" title="Reject Candidate" value="SAVE" />
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
<!-- end modal -->