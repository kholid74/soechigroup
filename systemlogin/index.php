<?php error_reporting(0);
define('BASE_URL', "http://".$_SERVER['HTTP_HOST'].'/');
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../controller/Autoloader.php';
include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'../controller/auth-login.php';


$auth = new auth_login();
if(!$auth->is_loggedin()){
	$auth->redirect('login.php');
}

$uid = $_SESSION['user_session'];
$sql = "SELECT * FROM sch_user WHERE id='".$uid."'";
$authadmin = $object->fetch($sql);

$level = $authadmin['level'];

@$page=$_GET['page'];
$halaman = $page ? $page : 'Dashboard';

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/layouts/header.php';

if(@$_GET['page']==''):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-dashboard/index.php';

elseif(@$_GET['page']=='user-settings'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-user/user-list.php';

elseif(@$_GET['page']=='add-user'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-user/user-add.php';

elseif(@$_GET['page']=='edit-user'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-user/user-edit.php';

elseif(@$_GET['page']=='delete-user'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-user/user-delete.php';

elseif(@$_GET['page']=='manage-menu'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-user/menu.php';

elseif(@$_GET['page']=='delete-menu'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-user/menu-delete.php';

elseif(@$_GET['page']=='menu-role'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-user/menu-role.php';

/*shipping*/

elseif(@$_GET['page']=='list-vacancy-shipping'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-job/job-shipping.php';

elseif(@$_GET['page']=='add-job-shipping'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-job/job-shipping-add.php';

elseif(@$_GET['page']=='edit-job-shipping'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-job/job-shipping-edit.php';

elseif(@$_GET['page']=='delete-job-shipping'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-job/job-shipping-delete.php';

elseif(@$_GET['page']=='shipping-category'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-job/job-shipping-category.php';

elseif(@$_GET['page']=='add-shipping-category'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-job/job-shipping-category-add.php';

elseif(@$_GET['page']=='edit-shipping-category'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-job/job-shipping-category-edit.php';

elseif(@$_GET['page']=='delete-shipping-category'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-job/job-shipping-category-delete.php';

elseif(@$_GET['page']=='shipping-candidate-pending'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-pending.php';

elseif(@$_GET['page']=='shipping-candidate-pending-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-pending-details.php';

elseif(@$_GET['page']=='shipping-candidate-shortlisted'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-shortlisted.php';

elseif(@$_GET['page']=='shipping-candidate-shortlisted-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-shortlisted-details.php';

elseif(@$_GET['page']=='shipping-candidate-rejected'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-rejected.php';

elseif(@$_GET['page']=='shipping-candidate-rejected-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-rejected-details.php';

elseif(@$_GET['page']=='shipping-candidate-online-test'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-online-test.php';

elseif(@$_GET['page']=='shipping-candidate-online-test-detail'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-online-test-details.php';

elseif(@$_GET['page']=='shipping-candidate-interview-passed'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-interview-passed.php';

elseif(@$_GET['page']=='shipping-candidate-interview-failed'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-interview-failed.php';

elseif(@$_GET['page']=='shipping-candidate-interview-passed-detail'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-interview-passed-detail.php';

elseif(@$_GET['page']=='shipping-candidate-interview-failed-detail'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-candidate/shipping-candidate-interview-failed-detail.php';

elseif(@$_GET['page']=='shipping-excrew-candidate-pending'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-excrew/shipping-excrew-pending.php';

elseif(@$_GET['page']=='excrew-pending-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-excrew/shipping-excrew-pending-details.php';

elseif(@$_GET['page']=='shipping-excrew-candidate-shortlisted'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-excrew/shipping-excrew-shortlisted.php';

elseif(@$_GET['page']=='excrew-shortlisted-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-excrew/shipping-excrew-shortlisted-details.php';

elseif(@$_GET['page']=='excrew-rejected-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-excrew/shipping-excrew-rejected-details.php';

elseif(@$_GET['page']=='shipping-excrew-candidate-rejected'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-excrew/shipping-excrew-rejected.php';

elseif(@$_GET['page']=='s-interview-schedule-pending'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-interview/shipping-interview-pending.php';

elseif(@$_GET['page']=='s-interview-schedule-pending-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-interview/shipping-interview-pending-details.php';

elseif(@$_GET['page']=='s-interview-schedule-approved'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-interview/shipping-interview-approved.php';

elseif(@$_GET['page']=='s-interview-schedule-approved-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-interview/shipping-interview-approved-details.php';

elseif(@$_GET['page']=='s-interview-schedule-rejected'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-interview/shipping-interview-rejected.php';

elseif(@$_GET['page']=='shipping-reports'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-shipping-reports/shipping-reports.php';

/*end shipping*/

/*office*/

elseif(@$_GET['page']=='list-vacancy-office'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-job/job-office.php';

elseif(@$_GET['page']=='add-job-office'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-job/job-office-add.php';

elseif(@$_GET['page']=='edit-job-office'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-job/job-office-edit.php';

elseif(@$_GET['page']=='delete-job-office'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-job/job-office-delete.php';

elseif(@$_GET['page']=='office-candidate-pending'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-pending.php';

elseif(@$_GET['page']=='office-candidate-pending-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-pending-details.php';

elseif(@$_GET['page']=='office-candidate-shortlisted'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-shortlisted.php';

elseif(@$_GET['page']=='office-candidate-shortlisted-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-shortlisted-details.php';

elseif(@$_GET['page']=='office-candidate-rejected'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-rejected.php';

elseif(@$_GET['page']=='office-candidate-rejected-details'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-rejected-details.php';

elseif(@$_GET['page']=='office-candidate-interview-passed'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-interview-passed.php';

elseif(@$_GET['page']=='office-candidate-interview-detail'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-interview-detail.php';

elseif(@$_GET['page']=='office-candidate-interview-failed'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-interview-failed.php';

elseif(@$_GET['page']=='o-interview-schedule-pending'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-interview/office-interview-pending.php';

elseif(@$_GET['page']=='o-interview-schedule-approved'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-interview/office-interview-approved.php';

elseif(@$_GET['page']=='o-interview-schedule-rejected'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-interview/office-interview-rejected.php';

elseif(@$_GET['page']=='office-candidate-print'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-candidate/office-candidate-print.php';

elseif(@$_GET['page']=='office-reports'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-office-reports/office-reports.php';

/*end office*/

elseif(@$_GET['page']=='account-settings'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-account/account-settings.php';

elseif(@$_GET['page']=='master-declaration-shipping'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/shipping-declaration.php';

elseif(@$_GET['page']=='master-declaration-office'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/office-declaration.php';

elseif(@$_GET['page']=='master-crew-rank'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/crew-rank.php';

elseif(@$_GET['page']=='delete-crew-rank'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/crew-rank-delete.php';

elseif(@$_GET['page']=='master-vessel'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/vessel.php';

elseif(@$_GET['page']=='delete-vessel'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/vessel-delete.php';

elseif(@$_GET['page']=='master-reason-reject'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/reason-reject.php';

elseif(@$_GET['page']=='delete-reason-reject'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/reason-reject-delete.php';

elseif(@$_GET['page']=='master-job-name'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/job-name.php';

elseif(@$_GET['page']=='delete-job-name'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/job-name-delete.php';

elseif(@$_GET['page']=='master-shipping-document'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/document-shipping.php';

elseif(@$_GET['page']=='delete-shipping-document'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/document-shipping-delete.php';

elseif(@$_GET['page']=='master-email-boc'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/email-boc.php';

elseif(@$_GET['page']=='master-data'):
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-master/master-data.php';

else:
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/page-dashboard/index.php';
endif;

include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'views/layouts/footer.php';