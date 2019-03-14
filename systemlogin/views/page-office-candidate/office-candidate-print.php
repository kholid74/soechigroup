<?php 
//error_reporting(E_ALL);


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


	<div class="container-fluid">
		<div id="ui-view" style="opacity: 1;">
			<div class="animated fadeIn">
				
				<div class="card">
					<div class="card-header">
						
					</div>
				<div class="card-body">
					
					<!-- Main row -->
				      <div class="row">
				        <div class="col-lg-12">
				        
				          <h4 style="text-align: center">DATA CANDIDATE</h4>
						   <center><span style="font-size: 15px;">SOECHI LINES</span></center>

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
						              <td width="35%">Job Position</td>
						              <td>:&nbsp;</td>
						              <td><?=$candidate['job_title']?></td>
						            </tr>
						           
						            <tr>
						              <td>Applied Date</td>
						              <td>:&nbsp;</td>
						              <td><?= $candidate['created']; ?></td>
						            </tr>
						           
					            </tbody>
				          </table>
				          </div>
						
						<div class="tab-content" id="myTabContent">
						  <div class="col-md-12">
						  	<!--PERSONAL INFORMATION-->
						  	   <div>

						  	   	<h5 style="font-weight: bold;">PERSONAL INFO</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
			                   
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
					
						  <div class="col-md-12">
						  	<!-- ADDRESS -->
			                  <div>

			                  	<h5 style="font-weight: bold;">ADDRESS</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
			                    
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

						  <div class="col-md-12">
						  	<!-- FORMAL EDUCATION -->
			                  <div>

				              	<h5 style="font-weight: bold;">FORMAL EDUCATION</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
               
				                <table class="table table-responsive-sm table-bordered table-striped table-sm">
				                <thead>
				                  <tr style="font-weight: bold;">
				                    <td style="font-size: 12px;">Level</td>
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
				                  $sql = 'SELECT a.*,b.nama_provinsi,c.nama_kabupaten FROM sch_cand_office_education a JOIN sch_provinsi b ON a.province=b.id_prov JOIN sch_kabupaten c ON a.city=c.id_kab WHERE id_candidate="'.$_GET['ids'].'"';
				                  $exp = $object->fetch_all($sql);
				                  if (count($exp) > 0) {
				                    foreach ($exp as $univ) { 
				                    	$prov     = "SELECT * FROM sch_provinsi WHERE id_prov='".$univ['province']."'";
				                        $showProv = $object->fetch($prov);

				                        $kab      = "SELECT * FROM sch_kabupaten WHERE id_kab='".$univ['city']."'";
				                        $showKab  = $object->fetch($kab);?>
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

				              	<h5 style="font-weight: bold;">COURSE</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
				                
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

						  <div class="col-md-12">
						  	<!-- FAMILY MEMBER -->
			                  <div>
			                   
			                    <h5 style="font-weight: bold;">CORE FAMILY MEMBER</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
                
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
				              
				                <h5 style="font-weight: bold;">PRIMARY FAMILY MEMBER</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
				                
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

				              	<h5 style="font-weight: bold;">EMERGENCY LIST CONTACT</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
				                
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

						  <div class="col-md-12">
						  	<!-- ATTACHMENTS -->
			                  <div>

			                  	<h5 style="font-weight: bold;">INITIAL DECLARATION</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
			                    

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

						  <div class="col-md-12">
						  	<!-- WORK EXPERIENCE -->
			                  <div>
			                    
			                    <h5 style="font-weight: bold;">WORK EXPERIENCE</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
                
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
						  
						  <div class="col-md-12">
						  	<!-- REFERENCE -->
			                  <div>
			                    
			                    <h5 style="font-weight: bold;">REFERENCE</h5>
			                    <hr style="margin-top: 15px;margin-bottom: 15px;border: 0;border-top: 2px solid #333333;">
				                
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

						  <div class="col-md-12">
						  	<!-- CANDIDATE HISTORY -->
			                  <div>
			                    <h5 style="font-weight: bold;">CANDIDATE HISTORY</h5>
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
									                    <p style="font-weight: bold;">Previous Step : <?= $hisCand['status'] ?></p>
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

				</div>
				</div>
			</div>
		</div>
	</div>

	<script>
		window.print();
	</script>