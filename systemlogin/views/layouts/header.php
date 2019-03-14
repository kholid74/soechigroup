<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="Soechi Lines E-Recruitment System">
  <meta name="author" content="Soechi">
  <meta name="keyword" content="Soechi Lines E-Recruitment System">
  <link rel="shortcut icon" href="assets/img/favicon.png">
  <title>Soechi Lines - E-Recruitment</title>

  <!-- Icons -->
  <link href="<?php echo $object->base_path()?>assets/icon/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <link href="<?php echo $object->base_path()?>assets/icon/simple-line-icons/css/simple-line-icons.css" rel="stylesheet">

  <!-- Main styles for this application -->
  <link href="<?php echo $object->base_path()?>assets/css/style.css" rel="stylesheet">
  <link href="<?php echo $object->base_path()?>assets/css/custom.css" rel="stylesheet">
  <!-- Styles required by this views -->

  <link href="<?php echo $object->base_path()?>assets/plugin/DataTables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?php echo $object->base_path()?>assets/plugin/fullcalendar/fullcalendar.css" rel="stylesheet">
  
</head>

<body class="app header-fixed sidebar-fixed aside-menu-fixed aside-menu-hidden">
  <header class="app-header navbar">
    <button class="navbar-toggler mobile-sidebar-toggler d-lg-none mr-auto" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>
    <a class="navbar-brand" href="<?php echo $object->base_path()?>"></a>
    <button class="navbar-toggler sidebar-toggler d-md-down-none" type="button">
      <span class="navbar-toggler-icon"></span>
    </button>


    <ul class="nav navbar-nav ml-auto">
     <li class="nav-item d-md-down-none ">
        <span>Hi <b><?php echo $authadmin['username']?></b></span>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          <img src="<?php echo $object->base_path()?>assets/img/avatars/6.png" class="img-avatar" alt="">
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Settings</strong>
          </div>
          <a class="dropdown-item" href="#"><i class="fa fa-user"></i> Profile</a>
          <a class="dropdown-item" href="#"><i class="fa fa-wrench"></i> Settings</a>
          <a class="dropdown-item" href="<?php echo $object->base_path()?>logout.php" onclick="return confirm('Confirm Logout ?');"><i class="fa fa-lock"></i> Logout</a>
        </div>
      </li>
      <li style="color: #FFFFFF">0000</li>
    </ul>
    
  </header>

  <div class="app-body">
    <div class="sidebar">
      <nav class="sidebar-nav">
        <ul class="nav">
         
         <!-- 

          Show menu based on user login and user type 

          Level 1 = Superadmin => all menu based on user type
          Level 2 = Manager => dashboard, module candidate, *module excrew, module report
          Level 3 = HR => dashboard, module candidate, module excrew, module interview, module report
          Level 4 = Staff => Dashboard, module job
          Level 5 = Security => dashboard interview schedule

          *only for shipping
          -->

          <?php 
            if($authadmin['level'] == '1' AND $authadmin['user_type'] == 'shipping') //superadmin shipping
            {
          ?>

          <li class="nav-title">
            MENU SHIPPING
          </li>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $object->base_path()?>"><i class="icon-home"></i> Dashboard </a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($page == "list-vacancy-shipping" OR $page == "add-job-shipping" OR $page == "edit-job-shipping" OR $page == "shipping-category"){echo "active";}?>" href="<?php echo $object->base_path()?>list-vacancy-shipping"><i class="icon-anchor"></i>List Vacancy</a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($page == "shipping-candidate-pending" OR $page == "shipping-candidate-pending-details" OR $page == "shipping-candidate-shortlisted" OR $page == "shipping-candidate-shortlisted-details" OR $page == "shipping-candidate-rejected" OR $page == "shipping-candidate-rejected-details" OR $page == "shipping-candidate-interview-passed" OR $page == "shipping-candidate-interview-passed-details" OR $page == "shipping-candidate-interview-failed" OR $page == "shipping-candidate-interview-failed-details" OR $page == "shipping-candidate-online-test" OR $page == "shipping-candidate-online-test-detail"){echo "active";}?>" href="<?php echo $object->base_path()?>shipping-candidate-pending"><i class="icon-anchor"></i>Candidate</a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link <?php if($page == "shipping-excrew-candidate-pending" OR $page == "excrew-pending-details" OR $page == "excrew-shortlisted"){echo "active";}?>" href="<?php echo $object->base_path()?>shipping-excrew-candidate-pending"><i class="icon-anchor"></i>Ex-Crew</a>
              </li>
            
              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>s-interview-schedule-pending" class="nav-link <?php if($page == "s-interview-schedule-pending" OR $page == "s-interview-schedule-approved" OR $page == "s-interview-schedule-rejected"){echo "active";}?>"><i class="icon-anchor"></i> Interview Schedule</a>
              </li>

              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>shipping-reports" class="nav-link"><i class="icon-chart"></i> Reports</a>
              </li>

               <li class="nav-title">
                OTHERS
              </li>

                <li class="nav-item">
                  <a href="<?php echo $object->base_path()?>user-settings" class="nav-link <?php if($page == "user-settings" OR $page == "add-user" OR $page == "edit-user" OR $page == "manage-menu" OR $page == "menu-role"){echo "active";}?>"><i class="icon-user"></i> User Settings</a>
                </li>
                
                <li class="nav-item">
                  <a href="<?php echo $object->base_path()?>master-data" class="nav-link <?php if($page == "master-data" OR $page == "master-declaration-shipping" OR $page == "master-declaration-office" OR $page == "master-crew-rank" OR $page == "master-vessel" OR $page == "master-reason-reject" OR $page == "master-job-name"){echo "active";}?>"><i class="icon-folder"></i> Master Data</a>
                </li>

                <li class="nav-item">
                  <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings"></i> Account Settings</a>
                </li>
          
      <?php }
            elseif($authadmin['level'] == '2' AND $authadmin['user_type'] == 'shipping') //manager shipping
            {
          ?>

          <li class="nav-title">
            MENU SHIPPING
          </li>

          <li class="nav-item">
            <a class="nav-link" href="<?php echo $object->base_path()?>"><i class="icon-home"></i> Dashboard </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php if($page == "shipping-candidate-pending" OR $page == "shipping-candidate-pending-details" OR $page == "shipping-candidate-shortlisted" OR $page == "shipping-candidate-shortlisted-details" OR $page == "shipping-candidate-rejected" OR $page == "shipping-candidate-rejected-details" OR $page == "shipping-candidate-interview-passed" OR $page == "shipping-candidate-interview-passed-details" OR $page == "shipping-candidate-interview-failed" OR $page == "shipping-candidate-interview-failed-details" OR $page == "shipping-candidate-online-test" OR $page == "shipping-candidate-online-test-detail"){echo "active";}?>" href="<?php echo $object->base_path()?>shipping-candidate-pending"><i class="icon-anchor"></i>Candidate</a>
          </li>
        
          <li class="nav-item">
            <a class="nav-link <?php if($page == "shipping-excrew-candidate-pending" OR $page == "excrew-pending-details" OR $page == "excrew-shortlisted"){echo "active";}?>" href="<?php echo $object->base_path()?>shipping-excrew-candidate-pending"><i class="icon-anchor"></i>Ex-Crew</a>
          </li>

          <li class="nav-item">
            <a href="<?php echo $object->base_path()?>shipping-reports" class="nav-link"><i class="icon-chart"></i> Reports</a>
          </li>

          <li class="nav-item">
            <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings"></i> Account Settings</a>
          </li>
          
      <?php }
            elseif($authadmin['level'] == '3' AND $authadmin['user_type'] == 'shipping') //HR shipping
            { ?>

              <li class="nav-title">
                MENU SHIPPING
              </li>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $object->base_path()?>"><i class="icon-home"></i> Dashboard </a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($page == "shipping-candidate-pending" OR $page == "shipping-candidate-pending-details" OR $page == "shipping-candidate-shortlisted" OR $page == "shipping-candidate-shortlisted-details" OR $page == "shipping-candidate-rejected" OR $page == "shipping-candidate-rejected-details" OR $page == "shipping-candidate-interview-passed" OR $page == "shipping-candidate-interview-passed-details" OR $page == "shipping-candidate-interview-failed" OR $page == "shipping-candidate-interview-failed-details" OR $page == "shipping-candidate-online-test" OR $page == "shipping-candidate-online-test-detail"){echo "active";}?>" href="<?php echo $object->base_path()?>shipping-candidate-pending"><i class="icon-anchor"></i>Candidate</a>
              </li>
            
              <li class="nav-item">
                <a class="nav-link <?php if($page == "shipping-excrew-candidate-pending" OR $page == "excrew-pending-details" OR $page == "excrew-shortlisted"){echo "active";}?>" href="<?php echo $object->base_path()?>shipping-excrew-candidate-pending"><i class="icon-anchor"></i>Ex-Crew</a>
              </li>
            
              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>s-interview-schedule-pending" class="nav-link <?php if($page == "s-interview-schedule-pending" OR $page == "s-interview-schedule-approved" OR $page == "s-interview-schedule-rejected"){echo "active";}?>"><i class="icon-anchor"></i> Interview Schedule</a>
              </li>

              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>shipping-reports" class="nav-link"><i class="icon-chart"></i> Reports</a>
              </li>

                <li class="nav-item">
                  <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings"></i> Account Settings</a>
                </li>

      <?php }
            elseif($authadmin['level'] == '4' AND $authadmin['user_type'] == 'shipping') //staf shipping
            { ?>

              <li class="nav-title">
                MENU SHIPPING
              </li>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $object->base_path()?>"><i class="icon-home"></i> Dashboard </a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($page == "list-vacancy-shipping" OR $page == "add-job-shipping" OR $page == "edit-job-shipping" OR $page == "shipping-category"){echo "active";}?>" href="<?php echo $object->base_path()?>list-vacancy-shipping"><i class="icon-anchor"></i>List Vacancy</a>
              </li>

              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings"></i> Account Settings</a>
              </li>

      <?php }
            elseif($authadmin['level'] == '1' AND $authadmin['user_type'] == 'office') //superadmin office
            { ?>

              <li class="nav-title">
                MENU OFFICE
              </li>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $object->base_path()?>"><i class="icon-home"></i> Dashboard </a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($page == "list-vacancy-office" OR $page == "add-job-office" OR $page == "edit-job-office"){echo "active";}?>" href="<?php echo $object->base_path()?>list-vacancy-office"><i class="icon-briefcase"></i>List Vacancy</a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($page == "office-candidate-pending" OR $page == "office-candidate-pending-details" OR $page == "office-candidate-shortlisted" OR $page == "office-candidate-shortlisted-details" OR $page == "office-candidate-rejected" OR $page == "office-candidate-rejected-details" OR $page == "office-candidate-interview-passed" OR $page == "office-candidate-interview-details" OR $page == "office-candidate-interview-failed"){echo "active";}?>" href="<?php echo $object->base_path()?>office-candidate-pending"><i class="icon-briefcase"></i>Candidate</a>
              </li>

               <li class="nav-item">
                <a href="<?php echo $object->base_path()?>o-interview-schedule-pending" class="nav-link <?php if($page == "o-interview-schedule-pending" OR $page == "o-interview-schedule-approved" OR $page == "o-interview-schedule-rejected"){echo "active";}?>"><i class="icon-briefcase"></i> Interview Schedule</a>
              </li>

               <li class="nav-item">
                <a href="<?php echo $object->base_path()?>office-reports" class="nav-link"><i class="icon-chart"></i> Reports</a>
              </li> 

            <li class="nav-title">
              OTHERS
            </li>

              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>user-settings" class="nav-link <?php if($page == "user-settings" OR $page == "add-user" OR $page == "edit-user" OR $page == "manage-menu" OR $page == "menu-role"){echo "active";}?>"><i class="icon-user"></i> User Settings</a>
              </li>
              
              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>master-data" class="nav-link <?php if($page == "master-data" OR $page == "master-declaration-shipping" OR $page == "master-declaration-office" OR $page == "master-crew-rank" OR $page == "master-vessel" OR $page == "master-reason-reject" OR $page == "master-job-name"){echo "active";}?>"><i class="icon-folder"></i> Master Data</a>
              </li>

              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings"></i> Account Settings</a>
              </li>

      <?php }
            elseif($authadmin['level'] == '2' AND $authadmin['user_type'] == 'office') //manager office
            { ?>

              <li class="nav-title">
                MENU OFFICE
              </li>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $object->base_path()?>"><i class="icon-home"></i> Dashboard </a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($page == "office-candidate-pending" OR $page == "office-candidate-pending-details" OR $page == "office-candidate-shortlisted" OR $page == "office-candidate-shortlisted-details" OR $page == "office-candidate-rejected" OR $page == "office-candidate-rejected-details" OR $page == "office-candidate-interview-passed" OR $page == "office-candidate-interview-details" OR $page == "office-candidate-interview-failed"){echo "active";}?>" href="<?php echo $object->base_path()?>office-candidate-pending"><i class="icon-briefcase"></i>Candidate</a>
              </li>

               <li class="nav-item">
                <a href="<?php echo $object->base_path()?>office-reports" class="nav-link"><i class="icon-chart"></i> Reports</a>
              </li> 

                <li class="nav-item">
                  <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings"></i> Account Settings</a>
                </li>

      <?php }
            elseif($authadmin['level'] == '3' AND $authadmin['user_type'] == 'office') //HR office
            { ?>

              <li class="nav-title">
                MENU OFFICE
              </li>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $object->base_path()?>"><i class="icon-home"></i> Dashboard </a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($page == "office-candidate-pending" OR $page == "office-candidate-pending-details" OR $page == "office-candidate-shortlisted" OR $page == "office-candidate-shortlisted-details" OR $page == "office-candidate-rejected" OR $page == "office-candidate-rejected-details" OR $page == "office-candidate-interview-passed" OR $page == "office-candidate-interview-details" OR $page == "office-candidate-interview-failed"){echo "active";}?>" href="<?php echo $object->base_path()?>office-candidate-pending"><i class="icon-briefcase"></i>Candidate</a>
              </li>

               <li class="nav-item">
                <a href="<?php echo $object->base_path()?>o-interview-schedule-pending" class="nav-link <?php if($page == "o-interview-schedule-pending" OR $page == "o-interview-schedule-approved" OR $page == "o-interview-schedule-rejected"){echo "active";}?>"><i class="icon-briefcase"></i> Interview Schedule</a>
              </li>

               <li class="nav-item">
                <a href="<?php echo $object->base_path()?>office-reports" class="nav-link"><i class="icon-chart"></i> Reports</a>
              </li> 

              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings"></i> Account Settings</a>
              </li>

      <?php }
            elseif($authadmin['level'] == '4' AND $authadmin['user_type'] == 'office') //staff office
            { ?>

              <li class="nav-title">
                MENU OFFICE
              </li>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $object->base_path()?>"><i class="icon-home"></i> Dashboard </a>
              </li>

              <li class="nav-item">
                <a class="nav-link <?php if($page == "list-vacancy-office" OR $page == "add-job-office" OR $page == "edit-job-office"){echo "active";}?>" href="<?php echo $object->base_path()?>list-vacancy-office"><i class="icon-briefcase"></i>List Vacancy</a>
              </li>

              <li class="nav-item">
                <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings"></i> Account Settings</a>
              </li>

      <?php }
            elseif($authadmin['level'] == '5') //security
            { ?>

              <li class="nav-item">
                <a class="nav-link" href="<?php echo $object->base_path()?>"><i class="icon-home"></i> Dashboard </a>
              </li>

     <?php }  
          ?>

        </ul>
      </nav>
      <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>