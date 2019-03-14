      <?php 

        $sql  = 'SELECT * FROM sch_jobs WHERE id="'.$_GET['ids'].'"';
        $dataJob = $object->fetch($sql);

       ?>

      <div class="container">
      <div class="row" style="background-color: #F1F1F2;">
        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;">
          <h1 style="font-weight: normal;color: #007bff;">CAREERS</h1>
        </div>
        <div class="col-md-12" style="padding: 50px;">
            <img alt="" src="<?php echo $halaman->base_path()?>assets/img/img3.jpg">
            <br>
            <hr>
            <h4 style="font-weight: bold;color: #000000;"><?= $dataJob['job_name'] ?></h4>
              <br>
            <?= $dataJob['job_desc']?>
              <br>
            <a href="<?php echo $halaman->base_path()?>apply-job/<?= $dataJob['id'] ?>/<?php echo $object->sluggify($dataJob['job_name']); ?>"><button class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;APPLY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a>
        </div>
      
      </div>
    </div>
