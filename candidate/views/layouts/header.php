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
  <!-- Styles required by this views -->

  <link href="<?php echo $object->base_path()?>assets/plugin/DataTables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css" rel="stylesheet">
  <link href="<?php echo $object->base_path()?>assets/plugin/SmartWizard/dist/css/smart_wizard_theme_circles.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $object->base_path()?>assets/plugin/sweetalert/dist/sweetalert.css" rel="stylesheet" type="text/css" />
  <link href="<?php echo $object->base_path()?>assets/css/alertify.min.css" rel="stylesheet">
  <script src="<?php echo $object->base_path()?>assets/js/alertify.min.js"></script>
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
    
    <?php

      if ($_SESSION['user_category'] == "shipping") {

        $sql = "SELECT photo FROM sch_candidate_shipping WHERE id=".$authadmin['id']."";
        $candidate = $object->fetch($sql);

      }else if ($_SESSION['user_category'] == "office") {

        $sql = "SELECT file_photo FROM sch_candidate_office WHERE id=".$authadmin['id']."";
        $candidate = $object->fetch($sql);

      } 

     ?>

    <ul class="nav navbar-nav ml-auto">
     <li class="nav-item d-md-down-none ">
        <span>Hi <b><?php if ($_SESSION['user_category'] == "shipping" OR $_SESSION['user_category'] == "excrew") {echo $authadmin['first_name'];}elseif($_SESSION['user_category'] == "office"){echo $authadmin['full_name'];} ?></b></span>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
          
          <?php if ($_SESSION['user_category'] == "shipping" OR $_SESSION['user_category'] == "excrew") { ?>

            <?php if(empty($candidate['photo'])){ ?>
          
            <img src="<?php echo $object->base_path()?>assets/img/avatars/6.png" class="img-avatar" alt="">
          
            <?php }else{ ?>
          
            <img src="<?php echo BASE_URL ?>media/images/photos/<?= $candidate['photo'] ?>" class="img-avatar" alt="">
          
            <?php } ?>

          <?php }else if ($_SESSION['user_category'] == "office") { ?>

            <?php if(empty($candidate['file_photo'])){ ?>
          
            <img src="<?php echo $object->base_path()?>assets/img/avatars/6.png" class="img-avatar" alt="">
          
            <?php }else{ ?>
          
            <img src="<?php echo BASE_URL ?>media/images/photos/<?= $candidate['file_photo'] ?>" class="img-avatar" alt="">
          
            <?php } ?>

          <?php } ?>
        
        </a>
        <div class="dropdown-menu dropdown-menu-right">
          <div class="dropdown-header text-center">
            <strong>Settings</strong>
          </div>
          <a class="dropdown-item" href="<?php echo $object->base_path()?>profile"><i class="fa fa-user"></i> Profile</a>
          <a class="dropdown-item" href="<?php echo $object->base_path()?>account-settings"><i class="fa fa-wrench"></i> Settings</a>
          <a class="dropdown-item" href="log_out.php?logout" onclick="return confirm('Confirm Logout ?');"><i class="fa fa-lock"></i> Logout</a>
        </div>
      </li>
      <li style="color: #FFFFFF">0000</li>
    </ul>
    
  </header>

  <div class="app-body">
    <div class="sidebar">
      <nav class="sidebar-nav" style="background-color: #105496;">
        <ul class="nav">
         
          <?php if ($_SESSION['user_category'] == "shipping") { ?>
            
            <!-- MENU SHIPPING -->
            <li class="nav-item" style="margin-top: 2em;">
            <a class="nav-link <?php if($page == ""){echo "active";}?>" href="<?php echo $object->base_path()?>"><i class="icon-home" style="color: #ffffff;"></i> DASHBOARD </a>
            </li>
           <li class="nav-item">
              <a href="<?php echo $object->base_path()?>profile" class="nav-link <?php if($page == "profile" OR $page == "personal-info" OR $page == "nex-of-kin-details" OR $page == "prejoining-experience" OR $page == "initial-declaration"){echo "active";}?>"><i class="icon-user" style="color: #ffffff;"></i> PROFILE</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $object->base_path()?>application-status" class="nav-link <?php if($page == "application-status"){echo "active";}?>"><i class="icon-notebook" style="color: #ffffff;"></i>APPLICATION STATUS</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $object->base_path()?>document-uploads" class="nav-link <?php if($page == "document-uploads"){echo "active";}?>"><i class="icon-cloud-upload" style="color: #ffffff;"></i> DOCS UPLOAD</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $object->base_path()?>interview-schedule" class="nav-link <?php if($page == "interview-schedule"){echo "active";}?>"><i class="icon-calendar" style="color: #ffffff;"></i>SCHEDULE</a>
            </li>
             <li class="nav-item">
              <a href="<?php echo $object->base_path()?>online-test" class="nav-link <?php if($page == "online-test"){echo "active";}?>"><i class="icon-note" style="color: #ffffff;"></i>ONLINE TEST</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings" style="color: #ffffff;"></i> ACCOUNT SETTINGS</a>
            </li>
            <!-- END MENU SHIPPING -->

          <?php }else if($_SESSION['user_category'] == "excrew"){ ?>
              
            <!-- MENU SHIPPING -->
            <li class="nav-item" style="margin-top: 2em;">
            <a class="nav-link <?php if($page == ""){echo "active";}?>" href="<?php echo $object->base_path()?>"><i class="icon-home" style="color: #ffffff;"></i> DASHBOARD </a>
            </li>
           <li class="nav-item">
              <a href="<?php echo $object->base_path()?>profile" class="nav-link <?php if($page == "profile" OR $page == "edit-profile-1" OR $page == "edit-profile-2" OR $page == "edit-profile-3" OR $page == "edit-profile-4"){echo "active";}?>"><i class="icon-user" style="color: #ffffff;"></i> PROFILE</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $object->base_path()?>document-uploads" class="nav-link <?php if($page == "document-uploads"){echo "active";}?>"><i class="icon-cloud-upload" style="color: #ffffff;"></i> DOCS UPLOAD</a>
            </li>
            <li class="nav-item">
              <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings" style="color: #ffffff;"></i> ACCOUNT SETTINGS</a>
            </li>
            <!-- END MENU SHIPPING -->

          <?php }else if($_SESSION['user_category'] == "office"){ ?>

            <!-- MENU OFFICE -->
            <li class="nav-item" style="margin-top: 2em;">
            <a class="nav-link <?php if($page == ""){echo "active";}?>" href="<?php echo $object->base_path()?>"><i class="icon-home" style="color: #ffffff;"></i> DASHBOARD </a>
            </li>
           
           <li class="nav-item">
              <a href="<?php echo $object->base_path()?>profile" class="nav-link <?php if($page == "profile" OR $page == "personal-info" OR $page == "address" OR $page == "formal-education" OR $page == "family-member" OR $page == "general-information" OR $page == "work-experience" OR $page == "reference" OR $page == "document-uploads"){echo "active";}?>"><i class="icon-user" style="color: #ffffff;"></i> PROFILE</a>
            </li>
           
            <li class="nav-item">
              <a href="<?php echo $object->base_path()?>application-status" class="nav-link <?php if($page == "application-status"){echo "active";}?>"><i class="icon-notebook" style="color: #ffffff;"></i>APPLICATION STATUS</a>
            </li>
           
            <li class="nav-item">
              <a href="<?php echo $object->base_path()?>interview-schedule" class="nav-link <?php if($page == "interview-schedule"){echo "active";}?>"><i class="icon-calendar" style="color: #ffffff;"></i>SCHEDULE</a>
            </li>
           
            <li class="nav-item">
              <a href="<?php echo $object->base_path()?>account-settings" class="nav-link <?php if($page == "account-settings"){echo "active";}?>"><i class="icon-settings" style="color: #ffffff;"></i> ACCOUNT SETTINGS</a>
            </li>
            <!-- END MENU OFFICE -->

          <?php } ?>

        </ul>
      </nav>
      <button class="sidebar-minimizer brand-minimizer" type="button"></button>
    </div>