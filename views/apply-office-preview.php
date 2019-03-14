   <?php
   
    if (!isset($_SESSION['email'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
       
       }
   
    $job     = 'SELECT a.*,b.job_name FROM sch_jobs a JOIN sch_master_job b ON a.id_job_name=b.id WHERE a.id="'.$_GET['ids'].'"';
    $showJob = $object->fetch($job);

    $cand     = 'SELECT * FROM sch_candidate_office WHERE email="'.$_SESSION['email'].'"';
    $showCand = $object->fetch($cand);


    if(isset($_POST['_submit'])){ 

        $namatable = 'sch_candidate_office';
        $data = array(
              'id_job'=>trim($_POST['idJob']), 
              'cand_type'=>'office',
              'full_name'=>trim($_POST['fullName']),
              'birth_place'=>trim($_POST['placeofBirth']), 
              'birth_date'=>trim($_POST['dateofBirth']), 
              'email'=>trim($_POST['email']),
              'idcard_number'=>trim($_POST['idcard_number']),
              'tax_number'=>trim($_POST['taxNumber']),
              'passport_number'=>trim($_POST['passportNumber']),
              'gender'=>trim($_POST['gender']),  
              'cityzenship'=>trim($_POST['cityzenship']),
              'ethnic'=>trim($_POST['ethnic']),
              'religion'=>trim($_POST['religion']),
              'marital_status'=>trim($_POST['maritalStatus']),
              'expected_salary'=>trim($_POST['salary']),
              'url_socmed'=>trim($_POST['socmedUrl']),
              'status'=>'0'
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg  = $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."office-address'); </script>";
        $_SESSION['idCand'] = $showCand['id'];
        $_SESSION['idJob'] = $showJob['id'];
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
        width: 10%!important;
        padding: 0 5px;
        text-align: center;
    }
   </style>

    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">

        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;">STEP 1</h4>
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
                  <div class="form-wizard ">
                      <div class="wizard-icon"><i class="fa fa-map"></i></div>
                      <p>Address</p>
                  </div>
                  <div class="form-wizard ">
                      <div class="wizard-icon"><i class="fa fa-graduation-cap"></i></div>
                      <p>Formal Education</p>
                  </div>
                  <div class="form-wizard ">
                      <div class="wizard-icon"><i class="fa fa-users"></i></div>
                      <p>Family Member</p>
                  </div>
                  <div class="form-wizard ">
                      <div class="wizard-icon"><i class="fa fa-info-circle"></i></div>
                      <p>General Information</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-briefcase"></i></div>
                      <p>Work Experience</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Reference</p>
                  </div>
                  <div class="form-wizard">
                      <div class="wizard-icon"><i class="fa fa-file-text-o"></i></div>
                      <p>Upload</p>
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

              <!-- start personal data -->
              <div style="padding: 30px;">
                <h4 style="font-weight: normal;color: #000000;text-align: center;">PERSONAL DATA</h4>
                <br>

                <div class="form-group row">
                  <label for="idCard" class="col-sm-4 col-form-label">Apply for Job</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" value="<?= $showJob['job_name'] ?>" disabled>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="email" class="col-sm-4 col-form-label">Email*</label>
                  <div class="col-sm-8">
                    <input type="email" class="form-control" id="email" name="email" value="<?= $showCand['email']; ?>" disabled>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="fullName" class="col-sm-4 col-form-label">Nama Lengkap (sesuai KTP) / COMPLETE NAME REFER TO ID CARD *</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="fullName" name="fullName" value="<?= $showCand['full_name']; ?>" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat lahir / Place of birth *</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="placeofBirth" name="placeofBirth" value="<?= $showCand['birth_place']; ?>" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal lahir / Date of birth *</label>
                  <div class="col-sm-8">
                    <input type="date" class="form-control" id="dateofBirth" name="dateofBirth" value="<?= $showCand['birth_date']; ?>" >
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="idcardNumber" class="col-sm-4 col-form-label">Nomor KTP / ID Card Number *</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="idcardNumber" name="idcardNumber" value="<?= $showCand['idcard_number']; ?>" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="taxNumber" class="col-sm-4 col-form-label">Nomor NPWP / Tax number</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="taxNumber" name="taxNumber" value="<?= $showCand['tax_number']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="passportNumber" class="col-sm-4 col-form-label">Nomor Passport / Passport number</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="passportNumber" name="passportNumber" value="<?= $showCand['passport_number']; ?>">
                  </div>
                </div>

                <div class="form-group row">
                  <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin / Gender*</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="gender" name="gender" required>
                      <option selected disabled>------Please Select Below------</option>
                      <option value="Male" <?php if($showCand['gender'] == "Male"){echo "selected";} ?>>Male</option>
                      <option value="Female" <?php if($showCand['gender'] == "Female"){echo "selected";} ?>>Female</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="cityzenship" class="col-sm-4 col-form-label">Kewarganegaraan / Citizenship *</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="cityzenship" name="cityzenship" >
                      <option selected>------Please Select Below------</option>
                      <option value="WNI" <?php if($showCand['cityzenship'] == "WNI"){echo "selected";} ?>>WNI</option>
                      <option value="WNA" <?php if($showCand['cityzenship'] == "WNA"){echo "selected";} ?>>WNA</option>
                    </select>
                  </div>
                </div>        

                <div class="form-group row">
                  <label for="ethnic" class="col-sm-4 col-form-label">Suku / Ethnic</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="ethnic" name="ethnic">
                      <option selected>------Please Select Below------</option>
                      <option value="JAWA" <?php if($showCand['ethnic'] == "JAWA"){echo "selected";} ?>>JAWA</option>
                      <option value="SUNDA" <?php if($showCand['ethnic'] == "SUNDA"){echo "selected";} ?>>SUNDA</option>
                      <option value="BATAK" <?php if($showCand['ethnic'] == "BATAK"){echo "selected";} ?>>BATAK</option>
                      <option value="MADURA" <?php if($showCand['ethnic'] == "MADURA"){echo "selected";} ?>>MADURA</option>
                      <option value="BETAWI" <?php if($showCand['ethnic'] == "BETAWI"){echo "selected";} ?>>BETAWI</option>
                      <option value="DAYAK" <?php if($showCand['ethnic'] == "DAYAK"){echo "selected";} ?>>DAYAK</option>
                      <option value="MELAYU" <?php if($showCand['ethnic'] == "MELAYU"){echo "selected";} ?>>MELAYU</option>
                      <option value="TIONGHOA" <?php if($showCand['ethnic'] == "TIONGHOA"){echo "selected";} ?>>TIONGHOA</option>
                      <option >OTHER</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="religion" class="col-sm-4 col-form-label">Agama / Religion *</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="religion" name="religion" >
                      <option selected>------Please Select Below------</option>
                      <option value="ISLAM" <?php if($showCand['religion'] == "ISLAM"){echo "selected";} ?>>ISLAM</option>
                      <option value="KATHOLIK" <?php if($showCand['religion'] == "KATHOLIK"){echo "selected";} ?>>KATHOLIK</option>
                      <option value="KRISTEN" <?php if($showCand['religion'] == "KRISTEN"){echo "selected";} ?>>KRISTEN</option>
                      <option value="BUDHA" <?php if($showCand['religion'] == "BUDHA"){echo "selected";} ?>>BUDHA</option>
                      <option value="HINDU" <?php if($showCand['religion'] == "HINDU"){echo "selected";} ?>>HINDU</option>
                      <option value="KONG HU CU" <?php if($showCand['religion'] == "KONG HU CU"){echo "selected";} ?>>KONG HU CU</option>
                      <option >OTHER</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="maritalStatus" class="col-sm-4 col-form-label">Status Marital / Marital Status *</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="maritalStatus" name="maritalStatus" >
                      <option selected>------Please Select Below------</option>
                      <option value="LAJANG" <?php if($showCand['marital_status'] == "LAJANG"){echo "selected";} ?>>LAJANG</option>
                      <option value="MENIKAH" <?php if($showCand['marital_status'] == "MENIKAH"){echo "selected";} ?>>MENIKAH</option>
                      <option value="JANDA" <?php if($showCand['marital_status'] == "JANDA"){echo "selected";} ?>>JANDA</option>
                      <option value="DUDA" <?php if($showCand['marital_status'] == "DUDA"){echo "selected";} ?>>DUDA</option>
                      <option >OTHER</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label for="blood" class="col-sm-4 col-form-label">Golongan darah / Blood clasification</label>
                  <div class="col-sm-8">
                    <select class="form-control" id="blood" name="blood">
                      <option selected>------Please Select Below------</option>
                      <option value="O" <?php if($showCand['blood'] == "O"){echo "selected";} ?>>O</option>
                      <option value="A" <?php if($showCand['blood'] == "A"){echo "selected";} ?>>A</option>
                      <option value="B" <?php if($showCand['blood'] == "B"){echo "selected";} ?>>B</option>
                      <option value="AB" <?php if($showCand['blood'] == "AB"){echo "selected";} ?>>AB</option>
                    </select>
                  </div>
                </div>
                
                <div class="form-group row">
                  <label for="salary" class="col-sm-4 col-form-label">Gaji Yang Diharapkan / Expected Salary *</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="salary" name="salary" value="<?= $showCand['expected_salary'] ?>" >
                  </div>
                </div>

                <div class="form-group row">
                  <label for="socmedUrl" class="col-sm-4 col-form-label">Media Sosial (masukan link salah satu media sosial milik anda, Linkedin, Facebook, Instagram) / Please provide one of your social media URL</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="socmedUrl" name="socmedUrl" value="<?= $showCand['url_socmed'] ?>">
                  </div>
                </div>

              </div>
              <!-- end personal data -->   

              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <input type="hidden" value="<?php echo $showJob['id']; ?>" name="idJob">
                      <input type="hidden" value="<?php echo $showCand['id']; ?>" name="id">
                      <input type="submit" class="btn btn-primary" name="_submit" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>       
          </form>
        </div>

    </div>
  </div>
