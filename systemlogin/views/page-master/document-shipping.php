  <?php

	  if(isset($_POST['_publish'])) { 

	    $namatable = 'sch_master_document_shipping';
	    $jumlah_dipilih = count($_POST['docName']);
 
		for($x=0;$x<$jumlah_dipilih;$x++){
			$data = array(
			      'category'=>$_POST['category'],
			      'document_name'=>$_POST['docName'][$x]
			    ); 
		$insert = $object->tambahdata($namatable,$data);
		}

	    $object->messagesin($insert);
	    echo "<script> window.location.assign('".$object->base_path()."master-shipping-document');</script>";
	        
	  }

	   if(isset($_POST['_update'])){ 
        $namatable = 'sch_master_document_shipping';
        $data = array(
          'category'=>$_POST['category'],
		  'document_name'=>$_POST['docName']
      );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Data has been updated successfully.':'Some problem occurred, please try again.';
        @$msg = $_SESSION['statusMsg'] = $statusMsg;
        echo "<script> window.location.assign('".$object->base_path()."master-shipping-document'); </script>";
    }

?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Master Data</li>
        <li class="breadcrumb-item active">Document Shipping</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <span>You logged as <b><?php echo $object->logged_as($level); ?></b></span>
          </div>
        </li>
      </ol>

	<div class="container-fluid">
		<div id="ui-view" style="opacity: 1;">
			<div class="animated fadeIn">
				<h4 style="text-align: center">DOCUMENT SHIPPING</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header">
						<span class="btn btn-flat btn-primary" data-toggle="modal" data-target="#addDoc">ADD MASTER DOCUMENT</span>
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
								<td style="font-weight: bold;">Category</td>
								<td style="font-weight: bold;">Document Name</td>
								<td style="font-weight: bold;">Action</td>
							</tr>
						</thead>
						<tbody>
							<?php 
						    	$sql = "SELECT * FROM sch_master_document_shipping ORDER BY category ASC";
								$usr = $object->fetch_all($sql);
								if (count($usr) > 0) {
									$number = 1;
									foreach ($usr as $job) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $job['category'] ?></td>
								<td><?= $job['document_name'] ?></td>
								<td align="center">
									<span class="btn btn-flat btn-primary btn-sm" data-toggle="modal" data-target="#editDoc<?php echo $job['id']?>"><i class="fa fa-edit"></i></span>
									<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-shipping-document/<?php echo $job['id']?>" onclick="return confirm('Confirm delete ?')">
									<i class="fa fa-trash-o "></i>
									</a>
								</td>
							</tr>

							<!-- Modal -->
							<div class="modal" id="editDoc<?php echo $job['id']?>" tabindex="-1" role="dialog" aria-labelledby="editDoc<?php echo $job['id']?>" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered" role="document">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLongTitle">Edit Master Document</h5>
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
						                      <label class="col-md-4 col-form-label" for="category">Category</label>
						                      <div class="col-md-8">
						                        <select name="category" id="category" class="form-control">
						                          <option selected>- Choose Category -</option>
						                          <option value="Deck Officer" <?php if($job['category'] == "Deck Officer"){echo "selected";} ?>>Deck Officer</option>
						                          <option value="Deck Officer Junior" <?php if($job['category'] == "Deck Officer Junior"){echo "selected";} ?>>Deck Officer Junior</option>
						                          <option value="Deck Officer Senior" <?php if($job['category'] == "Deck Officer Senior"){echo "selected";} ?>>Deck Officer Senior</option>
						                          <option value="Deck Rating" <?php if($job['category'] == "Deck Rating"){echo "selected";} ?>>Deck Rating</option>
						                          <option value="Deck Rating Senior" <?php if($job['category'] == "Deck Rating Senior"){echo "selected";} ?>>Deck Rating Senior</option>
						                          <option value="Engine Officer" <?php if($job['category'] == "Engine Officer"){echo "selected";} ?>>Engine Officer</option>
						                          <option value="Engine Officer Trainee" <?php if($job['category'] == "Engine Officer Trainee"){echo "selected";} ?>>Engine Officer Trainee</option>
						                          <option value="Engine Officer Junior" <?php if($job['category'] == "Engine Officer Junior"){echo "selected";} ?>>Engine Officer Junior</option>
						                          <option value="Engine Officer Senior" <?php if($job['category'] == "Engine Officer Senior"){echo "selected";} ?>>Engine Officer Senior</option>
						                          <option value="Engine Rating" <?php if($job['category'] == "Engine Rating"){echo "selected";} ?>>Engine Rating</option>
						                        </select>
						                      </div>
						                     </div>

							                 <div class="form-group row">
							                  <label class="col-md-4 col-form-label" for="docName">Document Name</label>
							                  <div class="col-md-8">
							                    <input type="text" class="form-control" id="docName" name="docName" value="<?= $job['document_name'] ?>">
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
	<div class="modal" id="addDoc" tabindex="-1" role="dialog" aria-labelledby="addDoc" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Master Document</h5>
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
                      <label class="col-md-4 col-form-label" for="category">Category</label>
                      <div class="col-md-8">
                        <select name="category" id="category" class="form-control">
                          <option selected>- Choose Category -</option>
                          <option value="Deck Officer">Deck Officer</option>
                          <option value="Deck Officer Junior">Deck Officer Junior</option>
                          <option value="Deck Officer Senior">Deck Officer Senior</option>
                          <option value="Deck Rating">Deck Rating</option>
                          <option value="Deck Rating Senior">Deck Rating Senior</option>
                          <option value="Engine Officer">Engine Officer</option>
                          <option value="Engine Officer Trainee">Engine Officer Trainee</option>
                          <option value="Engine Officer Junior">Engine Officer Junior</option>
                          <option value="Engine Officer Senior">Engine Officer Senior</option>
                          <option value="Engine Rating">Engine Rating</option>
                        </select>
                      </div>
                     </div>

                   <div class="form-group row">
	                  <label class="col-md-4 col-form-label" for="docName">Document Name</label>
	                  <div class="col-md-8" id="table-common">
	                  	<a onclick="tambah()" style="cursor:pointer;text-decoration:underline;">Add more</a><br/>
	                    <input type="text" class="form-control" id="docName" name="docName[]">
	                    
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

<script>
  function tambah(){
  $("#table-common").append('<input type="text" class="form-control" id="docName" name="docName[]">').children(':last');
  }
</script>