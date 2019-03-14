<?php
    $sql  = 'SELECT * FROM sch_job_office WHERE id="'.$_GET['ids'].'"';
    $data = $object->fetch($sql);
    if (!empty($data)){
    if(isset($_POST['_publish'])){ 
        $namatable = 'sch_job_office';
        $maxsize = 1024 * 1024; // 1MB

        if (!empty($_FILES["banner"]["name"])) {

            $fileSize  = $_FILES['banner']['size'];
            if($fileSize < $maxsize){
                $object->deleteBanner($_POST['oldimage']);
                $object->create_path();
                $banner = $object->uploadBanner();
                $data = array(
                    'job_title' => $_POST['_jobname'],
                    'job_level' => $_POST['_level'],
                    'job_location' => $_POST['_location'],
                    'job_desc' => $_POST['_jobdesc'],
                    'job_banner' => $banner,
                    'status' => $_POST['_status'],
                    'posted_by' => $_POST['_posted_by']
                );
                $conditions = array('id' =>$_POST['id']);
                $updated = $object->updatedata($namatable,$data,$conditions);
                $object->messagesup($updated);
                echo "<script> window.location.assign('".$object->base_path()."list-vacancy-office'); </script>";
            }else{
                $object->messagesfile();
                echo "<script> window.location.assign('".$object->base_path()."list-vacancy-office'); </script>";
            }

        }else{
            $data = array(
                    'job_title' => $_POST['_jobname'],
                    'job_level' => $_POST['_level'],
                    'job_location' => $_POST['_location'],
                    'job_desc' => $_POST['_jobdesc'],
                    'status' => $_POST['_status'],
                    'posted_by' => $_POST['_posted_by']
                );
            $conditions = array('id' =>$_POST['id']);
            $updated = $object->updatedata($namatable,$data,$conditions);
            $object->messagesup($updated);
            echo "<script> window.location.assign('".$object->base_path()."list-vacancy-office'); </script>";
        }
    }}
?>
<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Jobs</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>list-vacancy-office">Job List</a></li>
        <li class="breadcrumb-item active">Edit Job (Office)</li>

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
        <center><span style="font-size: 15px;">SOECHI LINES</span></center>
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
                        <input type="text" id="text-input" name="_jobname" class="form-control" placeholder="Enter job Name" value="<?= $data['job_title'] ?>">
                        <span class="help-block"></span>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-3 col-form-label" for="_level">Level</label>
                      <div class="col-md-9">
                        <select id="_level" name="_level" class="form-control" required> 
                          <option selected disabled>Select Level</option>
                          <option value="Staff" <?php if($data['job_level'] == "Staff"){echo "selected";} ?>>Staff</option>
                          <option value="Supervisor" <?php if($data['job_level'] == "Supervisor"){echo "selected";} ?>>Supervisor</option>
                          <option value="Assistant Manager" <?php if($data['job_level'] == "Assistant Manager"){echo "selected";} ?>>Assistant Manager</option>
                          <option value="Manager" <?php if($data['job_level'] == "Manager"){echo "selected";} ?>>Manager</option>
                          <option value="General Manager" <?php if($data['job_level'] == "General Manager"){echo "selected";} ?>>Staff</option>
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

                    <input type="hidden" name="_jobtype" class="form-control" value="office">
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