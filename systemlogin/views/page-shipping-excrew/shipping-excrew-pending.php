<?php 

  /*PENDING*/

  $sql1   = "SELECT * FROM sch_ex_candidate WHERE status='0' AND candidate_code !=''";

  $show1  = $object->fetch_all($sql1);

  $count1 = count($show1); 



  /*SHORTLIST*/

  $sql2   = "SELECT * FROM sch_ex_candidate WHERE status='1'";

  $show2  = $object->fetch_all($sql2);

  $count2 = count($show2);



  /*REJECT*/

  $sql3   = "SELECT * FROM sch_ex_candidate WHERE status='2'";

  $show3  = $object->fetch_all($sql3);

  $count3 = count($show3); 



 ?>

<!-- Main content -->

    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item">Shipping</li>

        <li class="breadcrumb-item active">Ex-Crew</li>



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

				<h4 style="text-align: center">EX-CREW CANDIDATE</h4>

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

                    	<a href="<?php echo $object->base_path()?>shipping-excrew-candidate-pending" class="btn btn-outline-secondary active">

                    		<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING

                    	</a>

	                    <a href="<?php echo $object->base_path()?>shipping-excrew-candidate-shortlisted" class="btn btn-outline-secondary">

	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> SHORTLISTED</a>

	                    <a href="<?php echo $object->base_path()?>shipping-excrew-candidate-rejected" class="btn btn-outline-secondary">

	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED</a>

                    </div>



                    <center><b>STATUS : <span class='badge badge-warning'>PENDING</span></b></center>

					

						<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">

							<thead>

								<tr>

									<td style="font-weight: bold;text-align: center;">No</td>

									<td style="font-weight: bold;text-align: center;">Name</td>

									<td style="font-weight: bold;text-align: center;">Company ID</td>

									<td style="font-weight: bold;text-align: center;">Last Vessel Name</td>

									<td style="font-weight: bold;text-align: center;">Last Rank</td>

									<td style="font-weight: bold;text-align: center;">Status</td>

									<td style="font-weight: bold;text-align: center;">Date of Readiness</td>

									<td style="font-weight: bold;text-align: center;">Action</td>

								</tr>

							</thead>

							<tbody>

								<?php 

							    	$sql = "SELECT a.*,b.name,c.short_name FROM sch_ex_candidate a JOIN sch_master_vessel b ON a.id_last_ship=b.id JOIN sch_master_crewrank c ON a.id_last_rank=c.id WHERE a.status='0' OR a.status='3'";

									$candidate = $object->fetch_all($sql);

									if (count($candidate) > 0) {

										$number = 1;

										foreach ($candidate as $cand) {?>

								<tr>

									<td><?php echo $number;?></td>

									<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>

									<td><?= $cand['company_id'] ?></td>

									<td><?= $cand['name'] ?></td>

									<td align="center"><?= $cand['short_name'] ?></td>

									<td align="center">

										<?php if ($cand['status'] == 0) {

												echo "<span class='badge badge-warning'>PENDING REVIEW</span>";

											}elseif($cand['status'] == 3){

												echo "<span class='badge badge-dark'>WAITING MANAGER DECISION</span>";

											} ?>

									</td>

									<td align="center"><?php echo $object->dateConvertEng($cand['ready_join_date']); ?></td>

									<td align="center">

										<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>excrew-pending-details/<?= $cand['id'] ?>" title="View <?= $cand['first_name'] ?> <?= $cand['last_name'] ?>">

										<i class="fa fa-eye"></i>&nbsp;VIEW

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