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
                    <h3 class="page-title">HR Leave List </h3>
                   </div>  
                </div> 
                  
                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                      <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                               <p class="mb-2">Employee</p>
                               <select class="form-control" placeholder="Employee Name" name="employee_name" id="employee_name" >
                                <option  value="">Select Employee Name</option>
                                 <?php foreach($employees as $row) {?>
                                       <option  value="<?php echo  $row['user_id'];?>">
                                                     <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                              </select>
                            </div>
                           
                        </div>  
                      </div> 
                       <div class="col-sm-6"> 
                        <div class="row">
                             <button onclick="filterData();" class="btn btn-primary">Filter</button>
                             <a href="<?php echo site_url();?>report" class="btn btn-primary">Refresh</a>
                        </div>  
                      </div> 
                    </div> 
                    <div class="table-responsive">
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
                              
                              foreach($leave_balance as $v) { 
                          
                          ?>
                          <tr>
                              <td><?php echo $i++;?></td>
                               <td>
                                  <?php echo $v['first_name'].' '.$v['last_name'];?>
                              </td>
                              
                              <td><?php echo $v['leave_name'];?></td>
                              <td><?php echo $v['yearly_number'];?></td>
                              <td>
                                  <?php
                                      $leave_id = $v['leave'];
                                      $emp_name = $v['emp_name'];
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
 

<script type="text/javascript">
  $(document).ready(function() {
       $('#employee_name').select2();
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
    
     function filterData()
     {
         
        //  alert(1);

        var employee_name = document.getElementById('employee_name').value;

         var buildSearchData = {
            "employee_name"         : employee_name,
        };

         table = $('#example').DataTable({ 
            // "scrollY"       : "350px",
            // "scrollCollapse": true,
            "dom"     : 'lBfrtip',
            "buttons"   : [
                      {
                            'extend': 'pdfHtml5',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                            'exportOptions': {                    
                                 columns: [0,1,2]                        
                            },
         
                        },
                        // 'excel',
                        {
                            'extend': 'excel',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                 columns: [0,1,2]                        
                            },
                         },
                         // 'print',
                        {
                            'extend': 'print',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                columns: [0,1,2]                        
                            },
                         },
                    ],
            "ajax"          :  {
               "url"        : '<?php echo site_url("timesheet/filter"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        });
    }
</script>