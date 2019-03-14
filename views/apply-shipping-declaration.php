   <?php

   if (!isset($_SESSION['idCand'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
       
       }

    $cand     = 'SELECT * FROM sch_candidate_shipping WHERE id="'.$_SESSION['idCand'].'"';
    $showCand = $object->fetch($cand); 

    $job  = 'SELECT a.*,b.name FROM sch_job_shipping a JOIN sch_master_crewrank b ON a.id_job_name=b.id WHERE a.id="'.$_SESSION['idJob'].'"';
    $showJob = $object->fetch($job);

    $agree     = 'SELECT * FROM sch_declaration WHERE section="shipping"';
    $showAgree = $object->fetch($agree);

     if(isset($_POST['_submit'])) {

      echo "<script> window.location.assign('".$object->base_path()."shipping-preview');</script>";
      $_SESSION['idCand'] = $showCand['id'];
      $_SESSION['idJob'] = $showJob['id'];

     }

    
  ?>
 
    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">

        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;">STEP 3</h4>
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
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Agreement</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                      <p>Preview</p>
                  </div>
              </div>

              <!-- start agreement -->
              <div style="padding: 30px;">
                  <div style="border: 1px solid #1c5d9c;padding: 30px;">
                    <?= $showAgree['value']; ?>
                  </div>
                  <div class="form-group row">
                    <label class="form-check-label" style="margin-left: 35px;margin-top: 15px;">
                        <input class="form-check-input" type="checkbox" value="yes" required> I agree to the above terms and will comply with enforce the rules set by the company
                    </label>
                  </div>
                
              </div>
              <!-- end agreement -->
              
              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <a href="<?php echo $halaman->base_path()?>shipping-document-upload"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                      <!-- <button type="submit" name="save" class="btn btn-primary btn-submit">Submit</button> -->
                  </div>
              </div>
          </form>
        </div>

    </div>
  </div>
