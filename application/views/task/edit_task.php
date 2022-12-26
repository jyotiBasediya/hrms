
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Update Task</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>task">
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
                          <form action="<?php echo site_url('task/updates') ?>" method="post" name="add_task" data-parsley-validate>
                                  <input type="hidden" name="id" value="<?php echo $task_detail->task_id; ?>">
                              <div class="">
                                 <h4 class="mb-4 font-weight-semibold">Task Description</h4>  
                                 <div class="form-group">
                                    <p>Task Name</p>
                                    <input class="form-control" type="text" name="task_name" data-parsley-required data-parsley-required-message="Please enter Task Name" value="<?php echo $task_detail->task_name; ?>">
                                 </div> 
                                   <div class="form-group">
                                 <!--   <p>Client Name</p>-->

                                    <!-- <input class="form-control" type="text" name="cname"> -->

                                 <!--   <select class="form-control" placeholder="Client Name" name="client_name">-->


                                      
                                 <!--   <?php foreach($task_detail as $row) {?>-->
                                 <!--       <option  value="<?php echo  $row->client_name; ?>">-->
                                 <!--                    <?php echo $row->client_name; ?></option>-->
                                 <!--                      <?php } ?>-->
                                 <!--                         </select>-->
                                                                  
                                 <!--</div> -->
                                 <!--<div class="form-group">-->
                                 <!--    <p>Project Name</p>-->
                                 <!--     <select class="form-control" placeholder="Client Name" name="project_name">-->
                                 <!--          <?php foreach($task_detail as $row) {?>-->
                                 <!--       <option  value="<?php echo  $row->project_name; ?>">-->
                                 <!--                    <?php echo $task_detail->project_name; ?></option>-->
                                 <!--                      <?php } ?>-->
                                 <!--                         </select>-->
                                 <!--         </select>-->
                                 <!--    </div>-->
                                 <div class="form-group">
                                    <p>Task Code</p>
                                    <input class="form-control" type="text" name="task_code" data-parsley-required data-parsley-required-message="Please enter Task Code" value="<?php echo $task_detail->task_code; ?>">
                                    <!-- <small>(suggested 3-5 characters)</small> -->
                                 </div>  
                                 <div class="form-group">
                                    <p>Accounting Package Task ID</p>
                                    <input class="form-control" type="number" name="task_id" data-parsley-required data-parsley-required-message="Please enter Accounting Package Task ID" value="<?php echo $task_detail->task_id; ?>">
                                 </div> 
                                 <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control" id="status" name="status" data-parsley-required data-parsley-required-message="Please select status">
                                      <option value="">Select Status</option>
                                      <option value="billing" <?php if('billing'==$task_detail->task_status){ echo 'selected'; } ?>>Billable </option>
                                      <option value="non_billing"<?php if('non_billing'==$task_detail->task_status){ echo 'selected'; } ?>>Non Billable</option>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control" name="notes"> <?php echo $task_detail->task_note; ?> </textarea>
                                 </div> 
                                 <div class="text-center">
                                      <button class="btn btn-warning2 t mt-4 px-5">Update</button>
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
            <!-- footer -->
          

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
  