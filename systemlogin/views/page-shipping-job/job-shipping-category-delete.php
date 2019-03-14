<?php
if(isset($_GET['ids'])){ 
	$namatable = 'sch_job_shipping_cat';

  	$conditions = array('id' =>strip_tags($_GET['ids']));
 	$delete = $object->deleteedata($namatable,$conditions);
	$object->messageshps($delete);

	echo "<script> window.location.assign('".$object->base_path()."shipping-category');</script>";
}