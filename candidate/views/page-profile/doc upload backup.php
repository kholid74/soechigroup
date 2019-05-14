<style type="text/css">

  .sw-theme-circles > ul.step-anchor:before {

      content: " ";

      position: absolute;

      top: 50%;

      bottom: 0;

      width: 100%;

      height: 5px;

      background-color: #f5f5f5;

      border-radius: 3px;

      z-index: 0;

  }

  .sw-theme-circles > ul.step-anchor > li > a {

    font-size: 11px;

      border: 2px solid #f5f5f5;

      background: #f5f5f5;

      width: 100px;

      height: 100px;

      text-align: center;

      padding: 40px 0;

      border-radius: 50%;

      -webkit-box-shadow: inset 0px 0px 0px 3px #fff !important;

      box-shadow: inset 0px 0px 0px 3px #fff !important;

      text-decoration: none;

      outline-style: none;

      z-index: 99;

      color: #bbb;

      background: #f5f5f5;

      line-height: 1;

  }

  .sw-theme-circles > ul.step-anchor > li {

      border: none;

      margin-left: 130px;

      z-index: 98;

  }

</style>



<?php



  $sql = "SELECT a.*,b.id_job_name,c.name,c.deck_engine,c.short_name,c.category FROM sch_candidate_shipping a JOIN sch_job_shipping b ON a.id_job = b.id JOIN sch_master_crewrank c ON b.id_job_name=c.id WHERE a.id=".$authadmin['id']."";

  $candidate = $object->fetch($sql);



    if(isset($_POST['_save'])){

      $namatable = 'sch_cand_ship_document';

        $maxsize = 1024 * 1024; // 1MB



      if (!empty($_FILES["doc"]["name"])) {

            $fileSize  = $_FILES['doc']['size'];

            if($fileSize < $maxsize){

                $object->create_path();

                $uploadDoc = $object->uploadDocument();

                $data = array(

                'id_candidate'=>$authadmin['id'],

                'doc_name'=>$_POST['certName'],

                'date_issued' => $_POST['dateIssued'],

                'date_expired' => $_POST['dateExp'],

                'file_upload'=>$uploadDoc

          );

            $insert = $object->tambahdata($namatable,$data);

            $object->messagesin($insert);

            echo "<script> window.location.assign('".$object->base_path()."document-uploads'); </script>";



            }else{

                $object->messagesfile();

                echo "<script> window.location.assign('".$object->base_path()."document-uploads'); </script>";

            }

        }   

    }



?>

