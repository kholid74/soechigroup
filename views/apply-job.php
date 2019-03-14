   <?php
   
   use PHPMailer\PHPMailer\PHPMailer;
   use PHPMailer\PHPMailer\Exception;
   
   require_once $_SERVER['DOCUMENT_ROOT'].'/soechi/vendor/autoload.php';
   
    $job     = 'SELECT * FROM sch_jobs WHERE id="'.$_GET['ids'].'"';
    $showJob = $object->fetch($job);

     if(isset($_POST['_submit'])) {
        
      if(!empty($_FILES["cv"]["name"]) && !empty($_FILES["seaman_book"]["name"]) && !empty($_FILES["contract1"]["name"]) && !empty($_FILES["contract2"]["name"]))
              {

            $object->create_path();
            
            $cv         = $object->uploadCV();
            $seamanBook = $object->uploadSeamanBook();
            $contract1  = $object->uploadContract1();
            $contract2  = $object->uploadContract2();

            $apply="INSERT INTO `sch_candidate` SET 
              `id_job`='".trim($_POST['idJob'])."', 
              `id_countries`='".trim($_POST['country'])."',
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
              `address`='".trim($_POST['address'])."', 
              `status`='".trim($_POST['status'])."', 
              `created`='".date("Y-m-d H:i:s")."', 
              `modified`='".date("Y-m-d H:i:s")."'
            ";

            //$object->add($apply)
            if ($object->add($apply)) {

                  $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
                              
                  //Recipients
                  $mail->setFrom('demo@essentials.id', 'Soechi Recruitment');
                  $mail->addAddress(''.$_POST['email'].'', 'Candidate');     // Add a recipient
                  $mail->addReplyTo('demo@essentials.id', 'Information');

                  //Content
                  $mail->isHTML(true);                                  // Set email format to HTML
                  $mail->Subject = 'Thank you for your application';
                  $mail->Body    = '<!DOCTYPE html>
                        <html>
                        <head>
                        <meta http-equiv="Content-Type" content="text/html;
                        charset=UTF-8">
                        <title>Soechi Lines</title>
                        </head>
                        <body leftmargin="0" marginwidth="0" topmargin="0" marginheight="0" offset="0">
                            <div id="wrapper" dir="ltr" style="background-color: #f5f5f5; margin: 0; padding: 70px 0 70px 0; -webkit-text-size-adjust: none !important; width: 100%;">
                                <table border="0" cellpadding="0" cellspacing="0" height="100%" width="100%"><tr>
                        <td align="center" valign="top">
                          <div id="template_header_image">
                                    <p style="margin-top: 0;"><img src="http://grab-indonesia.com/logo/logo.png" alt="Soechi" by SCG" style="border: none; display: inline; font-size: 14px; font-weight: bold; max-height: 80px; line-height: 100%; outline: none; text-decoration: none; text-transform: capitalize;"></p>            </div>
                                    <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_container" style="box-shadow: 0 1px 4px rgba(0,0,0,0.1) !important; background-color: #024a90; border: 1px solid #dcdcdc; border-radius: 3px !important;">
                        <tr>
                        <td align="center" valign="top">
                                            <!-- Header -->
                                          <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_header" style="background-color: #024a90; border-radius: 3px 3px 0 0 !important; color: #ffffff; border-bottom: 0; font-weight: bold; line-height: 100%; vertical-align: middle; font-family: Helvetica, Arial, sans-serif;"><tr>
                        <td id="header_wrapper" style="padding: 36px 48px; display: block;">
                                            <h1 style="color: #ffffff; font-family: Helvetica, Arial, sans-serif; font-size: 20px; font-weight: 300; line-height: 150%; margin: 0; text-align: center; -webkit-font-smoothing: antialiased;">THANK YOU FOR APPLICATION </h1>
                                          </td>
                                      </tr></table>
                        <!-- End Header -->
                        </td>
                            </tr>
                        <tr>
                        <td align="center" valign="top">
                            <!-- Body -->
                        <table border="0" cellpadding="0" cellspacing="0" width="600" id="template_body"><tr>
                        <td valign="top" id="body_content" style="background-color: #fdfdfd;">
                            <!-- Content -->
                        <table border="0" cellpadding="20" cellspacing="0" width="100%"><tr>
                        <td valign="top" style="padding: 48px;padding-top: 15px;">
                        <div id="body_content_inner" style="color: #737373; font-family: Helvetica, Arial, sans-serif; font-size: 14px; line-height: 150%; text-align: justify;">
                        <br>
                        <table>
                          <tr>
                            <td><span style="font-family: Helvetica, Arial, sans-serif;">
                                    Hi '.$_POST['firstName'].', <br> 
                                    Thank you for applying in our company. Our team will review you application and we will inform you if you are suitable for this position.
                                </span></td>
                          </tr>
                          
                        <br>
                        </div>
                            </td>
                            </tr></table>
                        <!-- End Content -->
                        </td>
                            </tr></table>
                        <!-- End Body -->
                        </td>
                            </tr>
                        <tr>
                        <td align="center" valign="top">
                            <!-- Footer -->
                            <table border="0" cellpadding="10" cellspacing="0" width="600" id="template_footer"><tr>
                        <td valign="top" style="padding: 0; -webkit-border-radius: 6px;">
                            <table border="0" cellpadding="10" cellspacing="0" width="100%"><tr>
                        <td colspan="2" valign="middle" id="credit" style="padding: 0 48px 0 48px; -webkit-border-radius: 6px; border: 0; color: #eb1868; font-family: Arial; font-size: 12px; line-height: 125%; text-align: center;">
                            <p style="color: #FFF;">Soechi Lines Recruitment</p>
                            </td>
                            </tr></table>
                        </td>
                            </tr></table>
                        <!-- End Footer -->
                        </td>
                            </tr>
                        </table>
                        </td>
                            </tr></table>
                        </div>
                            </body>
                        </html>';

                  $mail->send();
                   //echo 'Message has been sent';
                
                echo "<script> window.location.assign('".$object->base_path()."thank-you');</script>";
                
            }else{

                $error = "Oops !! there is something error..";
            } 

        }


      }
  ?>

    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">
        <div class="col-md-10 offset-md-1" style="padding: 0px;margin-bottom: 30px;margin-top: 30px;">
          <h1 style="font-weight: normal;color: #007bff;">CAREERS</h1>
        </div>

        <div class="col-md-10 offset-md-1" style="padding: 0px;margin-bottom: 30px;">
            <?php if (isset($error)): ?>
            <div class="alert alert-danger alert-dismissible">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                <?php echo $error ?>
            </div> 
            <?php endif;?>
          <h3 style="font-weight: normal;color: #000000;">FILL THE FORM</h3>
          <br>
          <p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate, cum sint voluptatibus, nulla distinctio obcaecati vitae, quam ipsa reprehenderit consequatur iure aliquid soluta inventore accusamus ea aut delectus ad fuga. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Explicabo rerum quibusdam iure cumque perferendis, soluta aut eius, error, autem suscipit illo repellat optio inventore dignissimos debitis, minus aliquid beatae enim.</p>
        </div>
  
        <div class="col-md-10 offset-md-1" style="padding: 0px;">
            <h4 style="font-weight: normal;color: #000000;">PERSONAL DATA</h4>
            <div class="container">
              <form role="form" method="POST" enctype="multipart/form-data">
                
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
                      <option disabled>------Please Select Below------</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="inputPassword" class="col-sm-4 col-form-label">Nationality*</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="country" name="country" required>
                      <option disabled>------Please Select Below------</option>
                      <?php $sql = "SELECT * FROM sch_countries ORDER BY en_short_name ASC";
                            $countries = $object->fetch_all($sql);
                              foreach ($countries as $nation) {?>
                      <option value="<?= $nation['num_code'] ?>"><?= $nation['en_short_name'] ?></option>
                      <?php } ?>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="address" class="col-sm-4 col-form-label">Address*</label>
                  <div class="col-sm-8">
                    <textarea name="address" id="address" class="form-control" cols="10" rows="5" required></textarea>
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
                
            </div>
        </div>

        <div class="col-md-10 offset-md-1" style="padding: 0px;margin-bottom: 30px;">
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
                  <label for="lastName" class="col-sm-4 col-form-label">Upload Last 2 Previous Contract as Proff*</label>
                  <div class="col-sm-8">
                    <input type="file" class="form-control-file" id="contract1" name="contract1" accept=".pdf, .doc, .docx" required>
                    <br>
                    <input type="file" class="form-control-file" id="contract2" name="contract2" accept=".pdf, .doc, .docx" required>
                  </div>
                </div>
                <br><br>
                <div class="form-group" id="terms">
                  <label class="checkbox-inline">
                    <input type="checkbox" name="agree" id="agree" value="agree" required>
                      I have read and understand this agreement, and I accept and agree to all of it's <a href="#" data-toggle="modal" data-target=".bd-example-modal-lg">terms and conditions.</a> I enter into this agreement voluntarily, with full knowledge of it's effect.</label>
                </div>
                <div class="form-group row">
                  <input type="hidden" value="<?php echo $showJob['id']; ?>" name="idJob">
                  <input type="hidden" value="<?= $nation['num_code'] ?>" name="countries">
                  <input type="hidden" value="0" name="status">
                  <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;SUBMIT FORM&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                </div>
            
            </div>           
          </div></form>
        </div>
        <!-- Terms Condition -->
        <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <div class="row">
                      <div class="col-md-12">
                        <h5 class="modal-title" style="text-align: center;">AGREEMENT</h5> 
                        <br>   
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum recusandae dolor autem laudantium, quaerat vel dignissimos. Magnam sint suscipit omnis eaque unde eos aliquam distinctio, quisquam iste, itaque possimus a. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet alias modi eaque, ratione recusandae cupiditate dolorum repellendus iure eius rerum hic minus ipsa at, corporis nesciunt tempore vero voluptas. Tempore.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum recusandae dolor autem laudantium, quaerat vel dignissimos. Magnam sint suscipit omnis eaque unde eos aliquam distinctio, quisquam iste, itaque possimus a. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet alias modi eaque, ratione recusandae cupiditate dolorum repellendus iure eius rerum hic minus ipsa at, corporis nesciunt tempore vero voluptas. Tempore.</p>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum recusandae dolor autem laudantium, quaerat vel dignissimos. Magnam sint suscipit omnis eaque unde eos aliquam distinctio, quisquam iste, itaque possimus a. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet alias modi eaque, ratione recusandae cupiditate dolorum repellendus iure eius rerum hic minus ipsa at, corporis nesciunt tempore vero voluptas. Tempore.Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cum recusandae dolor autem laudantium, quaerat vel dignissimos. Magnam sint suscipit omnis eaque unde eos aliquam distinctio, quisquam iste, itaque possimus a. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Eveniet alias modi eaque, ratione recusandae cupiditate dolorum repellendus iure eius rerum hic minus ipsa at, corporis nesciunt tempore vero voluptas. Tempore.</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div> 
            </div>
          </div>
        </div>
<!-- End Terms Condition -->

    </div>
  </div>
