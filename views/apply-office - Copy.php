   <?php
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   
   require_once dirname( __FILE__ ) . '/../vendor/autoload.php';
   
    $job     = 'SELECT * FROM sch_jobs WHERE id="'.$_GET['ids'].'"';
    $showJob = $object->fetch($job);

    $checkCode  = 'SELECT candidate_code FROM sch_candidate_office';
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
    $codeCandidate="OFC".''.$no.$next;

     if(isset($_POST['_submit'])) {
      

            $object->create_path();
            
            $filePhoto      = $object->uploadPhoto();
            $file_idCard    = $object->uploadIDCard();
            $eduCert        = $object->uploadEduCert();
            $eduTranscript  = $object->uploadEduTranscript();
            $trainingCert   = $object->uploadTrainingCert();

            $apply="INSERT INTO `sch_candidate_office` SET
              `candidate_code`='".trim($codeCandidate)."', 
              `id_job`='".trim($_POST['idJob'])."', 
              `cand_type`='office',
              `full_name`='".trim($_POST['fullName'])."',
              `birth_place`='".trim($_POST['placeofBirth'])."', 
              `birth_date`='".trim($_POST['dateofBirth'])."', 
              `email`='".trim($_POST['email'])."',
              `passport_number`='".trim($_POST['passportNumber'])."',
              `gender`='".trim($_POST['gender'])."',  
              `cityzenship`='".trim($_POST['cityzenship'])."',
              `ethnic`='".trim($_POST['ethnic'])."',
              `religion`='".trim($_POST['religion'])."',
              `marital_status`='".trim($_POST['maritalStatus'])."',
              `expected_salary`='".trim($_POST['salary'])."',
              `url_socmed`='".trim($_POST['socmedUrl'])."',
              `file_photo`='".trim($filePhoto)."',
              `file_idcard`='".trim($file_idCard)."',
              `edu_cert`='".trim($eduCert)."',
              `edu_transcript`='".trim($eduTranscript)."',
              `training_cert`='".trim($trainingCert)."',
              `status`='0',
              `created`='".date("Y-m-d H:i:s")."', 
              `modified`='".date("Y-m-d H:i:s")."'
            ";

            if ($object->add($apply)) {
                  
                  $message = file_get_contents(''.$halaman->base_path().'emailtemplates/office-thankyou-candidate.html');
                  $message = str_replace("%_POST['fullName']%", $_POST['fullName'], $message);
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
  ?>
 <style>
     .form-control {
        font-size: small!important;
      }
     .col-form-label {
        font-size: small;
      }
   </style>

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
                  <label for="fullName" class="col-sm-4 col-form-label">Nama Lengkap (sesuai KTP) / COMPLETE NAME REFER TO ID CARD *</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="fullName" name="fullName" placeholder="" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat lahir / Place of birth *</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="placeofBirth" name="placeofBirth" placeholder="" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal lahir / Date of birth *</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="dateofBirth" name="dateofBirth" placeholder="" >
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label">Email*</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" placeholder="" >
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">Nomor KTP / ID Card Number *</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="idCard" name="idCard" placeholder="" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="taxNumber" class="col-sm-4 col-form-label">Nomor NPWP / Tax number</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="taxNumber" name="taxNumber" placeholder="">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="passportNumber" class="col-sm-4 col-form-label">Nomor Passport / Passport number</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="passportNumber" name="passportNumber" placeholder="">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Jenis Kelamin / Gender *</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="gender" name="gender" >
                      <option selected>------Please Select Below------</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="cityzenship" class="col-sm-4 col-form-label">Kewarganegaraan / Citizenship *</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="cityzenship" name="cityzenship" >
                      <option selected>------Please Select Below------</option>
                      <option value="WNI">WNI</option>
                      <option value="WNA">WNA</option>
                    </select>
                  </div>
                </div>        

                <div class="form-group row">
                  <label for="ethnic" class="col-sm-4 col-form-label">Suku / Ethnic</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="ethnic" name="ethnic">
                      <option selected>------Please Select Below------</option>
                      <option value="JAWA">JAWA</option>
                      <option value="SUNDA">SUNDA</option>
                      <option value="BATAK">BATAK</option>
                      <option value="MADURA">MADURA</option>
                      <option value="BETAWI">BETAWI</option>
                      <option value="DAYAK">DAYAK</option>
                      <option value="MELAYU">MELAYU</option>
                      <option value="TIONGHOA">TIONGHOA</option>
                      <option >OTHER</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="religion" class="col-sm-4 col-form-label">Agama / Religion *</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="religion" name="religion" >
                      <option selected>------Please Select Below------</option>
                      <option value="ISLAM">ISLAM</option>
                      <option value="KATHOLIK">KATHOLIK</option>
                      <option value="KRISTEN">KRISTEN</option>
                      <option value="BUDHA">BUDHA</option>
                      <option value="HINDU">HINDU</option>
                      <option value="KONG HU CU">KONG HU CU</option>
                      <option >OTHER</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="maritalStatus" class="col-sm-4 col-form-label">Status Marital / Marital Status *</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="maritalStatus" name="maritalStatus" >
                      <option selected>------Please Select Below------</option>
                      <option value="LAJANG">LAJANG</option>
                      <option value="MENIKAH">MENIKAH</option>
                      <option value="JANDA">JANDA</option>
                      <option value="DUDA">DUDA</option>
                      <option >OTHER</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="blood" class="col-sm-4 col-form-label">Golongan darah / Blood clasification</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="blood" name="blood">
                      <option selected>------Please Select Below------</option>
                      <option value="O">O</option>
                      <option value="A">A</option>
                      <option value="B">B</option>
                      <option value="AB">AB</option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="salary" class="col-sm-4 col-form-label">Gaji Yang Diharapkan / Expected Salary *</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="salary" name="salary" placeholder="Rp." >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="socmedUrl" class="col-sm-4 col-form-label">Media Sosial (masukan link salah satu media sosial milik anda, Linkedin, Facebook, Instagram) / Please provide one of your social media URL</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="socmedUrl" name="socmedUrl" placeholder="">
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
                          <label for="lastName" class="col-sm-4 col-form-label">FOTO / PHOTO*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="photo" name="photo" accept=".jpeg, .png, .jpg" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">KTP / ID CARD*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="file_idCard" name="file_idCard" accept=".jpeg, .png, .jpg" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">IJAZAH PENDIDIKAN TERAKHIR / EDUCATION CERTIFICATE*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="eduCert" name="eduCert" accept=".pdf, .doc, .docx" required>
                          </div>
                        </div>
                        
                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">TRANSKRIP PENDIDIKAN TERAKHIR / EDUCATION TRANSCRIPT*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="eduTranscript" name="eduTranscript" accept=".pdf, .doc, .docx" required>
                          </div>
                        </div>

                        <div class="form-group row">
                          <label for="lastName" class="col-sm-4 col-form-label">SERTIFIKAT PELATIHAN / TRAINING CERTIFICATE*</label>
                          <div class="col-sm-8">
                            <input type="file" class="form-control-file" id="trainingCert" name="trainingCert" accept=".pdf, .doc, .docx" required>
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
                  <iframe src="<?php echo $halaman->base_path()?>license_office.txt"></iframe>
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
                      <button type="button" class="btn btn-previous">Previous</button>
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUBMIT FORM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                      <!-- <button type="submit" name="save" class="btn btn-primary btn-submit">Submit</button> -->
                  </div>
              </fieldset>
          </form>
        </div>

    </div>
  </div>
