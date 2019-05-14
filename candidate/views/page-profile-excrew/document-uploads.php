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



    if(isset($_POST['_save'])){

      $namatable = 'sch_ex_candidate_document';

        $maxsize = 1024 * 1024; // 1MB



      if (!empty($_FILES["doc"]["name"])) {

            $fileSize  = $_FILES['doc']['size'];

            if($fileSize < $maxsize){

                $object->create_path();

                $uploadDoc = $object->uploadDocument();

                $data = array(

                'id_excrew'=>$authadmin['id'],

                'doc_name'=>$_POST['_doc_name'],

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

        <h4 style="text-align: center">EX CREW DOCUMENT UPLOADS</h4>

        <center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>

        <div class="card">

          <div class="card-header">



          </div>

        <div class="card-body">



          <span data-toggle="modal" data-target="#exampleModalCenter" class="btn btn-primary"><i class="fa fa-upload"></i>&nbsp;&nbsp;UPLOAD</span>

          <br><br>

          

          <h6>DOC TYPE : PREVIOUS SEA SERVICE</h6>

            <table class="table table-responsive-sm table-bordered table-striped table-sm">

                <thead>

                  <tr style="font-weight: bold;">

                    <td align="center">NO</td>

                    <td align="center">DOCUMENT NAME</td>

                    <td align="center">STATUS</td>

                    <td align="center">ACTION</td>

                  </tr>

                </thead>

                <tbody>

                <?php 

                  $sql = "SELECT * FROM sch_ex_candidate_document WHERE id_excrew = ".$authadmin['id']."";

                  $exp = $object->fetch_all($sql);

                  if (count($exp) > 0) {

                    $number = 1;

                    foreach ($exp as $docUpload) {?>

                <tr>

                  <td align="center"><?= $number; ?></td>

                  <td><?= $docUpload['doc_name'] ?></td>

                  <td align="center">

                    <span class="badge badge-success">SUCCESS</span>

                  </td>

                  <td align="center">

                    <a class="btn btn-success btn-sm" href="<?php echo BASE_URL ?>media/files/<?= $docUpload['file_upload'] ?>" target="_blank"><i class="fa fa-eye"></i></a>

                    <a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-document-uploads-excrew/<?php echo $docUpload['id']?>" onclick="return confirm('Confirm delete ?')" >

                    <i class="fa fa-trash-o "></i>

                  </td>

                </tr>

                <?php $number++; }} ?>

                <hr>

                </tbody>

              </table>

        </div>

        </div>

      </div>

    </div>

  </div>



    <!-- Modal -->

      <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">

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

                      <label class="col-md-3 col-form-label" for="doc">File Upload</label>

                      <div class="col-md-9">

                        <input type="file" class="form-control-file" id="doc" name="doc" accept=".pdf, .doc, .docx" required>

                      </div>

                     </div>

                </div>

              </div>

          </div>

             

            </div>

            <div class="modal-footer">

              <input type="hidden" name="_doc_name" value="Previous Sea Service">

              <input type="submit" name="_save"  class="btn btn-flat btn-primary" class="btn btn-flat btn-success" title="Add Document" value="UPLOAD" />

              </form>

            </div>

          </div>

        </div>

    </div>