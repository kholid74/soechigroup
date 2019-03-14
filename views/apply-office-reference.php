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

    $family     = 'SELECT * FROM sch_cand_office_reference WHERE id_candidate="'.$idCand.'"';
    $showFamily = $object->fetch($family); 

    if(isset($_POST['_saveReference'])) {
        $namatable = 'sch_cand_office_reference';
        $data = array(
          'id_candidate'=> $idCand,
          'name' => $_POST['name'],
          'company' => $_POST['company'],
          'position' => $_POST['position'],
          'years_known' => $_POST['yearsKnown'],
          'phone_number' => $_POST['phoneNumber']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."office-reference'); </script>";
    }

    if(isset($_POST['_updatereference'])){ 

        $namatable = 'sch_cand_office_reference';
        $data = array(
          'name' => $_POST['name'],
          'company' => $_POST['company'],
          'position' => $_POST['position'],
          'years_known' => $_POST['yearsKnown'],
          'phone_number' => $_POST['phoneNumber']
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."office-reference'); </script>";
        
    }

    if(isset($_POST['_forward'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."office-document-upload'); </script>";
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
          <h4 style="font-weight: bold;color: #000000;">STEP 7</h4>
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
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reference"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Reference</button>    
                <p align="center" style="font-weight: bold;">REFERENSI / REFERENCE</p>
                <small>Adakah referensi anda yang berada diluar perusahaan kami ? Bila ada mohon isi kolom dibawah ini / <i>Do you have any reference contact otside SOECHI GROUP Company? If you have, please fill collum below</i></small>
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                  <tr style="font-weight: bold;">
                    <td style="font-size: 12px;">Nama Referensi</td>
                    <td style="font-size: 12px;">Perusahaan</td>
                    <td style="font-size: 12px;">Jabatan</td>
                    <td style="font-size: 12px;">Lama Kenal</td>
                    <td style="font-size: 12px;">Nomor Telepon</td>
                    <td style="font-size: 12px;">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = 'SELECT * FROM sch_cand_office_reference WHERE id_candidate="'.$idCand.'"';
                  $exp = $object->fetch_all($sql);
                  if (count($exp) > 0) {
                    foreach ($exp as $smp) {?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['name'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['company'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['position'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['years_known'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['phone_number'] ?></td>
                    
                    <!-- MODAL -->
                    <div class="modal" id="editreference<?php echo $smp['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">REFERENSI / REFERENCE</h5>
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
                                    <label class="col-md-4 col-form-label" for="name">Nama Referensi / Reference Name *</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="name" name="name" value="<?= $smp['name'] ?>" required>
                                    </div>
                                   </div>
                                  
                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="company">Perusahaan / Company</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="company" name="company" value="<?= $smp['company'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="position">Jabatan / Position</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="position" name="position" value="<?= $smp['position'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="yearsKnown">Lama Kenal / Years Known</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="yearsKnown" name="yearsKnown" value="<?= $smp['years_known'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="phoneNumber">Nomor Telepon / Phone Number</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="<?= $smp['phone_number'] ?>" required>
                                    </div>
                                   </div>

                              </div>
                            </div>
                        </div>
                           
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id" value="<?= $smp['id'] ?>">
                            <input type="submit" name="_updatereference"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Edit Reference" value="UPDATE" />
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>

                    <td style="font-size: 12px;font-weight: normal;">
                      <a style="cursor: pointer;" data-toggle="modal" data-target="#editreference<?php echo $smp['id']?>" ><i class="fa fa-pencil"></i></a> |

                      <a class="danger" href="<?php echo $object->base_path()?>delete-reference/<?php echo $smp['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o"></i></a>
                    </td>
                  </tr>
                  <?php }}else { ?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="5">No Data..</td>
                  </tr>
                  <?php } ?>
                <hr>
                </tbody>
              </table>

              </div>
              <!-- end personal data -->   

              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <a href="<?php echo $halaman->base_path()?>office-work-experience"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_forward" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>       
          </form>
        </div>

    </div>
  </div>

    <!-- MODAL -->
      <div class="modal" id="reference" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">REFERENSI / REFERENCE</h5>
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
                      <label class="col-md-4 col-form-label" for="name">Nama Referensi / Reference Name *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="name" name="name"required>
                      </div>
                     </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="company">Perusahaan / Company</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="company" name="company"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="position">Jabatan / Position</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="position" name="position"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="yearsKnown">Lama Kenal / Years Known</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="yearsKnown" name="yearsKnown"required>
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
              <input type="submit" name="_saveReference"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>

  