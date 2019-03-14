   <?php

   if (!isset($_SESSION['idCand'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
          //echo "session tidak jalan";
       
       }

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
   
    require_once dirname( __FILE__ ) . '/../vendor/autoload.php';

    $cand     = 'SELECT * FROM sch_candidate_office WHERE id="'.$_SESSION['idCand'].'"';
    $showCand = $object->fetch($cand); 
    $idCand   = $showCand['id'];

    $job     = 'SELECT * FROM sch_job_office WHERE id="'.$_SESSION['idJob'].'"';
    $showJob = $object->fetch($job);

    $agree     = 'SELECT * FROM sch_declaration WHERE section="office"';
    $showAgree = $object->fetch($agree);

     $checkCode  = 'SELECT candidate_code FROM sch_candidate_office';
    $candCode   = $object->fetch_all($checkCode);
    $countCode  = count($candCode);
    $cekQ       = $countCode;

    $date= date("mdY");
    $tgl= str_shuffle($date);
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUPWXYZ'.$tgl;
    $randomcode = $object->random(10,$karakter);
    $codeCandidate ="OFC".''.$randomcode;

        if(isset($_POST['_submit'])) {
        
            $apply="UPDATE `sch_candidate_office` SET `candidate_code`='".trim($codeCandidate)."' WHERE id='$idCand'";

            if ($object->add($apply)) {
                  
                  $message = file_get_contents(''.$halaman->base_path().'emailtemplates/office-thankyou-candidate.html');
                  $message = str_replace("%showCand['full_name']%", $showCand['full_name'], $message);
                  $message = str_replace("%showJob['job_title']%", $showJob['job_title'], $message);

                  $mail = new PHPMailer(true);                     
                  
                  //SMTPconfig();
                  
                  $mail->SMTPDebug = 0;    
                  $mail->isSMTP();                         
                  $mail->Host = 'smtp.mailtrap.io'; 
                  $mail->SMTPAuth = true;                      
                  $mail->Username = 'a1526266572f65';   
                  $mail->Password = '49a15dc8363a34';                
                  $mail->SMTPSecure = 'tls';                         
                  $mail->Port = 2525;                
                     
                  //Recipients
                  $mail->setFrom('demo@essentials.id', 'Soechi Recruitment');
                  $mail->addAddress(''.$showCand['email'].'', 'Candidate');    
                  $mail->addReplyTo('demo@essentials.id', 'Information');

                  //Content
                  $mail->isHTML(true);                              
                  $mail->Subject = '[no-reply] Thank you for your application';
                  $mail->MsgHTML($message);

                  $mail->send();
                
                echo "<script> window.location.assign('".$object->base_path()."thank-you');</script>";
                session_destroy();
                unset($_SESSION['idCand']);
                unset($_SESSION['idJob']);
                
            }else{

                $error = "Oops !! there is something error..";
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
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Agreement</p>
                  </div>
              </div>

              <!-- start agreement -->
              <div style="padding: 30px;">
                  <div style="border: 1px solid #1c5d9c;padding: 30px;">
                    <h5 style="text-align: center;font-weight: bold;">AGREEMENT</h5>
                    <br>
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
                      <a href="<?php echo $halaman->base_path()?>office-document-upload"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUBMIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" onclick="return confirm('Are you sure your data is correct ?');">
                  </div>
              </div>
          </form>
        </div>

    </div>
  </div>
