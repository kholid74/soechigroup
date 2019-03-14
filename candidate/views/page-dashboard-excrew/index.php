<?php 

  $sql = "SELECT * FROM sch_ex_candidate_document WHERE id_excrew=".$authadmin['id']."";
  $countUpload = $object->fetch_all($sql);
  $countDoc = count($countUpload);

 ?>

<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">Dashboard</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <!-- <span>You logged as <b>Candidate</b></span> -->
          </div>
        </li>
      </ol>

      <div class="container-fluid">

        <div class="animated fadeIn">
          <div class="row">

            <div class="col-sm-6 col-lg-4">
              <div class="card text-white bg-success">
                <div class="card-body pb-0" align="center" style="height: 245px;">
                  <h4 class="mb-0"><i class="fa fa-tv fa-3x"></i></h4>
                  <br>
                  <p style="font-weight: bold;font-size: 25px;">PERSONAL DATA UPLOADS</p>
                  <a href="<?php echo $object->base_path()?>document-uploads"><button class="btn btn-success btn-md" style="background-color: white;color: #4dbd74;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;">COMPLETE</button></a>
                  <br>
                </div>
              </div>
            
            </div>
            <!--/.col-->

            <div class="col-sm-6 col-lg-4">
              <?php if(!empty($countDoc)) { ?>
              <div class="card text-white bg-success">
                <div class="card-body pb-0" align="center" style="height: 245px;">
                  <h4 class="mb-0"><i class="fa fa-book fa-3x"></i></h4>
                  <br>
                  <p style="font-weight: bold;font-size: 25px;">DOCUMENT UPLOADS</p>
                  <a href="<?php echo $object->base_path()?>document-uploads"><button class="btn btn-success btn-md" style="background-color: white;color: #4dbd74;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;margin-top: 38px;" >COMPLETE</button></a>
                  <br>
                </div>
              </div>
              <?php }else { ?>
              <div class="card text-white bg-danger">
                <div class="card-body pb-0" align="center" style="height: 245px;">
                  <h4 class="mb-0"><i class="fa fa-book fa-3x"></i></h4>
                  <br>
                  <p style="font-weight: bold;font-size: 25px;">DOCUMENT UPLOADS</p>
                  <a href="<?php echo $object->base_path()?>document-uploads"><button class="btn btn-success btn-md" style="background-color: white;color: #f86c6b;border: 1px solid #ffffff;border-radius: 11px;padding-left: 25px;padding-right: 25px;margin-top: 38px;">NOT COMPLETE</button></a>
                  <br>
                </div>
              </div>
              <?php } ?>
            </div>
            <!--/.col-->

            <!--/.col-->
          </div>
          <!--/.row-->
          <div class="row">
            <div class="col-md-12">
              <div class="card text-black" style="background-color: #dadbdc">
                <div class="card-body pb-0" align="left">
                  <br>
                  <!-- <p style="font-weight: normal;font-size: 25px;">INTERVIEW SCHEDULE</p> -->
                  <ul>
                    <li>Please complete your data until BOX above changed to <b>"COMPLETE"</b>.</li>
                  </ul>
                  <br>
                  
                </div>
              
              </div>
            </div>
          </div>

         
        </div>

      </div>
      <!-- /.conainer-fluid -->
    </main>