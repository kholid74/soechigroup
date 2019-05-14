<?php



  use PHPMailer\PHPMailer\PHPMailer;

  use PHPMailer\PHPMailer\Exception;

   

  require_once dirname( __FILE__ ) . '../../../../vendor/autoload.php';

  

  $sqlCur = "SELECT * FROM sch_interview_schedule WHERE id_candidate=".$authadmin['id']." AND status='2'";

  $curSch = $object->fetch($sqlCur);

  $idCurrentSch   = $curSch['id']; 

  $statCurrentSch = $curSch['status'];



  if(isset($_POST['_save'])) { 

    $namatable = 'sch_interview_schedule';

    $data = array(

      'id_candidate'=>$_POST['idCandidate']

    ); 

    $conditions = array('id' =>strip_tags($_POST['time']));

    $statusMsg =  $object->updatedata($namatable,$data,$conditions)?'Your schedule is PENDING, we will inform you if your schedule has been APPROVED..':'Some problem occurred, please try again.';

    @$msg = $_SESSION['statusMsg'] = $statusMsg;

    echo "<script> window.location.assign('".$object->base_path()."interview-schedule');</script>";

    

    $insertPass="UPDATE `sch_interview_schedule` SET 

                        `id_candidate`= NULL,

                        `status`='0',

                        `created`='".date("Y-m-d H:i:s")."', 

                        `modified`='".date("Y-m-d H:i:s")."'

                WHERE id='$idCurrentSch'

                    ";



     $object->add($insertPass);



  }

?>

