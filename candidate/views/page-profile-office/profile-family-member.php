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

    $family     = 'SELECT * FROM sch_cand_office_family WHERE id_candidate="'.$authadmin['id'].'"';
    $showFamily = $object->fetch($family);  

	if(isset($_POST['_saveCore'])) {
        $namatable = 'sch_cand_office_family';
        $data = array(
          'id_candidate'=> $idCand,
          'type' => 'core',
          'family_status' => $_POST['familyStatus'],
          'family_name' => $_POST['familyName'],
          'gender' => $_POST['gender'],
          'birth_place' => $_POST['placeofBirth'],
          'birth_date' => $_POST['dateofBirth'],
          'education' => $_POST['education'],
          'occupation' => $_POST['occupation']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."family-member'); </script>";
    }

    if(isset($_POST['_savePrimary'])) {
        $namatable = 'sch_cand_office_family';
        $data = array(
          'id_candidate'=> $idCand,
          'type' => 'primary',
          'family_status' => $_POST['familyStatus'],
          'family_name' => $_POST['familyName'],
          'gender' => $_POST['gender'],
          'birth_place' => $_POST['placeofBirth'],
          'birth_date' => $_POST['dateofBirth'],
          'education' => $_POST['education'],
          'occupation' => $_POST['occupation']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."family-member'); </script>";
    }

    if(isset($_POST['_saveEmergency'])) {
        $namatable = 'sch_cand_office_emergency';
        $data = array(
          'id_candidate'=> $idCand,
          'name' => $_POST['contactName'],
          'relation' => $_POST['relation'],
          'address' => $_POST['address'],
          'phone' => $_POST['phoneNumber']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."family-member'); </script>";
    }

    if(isset($_POST['_forward'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."general-information'); </script>";
        
    }

?>
<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>profile"><?=$authadmin['full_name']?></a></li>
        <li class="breadcrumb-item active">Edit Formal Education</li>

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
                                    <li class="nav-item active"><a href="#address" class="nav-link" style="">ADDRESS</a></li>
                                    <li class="nav-item active"><a href="#formal-education" class="nav-link">FORMAL EDUCATION</a></li>
                                    <li class="nav-item active"><a href="#family-member" class="nav-link">FAMILY MEMBER</a></li>
                                    <li class="nav-item"><a href="#general-information" class="nav-link">GENERAL INFORMATION</a></li>
                                    <li class="nav-item"><a href="#work-experience" class="nav-link">WORK EXPERIENCE</a></li>
                                    <li class="nav-item"><a href="#reference" class="nav-link">REFERENCE</a></li>
                                    <li class="nav-item"><a href="#document-uploads" class="nav-link">DOCUMENT UPLOADS</a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

				      <div class="col-md-10 offset-md-1">

				      	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#coreFamily"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Core Family</button>    
		                <p align="center" style="font-weight: bold;">KELUARGA INTI / CORE FAMILY MEMBER</p>
		                
		                <table class="table table-responsive-sm table-bordered table-striped table-sm">
		                <thead>
		                  <tr style="font-weight: bold;">
		                    <td style="font-size: 12px;">Status Keluarga</td>
		                    <td style="font-size: 12px;">Nama</td>
		                    <td style="font-size: 12px;">Jenis Kelamin</td>
		                    <td style="font-size: 12px;">Tempat Lahir</td>
		                    <td style="font-size: 12px;">Tanggal Lahir</td>
		                    <td style="font-size: 12px;">Pendidikan</td>
		                    <td style="font-size: 12px;">Pekerjaan</td>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                  $sql = 'SELECT * FROM sch_cand_office_family WHERE type="core" AND id_candidate="'.$authadmin['id'].'"';
		                  $exp = $object->fetch_all($sql);
		                  if (count($exp) > 0) {
		                    foreach ($exp as $smp) {?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['family_status'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['family_name'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['gender'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['birth_place'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['birth_date'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['education'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['occupation'] ?></td>
		                  </tr>
		                  <?php }}else { ?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="7">No Data..</td>
		                  </tr>
		                  <?php } ?>
		                <hr>
		                </tbody>
		              </table>
		              
		              <br><br>
		              
		              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#primaryFamily"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Primary Family</button>    
		                <p align="center" style="font-weight: bold;">DATA ANGGOTA KELUARGA / PRIMARY FAMILY MEMBER</p>
		                
		                <table class="table table-responsive-sm table-bordered table-striped table-sm">
		                <thead>
		                  <tr style="font-weight: bold;">
		                    <td style="font-size: 12px;">Status Keluarga</td>
		                    <td style="font-size: 12px;">Nama</td>
		                    <td style="font-size: 12px;">Jenis Kelamin</td>
		                    <td style="font-size: 12px;">Tempat Lahir</td>
		                    <td style="font-size: 12px;">Tanggal Lahir</td>
		                    <td style="font-size: 12px;">Pendidikan</td>
		                    <td style="font-size: 12px;">Pekerjaan</td>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                  $sql = 'SELECT * FROM sch_cand_office_family WHERE type="primary" AND id_candidate="'.$authadmin['id'].'"';
		                  $exp = $object->fetch_all($sql);
		                  if (count($exp) > 0) {
		                    foreach ($exp as $smp) {?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['family_status'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['family_name'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['gender'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['birth_place'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['birth_date'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['education'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['occupation'] ?></td>
		                  </tr>
		                  <?php }}else { ?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="7">No Data..</td>
		                  </tr>
		                  <?php } ?>
		                <hr>
		                </tbody>
		              </table>

		              <br><br>
		              
		              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#emergency"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Emergency Contact</button>    
		                <p align="center" style="font-weight: bold;">PIHAK YANG BISA DIHUBUNGI DALAM KEADAAN DARURAT / EMERGENCY LIST CONTACT</p>
		                
		                <table class="table table-responsive-sm table-bordered table-striped table-sm">
		                <thead>
		                  <tr style="font-weight: bold;">
		                    <td style="font-size: 12px;">Nama</td>
		                    <td style="font-size: 12px;">Hubungan</td>
		                    <td style="font-size: 12px;">Alamat</td>
		                    <td style="font-size: 12px;">No. Telepon</td>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                  $sql = 'SELECT * FROM sch_cand_office_emergency WHERE id_candidate="'.$authadmin['id'].'"';
		                  $exp = $object->fetch_all($sql);
		                  if (count($exp) > 0) {
		                    foreach ($exp as $smp) {?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['name'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['relation'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['address'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['phone'] ?></td>
		                  </tr>
		                  <?php }}else { ?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="4">No Data..</td>
		                  </tr>
		                  <?php } ?>
		                <hr>
		                </tbody>
		              </table>				          	

				      </div>
				      <div class="col-md-12" align="center">
						<input type="hidden" name="id" value="<?= $$authadmin['id'] ?>">
						<form role="form" method="POST" enctype="multipart/form-data">
						<a href="<?php echo $object->base_path()?>formal-education" class="btn btn-flat btn-primary">BACK</a>
				      	<input type="submit" class="btn btn-flat btn-primary" name="_forward" value="NEXT">
				      </div>
				      </form>
				</div>
				</div>
			</div>
		</div>
	</div>

<!-- MODAL -->
      <div class="modal" id="coreFamily" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">KELUARGA INTI / CORE FAMILY MEMBER</h5>
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
                      <label class="col-md-4 col-form-label" for="familyStatus">Status Keluarga / Family Status</label>
                      <div class="col-md-8">
                        <select name="familyStatus" class="form-control">
                          <option value="AYAH">AYAH</option>
                          <option value="IBU">IBU</option>
                          <option value="SAUDARA KANDUNG">SAUDARA KANDUNG</option>
                        </select>
                      </div>
                     </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="familyName">Family Name / Nama</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="familyName" name="familyName"required>
                      </div>
                     </div>
                     
                     <div class="form-group row">
                      <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin / Gender</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="gender" name="gender" required>
                          <option selected disabled>------Please Select Below------</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat lahir / Place of birth</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="placeofBirth" name="placeofBirth">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal lahir / Date of birth</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="dateofBirth" name="dateofBirth">
                      </div>
                    </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="education">Pendidikan / Education</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="education" name="education"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="occupation">Pekerjaan / occupation</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="occupation" name="occupation"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveCore"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>

<!-- MODAL -->
      <div class="modal" id="primaryFamily" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">DATA ANGGOTA KELUARGA / PRIMARY FAMILY</h5>
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
                      <label class="col-md-4 col-form-label" for="familyStatus">Status Keluarga / Family Status</label>
                      <div class="col-md-8">
                        <select name="familyStatus" class="form-control">
                          <option value="SUAMI">SUAMI</option>
                          <option value="ISTRI">ISTRI</option>
                          <option value="ANAK">ANAK</option>
                        </select>
                      </div>
                     </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="familyName">Family Name / Nama</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="familyName" name="familyName"required>
                      </div>
                     </div>
                     
                     <div class="form-group row">
                      <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin / Gender</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="gender" name="gender" required>
                          <option selected disabled>------Please Select Below------</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat lahir / Place of birth</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="placeofBirth" name="placeofBirth">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal lahir / Date of birth</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="dateofBirth" name="dateofBirth">
                      </div>
                    </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="education">Pendidikan / Education</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="education" name="education"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="occupation">Pekerjaan / occupation</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="occupation" name="occupation"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_savePrimary"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>

    <!-- MODAL -->
      <div class="modal" id="emergency" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">KONTAK DARURAT / EMERGENCY LIST CONTACT</h5>
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
                      <label class="col-md-4 col-form-label" for="contactName">Name / Nama</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="contactName" name="contactName"required>
                      </div>
                     </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="relation">Hubungan / Relation</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="relation" name="relation"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label for="address" class="col-sm-4 col-form-label">Alamat / Address</label>
                      <div class="col-sm-8">
                        <textarea name="address" class="form-control" id="address" cols="75" rows="3"></textarea>
                      </div>
                    </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="phoneNumber">Nomor Telepon / Phone Number</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveEmergency"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>