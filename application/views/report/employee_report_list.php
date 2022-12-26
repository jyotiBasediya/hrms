<?php 
$session = $this->session->userdata('username');
$user_info = $this->Hrms_model->read_user_info($session['user_id']);
?>
        <!-- partial -->


        <div class="main-panel">
           <div class="content-wrapper">   
                <div class="page-header">
                   <div class="d-flex justify-content-between w-100">

                    <h3 class="page-title">Report </h3>
                   </div>  
                </div> 

                <div class="row">  
                  <div class="col-lg-12 grid-margin stretch-card">
                   <div class="card">
                  <div class="card-body">
                    <div class="row align-items-center">
                      <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2">Company Name</p>
                                 <select class="form-control" placeholder="Client Name" name="client_name" id="client_name" onchange="getProject(this.value);">

                                      <option>Select Company Name</option>
                                      
                                    <?php foreach($clients as $row) {?>
                                        <option  value="<?php echo  $row['id']?>">
                                                     <?php echo $row['first_name']." " .$row['last_name']?></option>
                                                       <?php } ?>
                                                          </select>  
                            </div>
                            <div class="col-sm-6">
                               <p class="mb-2">Project</p>
                               <select class="form-control" placeholder="Project Name" name="project_name" id="project_name" onchange="getTask(this.value);">
                                <option  value="">Select Project Name</option>
                              </select>
                            </div>

                        </div>  
                      </div> 
                      <div class="col-sm-6"> 
                        <div class="row">
                            <div class="col-sm-6">
                                <p class="mb-2">Task</p>
                                 <select class="form-control" placeholder="Task Name" name="task_id" id="task_id" onchange="getEmployee(this.value);">
                                <option  value="">Select Task</option>
                              </select>
                            </div>
                            <!-- <div class="col-sm-6">
                               <p class="mb-2">Employee</p>
                               <select class="form-control" placeholder="Employee Name" name="employee_name" id="employee_name" >
                                <option  value="">Select Employee Name</option>
                              </select>
                            </div> -->
                            <input type="hidden" name="employee_name" id="employee_name" value="<?php echo $user_info[0]->user_id;?>">


                             <!-- <button onclick="filterData();" class="btn btn-primary">Filter</button> -->
                        </div>  
                      </div> 
                      <div class="col-sm-6"> 
                        <div class="filters-new">
                         <button onclick="filterData();" class="btn btn-primary">Filter</button>
                         <a href="<?php echo site_url();?>employee_report_list" class="btn btn-primary">Refresh</a>
                       </div>
                      </div>
                    </div> 
                    <div class="table-responsive">
                      <table class="table table-hover mt-4 text-center" id="example">
                        <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Company Name</th>
                            <th>Project Name</th>
                            <th>Task Name</th>
                            <th>Employee Name</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody id="fbody">
                          
                           <?php
                          $i =1;
                          foreach ($report_list as $v)  
                          {
                          ?>
                          <tr>
                            <td><?php echo $i++;?></td>
                        
                           <td><?php echo $v['client_first_name'] . " " . $v['client_last_name'];?></td>
                            <td><?php echo $v['project_name'];?></td>
                            <td><?php echo $v['task_name'];?></td>
                            <td><?php echo $v['first_name'] . " " . $v['last_name'];?></td>
                            <td></td>
                          </tr>
                          <?php } ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="row mt-4">
                     <!--  <div class="col-sm-12 col-md-5">
                        <div class="dataTables_info" id="order-listing_info" role="status" aria-live="polite">Showing 1 to 5 of 10 entries</div>
                      </div> -->
                      <div class="col-sm-12 col-md-7">
                        <div class="dataTables_paginate paging_simple_numbers" id="order-listing_paginate">
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

 <script type="text/javascript">
  $(document).ready( function () {
    $('#example').DataTable();
} );

   function getProject(client_name){

        $.ajax({
            url: '<?php echo site_url("ReportController/getProject"); ?>',
            type: "POST",
            data: {
                "client_name" : client_name
            },
            success: function (response) 
            {
                console.log(response);
                
                 var html = '<option value="">Select Project</option>';
                 
                if (response == '0') {
                     
                    html += '<option value="0">No Project Found</option>'
                      
                    $('#project_name').html(html);
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                   
                    for(var i=0; i<obj.length; i++){
                        html += '<option value="'+obj[i]['id']+'">'+obj[i]['project_name']+'</option>'
                    }
                    $('#project_name').html(html);
                }
            }
        });
    }

    function getTask(project_name){

        $.ajax({
            url: '<?php echo site_url("ReportController/getTask"); ?>',
            type: "POST",
            data: {
                "project_name" : project_name
            },
            success: function (response) 
            {
                console.log(response);
                
                 var html = '<option value="">Select Task</option>';
                 
                if (response == '0') {
                     
                    html += '<option value="0">No Task Found</option>'
                      
                    $('#task_id').html(html);
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                   
                    for(var i=0; i<obj.length; i++){
                        html += '<option value="'+obj[i]['task_id']+'">'+obj[i]['task_name']+'</option>'
                    }
                    $('#task_id').html(html);
                }
            }
        });
    }

    function getEmployee(task_id){

        $.ajax({
            url: '<?php echo site_url("ReportController/getEmployee"); ?>',
            type: "POST",
            data: {
                "task_id" : task_id
            },
            success: function (response) 
            {
                console.log(response);
                
                 var html = '<option value="">Select employee</option>';
                 
                if (response == '0') {
                     
                    html += '<option value="0">No employee Found</option>'
                      
                    $('#employee_name').html(html);
                } else {
                    var obj = JSON.parse(response);
                    // console.log(obj.length);
                   
                    for(var i=0; i<obj.length; i++)
                    {
                        var name = obj[i]['first_name']+' '+obj[i]['last_name'];

                        html += '<option value="'+obj[i]['employee']+'">'+name+'</option>'
                    }
                    $('#employee_name').html(html);
                }
            }
        });
    }

    function filterData(){

        var client_name = document.getElementById('client_name').value;
        var project_name = document.getElementById('project_name').value;
        var task_id = document.getElementById('task_id').value;
        // var employee_name = document.getElementById('employee_name').value;
        var employee_name = $('#employee_name').val();
        // alert(employee_name);

         var buildSearchData = {
            "client_name"           : client_name,
            "project_name"          : project_name,
            "task_id"               : task_id,
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
                                'columns': [0,1, 2,3,4,5,6,7,8,9,10,11,12,13,14]                
                            },
         
                        },
                        // 'excel',
                        {
                            'extend': 'excel',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                'columns': [0,1, 2,3,4,5,6,7,8,9,10,11,12,13,14]                
                            },
                         },
                         // 'print',
                        {
                            'extend': 'print',
                            'orientation': 'landscape',
                            'pageSize': 'LEGAL',
                            'columns': ':visible',
                             'exportOptions': {                    
                                'columns': [0,1, 2,3,4,5,6,7,8,9,10,11,12,13,14]                
                            },
                         },
                    ],
            "ajax"          :  {
               "url"        : '<?php echo site_url("ReportController/filter"); ?>',
               "type"       : 'POST',
               "data"       : buildSearchData
           },
            "bDestroy": true 
        });
    }
 </script>

