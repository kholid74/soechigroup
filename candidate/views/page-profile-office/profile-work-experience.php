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

	$work     = 'SELECT * FROM sch_cand_office_experience WHERE id_candidate="'.$authadmin['id'].'"';
    $showWork = $object->fetch($work);

	if(isset($_POST['_saveJobExperience'])) {
        $namatable = 'sch_cand_office_experience';
        $data = array(
          'id_candidate'=> $authadmin['id'],
          'company_name' => $_POST['companyName'],
          'company_address' => $_POST['companyAddress'],
          'company_type' => $_POST['companyType'],
          'company_contact' => $_POST['companyContact'],
          'date_start' => $_POST['startYear'],
          'date_end' => $_POST['endYear'],
          'first_position' => $_POST['firstPosition'],
          'last_position' => $_POST['lastPosition'],
          'current_salary' => $_POST['lastSalary'],
          'move_reason' => $_POST['moveReason'],
          'total_employe' => $_POST['totalEmploye'],
          'job_desc' => $_POST['jobDesc']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."work-experience'); </script>";
    }

    if(isset($_POST['_forward'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."reference'); </script>";
        
    }

?>
<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>profile"><?=$authadmin['full_name']?></a></li>
        <li class="breadcrumb-item active">Work Experience</li>

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
                                    <li class="nav-item active"><a href="#general-information" class="nav-link">GENERAL INFORMATION</a></li>
                                    <li class="nav-item active"><a href="#work-experience" class="nav-link">WORK EXPERIENCE</a></li>
                                    <li class="nav-item"><a href="#reference" class="nav-link">REFERENCE</a></li>
                                    <li class="nav-item"><a href="#document-uploads" class="nav-link">DOCUMENT UPLOADS</a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

				          <div class="col-md-12">
				          	
				          	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#workExperience"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Work Experience</button>    
			                <p align="center" style="font-weight: bold;">PENGALAMAN BEKERJA (DIMULAI DENGAN PEKERJAAN TERAKHIR)</p>
			                
			                <table class="table table-responsive-sm table-bordered table-striped table-sm">
			                <thead>
			                  <tr style="font-weight: bold;">
			                    <td style="font-size: 12px;">Nama Perusahaan</td>
			                    <td style="font-size: 12px;">Alamat</td>
			                    <td style="font-size: 12px;">Jenis Bidang Usaha</td>
			                    <td style="font-size: 12px;">No telp</td>
			                    <td style="font-size: 12px;">Lama Kerja</td>
			                    <td style="font-size: 12px;">Jabatan Awal</td>
			                    <td style="font-size: 12px;">Jabatan Akhir</td>
			                    <td style="font-size: 12px;">Gaji Terakhir</td>
			                    <td style="font-size: 12px;">Alasan Berhenti</td>
			                    <td style="font-size: 12px;">Jumlah Karyawan</td>
			                    <td style="font-size: 12px;">Tanggung Jawab Pekerjaan</td>
			                  </tr>
			                </thead>
			                <tbody>
			                  <?php 
			                  $sql = 'SELECT * FROM sch_cand_office_experience WHERE id_candidate="'.$authadmin['id'].'"';
			                  $exp = $object->fetch_all($sql);
			                  if (count($exp) > 0) {
			                    foreach ($exp as $workExp) {?>
			                  <tr>               
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['company_name'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['company_address'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['company_type'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['company_contact'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['date_start'] ?> - <?= $workExp['date_end'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['first_position'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['last_position'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['current_salary'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['move_reason'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['total_employe'] ?></td>
			                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['job_desc'] ?></td>
			                  </tr>
			                  <?php }}else { ?>
			                  <tr>
			                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="11">No Data..</td>
			                  </tr>
			                  <?php } ?>
			                <hr>
			                </tbody>
			              </table>
				          		
								<br><br>
								<center>
									<form role="form" method="POST" enctype="multipart/form-data">
                  <a href="<?php echo $object->base_path()?>general-information" class="btn btn-flat btn-primary">BACK</a>
                  <input type="submit" class="btn btn-flat btn-primary" name="_forward" value="NEXT">
								  </form>
				          </div>
				      </div>
				</div>
				</div>
			</div>
		</div>
	</div>

	<!-- MODAL -->
      <div class="modal" id="workExperience" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">PENGALAMAN BEKERJA / WORK EXPERIENCE</h5>
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
                      <label class="col-md-4 col-form-label" for="companyName">Nama Perusahaan / Company Name *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="companyName" name="companyName"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label for="companyAddress" class="col-sm-4 col-form-label">Alamat / Company Address *</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="companyAddress" name="companyAddress">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="companyType" class="col-sm-4 col-form-label">Jenis Bidang Usaha / Type of Company</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="companyType" name="companyType">
                      </div>
                    </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="companyContact">No telp / Company Contact</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="companyContact" name="companyContact"required>
                      </div>
                     </div>

                      <div class="row">
                        <label class="col-md-4 col-form-label">Lama Kerja / Years of work</label>
                        <div class="col-md-8 col-form-label">
                          <div class="">
                            <input type="date" class="form-control" id="startYear" name="startYear"required>
                          </div>
                          <div class="">
                            <input type="date" class="form-control" id="endYear" name="endYear"required>
                          </div>
                        </div>
                      </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="firstPosition">Jabatan Awal / First Position *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="firstPosition" name="firstPosition"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="lastPosition">Jabatan Akhir / Last Position *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="lastPosition" name="lastPosition"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="lastSalary">Gaji Terakhir / Current Salary *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="lastSalary" name="lastSalary"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="moveReason">Alasan Berhenti / Pindah *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="moveReason" name="moveReason"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="totalEmploye">Jumlah Karyawan / Total Employee</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="totalEmploye" name="totalEmploye"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="jobDesc">Tanggung Jawab Pekerjaan / Job description*</label>
                      <div class="col-md-8">
                        <textarea name="jobDesc" class="form-control" id="jobDesc" cols="75" rows="3"></textarea>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveJobExperience"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add Work Experience" value="SAVE" />
              </form>
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