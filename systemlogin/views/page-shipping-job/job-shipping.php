

<!-- Main content -->

    <main class="main">



      <!-- Breadcrumb -->

      <ol class="breadcrumb">

        <li class="breadcrumb-item">Home</li>

        <li class="breadcrumb-item">Shipping</li>

        <li class="breadcrumb-item active">List Vacancy</li>



        <!-- Breadcrumb Menu-->

        <li class="breadcrumb-menu d-md-down-none">

          <div class="btn-group" role="group" aria-label="Button group">

            <span>You logged as <b><?php echo $object->logged_as($level); ?></b></span>

          </div>

        </li>

      </ol>



	<div class="container-fluid">

		<div id="ui-view" style="opacity: 1;">

			<div class="animated fadeIn">

				<h4 style="text-align: center">LIST VACANCY</h4>

				<center><span style="font-size: 15px;">VEKTOR MARITIM SHIP MANAGEMENT</span></center>	

				<div class="card">

					<div class="card-header">

					

						<a href="<?php echo $object->base_path()?>add-job-shipping" class="btn btn-primary"><i class="fa fa-plus "></i>&nbsp;Add New Vacancy</a>



					</div>

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



					<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">

						<thead>

							<tr>

								<td style="font-weight: bold;">No</td>

								<td style="font-weight: bold;">Category</td>

								<td style="font-weight: bold;">Job Vacancy</td>

								<td style="font-weight: bold;">Location</td>

								<td style="font-weight: bold;">Status</td>

								<td style="font-weight: bold;">Update by</td>

								<td style="font-weight: bold;">Date</td>

								<td style="font-weight: bold;">Action</td>

							</tr>

						</thead>

						<tbody>

							<?php 

						    	$sql = "SELECT a.*,b.name,b.deck_engine FROM sch_job_shipping a JOIN sch_master_crewrank b ON a.id_job_name=b.id ";

								$job = $object->fetch_all($sql);

								if (count($job) > 0) {

									$number = 1;

									foreach ($job as $jobs) {?>

							<tr>

								<td><?php echo $number;?></td>

								<td><?= $jobs['deck_engine'] ?></td>

								<td><?= $jobs['name'] ?></td>

								<td><?= $jobs['job_location'] ?></td>

								<td align="center"><span class='badge badge-success'><?= $jobs['status'] ?></span>

								</td>

								<td><?= $jobs['posted_by'] ?></td>

								<td><?= $jobs['modified'] ?></td>

								

								<!-- MODAL SHARE JOB -->

									<div class="modal fade" id="share" tabindex="-1" role="dialog" aria-labelledby="share" aria-hidden="true">

									  <div class="modal-dialog modal-dialog-centered" role="document">

									    <div class="modal-content">

									      <div class="modal-header">

									        <h5 class="modal-title" id="exampleModalLongTitle">Share to :</h5>

									        <button type="button" class="close" data-dismiss="modal" aria-label="Close">

									          <span aria-hidden="true">&times;</span>

									        </button>

									      </div>

									      <div class="modal-body" align="center">

									      

									      <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo BASE_URL ?>detail-shipping/<?= $jobs['id'] ?>-<?php echo $object->sluggify($jobs['name']); ?>" target="_blank" title="Share to Facebook"><i class="fa fa-facebook-square fa-5x"></i></a>



										  <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php echo BASE_URL ?>detail-shipping/<?= $jobs['id'] ?>-<?php echo $object->sluggify($jobs['name']); ?>" target="_blank" title="Share to Linkedin"><i class="fa fa-linkedin-square fa-5x"></i></a>

									          

									      </div>

									    </div>

									  </div>

									</div> 

							<!-- END MODAL SHARE JOB -->



								<td align="center">

									<a class="btn btn-info btn-sm" href="<?php echo $object->base_path()?>edit-job-shipping/<?php echo $jobs['id']?>" title="edit">

									<i class="fa fa-edit"></i>

									</a>

									<a class="btn btn-danger btn-sm" href="<?php echo $object->base_path()?>delete-job-shipping/<?php echo $jobs['id']?>" onclick="return confirm('Confirm delete ?')" title="delete">

									<i class="fa fa-trash-o "></i>

									</a>

									<span class="btn btn-success btn-sm" data-toggle="modal" data-target="#share" title="share">

									<i class="fa fa-share-alt "></i>

									</span>

								</td>

							</tr>

							<?php

					    	$number++;

					    	}}?>

						</tbody>

					</table>

				</div>

				</div>

			</div>

		</div>

	</div>



	

