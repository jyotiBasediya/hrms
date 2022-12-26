<?php $session = $this->session->userdata('username');?>
        <!-- partial -->



        <?php
   $session = $this->session->userdata('username');
   $user_info = $this->Hrms_model->read_user_info($session['user_id']);
   
   // print_r($user_info[0]->user_id);die;
   $role_user = $this->Hrms_model->read_user_role_info($user_info[0]->user_role_id);
   
   $designation_info = $this->Hrms_model->read_designation_info($user_info[0]->designation_id);
   
   $role_resources_ids = explode(',',$role_user[0]->role_resources);
   
   // print_r($role_resources_ids);die;
   ?>
<!-- <!DOCTYPE >
<html>
<head>
  
 <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css">
</head>
<body> -->
  <!--  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css"> -->
        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">

                    <h3 class="page-title">Employee </h3>
                    <div class="d-flex float-right"> 
                        <!-- <button class="btn btn-secondary btn-fw">Employment Types</button> -->
                        <!-- <button class="btn btn-secondary btn-fw mx-2">Employee Performance Review</button> -->
                      <?php if(in_array('16',$role_resources_ids)) { ?>
                        <a href="<?php echo site_url();?>add_form">
                        <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Employee </button>
                      </a>
                    <?php } ?>
                      <!--  -->
                    </div>  
                   </div>  
                </div> 

                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <!--<div class="row align-items-center">-->
                    <!--  <div class="col-sm-6"> -->
                    <!--    <div class="row">-->
                    <!--        <div class="col-sm-6">-->
                    <!--            <p class="mb-2">Show</p>-->
                    <!--            <input class="form-control" id="searchInput" type="" name="">   -->
                    <!--        </div>-->
                    <!--        <div class="col-sm-6">-->
                    <!--           <p class="mb-2">Group By</p>-->
                    <!--           <select class="form-control w-75">-->
                    <!--              <option>Timesheet Period</option>-->
                    <!--              <option>Person</option>-->
                    <!--              <option>Approver</option>-->
                    <!--           </select>   -->
                    <!--        </div>-->
                    <!--    </div>  -->
                    <!--  </div> -->
                    <!--  <div class="col-sm-6">-->
                    <!--   <div class="d-flex float-right"> -->
                    <!--     <div class="btn-group">-->
                    <!--      <button type="button" class="btn btn-secondary">Active</button>-->
                    <!--      <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--        <span class="sr-only">Toggle Dropdown</span>-->
                    <!--      </button>-->
                    <!--      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSplitButton1">-->
                    <!--        <a class="dropdown-item" href="#">Active</a>-->
                    <!--        <a class="dropdown-item" href="#">Active & Inactive</a>-->
                    <!--        <a class="dropdown-item" href="#">Active & Never Signed In</a>-->
                            
                    <!--      </div>-->
                    <!--   </div>-->
                    <!--     <div class="btn-group mx-2">-->
                    <!--      <button type="button" class="btn btn-secondary">Actions</button>-->
                    <!--      <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--        <span class="sr-only">Toggle Dropdown</span>-->
                    <!--      </button>-->
                    <!--      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSplitButton1">-->
                    <!--        <a class="dropdown-item" href="#">Mark as Inactive</a>-->
                    <!--        <a class="dropdown-item" href="#">Mark as Active</a>-->
                    <!--        <a class="dropdown-item" href="#">Change Timesheet Approver to...</a>-->
                    <!--        <a class="dropdown-item" href="#">Change Expense Sheet Approver to...</a>-->
                    <!--        <a class="dropdown-item" href="#">Change Time Off Approver to...</a>-->
                    <!--        <a class="dropdown-item" href="#">Send Welcome Email(s)</a>-->
                            
                    <!--      </div>-->
                    <!--   </div>-->
                    <!--     <div class="btn-group">-->
                    <!--      <button type="button" class="btn btn-secondary">Columns</button>-->
                    <!--      <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" id="dropdownMenuSplitButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">-->
                    <!--        <span class="sr-only">Toggle Dropdown</span>-->
                    <!--      </button>-->
                    <!--      <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuSplitButton1">-->
                    <!--        <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Accounting Package ID</a>-->
                    <!--        <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Billing Rate (Rs/hr)</a>-->
                    <!--        <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Costs (Rs/hr)</a>-->
                    <!--        <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Default Task</a>-->
                    <!--        <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Division</a>-->
                    <!--        <a class="dropdown-item" href="#"><input class="mr-2" type="checkbox" name=""> Email Address</a>-->
                            
                    <!--      </div>-->
                    <!--   </div>-->
                    <!--   </div>-->
                    <!--  </div> -->
                    <!--</div> -->

                    <table class="table table-hover mt-4 text-center" id="example">
                      <thead>
                        <tr>
                          <th>S.no </th>
                          <th>Full Name</th>
                          <th>Email Id</th>
                          <th>Mobile Number</th>
                          <th>Manager</th>
                          <th>Employee id</th>
                          <th>Role & Access</th>
                          <?php if(in_array('15',$role_resources_ids) || in_array('17',$role_resources_ids) || in_array('70',$role_resources_ids)) { ?>
                            <th>Action</th>
                          <?php } ?>
                        </tr>
                      </thead>
                      <tbody id="fbody">
                        
                         <?php
                        $i=1;
                        foreach ($data as $row)  
                        {
                        ?>
                        <tr>
                          <td><?php echo $i++;?></td>
                      
                         <td><?php echo $row->first_name . " " . $row->last_name;?></td>
                         
                          <td><?php echo $row->email; ?></td>
                          <td><?php echo $row->mobile_no; ?></td>
                          <td>
                            <?php 
                              if(!empty($row->manager_id)){
                                $manger_detail = $this->CommonModel->selectRowDataByCondition(array('user_id'=>$row->manager_id),'hrms_employees');

                                if(!empty($manger_detail)){
                                  $manger_detail = $manger_detail->first_name.''.$manger_detail->last_name;
                                }else{
                                  $manger_detail = 'No Manager alloted';
                                }
                              }else{
                                  $manger_detail = 'No Manager alloted';
                                }
                              echo $manger_detail;
                            ?>
                          </td>
                          <td><?php echo $row->employee_id; ?></td>
                          <td> 
                            <?php 
                              if(!empty($row->user_role_id)){
                                
                                $role_detail = $this->CommonModel->selectRowDataByCondition(array('role_id'=>$row->user_role_id),'hrms_user_roles');

                                if(!empty($role_detail)){
                                  $role_detail = $role_detail->role_name;
                                }else{
                                  $role_detail = 'No Role alloted';
                                }
                              }else{
                                $role_detail = 'No Role alloted';
                              }
                              echo $role_detail;
                            ?>
                          </td>
                          <td>
                            <?php if(in_array('15',$role_resources_ids)) { ?>
                            <a href="<?php echo site_url('employees/viewpost/'. $row->user_id);?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                             <?php } if(in_array('17',$role_resources_ids)) {?>
                            <a href="<?php echo site_url('employees/editpost/'. $row->user_id);?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
                          <?php } if(in_array('70',$role_resources_ids)) {
                                if($row->user_role_id != 1){
                            ?>  
                             <a  title="Delete" href="<?php echo base_url().'Add_form/delete_employee/'.$row->user_id;?>" onclick="return deleteClient()">
                                 <i class="fa fa-trash" ></i></a>
                          <?php } }?>

                           
                          </td>
                        </tr>
                        <?php } ?>
                        
                       
                        
                      </tbody>
                    </table>
                    <div class="row mt-4">
                     <!--  <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div>
                      </div> -->
                      <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                       <!--    <ul class="pagination float-right">
                            <li class="paginate_button page-item previous disabled" id="order-listing_previous"><a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li> -->
