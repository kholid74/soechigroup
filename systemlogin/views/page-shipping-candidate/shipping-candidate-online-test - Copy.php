<?php

  

  use PHPMailer\PHPMailer\PHPMailer;

  use PHPMailer\PHPMailer\Exception;



  require_once dirname( __FILE__ ) . '../../../../vendor/autoload.php';

	

  /*Number of Crew Applied Pending Review*/

  $sql1   = "SELECT * FROM sch_cand_shipping_status WHERE status='PENDING_REVIEW' OR status='REJECT_MANAGER_DECISION'";

  $show1  = $object->fetch_all($sql1);

  $count1 = count($show1); 



  /*Number of Shortlisted for Interview*/

  $sql2   = "SELECT * FROM sch_cand_shipping_status WHERE status='SHORTLISTED'";

  $show2  = $object->fetch_all($sql2);

  $count2 = count($show2);



  /*Reject Review*/

  $sql3   = "SELECT * FROM sch_cand_shipping_status WHERE status='REJECTED'";

  $show3  = $object->fetch_all($sql3);

  $count3 = count($show3); 



  /*INTERVIEW PASSED*/

  $sql4   = "SELECT * FROM sch_cand_shipping_status WHERE status='INTERVIEW_PASS'";

  $show4  = $object->fetch_all($sql4);

  $count4 = count($show4);



  /*INTERVIEW FAILED*/

  $sql5   = "SELECT * FROM sch_cand_shipping_status WHERE status='INTERVIEW_FAIL'";

  $show5  = $object->fetch_all($sql5);

  $count5 = count($show5);



  /*REFUSE JOINED*/

  $sql6   = "SELECT * FROM sch_cand_shipping_status WHERE status='REFUSE_JOINED'";

  $show6  = $object->fetch_all($sql6);

  $count6 = count($show5);



  /*JOINED*/

  $sql7   = "SELECT * FROM sch_cand_shipping_status WHERE status='JOINED'";

  $show7  = $object->fetch_all($sql7);

  $count7 = count($show7);



  



function sendEmail($email){



	$mail = new PHPMailer(true);



	  $mail->SMTPDebug = 0;    

      $mail->isSMTP();                         

      $mail->Host = 'smtp.mailtrap.io'; 

      $mail->SMTPAuth = true;                      

      $mail->Username = 'a1526266572f65';   

      $mail->Password = '49a15dc8363a34';                

      $mail->SMTPSecure = 'tls';                         

      $mail->Port = 2525;                            

      

      $message = file_get_contents(''.BASE_URL.'emailtemplates/shipping-online-test.html');

      $message = str_replace("%_POST['urlTest']%", $_POST['urlTest'], $message);

     

      //Recipients

      $mail->setFrom('demo@essentials.id', 'Soechi Recruitment');



      $mail->addAddress($email, 'Candidate');  



      $mail->addReplyTo('demo@essentials.id', 'Information');



      //Content

      $mail->isHTML(true);              

      $mail->Subject = '[no-reply] Online Test';

      $mail->MsgHTML($message);



      if(!$mail->send()) {

			echo 'Message could not be sent.';

			echo 'Mailer Error: ' . $mail->ErrorInfo;

	} else {



		$statusMsg = "Email has been sent..";

		//echo "<script> window.location.assign('".$object->base_path()."shipping-candidate-online-test'); </script>";

	}



      



}





  if(isset($_POST['_sendTest'])){



  	  $sql = "SELECT a.*, b.email FROM sch_cand_online_test a JOIN sch_candidate_shipping b ON a.candidate_code=b.candidate_code WHERE a.result=''";



	  $candidate = $object->fetch_all($sql);

	  foreach ($candidate as $cand) {



	  	$email  = $cand['email'];

	  	$candID = $cand['id'];

	  	

	  	sendEmail($email);



	  	$status="UPDATE `sch_cand_online_test` SET `result`='EMAIL SENT' WHERE id in ($candID)";



	     $object->add($status);

      

      }



  }



 ?>



