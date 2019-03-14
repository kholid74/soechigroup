<?php
	error_reporting(E_ALL);

	$sql = "SELECT a.*,b.name,c.short_name FROM sch_ex_candidate a JOIN sch_master_vessel b ON a.id_last_ship=b.id JOIN sch_master_crewrank c ON a.id_last_rank=c.id WHERE a.id=".$authadmin['id']."";
	$candidate = $object->fetch($sql);

	$sql2 = "SELECT * FROM sch_cand_ship_nextkin WHERE id_candidate=".$authadmin['id']."";
	$nextKin = $object->fetch($sql2);

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
				<h4 style="text-align: center">EXCREW CANDIDATE</h4>
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
					              <td><?php if ($candidate['status'] == 1) {
										echo "<span class='badge badge-success'>SHORTLISTED</span>";} ?></td>
					            </tr>
					            </tbody>
				          </table>
				          </div>
						<ul class="nav nav-tabs" id="myTab" role="tablist">
						  <li class="nav-item">
						    <a class="nav-link active" id="personal-info-tab" data-toggle="tab" href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">Personal Information</a>
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
				                      <td>Company ID</td>
				                      <td>:&nbsp;</td>
				                      <td><?=$candidate['company_id']?></td>
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
				                      <td width="50%">Applied Date</td>
				                      <td>:&nbsp;</td>
				                      <td><?=$candidate['created']?></td>
				                    </tr>
				                    </tbody>
			                    </table>
			                  </div>
						  	<!--END PERSONAL INFORMATION-->
						  </div>
						</div>

				          <div align="center">
							<br><br>
							

				          </div>
				        </div>
				      </div>

				</div>
				</div>
			</div>
		</div>
	</div>
