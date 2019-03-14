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

    if(isset($_POST['_submit'])) {

      if(!empty($_FILES["photo"]["name"]) AND !empty($_FILES["file_idCard"]["name"]) AND !empty($_FILES["eduCert"]["name"]) AND !empty($_FILES["eduTranscript"]["name"]) AND !empty($_FILES["trainingCert"]["name"]))
        {
          $maxsize = 1024 * 1024; // 1MB

          $fileSize_photo       = $_FILES['photo']['size'];
          $fileSize_idcard      = $_FILES['file_idCard']['size'];
          $fileSize_certificate = $_FILES['eduCert']['size'];
          $fileSize_transcript  = $_FILES['eduTranscript']['size'];
          $fileSize_training    = $_FILES['trainingCert']['size'];

          if($fileSize_idcard < $maxsize){

            $object->create_path();
            
            $photo         = $object->uploadPhotooffice();
            $idCard        = $object->uploadIDCard();
            $eduCert       = $object->uploadEduCert();
            $eduTranscript = $object->uploadEduTranscript();
            $trainingCert  = $object->uploadTrainingCert();

            $saveDoc = "UPDATE `sch_candidate_office` SET
              `file_photo`='".trim($photo)."',
              `file_idcard`='".trim($idCard)."',
              `edu_cert`='".trim($eduCert)."',
              `edu_transcript`='".trim($eduTranscript)."',
              `training_cert`='".trim($trainingCert)."'
               WHERE id='$idCand'";

            if ($object->add($saveDoc)) {

                echo "<script> window.location.assign('".$object->base_path()."office-agreement');</script>";
                $_SESSION['idCand'] = $showCand['id'];
                $_SESSION['idJob'] = $showJob['id'];
                
            }else{

                $error = "Oops !! there is something error..";
            }


          }else{
            $error = "Maximum size each document is 2MB";
          }
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
          <h4 style="font-weight: bold;color: #000000;">STEP 8</h4>
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
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-graduation-cap"></i></div>
                      <p>Formal Education</p>
                  </div>
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-users"></i></div>
                      <p>Family Member</p>
                  </div>
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-info-circle"></i></div>
                      <p>General Information</p>
                  </div>
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-briefcase"></i></div>
                      <p>Work Experience</p>
                  </div>
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Reference</p>
                  </div>
                  <div class="form-wizard active">
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

                <p align="center" style="font-weight: bold;">ADDITIONAL DOCUMENT</p>

                <small>Bila ada kelengkapan pendukung mohon unggah pada kolom dibawah ini (Maks 2 MB/Dokumen) / <i>If there's any additional document please upload in the field below</i></small>
                
                <div class="container">
                    <div class="form-group row">
                      <label for="photo" class="col-sm-4 col-form-label">FOTO / PHOTO</label>
                      <div class="col-sm-8">
                        <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpg, .jpeg, .png" value="<?= $showCand['cv'] ?>" required>
                        <small><i>Format diperbolehkan : jpg, .jpeg, .png</i></small>  
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="file_idCard" class="col-sm-4 col-form-label">KTP / ID CARD</label>
                      <div class="col-sm-8">
                        <input type="file" class="form-control-file" id="file_idCard" name="file_idCard" accept=".jpg, .jpeg, .png, .pdf" value="<?= $showCand['file_idcard'] ?>" required>
                        <small><i>Format diperbolehkan : jpg, .jpeg, .png, .pdf</i></small>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="eduCert" class="col-sm-4 col-form-label">IJAZAH PENDIDIKAN TERAKHIR / EDUCATION CERTIFICATE</label>
                      <div class="col-sm-8">
                        <input type="file" class="form-control-file" id="eduCert" name="eduCert" accept=".pdf" value="<?= $showCand['edu_cert'] ?>" required>
                        <small><i>Format diperbolehkan : .pdf</i></small>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="eduTranscript" class="col-sm-4 col-form-label">TRANSKRIP PENDIDIKAN TERAKHIR / EDUCATION TRANSCRIPT</label>
                      <div class="col-sm-8">
                        <input type="file" class="form-control-file" id="eduTranscript" name="eduTranscript" accept=".pdf" value="<?= $showCand['edu_transcript'] ?>" required>
                        <small><i>Format diperbolehkan : .pdf</i></small>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="trainingCert" class="col-sm-4 col-form-label">SERTIFIKAT PELATIHAN / TRAINING CERTIFICATE</label>
                      <div class="col-sm-8">
                        <input type="file" class="form-control-file" id="trainingCert" name="trainingCert" accept=".pdf" value="<?= $showCand['training_cert'] ?>" required>
                        <small><i>Format diperbolehkan : .pdf</i></small>
                      </div>
                    </div>
                </div>

              </div>
              <!-- end personal data -->   

              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <a href="<?php echo $halaman->base_path()?>office-reference"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>       
          </form>
        </div>

    </div>
  </div>
