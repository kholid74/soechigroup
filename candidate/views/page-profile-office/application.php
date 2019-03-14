<?php 

$cekStatus = "SELECT status FROM sch_candidate_office WHERE id=".$authadmin['id']."";
$showStatus = $object->fetch($cekStatus);

 ?>

<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Application Status</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            
          </div>
        </li>
      </ol>

    <div class="container-fluid">
        <div id="ui-view" style="opacity: 1;">
            <div class="animated fadeIn">
                <h4 style="text-align: center">MY APPLICATION STATUS</h4>
                <center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
                <div class="card">
                   
                <div class="card-body">
                    
                    <!-- Main row -->
                      <div class="row">
                        <div class="col-lg-12">
                            <div id="smartwizard" class="sw-main sw-theme-circles" align="center">
                                <ul class="nav nav-tabs step-anchor">

                                    <li class="nav-item active"><a href="#apply" class="nav-link" style="font-weight: bold;">APPLY&nbsp;<i class="fa fa-check"></i></a></li>
                                    
                                    <li class="nav-item <?php if($showStatus['status'] == '1' OR $showStatus['status'] == '4' OR $showStatus['status'] == '5') {echo 'active';} ?>"><a href="#shortlisted" class="nav-link" style="font-weight: bold;">SHORTLISTED <br><br><span class='badge badge-default' style='font-weight: normal;background-color: white;color: #5bc0de;border-radius: 10px;padding-left: 10px;padding-right: 10px;'>PASSED</span></a></li>
                                    
                                    <li class="nav-item <?php if($showStatus['status'] == '4' OR $showStatus['status'] == '5') {echo 'active';} ?>"><a href="#interview" class="nav-link">INTERVIEW<br><br><span class='badge badge-default' style='font-weight: normal;background-color: white;color: #5bc0de;border-radius: 10px;padding-left: 10px;padding-right: 10px;'><?php if($showStatus['status'] == '4') {echo 'PASSED';}else if($showStatus['status'] == '5')echo 'FAILED'; ?></span></a></li>

                                    <!-- <li class="nav-item"><a href="#testonline" class="nav-link">TEST ONLINE</a></li> -->
                                    
                                    <li class="nav-item"><a href="#joined" class="nav-link">JOINED</a></li>
                                </ul>

                                
                            </div>
                          
                        </div>
                      </div>

                </div>
                </div>
            </div>
        </div>
    </div>