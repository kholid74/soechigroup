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
                    	<a href="<?php echo $object->base_path()?>o-interview-schedule-pending" class="btn btn-outline-secondary active">
                    		<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING
                    	</a>
	                    <a href="<?php echo $object->base_path()?>o-interview-schedule-approved" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> APPROVED</a>
	                    <a href="<?php echo $object->base_path()?>o-interview-schedule-rejected" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED</a>
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
						    	$sql = "SELECT a.*,b.full_name,b.email,b.candidate_code,c.job_title FROM sch_interview_schedule a JOIN sch_candidate_office b ON a.id_candidate = b.id JOIN sch_job_office c ON b.id_job=c.id WHERE a.category='office' AND a.status='0'";
								$candidate = $object->fetch_all($sql);
								if (count($candidate) > 0) {
									$number = 1;
									foreach ($candidate as $cand) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $cand['full_name'] ?></td>
								<td><?= $cand['job_title'] ?></td>
								<td align="center"><?= $object->dateConvertEng($cand['date']); ?></td>
								<td align="center"><?= $cand['time'] ?></td>
								<td align="center">
									
									<form role="form" method="POST" enctype="multipart/form-data">
										<input type="hidden" name="id" value="<?=$cand['id']?>">
										<span data-toggle="modal" data-target="#approve" class="btn btn-flat btn-primary btn-sm">APPROVE</span>
										<!-- <input type="submit" name="_approve"  class="btn btn-flat btn-primary btn-sm" class="btn btn-flat btn-success" title="Approve Schedule" value="APPROVE" onclick="return confirm('Approve Interview Schedule ?');"/> -->
										 <input type="submit" name="_decline"  class="btn btn-flat btn-danger btn-sm" class="btn btn-flat btn-success" title="Reject Schedule" value="REJECT" onclick="return confirm('Reject Interview Schedule ?');"/>
									</form>
								</td>
							</tr>

							<?php
					    	$number++;
					    	}}?>
						</tbody>
					</table>

					<?php 

						if(isset($_POST['_approve'])){
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
						      'status'=>'1',
						      'pic_name'=> $_POST['picName'],
						      'img_qrcode'=> $fileName
					      );
					        $conditions = array('id' =>strip_tags($_POST['id']));
					        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
					        
					        $message = file_get_contents(''.BASE_URL.'emailtemplates/office-barcode.html');
					        $message = str_replace("%cand['full_name']%", $cand['full_name'], $message);
					        $message = str_replace("%cand['job_title']%", $cand['job_title'], $message);
					        $message = str_replace("%cand['date']%", $cand['date'], $message);
					        $message = str_replace("%cand['time']%", $cand['time'], $message);
					        $message = str_replace("%_POST['pic_name']%", $_POST['pic_name'], $message);
					        $message = str_replace("%cand['img_qrcode']%", $cand['img_qrcode'], $message);
					        $message = str_replace("%BASE_URL%", BASE_URL, $message);
					       
					        $mail = new PHPMailer(true);                             
					                  
		        		  	$mail->SMTPDebug = 0;    
						    $mail->isSMTP();                         
						    $mail->Host = 'smtp.mailtrap.io'; 
						    $mail->SMTPAuth = true;                      
						    $mail->Username = 'a1526266572f65';   
						    $mail->Password = '49a15dc8363a34';                
						    $mail->SMTPSecure = 'tls';                         
						    $mail->Port = 2525;         

		                  	//Recipients
		                  	$mail->setFrom('demo@essentials.id', 'Soechi Recruitment');
		                  	$mail->addAddress(''.$cand['email'].'', ''.$cand['full_name'].'');    
		                  	$mail->addReplyTo('demo@essentials.id', 'Information');

		                  	//Content
		                  	$mail->isHTML(true);                                 
		                  	$mail->Subject = '[no-reply] Interview Schedule';
		                  	$mail->MsgHTML($message);

		                  	$mail->send();

					        @$msg = $_SESSION['statusMsg'] = $statusMsg;
					        echo "<script> window.location.assign('".$object->base_path()."o-interview-schedule-pending'); </script>";
					    }

					    if(isset($_POST['_decline'])){
					        $namatable = 'sch_interview_schedule';
					        $data = array(
						      'status'=> '2'
					      	);
					        $conditions = array('id' =>strip_tags($_POST['id']));
					        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
					        $message = file_get_contents(''.BASE_URL.'emailtemplates/office-reject-interview.html');
					        $message = str_replace("%cand['full_name']%", $cand['full_name'], $message);
					       
					        $mail = new PHPMailer(true);                             
					                  
			        		  $mail->SMTPDebug = 0;    
						      $mail->isSMTP();                         
						      $mail->Host = 'smtp.mailtrap.io'; 
						      $mail->SMTPAuth = true;                      
						      $mail->Username = 'a1526266572f65';   
						      $mail->Password = '49a15dc8363a34';                
						      $mail->SMTPSecure = 'tls';                         
						      $mail->Port = 2525;         

			                  //Recipients
			                  $mail->setFrom('demo@essentials.id', 'Soechi Recruitment');
			                  $mail->addAddress(''.$cand['email'].'', ''.$cand['full_name'].'');    
			                  $mail->addReplyTo('demo@essentials.id', 'Information');

			                  //Content
			                  $mail->isHTML(true);                                 
			                  $mail->Subject = '[no-reply] Interview Schedule';
			                  $mail->MsgHTML($message);

			                  $mail->send();
					        @$msg = $_SESSION['statusMsg'] = $statusMsg;
					        echo "<script> window.location.assign('".$object->base_path()."o-interview-schedule-pending'); </script>";
					    }

					 ?>
				</div>
				</div>
			</div>
		</div>
	</div>

<!-- Modal -->
  <div class="modal" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Confirm Schedule for <?= $cand['full_name'] ?></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form role="form" method="POST" enctype="multipart/form-data">
          <div class="container-fluid">
          <div class="row">

            <div class="col-md-12">

              <div align="center" class="col-md-8 offset-md-2">
              	<label  for="picName">Confirm PIC :</label>
                <input type="text" class="form-control" id="picName" name="picName" value="<?= $authadmin['name'] ?>" required>
              </div>                

            </div>
          </div>
      </div>
         
        </div>
        <div class="modal-footer">
          <input type="hidden" name="id" value="<?=$cand['id']?>">
          <input type="submit" name="_approve" class="btn btn-flat btn-primary" class="btn btn-flat btn-success"  value="SUBMIT" />
          </form>
        </div>
      </div>
    </div>
</div>