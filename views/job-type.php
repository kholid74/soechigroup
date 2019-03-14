<?php 

  $shipping    = "SELECT * FROM sch_job_shipping WHERE status = 'published'";
  $allShipping = $object->fetch_all($shipping);

  $office    = "SELECT * FROM sch_job_office WHERE status = 'published'";
  $allOffice = $object->fetch_all($office);

 ?>

      <div class="container">
      <div class="row" style="background-color: #F1F1F2;">
        <div class="col-md-12" style="padding: 30px;padding-bottom: 0px;" align="center">
          <h1 style="font-weight: bold;color: #024a90;">CHOOSE JOB TYPE :</h1>
        </div>
        <div class="col-md-12" style="padding: 30px;padding-top: 0px;">

        <div class="grid">
          <a href="<?php echo $halaman->base_path()?>job-shipping">
            <figure class="effect-steve">
              <img src="<?php echo $halaman->base_path()?>media/images/vessel.jpg" alt="img29"/>
              <figcaption>
                <h2><span style="color: #024a90;">SHIPPING</span></h2>
                <p><?php echo count($allShipping); ?> Positions</p>
              </figcaption>     
            </figure>
          </a>
          <a href="<?php echo $halaman->base_path()?>job-office">
            <figure class="effect-steve">
              <img src="<?php echo $halaman->base_path()?>media/images/office.jpg" alt="img33"/>
              <figcaption>
                <h2><span style="color: #024a90;">OFFICE</span></h2>
                <p><?php echo count($allOffice); ?> Positions</p>
              </figcaption>     
            </figure>
          </a>
        </div>
              
        </div>
    
      </div>
      
    </div>
