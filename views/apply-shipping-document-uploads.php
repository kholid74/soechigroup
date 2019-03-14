   <?php

   if (!isset($_SESSION['idCand'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
       
       }
   
    $job  = 'SELECT a.*,b.name FROM sch_job_shipping a JOIN sch_master_crewrank b ON a.id_job_name=b.id WHERE a.id="'.$_SESSION['idJob'].'"';
    $showJob = $object->fetch($job);

    $cand     = 'SELECT * FROM sch_candidate_shipping WHERE id="'.$_SESSION['idCand'].'"';
    $showCand = $object->fetch($cand); 
    $idCand   = $showCand['id'];

    if(isset($_POST['_submit'])) {

      if(!empty($_FILES["cv"]["name"]) && !empty($_FILES["seaman_book"]["name"]) && !empty($_FILES["contract"]["name"]))
        {

            $maxsize = 2250 * 2250; // 5MB

            $fileSize_cv         = $_FILES['cv']['size'];
            $fileSize_seamanbook = $_FILES['seaman_book']['size'];
            $fileSize_contract   = $_FILES['contract']['size'];

            if($fileSize_cv < $maxsize OR $fileSize_contract < $maxsize OR $fileSize_seamanbook < $maxsize){

            $object->create_path();
            
            $cv         = $object->uploadCV();
            $seamanBook = $object->uploadSeamanBook();
            $contract   = $object->uploadContract();

            $saveDoc = "UPDATE `sch_candidate_shipping` SET
              `cv`='".trim($cv)."',
              `seaman_book`='".trim($seamanBook)."',
              `contract`='".trim($contract)."'
               WHERE id='$idCand'";

            if ($object->add($saveDoc)) {
                
                echo "<script> window.location.assign('".$object->base_path()."shipping-declaration');</script>";
                
                $_SESSION['idCand'] = $showCand['id'];
                $_SESSION['idJob'] = $showJob['id'];
                
            }else{

                $error = "Oops !! there is something error..";
            }

             }else{
                
                $error = "Maximum size each document is 5MB";
              
              }

        }

    }

    
  ?>
 
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
                      <div class="progress-line" data-now-value="12.11" data-number-of-steps="4" style="width: 12.11%;"></div> <!-- 19.66% -->
                  </div>
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-user"></i></div>
                      <p>Personal Data</p>
                  </div>
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-upload"></i></div>
                      <p>Data Upload</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Agreement</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                      <p>Preview</p>
                  </div>
              </div>

              <!-- start file upload -->
              <div style="padding: 30px;">
                   <!-- <h4 style="font-weight: normal;color: #000000;">DOCUMENT UPLOADS</h4> -->
                    <small>Please upload your file maximum <b>5MB</b> for every items. We Accept .jpg, .pdf, .doc, .docx</small>
                    <br><br>
                    <div class="container">
                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">Curricilum Vitae*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="cv" name="cv" accept=".pdf, .doc, .docx" value="<?= $showCand['cv'] ?>" required>
                            <small><i>*CV Must have Vessels Details on Type of Vessels/GRT/HP</i></small>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">Seaman Book*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="seaman_book" name="seaman_book" accept=".pdf, .doc, .docx" value="<?= $showCand['seaman_book'] ?>" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">Previous Contract as Proof*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="contract" name="contract" accept=".pdf, .doc, .docx" value="<?= $showCand['contract'] ?>" required>
                          </div>
                        </div>
                    </div>
              </div>
              <!-- file upload -->
              
              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <a href="<?php echo $halaman->base_path()?>shipping-personal-data/<?= $showJob['id'] ?>"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>
          </form>
        </div>

    </div>
  </div>
