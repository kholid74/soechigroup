      <div class="container">
      <div class="row" style="background-color: #F1F1F2;">
        <div class="col-md-12" style="padding: 30px;padding-bottom: 0px;">
          <h1 style="font-weight: normal;color: #007bff;">CAREERS</h1>
        </div>
        <div class="col-md-4" style="padding: 30px;">
           <h5 style="font-weight: normal;color: #000000;">FILTER BY</h5>
              <hr>
              <b>JOBS CATEGORY :</b>
              <p></p>
                <br>
                <?php
                        $cat    = "SELECT * FROM sch_job_category";
                        $jobCat = $object->fetch_all($cat);
                        $no = 0;
                        if (count($jobCat) > 0) {
                          foreach ($jobCat as $Cat) {
                          $no++;
                          $convert1 = strtolower($Cat['category_name']);
                          $title1 = str_replace(' ', '-', $convert1);
                          $idcat  = $Cat['id'];
                          $jobb   = "SELECT * FROM sch_jobs WHERE id_jobcat='$idcat'";
                          $showJobb   = count($jobb);
                                  if (!empty($showJobb)) {?>

                          <input type="checkbox" name="ids[]" value="<?=$Cat['id'];?>" id="check<?php echo $no;?>" class="ids"/>
                  <label for="check<?php echo $no;?>"><?=$Cat['category_name'];?>
                    <a href="javascript::void(0)" style="text-decoration: none;"><span style="color: #337ab7;">(<?php echo $showJobb; ?>)</span></a></label><br>
                  <?php
                  }
                }
              }
              ?>
        </div>
        <div class="col-md-8" style="padding: 30px;padding-left: 0px;">
           
              <h5 style="font-weight: normal;color: #000000;">RESULTS</h5>
              <hr>
              <?php 
                $sql = "SELECT * FROM sch_jobs WHERE active = '1'";
                $job = $object->fetch_all($sql);
                if (count($job) > 0) {
                  foreach ($job as $jobs) {?>
                  <div style="margin-bottom: 20px;">
                  <a href="<?php echo $halaman->base_path()?>view-job/<?= $jobs['id'] ?>/<?php echo $object->sluggify($jobs['job_name']); ?>">
                  <h4 style="font-weight: bold;color: #000000;"><?= $jobs['job_name'] ?></h4>
                  </a>
                  <i><span><?= $jobs['job_location'] ?> / <?php echo $object->time_elapsed_string($jobs['modified']); ?></span></i>
                  </div>
                  <?php }}else{?>
                  <i><h5 style="font-weight: normal;color: #000000;">Sorry, no job post at the moment..</h5></i>
                  
                  <?php }  ?>
            </div>
    
      </div>
      
    </div>
