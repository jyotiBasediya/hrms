
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Update Project Cost</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>project_cost">
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
                          <form action="<?php echo base_url('update_project_cost');?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $project_cost_view->id; ?>">
                              <div class="">
                                 </div> 
                                 <input type="hidden" name="id" value="<?php echo $project_cost_view->id;?>">
                                 <div class="form-group">
                                    <p>Client Name</p>
                                    <input class="form-control" type="text" name="cname" value="<?php echo $project_cost_view->client_first_name;?> <?php echo $project_cost_view->client_last_name;?>" readonly>
                                 </div> 

                                  <div class="form-group">
                                    <p>Project Name</p>
                                    <input class="form-control" type="text" name="project_name" value="<?php echo $project_cost_view->project_name;?>" readonly>
                                 </div> 

                                  <div class="form-group">
                                    <p>Task Name</p>
                                    <input class="form-control" type="text" name="task_name" value="<?php echo $project_cost_view->task_name;?>" readonly>
                                 </div> 

                                  <div class="form-group">
                                    <p>Employee Name</p>
                                    <input class="form-control" type="text" name="cname" value="<?php echo $project_cost_view->first_name;?> <?php echo $project_cost_view->last_name;?>" readonly>
                                 </div> 

                                 <div class="form-group">
                                    <p>Currency</p>
                                    <input class="form-control" type="text" name="currency" value="<?php echo $project_cost_view->currency;?>" readonly>
                                 </div> 

                                  <div class="form-group">
                                    <p>Cost</p>
                                    <input class="form-control" type="text" name="cost" value="<?php echo $project_cost_view->cost;?>">
                                 </div> 

                                  <div class="form-group">
                                    <p>Hours</p>
                                    <input class="form-control" type="text" name="hours" value="<?php echo $project_cost_view->hours;?>">
                                 </div> 
                                
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
