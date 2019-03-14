    

      <?php 

        $sql  = 'SELECT a.*,b.name FROM sch_job_shipping a JOIN sch_master_crewrank b ON a.id_job_name=b.id WHERE a.id="'.$_GET['ids'].'"';
        $dataJob = $object->fetch($sql);

        if(isset($_POST['_applyShipping'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."email-verification'); </script>";
          $_SESSION['type'] = 'shipping';
          $_SESSION['idJob'] = $dataJob['id'];
        }

        if(isset($_POST['_applyExcrew'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."email-verification'); </script>";
          $_SESSION['type'] = 'excrew';
          $_SESSION['idJob'] = $dataJob['id'];
        }

       ?>



       <title><?= $dataJob['name'] ?> | Vektor Maritim</title>

      <div class="container">
      <div class="row" style="background-color: #F1F1F2;">
        <div class="col-md-12" style="padding: 50px;padding-bottom: 0px;padding-top: 20px;" align="center">
          <h4 style="font-weight: bold;color: #000000;"><?= $dataJob['name'] ?></h4>
        </div>
        <div class="col-md-12" style="padding: 50px;padding-top: 10px;padding-bottom: 10px;">
            <img alt="" src="<?php echo $halaman->base_path()?>media/images/banner/<?= $dataJob['job_banner'] ?>">
            <br>
            <hr>
             <br>
            <?= $dataJob['job_desc']?>
        </div>
        <div class="col-md-6" style="padding: 50px;padding-top: 10px;">
          <form role="form" method="POST" enctype="multipart/form-data">
          <input type="submit" class="btn btn-primary" name="_applyShipping" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;APPLY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;">


          <!-- <a href="<?php echo $halaman->base_path()?>email-verification/<?= $dataJob['id'] ?>"><button class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;APPLY NOW&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a> -->
        </div>
        <div class="col-md-6" style="padding: 50px;padding-top: 10px;" align="right">
        <!-- 
          <input type="submit" class="btn btn-primary" name="_applyExcrew" value="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EX-CREW APPLY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"> -->
          </form>
         <!--  <a href="<?php echo $halaman->base_path()?>excrew-personal-data/<?= $dataJob['id'] ?>"><button class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;EX-CREW APPLY&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button></a> -->
        </div>
      
      </div>
    </div>
