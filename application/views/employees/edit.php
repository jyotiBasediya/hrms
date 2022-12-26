<!-- <?php $session = $this->session->userdata('username');?> -->

        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Update Employee</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>employees">
                        <button class="btn btn-secondary btn-fw">Cancel</button>
                      </a>

                        <button class="btn btn-secondary btn-fw mx-2">Next</button>
                  
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-8 grid-margin stretch-card m-auto">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                       <div class="col-lg-12">
    
                          <form action="<?php echo base_url('employees/updates');?>" method="post" name="add_employee">
                              <div class="">
                              	<input type="hidden" name="id" value="<?php echo $employees_detail->id; ?>">
                                 <div class="form-group">
                                    <p>Full Name</p>
                                    <input class="form-control" type="text" name="full_name" value="<?php echo $employees_detail->full_name;?>">
                                 </div> 
                                 <div class="form-group">
                                    <p>Email Address</p>
                                    <input class="form-control" type="text" name="email" value="<?php echo $employees_detail->email; ?>">
                                 </div> 
                                   <div class="text-center">
                                      <button class="btn btn-warning2 t mt-4 px-5">Update</button>
                                    </div> 
                                 <!-- <div class="form-group">
                                    <p>Start Date</p>
                                    <input class="form-control" type="Date" name="sdate">
                                 </div>  -->
                                 <!-- div class="form-group">
                                    <p>End Date</p>
                                    <input class="form-control" type="date" name="edate">
                                 </div>  -->
                                <!--  <div class="form-group">
                                    <p>Role</p>
                                    <input class="form-control" type="" name="role">
                                 </div>  -->
                               <!--   <div class="form-group">
                                    <p>Employment</p>
                                    <select class="form-control" name="employment">
                                        <option>Contractor</option>
                                        <option>Full-time employee</option>
                                        <option>Hourly employee</option>
                                        <option>Standard</option>
                                    </select>
                                 </div>  -->
                                 <!-- <div class="form-group">
                                    <p>Division</p>
                                    <select class="form-control" name="division">
                                      <option>No Division</option>
                                    </select>
                                 </div>  -->
                                 <!-- <div class="form-group">
                                    <p>Default Task:</p>
                                    <input class="form-control" type="" name="task">
                                 </div>  -->
                                <!--  <div class="form-group">
                                    <p>Employee Number</p>
                                    <input class="form-control" type="" name="enumuber">
                                 </div> --> 
                                 <!-- <div class="form-group">
                                    <p>Accounting Package Person ID</p>
                                    <input class="form-control" type="" name="account">
                                 </div>  -->
                                <!--  <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control" name="status">
                                      <option>active </option>
                                      <option>inactive</option>
                                    </select>
                                 </div> --> 
                               <!--   <div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control" name="note" required>
                                      
                                    </textarea>
                                 </div>  -->
                               <!--   <div class="form-group">
                                    <p>Password</p>
                                    <input class="form-control" type="password" name="password">
                                 </div> --> 
                                 <!-- <div class="form-group">
                                    <p>Confirm Password</p>
                                    <input class="form-control" type="password" name="cpass">

                                 </div> --> 
                                 <!-- <div class="">
                                    <input type="checkbox" name=""> Email sign-in instructions with password (this can be sent later or at anytime)

                                 </div>  -->
                             <!--  </div> 
                              <div class="mt-5"> -->
                                  <!-- h4 class="font-weight-semibold mb-0">Timesheet Settings & Approvals</h4> -->
                                 <!--  <p class="mb-4 small text-muted">Set approvers and edit timesheet settings for this person.</p> -->

                                 <!--  <h5 class="font-weight-semibold mb-0">Approvals</h5> -->
                                  <!-- <p class="mb-4 small text-muted">It may take a few moments to populate the most current approvers.</p> -->
<!-- 
                                  <div class="form-group"> -->

                                     <!--  <select class="form-control" placeholder = "Select One.."> -->
