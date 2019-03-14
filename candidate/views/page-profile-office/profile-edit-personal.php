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

	if (!empty($candidate)){
    if(isset($_POST['_update'])){
    	$namatable = 'sch_candidate_shipping';
        $maxsize = 1024 * 1024; // 1MB

    	if (!empty($_FILES["photo"]["name"])) {

            $fileSize  = $_FILES['photo']['size'];
            if($fileSize < $maxsize){
                $object->deletePhoto($_POST['oldimage']);
                $object->create_path();
                $uploadPhoto = $object->uploadPhoto();
                $data = array(
		            'card_number'=>$_POST['idCard'],
		            'first_name'=>$_POST['firstName'],
		            'last_name'=>$_POST['lastName'],
		            'birth_place'=>$_POST['placeofBirth'],
		            'birth_date'=>$_POST['dateofBirth'],
		            'gender'=>$_POST['gender'],
		            'address'=>$_POST['address'],
		            'id_countries'=>$_POST['country'],
		            'city'=>$_POST['city'],
		            'mobile1'=>$_POST['mobile1'],
		            'mobile2'=>$_POST['mobile2'],
		            'nearest_airport'=>$_POST['nearest_airport'],
		            'marital_status'=>$_POST['marital_status'],
		            'photo'=>$uploadPhoto
		      );
		        $conditions = array('id' =>strip_tags($_POST['id']));
		        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
		        @$msg = $_SESSION['statusMsg'] = $statusMsg;
        		echo "<script> window.location.assign('".$object->base_path()."edit-profile-2/".$candidate['id']."'); </script>";
            }else{
                $object->messagesfile();
                echo "<script> window.location.assign('".$object->base_path()."edit-profile-1/".$candidate['id']."'); </script>";
            }

        }else{
            $data = array(
                    'card_number'=>$_POST['idCard'],
		            'first_name'=>$_POST['firstName'],
		            'last_name'=>$_POST['lastName'],
		            'birth_place'=>$_POST['placeofBirth'],
		            'birth_date'=>$_POST['dateofBirth'],
		            'gender'=>$_POST['gender'],
		            'address'=>$_POST['address'],
		            'id_countries'=>$_POST['country'],
		            'city'=>$_POST['city'],
		            'mobile1'=>$_POST['mobile1'],
		            'mobile2'=>$_POST['mobile2'],
		            'nearest_airport'=>$_POST['nearest_airport'],
		            'marital_status'=>$_POST['marital_status'],
                );
            $conditions = array('id' =>$_POST['id']);
            $updated = $object->updatedata($namatable,$data,$conditions);
            $object->messagesup($updated);
            echo "<script> window.location.assign('".$object->base_path()."edit-profile-2/".$candidate['id']."'); </script>";
        }

        
    }}

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
                                    <li class="nav-item active"><a href="#personal-data" class="nav-link" style="">PERSONAL DATA</a></li>
                                    <li class="nav-item"><a href="#next-of-kin-details" class="nav-link" style="">NEXT OF KIN DETAILS</a></li>
                                    <li class="nav-item"><a href="#prejoining-experience" class="nav-link">PRE JOINING EXPERIENCE</a></li>
                                    <li class="nav-item"><a href="#initial-declaration" class="nav-link">INITIAL DECLARATION</a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

						<div class="col-md-4" align="center">
						<form role="form" method="POST" enctype="multipart/form-data">
							<?php if(empty($candidate['photo'])){ ?>
							<img src="<?php echo BASE_URL; ?>media/images/img-nopict.jpg" style="border-radius: 110px;" id="preview" width="219" height="215">
							<?php }else{ ?>
							<img src="<?php echo BASE_URL; ?>media/images/photos/<?= $candidate['photo'] ?>" style="border-radius: 110px;" id="preview" width="219" height="215">
							<?php } ?>
							<br><br>
							<label style="color: black;"><i>Upload Your Photo</i></label>
							<br>
							<input type="file" name="photo" class="form-control c-square c-theme" accept=".jpg,.png" onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">
							<center><small style="color: black;"><i>*Recomended 250 x 250 px.</i></small></center>
						</div>
				          <div class="col-md-8">

				          	<div class="form-group row">
			                  <label for="email" class="col-sm-4 col-form-label">Email address*</label>
			                  <div class="col-sm-8">
			                    <input type="email" class="form-control" id="email" value="<?= $candidate['email'] ?>" disabled>
			                  </div>
			                </div>
				          	
				          	<div class="form-group row">
			                  <label for="idCard" class="col-sm-4 col-form-label">ID (KTP/Passport)</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="idCard" name="idCard" value="<?= $candidate['card_number'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="firstName" class="col-sm-4 col-form-label">First Name*</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $candidate['first_name'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="lastName" class="col-sm-4 col-form-label">Last Name*</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $candidate['last_name'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="placeofBirth" class="col-sm-4 col-form-label">Place of Birth*</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="placeofBirth" name="placeofBirth" value="<?= $candidate['birth_place'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="dateofBirth" class="col-sm-4 col-form-label">Date of Birth*</label>
			                  <div class="col-sm-8">
			                    <input type="date" class="form-control" id="dateofBirth" name="dateofBirth" value="<?= $candidate['birth_date'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="inputPassword" class="col-sm-4 col-form-label">Gender*</label>
			                  <div class="col-sm-8">
			                    <select class="form-control" id="gender" name="gender" required>
			                      <option selected disabled>------Please Select Below------</option>
			                      <option value="Male" <?php if($candidate['gender'] == "Male"){echo "selected";} ?>>Male</option>
			                      <option value="Female" <?php if($candidate['gender'] == "Female"){echo "selected";} ?>>Female</option>
			                    </select>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="inputPassword" class="col-sm-4 col-form-label">Marital Status*</label>
			                  <div class="col-sm-8">
			                    <select class="form-control" id="marital_status" name="marital_status" required>
			                      <option selected disabled>------Please Select Below------</option>
			                      <option value="Single" <?php if($candidate['marital_status'] == "Single"){echo "selected";} ?>>Single</option>
			                      <option value="Married" <?php if($candidate['marital_status'] == "Married"){echo "selected";} ?>>Married</option>
			                      <option value="Separated" <?php if($candidate['marital_status'] == "Separated"){echo "selected";} ?>>Separated</option>
			                      <option value="Widowed" <?php if($candidate['marital_status'] == "Widowed"){echo "selected";} ?>>Widowed</option>
			                      <option value="Divorced" <?php if($candidate['marital_status'] == "Divorced"){echo "selected";} ?>>Divorced</option>
			                    </select>
			                  </div>
			                </div>

							<div class="form-group row">
			                  <label for="city" class="col-sm-4 col-form-label">Address*</label>
			                  <div class="col-sm-8">
			                    <textarea name="address" class="form-control" cols="20" rows="5"><?= $candidate['address'] ?></textarea>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="inputPassword" class="col-sm-4 col-form-label">Nationality*</label>
			                  <div class="col-sm-8">
			                    <select class="form-control" id="country" name="country" required>
			                      <option selected disabled>------Please Select Below------</option>
			                      <?php $sql = "SELECT * FROM sch_countries ORDER BY en_short_name ASC";
			                            $countries = $object->fetch_all($sql);
			                              foreach ($countries as $nation) {?>
			                      <option value="<?= $nation['num_code'] ?>" <?php if($candidate['id_countries'] == $nation['num_code']){echo "selected";} ?>><?= $nation['en_short_name'] ?></option>
			                      <?php } ?>
			                    </select>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="city" class="col-sm-4 col-form-label">City*</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="city" name="city" value="<?= $candidate['city'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="mobile1" class="col-sm-4 col-form-label">Phone Number*</label>
			                  <div class="col-sm-8">
			                    <input type="number" onkeypress="return hanyaAngka(event, false)" class="form-control" id="mobile1" name="mobile1" value="<?= $candidate['mobile1'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="mobile2" class="col-sm-4 col-form-label">Mobile Number*</label>
			                  <div class="col-sm-8">
			                    <input type="number" onkeypress="return hanyaAngka(event, false)" class="form-control" id="mobile2" name="mobile2" value="<?= $candidate['mobile2'] ?>" required>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="nearest_airport" class="col-sm-4 col-form-label">Nearest Airport*</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="nearest_airport" name="nearest_airport" value="<?= $candidate['nearest_airport'] ?>" required>
			                  </div>
			                </div>

				      </div>
				      <div class="col-md-12" align="center">
						<input type="hidden" name="id" value="<?= $candidate['id'] ?>">
						<input type="hidden" name="oldimage" value="<?php echo $candidate['photo']?>">
				      	<input type="submit" class="btn btn-flat btn-primary" name="_update" value="NEXT">
				      </div>
				      </form>
				</div>
				</div>
			</div>
		</div>
	</div>
