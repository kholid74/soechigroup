<?php //error_reporting(0);
  
  /*PENDING REVIEW*/
  $sql1   = "SELECT * FROM sch_candidate_office WHERE status='0'";
  $show1  = $object->fetch_all($sql1);
  $count1 = count($show1); 

  /*SHORTLIST*/
  $sql2   = "SELECT * FROM sch_candidate_office WHERE status='1'";
  $show2  = $object->fetch_all($sql2);
  $count2 = count($show2);

  /*REJECT REVIEW*/
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

  /*MALE CANDIDATE*/
  $sql6   = "SELECT * FROM sch_candidate_office WHERE gender='Male'";
  $show6  = $object->fetch_all($sql6);
  $count6 = count($show6);

  /*FEMALE CANDIDATE*/
  $sql7   = "SELECT * FROM sch_candidate_office WHERE gender='Female'";
  $show7  = $object->fetch_all($sql7);
  $count7 = count($show7);

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Office</a></li>
        <li class="breadcrumb-item active">Reports</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <span>You logged as <b><?php echo $object->logged_as($level); ?></b></span>
          </div>
        </li>
      </ol>

      <div class="container-fluid">

        <div class="animated fadeIn">
          <div class="row">

            <div class="col-sm-6 col-lg-3">
              <a href="#" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count1; ?></h4>
                  <br>
                  <p>Number of Applied Pending Review</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <a href="#" style="text-decoration: none;">
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
             <a href="#" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count3; ?></h4>
                  <br>
                  <p>Number of Rejected Due to Non Suitable</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
             <a href="#" style="text-decoration: none;">
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
              <a href="#" style="text-decoration: none;">
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
              <a href="#" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count6; ?></h4>
                  <br>
                  <p>Number of Male Candidate</p>
                </div>
              </div>
             </a>
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-3">
              <a href="#" style="text-decoration: none;">
              <div class="card text-white bg-primary">
                <div class="card-body pb-0" style="height: 124px;">
                  <h4 class="mb-0"><?php echo $count7; ?></h4>
                  <br>
                  <p>Number of Female Candidate</p>
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
	                <div class="form-inline" align="center">
	                    <div class="form-group">
	                        <select class="form-control" name="_jobTitle" style="border-radius: 0px;">
	                          <option selected disabled>Filter by Vacancy</option>
	                          <?php 

	                          	$jobtitle = "SELECT job_title FROM sch_job_office";
	                          	$job =$object->fetch_all($jobtitle);
								foreach ($job as $showJob){

	                           ?>
	                          <option value="<?= $showJob['job_title'] ?>"><?= $showJob['job_title'] ?></option>
	                          <?php } ?>
	                        </select>
	                    </div>
	                    &nbsp;
	                    <div class="form-group">
	                        <input type="submit" name="_filterJob" class="btn btn-success" value="Filter">
	                    </div>
						&nbsp;
	                    <div class="form-group">
	                        <a href="" class="btn btn-success"><i class="fa fa-refresh"></i>&nbsp;Reset Filter</a>
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

                    if(isset($_POST['_filterJob'])){

                      $jobtitle  = $_POST['_jobTitle'];

                      $sql = "SELECT a.*,b.job_title FROM sch_candidate_office a JOIN sch_job_office b ON a.id_job = b.id WHERE b.job_title='$jobtitle'";
                      
                      $fetchAll = $object->fetch_all($sql);
                      $rows = count($fetchAll);
                      
                      echo '<p><b>'.$rows.'</b> result of <b>'.$_POST['_jobTitle'].'</b></p>';
                    

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
      <!-- /.conainer-fluid -->
    </main>