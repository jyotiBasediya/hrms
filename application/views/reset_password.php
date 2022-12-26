<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::Arrow::</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?=base_url();?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/shared/style.css">
    <link rel="stylesheet" href="<?=base_url();?>assets/css/custom/style.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">

      <link rel="stylesheet" href="<?php echo base_url();?>assets/css/parsley.css">

    <!-- End Layout styles -->
    <link rel="shortcut icon" href="<?=base_url();?>assets/images/favicon.png" />

    <style type="text/css">
          .parsley-errors-list {
               list-style-type: none;
               padding-left: 0;
               color: #ff0000;
               }
        </style>

  <style type="text/css">
        .form-heading { color:#fff; font-size:23px;}
        .panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
        .panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
        .login-form .form-control {
        background: #f7f7f7 none repeat scroll 0 0;
        border: 1px solid #d4d4d4;
        border-radius: 4px;
        font-size: 14px;
        height: 50px;
        line-height: 50px;
        }
        .main-div {
        background: #ffffff none repeat scroll 0 0;
        border-radius: 2px;
        margin: 10px auto 30px;
        max-width: 38%;
        padding: 50px 70px 70px 71px;
        box-shadow: 0px 7px 60px -33px rgba(0,0,0, 0.5);
        }

        .login-form .form-group {
        margin-bottom:10px;
        }
        .login-form{ text-align:center;}
        .forgot a {
        color: #777777;
        font-size: 14px;
        text-decoration: underline;
        }
        .login-form  .btn.btn-primary {
        background: #f0ad4e none repeat scroll 0 0;
        border-color: #f0ad4e;
        color: #ffffff;
        font-size: 14px;
        width: 100%;
        height: 50px;
        line-height: 50px;
        padding: 0;
        }
        .forgot {
        text-align: left; margin-bottom:30px;
        }
        .botto-text {
        color: #ffffff;
        font-size: 14px;
        margin: auto;
        }
        .login-form .btn.btn-primary.reset {
        background: #ff9900 none repeat scroll 0 0;
        }
        .back { text-align: left; margin-top:10px;}
        .back a {color: #444444; font-size: 13px;text-decoration: none;}
        .main-panel
        {
          width: 100%;
          min-height: calc(100vh - 143px) !important;
        }
        .btn {
            padding: 0 45px;
            height: 46px;
            line-height: 0;
            border: none;
            font-size: 18px;
        }

    .btn-gradient3 {
      background: #f37d04 !important;
      background: -webkit-linear-gradient(331deg, #f37d04 11%, #b50705 55%) !important;
      background: -o-linear-gradient(331deg, #f37d04 11%, #b50705 55%) !important;
      background: linear-gradient(119deg, #f37d04 11%, #b50705 55%) !important;
      background-size: 101% auto !important;      }

  </style>

  <link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/toastr/toastr.min.css">
  </head>

  <body>
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
     
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
       <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">   
                 <div class="container">
                    <h1 class="form-heading my-5 text-center"><img width="320" src="<?=base_url();?>assets/images/logo.png"></h1>
                     <div class="">
                        <div class="">
                            
                             <form style="margin: 50px 0;" method="post" action="<?=base_url();?>Forgot_password/verify_resetpassword?user_id=<?=$id?>" data-parsley-validate>

        <input type="Password" placeholder="New Password" name="npwd" class="form-control p_input" id="npwd" placeholder="New Password" data-parsley-required data-parsley-required-message="Please Enter New Password" style="display: block;height:32px;padding-left: 15px;border-radius: 50px;box-shadow: none;border: 1px solid #ccc;outline: none;width: 60%;margin: 0 auto 20px;" onblur="checkRegex(this.value);">
        <!-- <input type="Password" placeholder="New Password" name="npwd" class="form-control p_input" id="npwd" placeholder="New Password" data-parsley-required data-parsley-required-message="Please Enter New Password" style="display: block;height:32px;padding-left: 15px;border-radius: 50px;box-shadow: none;border: 1px solid #ccc;outline: none;width: 60%;margin: 0 auto 20px;" data-parsley-pattern="/^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/" data-parsley-pattern-message="Password must be contain atleast 1 Uppercase letter, 1 lowercase letter,1 number,1 special character ,Eg. Abc@123" data-parsley-required>
        <span id="validate-status1"></span>
 -->
        <input type="Password" placeholder="Confirm New Password"  name="cpwd" class="form-control p_input" id="cpwd" placeholder="Confirm Password" data-parsley-required data-parsley-required-message="Please Enter Confirm New Password" data-parsley-equalto="#npwd" data-parsley-equalto-message="Password and Confirm password must be same" style="display: block;height:32px;padding-left: 15px;border-radius: 50px;box-shadow: none;border: 1px solid #ccc;outline: none;width: 60%;margin: 0 auto 20px;">

        <p id="validate-status"></p>

        <input id="forget_password" type="submit" value="submit" style="width: 63%;display: block;height: 40px;text-transform: uppercase;margin: 0 auto;border-radius: 50px;border: 2px solid #00afa9;background: transparent;outline: none;text-align: center;color: #333;font-weight: 600;cursor: pointer;">

      </form>




                         </div>

                     </div>
                 </div>
             </div>
  
       </div>
      </div>  
            <!-- content-wrapper ends -->
            <!-- footer -->
            <footer class="footer">
              <div class="container-fluid clearfix">
                <img width="180px" src="assets/images/logo.png">

                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block mr-5 ml-5">Copyright © 2020 aaravsolutions, Inc.</span>

                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block mr-5">Terms & conditions</span>

                <span class="text-muted d-block text-center text-sm-left d-sm-inline-block mr-5">Privacy Policy and Cookie Policy</span>
                
              </div>
            </footer>

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- js -->
    
    <script src="<?=base_url();?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?=base_url();?>assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="<?=base_url();?>assets/js/shared/off-canvas.js"></script>
    <script src="<?=base_url();?>assets/js/shared/misc.js"></script>
    <!-- <script src="<?=base_url();?>assets/js/dashboard/dashboard.js"></script> -->
     <!-- Custom js for this page-->
    <script src="<?=base_url();?>assets/js/shared/chart.js"></script>
    <!-- End custom js for this page-->
    <script src="<?=base_url();?>assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <!-- <script src="<?=base_url();?>assets/js/custom.js" type="text/javascript"></script> -->

    <!-- <script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script> -->
<!-- <script type="text/javascript" src="<?php echo base_url();?>skin/js_module/hrms_login.js"></script> -->
<script type="text/javascript" src="<?php echo base_url();?>skin/vendor/toastr/toastr.min.js"></script> 
  </body>
</html>
