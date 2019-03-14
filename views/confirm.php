<?php

	if (!isset($_GET['email']) || !isset($_GET['token'])) {
		redirect();

	} else {
		
		$email = trim($_GET['email']);
		
		$token = trim($_GET['token']);

		$sql = "SELECT id FROM sch_candidate_user WHERE email='$email' AND token='$token' AND account_status='0'";
		
		$count  = $object->fetch_all($sql);
		
		if (count($count) > 0) {

			$update="UPDATE sch_candidate_user SET account_status='1', token='' WHERE email='$email'";

            $object->edit($update);

			echo 'alertify.alert("<b>Success</b>", "Your email has been verified! You can login now!")';
			echo "<script> window.location.assign('".$halaman->base_path()."login');</script>";
		
		} else
			echo "<script> window.location.assign('".$halaman->base_path()."login');</script>";
	}
?>