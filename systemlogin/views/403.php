<!-- Main content -->
    <main class="main">

      <!-- Breadcrumb -->
      <ol class="breadcrumb">
        <li class="breadcrumb-item">Home</li>
        <li class="breadcrumb-item"><a href="#">Admin</a></li>
        <li class="breadcrumb-item active">403</li>

        <!-- Breadcrumb Menu-->
        <li class="breadcrumb-menu d-md-down-none">
          <div class="btn-group" role="group" aria-label="Button group">
            <span>You logged as <b><?php echo $object->logged_as($level); ?></b></span>
          </div>
        </li>
      </ol>

    

      <div class="container-fluid">

        <div class="animated fadeIn">
          <div class="row" align="center">

          <b>You are not allowed to access this page!</b>

          </div>
          <!--/.row-->

        </div>

      </div>




      <!-- /.conainer-fluid -->
    </main>