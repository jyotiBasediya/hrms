
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Add New Client</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>add_client">
                        <button class="btn btn-secondary btn-fw">Cancel</button>
                      </a>
                        <!-- <button class="btn btn-secondary btn-fw mx-2">Next</button> -->
                      <!--  -->
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-8 grid-margin stretch-card m-auto">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                       <div class="col-lg-12">
                          <form action="<?php echo site_url('add_client/register');?>" method="post" data-parsley-validate enctype= "multipart/form-data">
                              <div class="">
                               <!--   <h4 class="mb-4 font-weight-semibold">Basic Information</h4> -->  
                                 <!-- <div class="form-group">
                                    <p>First Name</p>
                                    <input class="form-control" type="text" name="fname" data-parsley-required-message="Please enter First Name" required data-parsley-group="block1" >
                                 </div> 
                                 <div class="form-group">
                                    <p>Last Name</p>
                                    <input class="form-control" type="text" name="lname" data-parsley-required-message="Please enter Last Name" required data-parsley-group="block1"> 
                                 </div>  -->
                                 <div class="form-group">
                                    <p>Company Name</p>
                                    <input class="form-control" type="text" name="cname" data-parsley-required-message="Please enter Company Name" required="">
                                 </div> 
                                  <div class="form-group">
                                    <p>Company Address</p>
                                    <input class="form-control" type="text" name="company_address" data-parsley-required-message="Please enter Company Name" required="">
                                 </div>

                                  <div class="form-group">
                                    <p>Contact Person Name</p>
                                    <input class="form-control" type="text" name="person_name" data-parsley-required-message="Please enter Company Name" required="">
                                 </div>
                                 <div class="form-group">
                                    <p>Contact Number</p>
                                    <input class="form-control" type="text" name="cnumber" data-parsley-required-message="Please enter Contact Number"  required data-parsley-required data-parsley-required-message="Enter mobile number" data-parsley-type="number" data-parsley-required-message="Only number allow" pattern="[1-9]{1}[0-9]{9}"  data-parsley-pattern-message="Enter maxlength 10 digit"  maxlength="10" data-parsley-maxlength-message="Maxlength 10 digit">
                                 </div>
                                 <div class="form-group">
                                    <p>Contact Mail-Id</p>
                                    <input class="form-control" type="email" name="email" data-parsley-required-message="Please enter Contact Mail-Id" required="" data-parsley-type="email">
                                 </div> 
                                 <div class="form-group">
                                    <p>Gst Number</p>
                                   <input class="form-control" type="text" name="gst_number" data-parsley-required-message="Please enter Company Name" required="">
                                    <!-- <input type="file" id="myfile" name="picture" multiple><br><br>  -->
                                 </div>

                                  <div class="form-group">
                                    <p>PAN Number</p>
                                   <input class="form-control" type="text" name="pan_number" data-parsley-required-message="Please enter PAN Number" required="">
                                    <!-- <input type="file" id="myfile" name="picture" multiple><br><br>  -->
                                 </div>

                                  <div class="form-group">
                                    <p>SPOC Number</p>
                                   <input class="form-control" type="text" name="spoc_name" data-parsley-required-message="Please enter Company Name" required="">
                                    <!-- <input type="file" id="myfile" name="picture" multiple><br><br>  -->
                                 </div>
                                 
                                 
                                  <div class="form-group">
                                    <p>Company Document </p>
                                    <input type="file" id="myfile" name="picture" onchange="readURL(this);" ><br><br> 

                                     <img id="admin_img" name="image" class="mb-3" src="<?php echo base_url().'uploads/gst/default.png'?>" alt="your image" width="100px" height="100px" />
                                 </div>
                                  <div class="text-center">
                <input type="submit" class="btn btn-warning2 t mt-4 px-5" name="userSubmit" value="Save">
            </div>
                              </div>     
                          </form>
                       </div>      
                    </div>  
                  </div>
                   </div>
                  </div>
                </div>  

            </div>
            <!-- content-wrapper ends -->
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- js -->
<!--     <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script>
     <!-Custom js for this page-->
    <!-- <script src="assets/js/shared/chart.js"></script> -->
    <!-- End custom js for this page-->
    <!-- <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
  </body>
</html>  -->

<script type="text/javascript">
  function readURL(input) {

      if (input.files && input.files[0]) {

        var reader = new FileReader();

        reader.onload = function(e) {

          $('#admin_img').attr('src', e.target.result);

          $('.image-upload-wrap').hide();

    

          $('.file-upload-image').attr('src', e.target.result);

          $('.file-upload-content').show();

    

          $('.image-title').html(input.files[0].name);

        };

        reader.readAsDataURL(input.files[0]);

      } else {

        removeUpload();

      }

      $("#imgInp").change(function(){

        readURL(this);

      });

    }
</script>