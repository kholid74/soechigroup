  <?php

    $sql  = 'SELECT * FROM sch_declaration WHERE section="office"';
    $data = $object->fetch($sql);
    if (!empty($data)){
    if(isset($_POST['_publish'])){ 
        $namatable = 'sch_declaration';
        $data = array(
            'value'=>$_POST['value'],
      );
        $conditions = array('id' =>strip_tags($_POST['id']));
        $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Data has been updated successfully.':'Some problem occurred, please try again.';
        @$msg = $_SESSION['statusMsg'] = $statusMsg;
        echo "<script> window.location.assign('".$object->base_path()."master-declaration-office'); </script>";
    }}

?>
<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item active">Jobs</li>
        <li class="breadcrumb-item"><a href="<?php echo $object->base_path()?>job-category">Job Category</a></li>
        <li class="breadcrumb-item active">Edit Job Category</li>

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
				<h4 style="text-align: center"><i class="fa fa-settings"></i> TEXT DECLARATION</h4>
				<div class="col-md-8 offset-md-2">
	              <div class="card">
	             	<div class="card-header"></div>
	                <div class="card-body">
                    <form role="form" method="POST" enctype="multipart/form-data">
	                  
                    <div class="form-group row">

                      <textarea class="form-control" name="value" id="content" cols="30" rows="10"><?= $data['value']?></textarea>
                      <span class="help-block"></span>

                     </div>

	                </div>
	                <div class="card-footer">
                    <input type="hidden" name="id" value="<?php echo $data['id']?>">
	                  <input type="submit" name="_publish"  class="btn btn-md btn-primary" value="SAVE" />
	                </div>
                  </form>
	              </div>
	            </div>
			</div>
		</div>
	</div>