<!-- Main content -->

    <main class="main" style="background-color: #f0f3f5;">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item active">Document Uploads</li>

        <!-- Breadcrumb Menu-->

        <li class="breadcrumb-menu d-md-down-none">

          <div class="btn-group" role="group" aria-label="Button group">

            <!-- <span>You logged as Candidate</b></span> -->

          </div>

        </li>

      </ol>



  <div class="container-fluid">

    <div id="ui-view" style="opacity: 1;">

      <div class="animated fadeIn">

        <h4 style="text-align: center">DOCUMENT UPLOADS</h4>

        <center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>

        <div class="card">

          <div class="card-header">



          </div>

        <div class="card-body">



          <div class="row">

                      

                      <div class="col-sm-4">

                        <div class="card">

                          

                            <div class="card-body" style="background-color: #f0f3f5">

                                

                                <div class="" style="padding: 10px;">

                                  <h6 style="text-transform: uppercase;">NAME : <b><?= $candidate['first_name'] ?> <?= $candidate['last_name'] ?></b></h6>

                                  <h6 style="text-transform: uppercase;">POSITION : <b><?= $candidate['name'] ?> - <?= $candidate['short_name'] ?></b></h6>

                                  <h6 style="text-transform: uppercase;">CATEGORY : <b><?= $candidate['category'] ?></b></h6>

                                  <h6 style="text-transform: uppercase;">DECK/ENGINE : <b><?= $candidate['deck_engine'] ?></b></h6>

                                  </h6>

                                </div>



                                <?php if ($candidate['category'] == "Deck Officer Senior") { ?>



                                <table class="table table-responsive-sm table-bordered table-striped table-sm">

                                  <thead>

                                    <tr style="font-weight: bold;">

                                      <td align="center">List Document Required</td>

                                    </tr>

                                  </thead>

                                  <tbody>

                                    <tr><td>COC & COE</td></tr>

                                    <tr><td>BST</td></tr>

                                    <tr><td>PSCRB</td></tr>

                                    <tr><td>ACT/ACT/ALGT (Depend on Vessels Type)</td></tr>

                                    <tr><td>AFF</td></tr>

                                    <tr><td>MC</td></tr>

                                    <tr><td>MFA</td></tr>

                                    <tr><td>RADAR</td></tr>

                                    <tr><td>ARPA</td></tr>

                                    <tr><td>GMDSS</td></tr>

                                    <tr><td>GOC/ORU</td></tr>

                                    <tr><td>SSO</td></tr>

                                    <tr><td>BRM</td></tr>

                                    <tr><td>ECDIS</td></tr>

                                    <tr><td>ECDIS TYPE SPECIFIC (As Per Vessels Requirement)</td></tr>

                                    <tr><td>SHIP HANDLING (For Master Only)</td></tr>

                                    <tr><td>SAFETY OFFICER (For CO Only)</td></tr>

                                    <tr><td>PSSR & PST (For Foreign Only)</td></tr>

                                    <tr><td>Risk Assessement & Accident Investigation Course</td></tr>

                                  <hr>

                                  </tbody>

                                </table>



                                <?php }else if ($candidate['category'] == "Engine Officer Senior") { ?>



                                <table class="table table-responsive-sm table-bordered table-striped table-sm">

                                  <thead>

                                    <tr style="font-weight: bold;">

                                      <td align="center">List Document Required</td>

                                    </tr>

                                  </thead>

                                  <tbody>

                                    <tr><td>COC & COE</td></tr>

                                    <tr><td>BST</td></tr>

                                    <tr><td>PSCRB</td></tr>

                                    <tr><td>ACT/ACT/ALGT (Depend on Vessels Type)</td></tr>

                                    <tr><td>AFF</td></tr>

                                    <tr><td>MFA</td></tr>

                                    <tr><td>SSO</td></tr>

                                    <tr><td>ERM</td></tr>

                                    <tr><td>PSSR & PST (For Foreign Only)</td></tr>

                                    <tr><td>Risk Assessement & Accident Investigation Course</td></tr>

                                  <hr>

                                  </tbody>

                                </table>



                                <?php }else if ($candidate['category'] == "Deck Officer Junior") { ?>



                                <table class="table table-responsive-sm table-bordered table-striped table-sm">

                                  <thead>

                                    <tr style="font-weight: bold;">

                                      <td align="center">List Document Required</td>

                                    </tr>

                                  </thead>

                                  <tbody>

                                    <tr><td>COC & COE</td></tr>

                                    <tr><td>BST</td></tr>

                                    <tr><td>PSCRB</td></tr>

                                    <tr><td>ACT/ACT/ALGT (Depend on Vessels Type)</td></tr>

                                    <tr><td>AFF</td></tr>

                                    <tr><td>MC</td></tr>

                                    <tr><td>MFA</td></tr>

                                    <tr><td>RADAR</td></tr>

                                    <tr><td>ARPA</td></tr>

                                    <tr><td>GMDSS</td></tr>

                                    <tr><td>GOC/ORU</td></tr>

                                    <tr><td>SSO</td></tr>

                                    <tr><td>BRM</td></tr>

                                    <tr><td>ECDIS</td></tr>

                                    <tr><td>ECDIS TYPE SPECIFIC (As Per Vessels Requirement)</td></tr>

                                  <hr>

                                  </tbody>

                                </table>



                                <?php }else if ($candidate['category'] == "Engine Officer Junior") { ?>



                                <table class="table table-responsive-sm table-bordered table-striped table-sm">

                                  <thead>

                                    <tr style="font-weight: bold;">

                                      <td align="center">List Document Required</td>

                                    </tr>

                                  </thead>

                                  <tbody>

                                    <tr><td>COC & COE</td></tr>

                                    <tr><td>BST</td></tr>

                                    <tr><td>PSCRB</td></tr>

                                    <tr><td>ACT/ACT/ALGT (Depend on Vessels Type)</td></tr>

                                    <tr><td>AFF</td></tr>

                                    <tr><td>MFA</td></tr>

                                    <tr><td>SSO</td></tr>

                                    <tr><td>ERM</td></tr>

                                  <hr>

                                  </tbody>

                                </table>



                                <?php }else if ($candidate['category'] == "Deck Rating" OR $candidate['category'] == "Deck Rating Senior" OR $candidate['category'] == "Engine Rating") { ?>



                                <table class="table table-responsive-sm table-bordered table-striped table-sm">

                                  <thead>

                                    <tr style="font-weight: bold;">

                                      <td align="center">List Document Required</td>

                                    </tr>

                                  </thead>

                                  <tbody>

                                    <tr><td>Watch keeping Certificate (Able Seafarer Deck)</td></tr>

                                    <tr><td>BST</td></tr>

                                    <tr><td>PSCRB</td></tr>

                                    <tr><td>BOCT/BLGT (Depend on Vessels Type)</td></tr>

                                    <tr><td>AFF</td></tr>

                                    <tr><td>MFA</td></tr>

                                    <tr><td>SAT</td></tr>

                                    <tr><td>SDSD</td></tr>

                                  <hr>

                                  </tbody>

                                </table>



                                <?php } ?>



                            </div>

                          </div>

                        </div>



                        <div class="col-sm-8">

                        <div class="card">

                          

                            <div class="card-body" style="background-color: #f0f3f5">

                                

                                <span data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;&nbsp;UPLOAD</span>



                                <table class="table table-responsive-sm table-bordered table-striped table-sm">

                                  <thead>

                                    <tr style="font-weight: bold;">

                                      <td align="center">Document Name</td>

                                      <td align="center">Date Issued</td>

                                      <td align="center">Date Expired</td>

                                      <td align="center">File</td>

                                      <td align="center">Status</td>

                                      <td align="center">Action</td>

                                    </tr>

                                  </thead>

                                  <tbody>

                                  <?php 

                                    $sql = "SELECT * FROM sch_cand_ship_document WHERE id_candidate = ".$authadmin['id']."";

                                    $exp = $object->fetch_all($sql);

                                    if (count($exp) > 0) {

                                      $number = 1;

                                      foreach ($exp as $docUpload) {?>

                                  <tr>

                                    <td><?= $docUpload['doc_name'] ?></td>

                                    <td><?= $docUpload['date_issued'] ?></td>

                                    <td><?= $docUpload['date_expired'] ?></td>

                                    <td align="center"><a href="<?php echo BASE_URL ?>media/files/<?= $docUpload['file_upload'] ?>" target="_blank"><i class="fa fa-file"></i></a></td>

                                    <td align="center">

                                      <span class="badge badge-success">SUCCESS</span>

                                    </td>

                                    <td align="center">

                                      <a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-document-upload/<?php echo $docUpload['id']?>" onclick="return confirm('Confirm delete ?')" >

                                      <i class="fa fa-trash-o "></i>

                                      </a>

                                    </td>

                                  </tr>

                                  <?php $number++; }}else{ ?>

                                  <tr>

                                    <td colspan="6" align="center">No document has been uploaded..</td>

                                  </tr>

                                  <?php } ?>

                                  <hr>

                                  </tbody>

                                </table>                                



                            </div>

                          </div>

                        </div>

                      

          </div>



        </div>

        </div>

      </div>

    </div>

  </div>



    <!-- Modal -->

      <div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

        <div class="modal-dialog modal-dialog-centered" role="document">

          <div class="modal-content">

            <div class="modal-header">

              <h5 class="modal-title" id="exampleModalLongTitle">Upload Document</h5>

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

                      <label class="col-md-4 col-form-label" for="certName">Certificate</label>

                      <div class="col-md-8">



                        <?php if ($candidate['category'] == "Deck Officer Senior") { ?>

                        

                          <select class="form-control" name="certName">

                            <option value="COC & COE">COC & COE</option>

                            <option value="BST">BST</option>

                            <option value="PSCRB">PSCRB</option>

                            <option value="ACT/ACT/ALGT (Depend on Vessels Type)">ACT/ACT/ALGT (Depend on Vessels Type)</option>

                            <option value="AFF">AFF</option>

                            <option value="MC">MC</option>

                            <option value="MFA">MFA</option>

                            <option value="RADAR">RADAR</option>

                            <option value="ARPA">ARPA</option>

                            <option value="GMDSS">GMDSS</option>

                            <option value="GOC/ORU">GOC/ORU</option>

                            <option value="SSO">SSO</option>

                            <option value="BRM">BRM</option>

                            <option value="ECDIS">ECDIS</option>

                            <option value="ECDIS TYPE SPECIFIC (As Per Vessels Requirement)">ECDIS TYPE SPECIFIC (As Per Vessels Requirement)</option>

                            <option value="SHIP HANDLING (For Master Only)">SHIP HANDLING (For Master Only)</option>

                            <option value="SAFETY OFFICER (For CO Only)">SAFETY OFFICER (For CO Only)</option>

                            <option value="PSSR & PST (For Foreign Only)">PSSR & PST (For Foreign Only)</option>

                            <option value="Risk Assessement & Accident Investigation Course">Risk Assessement & Accident Investigation Course</option>

                          </select>



                        <?php }else if ($candidate['category'] == "Engine Officer Senior") { ?>



                          <select class="form-control" name="certName">

                            <option value="COC & COE">COC & COE</option>

                            <option value="BST">BST</option>

                            <option value="PSCRB">PSCRB</option>

                            <option value="ACT/ACT/ALGT (Depend on Vessels Type)">ACT/ACT/ALGT (Depend on Vessels Type)</option>

                            <option value="AFF">AFF</option>

                            <option value="MFA">MFA</option>

                            <option value="SSO">SSO</option>

                            <option value="ERM">ERM</option>

                            <option value="PSSR & PST (For Foreign Only)">PSSR & PST (For Foreign Only)</option>

                            <option value="Risk Assessement & Accident Investigation Course">Risk Assessement & Accident Investigation Course</option>

                          </select>



                        <?php }else if ($candidate['category'] == "Deck Officer Junior") { ?>



                          <select class="form-control" name="certName">   

                            <option value="COC & COE">COC & COE</option>

                            <option value="BST">BST</option>

                            <option value="PSCRB">PSCRB</option>

                            <option value="ACT/ACT/ALGT (Depend on Vessels Type)">ACT/ACT/ALGT (Depend on Vessels Type)</option>

                            <option value="AFF">AFF</option>

                            <option value="MFA">MFA</option>

                            <option value="RADAR">RADAR</option>

                            <option value="ARPA">ARPA</option>

                            <option value="GMDSS">GMDSS</option>

                            <option value="GOC/ORU">GOC/ORU</option>

                            <option value="SSO">SSO</option>

                            <option value="BRM">BRM</option>

                            <option value="ECDIS">ECDIS</option>

                            <option value="ECDIS TYPE SPECIFIC (As Per Vessels Requirement)">ECDIS TYPE SPECIFIC (As Per Vessels Requirement)</option>

                          </select>



                        <?php }else if ($candidate['category'] == "Engine Officer Junior") { ?>



                          <select class="form-control" name="certName">   

                            <option value="COC & COE">COC & COE</option>

                            <option value="BST">BST</option>

                            <option value="PSCRB">PSCRB</option>

                            <option value="ACT/ACT/ALGT (Depend on Vessels Type)">ACT/ACT/ALGT (Depend on Vessels Type)</option>

                            <option value="AFF">AFF</option>

                            <option value="MFA">MFA</option>

                            <option value="SSO">SSO</option>

                            <option value="ERM">ERM</option>

                          </select>



                        <?php }else if ($candidate['category'] == "Deck Rating" OR $candidate['category'] == "Deck Rating Senior" OR $candidate['category'] == "Engine Rating Senior") { ?>



                          <select class="form-control" name="certName">   

                            <option value="Watch keeping Certificate (Able Seafarer Deck)">Watch keeping Certificate (Able Seafarer Deck)</option>

                            <option value="BST">BST</option>

                            <option value="PSCRB">PSCRB</option>

                            <option value="BOCT/BLGT (Depend on Vessels Type)">BOCT/BLGT (Depend on Vessels Type)</option>

                            <option value="AFF">AFF</option>

                            <option value="MFA">MFA</option>

                            <option value="SAT">SAT</option>

                            <option value="SDSD">SDSD</option>

                          </select>

                        

                        <?php } ?>



                      </div>

                     </div>



                     <div class="form-group row">

                      <label class="col-md-4 col-form-label" for="dateIssued">Date Issued</label>

                      <div class="col-md-8">

                        <input type="date" class="form-control" id="dateIssued" name="dateIssued" required>

                      </div>

                     </div>



                     <div class="form-group row">

                      <label class="col-md-4 col-form-label" for="dateExp">Date Expired</label>

                      <div class="col-md-8">

                        <input type="date" class="form-control" id="dateExp" name="dateExp" required>

                      </div>

                     </div>



                    <div class="form-group row">

                      <label class="col-md-4 col-form-label" for="_jobdesc">File Upload</label>

                      <div class="col-md-8">

                        <input type="file" class="form-control-file" id="doc" name="doc" accept=".pdf, .doc, .docx" required>

                      </div>

                     </div>

                </div>

              </div>

          </div>

             

            </div>

            <div class="modal-footer">

              <input type="submit" name="_save"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add Document" value="UPLOAD" />

              </form>

            </div>

          </div>

        </div>

    </div>