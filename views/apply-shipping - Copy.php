   <?php
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   
   require_once dirname( __FILE__ ) . '/../vendor/autoload.php';
   
    $job     = 'SELECT * FROM sch_jobs WHERE id="'.$_GET['ids'].'"';
    $showJob = $object->fetch($job);

    $checkCode  = 'SELECT candidate_code FROM sch_candidate_shipping';
    $candCode   = $object->fetch_all($checkCode);
    $countCode  = count($candCode);
    $cekQ=$countCode;

    $awalQ=substr($cekQ,0-6);
    $next=$awalQ+1;
    $kode=strlen($next);
    if(!$cekQ)
    { $no='00000'; }
    elseif($kode==1)
    { $no='00000'; }
    elseif($kode==2)
    { $no='0000'; }
    elseif($kode==3)
    { $no='000'; }
    elseif($kode==4)
    { $no='00'; }
    elseif($kode==5)
    { $no='0'; }
    elseif($kode=6)
    { $no=''; }
    $codeCandidate="SHP".''.$no.$next;

     if(isset($_POST['_submit'])) {
        
      if(!empty($_FILES["cv"]["name"]) && !empty($_FILES["seaman_book"]["name"]) && !empty($_FILES["contract1"]["name"]) && !empty($_FILES["contract2"]["name"]))
        {

            $object->create_path();
            
            $cv         = $object->uploadCV();
            $seamanBook = $object->uploadSeamanBook();
            $contract1  = $object->uploadContract1();
            $contract2  = $object->uploadContract2();

            //$IDCandShip = '001'.$showJob['id'].''.$object->randomID(5).''.time();

            $apply="INSERT INTO `sch_candidate_shipping` SET
              `candidate_code`='".trim($codeCandidate)."', 
              `id_job`='".trim($_POST['idJob'])."', 
              `id_countries`='".trim($_POST['country'])."',
              `card_number`='".trim($_POST['idCard'])."',
              `first_name`='".trim($_POST['firstName'])."',
              `last_name`='".trim($_POST['lastName'])."', 
              `birth_place`='".trim($_POST['placeofBirth'])."', 
              `birth_date`='".trim($_POST['dateofBirth'])."', 
              `gender`='".trim($_POST['gender'])."', 
              `email`='".trim($_POST['email'])."', 
              `phone`='".trim($_POST['phoneNumber'])."',
              `city`='".trim($_POST['city'])."',
              `cv`='".trim($cv)."',
              `seaman_book`='".trim($seamanBook)."',
              `contract1`='".trim($contract1)."',
              `contract2`='".trim($contract2)."',
              `status`='".trim($_POST['status'])."', 
              `created`='".date("Y-m-d H:i:s")."', 
              `modified`='".date("Y-m-d H:i:s")."'
            ";

            if ($object->add($apply)) {
                  
                  $message = file_get_contents(''.$halaman->base_path().'emailtemplates/shipping-thankyou-candidate.html');
                  $message = str_replace("%_POST['firstName']%", $_POST['firstName'], $message);
                  $message = str_replace("%showJob['job_name']%", $showJob['job_name'], $message);

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
                  $mail->addAddress(''.$_POST['email'].'', 'Candidate');    
                  $mail->addReplyTo('demo@essentials.id', 'Information');

                  //Content
                  $mail->isHTML(true);                              
                  $mail->Subject = 'Thank you for your application';
                  $mail->MsgHTML($message);

                  $mail->send();
                
                echo "<script> window.location.assign('".$object->base_path()."thank-you');</script>";
                
            }else{

                $error = "Oops !! there is something error..";
            } 
        }

      }
  ?>
 
    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">

        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;">APPLY JOB</h4>
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
              <fieldset style="padding: 30px;">
                <h4 style="font-weight: normal;color: #000000;">PERSONAL DATA</h4>
                <br>
                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">Apply for Job</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showJob['job_name'] ?>" disabled>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">ID (KTP/Passport)</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="idCard" name="idCard" placeholder="" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="firstName" class="col-sm-4 col-form-label">First Name*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="lastName" class="col-sm-4 col-form-label">Last Name*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="placeofBirth" class="col-sm-4 col-form-label">Place of Birth*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="placeofBirth" name="placeofBirth" placeholder="" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="dateofBirth" class="col-sm-4 col-form-label">Date of Birth*</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="dateofBirth" name="dateofBirth" placeholder="" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Gender*</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="gender" name="gender" required>
                      <option selected disabled>------Please Select Below------</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Nationality*</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="country" name="country" required>
                      <option selected disabled>------Please Select Below------</option>
                      <?php $sql = "SELECT * FROM sch_countries ORDER BY en_short_name ASC";
                            $countries = $object->fetch_all($sql);
                              foreach ($countries as $nation) {?>
                      <option value="<?= $nation['num_code'] ?>"><?= $nation['en_short_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="city" class="col-sm-4 col-form-label">City*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="city" name="city" placeholder="" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="phoneNumber" class="col-sm-4 col-form-label">Phone Number*</label>
                  <div class="col-sm-8">
                    <input type="number" onkeypress="return hanyaAngka(event, false)" class="form-control" id="phoneNumber" name="phoneNumber" placeholder="+62" required>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label">Email address*</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="" required>
                  </div>
                </div>
                  <div class="wizard-buttons">
                      <button type="button" class="btn btn-next">Next</button>
                  </div>
              </fieldset>
              <!-- end personal data -->

              <!-- start file upload -->
              <fieldset style="padding: 30px;">
                   <h4 style="font-weight: normal;color: #000000;">FILE UPLOADS</h4>
                    <small>Please upload your file maximum 500kb for every items. We Accept .jpg, .pdf, .doc, .docx</small>
                    <br><br>
                    <div class="container">
                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">Curricilum Vitae*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="cv" name="cv" accept=".pdf, .doc, .docx" required>
                            <small><i>*CV Must have Vessels Details on Type of Vessels/GRT/HP</i></small>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">Seaman Book*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="seaman_book" name="seaman_book" accept=".pdf, .doc, .docx" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">Upload Last 2 Previous Contract as Proof*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="contract1" name="contract1" accept=".pdf, .doc, .docx" required>
                            <br>
                            <input type="file" class="form-control-file" id="contract2" name="contract2" accept=".pdf, .doc, .docx" required>
                          </div>
                        </div>
                  <div class="wizard-buttons">
                      <button type="button" class="btn btn-previous">Previous</button>
                      <button type="button" class="btn btn-next">Next</button>
                  </div>
              </fieldset>
              <!-- file upload -->

              <!-- start agreement -->
              <fieldset style="padding: 30px;">
                  <iframe src="<?php echo $halaman->base_path()?>license.txt"></iframe>
                  <div class="form-group row">
                    <label class="form-check-label" style="margin-left: 35px;margin-top: 15px;">
                        <input class="form-check-input" type="checkbox" value="yes"> I agree to the above terms and will comply with enforce the rules set by the company
                    </label>
                  </div>
                  <div class="wizard-buttons">
                      <button type="button" class="btn btn-previous">Previous</button>
                      <button type="button" class="btn btn-next">Next</button>
                  </div>
              </fieldset>
              <!-- end agreement -->
              
              <fieldset style="padding: 30px;">
                  <div class="jumbotron text-center">
                  <h1>Please click <b>SUBMIT FORM</b> button to save your data</h1>
                  </div>
                  <div class="wizard-buttons">
                      <input type="hidden" value="<?php echo $showJob['id']; ?>" name="idJob">
                      <input type="hidden" value="<?= $nation['num_code'] ?>" name="countries">
                      <input type="hidden" value="0" name="status">
                      <button type="button" class="btn btn-previous">Previous</button>
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUBMIT FORM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                      <!-- <button type="submit" name="save" class="btn btn-primary btn-submit">Submit</button> -->
                  </div>
              </fieldset>
          </form>
        </div>

    </div>
  </div>
