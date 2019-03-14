<?php 
  
  $sql1 = "SELECT * FROM sch_cand_ship_nextkin WHERE id_candidate=".$authadmin['id']."";
  $countNextKin = $object->fetch_all($sql1);
  $countNext = count($countNextKin); 

  $sql2 = "SELECT * FROM sch_cand_initial_declaration WHERE id_candidate=".$authadmin['id']."";
  $countInitial = $object->fetch_all($sql2);
  $countDec = count($countInitial);

  $sql3 = "SELECT * FROM sch_cand_ship_prejoin_exp WHERE id_candidate=".$authadmin['id']."";
  $countPrejoin = $object->fetch_all($sql3);
  $countPre = count($countPrejoin);

  $sql4 = "SELECT * FROM sch_cand_ship_document WHERE id_candidate=".$authadmin['id']."";
  $countUpload = $object->fetch_all($sql4);
  $countDoc = count($countUpload);

  $sql5 = "SELECT a.*,b.status FROM sch_candidate_shipping a JOIN sch_cand_shipping_status b ON a.candidate_code=b.candidate_code WHERE a.id=".$authadmin['id']."";
  $showStatus = $object->fetch($sql5);

 ?>

<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <!-- <span>You logged as <b>Candidate</b></span> -->
          </div>
        </li>
      </ol>

      <div class="container-fluid">

        <div class="animated fadeIn">
          <div class="row">

            <div class="col-sm-6 col-lg-4">
            <?php if(!empty($countNext) && !empty($countDec) && !empty($countPre)) { ?>
              <div class="card text-white bg-success">
                <div class="card-body pb-0" align="center" style="height: 245px;">
                  <h4 class="mb-0"><i class="fa fa-tv fa-3x"></i></h4>
                  <br>
                  <p style="font-weight: bold;font-size: 25px;">PERSONAL DATA UPLOADS</p>
                  <a href="<?php echo $object->base_path()?>profile">
                  <button class="btn btn-success btn-md" style="background-color: white;color: #4dbd74;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;">COMPLETE</button>
                  </a>
                  <br>
                </div>
              </div>
              <?php }else { ?>
              <div class="card text-white bg-danger">
                <div class="card-body pb-0" align="center" style="height: 245px;">
                  <h4 class="mb-0"><i class="fa fa-tv fa-3x"></i></h4>
                  <br>
                  <p style="font-weight: bold;font-size: 25px;">PERSONAL DATA UPLOADS</p>
                  <a href="<?php echo $object->base_path()?>personal-info"><button class="btn btn-success btn-md" style="background-color: white;color: #f86c6b;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;" >NOT COMPLETE</button></a>    
                  <br>
                </div>
              </div>
              <?php } ?>

            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-4">
              <?php if(!empty($countDoc)) { ?>
              <div class="card text-white bg-success">
                <div class="card-body pb-0" align="center" style="height: 245px;">
                  <h4 class="mb-0"><i class="fa fa-book fa-3x"></i></h4>
                  <br>
                  <p style="font-weight: bold;font-size: 25px;">DOCUMENT UPLOADS</p>
                  <a href="<?php echo $object->base_path()?>document-uploads">
                  <button class="btn btn-success btn-md" style="background-color: white;color: #4dbd74;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;margin-top: 38px;">COMPLETE</button>
                  </a>
                  <br>
                </div>
              </div>
              <?php }else { ?>
              <div class="card text-white bg-danger">
                <div class="card-body pb-0" align="center" style="height: 245px;">
                  <h4 class="mb-0"><i class="fa fa-book fa-3x"></i></h4>
                  <br>
                  <p style="font-weight: bold;font-size: 25px;">DOCUMENT UPLOADS</p>
                  <a href="<?php echo $object->base_path()?>document-uploads"><button class="btn btn-success btn-md" style="background-color: white;color: #f86c6b;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;margin-top: 38px;">NOT COMPLETE</button></a>
                  <br>
                </div>
              </div>
              <?php } ?>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-4">
              <?php if(!empty($countDoc)) { ?>
              <div class="card text-white bg-success">
                <div class="card-body pb-0" align="center" style="height: 245px;">
                  <h4 class="mb-0"><i class="fa fa-calendar fa-3x"></i></h4>
                  <br>
                  <p style="font-weight: bold;font-size: 25px;">INTERVIEW SCHEDULE</p>
                
                  <?php if($showStatus['status'] == 'INTERVIEW_PASS' OR $showStatus['status'] == 'INTERVIEW_FAIL') { ?>
                  <a href="<?php echo $object->base_path()?>application-status"><button class="btn btn-success btn-md" style="background-color: white;color: #4dbd74;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;margin-top: 38px;">VIEW RESULTS</button></a>
                  <?php }else {?>
                  <a href="<?php echo $object->base_path()?>interview-schedule"><button class="btn btn-success btn-md" style="background-color: white;color: #4dbd74;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;margin-top: 38px;">SET INTERVIEW</button></a>
                  <?php } ?>
                  <br> 
                </div>
              </div>
            
              <?php }else { ?>
              <div class="card text-white bg-danger">
                <div class="card-body pb-0" align="center" style="height: 245px;">
                  <h4 class="mb-0"><i class="fa fa-calendar fa-3x"></i></h4>
                  <br>
                  <p style="font-weight: bold;font-size: 25px;">INTERVIEW SCHEDULE</p>
                  <button class="btn btn-success btn-md" style="background-color: white;color: #f86c6b;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;margin-top: 38px;" disabled>SET INTERVIEW</button>
                  <br> 
                </div>
              </div>
              <?php } ?>
            </div>
            <!--/.col-->
          </div>
          <!--/.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="card text-black" style="background-color: #dadbdc">
                <div class="card-body pb-0" align="left">
                  <br>
                  <!-- <p style="font-weight: normal;font-size: 25px;">INTERVIEW SCHEDULE</p> -->
                  <ul>
                    <li>Silahkan lengkapi data Anda hingga BOX di atas berubah menjadi <b>"COMPLETE"</b>. / <br><i>Please complete your data until BOX above changed to <b>"COMPLETE"</b></i>.</li>
                    <li>Silakan unggah dokumen yang diperlukan untuk mengatur jadwal wawancara. / <br><i>Please upload the required documents to set up the interview schedule</i>.</li>
                  </ul>
                  <br>
                  
                </div>
              
              </div>
            </div>
          </div>

         
        </div>

      </div>
      <!-- /.conainer-fluid -->
    </main>