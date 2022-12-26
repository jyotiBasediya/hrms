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
                    <h3 class="page-title">Apply Leave List <div class="float-right"> 
                        <a href="<?php echo site_url();?>timesheet/leave_insert"> <button class="btn btn-secondary btn-fw"><i class="fa fa-plus-circle"aria-hidden="true"></i> Add Apply Leave </button></a>
                      <!--  -->
                    </div></h3>
                      
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                    <div class="card">
                      <div class="card-body">
                        
                            <div class="table-resonsive">
                              <table class="table table-hover mt-4 text-center"  id="example">
                                <thead>
                                  <tr>
                                    <th>S.No</th>
                                    <th>Employee Name</th>
                                    <th>Leave Category</th>
                                    <th>Yearly number</th>
                                    <th>Total leave</th>
                                    <th>Remaining Leave</th>
                                  </tr>
                                </thead>
                                <tbody id="fbody">
                                    
                                  <?php 
                                  
                                      $session = $this->session->userdata('username');
                                      $user_info = $this->Hrms_model->read_user_info($session['user_id']);
              
                                      $i =1;
                                      
                                      foreach($leave_category as $v) { 
                                  
                                  ?>
                                  <tr>
                                      <td><?php echo $i++;?></td>
                                       <td>
                                          <?php
                                              $leave_id = $v['id'];
                                              $emp_name = $session['user_id'];
                                              $total_balance = $this->CommonModel->getemployee_leavebalance($leave_id,$emp_name);
                                          
                                              if(!empty($total_balance)){
                                                  $name = $total_balance->first_name.' '.$total_balance->last_name;
                                              }
                                              
                                              echo $name;
                                          ?>
                                      </td>
                                      
                                      <td><?php echo $v['leave_name'];?></td>
                                      <td><?php echo $v['yearly_number'];?></td>
                                      <td>
                                          <?php
                                              $leave_id = $v['id'];
                                              $emp_name = $session['user_id'];
                                              $total_balance = $this->CommonModel->getemployee_leavebalance($leave_id,$emp_name);
                                              
                                              if(!empty($total_balance)){
                                                  $total = $total_balance->total_days;
                                              }else{
                                                  $total == '0';
                                              }
                                              echo $total;
                                          ?>
                                      </td>
                                      <td>
                                          <?php
                                              $yearly_number = $v['yearly_number'];
                                              $total = $total_balance->total_days;
                                              
                                              $remainin = $yearly_number - $total;
                                              
                                              echo $remainin;
                                          ?>
                                      </td>
                                        
                                    </tr>
                                    <?php } ?>
                                  
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