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

	$sql2 = "SELECT * FROM sch_cand_initial_declaration WHERE id_candidate=".$authadmin['id']."";
	$initial = $object->fetch($sql2); 

	$countInitial = $object->fetch_all($sql2);
	$countDec = count($countInitial); 

	if ($countDec > 0) {
		if(isset($_POST['_update'])){
	        $namatable = 'sch_cand_initial_declaration';
	        $data = array(
	          	'about_company' => $_POST['about_company'],
				'unfinished_contract' => $_POST['unfinish_contract'],
				'unfinished_contract_yes'=> $_POST['unfinish_contract_yes'],
				'bad_experience'=> $_POST['bad_experience'],
				'bad_experience_yes'=> $_POST['bad_experience_yes'],
				'last_salary'=> $_POST['last_salary'],
				'legal_litigation'=> $_POST['legal_litigation'],
				'legal_litigation_yes'=> $_POST['legal_litigation_yes'],
				'name1'=> $_POST['name1'],
				'email1'=> $_POST['email1'],
				'phone1'=> $_POST['phone1'],
				'name2'=> $_POST['name2'],
				'email2'=> $_POST['email2'],
				'phone2'=> $_POST['phone2'],
				'name3'=> $_POST['name3'],
				'email3'=> $_POST['email3'],
				'phone3'=> $_POST['phone3']
	      );
	        $conditions = array('id' =>strip_tags($_POST['id']));
	        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
	        @$msg = $_SESSION['statusMsg'] = $statusMsg;
	        echo "<script> window.location.assign('".$object->base_path()."'); </script>";
	    }

	}else if ($countDec == 0){
		if(isset($_POST['_update'])) {
		    $namatable = 'sch_cand_initial_declaration';
		    $data = array(
		      'id_candidate'=> $authadmin['id'],
		      'about_company' => $_POST['about_company'],
			  'unfinished_contract' => $_POST['unfinish_contract'],
			  'unfinished_contract_yes'=> $_POST['unfinish_contract_yes'],
			  'bad_experience'=> $_POST['bad_experience'],
			  'bad_experience_yes'=> $_POST['bad_experience_yes'],
			  'last_salary'=> $_POST['last_salary'],
			  'legal_litigation'=> $_POST['legal_litigation'],
			  'legal_litigation_yes'=> $_POST['legal_litigation_yes'],
			  'name1'=> $_POST['name1'],
			  'email1'=> $_POST['email1'],
			  'phone1'=> $_POST['phone1'],
			  'name2'=> $_POST['name2'],
			  'email2'=> $_POST['email2'],
			  'phone2'=> $_POST['phone2'],
			  'name3'=> $_POST['name3'],
			  'email3'=> $_POST['email3'],
			  'phone3'=> $_POST['phone3']
		    );
		    $insert = $object->tambahdata($namatable,$data);
		    $object->messagesin($insert);
	    	echo "<script> window.location.assign('".$object->base_path()."'); </script>";
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
                                    <li class="nav-item"><a href="#personal-data" class="nav-link" style="">PERSONAL DATA</a></li>
                                    <li class="nav-item active"><a href="#next-of-kin-details" class="nav-link" style="">NEXT OF KIN DETAILS</a></li>
                                    <li class="nav-item active"><a href="#prejoining-experience" class="nav-link">PRE JOINING EXPERIENCE</a></li>
                                    <li class="nav-item active"><a href="#initial-declaration" class="nav-link">INITIAL DECLARATION</a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

				          <div class="col-md-10 offset-md-1">
				          	<form role="form" method="POST" enctype="multipart/form-data">

			                <div class="form-group row">
			                  <label for="about_company" class="col-sm-4 col-form-label">From Where do You know About our Company ?</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="about_company" name="about_company" value="<?= $initial['about_company'] ?>" required>
			                  </div>
			                </div>

			                <div class="row">
		                      <label class="col-md-4 col-form-label">Do You have any Unfinished Contract ?</label>
		                      <div class="col-md-8 col-form-label">
		                        <div class="form-check">
		                          <input class="form-check-input" type="radio" value="YES" id="unfinish_contract" name="unfinish_contract" <?php if($initial['unfinished_contract'] == "YES"){echo "checked";} ?>>
		                          <label class="form-check-label" for="unfinish_contract">
		                            Yes
		                          </label>
		                        </div>
		                        <div class="form-check">
		                          <input class="form-check-input" type="radio" value="NO" id="unfinish_contract" name="unfinish_contract" <?php if($initial['unfinished_contract'] == "NO" OR empty($initial['unfinished_contract'])){echo "checked";} ?>>
		                          <label class="form-check-label" for="unfinish_contract">
		                            No
		                          </label>
		                        </div>
		                      </div>
		                    </div>

		                    <div class="form-group row" id="unfinish_contract_yes" style="display: <?php if($initial['unfinished_contract'] == "YES"){echo "flex";}else{echo "none";} ?>;">
			                  <label for="about_company" class="col-sm-4 col-form-label"></label>
			                  <div class="col-sm-8">
			                    <textarea class="form-control" placeholder="Please give reason" name="unfinish_contract_yes" id="unfinish_contract_yes" rows="3"><?= $initial['unfinished_contract_yes'] ?></textarea>
			                  </div>
			                </div>

		                    <div class="row">
		                      <label class="col-md-4 col-form-label">Do You have any bad experience Onboard ?</label>
		                      <div class="col-md-8 col-form-label">
		                        <div class="form-check">
		                          <input class="form-check-input" type="radio" value="YES" id="bad_experience" name="bad_experience" <?php if($initial['bad_experience'] == "YES"){echo "checked";} ?> >
		                          <label class="form-check-label" for="bad_experience">
		                            Yes
		                          </label>
		                        </div>
		                        <div class="form-check">
		                          <input class="form-check-input" type="radio" value="NO" id="bad_experience" name="bad_experience" <?php if($initial['bad_experience'] == "NO" OR empty($initial['bad_experience'])){echo "checked";} ?>>
		                          <label class="form-check-label" for="bad_experience">
		                            No
		                          </label>
		                        </div>
		                      </div>
		                    </div>

		                    <div class="form-group row" id="bad_experience_yes" style="display: <?php if($initial['bad_experience'] == "YES"){echo "flex";}else{echo "none";} ?>;">
			                  <label for="about_company" class="col-sm-4 col-form-label"></label>
			                  <div class="col-sm-8">
			                    <textarea class="form-control" placeholder="Please Explain" name="bad_experience_yes" id="bad_experience_yes" rows="3"><?= $initial['bad_experience_yes'] ?></textarea>
			                  </div>
			                </div>

			                <div class="row">
		                      <label class="col-md-4 col-form-label">Do you have any legal litigation or any court Case Pending againts you ?</label>
		                      <div class="col-md-8 col-form-label">
		                        <div class="form-check">
		                          <input class="form-check-input" type="radio" value="YES" id="legal_litigation" name="legal_litigation" <?php if($initial['legal_litigation'] == "YES"){echo "checked";} ?>>
		                          <label class="form-check-label" for="legal_litigation">
		                            Yes
		                          </label>
		                        </div>
		                        <div class="form-check">
		                          <input class="form-check-input" type="radio" value="NO" id="legal_litigation" name="legal_litigation" <?php if($initial['legal_litigation'] == "NO" OR empty($initial['legal_litigation'])){echo "checked";} ?>>
		                          <label class="form-check-label" for="legal_litigation">
		                            No
		                          </label>
		                        </div>
		                      </div>
		                    </div>

		                    <div class="form-group row" id="legal_litigation_yes" style="display: <?php if($initial['legal_litigation'] == "YES"){echo "flex";}else{echo "none";} ?>;">
			                  <label for="about_company" class="col-sm-4 col-form-label"></label>
			                  <div class="col-sm-8">
			                    <textarea class="form-control" placeholder="Please Advice Details" name="legal_litigation_yes" id="legal_litigation_yes" rows="3" ><?= $initial['legal_litigation_yes'] ?></textarea>
			                  </div>
			                </div>

			                 <div class="form-group row">
			                  <label for="last_salary" class="col-sm-4 col-form-label">What Was your Last Drawn Salary ?</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="last_salary" value="<?= $initial['last_salary'] ?>" name="last_salary" required>
			                    <small><i>*please give me actual figure as we shall be verify</i></small>
			                  </div>
			                </div>

		                     <div class="form-group row">
			                  <label for="last_contact" class="col-sm-4 col-form-label">Please advise details of you last 3 Companies Employed with.</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="name" placeholder="Name 1" name="name1" value="<?= $initial['name1'] ?>">
			                    <input type="email" class="form-control" id="email" placeholder="Email 1" name="email1" value="<?= $initial['email1'] ?>">
			                    <input type="text" class="form-control" id="phone" placeholder="Phone 1" name="phone1" value="<?= $initial['phone1'] ?>">
			                    <br>
			                    <input type="text" class="form-control" id="name" placeholder="Name 2" name="name2" value="<?= $initial['name2'] ?>">
			                    <input type="email" class="form-control" id="email" placeholder="Email 2" name="email2" value="<?= $initial['email2'] ?>">
			                    <input type="text" class="form-control" id="phone" placeholder="Phone 2" name="phone2" value="<?= $initial['phone2'] ?>">
			                    <br>
			                    <input type="text" class="form-control" id="name" placeholder="Name 3" name="name3" value="<?= $initial['name3'] ?>">
			                    <input type="email" class="form-control" id="email" placeholder="Email 3" name="email3" value="<?= $initial['email3'] ?>">
			                    <input type="text" class="form-control" id="phone" placeholder="Phone 3" name="phone3" value="<?= $initial['phone3'] ?>">
			                  </div>
			                </div>

				          </div>

				          <div class="col-md-8 offset-md-2" align="center">
							<br>
							<a href="<?php echo $object->base_path()?>edit-profile-3/<?=$candidate['id']?>" class="btn btn-flat btn-primary">BACK</a>
							<input type="hidden" name="id" value="<?= $initial['id'] ?>">
							<input type="submit" class="btn btn-flat btn-primary" name="_update" value="FINISH">

				          </div>
				      </form>
				      </div>
				</div>
				</div>
			</div>
		</div>
	</div>
