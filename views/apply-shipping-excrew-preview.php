   <?php

   if (!isset($_SESSION['idCand'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
       
       }

   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   
   require_once dirname( __FILE__ ) . '/../vendor/autoload.php';
  

    $cand     = 'SELECT * FROM sch_ex_candidate WHERE id="'.$_SESSION['idCand'].'"';
    $showCand = $object->fetch($cand);
    $idCand   = $showCand['id'];

    $date= date("mdY");
    $tgl= str_shuffle($date);
    $karakter = 'ABCDEFGHIJKLMNOPQRSTUPWXYZ'.$tgl;
    $randomcode = $object->random(10,$karakter);
    $codeCandidate ="EXC".''.$randomcode;

        if(isset($_POST['_submit'])) {
        
            $apply="UPDATE `sch_ex_candidate` SET `candidate_code`='".trim($codeCandidate)."' WHERE id='$idCand'";

            if ($object->add($apply)) {
                  
                  $message = file_get_contents(''.$halaman->base_path().'emailtemplates/excrew-thankyou-candidate.html');
                  $message = str_replace("%showCand['first_name']%", $showCand['first_name'], $message);

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
                  <div class="form-wizard active" style="width:33%!important;">
                      <div class="wizard-icon"><i class="fa fa-user"></i></div>
                      <p>Personal Data</p>
                  </div>
                  <div class="form-wizard active" style="width:33%!important;">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Agreement</p>
                  </div>
                  <div class="form-wizard active" style="width:33%!important;">
                      <div class="wizard-icon"><i class="fa fa-check-circle"></i></div>
                      <p>Preview</p>
                  </div>
              </div>

                <!-- start personal data -->
              <div style="padding: 30px;">

                <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label">Alamat Email / Email address*</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" value="<?= $showCand['email'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">Nomor ID / ID Number (KTP/Passport)</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showCand['idcard_number'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="firstName" class="col-sm-4 col-form-label">Nama Depan / First Name*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showCand['first_name'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="lastName" class="col-sm-4 col-form-label">Nama Belakang / Last Name*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showCand['last_name'] ?>" disabled>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="id_company" class="col-sm-4 col-form-label">ID Perusahaan / Company ID*</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showCand['company_id'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="last_ship" class="col-sm-4 col-form-label">Kapal SOECHI Terakhir / Last SOECHI Ship*</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="last_ship" name="last_ship" disabled>
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
                    <select class="form-control" id="last_rank" name="last_rank" disabled>
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
                    <input type="text" class="form-control" value="<?= $showCand['phone'] ?>" disabled>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="ready_date" class="col-sm-4 col-form-label">Tanggal Kesiapan / Readiness Date*</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" value="<?= $showCand['ready_join_date'] ?>" disabled>
                  </div>
                </div>

                <h4 style="color: #000000;text-decoration: underline;margin-top: 30px;">AGREEMENT</h4>
                <br>

                <div class="form-group row">
                <label class="form-check-label" style="margin-left: 35px;margin-top: 15px;">
                    <input class="form-check-input" type="checkbox" checked disabled> I agree to the above terms and will comply with enforce the rules set by the company
                </label>

              </div>

                <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <a href="<?php echo $halaman->base_path()?>excrew-agreement"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUBMIT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>
            
          </form>
        </div>

    </div>
  </div>
