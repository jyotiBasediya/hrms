
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
                    <h3 class="page-title">Expense Request </h3>
                    <!-- <div class="d-flex float-right"> 
                        <a href="<?php echo site_url();?>employeeExpense/applyforExpense"> <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Apply For Expense</button></a>
                    </div>   -->
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-sm-6"> 
                        <div class="row">
                            <!-- <div class="col-sm-6">
                                <p class="mb-2">Search</p>
                                <input class="form-control" id="searchInput">   
                            </div> -->
                            
                        </div>  
                      </div> 
                    </div>  
                    <div class="table-responsive">
                      <table class="table table-hover mt-4 text-center" id="example">
                        <thead>
                          <tr>
                           <th>S.No</th>
                            <th>Employee</th>
                            <th>Expense Category</th>
                            <th>Amount</th>
                            <th>Proof</th>
                            <th>Remark</th>
                            <?php if(in_array('34',$role_resources_ids)) { ?>
                            <th>Status</th>
                          <?php }?>
                            <!-- <th>Edit</th> -->
                          </tr>
                        </thead>
                        <tbody id="fbody">

                          <?php
                          
                          foreach ($pdata as $row)  
                          {
                            $catname = "";
                            $whr = array('expense_category_id'=>$row['expense_category_id']);
                            $pdata = $this->Expense_model->getsingleexpencedata('expense_categories',$whr);
                            if(isset($pdata) && !empty($pdata)){
                              $catname = $pdata[0]['name'];
                            }
                          ?>
                          <tr>
                            <td><?php echo $row['id'];?></td>
                            <td>
                               <?php 
                               $this->load->model('Employees_model');
                                  $id = $row['employee_id'];
                                  // $client_detail = $this->Client_model->edit($id);

                                  $employees_detail = $this->Employees_model->edit_id($id);

                                  $company_name = $employees_detail->first_name.' '.$employees_detail->last_name;
                                  echo $company_name;
                              ?>
                            </td>
                            <td><?php echo $catname;?></td>
                            <td>Rs <span><?php echo $row['amount'];?></span></td>
                            <td>
                              
                              <?php if(!empty($row['img']))
                                {
                                  $img = base_url().'uploads/gst/'.$row['img'];
                                }else{
                                  $img =  base_url().'uploads/gst/default.png';
                                }
                              ?>
                              <a href="<?php echo $img; ?>" target="blank">
                                <img src="<?php echo $img; ?>" alt="img" width="500" height="600">
                              </a>
                              
                            </td>
                            <td><span><?php echo $row['remark'];?></span></td>
                            <?php if(in_array('34',$role_resources_ids)) { ?>
                            <td>
                              <?php if($row['status'] == "pending"){ ?>
                                <a href="<?php echo site_url('EmployeeExpenseAdmin/approve/'. $row['id']);?>">Approve </a> /
                                <a href="<?php echo site_url('EmployeeExpenseAdmin/decline/'. $row['id']);?>"> </i>Decline</a>
                              <?php } ?>
                              <?php if($row['status'] != "pending"){ ?>
                                  <span><?php echo $row['status'];?></span>
                              <?php } ?>
                              

                            </td>
                          <?php } ?>
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

            </div>
            <!-- content-wrapper ends -->
           

          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
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