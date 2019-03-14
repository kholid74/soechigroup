   <?php

   if (!isset($_SESSION['email'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
       
       }
   
    $job  = 'SELECT a.*,b.name FROM sch_job_shipping a JOIN sch_master_crewrank b ON a.id_job_name=b.id WHERE a.id="'.$_SESSION['idJob'].'"';
    $showJob = $object->fetch($job);

    $cand     = 'SELECT * FROM sch_candidate_shipping WHERE email="'.$_SESSION['email'].'"';
    $showCand = $object->fetch($cand);

    $failcand     = 'SELECT a.card_number,a.created, b.status FROM sch_candidate_shipping a JOIN sch_cand_shipping_status b ON a.candidate_code=b.candidate_code WHERE b.status="REJECTED"';
    $showfailcand = $object->fetch($failcand);

    $date =  $showfailcand['created'];
    $awal  = date_create($date);
    $akhir = date_create(); // waktu sekarang
    $diff  = date_diff( $awal, $akhir );

    if(isset($_POST['_submit'])){ 

      if($_POST['idCard'] == $showfailcand['card_number'] && $diff->m < 6){

      echo "<script> window.location.assign('".$object->base_path()."detect-crew');</script>";
      session_destroy();
      unset($_SESSION['email']);

    }else{

        $namatable = 'sch_candidate_shipping';
        $data = array(
            'id_job'=>$_POST['idJob'],
      			'id_countries'=>$_POST['country'],
      			'cand_type'=>'shipping',
      			'card_number'=>$_POST['idCard'],
            'coc_number'=>$_POST['cocNumber'],
      			'first_name'=>$_POST['firstName'],
      			'last_name'=>$_POST['lastName'],
      			'birth_place'=>$_POST['placeofBirth'],
      			'birth_date'=>$_POST['dateofBirth'],
      			'gender'=>$_POST['gender'],
      			'mobile1'=>$_POST['mobile1'],
      			'mobile2'=>$_POST['mobile2'],
      			'city'=>$_POST['city']
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."shipping-document-upload'); </script>";
        $_SESSION['idCand'] = $showCand['id'];
        $_SESSION['idJob'] = $showJob['id'];
    }

    }

    
  ?>
 
    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">

        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;">STEP 1</h4>
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
                      <div class="progress-line" data-now-value="12.11" data-number-of-steps="4" style="width: 12.11%;"></div> <!-- 19.66% -->
                  </div>
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-user"></i></div>
                      <p>Personal Data</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-upload"></i></div>
                      <p>Data Upload</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Agreement</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                      <p>Submit</p>
                  </div>
              </div>
              
              <!-- start personal data -->
              <div style="padding: 30px;">
                <h4 style="font-weight: normal;color: #000000;">PERSONAL DATA</h4>
                <br>
                <div class="form-group row">
                  <label for="jobName" class="col-sm-4 col-form-label">Melamar Sebagai / Apply for Job</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showJob['name'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label">Alamat Email / Email address*</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $showCand['email'] ?>" readonly="">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">Nomor ID / ID Number (KTP/Passport)*</label>
                  <div class="col-sm-8">
                    <input type="text" onkeypress="return isNumber(event)" class="form-control" id="idCard" name="idCard" value="<?= $showCand['card_number'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">Nomor COC / COC Number*</label>
                  <div class="col-sm-8">
                    <input type="text" onkeypress="return isNumber(event)" class="form-control" id="cocNumber" name="cocNumber" value="<?= $showCand['coc_number'] ?>" maxlength="16" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="firstName" class="col-sm-4 col-form-label">Nama Depan / First Name*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?= $showCand['first_name'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="lastName" class="col-sm-4 col-form-label">Nama Belakang / Last Name*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?= $showCand['last_name'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat Lahir / Place of Birth*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="placeofBirth" name="placeofBirth" value="<?= $showCand['birth_place'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal Lahir / Date of Birth*</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="dateofBirth" name="dateofBirth" value="<?= $showCand['birth_date'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin / Gender*</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="gender" name="gender" required>
                      <option selected disabled>------Please Select Below------</option>
                      <option value="Male" <?php if($showCand['gender'] == "Male"){echo "selected";} ?>>Male</option>
                      <option value="Female" <?php if($showCand['gender'] == "Female"){echo "selected";} ?>>Female</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Kewarganegaraan / Nationality*</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="country" name="country" required>
                      <option selected disabled>------Please Select Below------</option>
                      <?php $sql = "SELECT * FROM sch_countries ORDER BY en_short_name ASC";
                            $countries = $object->fetch_all($sql);
                              foreach ($countries as $nation) {?>
                      <option value="<?= $nation['num_code'] ?>" <?php if($showCand['id_countries'] == $nation['num_code']){echo "selected";} ?>><?= $nation['en_short_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="city" class="col-sm-4 col-form-label">Kota / City*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="city" name="city" value="<?= $showCand['city'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="mobile1" class="col-sm-4 col-form-label">Nomor HP 1 / Mobile Number 1*</label>
                  <div class="col-sm-8">
                    <input type="text" onkeypress="return isNumber(event)" class="form-control" id="mobile1" name="mobile1" value="<?= $showCand['mobile1'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="mobile2" class="col-sm-4 col-form-label">Nomor HP 2 / Mobile Number 2*</label>
                  <div class="col-sm-8">
                    <input type="text" onkeypress="return isNumber(event)" class="form-control" id="mobile2" name="mobile2" value="<?= $showCand['mobile2'] ?>" required>
                    <small>* Masukkan nomor telepon alternatif atau kerabat yang dapat dihubungi / Input an alternative phone number or relatives who can be contacted</small>
                  </div>
                </div>

              </div>
              <!-- end personal data -->
              
              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <input type="hidden" value="<?php echo $showJob['id']; ?>" name="idJob">
                      <input type="hidden" value="<?php echo $showCand['id']; ?>" name="id">
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>
          </form>
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