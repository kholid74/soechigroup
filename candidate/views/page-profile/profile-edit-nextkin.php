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
	    width: 150px;
	    height: 150px;
	    text-align: center;
	    padding: 60px 0;
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
	    margin-left: 90px;
	    z-index: 98;
	}
</style>

<?php
	error_reporting(E_ALL);

	$sql = "SELECT a.*,b.id_job_name,c.name,c.deck_engine FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id WHERE a.id=".$authadmin['id']."";
	$candidate = $object->fetch($sql);

	$sql2 = "SELECT * FROM sch_cand_ship_nextkin WHERE id_candidate=".$authadmin['id']."";
	$nextKin = $object->fetch($sql2); 

	$countNextKin = $object->fetch_all($sql2);
	$countNext = count($countNextKin); 

	if ($countNext > 0) {
		if(isset($_POST['_update'])){
	        $namatable = 'sch_cand_ship_nextkin';
	        $data = array(
		      'first_name'=> $_POST['firstName'],
		      'last_name'=> $_POST['lastName'],
		      'date_of_birth'=> $_POST['dateofBirth'],
		      'address'=> $_POST['address'],
		      'phone'=> $_POST['phoneNumber'],
		      'relationship'=> $_POST['relationship'],
		      'dependents'=> $_POST['dependents']
	      );
	        $conditions = array('id' =>strip_tags($_POST['id']));
	        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
	        @$msg = $_SESSION['statusMsg'] = $statusMsg;
	        echo "<script> window.location.assign('".$object->base_path()."prejoining-experience'); </script>";
	    }

	}else if ($countNext == 0){
		if(isset($_POST['_update'])) {
		    $namatable = 'sch_cand_ship_nextkin';
		    $data = array(
		      'id_candidate'=> $authadmin['id'],
		      'first_name'=> $_POST['firstName'],
		      'last_name'=> $_POST['lastName'],
		      'date_of_birth'=> $_POST['dateofBirth'],
		      'address'=> $_POST['address'],
		      'phone'=> $_POST['phoneNumber'],
		      'relationship'=> $_POST['relationship'],
		      'dependents'=> $_POST['dependents']
		    );
		    $insert = $object->tambahdata($namatable,$data);
		    $object->messagesin($insert);
	    	echo "<script> window.location.assign('".$object->base_path()."prejoining-experience'); </script>";
	  }
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
                                    <li class="nav-item"><a href="#personal-data" class="nav-link" style="">PERSONAL DATA /<br> <i>Data Pribadi</i></a></li>
                                    <li class="nav-item active"><a href="#next-of-kin-details" class="nav-link" style="">NEXT OF KIN DETAILS /<br><i>Data Kerabat Terdekat</i></a></li>
                                    <li class="nav-item"><a href="#prejoining-experience" class="nav-link">PRE JOINING EXPERIENCE /<br><i>Pengalaman Kerja Sebelumnya</i></a></li>
                                    <li class="nav-item"><a href="#initial-declaration" class="nav-link">INITIAL DECLARATION / <br><i>Pernyataan Awal</i></a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

				          <div class="col-md-8 offset-md-2">
				          	<form role="form" method="POST" enctype="multipart/form-data">

			                <div class="form-group row">
			                  <label for="firstName" class="col-sm-4 col-form-label">Name Depan / <i>First Name*</i></label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $nextKin['first_name'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="lastName" class="col-sm-4 col-form-label">Nama Belakang / <i>Last Name*</i></label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $nextKin['last_name'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal Lahir / <i>Date of Birth*</i></label>
			                  <div class="col-sm-8">
			                    <input type="date" class="form-control" id="dateofBirth" name="dateofBirth" value="<?= $nextKin['date_of_birth'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="city" class="col-sm-4 col-form-label">Alamat / <i>Address*</i></label>
			                  <div class="col-sm-8">
			                    <textarea name="address" class="form-control" cols="10" rows="3" required><?= $nextKin['address'] ?></textarea>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="phoneNumber" class="col-sm-4 col-form-label">Nomor Telepon (HP) / <i>Phone Number*</i></label>
			                  <div class="col-sm-8">
			                    <input type="number" onkeypress="return hanyaAngka(event, false)" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= $nextKin['phone'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="relationship" class="col-sm-4 col-form-label">Hubungan / <i>Relationship*</i></label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="relationship" name="relationship" value="<?= $nextKin['relationship'] ?>" required>
			                  </div>
			                </div>

						  <div class="form-group row">
			                  <label for="dependents" class="col-sm-4 col-form-label">Tanggungan / <i>Dependents*</i></label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="dependents" name="dependents" value="<?= $nextKin['dependents'] ?>" required>
			                  </div>
			                </div>

				          </div>
				        
				          <div class="col-md-8 offset-md-2" align="center">
							<br>

							<input type="hidden" name="id" value="<?= $nextKin['id'] ?>">
							<a href="<?php echo $object->base_path()?>personal-info" class="btn btn-flat btn-primary">BACK</a>
							<input type="submit" class="btn btn-flat btn-primary" name="_update" value="NEXT">

				          </div>
				      </form>
				      </div>
				</div>
				</div>
			</div>
		</div>
	</div>
