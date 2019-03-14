<style type="text/css">
	.sw-theme-circles > ul.step-anchor:before {
	    content: " ";
	    position: absolute;
	    top: 50%;
	    bottom: 0;
	    width: 100%;
	    height: 5px;
	    background-color: #f5f5f5;
	    border-radius: 3px;
	    z-index: 0;
	}
	.sw-theme-circles > ul.step-anchor > li > a {
		font-size: 11px;
	    border: 2px solid #f5f5f5;
	    background: #f5f5f5;
	    width: 100px;
	    height: 100px;
	    text-align: center;
	    padding: 40px 0;
	    border-radius: 50%;
	    -webkit-box-shadow: inset 0px 0px 0px 3px #fff !important;
	    box-shadow: inset 0px 0px 0px 3px #fff !important;
	    text-decoration: none;
	    outline-style: none;
	    z-index: 99;
	    color: #bbb;
	    background: #f5f5f5;
	    line-height: 1;
	}
	.sw-theme-circles > ul.step-anchor > li {
	    border: none;
	    margin-left: 27px;
	    z-index: 98;
	}
</style>

<?php
	error_reporting(E_ALL);

    $reference     = 'SELECT * FROM sch_cand_office_reference WHERE id_candidate="'.$authadmin['id'].'"';
    $showReference = $object->fetch($reference); 

    if(isset($_POST['_saveReference'])) {
        $namatable = 'sch_cand_office_reference';
        $data = array(
          'id_candidate'=> $authadmin['id'],
          'name' => $_POST['name'],
          'company' => $_POST['company'],
          'position' => $_POST['position'],
          'years_known' => $_POST['yearsKnown'],
          'phone_number' => $_POST['phoneNumber']
          );
        $insert = $object->tambahdata($namatable,$data);
        $object->messagesin($insert);
        echo "<script> window.location.assign('".$object->base_path()."-reference'); </script>";
    }

    if(isset($_POST['_forward'])) {
        
        echo "<script> window.location.assign('".$object->base_path()."document-uploads'); </script>";
        
    }

?>
<!-- Main content -->
    <main class="main" style="background-color: #f0f3f5;">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Profile</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>profile"><?=$authadmin['full_name']?></a></li>
        <li class="breadcrumb-item active">Edit Reference</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <!-- <span>You logged as Candidate</b></span> -->
          </div>
        </li>
      </ol>

	<div class="container-fluid">
		<div id="ui-view" style="opacity: 1;">
			<div class="animated fadeIn">
				<h4 style="text-align: center">EDIT PROFILE</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">

					</div>
				<div class="card-body">

					<!-- Main row -->
				      <div class="row">
				          <div class="col-md-12">
				          	<div id="smartwizard" class="sw-main sw-theme-circles" align="center">
                                <ul class="nav nav-tabs step-anchor">
                                    <li class="nav-item active"><a href="#personal-info" class="nav-link" style="">PERSONAL INFO</a></li>
                                    <li class="nav-item active"><a href="#address" class="nav-link" style="">ADDRESS</a></li>
                                    <li class="nav-item active"><a href="#formal-education" class="nav-link">FORMAL EDUCATION</a></li>
                                    <li class="nav-item active"><a href="#family-member" class="nav-link">FAMILY MEMBER</a></li>
                                    <li class="nav-item active"><a href="#general-information" class="nav-link">GENERAL INFORMATION</a></li>
                                    <li class="nav-item active"><a href="#work-experience" class="nav-link">WORK EXPERIENCE</a></li>
                                    <li class="nav-item active"><a href="#reference" class="nav-link">REFERENCE</a></li>
                                    <li class="nav-item"><a href="#document-uploads" class="nav-link">DOCUMENT UPLOADS</a></li>
                                </ul>
                            </div>
				          </div>
				          <br>

				      <div class="col-md-10 offset-md-1">

				      	<button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#reference"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add Reference</button>    
		                <p align="center" style="font-weight: bold;">REFERENSI / REFERENCE</p>
		                
		                <table class="table table-responsive-sm table-bordered table-striped table-sm">
		                <thead>
		                  <tr style="font-weight: bold;">
		                    <td style="font-size: 12px;">Nama Referensi</td>
		                    <td style="font-size: 12px;">Perusahaan</td>
		                    <td style="font-size: 12px;">Jabatan</td>
		                    <td style="font-size: 12px;">Lama Kenal</td>
		                    <td style="font-size: 12px;">Nomor Telepon</td>
		                  </tr>
		                </thead>
		                <tbody>
		                  <?php 
		                  $sql = 'SELECT * FROM sch_cand_office_reference WHERE id_candidate="'.$authadmin['id'].'"';
		                  $exp = $object->fetch_all($sql);
		                  if (count($exp) > 0) {
		                    foreach ($exp as $smp) {?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['name'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['company'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['position'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['years_known'] ?></td>
		                    <td style="font-size: 12px;font-weight: normal;"><?= $smp['phone_number'] ?></td>
		                  </tr>
		                  <?php }}else { ?>
		                  <tr>
		                    <td style="font-size: 12px;font-weight: normal;" align="center" colspan="5">No Data..</td>
		                  </tr>
		                  <?php } ?>
		                <hr>
		                </tbody>
		              </table>        	

				      </div>
				      <div class="col-md-12" align="center">
						<input type="hidden" name="id" value="<?= $$authadmin['id'] ?>">
						<form role="form" method="POST" enctype="multipart/form-data">
						<a href="<?php echo $object->base_path()?>work-experience" class="btn btn-flat btn-primary">BACK</a>
				      	<input type="submit" class="btn btn-flat btn-primary" name="_forward" value="NEXT">
				      </div>
				      </form>
				</div>
				</div>
			</div>
		</div>
	</div>

<!-- MODAL -->
      <div class="modal" id="reference" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">REFERENSI / REFERENCE</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form role="form" method="POST" enctype="multipart/form-data">
              <div class="container-fluid">
              <div class="row">

                <div class="col-md-12">

                    <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="name">Nama Referensi / Reference Name *</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="name" name="name"required>
                      </div>
                     </div>
                    
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="company">Perusahaan / Company</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="company" name="company"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="position">Jabatan / Position</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="position" name="position"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="yearsKnown">Lama Kenal / Years Known</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="yearsKnown" name="yearsKnown"required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="phoneNumber">Nomor Telepon / Phone Number</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"required>
                      </div>
                     </div>

                </div>
              </div>
          </div>
             
            </div>
            <div class="modal-footer">
              <input type="submit" name="_saveReference"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add SMP" value="SAVE" />
              </form>
            </div>
          </div>
        </div>
    </div>