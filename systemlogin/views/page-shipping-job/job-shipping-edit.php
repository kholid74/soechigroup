<?php

    $sql  = 'SELECT * FROM sch_job_shipping WHERE id="'.$_GET['ids'].'"';

    $data = $object->fetch($sql);

    if (!empty($data)){

    if(isset($_POST['_publish'])){ 

        $namatable = 'sch_job_shipping';

        $maxsize = 1024 * 1024; // 1MB



        if (!empty($_FILES["banner"]["name"])) {



            $fileSize  = $_FILES['banner']['size'];

            if($fileSize < $maxsize){

                $object->deleteBanner($_POST['oldimage']);

                $object->create_path();

                $banner = $object->uploadBanner();

                $data = array(

                    'id_job_name' => $_POST['_jobname'],

                    'job_location' => $_POST['_location'],

                    'job_desc' => $_POST['_jobdesc'],

                    'job_banner' => $banner,

                    'status' => $_POST['_status'],

                    'posted_by' => $_POST['_posted_by']

                );

                $conditions = array('id' =>$_POST['id']);

                $updated = $object->updatedata($namatable,$data,$conditions);

                $object->messagesup($updated);

                echo "<script> window.location.assign('".$object->base_path()."list-vacancy-shipping'); </script>";

            }else{

                $object->messagesfile();

                echo "<script> window.location.assign('".$object->base_path()."list-vacancy-shipping'); </script>";

            }



        }else{

            $data = array(

                    'id_job_name' => $_POST['_jobname'],

                    'job_location' => $_POST['_location'],

                    'job_desc' => $_POST['_jobdesc'],

                    'status' => $_POST['_status'],

                    'posted_by' => $_POST['_posted_by']

                );

            $conditions = array('id' =>$_POST['id']);

            $updated = $object->updatedata($namatable,$data,$conditions);

            $object->messagesup($updated);

            echo "<script> window.location.assign('".$object->base_path()."list-vacancy-shipping'); </script>";

        }

    }}

?>

<!-- Main content -->

    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item">Shipping</li>

        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>list-vacancy-shipping">List Vacancy</a></li>

        <li class="breadcrumb-item active">Edit Vacancy</li>



        <!-- Breadcrumb Menu-->

        <li class="breadcrumb-menu d-md-down-none">

          <div class="btn-group" role="group" aria-label="Button group">

            <span>You logged as <b><?php echo $object->logged_as($level); ?></b></span>

          </div>

        </li>

      </ol>



  <div class="container-fluid">

    <div id="ui-view" style="opacity: 1;">

      <div class="animated fadeIn">

        <h4 style="text-align: center">EDIT VACANCY</h4>

        <center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>

        <div class="col-md-10 offset-md-1">

                <div class="card">

                <div class="card-header"></div>

                  <div class="card-body">

                    <form role="form" method="POST" enctype="multipart/form-data">



                    <div class="form-group row">

                      <label class="col-md-3 col-form-label" for="banner">Job Banner</label>

                      <div class="col-md-9">

                        <img id="replace_banner" src="<?php echo BASE_URL ?>media/images/banner/<?= $data['job_banner'] ?>" style="width:500px;height:200px;"> <br>

                        <input onchange="document.getElementById('replace_banner').src = window.URL.createObjectURL(this.files[0])" type="file" name="banner" > <br>

                        <span style="font-size: 10px;">Dimension 1000 x 400</span> . <span style="font-size: 10px;">Max Size 500kb</span> . <span style="font-size: 10px;">JPEG | JPG | PNG</span>

                      </div>

                     </div>

                     

                     <div class="form-group row">

                      <label class="col-md-3 col-form-label" for="_jobname">Job Title</label>

                      <div class="col-md-9">

                        <select id="_jobname" name="_jobname" class="form-control" required> 

                          <option selected disabled>Select Job Title</option>

                            <?php 

                              $sql = "SELECT * FROM sch_master_crewrank";

                              $usr = $object->fetch_all($sql);

                              if (count($usr) > 0) {

                                $number = 1;

                                foreach ($usr as $jobName) {?>

                          <option value="<?= $jobName['id'] ?>" <?php if($data['id_job_name'] == $jobName['id']){echo "selected";} ?>><?= $jobName['name'] ?> (<?= $jobName['deck_engine'] ?>)</option>

                          <?php

                            }}?>

                        </select>

                      </div>

                    </div>



                    <div class="form-group row">

                        <label class="col-md-3 col-form-label" for="_location">Location</label>

                        <div class="col-md-9">

                          <input type="text" id="text-input" name="_location" class="form-control" placeholder="Enter job location" value="<?= $data['job_location'] ?>">

                          <span class="help-block"></span>

                        </div>

                       </div>



                    <div class="form-group row">

                      <label class="col-md-3 col-form-label" for="_jobdesc">Job Description</label>

                      <div class="col-md-9">

                        <textarea class="form-control" name="_jobdesc" id="content" cols="30" rows="10"><?= $data['job_desc'] ?></textarea>

                        <span class="help-block"></span>

                      </div>

                     </div>



                  </div>

                  <div class="card-footer">



                    <?php if ($authadmin['level'] == 1 OR $authadmin['level'] == 2 OR $authadmin['level'] == 3){ ?>

                      <input type="hidden" name="_status" class="form-control" value="published">

                    <?php }elseif($authadmin['level'] == 4){ ?>

                      <input type="hidden" name="_status" class="form-control" value="pending">

                    <?php } ?>

            

                    <input type="hidden" name="_posted_by" class="form-control" value="<?php echo $authadmin['username']; ?>">

                    <input type="hidden" name="oldimage" value="<?php echo $data['job_banner']?>">

                    <input type="hidden" name="id" value="<?php echo $data['id']?>">

                    <input type="submit" name="_publish"  class="btn btn-md btn-primary" value="UPDATE" />

                  </div>

                  </form>

                </div>

              </div>

      </div>

    </div>

  </div>