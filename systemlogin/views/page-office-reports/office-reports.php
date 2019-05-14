<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item">Office</li>
        <li class="breadcrumb-item active">Reports</li>

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
        <h4 style="text-align: center">REPORTS</h4>
        <center><span style="font-size: 15px;">SOECHI LINES</span></center> 
        <div class="card">
          <div class="card-header">
          
          </div>
        <div class="card-body" align="center">
        Generate Candidate Reports that Pass Interview to Excel Format
        <br><br>
        <form role="form" method="POST" enctype="multipart/form-data" action="views/page-office-reports/action_reports.php">
            <div class="row">
            
              <fieldset class="form-group">
                <label>Start Date</label>
                  <div class="input-group">
                    <span class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                      </span>
                    <input type="date" class="form-control" id="startdate" name="startdate" required/>
                  </div>
                <!-- <small class="text-muted">ex. 99/99/9999</small> -->
              </fieldset>

              &nbsp;&nbsp;&nbsp;

              <fieldset class="form-group">
                <label>End Date</label>
                  <div class="input-group">
                    <span class="input-group-prepend">
                      <span class="input-group-text">
                        <i class="fa fa-calendar"></i>
                      </span>
                      </span>
                    <input type="date" class="form-control" id="enddate" name="enddate" required/>
                  </div>
                <!-- <small class="text-muted">ex. 99/99/9999</small> -->
              </fieldset>
              &nbsp;&nbsp;&nbsp;

              <fieldset class="form-group">
                <label><br></label>
                  <div class="input-group">
                    <input type="submit" name="_generate" value="DOWNLOAD REPORTS" class="btn btn-primary">
<!--                     <i class="fa fa-file-excel-o" aria-hidden="true"></i> -->
                  </div>

              </fieldset>
              </form>
            </div>

        </div>
        </div>
      </div>
    </div>
  </div>

  
