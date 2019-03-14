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

    $education = 'SELECT * FROM sch_cand_office_education WHERE id_candidate="'.$authadmin['id'].'"';
    $showEdu   = $object->fetch($education); 

	if(isset($_POST['_save'])) {
        $namatable = 'sch_cand_office_education';
        $data = array(
          'id_candidate'=> $authadmin['id'],
          'graduated' => $_POST['level'],
          'institution_name' => $_POST['institutionName'],
          'major' => $_POST['major'],
          'province' => $_POST['province'],
          'city' => $_POST['city'],
          'year_entry' => $_POST['yearIN'],
          'year_graduate' => $_POST['yearOUT'],
          'gpa' => $_POST['gpa']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."formal-education'); </script>";
    }

    if(isset($_POST['_saveCourse'])) {
        $namatable = 'sch_cand_office_course';
        $data = array(
          'id_candidate'=> $authadmin['id'],
          'course_name' => $_POST['courseName'],
          'held_by' => $_POST['heldBy'],
          'start_date' => $_POST['startDate'],
          'finish_date' => $_POST['finishDate']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."formal-education'); </script>";
    }

    if(isset($_POST['_forward'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."family-member'); </script>";

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
                                    <li class="nav-item"><a href="#family-member" class="nav-link">FAMILY MEMBER</a></li>
                                    <li class="nav-item"><a href="#general-information" class="nav-link">GENERAL INFORMATION</a></li>
                                    <li class="nav-item"><a href="#work-experience" class="nav-link">WORK EXPERIENCE</a></li>
                                    <li class="nav-item"><a href="#reference" class="nav-link">REFERENCE</a></li>
                                    <li class="nav-item"><a href="#document-uploads" class="nav-link">DOCUMENT UPLOADS</a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

				      <div class="col-md-10 offset-md-1">

				      	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#smpadd"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Formal Education</button>
						
						<p align="center" style="font-weight: bold;">Sekolah Dasar / Elementary School</p>
                
		                <table class="table table-responsive-sm table-bordered table-striped table-sm">
		                <thead>
		                  <tr style="font-weight: bold;">
		                    <td style="font-size: 12px;">Nama Institusi</td>
		                    <td style="font-size: 12px;">Jurusan</td>
		                    <td style="font-size: 12px;">Provinsi</td>
		                    <td style="font-size: 12px;">Kota / Kabupaten</td>
		                    <td style="font-size: 12px;">Tahun Masuk</td>
		                    <td style="font-size: 12px;">Tahun Lulus</td>
		                    <td style="font-size: 12px;">Nilai Akhir</td>
		                    <td style="font-size: 12px;">Action</td>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                    
		                    $sql = 'SELECT * FROM sch_cand_office_education WHERE graduated="sd" AND id_candidate="'.$authadmin['id'].'"';
		                    $exp = $object->fetch_all($sql);
		                    if (count($exp) > 0) {
		                      foreach ($exp as $sd) {

		                        $prov     = "SELECT * FROM sch_provinsi WHERE id_prov='".$sd['province']."'";
		                        $showProv = $object->fetch($prov);

		                        $kab      = "SELECT * FROM sch_kabupaten WHERE id_kab='".$sd['city']."'";
		                        $showKab  = $object->fetch($kab);
		                  ?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['institution_name'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['major'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $showProv['nama_provinsi'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $showKab['nama_kabupaten'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['year_entry'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['year_graduate'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['gpa'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;" align="center">
	                    		<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-education/<?php echo $sd['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o "></i></a>
		                    </td>
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
		                <p align="center" style="font-weight: bold;">Sekolah Menengah Pertama / Junior High School</p>
		                
		                <table class="table table-responsive-sm table-bordered table-striped table-sm">
		                <thead>
		                  <tr style="font-weight: bold;">
		                    <td style="font-size: 12px;">Nama Institusi</td>
		                    <td style="font-size: 12px;">Jurusan</td>
		                    <td style="font-size: 12px;">Provinsi</td>
		                    <td style="font-size: 12px;">Kota / Kabupaten</td>
		                    <td style="font-size: 12px;">Tahun Masuk</td>
		                    <td style="font-size: 12px;">Tahun Lulus</td>
		                    <td style="font-size: 12px;">Nilai Akhir</td>
		                    <td style="font-size: 12px;">Action</td>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                  
		                  $sql = 'SELECT * FROM sch_cand_office_education WHERE graduated="smp" AND id_candidate="'.$authadmin['id'].'"';
		                  $exp = $object->fetch_all($sql);
		                  if (count($exp) > 0) {
		                    foreach ($exp as $smp) {
		                    	
		                    	$prov     = "SELECT * FROM sch_provinsi WHERE id_prov='".$smp['province']."'";
		                        $showProv = $object->fetch($prov);

		                        $kab      = "SELECT * FROM sch_kabupaten WHERE id_kab='".$smp['city']."'";
		                        $showKab  = $object->fetch($kab);

		                   ?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['institution_name'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['major'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $showProv['nama_provinsi'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $showKab['nama_kabupaten'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['year_entry'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['year_graduate'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['gpa'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;" align="center">
		                    	<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-education/<?php echo $smp['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o "></i></a>
		                    </td>
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

		              <p align="center" style="font-weight: bold;">Sekolah Menengah Atas / Senior High School</p>
		               
		                <table class="table table-responsive-sm table-bordered table-striped table-sm">
		                <thead>
		                  <tr style="font-weight: bold;">
		                    <td style="font-size: 12px;">Nama Institusi</td>
		                    <td style="font-size: 12px;">Jurusan</td>
		                    <td style="font-size: 12px;">Provinsi</td>
		                    <td style="font-size: 12px;">Kota / Kabupaten</td>
		                    <td style="font-size: 12px;">Tahun Masuk</td>
		                    <td style="font-size: 12px;">Tahun Lulus</td>
		                    <td style="font-size: 12px;">Nilai Akhir</td>
		                    <td style="font-size: 12px;">Action</td>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                  $sql = 'SELECT * FROM sch_cand_office_education WHERE graduated="sma" AND id_candidate="'.$authadmin['id'].'"';
		                  $exp = $object->fetch_all($sql);
		                  if (count($exp) > 0) {
		                    foreach ($exp as $sma) {

		                    	$prov     = "SELECT * FROM sch_provinsi WHERE id_prov='".$sma['province']."'";
		                        $showProv = $object->fetch($prov);

		                        $kab      = "SELECT * FROM sch_kabupaten WHERE id_kab='".$sma['city']."'";
		                        $showKab  = $object->fetch($kab);

		                    ?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sma['institution_name'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sma['major'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $showProv['nama_provinsi'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $showKab['nama_kabupaten'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sma['year_entry'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sma['year_graduate'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $sma['gpa'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;" align="center">
		                    	<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-education/<?php echo $sma['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o "></i></a>
		                    </td>
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

		              <p align="center" style="font-weight: bold;">Universitas / University</p>
		               
		                <table class="table table-responsive-sm table-bordered table-striped table-sm">
		                <thead>
		                  <tr style="font-weight: bold;">
		                    <td style="font-size: 12px;">Tingkat</td>
		                    <td style="font-size: 12px;">Nama Institusi</td>
		                    <td style="font-size: 12px;">Fakultas</td>
		                    <td style="font-size: 12px;">Jurusan</td>
		                    <td style="font-size: 12px;">Provinsi</td>
		                    <td style="font-size: 12px;">Kota / Kabupaten</td>
		                    <td style="font-size: 12px;">Tahun Masuk</td>
		                    <td style="font-size: 12px;">Tahun Lulus</td>
		                    <td style="font-size: 12px;">Nilai Akhir</td>
		                    <td style="font-size: 12px;">Action</td>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                  $sql = 'SELECT * FROM sch_cand_office_education WHERE graduated !="sd" AND graduated !="smp" AND graduated !="sma" AND id_candidate="'.$authadmin['id'].'"';
		                  $exp = $object->fetch_all($sql);
		                  if (count($exp) > 0) {
		                    foreach ($exp as $univ) {

		                    	$prov     = "SELECT * FROM sch_provinsi WHERE id_prov='".$univ['province']."'";
		                        $showProv = $object->fetch($prov);

		                        $kab      = "SELECT * FROM sch_kabupaten WHERE id_kab='".$univ['city']."'";
		                        $showKab  = $object->fetch($kab);

		                    ?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['graduated'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['institution_name'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['faculty'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['major'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $showProv['nama_provinsi'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $showKab['nama_kabupaten'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['year_entry'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['year_graduate'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['gpa'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;" align="center">
		                    	<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-education/<?php echo $univ['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o "></i></a>
		                    </td>
		                  </tr>
		                  <?php }}else { ?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="9">No Data..</td>
		                  </tr>
		                  <?php } ?>
		                <hr>
		                </tbody>
		              </table>

		              <br><br>

		              <p align="center" style="font-weight: bold;">Course / Kursus</p>
		               <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#course"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Course</button>    
		                <table class="table table-responsive-sm table-bordered table-striped table-sm">
		                <thead>
		                  <tr style="font-weight: bold;">
		                    <td style="font-size: 12px;">Nama Kursus</td>
		                    <td style="font-size: 12px;">Nama penyelenggara</td>
		                    <td style="font-size: 12px;">Tanggal mulai</td>
		                    <td style="font-size: 12px;">Tanggal Selesai</td>
		                    <td style="font-size: 12px;">Action</td>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                  $sql = 'SELECT * FROM sch_cand_office_course WHERE id_candidate="'.$authadmin['id'].'"';
		                  $exp = $object->fetch_all($sql);
		                  if (count($exp) > 0) {
		                    foreach ($exp as $course) {?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $course['course_name'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $course['held_by'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $course['start_date'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $course['finish_date'] ?></td>
		                    <td align="center">
		                    	<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-course/<?php echo $course['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o "></i></a>
		                    </td>
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
						<input type="hidden" name="id" value="<?= $authadmin['id'] ?>">
						<form role="form" method="POST" enctype="multipart/form-data">
						<a href="<?php echo $object->base_path()?>address" class="btn btn-flat btn-primary">BACK</a>
				      	<input type="submit" class="btn btn-flat btn-primary" name="_forward" value="NEXT">
				      </div>
				      </form>
				</div>
				</div>
			</div>
		</div>
	</div>

<!-- MODAL -->
      <div class="modal" id="smpadd" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">PENDIDIKAN FORMAL / FORMAL EDUCATION</h5>
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
                      <label class="col-md-4 col-form-label" for="level">Tingkat / Level *</label>
                      <div class="col-md-8">
                        <select name="level" class="form-control">
                          <option value="SD">SD</option>
                          <option value="SMP">SMP</option>
                          <option value="SMA">SMA</option>
                          <option value="D3">D3</option>
                          <option value="S1">S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                        </select>
                      </div>
                     </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="institutionName">Nama Institusi / Institution Name *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="institutionName" name="institutionName"required>
                      </div>
                     </div>
                     
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="faculty">Faculty / Fakultas</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="faculty" name="faculty" >
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="major">Jurusan / Major</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="major" name="major"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label for="province" class="col-sm-4 col-form-label">Provinsi / Province *</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="province" name="province" required>
                          <option selected disabled>------Please Select Below------</option>
                          <?php $sql2 = "SELECT * FROM sch_provinsi ORDER BY nama_provinsi ASC";
                                $prov = $object->fetch_all($sql2);
                                  foreach ($prov as $showProv) {?>
                          <option value="<?= $showProv['id_prov'] ?>"><?= $showProv['nama_provinsi'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="city" class="col-sm-4 col-form-label">Kota / Kabupaten / City *</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="city" name="city">
                          <option selected disabled>------Please Select Below------</option>
                          <?php $sql3 = "SELECT * FROM sch_kabupaten INNER JOIN sch_provinsi ON sch_kabupaten.id_prov = sch_provinsi.id_prov ORDER BY nama_kabupaten ASC";
                                $city = $object->fetch_all($sql3);
                                  foreach ($city as $showCity) {?>
                          <option id="city" class="<?= $showCity['id_prov'] ?>" value="<?= $showCity['id_kab'] ?>"><?= $showCity['nama_kabupaten'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="yearIN">Tahun Masuk / Year of entry</label>
                      <div class="col-md-8">
                        <?php

                          $now=date('Y');
                          echo "<select name='yearIN' class='form-control' required>";
                          for ($a=1985;$a<=$now;$a++)
                          {
                               echo "<option value='$a'>$a</option>";
                          }
                          echo "</select>";

                        ?>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="yearOUT">Tahun Lulus / Graduation year</label>
                      <div class="col-md-8">
                        <?php
                          $now=date('Y');
                          echo "<select name='yearOUT' class='form-control' required>";
                          for ($a=1985;$a<=$now;$a++)
                          {
                               echo "<option value='$a'>$a</option>";
                          }
                          echo "</select>";
                        ?>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="gpa">Nilai Akhir / Final score</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="gpa" name="gpa"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_save"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>

    <!-- MODAL -->
      <div class="modal" id="course" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">COURSE / KURSUS</h5>
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
                      <label class="col-md-4 col-form-label" for="courseName">Nama Kursus / course name</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="courseName" name="courseName"required>
                      </div>
                     </div>
                     
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="heldBy">Nama penyelenggara / held by</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="heldBy" name="heldBy" >
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="startDate">Tanggal mulai / start date</label>
                      <div class="col-md-8">
                        <input type="date" class="form-control" id="startDate" name="startDate"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="finishDate">Tanggal selesai / Finish date</label>
                      <div class="col-md-8">
                        <input type="date" class="form-control" id="finishDate" name="finishDate"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveCourse"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>