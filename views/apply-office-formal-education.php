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

    $education = 'SELECT * FROM sch_cand_office_education WHERE id_candidate="'.$idCand.'"';
    $showEdu   = $object->fetch($education); 

    if(isset($_POST['_save'])) {
        $namatable = 'sch_cand_office_education';
        $data = array(
          'id_candidate'=> $idCand,
          'graduated' => $_POST['level'],
          'institution_name' => $_POST['institutionName'],
          'faculty' => $_POST['faculty'],
          'major' => $_POST['major'],
          'province' => $_POST['province'],
          'city' => $_POST['city'],
          'year_entry' => $_POST['yearIN'],
          'year_graduate' => $_POST['yearOUT'],
          'gpa' => $_POST['gpa']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."office-formal-education'); </script>";
    }

    if(isset($_POST['_updateformal'])){ 

        $namatable = 'sch_cand_office_education';
        $data = array(
            'institution_name' => $_POST['institutionName'],
            'faculty' => $_POST['faculty'],
            'major' => $_POST['major'],
            'province' => $_POST['province'],
            'city' => $_POST['city'],
            'year_entry' => $_POST['yearIN'],
            'year_graduate' => $_POST['yearOUT'],
            'gpa' => $_POST['gpa']
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."office-formal-education'); </script>";
        
    }

    if(isset($_POST['_saveCourse'])) {
        $namatable = 'sch_cand_office_course';
        $data = array(
          'id_candidate'=> $idCand,
          'course_name' => $_POST['courseName'],
          'held_by' => $_POST['heldBy'],
          'start_date' => $_POST['startDate'],
          'finish_date' => $_POST['finishDate']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."office-formal-education'); </script>";
    }

    if(isset($_POST['_editCourse'])){ 

        $namatable = 'sch_cand_office_course';
        $data = array(
            'course_name' => $_POST['courseName'],
            'held_by' => $_POST['heldBy'],
            'start_date' => $_POST['startDate'],
            'finish_date' => $_POST['finishDate']
        );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions);
        echo "<script> window.location.assign('".$object->base_path()."office-formal-education'); </script>";
        
    }

    if(isset($_POST['_forward'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."office-family-member'); </script>";
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
          <h4 style="font-weight: bold;color: #000000;">STEP 3</h4>
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
                 
              </div>

              <!-- start personal data -->
              <div style="padding: 30px;">
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addSchool"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Formal Education</button>    
                <p align="center" style="font-weight: bold;">PENDIDIKAN FORMAL / FORMAL EDUCATION</p>
                
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                  <tr style="font-weight: bold;">
                    <td style="font-size: 12px;">Level</td>
                    <td style="font-size: 12px;">Nama Institusi</td>
                    <td style="font-size: 12px;">Fakultas</td>
                    <td style="font-size: 12px;">Jurusan</td>
                    <td style="font-size: 12px;">Provinsi</td>
                    <td style="font-size: 12px;">Kota / Kabupaten</td>
                    <td style="font-size: 12px;">Tahun Masuk</td>
                    <td style="font-size: 12px;">Tahun Lulus</td>
                    <td style="font-size: 12px;">Nilai Akhir</td>
                    <td style="font-size: 12px;">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                    
                    $sql = 'SELECT * FROM sch_cand_office_education WHERE id_candidate="'.$idCand.'"';
                    $exp = $object->fetch_all($sql);
                    if (count($exp) > 0) {
                      foreach ($exp as $sd) {

                        $prov     = "SELECT * FROM sch_provinsi WHERE id_prov='".$sd['province']."'";
                        $showProv = $object->fetch($prov);

                        $kab      = "SELECT * FROM sch_kabupaten WHERE id_kab='".$sd['city']."'";
                        $showKab  = $object->fetch($kab);
                  ?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['graduated'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['institution_name'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['faculty'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['major'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $showProv['nama_provinsi'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $showKab['nama_kabupaten'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['year_entry'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['year_graduate'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $sd['gpa'] ?></td>

                    <!-- MODAL -->
                    <div class="modal" id="editschool<?php echo $sd['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">PENDIDIKAN FORMAL / FORMAL EDUCATION</h5>
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
                                    <label class="col-md-4 col-form-label" for="institutionName">Level</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" value="<?= $sd['graduated'] ?>" disabled>
                                    </div>
                                   </div>

                                  <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="institutionName">Nama Institusi / Institution Name *</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="institutionName" name="institutionName" value="<?= $sd['institution_name'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row" id="faculty">
                                  <label class="col-md-4 col-form-label" id="faculty" for="faculty">Faculty / Fakultas</label>
                                  <div class="col-md-8">
                                    <input type="text" class="form-control" id="faculty" name="faculty" value="<?= $sd['faculty'] ?>" placeholder="Only for University">
                                  </div>
                                 </div>

                                 <div class="form-group row" id="major">
                                  <label class="col-md-4 col-form-label" for="major">Jurusan / Major</label>
                                  <div class="col-md-8">
                                    <input type="text" class="form-control" id="major" name="major" value="<?= $sd['major'] ?>" required>
                                  </div>
                                 </div>

                                   <div class="form-group row">
                                    <label for="province" class="col-sm-4 col-form-label">Provinsi / Province *</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" id="province" name="province" required>
                                        <option selected>-- Please Select Below --</option>
                                        <?php $sql2 = "SELECT * FROM sch_provinsi ORDER BY nama_provinsi ASC";
                                              $prov = $object->fetch_all($sql2);
                                                foreach ($prov as $showProv) {?>
                                        <option value="<?= $showProv['id_prov'] ?>" <?php if($sd['province'] == $showProv['id_prov']){echo "selected";} ?>><?= $showProv['nama_provinsi'] ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>

                                  <div class="form-group row">
                                    <label for="city" class="col-sm-4 col-form-label">Kota / Kabupaten / City *</label>
                                    <div class="col-sm-8">
                                      <select class="form-control" id="city" name="city">
                                        <option selected disabled>------Please Select Below------</option>
                                        <?php $sql3 = "SELECT * FROM sch_kabupaten INNER JOIN sch_provinsi ON sch_kabupaten.id_prov = sch_provinsi.id_prov ORDER BY nama_kabupaten ASC";
                                              $city = $object->fetch_all($sql3);
                                                foreach ($city as $showCity) {?>
                                        <option id="city" class="<?= $showCity['id_prov'] ?>" value="<?= $showCity['id_kab'] ?>" <?php if($sd['city'] == $showCity['id_kab']){echo "selected";} ?>><?= $showCity['nama_kabupaten'] ?></option>
                                        <?php } ?>
                                      </select>
                                    </div>
                                  </div>
                                  
                                  <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="yearIN">Tahun Masuk / Year of entry</label>
                                    <div class="col-md-8">
                                      <select name='yearIN' class='form-control' required>
                                      <?php

                                        $now=date('Y');
                                        for ($a=1985;$a<=$now;$a++)
                                          { ?>
                                             <option value='<?php echo $a; ?>' <?php if($sd['year_entry'] == $a){echo "selected";} ?>><?php echo $a; ?></option>
                                        <?php } ?>
                                       
                                      </select>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="yearOUT">Tahun Lulus / Graduation year</label>
                                    <div class="col-md-8">
                                      <select name='yearOUT' class='form-control' required>
                                      <?php

                                        $now=date('Y');
                                        for ($a=1985;$a<=$now;$a++)
                                          { ?>
                                             <option value='<?php echo $a; ?>' <?php if($sd['year_graduate'] == $a){echo "selected";} ?>><?php echo $a; ?></option>
                                        <?php } ?>
                                       
                                      </select>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="gpa">Nilai Akhir / Final score</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="gpa" name="gpa" value="<?= $sd['gpa'] ?>" required>
                                    </div>
                                   </div>

                              </div>
                            </div>
                        </div>
                           
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id" value="<?= $sd['id']; ?>">
                            <input type="submit" name="_updateformal"  class="btn btn-flat btn-primary" title="Add SMP" value="UPDATE" />
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>

                      <td style="font-size: 12px;font-weight: normal;" align="center">

                        <a style="cursor: pointer;" data-toggle="modal" data-target="#editschool<?php echo $sd['id']?>" ><i class="fa fa-pencil"></i></a> |

                        <a class="danger" href="<?php echo $object->base_path()?>delete-education/<?php echo $sd['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o"></i></a>
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
              
              <br>
            
              <p align="center" style="font-weight: bold;">COURSE / KURSUS</p>
               <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#course"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Course</button>    
                <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                  <tr style="font-weight: bold;">
                    <td style="font-size: 12px;">Nama Kursus</td>
                    <td style="font-size: 12px;">Nama penyelenggara</td>
                    <td style="font-size: 12px;">Tanggal mulai</td>
                    <td style="font-size: 12px;">Tanggal Selesai</td>
                    <td style="font-size: 12px;">Action</td>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = 'SELECT * FROM sch_cand_office_course WHERE id_candidate="'.$idCand.'"';
                  $exp = $object->fetch_all($sql);
                  if (count($exp) > 0) {
                    foreach ($exp as $course) {?>
                  <tr>
                    <td style="font-size: 12px;font-weight: normal;"><?= $course['course_name'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $course['held_by'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $course['start_date'] ?></td>
                    <td style="font-size: 12px;font-weight: normal;"><?= $course['finish_date'] ?></td>

                        <!-- MODAL -->
                    <div class="modal" id="editcourse<?php echo $course['id']?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                      <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLongTitle">COURSE / KURSUS</h5>
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
                                    <label class="col-md-4 col-form-label" for="courseName">Nama Kursus / course name</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="courseName" name="courseName" value="<?= $course['course_name'] ?>" required>
                                    </div>
                                   </div>
                                   
                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="heldBy">Nama penyelenggara / held by</label>
                                    <div class="col-md-8">
                                      <input type="text" class="form-control" id="heldBy" value="<?= $course['held_by'] ?>" name="heldBy" >
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="startDate">Tanggal mulai / start date</label>
                                    <div class="col-md-8">
                                      <input type="date" class="form-control" id="startDate" name="startDate" value="<?= $course['start_date'] ?>" required>
                                    </div>
                                   </div>

                                   <div class="form-group row">
                                    <label class="col-md-4 col-form-label" for="finishDate">Tanggal selesai / Finish date</label>
                                    <div class="col-md-8">
                                      <input type="date" class="form-control" id="finishDate" name="finishDate" value="<?= $course['finish_date'] ?>" required>
                                    </div>
                                   </div>

                              </div>
                            </div>
                        </div>
                           
                          </div>
                          <div class="modal-footer">
                            <input type="hidden" name="id" value="<?= $course['id'] ?>">
                            <input type="submit" name="_editCourse"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add Course" value="SAVE" />
                            </form>
                          </div>
                        </div>
                      </div>
                  </div>

                    <td style="font-size: 12px;font-weight: normal;" align="center">

                      <a style="cursor: pointer;" data-toggle="modal" data-target="#editcourse<?php echo $course['id']?>" ><i class="fa fa-pencil"></i></a> |

                      <a class="danger" href="<?php echo $object->base_path()?>delete-course/<?php echo $course['id']?>" onclick="return confirm('Confirm delete ?')" ><i class="fa fa-trash-o"></i></a>
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
                      <a href="<?php echo $halaman->base_path()?>office-address"><button type="button" class="btn btn-previous">BACK</button></a>
                      <input type="submit" class="btn btn-primary" name="_forward" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;NEXT&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
                  </div>
              </div>       
          </form>
        </div>

    </div>
  </div>


<!-- MODAL -->
      <div class="modal" id="addSchool" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">PENDIDIKAN FORMAL / FORMAL EDUCATION</h5>
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
                      <label class="col-md-4 col-form-label" for="level">Tingkat / Level *</label>
                      <div class="col-md-8">
                        <select name="level" class="form-control">
                          <option selected>-- Please Select Below --</option>
                          <option value="SD">SD</option>
                          <option value="SMP">SMP</option>
                          <option value="SMA">SMA</option>
                          <option value="D3">D3</option>
                          <option value="S1">S1</option>
                          <option value="S2">S2</option>
                          <option value="S3">S3</option>
                        </select>
                      </div>
                     </div>

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="institutionName">Nama Institusi / Institution Name *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="institutionName" name="institutionName"required>
                      </div>
                     </div>
                     
                     <div class="form-group row" id="faculty">
                      <label class="col-md-4 col-form-label" id="faculty" for="faculty">Faculty / Fakultas</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="faculty" name="faculty" placeholder="Only for University">
                      </div>
                     </div>

                     <div class="form-group row" id="major">
                      <label class="col-md-4 col-form-label" for="major">Jurusan / Major</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="major" name="major"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label for="province" class="col-sm-4 col-form-label">Provinsi / Province *</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="province" name="province" required>
                          <option selected>-- Please Select Below --</option>
                          <?php $sql2 = "SELECT * FROM sch_provinsi ORDER BY nama_provinsi ASC";
                                $prov = $object->fetch_all($sql2);
                                  foreach ($prov as $showProv) {?>
                          <option value="<?= $showProv['id_prov'] ?>"><?= $showProv['nama_provinsi'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>

                    <div class="form-group row">
                      <label for="city" class="col-sm-4 col-form-label">Kota / Kabupaten / City *</label>
                      <div class="col-sm-8">
                        <select class="form-control" id="city" name="city">
                          <option selected disabled>------Please Select Below------</option>
                          <?php $sql3 = "SELECT * FROM sch_kabupaten INNER JOIN sch_provinsi ON sch_kabupaten.id_prov = sch_provinsi.id_prov ORDER BY nama_kabupaten ASC";
                                $city = $object->fetch_all($sql3);
                                  foreach ($city as $showCity) {?>
                          <option id="city" class="<?= $showCity['id_prov'] ?>" value="<?= $showCity['id_kab'] ?>"><?= $showCity['nama_kabupaten'] ?></option>
                          <?php } ?>
                        </select>
                      </div>
                    </div>
                    
                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="yearIN">Tahun Masuk / Year of entry</label>
                      <div class="col-md-8">
                        <?php

                          $now=date('Y');
                          echo "<select name='yearIN' class='form-control' required>";
                          for ($a=1985;$a<=$now;$a++)
                          {
                               echo "<option value='$a'>$a</option>";
                          }
                          echo "</select>";

                        ?>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="yearOUT">Tahun Lulus / Graduation year</label>
                      <div class="col-md-8">
                        <?php
                          $now=date('Y');
                          echo "<select name='yearOUT' class='form-control' required>";
                          for ($a=1985;$a<=$now;$a++)
                          {
                               echo "<option value='$a'>$a</option>";
                          }
                          echo "</select>";
                        ?>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="gpa">Nilai Akhir / Final score</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="gpa" name="gpa"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_save"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>

    <!-- MODAL -->
      <div class="modal" id="course" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">COURSE / KURSUS</h5>
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
                      <label class="col-md-4 col-form-label" for="courseName">Nama Kursus / course name</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="courseName" name="courseName"required>
                      </div>
                     </div>
                     
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="heldBy">Nama penyelenggara / held by</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="heldBy" name="heldBy" >
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="startDate">Tanggal mulai / start date</label>
                      <div class="col-md-8">
                        <input type="date" class="form-control" id="startDate" name="startDate"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="finishDate">Tanggal selesai / Finish date</label>
                      <div class="col-md-8">
                        <input type="date" class="form-control" id="finishDate" name="finishDate"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveCourse"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add Course" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>