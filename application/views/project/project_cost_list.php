        <?php
   $session = $this->session->userdata('username');
   $user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
   
   // print_r($role_resources_ids);die;
   ?>
<!DOCTYPE>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body>
        <!-- partial -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">
                    <h3 class="page-title">Project Cost</h3>
                    <div class="d-flex float-right"> 
                        <!-- <a href="<?php echo site_url();?>project"> <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Add Project </button></a> -->
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <!-- <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2">Search</p>
                                <input class="form-control" id="searchInput">   
                            </div>
                        </div>  
                      </div>  -->
                     <!--  <div class="col-sm-6">
                       <div class="d-flex float-right"> 
                         <div class="btn-group">
                          <button type="button" class="btn btn-secondary">Active</button>
                          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSplitButton1">
                            <a class="dropdown-item" href="#">Active</a>
                            <a class="dropdown-item" href="#">Active & Inactive</a>
                            <a class="dropdown-item" href="#">Inactive</a>
                            
                          </div>
                       </div>
                         <div class="btn-group mx-2">
                          <button type="button" class="btn btn-secondary">Actions</button>
                          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSplitButton1">
                            <a class="dropdown-item" href="#">Mark as Inactive</a>
                            <a class="dropdown-item" href="#">Mark as Active</a>
                          </div>
                       </div>
                         <div class="btn-group">
                          <button type="button" class="btn btn-secondary">Columns</button>
                          <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="sr-only">Toggle Dropdown</span>
                          </button>
                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSplitButton1">
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Accounting Package ID</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Project</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Project Name</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Project Short Name</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Notes</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Status</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Time Entry Preview </a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Client Detail Link</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Duplicate Client</a>
                            <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Restore Column Defaults</a>
                          </div>
                       </div>
                       </div>
                      </div>  -->
                    </div>  
                    <table class="table table-hover mt-4 text-center" id="example">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Company Name</th>
                          <th>Project Name</th>
                          <th>Task Name</th>
                          <th>Employee Name</th>
                          <th>Cost</th>
                          <th>Hours</th>
                          <?php if(in_array('14',$role_resources_ids)) { ?>
                          <th>Action</th>
                        <?php } ?>
                        </tr>
                      </thead>
                      <tbody id="fbody">

                        <?php
                        $i = 1;
                        foreach ($project_cost as $row)  
                        {
                        ?>
                        <tr>
                          <td><?php echo $i++;?></td>
                          <td ><?php echo $row['client_first_name'];?> <?php echo $row['client_last_name'];?></td>
                          <td ><?php echo $row['project_name'];?></td>
                          <td ><?php echo $row['task_name'];?></td>
                          <td ><?php echo $row['first_name'];?> <?php echo $row['last_name'];?></td>
                          <td ><?php echo $row['cost'];?></td>
                          <td ><?php echo $row['hours'];?></td>
                          <?php if(in_array('14',$role_resources_ids)) { ?>
                            <td>
                             <a href="<?php echo site_url('edit_project_cost/'. $row['id']);?>"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                            </td>
                          <?php } ?>
                        </tr>
                        <?php } ?>
                        
                      </tbody>
                    </table>
                          </ul>
                        </div>
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

    <script src="assets/js/shared/chart.js"></script>

    <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script> -->

  <script type="text/javascript">
      $(document).ready(function() {
        $('#example').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                    {
                        extend: 'pdfHtml5',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                        exportOptions: {                    
                            columns: [0,1,2,3,4,5,6]                
                        },
     
                    },
                    {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,5,6]                
                        },
                     },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,5,6]                
                        },
                     },

                ],
        });
    });
  </script>