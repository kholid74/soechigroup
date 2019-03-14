   <?php

    if (!isset($_SESSION['email'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
       
       }
   

    $cand     = 'SELECT * FROM sch_ex_candidate WHERE email="'.$_SESSION['email'].'"';
    $showCand = $object->fetch($cand);

    $failcand     = 'SELECT idcard_number,created FROM sch_ex_candidate WHERE status="2"';
    $showfailcand = $object->fetch($failcand);

    $date =  $showfailcand['created'];
    $awal  = date_create($date);
    $akhir = date_create(); // waktu sekarang
    $diff  = date_diff( $awal, $akhir );


   
    if(isset($_POST['_submit'])){ 

      if($_POST['idCard'] == $showfailcand['idcard_number'] && $diff->y < 1){

      echo "<script> window.location.assign('".$object->base_path()."detect');</script>";
      session_destroy();
      unset($_SESSION['email']);

    }else{ 

      $namatable = 'sch_ex_candidate';
      $data = array(

            'first_name'=> trim($_POST['firstName']),
            'last_name'=> trim($_POST['lastName']), 
            'idcard_number'=> trim($_POST['idCard']),
            'company_id'=> trim($_POST['id_company']), 
            'id_last_ship'=> trim($_POST['last_ship']),
            'id_last_rank'=> trim($_POST['last_rank']), 
            'phone'=> trim($_POST['phoneNumber']),
            'ready_join_date'=> trim($_POST['ready_date']),
            'status'=>'0'
      );
      $conditions = array('id' =>strip_tags($_POST['id']));
      $statusMsg  = $object->updatedata($namatable,$data,$conditions);
      echo "<script> window.location.assign('".$object->base_path()."excrew-agreement'); </script>";
      $_SESSION['idCand'] = $showCand['id'];

    }
        
    }

  

   
  ?>
 
    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">

        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;">EX-CREW APPLY</h4>
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
                  <div class="form-wizard active" style="width:33%!important;">
                      <div class="wizard-icon"><i class="fa fa-user"></i></div>
                      <p>Personal Data</p>
                  </div>
                  <div class="form-wizard" style="width:33%!important;">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Agreement</p>
                  </div>
                  <div class="form-wizard" style="width:33%!important;">
                      <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                      <p>Preview</p>
                  </div>
              </div>

              <div class="alert alert-warning alert-dismissible">
                  <small>Disclaimer : <br>
                    - Content Prepare by Team Crewing. <br>
                    - Please update or amend in case any update after any sign off.
                  </small>
              </div>

              <!-- start personal data -->
              <div style="padding: 30px;">

                <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label">Alamat Email / Email address*</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $showCand['email'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">Nomor ID / ID Number (KTP/Passport)</label>
                  <div class="col-sm-8">
                    <input type="text" onkeypress="return isNumber(event)" class="form-control" id="idCard" name="idCard" value="<?= $showCand['idcard_number'] ?>">
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
                  <label for="id_company" class="col-sm-4 col-form-label">ID Perusahaan / Company ID*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="id_company" name="id_company" value="<?= $showCand['company_id'] ?>" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="last_ship" class="col-sm-4 col-form-label">Kapal SOECHI Terakhir / Last SOECHI Ship*</label>
                  <div class="col-sm-8">

                    <select class="form-control" id="last_ship" name="last_ship" required>
                      <option selected disabled>------Please Select Below------</option>
                      <?php $ship = "SELECT id,name FROM sch_master_vessel ORDER BY id ASC";
                            $all_ship = $object->fetch_all($ship);
                              foreach ($all_ship as $showShip) {?>
                      <option value="<?= $showShip['id'] ?>" <?php if($showCand['id_last_ship'] == $showShip['id']){echo "selected";} ?>><?= $showShip['name'] ?></option>
                      <?php } ?>
                    </select>

                  </div>
                </div>

                <div class="form-group row">
                  <label for="last_rank" class="col-sm-4 col-form-label">Posisi Terakhir / Last Rank*</label>
                  <div class="col-sm-8">

                    <select class="form-control" id="last_rank" name="last_rank" required>
                      <option selected disabled>------Please Select Below------</option>
                      <?php $rank = "SELECT * FROM sch_master_crewrank ORDER BY id ASC";
                            $all_rank = $object->fetch_all($rank);
                              foreach ($all_rank as $showRank) {?>
                      <option value="<?= $showRank['id'] ?>" <?php if($showCand['id_last_rank'] == $showRank['id']){echo "selected";} ?>><?= $showRank['short_name'] ?></option>
                      <?php } ?>
                    </select>

                  </div>
                </div>

                <div class="form-group row">
                  <label for="phoneNumber" class="col-sm-4 col-form-label">Nomor Telepon / Phone Number*</label>
                  <div class="col-sm-8">
                    <input type="text" onkeypress="return isNumber(event)" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= $showCand['phone'] ?>" required>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="ready_date" class="col-sm-4 col-form-label">Tanggal Kesiapan / Readiness Date*</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="ready_date" name="ready_date" value="<?= $showCand['ready_join_date'] ?>" required>
                  </div>
                </div>

                  <div class="wizard-buttons">
                      <input type="hidden" value="<?php echo $showCand['id']; ?>" name="id">
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>
              <!-- end personal data -->
          
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