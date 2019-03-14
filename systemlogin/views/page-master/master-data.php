<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Master Data</li>

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
				<h4 style="text-align: center">MASTER DATA</h4>
				<center><span style="font-size: 15px;">VECTOR MARITIM SHIP MANAGEMENT</span></center>
				<div class="card">
					<div class="card-header"></div>
				<div class="card-body">

					<table class="table table-responsive-sm table-bordered table-striped table-sm" id="example">
						<thead>
							<tr>
								<td style="font-weight: bold;">No</td>
								<td style="font-weight: bold;">Master Name</td>
								<td style="font-weight: bold;">Action</td>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>1</td>
								<td>MASTER CREW RANK</td>
								<td align="center">
									<a class="btn btn-primary btn-sm" href="<?php echo $object->base_path()?>master-crew-rank"><i class="fa fa-gear"></i>&nbsp;&nbsp;MANAGE</a>
								</td>
							</tr>
							<tr>
								<td>2</td>
								<td>MASTER VESSEL</td>
								<td align="center">
									<a class="btn btn-primary btn-sm" href="<?php echo $object->base_path()?>master-vessel"><i class="fa fa-gear"></i>&nbsp;&nbsp;MANAGE</a>
								</td>
							</tr>
							<tr>
								<td>3</td>
								<td>MASTER REASON REJECT</td>
								<td align="center">
									<a class="btn btn-primary btn-sm" href="<?php echo $object->base_path()?>master-reason-reject"><i class="fa fa-gear"></i>&nbsp;&nbsp;MANAGE</a>
								</td>
							</tr>
							<!-- <tr>
								<td>4</td>
								<td>MASTER JOB NAME</td>
								<td align="center">
									<a class="btn btn-primary btn-sm" href="<?php echo $object->base_path()?>master-job-name"><i class="fa fa-gear"></i>&nbsp;&nbsp;MANAGE</a>
								</td>
							</tr> -->
							<tr>
								<td>4</td>
								<td>SHIPPING DECLARATION</td>
								<td align="center">
									<a class="btn btn-primary btn-sm" href="<?php echo $object->base_path()?>master-declaration-shipping"><i class="fa fa-gear"></i>&nbsp;&nbsp;MANAGE</a>
								</td>
							</tr>
							<tr>
								<td>5</td>
								<td>OFFICE DECLARATION</td>
								<td align="center">
									<a class="btn btn-primary btn-sm" href="<?php echo $object->base_path()?>master-declaration-office"><i class="fa fa-gear"></i>&nbsp;&nbsp;MANAGE</a>
								</td>
							</tr>
							<tr>
								<td>6</td>
								<td>SHIPPING DOCUMENT</td>
								<td align="center">
									<a class="btn btn-primary btn-sm" href="<?php echo $object->base_path()?>master-shipping-document"><i class="fa fa-gear"></i>&nbsp;&nbsp;MANAGE</a>
								</td>
							</tr>
							<tr>
								<td>7</td>
								<td>SETTING EMAIL BOC</td>
								<td align="center">
									<a class="btn btn-primary btn-sm" href="<?php echo $object->base_path()?>master-email-boc"><i class="fa fa-gear"></i>&nbsp;&nbsp;MANAGE</a>
								</td>
							</tr>
						</tbody>
					</table>

				</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal" id="crewRank" tabindex="-1" role="dialog" aria-labelledby="crewRank" aria-hidden="true">
	  <div class="modal-dialog modal-dialog-centered" role="document">
	    <div class="modal-content">
	      <div class="modal-header">
	        <h5 class="modal-title" id="exampleModalLongTitle">Add Crew Rank</h5>
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">&times;</span>
	        </button>
	      </div>
	      <div class="modal-body">
	       <div class="modal-body">
              <form role="form" method="POST" enctype="multipart/form-data">
              <div class="container-fluid">
              <div class="row">

                <div class="col-md-12">

                   <div class="form-group row">
	                  <label class="col-md-4 col-form-label" for="name">Name</label>
	                  <div class="col-md-8">
	                    <input type="text" class="form-control" id="name" name="name" required>
	                  </div>
	                 </div>

	                 <div class="form-group row">
	                  <label class="col-md-4 col-form-label" for="shortName">Short Name</label>
	                  <div class="col-md-8">
	                    <input type="text" class="form-control" id="shortName" name="shortName" required>
	                  </div>
	                 </div>

                     <div class="form-group row">
                      <label class="col-md-4 col-form-label" for="category">Category</label>
                      <div class="col-md-8">
                        <select name="category" id="category" class="form-control">
                          <option selected>- Choose Category -</option>
                          <option value="Deck Officer">Deck Officer</option>
                          <option value="Deck Officer Junior">Deck Officer Junior</option>
                          <option value="Deck Officer Senior">Deck Officer Senior</option>
                          <option value="Deck Rating">Deck Rating</option>
                          <option value="Deck Rating Senior">Deck Rating Senior</option>
                          <option value="Engine Officer">Engine Officer</option>
                          <option value="Engine Officer Trainee">Engine Officer Trainee</option>
                          <option value="Engine Officer Junior">Engine Officer Junior</option>
                          <option value="Engine Officer Senior">Engine Officer Senior</option>
                          <option value="Engine Rating">Engine Rating</option>
                        </select>
                      </div>
                     </div>

                     <div class="row">
                      <label class="col-md-3 col-form-label">Deck/Engine</label>
                      <div class="col-md-9 col-form-label">
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Deck" id="deck" name="_deckEngine" checked>
                          <label class="form-check-label" for="deck">
                            Deck
                          </label>
                        </div>
                        <div class="form-check">
                          <input class="form-check-input" type="radio" value="Engine" id="engine" name="_deckEngine">
                          <label class="form-check-label" for="engine">
                            Engine
                          </label>
                        </div>
                      </div>
                    </div>

                </div>
              </div>
          </div>
             
            </div>
	      </div>
	      <div class="modal-footer">
	        <input type="submit" name="_publish" class="btn btn-flat btn-primary" value="SAVE" />
	        </form>
	      </div>
	    </div>
	  </div>
	</div>
<!-- end modal -->