<!-- Main content -->

    <main class="main" style="background-color: #f0f3f5;">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item active">Interview Schedule</li>



        <!-- Breadcrumb Menu-->

        <li class="breadcrumb-menu d-md-down-none">

          <div class="btn-group" role="group" aria-label="Button group">

            

          </div>

        </li>

      </ol>



    <div class="container-fluid">

        <div id="ui-view" style="opacity: 1;">

            <div class="animated fadeIn">

                <h4 style="text-align: center">INTERVIEW SCHEDULE</h4>

                <center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>

                <div class="card">

                   

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

                    <!-- Main row -->

                      <div class="row">

                        

                        <div class="col-md-12">

                            <h6 style="text-align: left;">SELECT AVAILABLE DATE FOR YOUR INTERVIEW :</h6>

                            <br>

                        </div>

                         <?php 

                            $sqlDate = "SELECT DISTINCT date FROM sch_interview_schedule ORDER BY date ASC";

                            $date = $object->fetch_all($sqlDate);

                            if (count($date) > 0) {

                                $number = 1;

                                foreach ($date as $showDate) {?>

                        <div class="col-md-3">

                            <div class="card text-white bg-primary">

                                <div class="card-body pb-0" align="center" style="height: 140px;">

                                  <p style="font-weight: bold;font-size: 20px;"><?= $object->dateConvertEng($showDate['date']); ?></p>

                                  <span data-toggle="modal" data-target="#<?= $showDate['date'] ?>" class="btn btn-outline-primary" style="background-color: white;color: #20a8d8;border: 1px solid #ffffff;">SET SCHEDULE</span>

                                  <br>

                                  <!-- <small>0 Slot Available</small> -->

                                </div>

                              </div>

                        </div>

                        <!-- Modal -->

                        <div class="modal fade" id="<?= $showDate['date'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

                           <div class="modal-dialog modal-dialog-centered" role="document">

                             <div class="modal-content">

                               <div class="modal-header">

                                 <h5 class="modal-title" id="exampleModalLongTitle">Choose Time :</h5>

                                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                   <span aria-hidden="true">&times;</span>

                                 </button>

                               </div>

                               <div class="modal-body">

                                 <form role="form" method="POST" enctype="multipart/form-data">

                                 <div class="container-fluid">

                                 <div class="row">

                                   <?php       

                                       $shwDate  = $showDate['date'];

                                       $sqlTime = "SELECT * FROM sch_interview_schedule WHERE date='$shwDate'";

                                       $time = $object->fetch_all($sqlTime);



                                       if (count($time) > 0) {

                                           $number = 1;

                                           foreach ($time as $showTime) {

                                            ?>

                                   <div class="col-md-4" style="<?php if(!empty($showTime['id_candidate']) AND $showTime['status'] != "2"){echo "background-color: #ff8484";} ?>">

                                       <div class="form-check">

                                       <input class="form-check-input" type="radio" value="<?= $showTime['id'] ?>" id="time" name="time" <?php if(!empty($showTime['id_candidate']) AND $showTime['status'] != "2"){echo "disabled";} ?>>

                                       <label class="form-check-label" for="time">

                                         <?= $showTime['time_start'] ?> - <?= $showTime['time_end'] ?>

                                       </label>

                                     </div>

                                   </div>    

                                   <?php }} ?>

                                 </div>

                             </div>

                                

                               </div>

                               <div class="modal-footer">

                                <?php 

                                    $idCandidate = $authadmin['id'];

                                    $sqlCand = "SELECT id_candidate,status FROM sch_interview_schedule WHERE id_candidate='$idCandidate'";

                                    $cnd = $object->fetch($sqlCand);

                                 ?>

                                <input type="hidden" name="idCandidate" value="<?=$authadmin['id']?>">

                                 <input type="submit" name="_save"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Set Schedule" value="SAVE" <?php if(!empty($cnd['id_candidate']) AND $cnd['status'] != "2"){echo "disabled";} ?>/>

                                 </form>

                               </div>

                             </div>

                           </div>

                             </div>

                             <!-- end Modal -->

                        <?php }} ?>



                        <div class="col-lg-12">

                            <br><br>

                            <h6 style="text-align: left;">MY INTERVIEW :</h6>

                            <table class="table table-responsive-sm table-bordered table-striped table-sm">

                                <thead>

                                    <tr>

                                        <td style="font-weight: bold;text-align: center;">No</td>

                                        <td style="font-weight: bold;text-align: center;">Date</td>

                                        <td style="font-weight: bold;text-align: center;">Time</td>

                                        <td style="font-weight: bold;text-align: center;">Status</td>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php 

                                        $sqlSch = "SELECT a.*,b.first_name, b.last_name,b.email,c.job_name FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate = b.id JOIN sch_jobs c ON b.id_job=c.id WHERE a.id_candidate=".$authadmin['id']."";

                                        $schedule = $object->fetch_all($sqlSch);

                                        if (count($schedule) > 0) {

                                            $number = 1;

                                            foreach ($schedule as $showSch) {?>

                                    <tr>

                                        <td align="center"><?php echo $number;?></td>

                                        <td align="center"><?= $object->dateConvertEng($showSch['date']); ?></td>

                                        <td align="center"><?= $showSch['time_start'] ?> - <?= $showSch['time_end'] ?></td>

                                        <td align="center">

                                            <?php if ($showSch['status'] == 0) {

                                                echo "<span class='badge badge-warning'>PENDING</span>";

                                            }else if ($showSch['status'] == 1) {

                                                echo "<span class='badge badge-success'>APPROVED</span>";

                                            }else if ($showSch['status'] == 2) {

                                                echo "<span class='badge badge-danger'>DECLINE</span>"; 

                                            }?>

                                            <?php if ($showSch['status'] == 1) {?>

                                            <span data-toggle="modal" data-target="#<?= $showSch['id'] ?>" class="badge badge-primary btn-sm" style="cursor: pointer;">

                                            <i class="fa fa-calendar"></i>&nbsp;DETAILS

                                            </span>

                                            <?php }else if ($showSch['status'] == 2) { ?>

                                            <br><span class="badge badge-danger">PLEASE SELECT ANOTHER DATE</span>

                                            <?php } ?>

                                        </td>

                                        

                                    </tr>

                                    <!-- Modal -->

                                <div class="modal" id="<?= $showSch['id'] ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

                                   <div class="modal-dialog modal-dialog-centered" role="document">

                                     <div class="modal-content">

                                       <div class="modal-header">

                                         <h5 class="modal-title" id="exampleModalLongTitle">Detail Interview :</h5>

                                         <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                                           <span aria-hidden="true">&times;</span>

                                         </button>

                                       </div>

                                       <div class="modal-body">

                                         <form role="form" method="POST" enctype="multipart/form-data">

                                         <div class="container-fluid">

                                         <div class="row">

                                            <div class="col-md-4">

                                                Name

                                            </div>

                                            <div class="col-md-8">

                                                : <b><?= $showSch['first_name'] ?> <?= $showSch['last_name'] ?></b>

                                            </div>

                                            <div class="col-md-4">

                                                Position

                                            </div>

                                            <div class="col-md-8">

                                                : <b><?= $showSch['job_name'] ?></b>

                                            </div>

                                            <div class="col-md-4">

                                                Date / Time

                                            </div>

                                            <div class="col-md-8">

                                                : <b><?= $object->dateConvertEng($showSch['date']); ?> / <?= $showSch['time_start'] ?> - <?= $showSch['time_end'] ?></b>

                                            </div>

                                            <div class="col-md-4">

                                                PIC

                                            </div>

                                            <div class="col-md-8">

                                                : <b><?= $showSch['pic_name'] ?></b>

                                            </div>

                                         </div>



                                        <?php if($showSch['status'] == 1){ ?>

                                            <br>

                                            <div class="col-md-12" align="center">

                                                <img src="<?php echo BASE_URL; ?>media/images/qrcode_generate/<?= $showSch['img_qrcode'] ?>" alt="">

                                                <br>

                                                <span class="badge badge-success"><i class="fa fa-check"></i>&nbsp;APPROVED</span>

                                            </div>

                                        <?php }?>



                                        </div>

                                        

                                       </div>

                                       <div class="modal-footer">

                                         <form role="form" method="POST" enctype="multipart/form-data">

                                            <button class="btn btn-flat btn-primary" onclick="window.print();"><i class="fa fa-print"></i>&nbsp;&nbsp;PRINT SCHEDULE</button>

                                             <input type="submit" class="btn btn-flat btn-primary" name="_sendMail" value="EMAIL SCHEDULE">

                                         </form>

                                       </div>

                                     </div>

                                   </div>

                                     </div>

                                     <!-- end Modal -->

                                    <?php

                                    $number++;

                                    }}else{ ?>

                                    <tr>

                                        <td colspan="4" align="center">

                                            No Schedule..

                                        </td>

                                    </tr>

                                    <?php } ?>

                                </tbody>

                            </table>



                             <!-- <table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">

                                <thead>

                                    <tr>

                                        <td style="font-weight: bold;text-align: center;">No</td>

                                        <td style="font-weight: bold;text-align: center;">Date</td>

                                        <td style="font-weight: bold;text-align: center;">Time Start - End</td>

                                        <td style="font-weight: bold;text-align: center;">STATUS</td>

                                    </tr>

                                </thead>

                                <tbody>

                                    <?php 

                                        $sql = "SELECT * FROM sch_interview_schedule ORDER BY date ASC";

                                        $candidate = $object->fetch_all($sql);

                                        if (count($candidate) > 0) {

                                            $number = 1;

                                            foreach ($candidate as $cand) {?>

                                    <tr>

                                        <td align="center"><?php echo $number;?></td>

                                        <td align="center"><?= $object->dateConvertEng($cand['date']); ?></td>

                                        <td align="center"><?= $cand['time_start'] ?> - <?= $cand['time_end'] ?></td>

                                        <td align="center">

                                            <a class="btn btn-success btn-sm" href="#">

                                            AVAILABLE

                                            </a>

                                        </td>

                                    </tr>

                                    <?php

                                    $number++;

                                    }}?>

                                </tbody>

                                                         </table> -->

                        </div>

                      </div>

                </div>

                </div>

            </div>

        </div>

    </div>



   <?php 



    if(isset($_POST['_sendMail'])){

        

        $message = file_get_contents(''.BASE_URL.'emailtemplates/shipping-barcode.html');

        $message = str_replace("%cand['first_name']%", $showSch['first_name'], $message);

        $message = str_replace("%cand['last_name']%", $showSch['last_name'], $message);

        $message = str_replace("%cand['job_name']%", $showSch['job_name'], $message);

        $message = str_replace("%cand['date']%", $showSch['date'], $message);

        $message = str_replace("%cand['time_start']%", $showSch['time_start'], $message);

        $message = str_replace("%cand['time_end']%", $showSch['time_end'], $message);

        $message = str_replace("%cand['pic_name']%", $showSch['pic_name'], $message);

        $message = str_replace("%cand['img_qrcode']%", $showSch['img_qrcode'], $message);

        $message = str_replace("%BASE_URL%", BASE_URL, $message);

       

        $mail = new PHPMailer(true);                             

                  

                  $mail->SMTPDebug = 0;    

                  $mail->isSMTP();                         

                  $mail->Host = 'smtp.mailtrap.io'; 

                  $mail->SMTPAuth = true;                      

                  $mail->Username = 'a1526266572f65';   

                  $mail->Password = '49a15dc8363a34';                

                  $mail->SMTPSecure = 'tls';                         

                  $mail->Port = 2525;         



                  //Recipients

                  $mail->setFrom('demo@essentials.id', 'Soechi Recruitment');

                  $mail->addAddress(''.$showSch['email'].'', ''.$showSch['first_name'].' '.$showSch['last_name'].'');    

                  $mail->addReplyTo('demo@essentials.id', 'Information');



                  //Content

                  $mail->isHTML(true);                                 

                  $mail->Subject = 'Interview Schedule';

                  $mail->MsgHTML($message);



                  $mail->send();

                  

        echo "<script> window.location.assign('".$object->base_path()."interview-schedule'); </script>";

    }



    ?>