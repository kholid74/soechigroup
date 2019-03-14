<?php 

$cekStatus  = "SELECT * FROM sch_interview_schedule WHERE id_candidate=".$authadmin['id']."";
$showStatus = $object->fetch($cekStatus);

 ?>

<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Online Test</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            
          </div>
        </li>
      </ol>

    <div class="container-fluid">
        <div id="ui-view" style="opacity: 1;">
            <div class="animated fadeIn">
                <h4 style="text-align: center">ONLINE TEST</h4>
                <center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
                <div class="card">
                   
                <div class="card-body">
                    
                    <!-- Main row -->
                      <div class="row">
                        <div class="col-lg-12" align="center">

                            <br><br>

                            <?php if ($showStatus['online_test'] == "on"){ ?>

                            <a class="btn btn-primary btn-lg" href="<?= $showStatus['online_test_url'] ?>" target="_blank">START ONLINE TEST</a>
                                
                            <?php }else{ ?>
                            
                            <button class="btn btn-danger btn-lg" disabled title="Online test not active">ONLINE TEST NOT READY</button>
                            
                            <?php } ?>
                             <br><br>

                        </div>
                      </div>

                </div>
                </div>
            </div>
        </div>
    </div>