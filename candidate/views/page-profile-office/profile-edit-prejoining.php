<style type="text/css">
	.sw-theme-circles > ul.step-anchor:before {
	    content: " ";
	    position: absolute;
	    top: 50%;
	    bottom: 0;
	    width: 100%;
	    height: 5px;
	    background-color: #f5f5f5;
	    border-radius: 3px;
	    z-index: 0;
	}
	.sw-theme-circles > ul.step-anchor > li > a {
		font-size: 11px;
	    border: 2px solid #f5f5f5;
	    background: #f5f5f5;
	    width: 100px;
	    height: 100px;
	    text-align: center;
	    padding: 40px 0;
	    border-radius: 50%;
	    -webkit-box-shadow: inset 0px 0px 0px 3px #fff !important;
	    box-shadow: inset 0px 0px 0px 3px #fff !important;
	    text-decoration: none;
	    outline-style: none;
	    z-index: 99;
	    color: #bbb;
	    background: #f5f5f5;
	    line-height: 1;
	}
	.sw-theme-circles > ul.step-anchor > li {
	    border: none;
	    margin-left: 130px;
	    z-index: 98;
	}
</style>

<?php
	error_reporting(E_ALL);

	$sql = "SELECT a.*,b.job_name,b.id_jobcat,c.*,d.category_name FROM sch_candidate_shipping a JOIN sch_jobs b ON a.id_job = b.id JOIN sch_countries c ON a.id_countries=c.num_code JOIN sch_job_shipping_cat d ON b.id_jobcat=d.id WHERE a.id=".$authadmin['id']."";
	$candidate = $object->fetch($sql);

	if(isset($_POST['_save'])) {
	    $namatable = 'sch_cand_ship_prejoin_exp';
	    $data = array(
	      'id_candidate'=> $_POST['id'],
	      'vessel_name'=> $_POST['vesselName'],
	      'flag'=> $_POST['flag'],
	      'vessel_type'=> $_POST['vesselType'],
	      'dwt_grt'=> $_POST['dwt_grt'],
	      'me_makemodel'=> $_POST['make_model'],
	      'me_bhp'=> $_POST['me_bhp'],
	      'rank'=> $_POST['rank'],
	      'date_from'=> $_POST['from'],
	      'date_to'=> $_POST['to'],
	      'company_name'=> $_POST['company_name']
	    );
	    $insert = $object->tambahdata($namatable,$data);
	    $object->messagesin($insert);
    	echo "<script> window.location.assign('".$object->base_path()."edit-profile-3'); </script>";
  }

