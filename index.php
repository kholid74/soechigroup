<?php
	// Path constants
	ini_set('default_charset', 'UTF-8');
	$dir = realpath(dirname(__FILE__));
	defined('PROJECT_BASE') OR define('PROJECT_BASE', realpath($dir.'/'));
	include_once PROJECT_BASE.DIRECTORY_SEPARATOR.'controller/Autoloader'.'.php';
	include_once dirname(__FILE__).DIRECTORY_SEPARATOR.'controller/auth-login.php';

	$auth = new auth_login();

	$page  = $mypage="";
	@$page = $halaman->xss_cleaner($_GET['page']);
	$mypage.= $page ? $page : 'Home';

	

	/*header*/
	include_once $halaman->getload('views/layouts/header');

	if ($page == '') :
		include_once $halaman->getload('views/home');

	elseif ($page == 'job-type') :
		include_once $halaman->getload('views/job-type.php');

	elseif ($page == 'job-shipping') :
		include_once $halaman->getload('views/list-job-shipping.php');

	elseif ($page == 'job-office') :
		include_once $halaman->getload('views/list-job-office.php');

	elseif ($page == 'detail-shipping') :
		include_once $halaman->getload('views/view-job-shipping.php');

	elseif ($page == 'detail-office') :
		include_once $halaman->getload('views/view-job-office.php');

	elseif ($page == 'excrew-personal-data') :
		include_once $halaman->getload('views/apply-shipping-excrew-personal-data.php');

	elseif ($page == 'excrew-agreement') :
		include_once $halaman->getload('views/apply-shipping-excrew-agreement.php');

	elseif ($page == 'excrew-preview') :
		include_once $halaman->getload('views/apply-shipping-excrew-preview.php');

	elseif ($page == 'shipping-personal-data') :
		include_once $halaman->getload('views/apply-shipping-personal-data.php');

	elseif ($page == 'shipping-document-upload') :
		include_once $halaman->getload('views/apply-shipping-document-uploads.php');

	elseif ($page == 'shipping-declaration') :
		include_once $halaman->getload('views/apply-shipping-declaration.php');

	elseif ($page == 'shipping-preview') :
		include_once $halaman->getload('views/apply-shipping-preview.php');

	elseif ($page == 'office-personal-data') :
		include_once $halaman->getload('views/apply-office-personal-data.php');

	elseif ($page == 'office-address') :
		include_once $halaman->getload('views/apply-office-address.php');

	elseif ($page == 'office-formal-education') :
		include_once $halaman->getload('views/apply-office-formal-education.php');

	elseif ($page == 'delete-education') :
		include_once $halaman->getload('views/delete-education.php');

	elseif ($page == 'delete-course') :
		include_once $halaman->getload('views/delete-course.php');

	elseif ($page == 'office-family-member') :
		include_once $halaman->getload('views/apply-office-family-member.php');

	elseif ($page == 'delete-family') :
		include_once $halaman->getload('views/delete-family.php');

	elseif ($page == 'delete-emergency') :
		include_once $halaman->getload('views/delete-emergency.php');

	elseif ($page == 'office-general-information') :
		include_once $halaman->getload('views/apply-office-general-information.php');

	elseif ($page == 'office-work-experience') :
		include_once $halaman->getload('views/apply-office-work-experience.php');

	elseif ($page == 'delete-experience') :
		include_once $halaman->getload('views/delete-experience.php');

	elseif ($page == 'office-reference') :
		include_once $halaman->getload('views/apply-office-reference.php');

	elseif ($page == 'delete-reference') :
		include_once $halaman->getload('views/delete-reference.php');

	elseif ($page == 'office-document-upload') :
		include_once $halaman->getload('views/apply-office-document-uploads.php');

	elseif ($page == 'office-agreement') :
		include_once $halaman->getload('views/apply-office-declaration.php');

	elseif ($page == 'office-preview') :
		include_once $halaman->getload('views/apply-office-preview.php');

	elseif ($page == 'email-verification') :
		include_once $halaman->getload('views/email-verification.php');

	elseif ($page == 'excrew-verification') :
		include_once $halaman->getload('views/excrew-verification.php');

	elseif ($page == 'verify-code') :
		include_once $halaman->getload('views/input-code.php');

	elseif ($page == 'excrew-verify-code') :
		include_once $halaman->getload('views/excrew-input-code.php');

	elseif ($page == 'login') :
		include_once $halaman->getload('views/login.php');

	elseif ($page == 'confirm') :
		include_once $halaman->getload('views/confirm.php');

	elseif ($page == 'forgot-password') :
		include_once $halaman->getload('views/forgot-password.php');

	elseif ($page == 'thank-you') :
		include_once $halaman->getload('views/thank-you.php');

	elseif ($page == 'detect') :
		include_once $halaman->getload('views/detect.php');

	elseif ($page == 'detect-crew') :
		include_once $halaman->getload('views/detect-crew.php');

	else:
		include_once $halaman->getload('views/home');
	
	endif;

	/*footer*/
	include_once $halaman->getload('views/layouts/footer');