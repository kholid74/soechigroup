    <div class="container-fluid" id="footer" style="margin-top: 50px;">
      <div class="container" id="footer-container">
        <div class="row">
            <div class="col-md-3">
              <img src="<?php echo $halaman->base_path()?>assets/img/logo.png" style="max-width: 200px;margin-bottom: 10px;" alt="">
              <h5 style="font-size: 18px;">PT SOECHI LINES Tbk</h5>
              <h6 style="font-size: 15px;">HEAD OFFICE</h6>
              <p style="font-size: 13px;">Sahid Sudirman Center 51st Floor <br>
              Jl. Jend Sudirman, Kav 86 <br>
              Jakarta Pusat 10220, Indonesia <br>
              P +6221-8086-1000 <br>
              F +6221-8086-1001</p>
            </div>
            <div class="col-md-3">
              <p style="color: #000000;font-size: 13px;font-weight: bold;margin-left: 40px;">ABOUT US</p>
              <ul style="list-style-type:none;color: #B6B8BA;font-size: 13px;">
                <li><a href="#" style="color: #000000">MESSAGE FROM CEO</a></li>
                <li><a href="#" style="color: #000000">BOARD OF COMMISSIONERS & BOARD OF DIRECTORS</a></li>
                <li><a href="#" style="color: #000000">JOURNEY IN BRIEF</a></li>
                <li><a href="#" style="color: #000000">VISION, MISSION & VALUES</a></li>
                <li><a href="#" style="color: #000000">MILESTONES</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <p style="color: #000000;font-size: 13px;font-weight: bold;margin-left: 40px;">OUR SERVICES</p>
              <ul style="list-style-type:none;color: #B6B8BA;font-size: 13px;">
                <li><a href="#" style="color: #000000">OUR TANKERS</a></li>
                <li><a href="#" style="color: #000000">OUR SHIPYARD</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <p style="color: #000000;font-size: 13px;font-weight: bold;margin-left: 40px;">INVESTOR RELATION</p>
              <ul style="list-style-type:none;color: #B6B8BA;font-size: 13px;">
                <li><a href="#" style="color: #000000">CORPORATE ACTION</a></li>
                <li><a href="#" style="color: #000000">PROSPECTUS</a></li>
                <li><a href="#" style="color: #000000">FINANCIAL REPORT</a></li>
                <li><a href="#" style="color: #000000">ANNUAL REPORT</a></li>
                <li><a href="#" style="color: #000000">PRESS RELEASE/ANNOUNCEMENT</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              
            </div>
            <div class="col-md-3">
              <p style="color: #000000;font-size: 13px;font-weight: bold;margin-left: 40px;">FLEET</p>
            </div>
            <div class="col-md-3">
              <p style="color: #000000;font-size: 13px;font-weight: bold;margin-left: 40px;">GCG</p>
              <ul style="list-style-type:none;color: #B6B8BA;font-size: 13px;">
                <li><a href="#" style="color: #000000">AUDIT COMMITTEE PROFILE</a></li>
                <li><a href="#" style="color: #000000">AUDIT COMMITTEE CHARTER</a></li>
                <li><a href="#" style="color: #000000">CORPORATE SECRETARY</a></li>
                <li><a href="#" style="color: #000000">VISION, MISSION & VALUES</a></li>
                <li><a href="#" style="color: #000000">CORPORATE SOCIAL RESPONBILITY</a></li>
              </ul>
            </div>
            <div class="col-md-3">
              <p style="color: #000000;font-size: 13px;font-weight: bold;margin-left: 40px;">CAREERS</p>
              <ul style="list-style-type:none;color: #B6B8BA;font-size: 13px;">
                <li><a href="#" style="color: #000000">CAREER</a></li>
                <li><a href="#" style="color: #000000">CONTACT US</a></li>
                <li><a href="#" style="color: #000000">PROCUREMENT</a></li>
              </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 copyright" align="left" style="margin-bottom: 50px;">
                <small>Copyright © Soechi Lines <?php echo date("Y"); ?>. All Rights Reserved</small>
            </div>
        </div>
      </div>
    </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    
    <script src="<?php echo $halaman->base_path()?>assets/js/jquery-3.2.1.min.js"></script>
    <script src="<?php echo $halaman->base_path()?>assets/js/popper.min.js"></script>
    <!-- <script src="<?php echo $halaman->base_path()?>assets/js/wizard.js"></script> -->
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="<?php echo $halaman->base_path()?>assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/plugins/alertify/alertify.min.js"></script>
    <script src="<?php echo $halaman->base_path()?>assets/js/jquery.chained.min.js"></script>  
    <script>
      function onlyNumber(e, decimal) {
          var key;
          var keychar;
           if (window.event) {
               key = window.event.keyCode;
           } else
           if (e) {
               key = e.which;
           } else return true;
          keychar = String.fromCharCode(key);
          if ((key==null) || (key==0) || (key==8) ||  (key==9) || (key==13) || (key==27) ) {
              return true;
          } else
          if (((".,0123456789").indexOf(keychar) > -1)) {
              return true;
          } else
          if (decimal && (keychar == ".")) {
              return true;
          } else return false;
      }
    </script>

    <script>
        $("#city").chained("#province");
    </script>
    <script>
      $("#cur_city").chained("#cur_province");
    </script>
    <script>
      $("#smpCity").chained("#smpProvince");
    </script>
    <script>
      
      $(document).ready(function() {
        
        $('input[type=radio][name=applied_before]').change(function() {
            if (this.value == 'YES') {
                $("#applied_before_yes").show();
                $('#applied_before_yes').prop('required', true);
            }
            else {
                $("#applied_before_yes").hide();
                $('#applied_before_yes').prop('required', false);
            }

        });
        $('input[type=radio][name=part_time]').change(function() {
            if (this.value == 'YES') {
                $("#part_time_yes").show();
                $('#part_time_yes').prop('required', true);
            }
            else {
                $("#part_time_yes").hide();
                $('#part_time_yes').prop('required', false);
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
  </body>
</html>