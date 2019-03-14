   <?php

   if (!isset($_SESSION['idCand'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
       
       }

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   
   require_once dirname( __FILE__ ) . '/../vendor/autoload.php';
   
    $job  = 'SELECT a.*,b.name FROM sch_job_shipping a JOIN sch_master_crewrank b ON a.id_job_name=b.id WHERE a.id="'.$_SESSION['idJob'].'"';
    $showJob = $object->fetch($job);

    $cand     = 'SELECT * FROM sch_candidate_shipping WHERE id="'.$_SESSION['idCand'].'"';
    $showCand = $object->fetch($cand);
    $idCand   = $showCand['id'];

    $date= date("mdY");
    $tgl= str_shuffle($date);
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUPWXYZ'.$tgl;
    $randomcode = $object->random(10,$karakter);
    $codeCandidate ="SHP".''.$randomcode;

        if(isset($_POST['_submit'])) {
        
            $apply="UPDATE `sch_candidate_shipping` SET `candidate_code`='".trim($codeCandidate)."' WHERE id='$idCand'";

            $apply2="INSERT INTO `sch_cand_shipping_status` SET `candidate_code`='".trim($codeCandidate)."', status='PENDING_REVIEW', created='".date("Y-m-d H:i:s")."', modified='".date("Y-m-d H:i:s")."'";

            if ($object->add($apply) && $object->add($apply2)) {
                  
                  $message = file_get_contents(''.$halaman->base_path().'emailtemplates/shipping-thankyou-candidate.html');
                  $message = str_replace("%showCand['first_name']%", $showCand['first_name'], $message);
                  $message = str_replace("%showJob['name']%", $showJob['name'], $message);

                  $mail = new PHPMailer(true);                     
                  
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
 
    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">

        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;">PREVIEW YOUR DATA</h4>
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
                  <div class="form-wizard active">
                      <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                      <p>Preview</p>
                  </div>
              </div>
              <!-- preview -->
              <div style="padding: 30px;border: 1px solid #1c5d9c;">
                <h4 style="color: #000000;text-decoration: underline;">PERSONAL DATA</h4>
                <br>
                <div class="form-group row">
                  <label for="jobName" class="col-sm-4 col-form-label">Apply for Job</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showJob['name'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label">Email address</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" value="<?= $showCand['email'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">Nomor ID / ID Number (KTP/Passport)</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" value="<?= $showCand['card_number'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">Nomor COC / COC Number</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showCand['coc_number'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="firstName" class="col-sm-4 col-form-label">Nama Depan / First Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showCand['first_name'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="lastName" class="col-sm-4 col-form-label">Nama Belakang / Last Name</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showCand['last_name'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat Lahir / Place of Birth</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showCand['birth_place'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal Lahir / Date of Birth</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" value="<?= $showCand['birth_date'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Jenis Kelamin / Gender</label>
                  <div class="col-sm-8">
                    <select class="form-control" disabled>
                      <option selected disabled>------Please Select Below------</option>
                      <option value="Male" <?php if($showCand['gender'] == "Male"){echo "selected";} ?>>Male</option>
                      <option value="Female" <?php if($showCand['gender'] == "Female"){echo "selected";} ?>>Female</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Kewarganegaraan / Nationality</label>
                  <div class="col-sm-8">
                    <select class="form-control" disabled>
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
                    <input type="text" class="form-control" value="<?= $showCand['city'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="mobile1" class="col-sm-4 col-form-label">Nomor HP 1 / Mobile Number 1</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" value="<?= $showCand['mobile1'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="mobile2" class="col-sm-4 col-form-label">Nomor HP 2 / Mobile Number 2</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" value="<?= $showCand['mobile2'] ?>" disabled>
                  </div>
                </div>

                <h4 style="color: #000000;text-decoration: underline;margin-top: 30px;">DOCUMENT UPLOADS</h4>
                <br>

                <div class="form-group row">
                  <label for="lastName" class="col-sm-4 col-form-label">Curricilum Vitae*</label>
                  <div class="col-sm-8">
                    <a href="<?php echo $halaman->base_path()?>media/files/<?= $showCand['cv'] ?>" target="_blank" title="Click to preview" style="text-decoration: none;">CLICK TO PREVIEW&nbsp;&nbsp;&nbsp;<i class="fa fa-file fa-3x"></i></a>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="lastName" class="col-sm-4 col-form-label">Seaman Book*</label>
                  <div class="col-sm-8">
                    <a href="<?php echo $halaman->base_path()?>media/files/<?= $showCand['seaman_book'] ?>" target="_blank" title="Click to preview" style="text-decoration: none;">CLICK TO PREVIEW&nbsp;&nbsp;&nbsp;<i class="fa fa-file fa-3x"></i></a>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="lastName" class="col-sm-4 col-form-label">Previous Contract as Proof*</label>
                  <div class="col-sm-8">
                    <a href="<?php echo $halaman->base_path()?>media/files/<?= $showCand['contract'] ?>" target="_blank" title="Click to preview" style="text-decoration: none;">CLICK TO PREVIEW&nbsp;&nbsp;&nbsp;<i class="fa fa-file fa-3x"></i></a>
                  </div>
                </div>

                <h4 style="color: #000000;text-decoration: underline;margin-top: 30px;">AGREEMENT</h4>
                <br>

                <div class="form-group row">
                <label class="form-check-label" style="margin-left: 35px;margin-top: 15px;">
                    <input class="form-check-input" type="checkbox" checked disabled> I agree to the above terms and will comply with enforce the rules set by the company
                </label>

              </div>
              <!-- preview -->

            
              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <a href="<?php echo $halaman->base_path()?>shipping-declaration"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUBMIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>
          </form>
        </div>

    </div>
  </div>