<!-- 
                            <li class="paginate_button page-item active"><a href="#" aria-controls="order-listing" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">2</a></li> -->
                            
                          <!--   <li class="paginate_button page-item next" id="order-listing_next"><a href="#" aria-controls="order-listing" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li> -->
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
<!-- 
  <script src="assets/js/filter_data.js"></script> -->
   <!--  <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/js/vendor.bundle.addons.js"></script>
    <script src="assets/js/shared/off-canvas.js"></script>
    <script src="assets/js/shared/misc.js"></script>
    <script src="assets/js/dashboard/dashboard.js"></script>
     <!- Custom js for this page-->
   <!-- <script src="assets/js/shared/chart.js"></script> -->
    <!-- End custom js for this page-->
   <!--  <script src="assets/js/shared/jquery.cookie.js" type="text/javascript"></script>
    <script src="assets/js/custom.js" type="text/javascript"></script>
 -->

<!-- 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>  -->
  
<!-- <script>
  $("#searchInput").keyup(function() {
  var rows = $("#fbody").find("tr").hide();
  var data = this.value.split(" ");
  $.each(data, function(i, v) {
    rows.filter(":contains('" + v + "')").show();
  });
});
</script> -->
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
                            columns: [0,1,2,3,4,6]                
                        },
     
                    },
                    {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,6]                
                        },
                     },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,6]                
                        },
                     },

                ],
        });
    });

  function deleteClient(){
        var result = confirm("Are sure delete this employee ?");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    } 
</script>