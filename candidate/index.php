<?php
define('BASE_URL', "http://".$_SERVER['HTTP_HOST'].'/soechi/');
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../controller/Autoloader.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../controller/auth-login.php';
$auth = new auth_login();
if(!$auth->is_loggedin()){
	$auth->redirect('login.php');
}

if ($_SESSION['user_category'] == "shipping") {

	$uid = $_SESSION['user_session'];
	$sql = "SELECT * FROM sch_candidate_shipping WHERE candidate_code='".$uid."'";
	$authadmin = $object->fetch($sql);

	@$page=$_GET['page'];
	$halaman = $page ? $page : 'Dashboard';

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/layouts/header.php';

	if(@$_GET['page']==''):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-dashboard/index.php';

	elseif(@$_GET['page']=='profile'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile/profile.php';

	elseif(@$_GET['page']=='personal-info'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile/profile-edit-personal.php';

	elseif(@$_GET['page']=='nex-of-kin-details'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile/profile-edit-nextkin.php';

	elseif(@$_GET['page']=='prejoining-experience'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile/profile-edit-prejoining.php';

	elseif(@$_GET['page']=='initial-declaration'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile/profile-edit-initial-declaration.php';

	elseif(@$_GET['page']=='document-uploads'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile/document-uploads.php';

	elseif(@$_GET['page']=='delete-prejoin-exp'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile/delete-prejoining-exp.php';

	elseif(@$_GET['page']=='application-status'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile/application.php';

	elseif(@$_GET['page']=='interview-schedule'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-interview/interview-schedule.php';

	elseif(@$_GET['page']=='online-test'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-online-test/online-test.php';


	elseif(@$_GET['page']=='account-settings'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-account/account-settings.php';

	else:
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-dashboard/index.php';
	endif;

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/layouts/footer.php';

}else if($_SESSION['user_category'] == "excrew"){

	$uid = $_SESSION['user_session'];
	$sql = "SELECT * FROM sch_ex_candidate WHERE candidate_code='".$uid."'";
	$authadmin = $object->fetch($sql);

	@$page=$_GET['page'];
	$halaman = $page ? $page : 'Dashboard';

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/layouts/header.php';

	if(@$_GET['page']==''):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-dashboard-excrew/index.php';

	elseif(@$_GET['page']=='profile'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-excrew/profile.php';

	elseif(@$_GET['page']=='document-uploads'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-excrew/document-uploads.php';

	elseif(@$_GET['page']=='delete-document-uploads-excrew'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-excrew/delete-document-upload-excrew.php';

	elseif(@$_GET['page']=='account-settings'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-account/account-settings.php';

	else:
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-dashboard-excrew/index.php';
	endif;

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/layouts/footer.php';

}else if($_SESSION['user_category'] == "office"){

	$uid = $_SESSION['user_session'];
	$sql = "SELECT * FROM sch_candidate_office WHERE candidate_code='".$uid."'";
	$authadmin = $object->fetch($sql);

	@$page=$_GET['page'];
	$halaman = $page ? $page : 'Dashboard';

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/layouts/header.php';

	if(@$_GET['page']==''):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-dashboard-office/index.php';

	elseif(@$_GET['page']=='profile'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/profile.php';

	elseif(@$_GET['page']=='personal-info'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/profile-personal-info.php';

	elseif(@$_GET['page']=='address'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/profile-address.php';

	elseif(@$_GET['page']=='formal-education'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/profile-formal-education.php';

	elseif(@$_GET['page']=='delete-education'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/delete-education.php';

	elseif(@$_GET['page']=='delete-course'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/delete-course.php';

	elseif(@$_GET['page']=='family-member'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/profile-family-member.php';

	elseif(@$_GET['page']=='general-information'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/profile-general-information.php';

	elseif(@$_GET['page']=='work-experience'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/profile-work-experience.php';

	elseif(@$_GET['page']=='reference'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/profile-reference.php';

	elseif(@$_GET['page']=='document-uploads'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/profile-document-uploads.php';

	elseif(@$_GET['page']=='interview-schedule'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-interview-office/interview-schedule.php';

	elseif(@$_GET['page']=='application-status'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-profile-office/application.php';

	elseif(@$_GET['page']=='account-settings'):
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-account/account-settings.php';

	else:
		include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-dashboard-office/index.php';
	endif;

	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/layouts/footer.php';
}

