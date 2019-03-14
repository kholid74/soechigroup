<?php
	error_reporting(E_ALL);

	$sql = "SELECT a.*,b.id_job_name,c.name,c.deck_engine,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE a.id=".$authadmin['id']."";

	$candidate = $object->fetch($sql);

	$sql2 = "SELECT * FROM sch_cand_ship_nextkin WHERE id_candidate=".$authadmin['id']."";
	$nextKin = $object->fetch($sql2);

	$country = "SELECT en_short_name FROM sch_countries WHERE num_code=".$candidate['id_countries']."";
	$showCountry = $object->fetch($country);

?>
<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item active"><?=$candidate['first_name']?> <?=$candidate['last_name']?></li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <!-- <span>You logged as Candidate</b></span> -->
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

					<!-- Main row -->
				      <div class="row">
				        <div class="col-lg-12">
				          <!-- <div class="col-md-4" style="background-color: #f0f3f5;margin-bottom: 20px;">
				          	<img src="<?php echo BASE_URL; ?>media/images/img-nopict.jpg" style="border-radius: 110px;" id="preview" width="100" height="100">
				          </div> -->
				          <div class="col-md-12" style="background-color: #f0f3f5;margin-bottom: 20px;">
				            <table style="font-weight: bold;line-height: 2;">
					            <tbody>
						            <tr>
						              <td  width="30%" rowspan="5" align="center">
						              	<?php if(empty($candidate['photo'])){ ?>
										<img src="<?php echo BASE_URL; ?>media/images/img-nopict.jpg" width="129" height="125">
										<?php }else{ ?>
										<img src="<?php echo BASE_URL; ?>media/images/photos/<?= $candidate['photo'] ?>" width="119" height="115">
										<?php } ?>
						              </td>
				                      <td width="30%">Name</td>
				                      <td>:&nbsp;</td>
				                      <td><?=$candidate['first_name']?> <?=$candidate['last_name']?></td>
				                    </tr>
						            <tr>
						              <td width="35%">Applied For</td>
						              <td>:&nbsp;</td>
						              <td><?=$candidate['name']?></td>
						            </tr>
						            <tr>
						              <td width="35%">Category</td>
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
						              	<span class='badge badge-success'><?= $candidate['status']; ?></span>
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
						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#attachment" role="tab" aria-controls="attach" aria-selected="false">Document Uploads</a>
						  </li>
						</ul>
						<div class="tab-content" id="myTabContent">
						  <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">
						  	<!--PERSONAL INFORMATION-->
						  	   <div>
			                    <h3 style="font-weight: bold;">Personal Information</h3>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
			                    <table style="font-weight: bold;">
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
								    	$sql = "SELECT a.*,b.name,b.vessel_type,b.vessel_flag FROM sch_cand_ship_prejoin_exp a JOIN sch_master_vessel b ON a.id_vessel=b.id WHERE a.id_candidate = ".$authadmin['id']."";
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
			                    <table class="table" style="font-weight: bold;line-height: 2;">
				                    <tbody>

				                    <tr>
				                      <td>CV</td>
				                      <td><a class="btn btn-md btn-primary" href="<?php echo BASE_URL ?>media/files/<?=$candidate['cv']?>" target="_blank" style="font-weight: bold;">VIEW&nbsp;<i class="fa fa-eye"></i></a></td>
				                    </tr>

				                    <tr>
				                      <td>SEAMAN BOOK</td>
				                      <td><a class="btn btn-md btn-primary" href="<?php echo BASE_URL ?>media/files/<?=$candidate['seaman_book']?>" target="_blank" style="font-weight: bold;">VIEW&nbsp;<i class="fa fa-eye"></i></a></td>
				                    </tr>

				                    <tr>
				                      <td>CONTRACT</td>
				                      <td><a class="btn btn-md btn-primary" href="<?php echo BASE_URL ?>media/files/<?=$candidate['contract1']?>" target="_blank" style="font-weight: bold;">VIEW&nbsp;<i class="fa fa-eye"></i></a></td>
				                    </tr>

				                    </tbody>
			                  </table>
			                  </div>
			                <!--END ATTACHMENTS -->
						  </div>
						</div>

				          <div align="center">
							<br><br>
							<a href="<?php echo $object->base_path()?>personal-info" class="btn btn-flat btn-success">&nbsp;<i class="fa fa-pencil"></i>&nbsp;&nbsp;EDIT PROFILE&nbsp;</a>

				          </div>
				        </div>
				      </div>

				</div>
				</div>
			</div>
		</div>
	</div>
