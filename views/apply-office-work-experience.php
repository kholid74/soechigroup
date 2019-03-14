   <?php
   
    if (!isset($_SESSION['idCand'])) {
          
          echo "<script> window.location.assign('".$object->base_path()."job-type');</script>";
       }
   
    $job     = 'SELECT * FROM sch_job_office WHERE id="'.$_SESSION['idJob'].'"';
    $showJob = $object->fetch($job);

    $cand     = 'SELECT * FROM sch_candidate_office WHERE id="'.$_SESSION['idCand'].'"';
    $showCand = $object->fetch($cand);
    $idCand   = $showCand['id'];

    $work     = 'SELECT * FROM sch_cand_office_experience WHERE id_candidate="'.$idCand.'"';
    $showWork = $object->fetch($work); 

    if(isset($_POST['_saveJobExperience'])) {
        $namatable = 'sch_cand_office_experience';
        $data = array(
          'id_candidate'=> $idCand,
          'company_name' => $_POST['companyName'],
          'company_address' => $_POST['companyAddress'],
          'company_type' => $_POST['companyType'],
          'company_contact' => $_POST['companyContact'],
          'date_start' => $_POST['startYear'],
          'date_end' => $_POST['endYear'],
          'first_position' => $_POST['firstPosition'],
          'last_position' => $_POST['lastPosition'],
          'current_salary' => $_POST['lastSalary'],
          'move_reason' => $_POST['moveReason'],
          'total_employe' => $_POST['totalEmploye'],
          'job_desc' => $_POST['jobDesc']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."office-work-experience'); </script>";
    }

    if(isset($_POST['_updatework'])){ 

        $namatable = 'sch_cand_office_experience';
        $data = array(
          'company_name' => $_POST['companyName'],
          'company_address' => $_POST['companyAddress'],
          'company_type' => $_POST['companyType'],
          'company_contact' => $_POST['companyContact'],
          'date_start' => $_POST['startYear'],
          'date_end' => $_POST['endYear'],
          'first_position' => $_POST['firstPosition'],
          'last_position' => $_POST['lastPosition'],
          'current_salary' => $_POST['lastSalary'],
          'move_reason' => $_POST['moveReason'],
          'total_employe' => $_POST['totalEmploye'],
          'job_desc' => $_POST['jobDesc']
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."office-work-experience'); </script>";
        
    }

    if(isset($_POST['_forward'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."office-reference'); </script>";
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
          <h4 style="font-weight: bold;color: #000000;">STEP 6</h4>
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
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#workExperience"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Work Experience</button>    
                <p align="center" style="font-weight: bold;">PENGALAMAN BEKERJA (DIMULAI DENGAN PEKERJAAN TERAKHIR)</p>
                
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                  <tr style="font-weight: bold;">
                    <td style="font-size: 12px;">Nama Perusahaan</td>
                    <td style="font-size: 12px;">Alamat</td>
                    <td style="font-size: 12px;">Jenis Bidang Usaha</td>
                    <td style="font-size: 12px;">No telp</td>
                    <td style="font-size: 12px;">Lama Kerja</td>
                    <td style="font-size: 12px;">Jabatan Awal</td>
                    <td style="font-size: 12px;">Jabatan Akhir</td>
                    <td style="font-size: 12px;">Gaji Terakhir</td>
                    <td style="font-size: 12px;">Alasan Berhenti</td>
                    <td style="font-size: 12px;">Jumlah Karyawan</td>
                    <td style="font-size: 12px;">Tanggung Jawab Pekerjaan</td>
                    <td style="font-size: 12px;">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = 'SELECT * FROM sch_cand_office_experience WHERE id_candidate="'.$idCand.'"';
                  $exp = $object->fetch_all($sql);
                  if (count($exp) > 0) {
                    foreach ($exp as $workExp) {?>
                  <tr>               
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['company_name'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['company_address'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['company_type'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['company_contact'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['date_start'] ?> - <?= $workExp['date_end'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['first_position'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['last_position'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['current_salary'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['move_reason'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['total_employe'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $workExp['job_desc'] ?></td>
                    
                    <!-- MODAL -->
                    <div class="modal" id="editrexperience<?php echo $workExp['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">PENGALAMAN BEKERJA / WORK EXPERIENCE</h5>
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
                                    <label class="col-md-4 col-form-label" for="companyName">Nama Perusahaan / Company Name *</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="companyName" name="companyName" value="<?= $workExp['company_name'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label for="companyAddress" class="col-sm-4 col-form-label">Alamat / Company Address *</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="companyAddress" name="companyAddress" value="<?= $workExp['company_address'] ?>">
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="companyType" class="col-sm-4 col-form-label">Jenis Bidang Usaha / Type of Company</label>
                                    <div class="col-sm-8">
                                      <input type="text" class="form-control" id="companyType" name="companyType" value="<?= $workExp['company_type'] ?>">
                                    </div>
                                  </div>
                                  
                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="companyContact">No telp / Company Contact</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="companyContact" name="companyContact" value="<?= $workExp['company_contact'] ?>" required>
                                    </div>
                                   </div>

                                    <div class="row">
                                      <label class="col-md-4 col-form-label">Lama Kerja / Years of work</label>
                                      <div class="col-md-8 col-form-label">
                                        <div class="">
                                          <input type="date" class="form-control" id="startYear" name="startYear" value="<?= $workExp['date_start'] ?>" required>
                                        </div>
                                        <div class="">
                                          <input type="date" class="form-control" id="endYear" name="endYear" value="<?= $workExp['date_end'] ?>" required>
                                        </div>
                                      </div>
                                    </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="firstPosition">Jabatan Awal / First Position *</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="firstPosition" name="firstPosition" value="<?= $workExp['first_position'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="lastPosition">Jabatan Akhir / Last Position *</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="lastPosition" name="lastPosition" value="<?= $workExp['last_position'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="lastSalary">Gaji Terakhir / Current Salary *</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="lastSalary" name="lastSalary" value="<?= $workExp['current_salary'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="moveReason">Alasan Berhenti / Pindah *</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="moveReason" name="moveReason" value="<?= $workExp['move_reason'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="totalEmploye">Jumlah Karyawan / Total Employee</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="totalEmploye" name="totalEmploye" value="<?= $workExp['total_employe'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="jobDesc">Tanggung Jawab Pekerjaan / Job description*</label>
                                    <div class="col-md-8">
                                      <textarea name="jobDesc" class="form-control" id="jobDesc" cols="75" rows="3"><?= $workExp['job_desc'] ?></textarea>
                                    </div>
                                   </div>

                              </div>
                            </div>
                        </div>
                           
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id" value="<?= $workExp['id'] ?>">
                            <input type="submit" name="_updatework"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Update Experience" value="UPDATE" />
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>

                    <td style="font-size: 12px;font-weight: normal;">
                      <a style="cursor: pointer;" data-toggle="modal" data-target="#editrexperience<?php echo $workExp['id']?>" ><i class="fa fa-pencil"></i></a> |

                      <a class="danger" href="<?php echo $object->base_path()?>delete-experience/<?php echo $workExp['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o"></i></a>
                    </td>

                  </tr>
                  <?php }}else { ?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="11">No Data..</td>
                  </tr>
                  <?php } ?>
                <hr>
                </tbody>
              </table>

              </div>
              <!-- end personal data -->   

              <div style="padding: 30px;">
                  <div class="wizard-buttons">
                      <a href="<?php echo $halaman->base_path()?>office-general-information"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_forward" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>       
          </form>
        </div>

    </div>
  </div>


<!-- MODAL -->
      <div class="modal" id="workExperience" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">PENGALAMAN BEKERJA / WORK EXPERIENCE</h5>
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
                      <label class="col-md-4 col-form-label" for="companyName">Nama Perusahaan / Company Name *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="companyName" name="companyName"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label for="companyAddress" class="col-sm-4 col-form-label">Alamat / Company Address *</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="companyAddress" name="companyAddress">
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="companyType" class="col-sm-4 col-form-label">Jenis Bidang Usaha / Type of Company</label>
                      <div class="col-sm-8">
                        <input type="text" class="form-control" id="companyType" name="companyType">
                      </div>
                    </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="companyContact">No telp / Company Contact</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="companyContact" name="companyContact"required>
                      </div>
                     </div>

                      <div class="row">
                        <label class="col-md-4 col-form-label">Lama Kerja / Years of work</label>
                        <div class="col-md-8 col-form-label">
                          <div class="">
                            <input type="date" class="form-control" id="startYear" name="startYear"required>
                          </div>
                          <div class="">
                            <input type="date" class="form-control" id="endYear" name="endYear"required>
                          </div>
                        </div>
                      </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="firstPosition">Jabatan Awal / First Position *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="firstPosition" name="firstPosition"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="lastPosition">Jabatan Akhir / Last Position *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="lastPosition" name="lastPosition"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="lastSalary">Gaji Terakhir / Current Salary *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="lastSalary" name="lastSalary"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="moveReason">Alasan Berhenti / Pindah *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="moveReason" name="moveReason"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="totalEmploye">Jumlah Karyawan / Total Employee</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="totalEmploye" name="totalEmploye"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="jobDesc">Tanggung Jawab Pekerjaan / Job description*</label>
                      <div class="col-md-8">
                        <textarea name="jobDesc" class="form-control" id="jobDesc" cols="75" rows="3"></textarea>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveJobExperience"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>

