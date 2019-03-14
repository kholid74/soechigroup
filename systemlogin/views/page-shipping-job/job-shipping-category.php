<?php 

if(isset($_POST['_publish'])) { 
    $namatable = 'sch_job_shipping_cat';
    $data = array(
      'category_name'=>$_POST['catName']
    ); 
    $insert = $object->tambahdata($namatable,$data);
    $object->messagesin($insert);
    echo "<script> window.location.assign('".$object->base_path()."shipping-category');</script>";
        
  }

   if(isset($_POST['_update'])){ 
    $namatable = 'sch_job_shipping_cat';
    $data = array(
      'category_name'=>$_POST['catName']
  );
    $conditions = array('id' =>strip_tags($_POST['id']));
    $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Data has been updated successfully.':'Some problem occurred, please try again.';
    @$msg = $_SESSION['statusMsg'] = $statusMsg;
    echo "<script> window.location.assign('".$object->base_path()."shipping-category'); </script>";
}

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Shipping</li>
        <li class="breadcrumb-item active">Shipping Category</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <span>You logged as <b><?php if ($authadmin['level'] == 1) { echo "Superadmin";} ?></b></span>
          </div>
        </li>
      </ol>

	<div class="container-fluid">
		<div id="ui-view" style="opacity: 1;">
			<div class="animated fadeIn">
				<h4 style="text-align: center">SHIPPING CATEGORY</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">

						<span class="btn btn-flat btn-primary" data-toggle="modal" data-target="#addCat"><i class="fa fa-plus "></i>&nbsp;Add Shipping Category</span>

					</div>
				<div class="card-body">

						<?php
                          if(!empty($_SESSION['statusMsg'])){
                              echo '
                                 <div class="alert alert-success" role="alert">
                                  '.$_SESSION['statusMsg'].'
                                 </div>';
                              unset($_SESSION['statusMsg']);
                          }
                        ?>

					<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
						<thead>
							<tr>
								<td style="font-weight: bold;">No</td>
								<td style="font-weight: bold;">Category Name</td>
								<td style="font-weight: bold;">Modified</td>
								<td style="font-weight: bold;">Action</td>
							</tr>
						</thead>
						<tbody>
							<?php 
						    	$sql = "SELECT * FROM sch_job_shipping_cat";
								$usr = $object->fetch_all($sql);
								if (count($usr) > 0) {
									$number = 1;
									foreach ($usr as $job) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $job['category_name'] ?></td>
								<td><?= $job['modified'] ?></td>
								<td align="center">

									<span class="btn btn-flat btn-primary btn-sm" data-toggle="modal" data-target="#catEdit<?php echo $job['id']?>"><i class="fa fa-edit"></i></span>

									<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-shipping-category/<?php echo $job['id']?>" onclick="return confirm('Confirm delete ?')">
									<i class="fa fa-trash-o "></i>
									</a>

								</td>
							</tr>

							<!-- Modal -->
							<div class="modal" id="catEdit<?php echo $job['id']?>" tabindex="-1" role="dialog" aria-labelledby="catEdit<?php echo $job['id']?>" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Edit Shipping Category</h5>
							        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
							          <span aria-hidden="true">&times;</span>
							        </button>
							      </div>
							      <div class="modal-body">
							       <div class="modal-body">
						              <form role="form" method="POST" enctype="multipart/form-data">
						              <div class="container-fluid">
						              <div class="row">

						                <div class="col-md-12">

						                   <div class="form-group row">
							                  <label class="col-md-4 col-form-label" for="catName">Category Name</label>
							                  <div class="col-md-8">
							                    <input type="text" class="form-control" id="catName" name="catName" value="<?= $job['category_name'] ?>" required>
							                  </div>
							                 </div>
						                 
						                </div>
						              </div>
						          </div>
						             
						            </div>
							      </div>
							      <div class="modal-footer">
							      	<input type="hidden" name="id" value="<?= $job['id'] ?>">
							        <input type="submit" name="_update" class="btn btn-flat btn-primary" value="UPDATE" />
							        </form>
							      </div>
							    </div>
							  </div>
							</div>
						<!-- end modal -->

							<?php
					    	$number++;
					    	}}?>
						</tbody>
					</table>
				</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal" id="addCat" tabindex="-1" role="dialog" aria-labelledby="crewRank" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Shipping Category</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <div class="modal-body">
              <form role="form" method="POST" enctype="multipart/form-data">
              <div class="container-fluid">
              <div class="row">

                <div class="col-md-12">

                   <div class="form-group row">
	                  <label class="col-md-4 col-form-label" for="catName">Category Name</label>
	                  <div class="col-md-8">
	                    <input type="text" class="form-control" id="catName" name="catName" required>
	                  </div>
	                 </div>

                </div>
              </div>
          </div>
             
            </div>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" name="_publish" class="btn btn-flat btn-primary" value="SAVE" />
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
<!-- end modal -->