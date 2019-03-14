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
  <script src="<?php echo $object->base_path()?>assets/plugin/SmartWizard/dist/js/jquery.smartWizard.min.js"></script>
  <script src="<?php echo $object->base_path()?>assets/plugin/sweetalert/dist/sweetalert.min.js"></script>
  
  <script>
    $(document).ready(function() {
      $('#example').DataTable();
  } );
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
      
      $(document).ready(function() {
        $('input[type=radio][name=unfinish_contract]').change(function() {
            if (this.value == 'YES') {
                $("#unfinish_contract_yes").show();
            }
            else {
                $("#unfinish_contract_yes").hide();
            }
        });
        $('input[type=radio][name=bad_experience]').change(function() {
            if (this.value == 'YES') {
                $("#bad_experience_yes").show();
            }
            else {
                $("#bad_experience_yes").hide();
            }
        });
        $('input[type=radio][name=legal_litigation]').change(function() {
            if (this.value == 'YES') {
                $("#legal_litigation_yes").show();
            }
            else {
                $("#legal_litigation_yes").hide();
            }
        });
    });
  </script>
  <script>
      
      $(document).ready(function() {
        $('input[type=radio][name=applied_before]').change(function() {
            if (this.value == 'YES') {
                $("#applied_before_yes").show();
            }
            else {
                $("#applied_before_yes").hide();
            }
        });
        $('input[type=radio][name=part_time]').change(function() {
            if (this.value == 'YES') {
                $("#part_time_yes").show();
            }
            else {
                $("#part_time_yes").hide();
            }
        });
        $('input[type=radio][name=friend_soechi]').change(function() {
            if (this.value == 'YES') {
                $("#friend_soechi_yes").show();
            }
            else {
                $("#friend_soechi_yes").hide();
            }
        });
        $('input[type=radio][name=suffered]').change(function() {
            if (this.value == 'YES') {
                $("#suffered_yes").show();
            }
            else {
                $("#suffered_yes").hide();
            }
        });
        $('input[type=radio][name=criminal]').change(function() {
            if (this.value == 'YES') {
                $("#criminal_yes").show();
            }
            else {
                $("#criminal_yes").hide();
            }
        });
        $('input[type=radio][name=ready_stationed]').change(function() {
            if (this.value == 'NO') {
                $("#ready_stationed_no").show();
            }
            else {
                $("#ready_stationed_no").hide();
            }
        });
        $('input[type=radio][name=overtime]').change(function() {
            if (this.value == 'NO') {
                $("#overtime_no").show();
            }
            else {
                $("#overtime_no").hide();
            }
        });
    });
  </script>
<script type="text/javascript">
  $(document).ready(function(){
    $('#smartwizard').smartWizard();
  });
</script>
<script>
      $(function(){
          var dtToday = new Date();
          
          var month = dtToday.getMonth() + 1;
          var day = dtToday.getDate();
          var year = dtToday.getFullYear();
          if(month < 10)
              month = '0' + month.toString();
          if(day < 10)
              day = '0' + day.toString();
          
          var maxDate = year + '-' + month + '-' + day;
          $('#txtDate').attr('min', maxDate);
      });
</script>
<script>
    function checkvalueethnic(val)
      {
          if(val==="OTHER")
             document.getElementById('ethnic_other').style.display='block';
          else
             document.getElementById('ethnic_other').style.display='none'; 
      }
  </script>
  <script>
    function checkvaluereligion(val)
      {
          if(val==="OTHER")
             document.getElementById('religion_other').style.display='block';
          else
             document.getElementById('religion_other').style.display='none'; 
      }
  </script>
  <script>
    function selectformal(val)
      {
          if(val==="SMA")
             document.getElementById('faculty').style.display='block';
          else
             document.getElementById('faculty').style.display='none'; 
      }
  </script>
  <!-- CoreUI main scripts -->

  <script src="<?php echo $object->base_path()?>assets/js/app.js"></script>

  <!-- Plugins and scripts required by this views -->

  <!-- Custom scripts required by this view -->
  <script src="<?php echo $object->base_path()?>assets/js/views/main.js"></script>

</body>
</html>