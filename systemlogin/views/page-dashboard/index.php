<?php 

if($authadmin['user_type'] == 'shipping'){

  /*Number of Crew Applied Pending Review*/
  $sql1   = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='PENDING_REVIEW'";
  $show1  = $object->fetch_all($sql1);
  $count1 = count($show1); 

  /*Number of Shortlisted for Interview*/
  $sql2   = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='SHORTLISTED'";
  $show2  = $object->fetch_all($sql2);
  $count2 = count($show2);

  /*Reject Review*/
  $sql3   = "SELECT a.*,b.status FROM sch_candidate_shipping a JOIN sch_cand_shipping_status b ON a.candidate_code=b.candidate_code WHERE b.status='REJECT_MANAGER_DECISION' OR b.status='REJECTED'";
  $show3  = $object->fetch_all($sql3);
  $count3 = count($show3);

  /*Interview Schedule Approve and Online Test*/
  $test   = "SELECT a.*, b.first_name,b.last_name,b.email,b.candidate_code, c.id_job_name, d.status FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate=b.id JOIN sch_job_shipping c ON b.id_job=c.id JOIN sch_cand_shipping_status d ON b.candidate_code=d.candidate_code WHERE a.category='shipping' AND d.status='SHORTLISTED'";
  $showtest  = $object->fetch_all($test);
  $countest = count($showtest); 

  /*INTERVIEW PASSED*/
  $sql4   = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='INTERVIEW_PASS'";
  $show4  = $object->fetch_all($sql4);
  $count4 = count($show4);

  /*INTERVIEW FAILED*/
  $sql5   = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='INTERVIEW_FAIL'";
  $show5  = $object->fetch_all($sql5);
  $count5 = count($show5);

  /*REFUSE JOINED*/
  $sql6   = "SELECT a.*,b.status FROM sch_candidate_shipping a JOIN sch_cand_shipping_status b ON a.candidate_code=b.candidate_code WHERE b.status='REFUSE_JOINED'";
  $show6  = $object->fetch_all($sql6);
  $count6 = count($show5);

  /*JOINED*/
  $sql7   = "SELECT a.*,b.status FROM sch_candidate_shipping a JOIN sch_cand_shipping_status b ON a.candidate_code=b.candidate_code WHERE b.status='JOINED'";
  $show7  = $object->fetch_all($sql7);
  $count7 = count($show7);

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <span>You logged as <b><?php echo $object->logged_as($level); ?></b></span>
          </div>
        </li>
      </ol>

      <?php if($authadmin['level'] == '1' OR $authadmin['level'] == '2' OR $authadmin['level'] == '3'){  ?>

      <div class="container-fluid">

        <div class="animated fadeIn">
          <div class="row">

            <div class="col-sm-6 col-lg-3">
              <a href="<?php echo $object->base_path()?>shipping-candidate-pending" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count1; ?></h4>
                  <br>
                  <p>Number of Crew Applied Pending Review</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <a href="<?php echo $object->base_path()?>shipping-candidate-shortlisted" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count2; ?></h4>
                  <br>
                  <p>Number of Shortlisted for Interview</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
             <a href="<?php echo $object->base_path()?>shipping-candidate-rejected" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count3; ?></h4>
                  <br>
                  <p>Number of Crew Decline Due to Non Suitable</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0">0</h4>
                  <br>
                  <p>Number of Decline/Rejected non Cert. Compliance</p>
                </div>
               
              </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
             <a href="<?php echo $object->base_path()?>shipping-candidate-interview-passed" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count4; ?></h4>
                  <br>
                  <p>Number of Interview Passed</p>
                </div>  
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <a href="<?php echo $object->base_path()?>shipping-candidate-interview-failed" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count5; ?></h4>
                  <br>
                  <p>Number of Interview Failed</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count6; ?></h4>
                  <br>
                  <p>Number Of Crew Refuse to Join after Process</p>
                </div>
               
              </div>
            </div>
            <!--/.col-->

            
            <div class="col-sm-6 col-lg-3">
              <a href="<?php echo $object->base_path()?>" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count7; ?></h4>
                  <br>
                  <p>Number of Finally Joined Company</p>
                </div>
               
              </div>
              </a>
            </div>
            
            <!--/.col-->            
          </div>
          <!--/.row-->

          <hr>

          <div class="row">
            <div class="col-md-12">
              <form method="post">
                    <div class="form-inline">
                        <div class="form-group">
                          <label>Filter by :&nbsp;</label>
                            <select class="form-control" name="_statusCand" style="border-radius: 0px;">
                              <option selected disabled>Candidate Status</option>
                              <option value="PENDING_REVIEW">Pending Review</option>
                              <option value="SHORTLISTED">Shortlisted</option>
                              <option value="REJECT_MANAGER_DECISION">Reject Manager Decision</option>
                              <option value="REJECTED">Rejected</option>
                              <option value="INTERVIEW_PASS">Interview Pass</option>
                              <option value="INTERVIEW_FAIL">Interview Fail</option>
                              <option value="REFUSE_JOINED">Refuse Joined</option>
                              <option value="JOINED">Joined</option>
                              
                            </select>
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <input type="submit" name="_filterCand" class="btn btn-primary" value="Filter">
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <a href="" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;RESET FILTER</a>
                        </div>

                    </div>
                </form>
                <br><br>
               
              <table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
                <thead>
                  <tr>
                    <td style="font-weight: bold;text-align: center;">No</td>
                    <td style="font-weight: bold;text-align: center;">Name</td>
                    <td style="font-weight: bold;text-align: center;">Job Vacancy</td>
                    <td style="font-weight: bold;text-align: center;">Email</td>
                    <td style="font-weight: bold;text-align: center;">Status</td>
                    <td style="font-weight: bold;text-align: center;">Apply Date</td>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    if(isset($_POST['_filterCand'])){

                      $statusCand  = $_POST['_statusCand'];
                      $sql = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='$statusCand'";
                      
                      $fetchAll = $object->fetch_all($sql);
                      $rows = count($fetchAll);
                      
                      echo '<p><b>'.$rows.'</b> result of <b>'.$_POST['_statusCand'].'</b></p>';
                    
                    
                      //$sql = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code ";

                    $candidate = $object->fetch_all($sql);
                    if (count($candidate) > 0) {
                      $number = 1;
                      foreach ($candidate as $cand) {?>
                  <tr>
                    <td><?php echo $number;?></td>
                    <td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
                    <td><?= $cand['name'] ?></td>
                    <td><?= $cand['email'] ?></td>
                    <td align="center">
                      <span class='badge badge-warning'><?= $cand['status'] ?></span>
                    </td>
                    <td><?= $cand['created'] ?></td>
                    
                  </tr>
                  <?php
                    $number++;
                   } }}else{?>
                    <tr>
                      <td colspan="6" align="center">No data..</td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            
            </div>
          </div>
          
        <br><br><br>
         
        </div>

      </div>

      <?php }elseif($authadmin['level'] == '4'){  ?> <!-- login sebagai staff -->

          <div class="container-fluid">

            <div class="animated fadeIn">
              <div class="row">

                  <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                      <div class="card-body pb-0" style="height: 124px;">
                        <h4 class="mb-0"><?php echo $count1; ?></h4>
                        <br>
                        <p>Number of Crew Applied Pending Review</p>
                      </div>
                    </div>
                  </div>
                  <!--/.col-->

                  <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                      <div class="card-body pb-0" style="height: 124px;">
                        <h4 class="mb-0"><?php echo $count2; ?></h4>
                        <br>
                        <p>Number of Shortlisted for Interview</p>
                      </div>
                    </div>
                  </div>
                  <!--/.col-->

                  <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                      <div class="card-body pb-0" style="height: 124px;">
                        <h4 class="mb-0"><?php echo $count3; ?></h4>
                        <br>
                        <p>Number of Crew Decline Due to Non Suitable</p>
                      </div>
                    </div>
                  </div>
                  <!--/.col-->

                  <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                      <div class="card-body pb-0" style="height: 124px;">
                        <h4 class="mb-0">0</h4>
                        <br>
                        <p>Number of Decline/Rejected non Cert. Compliance</p>
                      </div>
                     
                    </div>
                  </div>
                  <!--/.col-->

                  <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                      <div class="card-body pb-0" style="height: 124px;">
                        <h4 class="mb-0"><?php echo $count4; ?></h4>
                        <br>
                        <p>Number of Interview Passed</p>
                      </div>  
                    </div>
                  </div>
                  <!--/.col-->

                  <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                      <div class="card-body pb-0" style="height: 124px;">
                        <h4 class="mb-0"><?php echo $count5; ?></h4>
                        <br>
                        <p>Number of Interview Failed</p>
                      </div>
                    </div>
                  </div>
                  <!--/.col-->

                  <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                      <div class="card-body pb-0" style="height: 124px;">
                        <h4 class="mb-0"><?php echo $count6; ?></h4>
                        <br>
                        <p>Number Of Crew Refuse to Join after Process</p>
                      </div>
                     
                    </div>
                  </div>
                  <!--/.col-->

                  
                  <div class="col-sm-6 col-lg-3">
                    <div class="card text-white bg-primary">
                      <div class="card-body pb-0" style="height: 124px;">
                        <h4 class="mb-0"><?php echo $count7; ?></h4>
                        <br>
                        <p>Number of Finally Joined Company</p>
                      </div>
                    </div>
                  </div>

              </div>
              <hr>

          <div class="row">
            <div class="col-md-12">
              <form method="post">
                    <div class="form-inline">
                        <div class="form-group">
                          <label>Filter by :&nbsp;</label>
                            <select class="form-control" name="_statusCand" style="border-radius: 0px;">
                              <option selected disabled>Candidate Status</option>
                              <option value="PENDING_REVIEW">Pending Review</option>
                              <option value="SHORTLISTED">Shortlisted</option>
                              <option value="REJECT_MANAGER_DECISION">Reject Manager Decision</option>
                              <option value="REJECTED">Rejected</option>
                              <option value="INTERVIEW_PASS">Interview Pass</option>
                              <option value="INTERVIEW_FAIL">Interview Fail</option>
                              <option value="REFUSE_JOINED">Refuse Joined</option>
                              <option value="JOINED">Joined</option>
                              
                            </select>
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <input type="submit" name="_filterCand" class="btn btn-primary" value="Filter">
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <a href="" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;RESET FILTER</a>
                        </div>

                    </div>
                </form>
                <br><br>
               
              <table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
                <thead>
                  <tr>
                    <td style="font-weight: bold;text-align: center;">No</td>
                    <td style="font-weight: bold;text-align: center;">Name</td>
                    <td style="font-weight: bold;text-align: center;">Job Vacancy</td>
                    <td style="font-weight: bold;text-align: center;">Email</td>
                    <td style="font-weight: bold;text-align: center;">Status</td>
                    <td style="font-weight: bold;text-align: center;">Apply Date</td>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    if(isset($_POST['_filterCand'])){

                      $statusCand  = $_POST['_statusCand'];
                      $sql = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code WHERE d.status='$statusCand'";
                      
                      $fetchAll = $object->fetch_all($sql);
                      $rows = count($fetchAll);
                      
                      echo '<p><b>'.$rows.'</b> result of <b>'.$_POST['_statusCand'].'</b></p>';
                    
                    
                      //$sql = "SELECT a.*,b.id_job_name,c.name,d.status FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id JOIN sch_cand_shipping_status d ON a.candidate_code=d.candidate_code ";

                    $candidate = $object->fetch_all($sql);
                    if (count($candidate) > 0) {
                      $number = 1;
                      foreach ($candidate as $cand) {?>
                  <tr>
                    <td><?php echo $number;?></td>
                    <td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
                    <td><?= $cand['name'] ?></td>
                    <td><?= $cand['email'] ?></td>
                    <td align="center">
                      <span class='badge badge-warning'><?= $cand['status'] ?></span>
                    </td>
                    <td><?= $cand['created'] ?></td>
                    
                  </tr>
                  <?php
                    $number++;
                   } }}else{?>
                    <tr>
                      <td colspan="6" align="center">No data..</td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            
            </div>
          </div>
            </div>
          </div>

      <?php }elseif($authadmin['level'] == '5'){  ?> <!-- login sebagai receptionist/security -->
        <br>
        <h4 style="text-align: center">INTERVIEW SCHEDULE</h4>
        <br>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="true"><b>SHIPPING CANDIDATE</b></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="office-tab" data-toggle="tab" href="#office" role="tab" aria-controls="office" aria-selected="false"><b>OFFICE CANDIDATE</b></a>
          </li>
          
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">

              <table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
                <thead>
                  <tr>
                    <td style="font-weight: bold;text-align: center;">No</td>
                    <td style="font-weight: bold;text-align: center;">Candidate Name</td>
                    <td style="font-weight: bold;text-align: center;">Position</td>
                                    <td style="font-weight: bold;text-align: center;">Date / Time</td>
                                    <td style="font-weight: bold;text-align: center;">PIC</td>
                    <td style="font-weight: bold;text-align: center;">Barcode</td>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    $sql = "SELECT a.*, b.first_name,b.last_name,b.email,b.candidate_code, c.id_job_name FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate=b.id JOIN sch_job_shipping c ON b.id_job=c.id WHERE a.category='shipping' AND a.status='1'"; 
                    
                    $candidate = $object->fetch_all($sql);
                    if (count($candidate) > 0) {
                      $number = 1;
                      foreach ($candidate as $cand) {

                    $job = "SELECT name FROM sch_master_crewrank WHERE id='".$cand['id_job_name']."'";
                    $jobName = $object->fetch($job);

                    ?>
                  <tr>
                    <td><?php echo $number;?></td>
                    <td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
                    <td><?= $jobName['name'] ?></td>
                                    <td align="center"><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></td>
                                    <td><?= $cand['pic_name'] ?></td>
                    <td>
                    
                    <!-- Modal -->
                      <div class="modal" id="view<?= $cand['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                             <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLongTitle">Detail Interview :</h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                             </div>
                             <div class="modal-body">
                               <form role="form" method="POST" enctype="multipart/form-data">
                               <div class="container-fluid">
                               <div class="row">
                                  <div class="col-md-4">
                                      Name
                                  </div>
                                  <div class="col-md-8">
                                      : <b><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></b>
                                  </div>
                                  <div class="col-md-4">
                                      Position
                                  </div>
                                  <div class="col-md-8">
                                      : <b><?= $jobName['name'] ?></b>
                                  </div>
                                  <div class="col-md-4">
                                      Date / Time
                                  </div>
                                  <div class="col-md-8">
                                      : <b><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></b>
                                  </div>
                                  <div class="col-md-4">
                                      PIC
                                  </div>
                                  <div class="col-md-8">
                                      : <b><?= $cand['pic_name'] ?></b>
                                  </div>
                               </div>

                                  <div class="col-md-12" align="center">
                                      <img src="<?php echo BASE_URL; ?>media/images/qrcode_generate/<?= $cand['img_qrcode'] ?>" alt="">
                                  </div>
                             
                              </div>
                              
                             </div>
                             <div class="modal-footer">
                               
                             </div>
                           </div>
                         </div>
                           </div>
                           <!-- end Modal -->

                      <center>
                        <span class="btn btn-flat btn-success btn-sm" data-toggle="modal" title="View Detail Candidate" data-target="#view<?= $cand['id'] ?>"><i class="fa fa-eye"></i></span>
                      </center> 

                    </td>


                  </tr>
                  
                  <?php
                    $number++;
                    }}?>
                </tbody>
              </table>

          </div>
          <div class="tab-pane fade show active" id="office" role="tabpanel" aria-labelledby="office-tab">
              
              <table class="table table-responsive-sm table-bordered table-striped table-sm" id="example1">
            <thead>
              <tr>
                <td style="font-weight: bold;text-align: center;">No</td>
                <td style="font-weight: bold;text-align: center;">Candidate Name</td>
                <td style="font-weight: bold;text-align: center;">Position</td>
                <td style="font-weight: bold;text-align: center;">Date / Time</td>
                <td style="font-weight: bold;text-align: center;">PIC</td>
                <td style="font-weight: bold;text-align: center;">Barcode</td>
              </tr>
            </thead>
            <tbody>
              <?php 
                  $sql = "SELECT a.*,b.full_name,b.email,b.candidate_code,c.job_title FROM sch_interview_schedule a JOIN sch_candidate_office b ON a.id_candidate = b.id JOIN sch_job_office c ON b.id_job=c.id WHERE a.category='office' AND a.status='1'";
                $candidate = $object->fetch_all($sql);
                if (count($candidate) > 0) {
                  $number = 1;
                  foreach ($candidate as $cand) {?>
              <tr>
                <td><?php echo $number;?></td>
                <td><?= $cand['full_name'] ?></td>
                <td><?= $cand['job_title'] ?></td>
                <td><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></td>
                <td><?= $cand['pic_name'] ?></td>
                <td>

                <!-- Modal -->
                  <div class="modal" id="view<?= $cand['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLongTitle">Detail Interview :</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                         <div class="modal-body">
                           <form role="form" method="POST" enctype="multipart/form-data">
                           <div class="container-fluid">
                           <div class="row">
                              <div class="col-md-4">
                                  Name
                              </div>
                              <div class="col-md-8">
                                  : <b><?= $cand['full_name'] ?></b>
                              </div>
                              <div class="col-md-4">
                                  Position
                              </div>
                              <div class="col-md-8">
                                  : <b><?= $cand['job_title'] ?></b>
                              </div>
                              <div class="col-md-4">
                                  Date / Time
                              </div>
                              <div class="col-md-8">
                                  : <b><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></b>
                              </div>
                              <div class="col-md-4">
                                  PIC
                              </div>
                              <div class="col-md-8">
                                  : <b><?= $cand['pic_name'] ?></b>
                              </div>
                           </div>

                              <div class="col-md-12" align="center">
                                  <img src="<?php echo BASE_URL; ?>media/images/qrcode_generate/<?= $cand['img_qrcode'] ?>" alt="">
                              </div>
                         
                          </div>
                          
                         </div>
                         <div class="modal-footer">
                           
                         </div>
                       </div>
                     </div>
                       </div>
                       <!-- end Modal -->

                  <center>
                    <span class="btn btn-flat btn-success btn-sm" data-toggle="modal" title="View Detail Candidate" data-target="#view<?= $cand['id'] ?>"><i class="fa fa-eye"></i></span>
                  </center> 

                </td>

              </tr>
              
              <?php
                $number++;
                }}?>
            </tbody>
          </table>

          </div>
        </div>
        

      <?php } ?>


      <!-- /.conainer-fluid -->
    </main>

    <?php }elseif($authadmin['user_type'] == 'office'){ 


  /*Number of Pending Review*/
  $sql1   = "SELECT * FROM sch_candidate_office WHERE candidate_code!='' AND (status='0' OR status='3')";
  $show1  = $object->fetch_all($sql1);
  $count1 = count($show1);

  /*Number of Shortlisted for Interview*/
  $sql2   = "SELECT * FROM sch_candidate_office WHERE status='1'";
  $show2  = $object->fetch_all($sql2);
  $count2 = count($show2);

  /*Reject Review*/
  $sql3   = "SELECT * FROM sch_candidate_office WHERE status='2'";
  $show3  = $object->fetch_all($sql3);
  $count3 = count($show3);

  /*INTERVIEW PASSED*/
  $sql4   = "SELECT * FROM sch_candidate_office WHERE status='4'";
  $show4  = $object->fetch_all($sql4);
  $count4 = count($show4);

  /*INTERVIEW FAILED*/
  $sql5   = "SELECT * FROM sch_candidate_office WHERE status='5'";
  $show5  = $object->fetch_all($sql5);
  $count5 = count($show5);


      ?>

      <!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <span>You logged as <b><?php echo $object->logged_as($level); ?></b></span>
          </div>
        </li>
      </ol>

      <?php if($authadmin['level'] == '1' OR $authadmin['level'] == '2' OR $authadmin['level'] == '3'){  ?>

      <div class="container-fluid">

        <div class="animated fadeIn">
          <div class="row">

            <div class="col-sm-6 col-lg-3">
              <a href="<?php echo $object->base_path()?>office-candidate-pending" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count1; ?></h4>
                  <br>
                  <p>Number of Pending Review</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <a href="<?php echo $object->base_path()?>office-candidate-shortlisted" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count2; ?></h4>
                  <br>
                  <p>Number of Shortlisted for Interview</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
             <a href="<?php echo $object->base_path()?>office-candidate-interview-passed" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count4; ?></h4>
                  <br>
                  <p>Number of Interview Passed</p>
                </div>  
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <a href="<?php echo $object->base_path()?>office-candidate-interview-failed" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count5; ?></h4>
                  <br>
                  <p>Number of Interview Failed</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->
           
            <!--/.col-->            
          </div>
          <!--/.row-->

          <hr>

          <div class="row">
            <div class="col-md-12">
              <form method="post">
                    <div class="form-inline">
                        <div class="form-group">
                          <label>Filter by :&nbsp;</label>
                            <select class="form-control" name="_statusCand" style="border-radius: 0px;">
                              <option selected disabled>Candidate Status</option>
                              <option value="0">Pending Review</option>
                              <option value="1">Shortlisted</option>
                              <option value="2">Rejected</option>
                              <option value="4">Interview Pass</option>
                              <option value="5">Interview Fail</option>
                              
                            </select>
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <input type="submit" name="_filterCand" class="btn btn-primary" value="Filter">
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <a href="" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;RESET FILTER</a>
                        </div>

                    </div>
                </form>
                <br><br>
               
              <table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
                <thead>
                  <tr>
                    <td style="font-weight: bold;text-align: center;">No</td>
                    <td style="font-weight: bold;text-align: center;">Name</td>
                    <td style="font-weight: bold;text-align: center;">Job Vacancy</td>
                    <td style="font-weight: bold;text-align: center;">Email</td>
                    <td style="font-weight: bold;text-align: center;">Status</td>
                    <td style="font-weight: bold;text-align: center;">Apply Date</td>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    if(isset($_POST['_filterCand'])){

                      $statusCand  = $_POST['_statusCand'];

                      $sql = "SELECT a.*,b.job_title FROM sch_candidate_office a JOIN sch_job_office b ON a.id_job = b.id WHERE a.status='$statusCand' AND a.candidate_code!=''";
                      
                      $fetchAll = $object->fetch_all($sql);
                      $rows = count($fetchAll);
                      
                      echo '<p><b>'.$rows.'</b> result of <b>'.$_POST['_statusCand'].'</b></p>';

                    $candidate = $object->fetch_all($sql);
                    if (count($candidate) > 0) {
                      $number = 1;
                      foreach ($candidate as $cand) {?>
                  <tr>
                    <td><?php echo $number;?></td>
                    <td><?= $cand['full_name'] ?></td>
                    <td><?= $cand['job_title'] ?></td>
                    <td><?= $cand['email'] ?></td>
                    <td align="center">
                      <?php if ($cand['status'] == 0) {
                        echo "<span class='badge badge-warning'>PENDING REVIEW</span>";
                      }elseif($cand['status'] == 3){
                        echo "<span class='badge badge-dark'>WAITING MANAGER DECISION</span>";
                      }elseif($cand['status'] == 1){
                        echo "<span class='badge badge-success'>SHORTLISTED</span>";
                      }elseif($cand['status'] == 2){
                        echo "<span class='badge badge-danger'>REJECTED</span>";
                      }elseif($cand['status'] == 4){
                        echo "<span class='badge badge-success'>INTERVIEW PASS</span>";
                      }elseif($cand['status'] == 5){
                        echo "<span class='badge badge-danger'>INTERVIEW FAIL</span>";
                      } ?>
                    </td>
                    <td><?= $cand['created'] ?></td>
                    
                  </tr>
                  <?php
                    $number++;
                   } }}else{?>
                    <tr>
                      <td colspan="6" align="center">No data..</td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            
            </div>
          </div>
          
        <br><br><br>
         
        </div>

      </div>

      <?php }elseif($authadmin['level'] == '4'){  ?> <!-- login sebagai staff -->

          <div class="container-fluid">

            <div class="animated fadeIn">
              <div class="row">

              <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count1; ?></h4>
                  <br>
                  <p>Number of Pending Review</p>
                </div>
              </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count2; ?></h4>
                  <br>
                  <p>Number of Shortlisted for Interview</p>
                </div>
              </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count4; ?></h4>
                  <br>
                  <p>Number of Interview Passed</p>
                </div>  
              </div>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count5; ?></h4>
                  <br>
                  <p>Number of Interview Failed</p>
                </div>
              </div>
            </div>
            <!--/.col-->

              </div>
              <hr>

          <div class="row">
            <div class="col-md-12">
              <form method="post">
                    <div class="form-inline">
                        <div class="form-group">
                          <label>Filter by :&nbsp;</label>
                            <select class="form-control" name="_statusCand" style="border-radius: 0px;">
                              <option selected disabled>Candidate Status</option>
                              <option value="0">Pending Review</option>
                              <option value="1">Shortlisted</option>
                              <option value="2">Rejected</option>
                              <option value="4">Interview Pass</option>
                              <option value="5">Interview Fail</option>
                              
                            </select>
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <input type="submit" name="_filterCand" class="btn btn-primary" value="Filter">
                        </div>
                        &nbsp;&nbsp;
                        <div class="form-group">
                            <a href="" class="btn btn-primary"><i class="fa fa-refresh"></i>&nbsp;RESET FILTER</a>
                        </div>

                    </div>
                </form>
                <br><br>
               
              <table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
                <thead>
                  <tr>
                    <td style="font-weight: bold;text-align: center;">No</td>
                    <td style="font-weight: bold;text-align: center;">Name</td>
                    <td style="font-weight: bold;text-align: center;">Job Vacancy</td>
                    <td style="font-weight: bold;text-align: center;">Email</td>
                    <td style="font-weight: bold;text-align: center;">Status</td>
                    <td style="font-weight: bold;text-align: center;">Apply Date</td>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    if(isset($_POST['_filterCand'])){

                      $statusCand  = $_POST['_statusCand'];

                      $sql = "SELECT a.*,b.job_title FROM sch_candidate_office a JOIN sch_job_office b ON a.id_job = b.id WHERE a.status='$statusCand' AND a.candidate_code!=''";
                      
                      $fetchAll = $object->fetch_all($sql);
                      $rows = count($fetchAll);
                      
                      echo '<p><b>'.$rows.'</b> result of <b>'.$_POST['_statusCand'].'</b></p>';

                    $candidate = $object->fetch_all($sql);
                    if (count($candidate) > 0) {
                      $number = 1;
                      foreach ($candidate as $cand) {?>
                  <tr>
                    <td><?php echo $number;?></td>
                    <td><?= $cand['full_name'] ?></td>
                    <td><?= $cand['job_title'] ?></td>
                    <td><?= $cand['email'] ?></td>
                    <td align="center">
                      <?php if ($cand['status'] == 0) {
                        echo "<span class='badge badge-warning'>PENDING REVIEW</span>";
                      }elseif($cand['status'] == 3){
                        echo "<span class='badge badge-dark'>WAITING MANAGER DECISION</span>";
                      }elseif($cand['status'] == 1){
                        echo "<span class='badge badge-success'>SHORTLISTED</span>";
                      }elseif($cand['status'] == 2){
                        echo "<span class='badge badge-danger'>REJECTED</span>";
                      }elseif($cand['status'] == 4){
                        echo "<span class='badge badge-success'>INTERVIEW PASS</span>";
                      }elseif($cand['status'] == 5){
                        echo "<span class='badge badge-danger'>INTERVIEW FAIL</span>";
                      } ?>
                    </td>
                    <td><?= $cand['created'] ?></td>
                    
                  </tr>
                  <?php
                    $number++;
                   } }}else{?>
                    <tr>
                      <td colspan="6" align="center">No data..</td>
                    </tr>
                    <?php } ?>
                </tbody>
              </table>
            
            </div>
          </div>
            </div>
          </div>

      <?php }elseif($authadmin['level'] == '5'){  ?> <!-- login sebagai receptionist/security -->
        <br>
        <h4 style="text-align: center">INTERVIEW SCHEDULE</h4>
        <br>
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <li class="nav-item">
            <a class="nav-link active" id="shipping-tab" data-toggle="tab" href="#shipping" role="tab" aria-controls="shipping" aria-selected="true"><b>SHIPPING CANDIDATE</b></a>
          </li>

          <li class="nav-item">
            <a class="nav-link" id="office-tab" data-toggle="tab" href="#office" role="tab" aria-controls="office" aria-selected="false"><b>OFFICE CANDIDATE</b></a>
          </li>
          
        </ul>
        <div class="tab-content" id="myTabContent">
          <div class="tab-pane fade show active" id="shipping" role="tabpanel" aria-labelledby="shipping-tab">

              <table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
                <thead>
                  <tr>
                    <td style="font-weight: bold;text-align: center;">No</td>
                    <td style="font-weight: bold;text-align: center;">Candidate Name</td>
                    <td style="font-weight: bold;text-align: center;">Position</td>
                    <td style="font-weight: bold;text-align: center;">Date / Time</td>
                    <td style="font-weight: bold;text-align: center;">PIC</td>
                    <td style="font-weight: bold;text-align: center;">Barcode</td>
                  </tr>
                </thead>
                <tbody>
                  <?php

                    $sql = "SELECT a.*, b.first_name,b.last_name,b.email,b.candidate_code, c.id_job_name FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate=b.id JOIN sch_job_shipping c ON b.id_job=c.id WHERE a.category='shipping' AND a.status='1'"; 
                    
                    $candidate = $object->fetch_all($sql);
                    if (count($candidate) > 0) {
                      $number = 1;
                      foreach ($candidate as $cand) {

                    $job = "SELECT name FROM sch_master_crewrank WHERE id='".$cand['id_job_name']."'";
                    $jobName = $object->fetch($job);

                    ?>
                  <tr>
                    <td><?php echo $number;?></td>
                    <td><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></td>
                    <td><?= $jobName['name'] ?></td>
                    <td align="center"><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></td>
                    <td><?= $cand['pic_name'] ?></td>
                    <td>
                    
                    <!-- Modal -->
                      <div class="modal" id="view<?= $cand['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                         <div class="modal-dialog modal-dialog-centered" role="document">
                           <div class="modal-content">
                             <div class="modal-header">
                               <h5 class="modal-title" id="exampleModalLongTitle">Detail Interview :</h5>
                               <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                 <span aria-hidden="true">&times;</span>
                               </button>
                             </div>
                             <div class="modal-body">
                               <form role="form" method="POST" enctype="multipart/form-data">
                               <div class="container-fluid">
                               <div class="row">
                                  <div class="col-md-4">
                                      Name
                                  </div>
                                  <div class="col-md-8">
                                      : <b><?= $cand['first_name'] ?> <?= $cand['last_name'] ?></b>
                                  </div>
                                  <div class="col-md-4">
                                      Position
                                  </div>
                                  <div class="col-md-8">
                                      : <b><?= $jobName['name'] ?></b>
                                  </div>
                                  <div class="col-md-4">
                                      Date / Time
                                  </div>
                                  <div class="col-md-8">
                                      : <b><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></b>
                                  </div>
                                  <div class="col-md-4">
                                      PIC
                                  </div>
                                  <div class="col-md-8">
                                      : <b><?= $cand['pic_name'] ?></b>
                                  </div>
                               </div>

                                  <div class="col-md-12" align="center">
                                      <img src="<?php echo BASE_URL; ?>media/images/qrcode_generate/<?= $cand['img_qrcode'] ?>" alt="">
                                  </div>
                             
                              </div>
                              
                             </div>
                             <div class="modal-footer">
                               
                             </div>
                           </div>
                         </div>
                           </div>
                           <!-- end Modal -->

                      <center>
                        <span class="btn btn-flat btn-success btn-sm" data-toggle="modal" title="View Detail Candidate" data-target="#view<?= $cand['id'] ?>"><i class="fa fa-eye"></i></span>
                      </center> 

                    </td>


                  </tr>
                  
                  <?php
                    $number++;
                    }}?>
                </tbody>
              </table>

          </div>
          <div class="tab-pane fade show active" id="office" role="tabpanel" aria-labelledby="office-tab">
              
              <table class="table table-responsive-sm table-bordered table-striped table-sm" id="example1">
            <thead>
              <tr>
                <td style="font-weight: bold;text-align: center;">No</td>
                <td style="font-weight: bold;text-align: center;">Candidate Name</td>
                <td style="font-weight: bold;text-align: center;">Position</td>
                <td style="font-weight: bold;text-align: center;">Date / Time</td>
                <td style="font-weight: bold;text-align: center;">PIC</td>
                <td style="font-weight: bold;text-align: center;">Barcode</td>
              </tr>
            </thead>
            <tbody>
              <?php 
                  $sql = "SELECT a.*,b.full_name,b.email,b.candidate_code,c.job_title FROM sch_interview_schedule a JOIN sch_candidate_office b ON a.id_candidate = b.id JOIN sch_job_office c ON b.id_job=c.id WHERE a.category='office' AND a.status='1'";
                $candidate = $object->fetch_all($sql);
                if (count($candidate) > 0) {
                  $number = 1;
                  foreach ($candidate as $cand) {?>
              <tr>
                <td><?php echo $number;?></td>
                <td><?= $cand['full_name'] ?></td>
                <td><?= $cand['job_title'] ?></td>
                <td><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></td>
                <td><?= $cand['pic_name'] ?></td>
                <td>

                <!-- Modal -->
                  <div class="modal" id="view<?= $cand['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                     <div class="modal-dialog modal-dialog-centered" role="document">
                       <div class="modal-content">
                         <div class="modal-header">
                           <h5 class="modal-title" id="exampleModalLongTitle">Detail Interview :</h5>
                           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                           </button>
                         </div>
                         <div class="modal-body">
                           <form role="form" method="POST" enctype="multipart/form-data">
                           <div class="container-fluid">
                           <div class="row">
                              <div class="col-md-4">
                                  Name
                              </div>
                              <div class="col-md-8">
                                  : <b><?= $cand['full_name'] ?></b>
                              </div>
                              <div class="col-md-4">
                                  Position
                              </div>
                              <div class="col-md-8">
                                  : <b><?= $cand['job_title'] ?></b>
                              </div>
                              <div class="col-md-4">
                                  Date / Time
                              </div>
                              <div class="col-md-8">
                                  : <b><?= $object->dateConvertEng($cand['date']); ?> / <?= $cand['time'] ?></b>
                              </div>
                              <div class="col-md-4">
                                  PIC
                              </div>
                              <div class="col-md-8">
                                  : <b><?= $cand['pic_name'] ?></b>
                              </div>
                           </div>

                              <div class="col-md-12" align="center">
                                  <img src="<?php echo BASE_URL; ?>media/images/qrcode_generate/<?= $cand['img_qrcode'] ?>" alt="">
                              </div>
                         
                          </div>
                          
                         </div>
                         <div class="modal-footer">
                           
                         </div>
                       </div>
                     </div>
                       </div>
                       <!-- end Modal -->

                  <center>
                    <span class="btn btn-flat btn-success btn-sm" data-toggle="modal" title="View Detail Candidate" data-target="#view<?= $cand['id'] ?>"><i class="fa fa-eye"></i></span>
                  </center> 

                </td>

              </tr>
              
              <?php
                $number++;
                }}?>
            </tbody>
          </table>

          </div>
        </div>
        

      <?php } ?>


      <!-- /.conainer-fluid -->
    </main>

    <?php } ?>