<?php 

	$sql = "SELECT a.*,b.job_title FROM sch_candidate_office a JOIN sch_job_office b ON a.id_job = b.id WHERE a.id=".$_GET['ids']."";

	$candidate = $object->fetch($sql);

	$candCode  = $candidate['candidate_code'];



	$address      = "SELECT * FROM sch_cand_office_address WHERE id_candidate=".$_GET['ids']."";

    $showAddress  = $object->fetch($address); 

	

	$candHistory  = "SELECT * FROM sch_candidate_history WHERE candidate_code='$candCode'";

    $history      = $object->fetch_all($candHistory);

    $countHistory = count($history); 



    $info     = 'SELECT * FROM sch_cand_office_info WHERE id_candidate="'.$_GET['ids'].'"';

    $showInfo = $object->fetch($info);



?>

<!-- Main content -->

    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item">Office</li>

        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>office-candidate-pending">Detail Candidate</a></li>

        <li class="breadcrumb-item active"><?=$candidate['full_name']?></li>



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

				<h4 style="text-align: center">DETAIL CANDIDATE</h4>

				<center><span style="font-size: 15px;">SOECHI LINES</span></center>

				<div class="card">

					<div class="card-header">

						

					</div>

				<div class="card-body">

					

					<!-- Main row -->

				      <div class="row">

				        <div class="col-lg-12">

				        <a onclick="window.history.back();" style="font-weight: bold;color: #084f93;cursor: pointer;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;&nbsp;BACK TO APPLICANT LIST</a>

				        <br><br>

				          

				          <div class="col-md-12" style="background-color: #f0f3f5;margin-bottom: 20px;">

				            <table style="font-weight: bold;line-height: 2;">

					            <tbody>

						            <tr>

						              <td  width="30%" rowspan="5" align="center">

						              	<?php if(empty($candidate['file_photo'])){ ?>

										<img src="<?php echo BASE_URL; ?>media/images/img-nopict.jpg" width="129" height="125">

										<?php }else{ ?>

										<img src="<?php echo BASE_URL; ?>media/images/photos/<?= $candidate['file_photo'] ?>" width="119" height="115">

										<?php } ?>

						              </td>

				                      <td width="30%">Name</td>

				                      <td>:&nbsp;</td>

				                      <td><?=$candidate['full_name']?></td>

				                    </tr>

						            <tr>

						              <td width="35%">Applied For</td>

						              <td>:&nbsp;</td>

						              <td><?=$candidate['job_title']?></td>

						            </tr>

						           

						            <tr>

						              <td>Applied Date</td>

						              <td>:&nbsp;</td>

						              <td><?= $candidate['created']; ?></td>

						            </tr>

						            <tr>

						              <td>Status</td>

						              <td>:&nbsp;</td>

						              <td><?php 



					              		if ($candidate['status'] == 4) {

										

											echo "<span class='badge badge-success'>INTERVIEW PASSED</span>";

										

										}elseif($candidate['status'] == 5){

										

											echo "<span class='badge badge-danger'>INTERVIEW FAILED</span>";

										

										} ?>

								</td>

						            </tr>

					            </tbody>

				          </table>

				          </div>

						<ul class="nav nav-tabs" id="myTab" role="tablist">

						  <li class="nav-item">

						    <a class="nav-link active" id="personal-info-tab" data-toggle="tab" href="#personal-info" role="tab" aria-controls="personal-info" aria-selected="true">Personal Information</a>

						  </li>

						  <li class="nav-item">

						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#address" role="tab" aria-controls="attach" aria-selected="false">Address</a>

						  </li>

						  <li class="nav-item">

						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#formaleducation" role="tab" aria-controls="attach" aria-selected="false">Formal Education</a>

						  </li>

						  <li class="nav-item">

						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#familymember" role="tab" aria-controls="attach" aria-selected="false">Family Member</a>

						  </li>

						  <li class="nav-item">

						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#generalinfo" role="tab" aria-controls="attach" aria-selected="false">General Information</a>

						  </li>

						  <li class="nav-item">

						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#workexp" role="tab" aria-controls="attach" aria-selected="false">Work Experience</a>

						  </li>

						  <li class="nav-item">

						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#reference" role="tab" aria-controls="attach" aria-selected="false">Reference</a>

						  </li>

						  <li class="nav-item">

						    <a class="nav-link" id="attach-tab" data-toggle="tab" href="#docuploads" role="tab" aria-controls="attach" aria-selected="false">Document Uploads</a>

						  </li>

						  <li class="nav-item">

						    <a class="nav-link" id="candidate-history-tab" data-toggle="tab" href="#candidate-history" role="tab" aria-controls="candidate-history" aria-selected="false"><span class='badge badge-danger'><?php echo $countHistory; ?></span>&nbsp;Candidate History</a>

						  </li>

						</ul>

						<div class="tab-content" id="myTabContent">

						  <div class="tab-pane fade show active" id="personal-info" role="tabpanel" aria-labelledby="personal-info-tab">

						  	<!--PERSONAL INFORMATION-->

						  	   <div>

			                   

			                    <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Nama Lengkap (sesuai KTP)</label>

				                  <div class="col-sm-8">

				                  	:&nbsp;&nbsp;<span><?= $candidate['full_name']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Tempat lahir / Place of birth</label>

				                  <div class="col-sm-8">

				                  	:&nbsp;&nbsp;<span><?= $candidate['birth_place']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Tanggal lahir / Date of birth</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['birth_date']; ?></span>

				                  </div>

				                </div>

                

				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Nomor KTP / ID Card Number *</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['idcard_number']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Nomor NPWP / Tax number</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['tax_number']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Nomor Passport / Passport number</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['passport_number']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Jenis Kelamin / Gender</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['gender']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Kewarganegaraan / Citizenship</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['cityzenship']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Suku / Ethnic</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['ethnic']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Agama / Religion</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['religion']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Status Marital / Marital Status</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['marital_status']; ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Golongan darah / Blood clasification</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['blood']; ?></span>

				                  </div>

				                </div>      

                

				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Media Sosial</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $candidate['url_socmed'] ?></span>

				                  </div>

				                </div>



			                  </div>

						  	<!--END PERSONAL INFORMATION-->

						  </div>

					

						  <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="attach-tab">

						  	<!-- ADDRESS -->

			                  <div>

			                    

			                    <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Alamat Tempat Tinggal (Sesuai KTP)</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['address'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Negara / Country</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['id_country'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Provinsi / Province</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['id_province'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Kota / Kabupaten / City</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['id_city'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Kecamatan / Distric</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['district'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Kelurahan / Village</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['village'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Kode Pos / Postal Number</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['postal_code'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Alamat Saat Ini / Current Address</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['curr_address'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Negara / Country</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['id_curr_country'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Provinsi / Province</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['id_curr_province'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Kota / Kabupaten / City</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['id_curr_city'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Kecamatan / Distric</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['curr_district'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Kelurahan / Village</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['curr_village'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label class="col-sm-4 col-form-label">Kode Pos / Postal Number</label>

				                  <div class="col-sm-8">

				                    :&nbsp;&nbsp;<span><?= $showAddress['curr_postal_code'] ?></span>

				                  </div>

				                </div>



			                  </div>

			                <!--END ADDRESS -->

						  </div>



						  <div class="tab-pane fade" id="formaleducation" role="tabpanel" aria-labelledby="attach-tab">

						  	<!-- FORMAL EDUCATION -->

			                  <div>

			                   

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

				                  </tr>

				                </thead>

				                <tbody>

				                  <?php 

				                  $sql = 'SELECT a.*,b.nama_provinsi,c.nama_kabupaten FROM sch_cand_office_education a JOIN sch_provinsi b ON a.province=b.id_prov JOIN sch_kabupaten c ON a.city=c.id_kab WHERE graduated="smp" AND id_candidate="'.$_GET['ids'].'"';

				                  $exp = $object->fetch_all($sql);

				                  if (count($exp) > 0) {

				                    foreach ($exp as $smp) {?>

				                  <tr>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['institution_name'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['major'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['nama_provinsi'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['nama_kabupaten'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['year_entry'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['year_graduate'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['gpa'] ?></td>

				                  </tr>

				                  <?php }}else { ?>

				                  <tr>

				                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="7">No Data..</td>

				                  </tr>

				                  <?php } ?>

				                <hr>

				                </tbody>

				              </table>



				              <br>



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

				                  </tr>

				                </thead>

				                <tbody>

				                  <?php 

				                  $sql = 'SELECT a.*,b.nama_provinsi,c.nama_kabupaten FROM sch_cand_office_education a JOIN sch_provinsi b ON a.province=b.id_prov JOIN sch_kabupaten c ON a.city=c.id_kab WHERE graduated="sma" AND id_candidate="'.$_GET['ids'].'"';

				                  $exp = $object->fetch_all($sql);

				                  if (count($exp) > 0) {

				                    foreach ($exp as $univ) {?>

				                  <tr>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['institution_name'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['major'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['nama_provinsi'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['nama_kabupaten'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['year_entry'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['year_graduate'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['gpa'] ?></td>

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

				                  </tr>

				                </thead>

				                <tbody>

				                  <?php 

				                  $sql = 'SELECT a.*,b.nama_provinsi,c.nama_kabupaten FROM sch_cand_office_education a JOIN sch_provinsi b ON a.province=b.id_prov JOIN sch_kabupaten c ON a.city=c.id_kab WHERE graduated !="smp" AND graduated !="sma" AND id_candidate="'.$_GET['ids'].'"';

				                  $exp = $object->fetch_all($sql);

				                  if (count($exp) > 0) {

				                    foreach ($exp as $univ) {?>

				                  <tr>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['graduated'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['institution_name'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['faculty'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['major'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['nama_provinsi'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['nama_kabupaten'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['year_entry'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['year_graduate'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $univ['gpa'] ?></td>

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

				                

				                <table class="table table-responsive-sm table-bordered table-striped table-sm">

				                <thead>

				                  <tr style="font-weight: bold;">

				                    <td style="font-size: 12px;">Nama Kursus</td>

				                    <td style="font-size: 12px;">Nama penyelenggara</td>

				                    <td style="font-size: 12px;">Tanggal mulai</td>

				                    <td style="font-size: 12px;">Tanggal Selesai</td>

				                  </tr>

				                </thead>

				                <tbody>

				                  <?php 

				                  $sql = 'SELECT * FROM sch_cand_office_course WHERE id_candidate="'.$_GET['ids'].'"';

				                  $exp = $object->fetch_all($sql);

				                  if (count($exp) > 0) {

				                    foreach ($exp as $course) {?>

				                  <tr>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $course['course_name'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $course['held_by'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $course['start_date'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $course['finish_date'] ?></td>

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

			                <!--END FORMAL EDUCATION -->

						  </div>



						  <div class="tab-pane fade" id="familymember" role="tabpanel" aria-labelledby="attach-tab">

						  	<!-- FAMILY MEMBER -->

			                  <div>

			                   

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

				                  $sql = 'SELECT * FROM sch_cand_office_family WHERE type="core" AND id_candidate="'.$_GET['ids'].'"';

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

				                  $sql = 'SELECT * FROM sch_cand_office_family WHERE type="primary" AND id_candidate="'.$_GET['ids'].'"';

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

				                  $sql = 'SELECT * FROM sch_cand_office_emergency WHERE id_candidate="'.$_GET['ids'].'"';

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

			                <!--END FAMILY MEMBER -->

						  </div>



						  <div class="tab-pane fade" id="generalinfo" role="tabpanel" aria-labelledby="attach-tab">

						  	<!-- ATTACHMENTS -->

			                  <div>

			                    



			                    <div class="row">

				                  <label class="col-md-6 col-form-label">Apakah anda pernah melamar di perusahaan ini sebelumnya ?</label>

				                  <div class="col-md-6 col-form-label">

				                    :&nbsp;&nbsp;<span><?= $showInfo['applied_before'] ?></span>	

				                  </div>

				                </div>



				                <div class="form-group row" id="applied_before_yes" style="display: <?php if($showInfo['applied_before'] == "YES"){echo "flex";}else{echo "none";} ?>;">

				                  <label for="about_company" class="col-sm-6 col-form-label">Kapan dan sebagai apa ?</label>

				                  <div class="col-sm-6">

				                    :&nbsp;&nbsp;<span><?= $showInfo['applied_before_yes'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label for="reason_join" class="col-sm-6 col-form-label">Sebutkan alasan mengapa anda Ingin bergabung dengan SOECHI GROUP</label>

				                  <div class="col-sm-6">

				                    :&nbsp;&nbsp;<span><?= $showInfo['reason_join'] ?></span>

				                  </div>

				                </div>



				                <div class="row">

				                  <label class="col-md-6 col-form-label">Apakah anda masih terikat kontrak dengan perusahaan tempat kerja anda saat ini?</label>

				                  <div class="col-md-6 col-form-label">

				                    :&nbsp;&nbsp;<?= $showInfo['still_work'] ?>

				                  </div>

				                </div>



				                <div class="row">

				                  <label class="col-md-6 col-form-label">Apakah anda mempunyai pekerjaan sampingan ? / Do you have any part time Job ?</label>

				                  <div class="col-md-6 col-form-label">

				                    :&nbsp;&nbsp;<span><?= $showInfo['part_time'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row" id="part_time_yes" style="display: <?php if($showInfo['part_time'] == "YES"){echo "flex";}else{echo "none";} ?>;">

				                  <label for="about_company" class="col-sm-6 col-form-label">Dimana dan sebagai apa ?</label>

				                  <div class="col-sm-6">

				                    :&nbsp;&nbsp;<span><?= $showInfo['part_time_yes'] ?></span>

				                  </div>

				                </div>



				                <div class="row">

				                  <label class="col-md-6 col-form-label">Apakah anda mempunyai teman atau saudara yang bekerja di perusahaan ini ?</label>

				                  <div class="col-md-6 col-form-label">

				                   	:&nbsp;&nbsp;<span><?= $showInfo['friend_soechi'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row" id="friend_soechi_yes" style="display: <?php if($showInfo['friend_soechi'] == "YES"){echo "flex";}else{echo "none";} ?>;">

				                  <label for="about_company" class="col-sm-6 col-form-label">Jika ada sebutkan nama dan jabatannya</label>

				                  <div class="col-sm-6">

				                    :&nbsp;&nbsp;<span><?= $showInfo['friend_soechi_yes'] ?></span>

				                  </div>

				                </div>



				                <div class="row">

				                  <label class="col-md-6 col-form-label">Apakah anda pernah menderita sakit keras/kronis/kecelakaan berat/operasi ?</label>

				                  <div class="col-md-6 col-form-label">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['suffered'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row" id="suffered_yes" style="display: <?php if($showInfo['suffered'] == "YES"){echo "flex";}else{echo "none";} ?>;">

				                  <label for="about_company" class="col-sm-6 col-form-label">kapan dan seperti apa? Jelaskan</label>

				                  <div class="col-sm-6">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['suffered_yes'] ?></span>	

				                  </div>

				                </div>



				                <div class="row">

				                  <label class="col-md-6 col-form-label">Apakah anda pernah berurusan dengan polisi karena tindak kriminal ?</label>

				                  <div class="col-md-6 col-form-label">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['criminal'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row" id="criminal_yes" style="display: <?php if($showInfo['criminal'] == "YES"){echo "flex";}else{echo "none";} ?>;">

				                  <label for="about_company" class="col-sm-6 col-form-label">Jika ada, sebutkan kapan dan alasannya</label>

				                  <div class="col-sm-6">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['criminal_yes'] ?></span>

				                  </div>

				                </div>



				                <div class="row">

				                  <label class="col-md-6 col-form-label">Bila diterima, bersediakah anda ditempatkan diseluruh area operasional perusahaan ?</label>

				                  <div class="col-md-6 col-form-label">

				                    :&nbsp;&nbsp;<span><?= $showInfo['ready_stationed'] ?></span>	

				                  </div>

				                </div>



				                <div class="form-group row" id="ready_stationed_no" style="display: <?php if($showInfo['ready_stationed'] == "NO"){echo "flex";}else{echo "none";} ?>;">

				                  <label for="about_company" class="col-sm-6 col-form-label">Sebutkan alasan anda</label>

				                  <div class="col-sm-6">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['ready_stationed_no'] ?></span>

				                  </div>

				                </div>



				                <div class="row">

				                  <label class="col-md-6 col-form-label">Apakah anda bersedia untuk lembur jika bekerja di perusahaan ini ?</label>

				                  <div class="col-md-6 col-form-label">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['overtime'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row" id="overtime_no" style="display: <?php if($showInfo['overtime'] == "NO"){echo "flex";}else{echo "none";} ?>;">

				                  <label for="overtime_no" class="col-sm-6 col-form-label">Sebutkan alasan anda</label>

				                  <div class="col-sm-6">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['overtime_no'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label for="working_comfort" class="col-sm-6 col-form-label">Lingkungan pekerjaan seperti apa yang <b>membuat anda nyaman ?</b></label>

				                  <div class="col-sm-6">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['working_comfort'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label for="working_discomfort" class="col-sm-6 col-form-label">Lingkungan pekerjaan seperti apa yang <b>tidak membuat anda nyaman ?</b></label>

				                  <div class="col-sm-6">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['working_discomfort'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label for="job_like" class="col-sm-6 col-form-label">Pekerjaan apa yang <b>sesuai</b> dengan keinginan anda ?</label>

				                  <div class="col-sm-6">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['job_like'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                  <label for="job_dislike" class="col-sm-6 col-form-label">Jenis pekerjaan apa yang <b>TIDAK</b> anda sukai ?</label>

				                  <div class="col-sm-6">

				                  	:&nbsp;&nbsp;<span><?= $showInfo['job_dislike'] ?></span>

				                  </div>

				                </div>



				                <div class="form-group row">

				                <label class="col-md-6 col-form-label" for="ready_join">Bila diterima kapankah anda dapat mulai bekerja ? / How long before you can join our company ?</label>

				                <div class="col-md-6">

				                  :&nbsp;&nbsp;<span><?= $showInfo['ready_join'] ?></span>

				                </div>

				               </div>		                    



			                  </div>

			                <!--END ATTACHMENTS -->

						  </div>



						  <div class="tab-pane fade" id="workexp" role="tabpanel" aria-labelledby="attach-tab">

						  	<!-- WORK EXPERIENCE -->

			                  <div>

			                    

			                    <p align="center" style="font-weight: bold;">PENGALAMAN BEKERJA</p>

                

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

				                  $sql = 'SELECT * FROM sch_cand_office_experience WHERE id_candidate="'.$_GET['ids'].'"';

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



			                  </div>

			                <!--END WORK EXPERIENCE -->

						  </div>

						  

						  <div class="tab-pane fade" id="reference" role="tabpanel" aria-labelledby="attach-tab">

						  	<!-- REFERENCE -->

			                  <div>

			                    

			                    <p align="center" style="font-weight: bold;">REFERENSI / REFERENCE</p>

				                

				                <table class="table table-responsive-sm table-bordered table-striped table-sm">

				                <thead>

				                  <tr style="font-weight: bold;">

				                    <td style="font-size: 12px;">Nama Referensi</td>

				                    <td style="font-size: 12px;">Perusahaan</td>

				                    <td style="font-size: 12px;">Jabatan</td>

				                    <td style="font-size: 12px;">Lama Kenal</td>

				                    <td style="font-size: 12px;">Nomor Telepon</td>

				                  </tr>

				                </thead>

				                <tbody>

				                  <?php 

				                  $sql = 'SELECT * FROM sch_cand_office_reference WHERE id_candidate="'.$_GET['ids'].'"';

				                  $exp = $object->fetch_all($sql);

				                  if (count($exp) > 0) {

				                    foreach ($exp as $smp) {?>

				                  <tr>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['name'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['company'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['position'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['years_known'] ?></td>

				                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['phone_number'] ?></td>

				                  </tr>

				                  <?php }}else { ?>

				                  <tr>

				                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="5">No Data..</td>

				                  </tr>

				                  <?php } ?>

				                <hr>

				                </tbody>

				              </table>

			                    

			                  </div>

			                <!--END REFERENCE -->

						  </div>



						  <div class="tab-pane fade" id="docuploads" role="tabpanel" aria-labelledby="attach-tab">

						  	<!-- ATTACHMENTS -->

			                  <div>

			                    

			                    <table class="table" style="font-weight: bold;line-height: 2;">

			                    <tbody>



			                    <tr>

			                      <td>ID CARD</td>

			                      <td><a class="btn btn-md btn-primary" href="<?php echo BASE_URL ?>media/files/<?=$candidate['file_idcard']?>" target="_blank" style="color:font-weight: bold;">VIEW&nbsp;<i class="fa fa-eye"></i></a></td>

			                    </tr>

			                    	

			                    <tr>

			                      <td>EDUCATION CERTIFICATE</td>

			                      <td><a class="btn btn-md btn-primary" href="<?php echo BASE_URL ?>media/files/<?=$candidate['edu_cert']?>" target="_blank" style="color:font-weight: bold;">VIEW&nbsp;<i class="fa fa-eye"></i></a></td>

			                    </tr>



			                    <tr>

			                      <td>EDUCATION TRANSCRIPT</td>

			                      <td><a class="btn btn-md btn-primary" href="<?php echo BASE_URL ?>media/files/<?=$candidate['edu_transcript']?>" target="_blank" style="color:font-weight: bold;">VIEW&nbsp;<i class="fa fa-eye"></i></a></td>

			                    </tr>



			                    <tr>

			                      <td>TRAINING CERTIFICATE</td>

			                      <td><a class="btn btn-md btn-primary" href="<?php echo BASE_URL ?>media/files/<?=$candidate['training_cert']?>" target="_blank" style="color:font-weight: bold;">VIEW&nbsp;<i class="fa fa-eye"></i></a></td>

			                    </tr>

			                  

			                    </tbody>

			                  </table>

			                  </div>

			                <!--END ATTACHMENTS -->

						  </div>



						  <div class="tab-pane fade" id="candidate-history" role="tabpanel" aria-labelledby="candidate-history-tab">

						  	<!-- CANDIDATE HISTORY -->

			                  <div>

			                    <h3 style="font-weight: bold;">Candidate History</h3>

			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">

			                    	<div class="col md-12">

				                    	<div class="timeline-centered">

				                    		<?php 



				                    			$candHistoryy  = "SELECT * FROM sch_candidate_history WHERE candidate_code='$candCode'";

    											$historyy      = $object->fetch_all($candHistoryy);

    											if (count($historyy) > 0) {

													foreach ($historyy as $hisCand) {



				                    		 ?>

									        <article class="timeline-entry">

									            <div class="timeline-entry-inner">

									                <div class="timeline-icon bg-danger">

									                    <i class="fa fa-history"></i>

									                </div>

									                <div class="timeline-label">

									                    <p style="font-weight: bold;">Register date: <?= $hisCand['register_date'] ?></p>

									                    <p style="font-weight: bold;">Position : <?= $hisCand['job_name'] ?></p>

									                    <p style="font-weight: bold;">Previous Step : <?php if($hisCand['status'] == "1"){echo "Shortlisted";}elseif($hisCand['status'] == "2"){echo "Reject Review";} ?></p>

									                    <p style="font-weight: bold;">Reason : <?= $hisCand['reason_reject'] ?></p>

									                    <p style="font-weight: bold;">Action by : <?= $hisCand['action_by'] ?></p>

									                    <p style="font-weight: bold;">Action date : <?= $hisCand['action_date'] ?></p>

									                </div>

									            </div>

									        </article>

									    <?php }}else{ ?>

											<?php echo "No history found on this Candidate.."; ?>

									    <?php } ?>

				                        </div>

			                    	</div>

			                <!--END CANDIDATE HISTORY -->

						  </div>

						</div>

						</div>

				          

				         

				          </div>

				          <br>

				          <a onclick="window.history.back();" style="font-weight: bold;color: #084f93;cursor: pointer;"><i class="fa fa-chevron-left" aria-hidden="true"></i>&nbsp;&nbsp;BACK TO APPLICANT LIST</a>

				        </div>

				      </div>



				</div>

				</div>

			</div>

		</div>

	</div>