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

    $info     = 'SELECT * FROM sch_cand_office_info WHERE id_candidate="'.$authadmin['id'].'"';
    $showInfo = $object->fetch($info); 

	if(isset($_POST['_update'])){
            $namatable = 'sch_cand_office_info';
            $data = array(
                'applied_before' => $_POST['applied_before'],
                'applied_before_yes' => $_POST['applied_before_yes'],
                'reason_join' => $_POST['reason_join'],
                'still_work' => $_POST['still_work'],
                'part_time' => $_POST['part_time'],
                'part_time_yes' => $_POST['part_time_yes'],
                'friend_soechi' => $_POST['friend_soechi'],
                'friend_soechi_yes' => $_POST['friend_soechi_yes'],
                'suffered' => $_POST['suffered'],
                'suffered_yes' => $_POST['suffered_yes'],
                'criminal' => $_POST['criminal'],
                'criminal_yes' => $_POST['criminal_yes'],
                'ready_stationed' => $_POST['ready_stationed'],
                'ready_stationed_no' => $_POST['ready_stationed_no'],
                'overtime' => $_POST['overtime'],
                'overtime_no' => $_POST['overtime_no'],
                'working_comfort' => $_POST['working_comfort'],
                'working_discomfort' => $_POST['working_comfort'],
                'job_like' => $_POST['job_like'],
                'job_dislike' => $_POST['job_dislike'],
                'ready_join' => $_POST['ready_join'],
								'salary' => $_POST['salary']
          );
            $conditions = array('id' =>strip_tags($_POST['id']));
            $statusMsg =  $object->updatedata($namatable,$data,$conditions);
            @$msg = $_SESSION['statusMsg'] = $statusMsg;
            echo "<script> window.location.assign('".$object->base_path()."work-experience'); </script>";

        }

