      <div class="container">
      <div class="row" style="background-color: #F1F1F2;">
        <div class="col-md-12" style="padding: 30px;padding-bottom: 0px;" align="center">
          <h1 style="font-weight: bold;color: #024a90;">JOB LIST - OFFICE</h1>
        </div>
        <div class="col-md-12" style="padding: 30px;padding-top: 10px;">
              <hr>
              <?php 
                $sql = "SELECT * FROM sch_job_office WHERE status = 'published' ORDER BY modified ASC";
                $job = $object->fetch_all($sql);
                if (count($job) > 0) {
                  foreach ($job as $jobs) {?>
                  <div style="margin-bottom: 20px;">
                  <a href="<?php echo $halaman->base_path()?>detail-office/<?= $jobs['id'] ?>-<?php echo $object->sluggify($jobs['job_title']); ?>">
                  <h5 style="font-weight: bold;color: #000000;"><?= $jobs['job_title'] ?></h5>
                  </a>
                  <i><span style="font-size: 13px;"><?= $jobs['job_location'] ?> / <?php echo $object->time_elapsed_string($jobs['modified']); ?></span></i>
                  </div>
                  <?php }}else{?>
                  <i><h5 style="font-weight: normal;color: #000000;">Sorry, no job available at the moment..</h5></i>
                  
                  <?php }  ?>
            </div>
    
      </div>
      
    </div>