<!-- Main content -->

    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item">Shipping</li>

        <li class="breadcrumb-item active">Shortlisted Candidate</li>



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

				<h4 style="text-align: center">SHORTLISTED CANDIDATE</h4>

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



	                    <a href="<?php echo $object->base_path()?>shipping-candidate-shortlisted" class="btn btn-outline-secondary ">

	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> SHORTLISTED</a>

	                    

	                    <a href="<?php echo $object->base_path()?>shipping-candidate-rejected" class="btn btn-outline-secondary">

	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED</a>

	                    

	                    <a href="<?php echo $object->base_path()?>shipping-candidate-online-test" class="btn btn-outline-secondary active">

	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> ONLINE TEST</a>



	                    <a href="<?php echo $object->base_path()?>shipping-candidate-interview-passed" class="btn btn-outline-secondary">

	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count4; ?></span> INTERVIEW PASSED</a>

	                    

	                    <a href="<?php echo $object->base_path()?>shipping-candidate-interview-failed" class="btn btn-outline-secondary">

	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count5; ?></span> INTERVIEW FAILED</a>

                    </div>

					<br>



				

					<div class="tab-content" id="myTab1Content">

						<br>

						<!-- <center>

						<span class="btn btn-flat btn-primary" data-toggle="modal" data-target="#sendtest"><i class="fa fa-envelope"></i>&nbsp;SEND ONLINE TEST TO CANDIDATE</span>

						</center> -->

						<div class="tab-pane fade active show" id="pending" role="tabpanel" aria-labelledby="pending-tab">

							<table class="table table-responsive-sm table-bordered table-striped table-sm" id="">

								<thead>

									<tr>

										<td style="font-weight: bold;text-align: center;">No</td>

										<td style="font-weight: bold;text-align: center;">Name</td>

										<td style="font-weight: bold;text-align: center;">Job Position</td>

										<td style="font-weight: bold;text-align: center;">Online Test</td>

										<td style="font-weight: bold;text-align: center;">Action</td>

									</tr>

								</thead>

								<tbody>

									<?php 

								    	$sql = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='SHORTLISTED'";

										$candidate = $object->fetch_all($sql);

										if (count($candidate) > 0) {

											$number = 1;

											foreach ($candidate as $cand) {?>

									<tr>

										<td><?php echo $number;?></td>

										<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>

										<td><?= $cand['name'] ?></td>

										

										

										<td align="center">

											

											<span class='badge badge-danger'>NOT ACTIVE</span>



											<!-- <form role="form" method="POST" enctype="multipart/form-data">

												<input type="submit" name="_toactive" class="btn btn-flat btn-danger btn-sm" title="Click" value="NOT ACTIVE"/>

											</form> -->

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



	<!-- Modal -->

	<div class="modal" id="sendtest" tabindex="-1" role="dialog" aria-labelledby="sendtest" aria-hidden="true">

	  <div class="modal-dialog modal-dialog-centered" role="document">

	    <div class="modal-content">

	      <div class="modal-header">

	        <h5 class="modal-title" id="exampleModalLongTitle">Input URL Test</h5>

	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

	          <span aria-hidden="true">&times;</span>

	        </button>

	      </div>

	      <div class="modal-body">

	       <div class="modal-body">

              <form role="form" method="POST" enctype="multipart/form-data">

              <div class="container-fluid">

              <div class="row">



                <div class="col-md-12">



                   <div class="form-group row">

	                  

	                  <div class="col-sm-12" align="center">

	                  	<label for="urlTest">Insert URL Test :</label>

	                    <input type="text" class="form-control" id="urlTest" name="urlTest" required>

	                  </div>



	                 </div>



                </div>

              </div>

          </div>

             

            </div>

	      </div>

	      <div class="modal-footer">

	        <input type="submit" name="_sendTest" class="btn btn-flat btn-primary" value="SEND ONLINE TEST" />

	        </form>

	      </div>

	    </div>

	  </div>

	</div>

<!-- end modal -->