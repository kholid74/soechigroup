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

    $family     = 'SELECT * FROM sch_cand_office_family WHERE id_candidate="'.$idCand.'"';
    $showFamily = $object->fetch($family); 

    if(isset($_POST['_saveCore'])) {
        $namatable = 'sch_cand_office_family';
        $data = array(
          'id_candidate'=> $idCand,
          'type' => 'core',
          'family_status' => $_POST['familyStatus'],
          'family_name' => $_POST['familyName'],
          'gender' => $_POST['gender'],
          'birth_place' => $_POST['placeofBirth'],
          'birth_date' => $_POST['dateofBirth'],
          'education' => $_POST['education'],
          'occupation' => $_POST['occupation']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."office-family-member'); </script>";
    }

    if(isset($_POST['_updatecore'])){ 

        $namatable = 'sch_cand_office_family';
        $data = array(
          'family_name' => $_POST['familyName'],
          'gender' => $_POST['gender'],
          'birth_place' => $_POST['placeofBirth'],
          'birth_date' => $_POST['dateofBirth'],
          'education' => $_POST['education'],
          'occupation' => $_POST['occupation']
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."office-family-member'); </script>";
        
    }

    if(isset($_POST['_savePrimary'])) {
        $namatable = 'sch_cand_office_family';
        $data = array(
          'id_candidate'=> $idCand,
          'type' => 'primary',
          'family_status' => $_POST['familyStatus'],
          'family_name' => $_POST['familyName'],
          'gender' => $_POST['gender'],
          'birth_place' => $_POST['placeofBirth'],
          'birth_date' => $_POST['dateofBirth'],
          'education' => $_POST['education'],
          'occupation' => $_POST['occupation']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."office-family-member'); </script>";
    }

    if(isset($_POST['_updateprimary'])){ 

        $namatable = 'sch_cand_office_family';
        $data = array(
          'family_name' => $_POST['familyName'],
          'gender' => $_POST['gender'],
          'birth_place' => $_POST['placeofBirth'],
          'birth_date' => $_POST['dateofBirth'],
          'education' => $_POST['education'],
          'occupation' => $_POST['occupation']
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."office-family-member'); </script>";
        
    }

    if(isset($_POST['_saveEmergency'])) {
        $namatable = 'sch_cand_office_emergency';
        $data = array(
          'id_candidate'=> $idCand,
          'name' => $_POST['contactName'],
          'relation' => $_POST['relation'],
          'address' => $_POST['address'],
          'phone' => $_POST['phoneNumber']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."office-family-member'); </script>";
    }

    if(isset($_POST['_updateemergency'])){ 

        $namatable = 'sch_cand_office_emergency';
        $data = array(
          'name' => $_POST['contactName'],
          'relation' => $_POST['relation'],
          'address' => $_POST['address'],
          'phone' => $_POST['phoneNumber']
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."office-family-member'); </script>";
        
    }

    if(isset($_POST['_forward'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."office-general-information'); </script>";
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
        width: 11%!important;
        padding: 0 5px;
        text-align: center;
        font-size: small;
    }
   </style>

    <div class="container">
      <div class="row" style="background-color: #F1F1F2;">

        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;">STEP 4</h4>
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
                
              </div>

              <!-- start personal data -->
              <div style="padding: 30px;">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#coreFamily"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Core Family</button>    
                <p align="center" style="font-weight: bold;">KELUARGA INTI / CORE FAMILY MEMBER</p>
                
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                  <tr style="font-weight: bold;">
                    <td style="font-size: 12px;">Status Keluarga</td>
                    <td style="font-size: 12px;">Nama</td>
                    <td style="font-size: 12px;">Jenis Kelamin</td>
                    <td style="font-size: 12px;">Tempat Lahir</td>
                    <td style="font-size: 12px;">Tanggal Lahir</td>
                    <td style="font-size: 12px;">Pendidikan</td>
                    <td style="font-size: 12px;">Pekerjaan</td>
                    <td style="font-size: 12px;">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = 'SELECT * FROM sch_cand_office_family WHERE type="core" AND id_candidate="'.$_SESSION['idCand'].'"';
                  $exp = $object->fetch_all($sql);
                  if (count($exp) > 0) {
                    foreach ($exp as $smp) {?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['family_status'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['family_name'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['gender'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['birth_place'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['birth_date'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['education'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['occupation'] ?></td>

                    <!-- MODAL -->
                    <div class="modal" id="editcore<?= $smp['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">KELUARGA INTI / CORE FAMILY MEMBER</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                            <div class="container-fluid">
                            <div class="row">

                              <div class="col-md-12">
                                 
                                 <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="familyStatus">Status Keluarga / Family Status</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" value="<?= $smp['family_status'] ?>" disabled>
                                    </div>
                                   </div>

                                  <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="familyName">Family Name / Nama</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="familyName" name="familyName" value="<?= $smp['family_name'] ?>" required>
                                    </div>
                                   </div>
                                   
                                   <div class="form-group row">
                                    <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin / Gender</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" id="gender" name="gender" required>
                                        <option selected disabled>------Please Select Below------</option>
                                        <option value="Male" <?php if($smp['gender'] == "Male"){echo "selected";} ?>>Male</option>
                                        <option value="Female" <?php if($smp['gender'] == "Female"){echo "selected";} ?>>Female</option>
                                      </select>
                                    </div>
                                  </div>

                                   <div class="form-group row">
                                    <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat lahir / Place of birth</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="placeofBirth" name="placeofBirth" value="<?= $smp['birth_place'] ?>">
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal lahir / Date of birth</label>
                                    <div class="col-sm-8">
                                      <input type="date" class="form-control" id="dateofBirth" name="dateofBirth" value="<?= $smp['birth_date'] ?>">
                                    </div>
                                  </div>
                                  
                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="education">Pendidikan / Education</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="education" name="education" value="<?= $smp['education'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="occupation">Pekerjaan / occupation</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="occupation" name="occupation" value="<?= $smp['occupation'] ?>" required>
                                    </div>
                                   </div>

                              </div>
                            </div>
                        </div>
                           
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id" value="<?= $smp['id'] ?>">
                            <input type="submit" name="_updatecore"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Update Family" value="UPDATE" />
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>

                    <td style="font-size: 12px;font-weight: normal;">
                      <a style="cursor: pointer;" data-toggle="modal" data-target="#editcore<?php echo $smp['id']?>" ><i class="fa fa-pencil"></i></a> |

                      <a class="danger" href="<?php echo $object->base_path()?>delete-family/<?php echo $smp['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr>
                  <?php }}else { ?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="7">No Data..</td>
                  </tr>
                  <?php } ?>
                <hr>
                </tbody>
              </table>
              
              <br><br>
              
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#primaryFamily"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Primary Family</button>    
                <p align="center" style="font-weight: bold;">DATA ANGGOTA KELUARGA / PRIMARY FAMILY MEMBER</p>
                
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                  <tr style="font-weight: bold;">
                    <td style="font-size: 12px;">Status Keluarga</td>
                    <td style="font-size: 12px;">Nama</td>
                    <td style="font-size: 12px;">Jenis Kelamin</td>
                    <td style="font-size: 12px;">Tempat Lahir</td>
                    <td style="font-size: 12px;">Tanggal Lahir</td>
                    <td style="font-size: 12px;">Pendidikan</td>
                    <td style="font-size: 12px;">Pekerjaan</td>
                    <td style="font-size: 12px;">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = 'SELECT * FROM sch_cand_office_family WHERE type="primary" AND id_candidate="'.$_SESSION['idCand'].'"';
                  $exp = $object->fetch_all($sql);
                  if (count($exp) > 0) {
                    foreach ($exp as $primary) {?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;"><?= $primary['family_status'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $primary['family_name'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $primary['gender'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $primary['birth_place'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $primary['birth_date'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $primary['education'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $primary['occupation'] ?></td>
                    
                    <!-- MODAL -->
                    <div class="modal" id="editprimary<?= $primary['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">KELUARGA INTI / CORE FAMILY MEMBER</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                            <div class="container-fluid">
                            <div class="row">

                              <div class="col-md-12">
                                 
                                 <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="familyStatus">Status Keluarga / Family Status</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" value="<?= $primary['family_status'] ?>" disabled>
                                    </div>
                                   </div>

                                  <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="familyName">Family Name / Nama</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="familyName" name="familyName" value="<?= $primary['family_name'] ?>" required>
                                    </div>
                                   </div>
                                   
                                   <div class="form-group row">
                                    <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin / Gender</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" id="gender" name="gender" required>
                                        <option selected disabled>------Please Select Below------</option>
                                        <option value="Male" <?php if($primary['gender'] == "Male"){echo "selected";} ?>>Male</option>
                                        <option value="Female" <?php if($primary['gender'] == "Female"){echo "selected";} ?>>Female</option>
                                      </select>
                                    </div>
                                  </div>

                                   <div class="form-group row">
                                    <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat lahir / Place of birth</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="placeofBirth" name="placeofBirth" value="<?= $primary['birth_place'] ?>">
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal lahir / Date of birth</label>
                                    <div class="col-sm-8">
                                      <input type="date" class="form-control" id="dateofBirth" name="dateofBirth" value="<?= $primary['birth_date'] ?>">
                                    </div>
                                  </div>
                                  
                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="education">Pendidikan / Education</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="education" name="education" value="<?= $primary['education'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="occupation">Pekerjaan / occupation</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="occupation" name="occupation" value="<?= $primary['occupation'] ?>" required>
                                    </div>
                                   </div>

                              </div>
                            </div>
                        </div>
                           
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id" value="<?= $primary['id'] ?>">
                            <input type="submit" name="_updatecore"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Update Family" value="UPDATE" />
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>

                    <td style="font-size: 12px;font-weight: normal;">
                      <a style="cursor: pointer;" data-toggle="modal" data-target="#editprimary<?php echo $primary['id']?>" ><i class="fa fa-pencil"></i></a> |

                      <a class="danger" href="<?php echo $object->base_path()?>delete-family/<?php echo $primary['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o"></i></a>
                    </td>

                  </tr>
                  <?php }}else { ?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="7">No Data..</td>
                  </tr>
                  <?php } ?>
                <hr>
                </tbody>
              </table>

              <br><br>
              
              <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#emergency"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Emergency Contact</button>    
                <p align="center" style="font-weight: bold;">PIHAK YANG BISA DIHUBUNGI DALAM KEADAAN DARURAT / EMERGENCY LIST CONTACT</p>
                
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                  <tr style="font-weight: bold;">
                    <td style="font-size: 12px;">Nama</td>
                    <td style="font-size: 12px;">Hubungan</td>
                    <td style="font-size: 12px;">Alamat</td>
                    <td style="font-size: 12px;">No. Telepon</td>
                    <td style="font-size: 12px;">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = 'SELECT * FROM sch_cand_office_emergency WHERE id_candidate="'.$_SESSION['idCand'].'"';
                  $exp = $object->fetch_all($sql);
                  if (count($exp) > 0) {
                    foreach ($exp as $emer) {?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;"><?= $emer['name'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $emer['relation'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $emer['address'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $emer['phone'] ?></td>
                    
                     <!-- MODAL -->
                    <div class="modal" id="editemergency<?= $emer['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="editemergency" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">KONTAK DARURAT / EMERGENCY LIST CONTACT</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body">
                            <form role="form" method="POST" enctype="multipart/form-data">
                            <div class="container-fluid">
                            <div class="row">

                              <div class="col-md-12">

                                  <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="contactName">Name / Nama</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="contactName" name="contactName" value="<?= $emer['name'] ?>" required>
                                    </div>
                                   </div>
                                  
                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="relation">Hubungan / Relation</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="relation" name="relation" value="<?= $emer['relation'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label for="address" class="col-sm-4 col-form-label">Alamat / Address</label>
                                    <div class="col-sm-8">
                                      <textarea name="address" class="form-control" id="address" cols="75" rows="3"><?= $emer['address'] ?></textarea>
                                    </div>
                                  </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="phoneNumber">Nomor Telepon / Phone Number</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= $emer['phone'] ?>" required>
                                    </div>
                                   </div>

                              </div>
                            </div>
                        </div>
                           
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id" value="<?= $emer['id'] ?>">
                            <input type="submit" name="_updateemergency"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Edit Emergency" value="UPDATE" />
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>

                    <td style="font-size: 12px;font-weight: normal;">
                      <a style="cursor: pointer;" data-toggle="modal" data-target="#editemergency<?php echo $emer['id']?>" ><i class="fa fa-pencil"></i></a> |

                      <a class="danger" href="<?php echo $object->base_path()?>delete-emergency/<?php echo $emer['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr>
                  <?php }}else { ?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="4">No Data..</td>
                  </tr>
                  <?php } ?>
                <hr>
                </tbody>
              </table>

              </div>
              <!-- end personal data -->   

              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <a href="<?php echo $halaman->base_path()?>office-formal-education"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_forward" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>       
          </form>
        </div>

    </div>
  </div>


<!-- MODAL -->
      <div class="modal" id="coreFamily" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">KELUARGA INTI / CORE FAMILY MEMBER</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" method="POST" enctype="multipart/form-data">
              <div class="container-fluid">
              <div class="row">

                <div class="col-md-12">
                   
                   <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="familyStatus">Status Keluarga / Family Status</label>
                      <div class="col-md-8">
                        <select name="familyStatus" class="form-control">
                          <option value="AYAH">AYAH</option>
                          <option value="IBU">IBU</option>
                          <option value="SAUDARA KANDUNG">SAUDARA KANDUNG</option>
                        </select>
                      </div>
                     </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="familyName">Family Name / Nama</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="familyName" name="familyName"required>
                      </div>
                     </div>
                     
                     <div class="form-group row">
                      <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin / Gender</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="gender" name="gender" required>
                          <option selected disabled>------Please Select Below------</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat lahir / Place of birth</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="placeofBirth" name="placeofBirth">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal lahir / Date of birth</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="dateofBirth" name="dateofBirth">
                      </div>
                    </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="education">Pendidikan / Education</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="education" name="education"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="occupation">Pekerjaan / occupation</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="occupation" name="occupation"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveCore"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>

<!-- MODAL -->
      <div class="modal" id="primaryFamily" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">DATA ANGGOTA KELUARGA / PRIMARY FAMILY</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" method="POST" enctype="multipart/form-data">
              <div class="container-fluid">
              <div class="row">

                <div class="col-md-12">
                   
                   <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="familyStatus">Status Keluarga / Family Status</label>
                      <div class="col-md-8">
                        <select name="familyStatus" class="form-control">
                          <option value="SUAMI">SUAMI</option>
                          <option value="ISTRI">ISTRI</option>
                          <option value="ANAK">ANAK</option>
                        </select>
                      </div>
                     </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="familyName">Family Name / Nama</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="familyName" name="familyName"required>
                      </div>
                     </div>
                     
                     <div class="form-group row">
                      <label for="gender" class="col-sm-4 col-form-label">Jenis Kelamin / Gender</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="gender" name="gender" required>
                          <option selected disabled>------Please Select Below------</option>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                    </div>

                     <div class="form-group row">
                      <label for="placeofBirth" class="col-sm-4 col-form-label">Tempat lahir / Place of birth</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="placeofBirth" name="placeofBirth">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="dateofBirth" class="col-sm-4 col-form-label">Tanggal lahir / Date of birth</label>
                      <div class="col-sm-8">
                        <input type="date" class="form-control" id="dateofBirth" name="dateofBirth">
                      </div>
                    </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="education">Pendidikan / Education</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="education" name="education"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="occupation">Pekerjaan / occupation</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="occupation" name="occupation"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_savePrimary"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>

    <!-- MODAL -->
      <div class="modal" id="emergency" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">KONTAK DARURAT / EMERGENCY LIST CONTACT</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" method="POST" enctype="multipart/form-data">
              <div class="container-fluid">
              <div class="row">

                <div class="col-md-12">

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="contactName">Name / Nama</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="contactName" name="contactName"required>
                      </div>
                     </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="relation">Hubungan / Relation</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="relation" name="relation"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label for="address" class="col-sm-4 col-form-label">Alamat / Address</label>
                      <div class="col-sm-8">
                        <textarea name="address" class="form-control" id="address" cols="75" rows="3"></textarea>
                      </div>
                    </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="phoneNumber">Nomor Telepon / Phone Number</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveEmergency"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>

  