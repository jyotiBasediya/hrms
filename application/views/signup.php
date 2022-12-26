
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Add New Project</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>project">
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
                          <form action="<?php echo site_url();?>signup/insert" method="post" data-parsley-validate>
                              <div class="">
                                 <h4 class="mb-4 font-weight-semibold">Sign Up</h4>  
                                
                                 <div class="form-group">
                                    <p>First Name</p>
                                    <input class="form-control" type="text" name="fname" required>
                                 </div> 
                                 <div class="form-group">
                                    <p>Last Name</p>
                                    <input class="form-control" type="text" name="lname" required>
                                 </div> 
                                 <div class="form-group">
                                    <p>Work Email Address</p>
                                    <input class="form-control" type="email" name="email">
                                 </div> 
                                 <div class="form-group">
                                    <p>Company Name</p>
                                    <input class="form-control" type="text" name="company_name">
                                 </div> 
                                <div class="form-group">
                                    <p>Mobile No.</p>
                                    <input class="form-control" type="text" name="number">
                                 </div> 
                                 <div class="form-group">
                                   
                                 <div class="text-center">
                                      <button class="btn btn-warning2 t mt-4 px-5">Signup</button>
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
