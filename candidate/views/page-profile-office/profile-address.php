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

	$address     = 'SELECT * FROM sch_cand_office_address WHERE id_candidate="'.$authadmin['id'].'"';
    $showAddress = $object->fetch($address); 

	if(isset($_POST['_update'])){
          $namatable = 'sch_cand_office_address';
          $data = array(
              'address' => $_POST['address'],
              'id_country' => $_POST['country'],
              'id_province' => $_POST['province'],
              'id_city' => $_POST['city'],
              'district' => $_POST['district'],
              'village' => $_POST['village'],
              'postal_code' => $_POST['posCode'],
              'curr_address' => $_POST['cur_address'],
              'id_curr_country' => $_POST['cur_country'],
              'id_curr_province' => $_POST['cur_province'],
              'id_curr_city' => $_POST['cur_city'],
              'curr_district' => $_POST['cur_district'],
              'curr_village' => $_POST['cur_village'],
              'curr_postal_code' => $_POST['cur_posCode']
              );
          $conditions = array('id' =>strip_tags($_POST['id']));
          $statusMsg =  $object->updatedata($namatable,$data,$conditions);
          @$msg = $_SESSION['statusMsg'] = $statusMsg;
          echo "<script> window.location.assign('".$object->base_path()."formal-education'); </script>";
      }

