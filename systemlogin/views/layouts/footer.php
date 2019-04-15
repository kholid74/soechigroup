</div>

  <footer class="app-footer">
    <span>Copyright © Soechi Lines 2018. All Rights Reserved</span>
  </footer>

  <!-- Bootstrap and necessary plugins -->
  <script src="<?php echo $object->base_path()?>assets/js/jquery.min.js"></script>
  <script src="<?php echo $object->base_path()?>assets/js/popper.min.js"></script>
  <script src="<?php echo $object->base_path()?>assets/js/bootstrap.min.js"></script>
  <script src="<?php echo $object->base_path()?>assets/js/pace.min.js"></script>

  <!-- Plugins and scripts required by all views -->
  <script src="<?php echo $object->base_path()?>assets/plugins/chart.js/Chart.min.js"></script>
  <script src="<?php echo $object->base_path()?>assets/plugin/DataTables/DataTables-1.10.16/js/jquery.dataTables.min.js"></script>
  <script src="<?php echo $object->base_path()?>assets/plugin/DataTables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo $object->base_path()?>assets/plugin/DataTables/datatables.js"></script>
  <script src="<?php echo $object->base_path()?>assets/plugin/ckeditor/js/sample.js"></script>
  <script src="<?php echo $object->base_path()?>assets/plugin/ckeditor/ckeditor.js"></script>
  <script src="<?php echo $object->base_path()?>assets/plugin/fullcalendar/lib/moment.min.js"></script>
  <script src="<?php echo $object->base_path()?>assets/plugin/fullcalendar/fullcalendar.js"></script>
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
  } );

   $(document).ready(function() {
      $('#example1').DataTable();
  } );

    $(document).ready(function() {
      $('#example2').DataTable();
  } );

    $(document).ready(function() {
      $('#example3').DataTable();
  } );

    $(document).ready(function() {
      $('#example4').DataTable();
  } );
  </script>
  <script>
    $(function() {

    $('#calendar').fullCalendar({
      events: [
          {
            title  : 'Rizal Maulana',
            start  : '2018-05-09T12:30:00',
            allDay : false // will make the time show
          },
          {
            title  : 'Rizal Maulana',
            start  : '2018-05-09T13:30:00',
            allDay : false // will make the time show
          }
        ],
        textColor: 'white'
    })

  });
  </script>
  <script>
    var roxyFileman = '<?php echo $object->base_path()?>assets/plugin/ckeditor/plugins/fileman/index.html?integration=ckeditor';
      $(function() {
       CKEDITOR.replace('content', {
         filebrowserBrowseUrl: roxyFileman,
         filebrowserImageBrowseUrl: roxyFileman + '&type=image',
         removeDialogTabs: 'link:upload;image:upload'
       });
      });

      $(function() {
       CKEDITOR.replace('content1', {
         filebrowserBrowseUrl: roxyFileman,
         filebrowserImageBrowseUrl: roxyFileman + '&type=image',
         removeDialogTabs: 'link:upload;image:upload'
       });
      });
  </script>

  <script>
    function checkAvailability() {
      $("#loaderIcon").show();
      jQuery.ajax({
      url: "<?php echo $object->base_path()?>views/page-user/user-available-check.php",
      data:'username='+$("#username").val(),
      type: "POST",
      success:function(data){
        $("#user-availability-status").html(data);
        $("#loaderIcon").hide();
      },
      error:function (){}
      });
    }
</script>
<script>
$('#select').change(function(){

var textarea = $('_reason');
var select   = $('#_reason_reject').val();

textarea.hide();

if (select == 'Other'){
  textarea.show();
}else{
	textarea.hide();
}
});
</script>

  <!-- CoreUI main scripts -->

  <script src="<?php echo $object->base_path()?>assets/js/app.js"></script>

  <!-- Plugins and scripts required by this views -->

  <!-- Custom scripts required by this view -->
  <script src="<?php echo $object->base_path()?>assets/js/views/main.js"></script>

</body>
</html>