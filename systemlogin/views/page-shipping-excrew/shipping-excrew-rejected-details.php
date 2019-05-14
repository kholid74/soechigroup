<?php 



    $sql = "SELECT a.*,b.name,c.short_name FROM sch_ex_candidate a JOIN sch_master_vessel b ON a.id_last_ship=b.id JOIN sch_master_crewrank c ON a.id_last_rank=c.id WHERE a.id=".$_GET['ids']."";

	$candidate = $object->fetch($sql);

	$canCode  = $candidate['candidate_code'];



	$candCode  = $candidate['candidate_code'];

	$candEmail = $candidate['email'];



	$candHistory  = "SELECT * FROM sch_candidate_history WHERE candidate_code='$candCode'";

    $history      = $object->fetch_all($candHistory);

    $countHistory = count($history);



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

    	echo "<script> window.location.assign('".$object->base_path()."excrew-rejected-details/".$candidate['id']."'); </script>";

  }



	  if(isset($_POST['_complete'])){

	    $namatable = 'sch_cand_notes';



	    $data = array(

	      'status'=> '1'

	  	);

	    $conditions = array('id' =>strip_tags($_POST['id']));

	    $statusMsg =  $object->updatedata($namatable,$data,$conditions);

	    echo "<script> window.location.assign('".$object->base_path()."excrew-rejected-details/".$candidate['id']."'); </script>";

	}

 





?>

<!-- Main content -->

    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item">Ex-Crew</li>

        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>shipping-excrew-candidate-rejected">Ex-Crew Details</a></li>

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

				<h4 style="text-align: center">EX-CREW DETAILS</h4>

				<center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>

				<div class="card">

					<div class="card-header">

						

					</div>

				<div class="card-body">

					

					<!-- Main row -->

				      <div class="row">

				        <div class="col-lg-12">

				        <a href="<?php echo $object->base_path()?>shipping-excrew-candidate-rejected" style="font-weight: bold;color: #084f93;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;&nbsp;BACK TO CANDIDATE LIST</a>

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

				              <td width="55%">Last Ship</td>

				              <td>:&nbsp;</td>

				              <td><?=$candidate['name']?></td>

				            </tr>

				            <tr>

				              <td width="55%">Last Rank</td>

				              <td>:&nbsp;</td>

				              <td><?=$candidate['short_name']?></td>

				            </tr>

				            <tr>

				              <td>Readiness Date</td>

				              <td>:&nbsp;</td>

				              <td><?= $candidate['ready_join_date']; ?></td>

				            </tr>

				            <tr>

				              <td>Status</td>

				              <td>:&nbsp;</td>

				              <td><?php if ($candidate['status'] == 2) {

									echo "<span class='badge badge-danger'>REJECTED</span>";

									}?>

								</td>

				            </tr>

				            <tr>

				              <td>Reason</td>

				              <td>:&nbsp;</td>

				              <td><?= $candidate['reason_reject']; ?></td>

				            </tr>

				            </tbody>

				          </table>

				          </div>

						<ul class="nav nav-tabs" id="myTab" role="tablist">

						  <li class="nav-item">

						    <a class="nav-link active" id="personal-info-tab" data-toggle="tab" href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">Personal Information</a>

						  </li>

						

						  <li class="nav-item">

						    <a class="nav-link" id="candidate-history-tab" data-toggle="tab" href="#candidate-history" role="tab" aria-controls="candidate-history" aria-selected="false"><span class='badge badge-danger'><?php echo $countHistory; ?></span>&nbsp;Candidate History</a>

						  </li>



						  <li class="nav-item">

						    <a class="nav-link" id="doc-upload-tab" data-toggle="tab" href="#doc-upload" role="tab" aria-controls="doc-upload" aria-selected="false">Document Uploads</a>

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

			                      <td>ID Card Number (KTP/Pasport)</td>

			                      <td>:&nbsp;</td>

			                      <td><?=$candidate['idcard_number']?></td>

			                    </tr>

			                    <tr>

			                      <td>Company ID</td>

			                      <td>:&nbsp;</td>

			                      <td><?=$candidate['company_id']?></td>

			                    </tr>

			                    <tr>

			                      <td width="50%">Last ship</td>

			                      <td>:&nbsp;</td>

			                      <td><?=$candidate['name']?></td>

			                    </tr>

			                    <tr>

			                      <td width="50%">Last Rank</td>

			                      <td>:&nbsp;</td>

			                      <td><?=$candidate['short_name']?></td>

			                    </tr>

			                    <tr>

			                      <td>Email</td>

			                      <td>:&nbsp;</td>

			                      <td><?=$candidate['email']?></td>

			                    </tr>

			                    <tr>

			                      <td width="50%">Phone</td>

			                      <td>:&nbsp;</td>

			                      <td><?=$candidate['phone']?></td>

			                    </tr>

			                    <tr>

			                      <td width="50%">Readiness Join Date</td>

			                      <td>:&nbsp;</td>

			                      <td><?=$candidate['ready_join_date']?></td>

			                    </tr>

			                    <tr>

			                      <td width="50%">Applied Date</td>

			                      <td>:&nbsp;</td>

			                      <td><?=$candidate['created']?></td>

			                    </tr>

			                    </tbody>

			                    </table>

			                  </div>

						  	<!--END PERSONAL INFORMATION-->

						  </div>

						 

						  <div class="tab-pane fade" id="candidate-history" role="tabpanel" aria-labelledby="candidate-history-tab">

						  	<!-- CANDIDATE HISTORY -->

			                  <div>

			                    <h3 style="font-weight: bold;">Candidate History</h3>

			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">

			                    	<div class="col md-12">

				                    	<div class="timeline-centered">

									        <?php 



				                    			$candHistoryy  = "SELECT a.*,b.email FROM sch_candidate_history a JOIN sch_ex_candidate b ON a.candidate_code=b.candidate_code WHERE a.candidate_code='$candCode'";

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



						<div class="tab-pane fade" id="doc-upload" role="tabpanel" aria-labelledby="attach-tab">

						  	<!-- DOC UPLOAD -->

							

							<table class="table table-responsive-sm table-bordered table-striped table-sm">

			                <thead>

			                  <tr style="font-weight: bold;">

			                    <td align="center">NO</td>

			                    <td align="center">DOCUMENT NAME</td>

			                    <td align="center">STATUS</td>

			                    <td align="center">ACTION</td>

			                  </tr>

			                </thead>

			                <tbody>

			                <?php 

			                  $sql = "SELECT * FROM sch_ex_candidate_document WHERE id_excrew = ".$_GET['ids']."";

			                  $exp = $object->fetch_all($sql);

			                  if (count($exp) > 0) {

			                    $number = 1;

			                    foreach ($exp as $docUpload) {?>

			                <tr>

			                  <td align="center"><?= $number; ?></td>

			                  <td><?= $docUpload['doc_name'] ?></td>

			                  <td align="center">

			                    <span class="badge badge-success">SUCCESS</span>

			                  </td>

			                  <td align="center">

			                    <a class="btn btn-success btn-sm" href="<?php echo BASE_URL ?>media/files/<?= $docUpload['file_upload'] ?>" target="_blank"><i class="fa fa-eye"></i></a>

			                  </td>

			                </tr>

			                <?php $number++; }} ?>

			                <hr>

			                </tbody>

			              </table>



							<!-- END DOC UPLOAD -->

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

				          

				        

				          <br>

				          <a href="<?php echo $object->base_path()?>shipping-excrew-candidate-rejected" style="font-weight: bold;color: #084f93;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;&nbsp;BACK TO CANDIDATE LIST</a>

				        </div>

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