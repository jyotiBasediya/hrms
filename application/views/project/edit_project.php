
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Update Project</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>project">
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
                          <form action="<?php echo base_url('project/updates');?>" method="post">
                            <input type="hidden" name="id" value="<?php echo $project_detail->id; ?>">
                              <div class="">
                                 <p>Company Name</p>
                                    <select class="form-control" placeholder="Client Name" name="cname" disabled="">
                                      <?php foreach($clients as $row) {?>
                                        <option  value="<?php echo  $row['id']?>" <?php if($row['id']==$project_detail->client_name){ echo 'selected'; } ?>>
                                            <?php echo $row['first_name']." " .$row['last_name']?>
                                                       
                                          </option>
                                          <?php } ?>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Project Manager</p>
                                    <select class="form-control" placeholder="Project Manager" name="project_manager" id="project_manager">
                                       <option value="">Select Project Manager</option>
                                      <?php foreach($employees as $row) {?>
                                        <option  value="<?php echo  $row['user_id']?>" <?php if($row['user_id']==$project_detail->project_manager){ echo 'selected'; } ?>>
                                                     <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                                    </select>
                                                                  
                                 </div> 
                                 <div class="form-group">
                                    <p>Project Name</p>
                                    <input class="form-control" type="text" name="cname" value="<?php echo $project_detail->project_name;?>">
                                 </div> 

                                 <div class="form-group">
                                    <p>Project Short Name</p>
                                    <input class="form-control" type="text" name="sname" value="<?php echo $project_detail->short_name;?>">
                                 </div> 
                                 <div class="form-group">
                                    <p>Project Number</p>
                                    <input class="form-control" type="text" name="pnumber" value="<?php echo $project_detail->project_number;?>">
                                 </div> 
                                 <div class="form-group">
                                    <p>Accounting Package Client ID</p>
                                    <input class="form-control" type="text" name="cid" value="<?php echo $project_detail->client_id;?>">
                                 </div> 
                                 <!--  <div class="form-group multi_select_box">
                                    <p>Assign To</p>
                                      <select class="form-control" data-live-search="true" name="employee_name[]" id="employee_id" multiple>
                                       <option value="">Select Employee Assign To</option>
                                      <?php foreach($employees as $row) {?>
                                       <option data-tokens="<?php echo $row['user_id']; ?>" value="<?php echo $row['user_id']; ?>" ><?php echo $row['first_name']." " .$row['last_name']?></option>
                                       <?php } ?>
                                    </select>
                                    
                                  </div> -->

                                 <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control" name="status" value="<?php echo $project_detail->status;?>">
                                      <option value="active" <?php if($project_detail->status=='active'){ echo 'selected'; } ?>>Active </option>
                                      <option value="inactive" <?php if($project_detail->status=='inactive'){ echo 'selected'; } ?>>Inactive</option>
                                    </select>
                                 </div> 
                                 <div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control" name="notes">

                                      <?php echo $project_detail->notes;?>
                                      
                                    </textarea>
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
    
    <script>
        $( document ).ready(function() {
        $('#employee_id').select2();
        $('#client_name').select2();
        $('#project_manager').select2();
        $('#currency').select2();
    });
</script>