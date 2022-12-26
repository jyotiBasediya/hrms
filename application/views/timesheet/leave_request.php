
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Apply for Leave</h3>
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
                          <form action="<?php echo site_url();?>timesheet/insert" method="post" data-parsley-validate>
                              <div class="">
                                 <h4 class="mb-4 font-weight-semibold">Make a Request</h4>  
                                 <div class="form-group">
                                    <p>Leave Type</p>

                                    <!-- <input class="form-control" type="text" name="cname"> -->

                                    <select class="form-control" name="leave_type">

                                   <option value disabled class selected="selected">Select Leave Type</option>
                                  <option value="">Casual Leave</option>
                                  <option value="">Vacation Leave</option>
                                  <option value="">Medical Leave</option>
                                                          </select>
                                                                  
                                 </div> 
                                 <div class="form-group">
                                    <p>from</p>
                                    <input class="form-control" name="sdate"  id="txtFrom" autocomplete="off" required>
                                 </div> 
                                 <div class="form-group">
                                    <p>to</p>
                                    <input class="form-control"  name="edate" id="txtTo" autocomplete="off">
                                  </div>
                                   <div class="form-group">
                                    <p>Hours:</p>
                                   <textarea class="form-group">

                                    <?php echo "date(mm/dd/yy)"; ?>
                                     
                                   </textarea>
                                  </div>
                                   <div class="form-group">
                                    <p>Note (optional):</p>
                                    <textarea  class="form-control" name="note" >
                                      
                                    </textarea>
                                 </div> 
                                 <div class="text-center">
                                      <button class="btn btn-warning2 t mt-4 px-5">Submit</button>
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
