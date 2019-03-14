<?php 

  if(isset($_POST['_applyExcrew'])) {
  
    echo "<script> window.location.assign('".$object->base_path()."excrew-verification'); </script>";
    $_SESSION['type'] = 'excrew';
  } 

?>

      <div class="container">
      <div class="row" style="background-color: #F1F1F2;">
        <div class="col-md-12" style="padding: 30px;padding-bottom: 0px;" align="center">
          <h1 style="font-weight: bold;color: #024a90;">JOB LIST - VESSEL</h1>
        </div>
        <div class="col-md-6">
            <form method="post">
                <div class="form-inline">
                    <div class="form-group">
                        <select class="job-select" name="_jobCat">
                          <option selected disabled>Job Category</option>
                          <?php 
                            $cat = "SELECT DISTINCT deck_engine FROM sch_master_crewrank";
                            $jobcat = $object->fetch_all($cat);
                            if (count($jobcat) > 0) {
                              foreach ($jobcat as $job_cat) {?>
                          <option value="<?= $job_cat['deck_engine'] ?>"><?= $job_cat['deck_engine'] ?></option>
                          <?php }} ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="submit" name="_filter" class="job-select" value="Filter">
                    </div>
                </div>
            </form>
        </div>
        <div class="col-md-6" align="right">
          <form role="form" method="POST" enctype="multipart/form-data">
          <input type="submit" class="job-select" name="_applyExcrew" value="&nbsp;&nbsp;&nbsp;EX-CREW APPLY&nbsp;&nbsp;&nbsp;">
          </form>
        </div>
        
        <div class="col-md-12" style="padding: 30px;padding-top: 10px;">
              <hr>
              <?php 
                if(isset($_POST['_filter'])){

                $jobCat  = $_POST['_jobCat'];

                $sql = "SELECT a.*,b.name,b.deck_engine FROM sch_job_shipping a JOIN sch_master_crewrank b ON a.id_job_name=b.id WHERE b.deck_engine='$jobCat' AND a.status = 'published' ORDER BY a.modified DESC";
                $fetchAll = $object->fetch_all($sql);
                $rows = count($fetchAll);
                
                echo '<p><b>'.$rows.'</b> results</p>';
                
                }else {
                    $sql = "SELECT a.*,b.name,b.deck_engine FROM sch_job_shipping a JOIN sch_master_crewrank b ON a.id_job_name=b.id WHERE a.status = 'published' ORDER BY a.modified DESC";
                }
                
                $job = $object->fetch_all($sql);
                if (count($job) > 0) {
                  foreach ($job as $jobs) {?>
                  <div style="margin-bottom: 20px;">
                  <a href="<?php echo $halaman->base_path()?>detail-shipping/<?= $jobs['id'] ?>-<?php echo $object->sluggify($jobs['name']); ?>">
                  <h5 style="font-weight: bold;color: #000000;"><?= $jobs['name'] ?></h5>
                  </a>
                  <i><span style="font-size: 13px;"><?= $jobs['job_location'] ?> / <?php echo $object->time_elapsed_string($jobs['modified']); ?></span></i>
                  </div>
                  <?php }}else{?>
                  <i><h5 style="font-weight: normal;color: #000000;">Sorry, no job available at the moment..</h5></i>
                  
                  <?php }  ?>
            </div>
    
      </div>
      
    </div>
