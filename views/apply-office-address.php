   <?php
   
    if (!isset($_SESSION['idCand'])) {
          
      echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
      //echo "session tidak jalan";
       
       }
   
    $job     = 'SELECT * FROM sch_job_office WHERE id="'.$_SESSION['idJob'].'"';
    $showJob = $object->fetch($job);

    $cand     = 'SELECT * FROM sch_candidate_office WHERE id="'.$_SESSION['idCand'].'"';
    $showCand = $object->fetch($cand);
    $idCand   = $showCand['id'];

    $address     = 'SELECT * FROM sch_cand_office_address WHERE id_candidate="'.$idCand.'"';
    $showAddress = $object->fetch($address); 

    $countAddress = $object->fetch_all($address);
    $countAdd = count($countAddress); 

    if ($countAdd > 0) {
    if(isset($_POST['_submit'])){
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
          echo "<script> window.location.assign('".$object->base_path()."office-formal-education'); </script>";
          $_SESSION['idCand'] = $showCand['id'];
          $_SESSION['idJob'] = $showJob['id'];
      }

  }else if ($countAdd == 0){
    if(isset($_POST['_submit'])) {
        $namatable = 'sch_cand_office_address';
        $data = array(
          'id_candidate'=> $_SESSION['idCand'],
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
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."office-formal-education'); </script>";
        $_SESSION['idCand'] = $showCand['id'];
        $_SESSION['idJob'] = $showJob['id'];
    }
  }
  ?>
 <style>
     .form-control {
        font-size: small!important;
      }
     .col-form-label {
        font-size: small;
      }
      .form-wizard {
        position: relative;
        float: left;
        width: 11%!important;
        padding: 0 5px;
        text-align: center;
        font-size: small;
    }
   </style>

    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">

        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;">STEP 2</h4>
        </div>
        <div class="col-md-10 offset-md-1" style="margin-bottom: 50px;">
           <?php if (isset($error)): ?>
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                  <?php echo $error ?>
              </div> 
            <?php endif;?>

            <form role="form" method="POST" enctype="multipart/form-data">
              <div class="wizards">
                  <div class="progressbar">
                      <div class="progress-line" data-now-value="12.11" data-number-of-steps="11" style="width: 12.11%;"></div> <!-- 19.66% -->
                  </div>
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-user"></i></div>
                      <p>Personal Data</p>
                  </div>
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-map"></i></div>
                      <p>Address</p>
                  </div>
                  <div class="form-wizard ">
                      <div class="wizard-icon"><i class="fa fa-graduation-cap"></i></div>
                      <p>Formal Education</p>
                  </div>
                  <div class="form-wizard ">
                      <div class="wizard-icon"><i class="fa fa-users"></i></div>
                      <p>Family Member</p>
                  </div>
                  <div class="form-wizard ">
                      <div class="wizard-icon"><i class="fa fa-info-circle"></i></div>
                      <p>General Information</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-briefcase"></i></div>
                      <p>Work Experience</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Reference</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Upload</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Agreement</p>
                  </div>
              </div>

              <!-- start personal data -->
              <div style="padding: 30px;">
               
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
                    <select class="form-control" id="city" name="city" >
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
                    <select class="form-control" id="cur_city" name="cur_city" >
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
              <!-- end personal data -->   

              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <a href="<?php echo $halaman->base_path()?>office-personal-data/<?= $showJob['id'] ?>"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="hidden" name="id" value="<?= $showAddress['id'] ?>">
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>       
          </form>
        </div>

    </div>
  </div>
