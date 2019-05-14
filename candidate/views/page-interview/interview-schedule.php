<?php



  $_SESSION['statusMsg'] = "";



  use PHPMailer\PHPMailer\PHPMailer;

  use PHPMailer\PHPMailer\Exception;

   

  require_once dirname( __FILE__ ) . '../../../../vendor/autoload.php';

  

  $sqlCur = "SELECT * FROM sch_interview_schedule WHERE id_candidate=".$authadmin['id']." AND status='2'";

  $curSch = $object->fetch($sqlCur);

  $idCurrentSch   = $curSch['id']; 

  $statCurrentSch = $curSch['status'];



  $sql = "SELECT a.*,b.id_job_name,c.name,c.deck_engine,c.short_name,c.category FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id WHERE a.id=".$authadmin['id']."";

  $candidate = $object->fetch($sql);



  $sqlSch = "SELECT a.*,b.first_name, b.last_name,b.email FROM sch_interview_schedule a JOIN sch_candidate_shipping b ON a.id_candidate = b.id WHERE a.id_candidate=".$authadmin['id']."";

  $schedule = $object->fetch($sqlSch);



  /*cek sudah upload dokumen atau belum*/

  $sql4 = "SELECT * FROM sch_cand_ship_document WHERE id_candidate=".$authadmin['id']."";

  $countUpload = $object->fetch_all($sql4);

  $countDoc = count($countUpload);



  if(isset($_POST['_saveInterview'])) { 

    $namatable = 'sch_interview_schedule';

    $data = array(

      'id_candidate'=>$authadmin['id'],

      'category'=>'shipping',

      'date'=>$_POST['interDate'],

      'time'=>$_POST['interTime'],

      'status'=>$_POST['status']

    ); 

    $insert = $object->tambahdata($namatable,$data);

    $object->messagesinterview($insert);

    //echo "<script>alertify.alert('Success', 'Your schedule is PENDING, we will inform you if your schedule has been APPROVED..');</script>";

    echo "<script> window.location.assign('".$object->base_path()."interview-schedule');</script>";

  

  }



  if(isset($_POST['_editInterview'])){

          $namatable = 'sch_interview_schedule';

          $data = array(

          'date'=>$_POST['interDate'],

          'time'=>$_POST['interTime'],

          'status'=>$_POST['status']

        );

          $conditions = array('id' =>strip_tags($_POST['id']));

          $statusMsg =  $object->updatedata($namatable,$data,$conditions);

          @$msg = $_SESSION['statusMsg'] = $statusMsg;

          

          //echo "<script>alertify.alert('Success', 'Your schedule is PENDING, we will inform you if your schedule has been APPROVED..');</script>";

          echo "<script> window.location.assign('".$object->base_path()."interview-schedule');</script>";

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

                     <!-- <?php

                        if(!empty($_SESSION['statusMsg'])){

                            echo '

                               <div class="alert alert-success" role="alert">

                                '.$_SESSION['statusMsg'].'

                               </div>';

                            unset($_SESSION['statusMsg']);

                        }

                      ?> -->

                    <!-- Main row -->

            <?php if(!empty($countDoc)) { ?>

                    <div class="row">

                      <div class="col-sm-6">

                        <div class="card">

                          <div class="card-header">

                              <strong>MY INTERVIEW</strong>

                          </div>

                            <div class="card-body" style="background-color: #f0f3f5">



                              <div class="form-group">

                                <label for="name">Name</label>

                                <h6 style="font-weight: bold;text-transform: uppercase;"><?= $candidate['first_name'] ?> <?= $candidate['last_name'] ?></h6>

                              </div>



                              <div class="form-group">

                                <label for="position">Position</label>

                                <h6 style="font-weight: bold;text-transform: uppercase;"><?= $candidate['name'] ?></h6>

                              </div>



                              <div class="form-group">

                                <label for="date">Interview Date / Time</label>

                                <h6 style="font-weight: bold;text-transform: uppercase;">

                                  <?php if(empty($schedule['date'])){

                                          echo "<span class='badge badge-dark'>NOT SET</span>";

                                        }else{ 

                                          echo ''.$object->dateConvertEng($schedule['date']).' - '.$schedule['time'].''; 

                                        }

                                    ?>

                                </h6>

                              </div>



                              <div class="form-group">

                                <label for="pic">PIC Name</label>

                                <h6 style="font-weight: bold;text-transform: uppercase;">

                                  <?php if(empty($schedule['pic_name'])){

                                          echo "<span class='badge badge-dark'>NOT SET</span>";

                                        }else{

                                          echo $schedule['pic_name'];

                                        } 

                                  ?>

                                </h6>

                              </div>



                              <div class="form-group">

                                <label for="status">Status</label>

                                <h6 style="font-weight: bold;text-transform: uppercase;"><?php 

                                      if($schedule['status'] == ''){

                                        echo "<span class='badge badge-dark'>NOT SET</span>";

                                      }else if($schedule['status'] == '0'){

                                        echo "<span class='badge badge-warning'>PENDING, WAITING FOR APPROVAL</span>";

                                      }else if($schedule['status'] == '1'){

                                        echo "<span class='badge badge-success'>APPROVED</span>";

                                      }else if($schedule['status'] == '2'){

                                        echo "<span class='badge badge-danger'>REJECTED, PLEASE RESCHEDULE</span>";

                                      }else if($schedule['status'] == '3'){

                                        echo "<span class='badge badge-success'>INTERVIEW PASSED</span>";

                                      }else if($schedule['status'] == '4'){

                                        echo "<span class='badge badge-danger'>INTERVIEW FAILED</span>";

                                      } 

                                    ?></h6>

                              </div>



                            </div>

                        </div>

                    </div>



                      <div class="col-sm-6">

                        <div class="card">

                          <div class="card-header">

                          <strong>INTERVIEW SCHEDULE</strong>

                          </div>

                          <div class="card-body" style="background-color: #f0f3f5">

                            

                            <div align="center">

                              

                              <?php if (empty($schedule['img_qrcode'])) {echo " ";}else{ ?>

                              <div class="form-group row" style="margin-bottom: 0px;">

                                

                                <div class="col-sm-12">

                                  <img src="<?php echo BASE_URL; ?>media/images/qrcode_generate/<?= $schedule['img_qrcode'] ?>" alt="">

                                </div>

                              </div>

                              <?php } ?>



                              <br>

                               <?php if($schedule['id_candidate'] == ''){ ?>



                              <span data-toggle="modal" data-target="#interview" class="btn btn-primary">SET INTERVIEW</span>

                              

                              <?php }else if($schedule['id_candidate'] == $authadmin['id'] && $schedule['status'] == '0'){ ?>

                              

                              <span data-toggle="modal" data-target="#interview" class="btn btn-primary" style="display: none;">SET INTERVIEW</span>

                              

                              <?php }else if($schedule['id_candidate'] == $authadmin['id'] && $schedule['status'] == '1'){ ?>



                              <span data-toggle="modal" data-target="#interview" class="btn btn-primary" style="display: none;">SET INTERVIEW</span>



                              <?php }else if($schedule['id_candidate'] == $authadmin['id'] && $schedule['status'] == '2'){ ?>  

                              

                              <span data-toggle="modal" data-target="#Editinterview" class="btn btn-primary">RESCHEDULE</span>

                              

                              <?php } ?>

                           </div>



                          </div>

                        </div>

                      </div>



             <?php }else { ?>



                  <div class="row">

                    <div class="col-sm-6 offset-sm-3" >

                    

                    <div class="alert alert-danger alert-dismissible">

                       <b>WARNING :</b> PLEASE UPLOAD YOUR REQUIRED DOCUMENT BEFORE SET INTERVIEW.

                    </div>



                    </div>

                  </div>



             <?php } ?>    

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

                  

        SMTPconfig();         



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



     <!-- Modal -->

      <div class="modal" id="interview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLongTitle">SET INTERVIEW</h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div>

            <div class="modal-body">

              <form role="form" method="POST" enctype="multipart/form-data">

              <div class="container-fluid">

              <div class="row">



                <div class="col-md-12">

                   <div class="form-group row">

                      <label class="col-md-4 col-form-label" for="interDate">Choose Date</label>

                      <div class="col-md-8">

                        <input type="date" class="form-control" id="txtDate" name="interDate" required>

                      </div>

                     </div>



                     <div class="form-group row">

                      <label class="col-md-4 col-form-label" for="interTime">Choose Time</label>

                      <div class="col-md-8">

                        <select name="interTime" id="interTime" class="form-control">

                          <option selected>- Choose Time -</option>

                          <option value="09.00">09.00</option>

                          <option value="10.00">10.00</option>

                          <option value="11.00">11.00</option>

                          <option value="13.00">13.00</option>

                          <option value="14.00">14.00</option>

                          <option value="15.00">15.00</option>

                        </select>

                      </div>

                     </div>



                </div>

              </div>

          </div>

             

            </div>

            <div class="modal-footer">

              <input type="hidden" name="status" value="0">

              <input type="submit" name="_saveInterview" class="btn btn-flat btn-primary" class="btn btn-flat btn-success"  value="SUBMIT" />

              </form>

            </div>

          </div>

        </div>

    </div>



    <!-- Modal -->

      <div class="modal" id="Editinterview" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLongTitle">EDIT INTERVIEW</h5>

              <button type="button" class="close" data-dismiss="modal" aria-label="Close">

                <span aria-hidden="true">&times;</span>

              </button>

            </div>

            <div class="modal-body">

              <form role="form" method="POST" enctype="multipart/form-data">

              <div class="container-fluid">

              <div class="row">



                <div class="col-md-12">



                   <div class="form-group row">

                      <label class="col-md-4 col-form-label" for="interDate">Choose Date</label>

                      <div class="col-md-8">

                        <input type="date" class="form-control" id="txtDate" name="interDate" value="<?= $schedule['date'] ?>" required>

                      </div>

                     </div>



                     <div class="form-group row">

                      <label class="col-md-4 col-form-label" for="interTime">Choose Time</label>

                      <div class="col-md-8">

                        <select name="interTime" id="interTime" class="form-control">

                          <option selected>- Choose Time -</option>

                          <option value="09.00" <?php if($schedule['time'] == '09.00'){echo "selected";} ?>>09.00</option>

                          <option value="10.00" <?php if($schedule['time'] == '10.00'){echo "selected";} ?>>10.00</option>

                          <option value="11.00" <?php if($schedule['time'] == '11.00'){echo "selected";} ?>>11.00</option>

                          <option value="13.00" <?php if($schedule['time'] == '13.00'){echo "selected";} ?>>13.00</option>

                          <option value="14.00" <?php if($schedule['time'] == '14.00'){echo "selected";} ?>>14.00</option>

                          <option value="15.00" <?php if($schedule['time'] == '15.00'){echo "selected";} ?>>15.00</option>

                        </select>

                      </div>

                     </div>



                </div>

              </div>

          </div>

             

            </div>

            <div class="modal-footer">

              <input type="hidden" name="status" value="0">

              <input type="hidden" name="id" value="<?= $schedule['id'] ?>">

              <input type="submit" name="_editInterview" class="btn btn-flat btn-primary" class="btn btn-flat btn-success"  value="SUBMIT" />

              </form>

            </div>

          </div>

        </div>

    </div>



    

    