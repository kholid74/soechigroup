      <?php 

        $sql  = 'SELECT * FROM sch_job_office WHERE id="'.$_GET['ids'].'"';
        $dataJob = $object->fetch($sql);

        if(isset($_POST['_applyOffice'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."email-verification'); </script>";
          $_SESSION['type'] = 'office';
          $_SESSION['idJob'] = $dataJob['id'];
        }

       ?>

      <div class="container">
      <div class="row" style="background-color: #F1F1F2;">
        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;"><?= $dataJob['job_title'] ?></h4>
        </div>
        <div class="col-md-12" style="padding: 50px;padding-top: 10px;padding-bottom: 10px;">
            <img alt="" src="<?php echo $halaman->base_path()?>media/images/banner/<?= $dataJob['job_banner'] ?>">
            <br>
            <hr>
             <br>
            <?= $dataJob['job_desc']?>
        </div>
        <div class="col-md-12" style="padding: 50px;padding-top: 10px;">

          <form role="form" method="POST" enctype="multipart/form-data">
          <input type="submit" class="btn btn-primary" name="_applyOffice" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;APPLY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">
          </form>
          <!-- <a href="<?php echo $halaman->base_path()?>email-verification/<?= $dataJob['id'] ?>"><button class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;APPLY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a> -->
          
        </div>
       
      </div>
    </div>
