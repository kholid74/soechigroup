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

  $catCandidate = $candidate['category'];

    if(isset($_POST['_save'])){
      $namatable = 'sch_cand_ship_document';
        $maxsize = 2250 * 2250; // 5MB

      if (!empty($_FILES["doc"]["name"])) {
            $fileSize  = $_FILES['doc']['size'];
            if($fileSize < $maxsize){
                $object->create_path();
                $uploadDoc = $object->uploadDocument();
                $data = array(
                'id_candidate'=>$authadmin['id'],
                'id_master_doc'=>$_POST['certName'],
                'document_number' => $_POST['docNumber'],
                'document_issue_place' => $_POST['docIssuePlace'],
                'document_issue_country' => $_POST['docIssueCountry'],
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
        <center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
        <div class="card">
          <div class="card-header">

          </div>
        <div class="card-body">

          <div class="row">
                      
                      <div class="col-sm-12">
                        <div class="card">
                          
                            <div class="card-body" style="background-color: #f0f3f5">
                                
                                <div class="" style="padding: 10px;">
                                  <h6 style="text-transform: uppercase;">NAME : <b><?= $candidate['first_name'] ?> <?= $candidate['last_name'] ?></b></h6>
                                  <h6 style="text-transform: uppercase;">POSITION : <b><?= $candidate['name'] ?> - <?= $candidate['short_name'] ?></b></h6>
                                  <h6 style="text-transform: uppercase;">CATEGORY : <b><?= $candidate['category'] ?></b></h6>
                                  <h6 style="text-transform: uppercase;">DECK/ENGINE : <b><?= $candidate['deck_engine'] ?></b></h6>
                                  </h6>
                                </div>

                                <span data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;&nbsp;UPLOAD</span>

                               <table class="table table-responsive-sm table-bordered table-striped table-sm">
                                  <thead>
                                    <tr style="font-weight: bold;">
                                      <td align="center">Document Name</td>
                                      <td align="center">Document Number</td>
                                      <td align="center">Document Issue Place</td>
                                      <td align="center">Document Issue Country</td>
                                      <td align="center">Date Issued</td>
                                      <td align="center">Date Expired</td>
                                      <td align="center">Status</td>
                                      <td align="center">Action</td>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  <?php 
                                    $sql = "SELECT * FROM sch_master_document_shipping WHERE category ='$catCandidate'";
                                    $exp = $object->fetch_all($sql);
                                    $count_all_doc = count($exp); 
                                    
                                    if (count($exp) > 0) {
                                      $number = 1;
                                      foreach ($exp as $docUpload) {

                                    $sql2    = "SELECT * FROM sch_cand_ship_document WHERE id_candidate =".$authadmin['id']." AND id_master_doc=".$docUpload['id']."";
                                    $candDoc = $object->fetch($sql2);

                                  ?>
                                  <tr>
                                    <td><?= $docUpload['document_name'] ?></td>
                                    <td><?= $candDoc['document_number'] ?></td>
                                    <td><?= $candDoc['document_issue_place'] ?></td>
                                    <td><?= $candDoc['document_issue_country'] ?></td>
                                    <td align="center"><?= $candDoc['date_issued'] ?></td>
                                    <td align="center"><?= $candDoc['date_expired'] ?></td>
                                    <td align="center">
                                    <?php if ($candDoc['id_master_doc'] == $docUpload['id']) { ?>
                                      <span class="badge badge-success">COMPLETE</span>
                                    <?php }else{ ?>
                                      <span class="badge badge-danger">INCOMPLETE</span>
                                    <?php } ?>
                                    </td>
                                    <td align="center">
                                      <?php if ($candDoc['id_master_doc'] == $docUpload['id']) { ?>
                                      <a class="btn btn-success btn-sm" href="<?php echo BASE_URL ?>media/files/<?=$candDoc['file_upload']?>" target='_blank'>
                                      <i class="fa fa-eye "></i>
                                      </a>
                                      <a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-document-upload/<?php echo $docUpload['id']?>" onclick="return confirm('Confirm delete ?')" >
                                      <i class="fa fa-trash-o "></i>
                                    <?php }else{} ?>
                                      </a>
                                    </td>
                                  </tr>
                                  <?php $number++; }}else{ ?>
                                  <tr>
                                    <td colspan="6" align="center">No document..</td>
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
                        
                          <select class="form-control" name="certName">
                            <?php 
                              $sql = "SELECT * FROM sch_master_document_shipping WHERE category ='$catCandidate'"; 
                              $exp = $object->fetch_all($sql);
                                foreach ($exp as $docUpload) { ?>
                            <option value="<?= $docUpload['id'] ?>"><?= $docUpload['document_name'] ?></option>
                            <?php } ?>
                          </select>

                      </div>
                     </div>
                      
                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="docNumber">Document Number</label>
                      <div class="col-md-8">
                        <input type="number" class="form-control" id="docNumber" name="docNumber" required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="docIssuePlace">Document Issue Place</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="docIssuePlace" name="docIssuePlace" required>
                      </div>
                     </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="docIssueCountry">Document Issue Country</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="docIssueCountry" name="docIssueCountry" required>
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
                        <input type="file" class="form-control-file" id="doc" name="doc" accept=".pdf" required>
                        <small><i>Maximum size 5 MB | File Allowed .pdf</i></small>
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