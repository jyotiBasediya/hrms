
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Edit Division</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>location">
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
                          <form action="<?php echo site_url('OrganizationController/edit_division/'.$division_detail->id);?>" method="post" data-parsley-validate enctype= "multipart/form-data">
                              <div class="">
                                <input type="hidden" name="location_id" value=" <?php echo $division_detail->id ?>">
                               <!--   <h4 class="mb-4 font-weight-semibold">Basic Information</h4> -->  
                                 <div class="form-group">
                                    <p>Name</p>
                                    <input class="form-control" type="text" name="name" value="<?php echo $division_detail->name ?>" data-parsley-required-message="Please enter Name" required data-parsley-group="block1" >
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