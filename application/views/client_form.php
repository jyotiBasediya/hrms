
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
                        <button class="btn btn-secondary btn-fw mx-2">Next</button>
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
                          <form action="<?php echo site_url('add_client/register');?>" method="post">
                              <div class="">
                               <!--   <h4 class="mb-4 font-weight-semibold">Basic Information</h4> -->  
                                 <div class="form-group">
                                    <p>First Name</p>
                                    <input class="form-control" type="text" name="fname">
                                 </div> 
                                 <div class="form-group">
                                    <p>Last Name</p>
                                    <input class="form-control" type="text" name="lname">
                                 </div> 
                                 <div class="form-group">
                                    <p>Comapny Name</p>
                                    <input class="form-control" type="text" name="cname">
                                 </div> 
                                 <div class="form-group">
                                    <p>Contact Number</p>
                                    <input class="form-control" type="Number" name="cnumber">
                                 </div>
                                 <div class="form-group">
                                    <p>Contact Mail-Id</p>
                                    <input class="form-control" type="text" name="email">
                                 </div> 
                               <!--   <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control">
                                      <option>active </option>
                                      <option>inactive</option>
                                    </select>
                                 </div>  -->
                                 <!-- div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control">
                                      
                                    </textarea>
                                 </div>  -->
                                 <div class="text-center">
                                      <button class="btn btn-warning2 t mt-4 px-5">Save</button>
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