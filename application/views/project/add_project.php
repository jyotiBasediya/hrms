
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Add New Project</h3>
                    <div class="d-flex float-right"> 
                      <a href="<?php echo site_url();?>add_project">
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
                          <form action="<?php echo site_url();?>add_project/insert" method="post" data-parsley-validate>
                              <div class="">
                                 <h4 class="mb-4 font-weight-semibold">Basic Information</h4>  
                                 <div class="form-group">
                                    <p>Company Name</p>

                                    <!-- <input class="form-control" type="text" name="cname"> -->

                                    <select class="form-control" placeholder="Client Name" name="client_name" id="client_name">
                                       <option value="">Select Company</option>
                                    <?php foreach($clients as $row) {?>
                                        <option  value="<?php echo  $row['id'];?>">
                                                     <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                                                          </select>
                                                                  
                                 </div> 
                                
                                 <div class="form-group">
                                    <p>Project Manager</p>
                                    <select class="form-control" placeholder="Project Manager" name="project_manager" id="project_manager">
                                       <option value="">Select Project Manager</option>
                                      <?php foreach($employees as $row) {?>
                                       <option  value="<?php echo  $row['user_id'];?>">
                                                     <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                                    </select>
                                                                  
                                 </div> 
                                 <div class="form-group">
                                    <p>Project Name</p>
                                    <input class="form-control" type="text" name="cname" required="">
                                 </div> 
                                 <div class="form-group">
                                    <p>Project Short Name</p>
                                    <input class="form-control" type="text" name="sname" required="">
                                 </div> 
                                 <div class="form-group">
                                    <p>Project Number</p>
                                    <input class="form-control" type="text" name="pnumber">
                                 </div> 
                                 <div class="form-group">
                                    <p>Accounting Package Client ID</p>
                                    <input class="form-control" type="text" name="cid">
                                 </div> 
                                 <div class="form-group">
                                    <p>Currency:</p>
                                    <select class="form-control" placeholder="Project Manager" name="currency" id="currency">
                                      <option value="">Select Currency</option>
                                      <?php foreach($currency as $r) {?>
                                          <option  value="<?php echo  $r['name']?>">
                                                       <?php echo $r['name']?></option>
                                      <?php } ?>
                                    </select>
                                 </div> 

                                 <div class="form-group">
                                    <p>Status:</p>
                                    <select class="form-control" name="status">
                                        <option value="active">Active </option>
                                      <option value="inactive">Inactive</option>
                                    </select>
                                    </select>
                                 </div> 
                                 <div class="form-group multi_select_box">
                                    <p>Assign To</p>
                                      <select class="form-control" data-live-search="true" name="employee_name[]" id="employee_id" multiple>
                                       <option value="">Select Employee Assign To</option>
                                      <?php foreach($employees as $row) {?>
                                       <option data-tokens="<?php echo $row['user_id']; ?>" value="<?php echo $row['user_id']; ?>" ><?php echo $row['first_name']." " .$row['last_name']?></option>
                                       <?php } ?>
                                    </select>
                                    
                                    </div>
                                 <div class="form-group">
                                    <p>Notes</p>
                                    <textarea rows="5" class="form-control" name="notes">
                                      
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