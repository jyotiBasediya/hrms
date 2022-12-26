<!DOCTYPE>

    <?php
   $session = $this->session->userdata('username');
   $user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
   
   // print_r($role_resources_ids);die;
   ?>
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
                    <h3 class="page-title">Apply Leave List </h3>
                    <div class="d-flex float-right"> 
                       <?php if(in_array('21',$role_resources_ids)) { ?>
                        <a href="<?php echo site_url();?>timesheet/leave_insert"> <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Add Apply Leave </button></a>
                      <?php } ?>
                      <!--  -->
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <!-- <div class="row align-items-center">
                      <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2">Search</p>
                                <input class="form-control" id="searchInput" type="" name="">   
                            </div>
                            
                        </div>  
                      </div> 
                      <div class="col-sm-6">
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
                      </div> 
                    </div>  --> 
                    <div class="table-responsive">
                    <table class="table table-hover mt-4 text-center"  id="example">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <!--<th>Client Name</th>-->
                          <th>Leave Type</th>
                          <th>Start Date</th>
                          <th>End Date</th>
                          <th>Note</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody id="fbody">

                        <?php
                        $i=1;
                        foreach ($leave as $v)  
                        {
                        ?>
                        <tr>
                          <td><?php echo $i++;?></td>
                      
                         <td>
                             <?php
                                $leave_detail = $this->CommonModel->selectRowDataByCondition(array('id' => $v['leave']),'hrms_leave_category');
                                
                                if(!empty($leave_detail)){
                                    $leave_name = $leave_detail->leave_name;
                                }else{
                                    $leave_name = 'No Leave type';
                                }
                                echo $leave_name;
                                
                            ?>
                         </td>
                         <!--<td><?php echo $v['leave'];?></td>-->
                        
                          <td><?php echo  date("d-m-Y", strtotime($v['sdate']));?></td>
                          <td><?php echo  date("d-m-Y", strtotime($v['edate']));?></td>
                          <td><?php echo $v['note'];?></td>
                          <td>
                              <?php
                               if(!empty($v['status'] == 0)){
                                    $status = 'Pending';
                                }else{
                                    $status = 'Approved';
                                }
                                echo $status;
                              ?>
                          </td>
                        </tr>
                        <?php  } ?>
                        
                      </tbody>
                    </table>
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
                            columns: [0,1,2,3,4,5]                
                        },
     
                    },
                    {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,5]                
                        },
                     },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,5]                
                        },
                     },

                ],
        });
    });
</script>