<!-- 
                                                     <option  disabled="" value="" ng-hide="true" class="ng-hide" selected="selected">Select One</option>
                                                     <option> Sohel Khan</option> -->
                       <!-- <?php foreach($groups as $row) {?>
                                         <option  value="<?php echo $row['id']?>">
                                                     <?php echo $row['full_name']?></option>
                                                       <?php } ?>
 -->                                                     
                                  <!--     </select> -->
                                
                                  <!--     <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Timesheets are approved by </p>
                                  </div>  --> 

                                 <!--  <div class="form-group">
                                      <select class="form-control">

        
                                     <?php foreach($groups as $row) {?>
                                         <option  value="<?php echo $row['id']?>">
                                                     <?php echo $row['full_name']?></option>
                                                       <?php } ?>
                                                     
                                      </select>
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Time off is approved by </p>
                                  </div>  --> 
<!-- 
                                  <div class="form-group"> -->
                                      <!-- <select class="form-control"> -->
                                         
                                                     <!-- <option  disabled="" value="" ng-hide="true" class="ng-hide" selected="selected">Select One</option>
                                                     -->
                                               
                                       <!-- <?php foreach($groups as $row) {?>
                                         <option  value="<?php echo $row['id']?>">
                                                     <?php echo $row['full_name']?></option>
                                                       <?php } ?> -->
                                                                  
                                  <!--     </select> -->
                                   <!--    <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Expenses are approved by </p>
                                  </div>   -->
                            <!--   </div>   -->
                              <!-- <div class="mt-5"> -->
                                  <!-- <h4 class="font-weight-semibold mb-0">Settings</h4>
                                  <p class="mb-4 small text-muted">Set approvers and edit timesheet settings for this person.</p> -->

                               <!--    <div class="form-group">
                                     <div class="d-flex align-items-center mb-4"> 
                                        <input class="form-control w-25" type="" name="">
                                        <span class="mx-2">hours per</span> 
                                        <select class="form-control w-25">
                                         <option>Day</option>
                                         <option>Week</option>
                                        </select>
                                        <span class="mx-2">are entered</span>
                                     </div> 
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Timesheet is incomplete if less than </p>
                                  </div>  --> 

                                 <!--  <div class="form-group">
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Incomplete timesheets cannot be submitted </p>
                                  </div>   -->

                                <!--   <div class="form-group">
                                      
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Notes must be entered with every time entry
                                      </p>
                                  </div>  -->
                              <!--     <div class="form-group">
                                      
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name=""> Start and end times must be entered with every time entry
                                      </p>
                                  </div> -->
                                 <!--  <div class="form-group pl-5">
                                      
                                      <p class="mt-2"><input class="mr-2" type="checkbox" name="">Allow entering break times (for meals, breaks, etc.)
                                      </p>

                                      <p class="mt-2"><input class="mr-2" type="checkbox" name="">Prevent stopwatches from being restarted</p>

                                      <p class="mt-2 pl-5"><input class="mr-2" type="checkbox" name="">Time can only be entered with a stopwatch
                                      </p>
                                  </div> -->

                           <!--    </div>  -->

                              <!--  <div class="mt-5"> -->
                                  <!-- <h4 class="font-weight-semibold mb-0">Costs</h4> -->
                              <!--     <p class="mb-4 small text-muted">The hourly cost rate associated with this person.</p> -->

                                  <!-- <h5>The estimated cost rate for this person is:</h5> -->
                                 <!--  <div class="d-flex justify-content-between align-items-center border-top border-bottom mt-4 py-1">
                                      <div class="align-items-center d-flex"> -->
                                         <!-- <span class="mr-2 p-3">RS</span> -->
                                       <!--   <input class="form-control w-25" type="" name="">
                                      </div> -->
                                     <!--  <p class="mb-0 text-muted font-italic">The company default is set to Rs75/hr.</p> -->
                                 <!--  </div>
                                  <div class="d-inline-block w-100">   -->
                                   <!--  <a class="btn btn-warning2 btn-rounded mt-3 float-right"> 
                                     <i class="fa fa-magic py-2" aria-hidden="true"></i>
                                    </a>  -->

                                   <!--  <div class="costWizardArrowText">Looking for a more accurate number? Click the icon to get started!</div> -->
                          <!--         </div>  -->
                                  

                      



                                  </div>
                                </div>
                                
                              </div>  
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
    <!-- <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script>
      Custom js for this page-->
    <!-- <script src="assets/js/shared/chart.js"></script> -->
    <!-- End custom js for this page-->
    <!-- <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
  </body>
</html> --> 