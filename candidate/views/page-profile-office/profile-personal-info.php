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
	    margin-left: 27px;
	    z-index: 98;
	}
</style>

<?php
	error_reporting(E_ALL);

	$sql = "SELECT a.*,b.job_title FROM sch_candidate_office a JOIN sch_job_office b ON a.id_job = b.id WHERE a.id=".$authadmin['id']."";
	$candidate = $object->fetch($sql);

	if(isset($_POST['_update'])){ 

        $namatable = 'sch_candidate_office';
        $data = array(
              'full_name'=>trim($_POST['fullName']),
              'birth_place'=>trim($_POST['placeofBirth']), 
              'birth_date'=>trim($_POST['dateofBirth']), 
              'idcard_number'=>trim($_POST['idcardNumber']),
              'tax_number'=>trim($_POST['taxNumber']),
              'passport_number'=>trim($_POST['passportNumber']),
              'gender'=>trim($_POST['gender']),  
              'cityzenship'=>trim($_POST['cityzenship']),
              'ethnic'=>trim($_POST['ethnic']),
              'religion'=>trim($_POST['religion']),
              'marital_status'=>trim($_POST['maritalStatus']),
              'expected_salary'=>trim($_POST['salary']),
              'url_socmed'=>trim($_POST['socmedUrl']),
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg  = $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."address'); </script>";
    }

?>
<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>profile"><?=$authadmin['full_name']?></a></li>
        <li class="breadcrumb-item active">Edit Personal Data</li>

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
                                    <li class="nav-item active"><a href="#personal-info" class="nav-link" style="">PERSONAL INFO</a></li>
                                    <li class="nav-item"><a href="#address" class="nav-link" style="">ADDRESS</a></li>
                                    <li class="nav-item"><a href="#formal-education" class="nav-link">FORMAL EDUCATION</a></li>
                                    <li class="nav-item"><a href="#family-member" class="nav-link">FAMILY MEMBER</a></li>
                                    <li class="nav-item"><a href="#general-information" class="nav-link">GENERAL INFORMATION</a></li>
                                    <li class="nav-item"><a href="#work-experience" class="nav-link">WORK EXPERIENCE</a></li>
                                    <li class="nav-item"><a href="#reference" class="nav-link">REFERENCE</a></li>
                                    <li class="nav-item"><a href="#document-uploads" class="nav-link">DOCUMENT UPLOADS</a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

						<div class="col-md-4" align="center">
						<form role="form" method="POST" enctype="multipart/form-data">
							<?php if(empty($candidate['file_photo'])){ ?>
							<img src="<?php echo BASE_URL; ?>media/images/img-nopict.jpg" style="border-radius: 110px;" id="preview" width="219" height="215">
							<?php }else{ ?>
							<img src="<?php echo BASE_URL; ?>media/images/photos/<?= $candidate['file_photo'] ?>" style="border-radius: 110px;" id="preview" width="219" height="215">
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
			                  <label for="fullName" class="col-sm-4 col-form-label">Nama Lengkap (sesuai KTP) / COMPLETE NAME REFER TO ID CARD *</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="fullName" name="fullName" value="<?= $candidate['full_name']; ?>" >
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat lahir / Place of birth *</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="placeofBirth" name="placeofBirth" value="<?= $candidate['birth_place']; ?>" >
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal lahir / Date of birth *</label>
			                  <div class="col-sm-8">
			                    <input type="date" class="form-control" id="dateofBirth" name="dateofBirth" value="<?= $candidate['birth_date']; ?>" >
			                  </div>
			                </div>
			                
			                <div class="form-group row">
			                  <label for="idcardNumber" class="col-sm-4 col-form-label">Nomor KTP / ID Card Number *</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="idcardNumber" name="idcardNumber" value="<?= $candidate['idcard_number']; ?>" onkeypress="return isNumber(event)">
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="taxNumber" class="col-sm-4 col-form-label">Nomor NPWP / Tax number</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="taxNumber" name="taxNumber" value="<?= $candidate['tax_number']; ?>" onkeypress="return isNumber(event)">
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="passportNumber" class="col-sm-4 col-form-label">Nomor Passport / Passport number</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="passportNumber" name="passportNumber" value="<?= $candidate['passport_number']; ?>" onkeypress="return isNumber(event)">
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin / Gender*</label>
			                  <div class="col-sm-8">
			                    <select class="form-control" id="gender" name="gender" required>
			                      <option selected disabled>------Please Select Below------</option>
			                      <option value="Male" <?php if($candidate['gender'] == "Male"){echo "selected";} ?>>Male</option>
			                      <option value="Female" <?php if($candidate['gender'] == "Female"){echo "selected";} ?>>Female</option>
			                    </select>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="cityzenship" class="col-sm-4 col-form-label">Kewarganegaraan / Citizenship *</label>
			                  <div class="col-sm-8">
			                    <select class="form-control" id="cityzenship" name="cityzenship" >
			                      <option selected>------Please Select Below------</option>
			                      <option value="WNI" <?php if($candidate['cityzenship'] == "WNI"){echo "selected";} ?>>WNI</option>
			                      <option value="WNA" <?php if($candidate['cityzenship'] == "WNA"){echo "selected";} ?>>WNA</option>
			                    </select>
			                  </div>
			                </div>        

			                <div class="form-group row">
			                  <label for="ethnic" class="col-sm-4 col-form-label">Suku / Ethnic</label>
			                  <div class="col-sm-8">
			                    <select class="form-control" id="ethnic" name="ethnic">
			                      <option selected>------Please Select Below------</option>
			                      <option value="JAWA" <?php if($candidate['ethnic'] == "JAWA"){echo "selected";} ?>>JAWA</option>
			                      <option value="SUNDA" <?php if($candidate['ethnic'] == "SUNDA"){echo "selected";} ?>>SUNDA</option>
			                      <option value="BATAK" <?php if($candidate['ethnic'] == "BATAK"){echo "selected";} ?>>BATAK</option>
			                      <option value="MADURA" <?php if($candidate['ethnic'] == "MADURA"){echo "selected";} ?>>MADURA</option>
			                      <option value="BETAWI" <?php if($candidate['ethnic'] == "BETAWI"){echo "selected";} ?>>BETAWI</option>
			                      <option value="DAYAK" <?php if($candidate['ethnic'] == "DAYAK"){echo "selected";} ?>>DAYAK</option>
			                      <option value="MELAYU" <?php if($candidate['ethnic'] == "MELAYU"){echo "selected";} ?>>MELAYU</option>
			                      <option value="TIONGHOA" <?php if($candidate['ethnic'] == "TIONGHOA"){echo "selected";} ?>>TIONGHOA</option>
			                      <option value="OTHER" <?php if($candidate['ethnic'] == "OTHER"){echo "selected";} ?>>OTHER</option>
			                    </select>
			                  </div>
			                </div>

			                <div class="form-group row" >
			                  <label for="ethnic_other" class="col-sm-4 col-form-label"></label>
			                  <div class="col-sm-8" id="ethnic_other" style="<?php if($candidate['ethnic'] != "OTHER"){echo "display: none";} ?>">
			                    <input type="text" class="form-control" id="ethnic_other" name="ethnic_other" value="<?= $candidate['ethnic_other'] ?>" placeholder="Please input ethnic" <?php if($candidate['ethnic'] == "OTHER"){echo "required";} ?>>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="religion" class="col-sm-4 col-form-label">Agama / Religion *</label>
			                  <div class="col-sm-8">
			                    <select class="form-control" id="religion" name="religion" >
			                      <option selected>------Please Select Below------</option>
			                      <option value="ISLAM" <?php if($candidate['religion'] == "ISLAM"){echo "selected";} ?>>ISLAM</option>
			                      <option value="KATHOLIK" <?php if($candidate['religion'] == "KATHOLIK"){echo "selected";} ?>>KATHOLIK</option>
			                      <option value="KRISTEN" <?php if($candidate['religion'] == "KRISTEN"){echo "selected";} ?>>KRISTEN</option>
			                      <option value="BUDHA" <?php if($candidate['religion'] == "BUDHA"){echo "selected";} ?>>BUDHA</option>
			                      <option value="HINDU" <?php if($candidate['religion'] == "HINDU"){echo "selected";} ?>>HINDU</option>
			                      <option value="KONG HU CU" <?php if($candidate['religion'] == "KONG HU CU"){echo "selected";} ?>>KONG HU CU</option>
			                      <option value="OTHER" <?php if($candidate['religion'] == "OTHER"){echo "selected";} ?>>OTHER</option>
			                    </select>
			                  </div>
			                </div>

			                <div class="form-group row" >
			                  <label for="religion_other" class="col-sm-4 col-form-label"></label>
			                  <div class="col-sm-8" id="religion_other" style="<?php if($candidate['religion'] != "OTHER"){echo "display: none";} ?>">
			                    <input type="text" class="form-control" id="religion_other" name="religion_other" value="<?= $candidate['religion_other'] ?>" placeholder="Please input religion" <?php if($candidate['religion'] == "OTHER"){echo "required";} ?>>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="maritalStatus" class="col-sm-4 col-form-label">Status Marital / Marital Status *</label>
			                  <div class="col-sm-8">
			                    <select class="form-control" id="maritalStatus" name="maritalStatus" >
			                      <option selected>------Please Select Below------</option>
			                      <option value="LAJANG" <?php if($candidate['marital_status'] == "LAJANG"){echo "selected";} ?>>LAJANG</option>
			                      <option value="MENIKAH" <?php if($candidate['marital_status'] == "MENIKAH"){echo "selected";} ?>>MENIKAH</option>
			                      <option value="JANDA" <?php if($candidate['marital_status'] == "JANDA"){echo "selected";} ?>>JANDA</option>
			                      <option value="DUDA" <?php if($candidate['marital_status'] == "DUDA"){echo "selected";} ?>>DUDA</option>
			                      <option >OTHER</option>
			                    </select>
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="blood" class="col-sm-4 col-form-label">Golongan darah / Blood clasification</label>
			                  <div class="col-sm-8">
			                    <select class="form-control" id="blood" name="blood">
			                      <option selected>------Please Select Below------</option>
			                      <option value="O" <?php if($candidate['blood'] == "O"){echo "selected";} ?>>O</option>
			                      <option value="A" <?php if($candidate['blood'] == "A"){echo "selected";} ?>>A</option>
			                      <option value="B" <?php if($candidate['blood'] == "B"){echo "selected";} ?>>B</option>
			                      <option value="AB" <?php if($candidate['blood'] == "AB"){echo "selected";} ?>>AB</option>
			                    </select>
			                  </div>
			                </div>
			                
			                <div class="form-group row">
			                  <label for="salary" class="col-sm-4 col-form-label">Gaji Yang Diharapkan / Expected Salary *</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="salary" name="salary" value="<?= $candidate['expected_salary'] ?>" >
			                  </div>
			                </div>

			                <div class="form-group row">
			                  <label for="socmedUrl" class="col-sm-4 col-form-label">Media Sosial (masukan link salah satu media sosial milik anda, Linkedin, Facebook, Instagram) / Please provide one of your social media URL</label>
			                  <div class="col-sm-8">
			                    <input type="text" class="form-control" id="socmedUrl" name="socmedUrl" value="<?= $candidate['url_socmed'] ?>">
			                  </div>
			                </div>

				      </div>
				      <div class="col-md-12" align="center">
						<input type="hidden" name="id" value="<?= $candidate['id'] ?>">
						<input type="hidden" name="oldimage" value="<?php echo $candidate['file_photo']?>">
				      	<input type="submit" class="btn btn-flat btn-primary" name="_update" value="NEXT">
				      </div>
				      </form>
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