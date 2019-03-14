<?php 

    //$data = $object->fetch($sql);

	if(isset($_POST['_save'])) { 
	    $namatable = 'sch_menu_role';

	$jumlah_dipilih = count($_POST['checkmenu']);
 
	for($x=0;$x<$jumlah_dipilih;$x++){
		$data = array(
		      'id_user'=>$_GET['ids'],
		      'id_menu'=>$_POST['checkmenu'][$x],
		      'status'=>'true'
		    ); 
		    $insert = $object->tambahdata($namatable,$data);
	}
	    
	    $object->messagesin($insert);
	    echo "<script> window.location.assign('".$object->base_path()."user-settings');</script>";
	        
	  }

 ?>

<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">User Settings</li>
        <li class="breadcrumb-item active">Menu Role</li>

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
				<h4 style="text-align: center">MENU ROLE</h4>
				<div class="card">
					<div class="card-header">
						<!-- <span class="btn btn-flat btn-primary" data-toggle="modal" data-target="#addMenu">ADD ROLE</span> -->
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

					<div class="col-md-6 offset-md-3">

						<!-- <table class="table table-responsive-sm table-bordered table-striped table-sm" id="">
						<thead>
							<tr>
								<td align="center" style="font-weight: bold;">No</td>
								<td align="center" style="font-weight: bold;">Menu Name</td>
								<td align="center" style="font-weight: bold;">Menu Link</td>
								<td align="center" style="font-weight: bold;">Menu Category</td>
								<td align="center" style="font-weight: bold;">Select</td>
								<td style="font-weight: bold;">Action</td>
							</tr>
						</thead>
						<form role="form" method="POST" enctype="multipart/form-data">
						<tbody>
							<?php 
						    	$sql  = 'SELECT a.*,b.menu_name,b.menu_for,b.menu_link FROM sch_menu_role a JOIN sch_menu b ON a.id_menu=b.id WHERE a.id_user="'.$_GET['ids'].'"';
								$usr = $object->fetch_all($sql);
								if (count($usr) > 0) {
									$number = 1;
									foreach ($usr as $user) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $user['menu_name'] ?></td>
								<td><?= $user['menu_link'] ?></td>
								<td><?= $user['menu_for'] ?></td>
								<td align="center"><input type="checkbox" name="selectMenu" value="<?= $user['status'] ?>" <?php if($user['status'] == "true"){echo "checked";} ?>></td>
							</tr>
						
							<?php
											    	$number++;
											    	}}?>
						</tbody>
											</table> -->

						<table class="table table-responsive-sm table-bordered table-striped table-sm" id="">
						<thead>
							<tr>
								<td align="center" style="font-weight: bold;">No</td>
								<td align="center" style="font-weight: bold;">Menu Name</td>
								<td align="center" style="font-weight: bold;">Menu Link</td>
								<td align="center" style="font-weight: bold;">Menu Category</td>
								<td align="center" style="font-weight: bold;">Select</td>
								<!-- <td style="font-weight: bold;">Action</td> -->
							</tr>
						</thead>
						<form role="form" method="POST" enctype="multipart/form-data">
						<tbody>
							<?php 
						    	$sql  = 'SELECT * FROM sch_menu ORDER BY modified ASC';
								$usr = $object->fetch_all($sql);
								if (count($usr) > 0) {
									$number = 1;
									foreach ($usr as $user) {?>
							<tr>
								<td><?php echo $number;?></td>
								<td><?= $user['menu_name'] ?></td>
								<td><?= $user['menu_link'] ?></td>
								<td><?= $user['menu_for'] ?></td>
								<td align="center"><input type="checkbox" name="checkmenu[]" value="<?= $user['id'] ?>"></td>
							</tr>

							<?php
					    	$number++;
					    	}}?>
						</tbody>
					</table>
					<br>
					<center><input type="submit" class="btn btn-primary" name="_save" value="SAVE"></center>
					</form>
					<br>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>

	