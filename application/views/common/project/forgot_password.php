<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>::Arrow::</title>
    <!-- plugins:css -->

     <script src="<?php echo base_url(); ?>assets/jquery-3.3.1.min.js"></script>
     
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/iconfonts/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/iconfonts/ionicons/dist/css/ionicons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/css/vendor.bundle.addons.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/vendors/iconfonts/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/shared/style.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/custom/style.css">
     <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <!-- End Layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/images/favicon.png" />
     <link rel="stylesheet" href="<?php echo base_url();?>assets/css/parsley.css">

              <script src="<?php echo base_url(); ?>assets/toastr.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/toastr.min.css">

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

  <style type="text/css">
          .parsley-errors-list {
               list-style-type: none;
               padding-left: 0;
               color: #ff0000;
               }
        </style>
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
                    <h1 class="form-heading my-5 text-center"><img width="320" src="<?php echo base_url(); ?>assets/images/logo.png"></h1>
                     <div class="login-form">
                        <div class="main-div">
                            <h1>Forgot Password</h1>
                              <!-- <form class="mb-1" method="post" name="hrm-form" id="hrm-form" data-redirect="dashboard?module=dashboard" data-form-table="login" data-is-redirect="1"> -->

                                <form action="<?php echo site_url();?>send_mail" method="post" data-parsley-validate>
                                     <!-- <form class="mb-1" method="post" name="hrm-form" id="hrm-form" action="<?php echo site_url('login/login')?>"> -->

                              

                                <div class="form-group">
                                  <input type="text" class="form-control" name="iemail" id="iemail"  placeholder="Email Id" required="" data-parsley-required data-parsley-required-message="Enter Email Id">
                                </div>

                                  <div class="forgot">
                                  <a class=" font-90" href="<?php echo site_url('/');?>">Login</a>
                                </div>
                                
                                <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-gradient3 ">Remeber Password</button>
                    </div>

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
    
    <script src="<?php echo base_url(); ?>assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="<?php echo base_url(); ?>assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/shared/off-canvas.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/shared/misc.js"></script>
    <script src="<?php echo base_url(); ?>assets/js/dashboard/dashboard.js"></script>
     <!-- Custom js for this page-->
    <script src="<?php echo base_url(); ?>assets/js/shared/chart.js"></script>
    <!-- End custom js for this page-->
    <script src="<?php echo base_url(); ?>assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="<?php echo base_url(); ?>assets/js/custom.js" type="text/javascript"></script>

    <script type="text/javascript">var base_url = '<?php echo base_url(); ?>';</script>
<script type="text/javascript" src="<?php echo base_url();?>skin/js_module/hrms_login.js"></script>
  <script src="<?php echo base_url();?>assets/js/parsley.min.js" type="text/javascript"></script>

  </body>
</html>

   <script type="text/javascript">
        $('.alert-danger').delay(7000).fadeOut();    

        $('.alert').delay(5000).fadeOut(); 

        

        <?php if($this->session->flashdata('success')){ ?>

            toastr.success("<?php echo $this->session->flashdata('success'); ?>");

        <?php }else if($this->session->flashdata('error')){  ?>

            toastr.error("<?php echo $this->session->flashdata('error'); ?>");

        <?php }else if($this->session->flashdata('warning')){  ?>

            toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");

        <?php }else if($this->session->flashdata('info')){  ?>

            toastr.info("<?php echo $this->session->flashdata('info'); ?>");

        <?php } ?>
        </script>