?>
<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>profile"><?=$authadmin['full_name']?></a></li>
        <li class="breadcrumb-item active">Edit Address</li>

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

				      <div class="col-md-10 offset-md-1">

				      	<form role="form" method="POST" enctype="multipart/form-data">

				      	<div class="form-group row">
		                  <label for="address" class="col-sm-4 col-form-label">Alamat Tempat Tinggal (Sesuai KTP) / Address refer to ID Card *</label>
		                  <div class="col-sm-8">
		                    <textarea name="address" class="form-control" id="address" cols="75" rows="3"><?= $showAddress['address'] ?></textarea>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="country" class="col-sm-4 col-form-label">Negara / Country *</label>
		                  <div class="col-sm-8">
		                    <select class="form-control" id="country" name="country" required>
		                      <option selected disabled>------Please Select Below------</option>
		                      <?php $sql = "SELECT * FROM sch_countries ORDER BY en_short_name ASC";
		                            $countries = $object->fetch_all($sql);
		                              foreach ($countries as $nation) {?>
		                      <option value="<?= $nation['num_code'] ?>" <?php if($showAddress['id_country'] == $nation['num_code']){echo "selected";} ?>><?= $nation['en_short_name'] ?></option>
		                      <?php } ?>
		                    </select>
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
		                      <option value="<?= $showProv['id_prov'] ?>" <?php if($showAddress['id_province'] == $showProv['id_prov']){echo "selected";} ?>><?= $showProv['nama_provinsi'] ?></option>
		                      <?php } ?>
		                    </select>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="city" class="col-sm-4 col-form-label">Kota / Kabupaten / City *</label>
		                  <div class="col-sm-8">
		                    <select class="form-control" id="city" name="city" required>
		                      <option selected disabled>------Please Select Below------</option>
		                      <?php $sql3 = "SELECT * FROM sch_kabupaten INNER JOIN sch_provinsi ON sch_kabupaten.id_prov = sch_provinsi.id_prov ORDER BY nama_kabupaten ASC";
		                            $city = $object->fetch_all($sql3);
		                              foreach ($city as $showCity) {?>
		                      <option id="city" class="<?= $showCity['id_prov'] ?>" value="<?= $showCity['id_kab'] ?>" <?php if($showAddress['id_city'] == $showCity['id_kab']){echo "selected";} ?>><?= $showCity['nama_kabupaten'] ?></option>
		                      <?php } ?>
		                    </select>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="district" class="col-sm-4 col-form-label">Kecamatan / Distric *</label>
		                  <div class="col-sm-8">
		                    <input type="text" class="form-control" id="district" name="district" value="<?= $showAddress['district'] ?>" required>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="village" class="col-sm-4 col-form-label">Kelurahan / Village *</label>
		                  <div class="col-sm-8">
		                    <input type="text" class="form-control" id="village" name="village" value="<?= $showAddress['village'] ?>" required>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="posCode" class="col-sm-4 col-form-label">Kode Pos / Postal Number</label>
		                  <div class="col-sm-8">
		                    <input type="text" class="form-control" id="posCode" name="posCode" value="<?= $showAddress['postal_code'] ?>" required>
		                  </div>
		                </div>

		                <br><br>

		                <div class="form-group row">
		                  <label for="cur_address" class="col-sm-4 col-form-label">Alamat Saat Ini / Current Address *</label>
		                  <div class="col-sm-8">
		                    <textarea name="cur_address" class="form-control" id="cur_address" cols="75" rows="3"><?= $showAddress['curr_address'] ?></textarea>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="cur_country" class="col-sm-4 col-form-label">Negara / Country *</label>
		                  <div class="col-sm-8">
		                    <select class="form-control" id="cur_country" name="cur_country" required>
		                      <option selected disabled>------Please Select Below------</option>
		                      <?php $sql = "SELECT * FROM sch_countries ORDER BY en_short_name ASC";
		                            $countries = $object->fetch_all($sql);
		                              foreach ($countries as $nation) {?>
		                      <option value="<?= $nation['num_code'] ?>" <?php if($showAddress['id_country'] == $nation['num_code']){echo "selected";} ?>><?= $nation['en_short_name'] ?></option>
		                      <?php } ?>
		                    </select>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="cur_province" class="col-sm-4 col-form-label">Provinsi / Province *</label>
		                  <div class="col-sm-8">
		                    <select class="form-control" id="cur_province" name="cur_province" required>
		                      <option selected disabled>------Please Select Below------</option>
		                      <?php $sql2 = "SELECT * FROM sch_provinsi ORDER BY nama_provinsi ASC";
		                            $prov = $object->fetch_all($sql2);
		                              foreach ($prov as $showProv) {?>
		                      <option value="<?= $showProv['id_prov'] ?>" <?php if($showAddress['id_province'] == $showProv['id_prov']){echo "selected";} ?>><?= $showProv['nama_provinsi'] ?></option>
		                      <?php } ?>
		                    </select>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="cur_city" class="col-sm-4 col-form-label">Kota / Kabupaten / City *</label>
		                  <div class="col-sm-8">
		                    <select class="form-control" id="cur_city" name="cur_city" required>
		                      <option selected disabled>------Please Select Below------</option>
		                      <?php $sql3 = "SELECT * FROM sch_kabupaten INNER JOIN sch_provinsi ON sch_kabupaten.id_prov = sch_provinsi.id_prov ORDER BY nama_kabupaten ASC";
		                            $city = $object->fetch_all($sql3);
		                              foreach ($city as $showCity) {?>
		                      <option id="cur_city" class="<?= $showCity['id_prov'] ?>" value="<?= $showCity['id_kab'] ?>" <?php if($showAddress['id_city'] == $showCity['id_kab']){echo "selected";} ?>><?= $showCity['nama_kabupaten'] ?></option>
		                      <?php } ?>
		                    </select>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="cur_district" class="col-sm-4 col-form-label">Kecamatan / Distric *</label>
		                  <div class="col-sm-8">
		                    <input type="text" class="form-control" id="cur_district" name="cur_district" value="<?= $showAddress['curr_district'] ?>" required>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="cur_village" class="col-sm-4 col-form-label">Kelurahan / Village *</label>
		                  <div class="col-sm-8">
		                    <input type="text" class="form-control" id="cur_village" name="cur_village" value="<?= $showAddress['curr_village'] ?>" required>
		                  </div>
		                </div>

		                <div class="form-group row">
		                  <label for="cur_posCode" class="col-sm-4 col-form-label">Kode Pos / Postal Number</label>
		                  <div class="col-sm-8">
		                    <input type="text" class="form-control" id="cur_posCode" name="cur_posCode" value="<?= $showAddress['curr_postal_code'] ?>" required>
		                  </div>
		                </div>

				          	

				      </div>
				      <div class="col-md-12" align="center">
						<input type="hidden" name="id" value="<?= $candidate['id'] ?>">
						<a href="<?php echo $object->base_path()?>personal-info" class="btn btn-flat btn-primary">BACK</a>
				      	<input type="submit" class="btn btn-flat btn-primary" name="_update" value="NEXT">
				      </div>
				      </form>
				</div>
				</div>
			</div>
		</div>
	</div>
