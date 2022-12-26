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
                    <h3 class="page-title">Expense Category </h3>
                    <div class="d-flex float-right"> 
                      <?php if(in_array('29',$role_resources_ids)) { ?>
                        <a href="<?php echo site_url();?>expenseCategory/addExpenseCategory"> <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Add Category </button></a>
                      <?php } ?>
                    </div>  
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <!--<div class="col-sm-6"> -->
                      <!--  <div class="row">-->
                      <!--      <div class="col-sm-6">-->
                      <!--          <p class="mb-2">Search</p>-->
                      <!--          <input class="form-control" id="searchInput">   -->
                      <!--      </div>-->
                            
                      <!--  </div>  -->
                      <!--</div> -->
                      <!-- <div class="col-sm-6">
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
                    <div class="table-responsive"> 
                    <table class="table table-hover mt-4 text-center" id="example">
                      <thead>
                        <tr>
                          <th>S.No</th>
                          <th>Category Name</th>
                          <th>Status</th>
                          <?php if(in_array('30',$role_resources_ids) || in_array('73',$role_resources_ids)) { ?>
                          <th>Action</th>
                        <?php } ?>
                        </tr>
                      </thead>
                      <tbody id="fbody">

                        <?php
                        
                        foreach ($expense_categories as $row)  
                        {
                        ?>
                        <tr>
                          <td><?php echo $row['expense_category_id'];?></td>
                          <td><span><?php echo $row['name'];?></span></td>
                          <td>
                            <!-- <button  title="Change Status" type="button" id="button" class="btn-info btn btn-sm " value="('<?=$row['expense_category_id']?>')" onclick="change_status('<?=$row['expense_category_id']?>','Active')"> Deactive </button> -->

                             <?php if($row['status'] == 1) { ?>
                                <button title="Change Status" class="btn-success  btn btn-sm" value="('<?=$row['expense_category_id']?>')" onclick="change_status('<?=$row['expense_category_id']?>','Deactive')"> Active </button>
                            <?php } else { ?>
                                <button  title="Change Status" type="button" id="button" class="btn-info btn btn-sm " value="('<?=$row['expense_category_id']?>')" onclick="change_status('<?=$row['expense_category_id']?>','Active')"> Deactive </button>
                            <?php }  ?>

                          </td>
                          
                          <td>
                            <?php if(in_array('30',$role_resources_ids)) { ?>
                           <a href="<?php echo site_url('expenseCategory/addExpenseCategory/'. $row['expense_category_id']);?>"> <i class="fa fa-pencil" aria-hidden="true"></i></a>
                           <?php }if(in_array('73',$role_resources_ids)) { ?>
                               <a  title="Delete" href="<?php echo base_url().'expenseCategory/delete_expense_category/'.$row['expense_category_id'];?>" onclick="return deleteClient()"> <i class="fa fa-trash" ></i></a>

                           <?php } ?>

                          
                          </td>
                        
                        </tr>
                        <?php

                          } ?>

                       <!--  <tr>
                          <td><input type="checkbox" name=""></td>
                          <td><span> Project Name </span></td>
                          <td >Project 1</td>
                          <td><span> </span></td>
                          <td> Project 1 </td>
                          <td>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <i class="fa fa-plus ml-3" aria-hidden="true"></i>
                          </td>
                        </tr> -->
                       <!--  <tr>
                          <td><input type="checkbox" name=""></td>
                          <td><span> Project Name </span></td>
                          <td >Project 1</td>
                          <td><span> </span></td>
                          <td> Project 1 </td>
                          <td>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <i class="fa fa-plus ml-3" aria-hidden="true"></i>
                          </td>
                        </tr> -->
                     <!--    <tr>
                          <td><input type="checkbox" name=""></td>
                          <td><span> Project Name </span></td>
                          <td >Project 1</td>
                          <td><span> </span></td>
                          <td> Project 1 </td>
                          <td>
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                            <i class="fa fa-plus ml-3" aria-hidden="true"></i>
                          </td>
                        </tr> -->
                        
                      </tbody>
                    </table>
                  <!--   <div class="row mt-4">
                      <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div>
                      </div> -->
                     <!--  <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
                          <ul class="pagination float-right">
                            <li class="paginate_button page-item previous disabled" id="order-listing_previous"><a href="#" aria-controls="order-listing" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li> -->
<!-- 
                            <li class="paginate_button page-item active"><a href="#" aria-controls="order-listing" data-dt-idx="1" tabindex="0" class="page-link">1</a></li>
                            <li class="paginate_button page-item "><a href="#" aria-controls="order-listing" data-dt-idx="2" tabindex="0" class="page-link">2</a></li>
                             --><!-- 
                            <li class="paginate_button page-item next" id="order-listing_next"><a href="#" aria-controls="order-listing" data-dt-idx="3" tabindex="0" class="page-link">Next</a></li> -->
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


    function change_status(id,value)
    {
      // alert(1);
        var expense_category_id = id;
            // alert(user_id);
        if(confirm("Are you sure want "+value+" this expense category")){
            $.ajax({
                url: '<?php echo site_url("ExpenseCategory/status_category"); ?>',
                type: "POST",
                data: {
                    "expense_category_id" : expense_category_id
                },
                success: function(response) { 
                    var data = response;
                    // console.log(data);
                    if(data.status == 1)
                    {
                        $('#change_status_'+data.user_id).removeClass("btn-info").addClass('btn-success').text('Active')
                    }
                    else 
                    {

                        $('#change_status_'+data.user_id).removeClass("btn-success").addClass('btn-info').text('Deactive')
                    }
                    location.reload();
                }
            });
        }
    }


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
                            columns: [0,1,2,3,4,6,7,8]                
                        },
     
                    },
                    {
                        extend: 'excel',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,6,7,8]                
                        },
                     },
                    {
                        extend: 'print',
                        orientation: 'landscape',
                        pageSize: 'LEGAL',
                        columns: ':visible',
                         exportOptions: {                    
                            columns: [0,1,2,3,4,6,7,8]                
                        },
                     },

                ],
        });
    });

   function deleteClient(){
        var result = confirm("Are sure delete this client ?");
        if(result == true){
            return true;
        } 
        else{
            return false;
        }
    } 
</script>