?>
<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>profile"><?=$authadmin['full_name']?></a></li>
        <li class="breadcrumb-item active">Edit General Information</li>

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
                                    <li class="nav-item"><a href="#work-experience" class="nav-link">WORK EXPERIENCE</a></li>
                                    <li class="nav-item"><a href="#reference" class="nav-link">REFERENCE</a></li>
                                    <li class="nav-item"><a href="#document-uploads" class="nav-link">DOCUMENT UPLOADS</a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

				      <div class="col-md-10 offset-md-1">
						<form role="form" method="POST" enctype="multipart/form-data">
				      	<div class="row">
		                  <label class="col-md-6 col-form-label">Apakah anda pernah melamar di perusahaan ini sebelumnya? / have you applied in this company before ?</label>
		                  <div class="col-md-6 col-form-label">
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="YES" id="applied_before" name="applied_before" <?php if($showInfo['applied_before'] == "YES"){echo "checked";} ?>>
		                      <label class="form-check-label" for="applied_before">
		                        Yes
		                      </label>
		                    </div>
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="NO" id="applied_before" name="applied_before" <?php if($showInfo['applied_before'] == "NO" OR empty($showInfo['applied_before'])){echo "checked";} ?>>
		                      <label class="form-check-label" for="applied_before">
		                        No
		                      </label>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group row" id="applied_before_yes" style="display: <?php if($showInfo['applied_before'] == "YES"){echo "flex";}else{echo "none";} ?>;">
		                  <label for="about_company" class="col-sm-6 col-form-label">Kapan dan sebagai apa ? / When and in for what kind of position</label>
		                  <div class="col-sm-6">
		                    <textarea class="form-control" name="applied_before_yes" id="applied_before_yes" rows="3"><?= $showInfo['applied_before_yes'] ?></textarea>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="reason_join" class="col-sm-6 col-form-label">Sebutkan alasan mengapa anda Ingin bergabung dengan SOECHI GROUP / Please mention your reason why you want to join with SOECHI GROUP</label>
		                  <div class="col-sm-6">
		                    <input type="text" class="form-control" id="reason_join" name="reason_join" value="<?= $showInfo['reason_join'] ?>" required>
		                  </div>
		                </div>

		                <div class="row">
		                  <label class="col-md-6 col-form-label">Apakah anda masih terikat kontrak dengan perusahaan tempat kerja anda saat ini? / Do you still workin orn in contract agreement in current workplace ?</label>
		                  <div class="col-md-6 col-form-label">
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="YES" id="still_work" name="still_work" <?php if($showInfo['still_work'] == "YES"){echo "checked";} ?>>
		                      <label class="form-check-label" for="still_work">
		                        Yes
		                      </label>
		                    </div>
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="NO" id="still_work" name="still_work" <?php if($showInfo['still_work'] == "NO" OR empty($showInfo['still_work'])){echo "checked";} ?>>
		                      <label class="form-check-label" for="still_work">
		                        No
		                      </label>
		                    </div>
		                  </div>
		                </div>

		                <div class="row">
		                  <label class="col-md-6 col-form-label">Apakah anda mempunyai pekerjaan sampingan? / Do you have any part time Job ?</label>
		                  <div class="col-md-6 col-form-label">
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="YES" id="part_time" name="part_time" <?php if($showInfo['part_time'] == "YES"){echo "checked";} ?>>
		                      <label class="form-check-label" for="part_time">
		                        Yes
		                      </label>
		                    </div>
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="NO" id="part_time" name="part_time" <?php if($showInfo['part_time'] == "NO" OR empty($showInfo['part_time'])){echo "checked";} ?>>
		                      <label class="form-check-label" for="part_time">
		                        No
		                      </label>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group row" id="part_time_yes" style="display: <?php if($showInfo['part_time'] == "YES"){echo "flex";}else{echo "none";} ?>;">
		                  <label for="about_company" class="col-sm-6 col-form-label">Dimana dan sebagai apa? / if there's any, please mention where</label>
		                  <div class="col-sm-6">
		                    <textarea class="form-control" name="part_time_yes" id="part_time_yes" rows="3"><?= $showInfo['part_time_yes'] ?></textarea>
		                  </div>
		                </div>

		                <div class="row">
		                  <label class="col-md-6 col-form-label">Apakah anda mempunyai teman atau saudara yang bekerja di perusahaan ini? / Do you have any friend or relative that working in SOECHI GROUP ?</label>
		                  <div class="col-md-6 col-form-label">
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="YES" id="friend_soechi" name="friend_soechi" <?php if($showInfo['friend_soechi'] == "YES"){echo "checked";} ?>>
		                      <label class="form-check-label" for="friend_soechi">
		                        Yes
		                      </label>
		                    </div>
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="NO" id="friend_soechi" name="friend_soechi" <?php if($showInfo['friend_soechi'] == "NO" OR empty($showInfo['friend_soechi'])){echo "checked";} ?>>
		                      <label class="form-check-label" for="friend_soechi">
		                        No
		                      </label>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group row" id="friend_soechi_yes" style="display: <?php if($showInfo['friend_soechi'] == "YES"){echo "flex";}else{echo "none";} ?>;">
		                  <label for="about_company" class="col-sm-6 col-form-label">Jika ada sebutkan nama dan jabatannya / If There's any, please mention the name and position</label>
		                  <div class="col-sm-6">
		                    <textarea class="form-control" name="friend_soechi_yes" id="friend_soechi_yes" rows="3"><?= $showInfo['friend_soechi_yes'] ?></textarea>
		                  </div>
		                </div>

		                <div class="row">
		                  <label class="col-md-6 col-form-label">Apakah anda pernah menderita sakit keras/kronis/kecelakaan berat/operasi? / Have you ever suffered from serious illness/chronic/severe injury/surgery ?</label>
		                  <div class="col-md-6 col-form-label">
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="YES" id="suffered" name="suffered" <?php if($showInfo['suffered'] == "YES"){echo "checked";} ?>>
		                      <label class="form-check-label" for="suffered">
		                        Yes
		                      </label>
		                    </div>
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="NO" id="suffered" name="suffered" <?php if($showInfo['suffered'] == "NO" OR empty($showInfo['suffered'])){echo "checked";} ?>>
		                      <label class="form-check-label" for="suffered">
		                        No
		                      </label>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group row" id="suffered_yes" style="display: <?php if($showInfo['suffered'] == "YES"){echo "flex";}else{echo "none";} ?>;">
		                  <label for="about_company" class="col-sm-6 col-form-label">kapan dan seperti apa? Jelaskan / When? Please explain</label>
		                  <div class="col-sm-6">
		                    <textarea class="form-control" name="suffered_yes" id="suffered_yes" rows="3"><?= $showInfo['suffered_yes'] ?></textarea>
		                  </div>
		                </div>

		                <div class="row">
		                  <label class="col-md-6 col-form-label">Apakah anda pernah berurusan dengan polisi karena tindak kriminal? / Have you deal with the police for any criminal action ?</label>
		                  <div class="col-md-6 col-form-label">
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="YES" id="criminal" name="criminal" <?php if($showInfo['criminal'] == "YES"){echo "checked";} ?>>
		                      <label class="form-check-label" for="criminal">
		                        Yes
		                      </label>
		                    </div>
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="NO" id="criminal" name="criminal" <?php if($showInfo['criminal'] == "NO" OR empty($showInfo['criminal'])){echo "checked";} ?>>
		                      <label class="form-check-label" for="criminal">
		                        No
		                      </label>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group row" id="criminal_yes" style="display: <?php if($showInfo['criminal'] == "YES"){echo "flex";}else{echo "none";} ?>;">
		                  <label for="about_company" class="col-sm-6 col-form-label">Jika ada, sebutkan kapan dan alasannya / If there's any please mention when and why</label>
		                  <div class="col-sm-6">
		                    <textarea class="form-control" name="criminal_yes" id="criminal_yes" rows="3"><?= $showInfo['criminal_yes'] ?></textarea>
		                  </div>
		                </div>

		                <div class="row">
		                  <label class="col-md-6 col-form-label">Bila diterima, bersediakah anda ditempatkan diseluruh area operasional perusahaan? / If you're accepted, will you ready to stasioned in all company area ?</label>
		                  <div class="col-md-6 col-form-label">
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="YES" id="ready_stationed" name="ready_stationed" <?php if($showInfo['ready_stationed'] == "YES" OR empty($showInfo['ready_stationed'])){echo "checked";} ?>>
		                      <label class="form-check-label" for="ready_stationed">
		                        Yes
		                      </label>
		                    </div>
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="NO" id="ready_stationed" name="ready_stationed" <?php if($showInfo['ready_stationed'] == "NO"){echo "checked";} ?>>
		                      <label class="form-check-label" for="ready_stationed">
		                        No
		                      </label>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group row" id="ready_stationed_no" style="display: <?php if($showInfo['ready_stationed'] == "NO"){echo "flex";}else{echo "none";} ?>;">
		                  <label for="about_company" class="col-sm-6 col-form-label">Sebutkan alasan anda / Please mention your reason</label>
		                  <div class="col-sm-6">
		                    <textarea class="form-control" name="ready_stationed_no" id="ready_stationed_no" rows="3"><?= $showInfo['ready_stationed_no'] ?></textarea>
		                  </div>
		                </div>

		                <div class="row">
		                  <label class="col-md-6 col-form-label">Apakah anda bersedia untuk lembur jika bekerja di perusahaan ini? / Did you willing to do over time when needed ?</label>
		                  <div class="col-md-6 col-form-label">
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="YES" id="overtime" name="overtime" <?php if($showInfo['overtime'] == "YES" OR empty($showInfo['overtime'])){echo "checked";} ?>>
		                      <label class="form-check-label" for="overtime">
		                        Yes
		                      </label>
		                    </div>
		                    <div class="form-check">
		                      <input class="form-check-input" type="radio" value="NO" id="overtime" name="overtime" <?php if($showInfo['overtime'] == "NO"){echo "checked";} ?>>
		                      <label class="form-check-label" for="overtime">
		                        No
		                      </label>
		                    </div>
		                  </div>
		                </div>

		                <div class="form-group row" id="overtime_no" style="display: <?php if($showInfo['overtime'] == "NO"){echo "flex";}else{echo "none";} ?>;">
		                  <label for="overtime_no" class="col-sm-6 col-form-label">Sebutkan alasan anda / Please mention your reason</label>
		                  <div class="col-sm-6">
		                    <textarea class="form-control" name="overtime_no" id="overtime_no" rows="3"><?= $showInfo['overtime_no'] ?></textarea>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="working_comfort" class="col-sm-6 col-form-label">Lingkungan pekerjaan seperti apa yang <b>membuat anda nyaman ?</b> / What kind of working environment that make you comfort ?</label>
		                  <div class="col-sm-6">
		                    <input type="text" class="form-control" id="working_comfort" name="working_comfort" value="<?= $showInfo['working_comfort'] ?>" required>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="working_discomfort" class="col-sm-6 col-form-label">Lingkungan pekerjaan seperti apa yang <b>tidak membuat anda nyaman ?</b> / What kind of working environment that make you discomfort ?</label>
		                  <div class="col-sm-6">
		                    <input type="text" class="form-control" id="working_discomfort" name="working_discomfort" value="<?= $showInfo['working_discomfort'] ?>" required>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="job_like" class="col-sm-6 col-form-label">Pekerjaan apa yang <b>sesuai</b> dengan keinginan anda? / What kind of job that you prefer</label>
		                  <div class="col-sm-6">
		                    <input type="text" class="form-control" id="job_like" name="job_like" value="<?= $showInfo['job_like'] ?>" required>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="job_dislike" class="col-sm-6 col-form-label">Jenis pekerjaan apa yang <b>TIDAK</b> anda sukai ? / what kind of job that you dislike</label>
		                  <div class="col-sm-6">
		                    <input type="text" class="form-control" id="job_dislike" name="job_dislike" value="<?= $showInfo['job_dislike'] ?>" required>
		                  </div>
		                </div>

		                <div class="form-group row">
		                <label class="col-md-6 col-form-label" for="ready_join">Bila diterima kapankah anda dapat mulai bekerja ? / How long before you can join our company ?</label>
		                <div class="col-md-6">
		                  <select name="ready_join" class="form-control">
		                    <option selected>-- PILIH --</option>
		                    <option value="SECEPATNYA" <?php if($showInfo['ready_join'] == "SECEPATNYA"){echo "selected";} ?>>SECEPATNYA</option>
		                    <option value="1 MINGGU" <?php if($showInfo['ready_join'] == "1 MINGGU"){echo "selected";} ?>>1 MINGGU</option>
		                    <option value="2 MINGGU" <?php if($showInfo['ready_join'] == "2 MINGGU"){echo "selected";} ?>>2 MINGGU</option>
		                    <option value="3 MINGGU" <?php if($showInfo['ready_join'] == "3 MINGGU"){echo "selected";} ?>>3 MINGGU</option>
		                    <option value="1 BULAN" <?php if($showInfo['ready_join'] == "1 BULAN"){echo  "selected";} ?>>1 BULAN</option>   
		                    <option value="2 BULAN" <?php if($showInfo['ready_join'] == "2 BULAN"){echo  "selected";} ?>>2 BULAN</option>
		                  </select>
		                </div>
		               </div>

									 <div class="form-group row">
										<label for="salary" class="col-sm-6 col-form-label">Berapa gaji yang anda harapkan ? / What salary do you expect ?</label>
										<div class="col-sm-6">
											<input type="number" class="form-control" id="salary" name="salary" value="<?= $showInfo['salary'] ?>" required>
											<small><i>*hanya angka / only number</i></small>
										</div>
									</div>				          	

				      </div>
				      <div class="col-md-12" align="center">
						<input type="hidden" name="id" value="<?= $$authadmin['id'] ?>">
						<a href="<?php echo $object->base_path()?>family-member" class="btn btn-flat btn-primary">BACK</a>
				      	<input type="submit" class="btn btn-flat btn-primary" name="_update" value="NEXT">
				      </div>
				      </form>
				</div>
				</div>
			</div>
		</div>
	</div>

