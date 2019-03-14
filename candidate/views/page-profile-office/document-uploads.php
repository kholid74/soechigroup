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

  $sql = "SELECT a.*,b.job_name,b.id_jobcat,c.*,d.category_name FROM sch_candidate_shipping a JOIN sch_jobs b ON a.id_job = b.id JOIN sch_countries c ON a.id_countries=c.num_code JOIN sch_job_shipping_cat d ON b.id_jobcat=d.id WHERE a.id=".$authadmin['id']."";
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
        <center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
        <div class="card">
          <div class="card-header">

          </div>
        <div class="card-body">

          <span data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;&nbsp;UPLOAD</span>
          <br><br>
          
          <h6>DOC TYPE : STCW CERTIFICATES, OTHER</h6>
            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                  <tr style="font-weight: bold;">
                    <td align="center">NO</td>
                    <td align="center">DOCUMENT NAME</td>
                    <td align="center">DATE ISSUED</td>
                    <td align="center">DATE EXPIRED</td>
                    <td align="center">FILE</td>
                    <td align="center">STATUS</td>
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
                  <td align="center"><?= $number; ?></td>
                  <td><?= $docUpload['doc_name'] ?></td>
                  <td><?= $docUpload['date_issued'] ?></td>
                  <td><?= $docUpload['date_expired'] ?></td>
                  <td align="center"><a href="<?php echo BASE_URL ?>media/files/<?= $docUpload['file_upload'] ?>" target="_blank"><i class="fa fa-file"></i></a></td>
                  <td align="center">
                    <span class="badge badge-success">SUCCESS</span>
                  </td>
                </tr>
                <?php $number++; }} ?>
                <hr>
                </tbody>
              </table>

          <h6> DOC TYPE : CV, SEAMAN BOOK, CONTRACT</h6>
            <table class="table table-responsive-sm table-bordered table-striped table-sm">
                <thead>
                  <tr style="font-weight: bold;">
                    <td align="center">NO</td>
                    <td align="center">DOCUMENT NAME</td>
                    <td align="center">FILE</td>
                    <td align="center">STATUS</td>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td align="center">1</td>
                    <td>CV</td>
                    <td align="center">
                      <a href="<?php echo BASE_URL ?>media/files/<?= $candidate['cv'] ?>" target="_blank"><i class="fa fa-file"></i></a>
                    </td>
                    <td align="center"><span class="badge badge-success">SUCCESS</span></td>
                  </tr>
                  <tr>
                    <td align="center">2</td>
                    <td>Seaman Book</td>
                    <td align="center">
                      <a href="<?php echo BASE_URL ?>media/files/<?= $candidate['seaman_book'] ?>" target="_blank"><i class="fa fa-file"></i></a>
                    </td>
                    <td align="center"><span class="badge badge-success">SUCCESS</span></td>
                  </tr>
                  <tr>
                    <td align="center">3</td>
                    <td>Contract</td>
                    <td align="center">
                      <a href="<?php echo BASE_URL ?>media/files/<?= $candidate['contract'] ?>" target="_blank"><i class="fa fa-file"></i></a>
                    </td>
                    <td align="center"><span class="badge badge-success">SUCCESS</span></td>
                  </tr>
                  
                <hr>
                </tbody>
              </table>
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
                      <label class="col-md-4 col-form-label" for="certName">Certificate Name</label>
                      <div class="col-md-8">
                        <input type="text" class="form-control" id="certName" name="certName" required>
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