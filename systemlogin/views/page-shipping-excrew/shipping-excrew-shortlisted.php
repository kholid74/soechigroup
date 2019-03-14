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
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
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
                    	<a href="<?php echo $object->base_path()?>shipping-excrew-candidate-pending" class="btn btn-outline-secondary ">
                    		<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count1; ?></span> PENDING
                    	</a>
	                    <a href="<?php echo $object->base_path()?>shipping-excrew-candidate-shortlisted" class="btn btn-outline-secondary active">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count2; ?></span> SHORTLISTED</a>
	                    <a href="<?php echo $object->base_path()?>shipping-excrew-candidate-rejected" class="btn btn-outline-secondary">
	                    	<span class="badge badge-pill badge-primary" style="background-color: #0f5396"><?php echo $count3; ?></span> REJECTED</a>
                    </div>

                    <center><b>STATUS : <span class='badge badge-success'>SHORTLISTED</span></b></center>

                    <br>
                    <form method="post">
                    <div class="form-inline">
                        <div class="form-group">
                          <label>Filter by :&nbsp;</label>
                          	<select class="form-control" id="last_ship" name="last_ship">
		                      <option selected disabled>- Last Vessel -</option>
		                      <?php $ship = "SELECT id,name FROM sch_master_vessel ORDER BY id ASC";
		                            $all_ship = $object->fetch_all($ship);
		                              foreach ($all_ship as $showShip) {?>
		                      <option value="<?= $showShip['name'] ?>"><?= $showShip['name'] ?></option>
		                      <?php } ?>
		                    </select>                            
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <input type="submit" name="_filterVessel" class="btn btn-primary" value="Filter">
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                         
                          	<select class="form-control" id="last_rank" name="last_rank">
		                      <option selected disabled>-Last Rank-</option>
		                      <?php $rank = "SELECT * FROM sch_master_crewrank ORDER BY id ASC";
		                            $all_rank = $object->fetch_all($rank);
		                              foreach ($all_rank as $showRank) {?>
		                      <option value="<?= $showRank['short_name'] ?>"><?= $showRank['short_name'] ?></option>
		                      <?php } ?>
		                    </select>

                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <input type="submit" name="_filterRank" class="btn btn-primary" value="Filter">
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                         
                          	<select class="form-control" id="ready_date" name="ready_date">
		                      <option selected disabled>-Readiness Date-</option>
		                      <option value="1">January</option>
		                      <option value="2">February</option>
		                      <option value="3">March</option>
		                      <option value="4">April</option>
		                      <option value="5">May</option>
		                      <option value="6">June</option>
		                      <option value="7">July</option>
		                      <option value="8">August</option>
		                      <option value="9">September</option>
		                      <option value="10">October</option>
		                      <option value="11">November</option>
		                      <option value="12">December</option>
		                    </select>

                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <input type="submit" name="_filterDate" class="btn btn-primary" value="Filter">
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <a href="" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;RESET FILTER</a>
                        </div>

		                </div>

		            </form>

		            <br>				
						
							<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example1">
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

										if(isset($_POST['_filterVessel'])){

					                      $vessel  = $_POST['last_ship'];

					                      $sql = "SELECT a.*,b.name,c.short_name FROM sch_ex_candidate a JOIN sch_master_vessel b ON a.id_last_ship=b.id JOIN sch_master_crewrank c ON a.id_last_rank=c.id WHERE a.status='1' AND b.name='$vessel'";
					                      
					                      $fetchAll = $object->fetch_all($sql);
					                      $rows = count($fetchAll);
					                      
					                      echo '<p><b>'.$rows.'</b> result of <b>'.$_POST['last_ship'].'</b></p>';

					                  	}elseif(isset($_POST['_filterRank'])){

					                  		$rank  = $_POST['last_rank'];

					                      	$sql = "SELECT a.*,b.name,c.short_name FROM sch_ex_candidate a JOIN sch_master_vessel b ON a.id_last_ship=b.id JOIN sch_master_crewrank c ON a.id_last_rank=c.id WHERE a.status='1' AND c.short_name='$rank'";
					                      
					                      	$fetchAll = $object->fetch_all($sql);
					                      	$rows = count($fetchAll);
					                      
					                      	echo '<p><b>'.$rows.'</b> result of <b>'.$_POST['last_rank'].'</b></p>';

					                    }elseif(isset($_POST['_filterDate'])){

					                    	$date  = $_POST['ready_date'];

					                      	$sql = "SELECT a.*,b.name,c.short_name FROM sch_ex_candidate a JOIN sch_master_vessel b ON a.id_last_ship=b.id JOIN sch_master_crewrank c ON a.id_last_rank=c.id WHERE a.status='1' AND MONTH(a.ready_join_date)='$date'";
					                      
					                      	$fetchAll = $object->fetch_all($sql);
					                      	$rows = count($fetchAll);
					                      
					                      	echo '<p><b>'.$rows.'</b> result of <b>'.$_POST['ready_date'].'</b></p>';

					                  	}else{

					                  		$sql = "SELECT a.*,b.name,c.short_name FROM sch_ex_candidate a JOIN sch_master_vessel b ON a.id_last_ship=b.id JOIN sch_master_crewrank c ON a.id_last_rank=c.id WHERE a.status='1'";

					                  	}

								    	
										$candidate = $object->fetch_all($sql);
										if (count($candidate) > 0) {
											$number = 1;
											foreach ($candidate as $cand) { 
												$month = date($cand['ready_join_date']); ?>
									<tr>
										<td><?php echo $number;?></td>
										<td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
										<td><?= $cand['company_id'] ?></td>
										<td><?= $cand['name'] ?></td>
										<td align="center"><?= $cand['short_name'] ?></td>
										<td align="center">
											<?php if ($cand['status'] == 1) {
											echo "<span class='badge badge-success'>SHORTLISTED</span>";} ?>
										</td>
										<td align="center"><?php echo $object->dateConvertEng($cand['ready_join_date']); ?></td>
										<td align="center">
											<a class="btn btn-success btn-sm" href="<?php echo $object->base_path()?>excrew-shortlisted-details/<?= $cand['id'] ?>" title="view <?= $cand['first_name'] ?> <?= $cand['last_name'] ?>">
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