?>
<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>profile"><?=$candidate['first_name']?> <?=$candidate['last_name']?></a></li>
        <li class="breadcrumb-item active">Edit Profile</li>

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
				<h4 style="text-align: center">EDIT PROFILE</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">

					</div>
				<div class="card-body">
					<!-- Main row -->
				      <div class="row">
				          <div class="col-md-12">
				          	<div id="smartwizard" class="sw-main sw-theme-circles" align="center">
                                <ul class="nav nav-tabs step-anchor">
                                    <li class="nav-item"><a href="#personal-data" class="nav-link" style="">PERSONAL DATA</a></li>
                                    <li class="nav-item active"><a href="#next-of-kin-details" class="nav-link" style="">NEXT OF KIN DETAILS</a></li>
                                    <li class="nav-item active"><a href="#prejoining-experience" class="nav-link">PRE JOINING EXPERIENCE</a></li>
                                    <li class="nav-item"><a href="#initial-declaration" class="nav-link">INITIAL DECLARATION</a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

				          <div class="col-md-12">
				          	<br>
				          	<span data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary"><i class="fa fa-plus "></i>&nbsp;Add New</span>
				          	<br>
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
				                    		<td>Action</td>
				                    	</tr>
				                    </thead>
				                    <tbody>
									<?php 
								    	$sql = "SELECT * FROM sch_cand_ship_prejoin_exp WHERE id_candidate = ".$authadmin['id']."";
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
				                      <td><?= $preJoin['vessel_name'] ?></td>
				                      <td><?= $preJoin['flag'] ?></td>
				                      <td><?= $preJoin['vessel_type'] ?></td>
				                      <td><?= $preJoin['dwt_grt'] ?></td>
				                      <td><?= $preJoin['me_makemodel'] ?></td>
				                      <td><?= $preJoin['me_bhp'] ?></td>
				                      <td><?= $preJoin['rank'] ?></td>
				                      <td><?= $preJoin['date_from'] ?></td>
				                      <td><?= $preJoin['date_to'] ?></td>
				                      <td><?php echo "$dd->m months $dd->d days"; ?></td>
				                      <td><?= $preJoin['company_name'] ?></td>
				                      <td align="center"><a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-prejoin-exp/<?php echo $preJoin['id']?>" onclick="return confirm('Confirm delete ?')" >
									<i class="fa fa-trash-o "></i>
									</a></td>
				                    </tr>
				                    <?php
								    	$number++;
								    	}}?>
				                    <hr>
				                    </tbody>
				                  </table>
								<br><br>
								<center>
									<a href="<?php echo $object->base_path()?>edit-profile-2/<?=$candidate['id']?>" class="btn btn-flat btn-primary">BACK</a>
									<a href="<?php echo $object->base_path()?>edit-profile-4" class="btn btn-primary">&nbsp;&nbsp;NEXT&nbsp;&nbsp;</a>
								</center>
								<!-- Modal -->
							<div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Add Pre Joining Experience</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							      	<form role="form" method="POST" enctype="multipart/form-data">
							      	<div class="container-fluid">
									    <div class="row">

									      <div class="col-md-6">
									      	  <div class="form-group">
									            <label for="message-text" class="col-form-label">Vessel Name :</label>
									            <input type="text" class="form-control" id="vesselName" name="vesselName" required>
									          </div>
									          <div class="form-group">
									            <label for="message-text" class="col-form-label">Flag :</label>
									            <input type="text" class="form-control" id="flag" name="flag" required>
									          </div>
									          <div class="form-group">
									            <label for="message-text" class="col-form-label">Vessel Type :</label>
									            <input type="text" class="form-control" id="vesselType" name="vesselType" required>
									          </div>
									          <div class="form-group">
									            <label for="message-text" class="col-form-label">DWT GRT :</label>
									            <input autocomplete="off" type="text" class="form-control" name="dwt_grt" maxlength="7" onkeypress="return isNumber(event)" required>
									          </div>
									          <div class="form-group">
									            <label for="message-text" class="col-form-label">M/E Make Model : <br><small><i>(Require for engine)</i></small></label>
									            <input type="text" class="form-control" id="make_model" name="make_model">
									          </div>
									      </div>
									      <div class="col-md-6">
									      	 <div class="form-group">
									            <label for="message-text" class="col-form-label">M/E BHP <small><i>(Optional)</i></small> :</label>
									            <input type="text" class="form-control" id="me_bhp" name="me_bhp">
									          </div>
									      	  <div class="form-group">
									            <label for="message-text" class="col-form-label">Rank :</label>
									            <input type="text" class="form-control" id="rank" name="rank" required>
									          </div>
									          <div class="form-group">
									            <label for="message-text" class="col-form-label">From :</label>
									            <input type="date" class="form-control" id="from" name="from" required>
									          </div>
									          <div class="form-group">
									            <label for="message-text" class="col-form-label">To :</label>
									            <input type="date" class="form-control" id="to" name="to" required>
									          </div>
									          <div class="form-group">
									            <label for="message-text" class="col-form-label">Company Name :</label>
									            <input type="text" class="form-control" id="company_name" name="company_name" required>
									          </div>
									      </div>
									    </div>
									</div>
							       
							      </div>
							      <div class="modal-footer">
							        <input type="hidden" name="id" value="<?=$candidate['id']?>">
							        <input type="submit" name="_save"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add Pre Joining Experience" value="SAVE" />
							        </form>
							      </div>
							    </div>

							  </div>
							</div>

				          </div>
				      </div>
				</div>
				</div>
			</div>
		</div>
	</div>

<script>

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        if (charCode > 31 && (charCode < 48 || charCode > 57)) {
            return false;
        }
        return true;
    }
</script> 